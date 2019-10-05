<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;

class payFee extends Controller{
	
    function getAllDueFeesByStudent(Request $request){
		$student_id = $request->student_id;
		$section_id = getStudentSectionID($student_id);
		$standard_id = getStudentStandardID($student_id);
		$data = DB::table('fee_structures')
		->join('fee_amounts','fee_structures.fee_entity_id','=','fee_amounts.ID')
		->join('fee_types','fee_amounts.fee_type_ID','=','fee_types.ID')
		->orWhere('fee_structures.section_id',$section_id)->orWhere('fee_structures.standard_id',$standard_id)
		->select('*','fee_structures.ID as ID')
		->get();
		
		
		$data2 = DB::table('paid_fees')->where('student_id',$student_id)->select('fee_entity_id')->get();
		
		$anArr = array();
		foreach($data2 as $one2){
			$fee_entity_ID = $one2->fee_entity_id;
			array_push($anArr,$fee_entity_ID);
		}
		
		
		$finalArr = array();
		foreach($data as $key => $one){
			try{
			$one->packed_structure = unserialize($one->packed_structure);
			$one->fee_structure = unserialize($one->fee_structure);
			$one->total_payable_fee = array_sum($one->fee_structure);
			}
			catch(Exception $ex){
				$one->total_payable_fee = $one->fee_total_amount;
			}
			$one->fee_status = "DUE";
			if(in_array($one->fee_entity_id,$anArr)) $one->fee_status = "PAID";
			array_push($finalArr,$one);
		}
		return datatables()->of($finalArr)->toJson();
	}
	
	 function getParticularDueFeeByStructureID($id){
		$data = DB::table('fee_structures')
		->join('fee_amounts','fee_structures.fee_entity_id','=','fee_amounts.ID')
		->join('fee_types','fee_amounts.fee_type_ID','=','fee_types.ID')
		->where('fee_structures.ID',$id)
		//->select('fee_structures.ID','fee_type_ID','fee_full_name','fee_for','fee_description','fee_entity_ID','packed_structure','fee_structure')
		->select('*','fee_structures.ID as ID')
		->get()->toArray()[0];
		
		try{
		$data->fee_structure = unserialize($data->fee_structure);
		$data->packed_structure = unserialize($data->packed_structure);
		$data->total_payable_fee = array_sum($data->fee_structure);
		}
		catch(Exception $ex){
			$data->total_payable_fee = $data->fee_total_amount;
		}
		
		return $data = (array)$data;
	}
	
	function markFeeAsPaid($id){
		$type = getUserType();
		$userTypeID = getUserTypeID();
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['fee_payment'];
		if($permission != 'allowed' AND $type !='student') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to mark the fee Payment.');
		if($type == 'student' AND $userTypeID != request()->student_id) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You can only pay your fees from your account.');
		$one = $this->getParticularDueFeeByStructureID($id);
		$data = array();
		$data['student_id'] = request()->student_id;
		$data['fee_entity_id'] = $one['fee_entity_id'];
		$data['fee_amount'] = $one['total_payable_fee'];
		$data['payment_date'] = date('Y-m-d H:i:s');
		$data['fee_status'] = "PAID";
		$data['comments'] = request()->comments;
		try{
		DB::table('paid_fees')->insert($data);
		return sendJsonResponse(null,200,"Fee Successfully Marked as PAID.");
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,"Cound Mark the Fee As PAID",true,$ex->getMessage());
		}
	}
	
	function getFeeStudentStats($id,Request $request){
		$fee_type_id = $id;
		$section_ids_ob = DB::table('fee_types')->where('ID',$fee_type_id)->select('fee_sections')->get();
		$standard_ids_ob = DB::table('fee_types')->where('ID',$fee_type_id)->select('fee_standards')->get();
		$section_ids = explode(',',$section_ids_ob[0]->fee_sections);
		$standard_ids = explode(',',$standard_ids_ob[0]->fee_standards);
		
		$count = DB::table('fee_amounts')->where('fee_type_ID',$fee_type_id)->count();
		if($count == 0) return sendJsonResponse(null,201,'Cound Not Fetch Students Fee Statistics for this month.',true, 'Amounts for this Fee Type Not Set Yet.');
		
		$data = DB::table('fee_structures')
		->join('fee_amounts','fee_structures.fee_entity_id','=','fee_amounts.ID')
		->join('fee_types','fee_amounts.fee_type_ID','=','fee_types.ID')
		->orWhereIn('fee_structures.section_id',$section_ids)->orWhereIn('fee_structures.standard_id',$standard_ids)
		->select('*','fee_structures.ID as ID')
		->get();
		
		$fee_entity_id = DB::table('fee_amounts')->where('fee_type_ID',$fee_type_id)->select('ID')->get()[0]->ID;
		
		$count = DB::table('fee_structures')->where('fee_entity_id',$fee_entity_id)->count();
		if($count == 0) return sendJsonResponse(null,201,'Cound Not Fetch Students Fee Statistics for this month.',true, 'Structures for this Fee Type Not Set Yet.');
		
		$students = array();
		$student_ids = array();
		foreach($section_ids as $one){
			$data = DB::table('students')
			->join('standards','standards.ID','=','students.standard_id')
			->join('sections','sections.ID','=','students.section_id')
			->where('students.section_id',$one)
			->select('*','students.ID as student_id')
			->get();
			foreach($data as $two){
				array_push($students,$two);
				array_push($student_ids,$two->student_id);
			}
		}
		

		foreach($standard_ids as $one){
			$data = DB::table('students')
			->join('standards','standards.ID','=','students.standard_id')
			->join('sections','sections.ID','=','students.section_id')
			->where('students.standard_id',$one)
			->select('*','students.ID as student_id')
			->get();
			foreach($data as $two){
				array_push($students,$two);
				array_push($student_ids,$two->student_id);
			}
		}

		$students_paid_fee = DB::table('paid_fees')
		->where('fee_entity_id',$fee_entity_id)
		->whereIn('student_id',$student_ids)
		->select('student_id')
		->get();
		
		$data3 = DB::table('fee_structures')
		->where('fee_entity_id',$fee_entity_id)
		->orWhereIn('standard_id',$standard_ids)
		->orWhereIn('section_id',$section_ids)
		->get();
		
		
		$data4 = array();
		foreach($data3 as $one){
			$data4['section'][$one->section_id] = $one->fee_total_amount;
			$data4['standard'][$one->standard_id] = $one->fee_total_amount;
		}
		
		$student_paid_fee_ids = array();
		foreach($students_paid_fee as $one){
			array_push($student_paid_fee_ids,$one->student_id);
		}
		
		$finalArr = array();
		foreach($students as $one){
			try{
			$one->fee_amount = $data4['section'][$one->section_id];
			}
			catch(Exception $ex){
				$one->fee_amount = $data4['standard'][$one->standard_id];
			}
			if(in_array($one->student_id,$student_paid_fee_ids)) $one->fee_status = 'PAID';
			else $one->fee_status = 'DUE';
			array_push($finalArr,$one);
		}
		
		return datatables()->of($finalArr)->toJson();
	}
	
}	