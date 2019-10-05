<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;

class fillFee extends Controller{
	
    public function addNewFee($fee_entity_id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_structures = $data['ADD']['fee_structures'];
		if($fee_structures!='allowed') $ADD_Permission = false;
		else $ADD_Permission = true;
		$data = DB::table('fee_amounts')->where('ID',$fee_entity_id)->select('fee_method')->get();
		$fee_method = $data[0]->fee_method;
		$data = request()->request;
		$checkT = request()->type;
		//Fee Method 1
		if($fee_method==1){
			foreach($data as $key => $value){
				if($key=='type') continue;
				$standard_id = explode("T",$key)[1];
				$totalMarks = $value;
				if($checkT=='standards') $arr['standard_id'] = $standard_id;
				if($checkT=='sections') $arr['section_id'] = $standard_id;
				$arr['fee_entity_id'] = $fee_entity_id;
				$arr['fee_total_amount'] = $totalMarks;
				$arr['fee_structure'] = 0;
				try{
				if($ADD_Permission == false) throw new exception("You do not have the permission to set Fee Structures for requested Fee Entity.");
				$check = DB::table('fee_structures')->insert($arr);
				}
				catch(Exception $ex){
					try{
					$data = checkToken(request()->token);
					if($data==401) return show(401);
					if($data==403) return show(403);
					
					$fee_structures = $data['EDIT']['fee_structures'];
					$this_fee_structures = $this->getFeeStructuresIDByFeeEntityID($fee_entity_id);
					
					if(!(array_intersect($this_fee_structures, $fee_structures) == $this_fee_structures)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to edit Fee Structure(s) for requested Fee Entity.');
					
					DB::table('fee_structures')->where('standard_id',$standard_id)->where('fee_entity_id',$fee_entity_id)->update($arr);
					}
					catch(Exception $po){
						return sendJsonResponse($data=null,201,'Fee Structures could not be inserted.',true,$po->getMessage());
					}
				}
			}
			return sendJsonResponse($data=null,200,'Fee Structures Inserted or Updated.');
		}
		//Fee Method 2
		if($fee_method==2){
		$bigArr = array();
		$previousStudentID = 0;
		$rightPart = array();
		foreach($data as $key => $value){
			if (strpos($key, 'S') === 0) {
				$arr = explode('S',$key,2);
				$arr = explode('Q',$arr[1],2);
				$arr[2] = $value;
				$studentID = $arr[0];
				$questionID = $arr[1];
				$questionMarks[$questionID] = $arr[2];
				if($studentID == $previousStudentID OR $previousStudentID == 0){
					array_push($rightPart,$questionMarks);
					$bigArr[$studentID] = end($rightPart);
					$previousStudentID = $studentID;
				}
				else {
					array_push($rightPart,$questionMarks);
					$bigArr[$studentID] = end($rightPart);
					$previousStudentID = 0;
					$rightPart = array();
				}
			}
		}
		foreach($bigArr as $key => $value){
			$arr = [];
			if($checkT=='standards') $arr['standard_id'] = $key;
			if($checkT=='sections') $arr['section_id'] = $key;
			$arr['fee_entity_id'] = $fee_entity_id;
			$arr['fee_total_amount'] = array_sum($value);
			$arr['fee_structure'] = serialize($value);
			try{
				if($ADD_Permission == false) throw new exception("You do not have the permission to set Fee Structures for requested Fee Entity.");
				$check = DB::table('fee_structures')->insert($arr);
			}
			catch(Exception $ex){
				try{
				$data = checkToken(request()->token);
					if($data==401) return show(401);
					if($data==403) return show(403);
					$fee_structures = $data['EDIT']['fee_structures'];
					$this_fee_structures = $this->getFeeStructuresIDByFeeEntityID($fee_entity_id);
					
					if(!(array_intersect($this_fee_structures, $fee_structures) == $this_fee_structures)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to edit Fee Structure(s) for requested Fee Entity.');
				DB::table('fee_structures')->where('standard_id',$key)->where('fee_entity_id',$fee_entity_id)->update($arr);
				}
				catch(Exception $po){
					return sendJsonResponse($data=null,201,'Fee Structures could not be inserted.',true,$po->getMessage());
				}
			}
		}
		}
		return sendJsonResponse($data=null,200,'Fee Structures successfully Inserted or Updated.');
	}
	
	public function getFee($id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_structures = $data['VIEW']['fee_structures'];
		$this_fee_structures = $this->getFeeStructuresIDByFeeEntityID($id);
		if(!(array_intersect($this_fee_structures, $fee_structures) == $this_fee_structures)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view Fee Structure(s) for requested Fee Entity.');
		
		try{
		$data = DB::table('fee_amounts')->where('ID',$id)->select('fee_method')->get();
		$fee_method = $data[0]->fee_method;
		$data = DB::table('fee_structures')->where('fee_entity_id',$id)->get();
		if(count($data)==0) throw new exception('Marks were never stored for this entity.');
		$major = array();
		//Fee Method 1
		if($fee_method==1){
			foreach($data as $one){
				if($one->section_id != null) $standard_id = $one->section_id;
				if($one->standard_id != null) $standard_id = $one->standard_id;
				$arr['T'.$standard_id] = $one->fee_total_amount;
				$major = array_merge($major,$arr);
			}
		}
		//Fee Method 2
		if($fee_method==2){
		foreach($data as $one){
			$one->fee_structure = unserialize($one->fee_structure);
			foreach($one->fee_structure as $key => $value){
				if($one->section_id != null) $standard_id = $one->section_id;
				if($one->standard_id != null) $standard_id = $one->standard_id;
				$one->fee_structure['S'.$standard_id.'Q'.$key] = $value;
				unset($one->fee_structure[$key]);
			}
			unset($one->standard_id);
			unset($one->section_id);
			unset($one->fee_entity_id);
			unset($one->fee_total_amount);
			$major = array_merge($major,$one->fee_structure);
		}
		}
		return $major;
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fees not found.',true,$ex->getMessage().$ex->getLine());
		}
	}
	
	public function getFeeStructuresIDByFeeEntityID($id){
		$data = DB::table('fee_structures')->where('fee_entity_id',$id)->select('ID')->get();
		$arr = array();
		foreach($data as $one){
			array_push($arr,$one->ID);
		}
		return $arr;
	}
	
}	