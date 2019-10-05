<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class evaluations extends Controller{
	
    public function getAllEvaluations(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$evaluations = $data['VIEW']['evaluations'];
		$evaluations = DB::table('evaluations')
		->whereIn('ID',$evaluations)
		->select('ID','standards_involved')->get();
		$data = array();
		foreach($evaluations as $evaluation){
			$ids = explode(',',$evaluation->standards_involved);
		$standards = DB::table('standards')->whereIn('ID',$ids)->select('standard_full_name','standard_short_name')->get();
		$string = "";
		foreach($standards as $standard){
			$string .= $standard->standard_full_name.' ('.$standard->standard_short_name.'), ';
		}
		$string = substr($string,0,-2);
		$dataOB = DB::table('evaluations')->where('ID',$evaluation->ID)->select('evaluations.*',DB::raw('CONCAT("'.$string.'") AS standards_involved_names'))->get();
		$dataOB = (array)$dataOB[0];
		array_push($data,$dataOB);
		}
		return datatables()->of($data)->toJson();
	}
	
	   public function getAllPublishedEvaluations($id,Request $request){
		$studentStandard = getStudentStandardID($request->id);
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$evaluations = $data['VIEW']['evaluations'];
		$evaluations = DB::table('evaluations')
		->whereIn('ID',$evaluations)
		->whereRaw($studentStandard.' IN (standards_involved)')
		->where('result_status','PUBLISHED')
		->select('ID','standards_involved')->get();
		$data = array();
		foreach($evaluations as $evaluation){
			$ids = explode(',',$evaluation->standards_involved);
		$standards = DB::table('standards')->whereIn('ID',$ids)->select('standard_full_name','standard_short_name')->get();
		$string = "";
		foreach($standards as $standard){
			$string .= $standard->standard_full_name.' ('.$standard->standard_short_name.'), ';
		}
		$string = substr($string,0,-2);
		$dataOB = DB::table('evaluations')->where('ID',$evaluation->ID)->select('evaluations.*',DB::raw('CONCAT("'.$string.'") AS standards_involved_names'))->get();
		$dataOB = (array)$dataOB[0];
		array_push($data,$dataOB);
		}
		return datatables()->of($data)->toJson();
	}
	
	public function getStudentResultForEvaluation($eval_id,$student_id,Request $request){
		$studentStandard = getStudentStandardID($student_id);
		$evaluationEntities = DB::table('registered_evaluations')->where('evaluation_id',$eval_id)->select('ID')->get();
		$arr = array();
		foreach($evaluationEntities as $one){
			array_push($arr,$one->ID);
		}
		$data = DB::table('marks')
		->join('registered_evaluations','registered_evaluations.ID','=','marks.evaluation_entity_ID')
		->join('subjects','subjects.ID','=','registered_evaluations.subject_id')
		->join('subject_types','subject_types.ID','=','subjects.subject_type_id')
		->where('student_id',$student_id)
		->whereIn('evaluation_entity_ID',$arr)
		->get();
		foreach($data as $one){
			$one->marks_group = unserialize($one->marks_group);
			$one->packedMarks = unserialize($one->packedMarks);
			$one->total_obtained_marks = array_sum($one->marks_group);
			$one->total_maximum_marks = array_sum($one->packedMarks);
			if(count($one->marks_group)>0 AND count($one->marks_group) == count($one->packedMarks)){
				$temp = array();
				$obtained_marks_values = array_values($one->marks_group);
				$count = 0;
				foreach($one->packedMarks as $key => $value){
					$temp[$key] = $obtained_marks_values[$count].'/'.$value;
					$count++;
				}
				$one->marks_structure = $temp;
			}
		}
		return datatables()->of($data)->toJson();
	}
	
	public function getEvaluation(Request $request,$id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$evaluations = $data['VIEW']['evaluations'];
		if(!in_array($request->id,$evaluations)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this evaluations.');
		$evaluation = DB::table('evaluations')->where('ID',$id)->select('ID','standards_involved')->get();
		$ids = explode(',',$evaluation[0]->standards_involved);
		$standards = DB::table('standards')->whereIn('ID',$ids)->select('standard_full_name','standard_short_name')->get();
		$string = "";
		foreach($standards as $standard){
			$string .= $standard->standard_full_name.' ('.$standard->standard_short_name.'), ';
		}
		$string = substr($string,0,-2);
		$dataOB = DB::table('evaluations')->where('ID',$id)->select('evaluations.*',DB::raw('CONCAT("'.$string.'") AS standards_involved_names'))->get();
		return $dataOB = (array)$dataOB[0];
	}
	
	public function deleteEvaluation(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$evaluations = $data['DELETE']['evaluations'];
		
		if(!in_array($request->id,$evaluations)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Evaluation.');
			
		$status = DB::table('evaluations')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_evaluations');
		refreshRelationLogics('EDIT_evaluations');
		refreshRelationLogics('DELETE_evaluations');
		
		if($status) return sendJsonResponse($data=null,200,'Evaluation Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation could not be added.',true,$ex->getMessage());
		}
	}
	
	public function standardsByEvaluation($id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$standards = $data['VIEW']['standards'];
		$evaluation = DB::table('evaluations')->where('ID',$id)->get()[0];
		$ids = explode(',',$evaluation->standards_involved);
		$data = DB::table('standards')->whereIn('ID',$ids)
		->whereIn('ID',$standards)
		->get();
		return sendJsonResponse($data,200,'Standards Fetched Successfully.');
	}
	
	public function subjectsByStandard($id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjects = $data['VIEW']['subjects'];
		$data = DB::table('subjects')->where('standard_id',$id)
		->whereIn('ID',$subjects)
		->get();
		return sendJsonResponse($data,200,'Standards Fetched Successfully.');
	}
	
	public function addNewEvaluation(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$evaluations = $data['ADD']['evaluations'];
		
		if($evaluations != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Evaluation Type.');
		
		$standards_involved = implode(',',(array)$request->standards_involved);
		
		$data = $request->except('standards_involved','token');
		
		$data = (array)$data;

		$data['standards_involved'] = $standards_involved;
		
		$request->validate([
			'full_name' => 'required',
			'short_name' => 'required',
		]);
		
		
		try{
		$status = DB::table('evaluations')->insert($data);
		
		$id = DB::getPdo()->lastInsertId();
		relationLogics('VIEW_evaluations',$id);
		relationLogics('EDIT_evaluations',$id);
		relationLogics('DELETE_evaluations',$id);
		
		return sendJsonResponse($data=null,200,'New Evaluation Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editEvaluation(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$evaluations = $data['EDIT']['evaluations'];
		if(!in_array($request->id,$evaluations)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Employee Type.');
		
		$standards_involved = implode(',',(array)$request->standards_involved);
		
		
		
		$data = $request->except('standards_involved','token');
		
		$data = (array)$data;

		$data['standards_involved'] = $standards_involved;
		
		$request->validate([
			'full_name' => 'required',
			'short_name' => 'required',
		]);
		
		
		try{
		$status = DB::table('evaluations')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Evaluation Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
