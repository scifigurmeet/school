<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;
use Illuminate\Validation\Rule;


class EvaluationsManager extends Controller{
	
    public function getAllEvaluationEntities(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$registered_evaluations = $data['VIEW']['registered_evaluations'];
		$data = DB::table('registered_evaluations')
		->join('evaluations','evaluations.ID','=','evaluation_id')
		->join('standards','standards.ID','=','standard_id')
		->join('subjects','subjects.ID','=','subject_id')
		->whereIn('registered_evaluations.ID',$registered_evaluations)
		->select('registered_evaluations.*',DB::raw('CONCAT(standards.standard_full_name," (",standards.standard_short_name,")") AS standard_info'),
		DB::raw('CONCAT(evaluations.full_name," (",evaluations.short_name,")") AS evaluation_info'),
		DB::raw('CONCAT(subjects.subject_code," | ",subjects.subject_full_name," (",subjects.subject_short_name,")") AS subject_info')
		)
		->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getEvaluationEntity(Request $request,$id){
		$data = DB::table('registered_evaluations')->where('ID',$id)->get()[0];
		$data = (array) $data;
		$data['packedMarks'] = unserialize($data['packedMarks']);
		return datatables()->of($data)->toJson();
	}
	
	public function getIdByABC($a,$b,$c){
		$data = DB::table('registered_evaluations')->where('evaluation_id',$a)->where('standard_id',$b)->where('subject_id',$c)->select('ID')->get();
		try{
		return $data[0]->ID;
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation Entity Not Found.',true,$ex->getMessage());
		}
	}
	
	public function deleteEvaluationEntity(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$registered_evaluations = $data['DELETE']['registered_evaluations'];
		
		if(!in_array($request->id,$registered_evaluations)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Evaluation Entity.');
			
		$status = DB::table('registered_evaluations')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_registered_evaluations');
		refreshRelationLogics('EDIT_registered_evaluations');
		refreshRelationLogics('DELETE_registered_evaluations');
		
		if($status) return sendJsonResponse($data=null,200,'Evaluation Entity Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation Entity could not be deleted.',true,$ex->getMessage());
		}
	}
	
	public function addNewEvaluationEntity(Request $request){
		$packedMarks = serialize($request->packedMarks);
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$registered_evaluations = $data['ADD']['registered_evaluations'];
		
		if($registered_evaluations != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Evaluation Entity.');

		$data = $request->except('packedMarks','token');
		
		$data = (array)$data;

		$data['packedMarks'] = $packedMarks;
		
		$request->validate([
			'evaluation_id' => 'required',
			'standard_id' => 'required',
			'subject_id' => 'required',
			'evaluation_method' => 'required',
			'maximum_marks' => 'required'
		]);
		
		
		try{
		$status = DB::table('registered_evaluations')->insert($data);
		return sendJsonResponse($data=null,200,'New Evaluation Entity Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation Entity could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editEvaluationEntity(Request $request){
		$packedMarks = serialize($request->packedMarks);
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$registered_evaluations = $data['EDIT']['registered_evaluations'];
		if(!in_array($request->id,$registered_evaluations)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Evaluation Entity.');
		
		
		$data = $request->except('packedMarks','token');
		
		$data = (array)$data;

		$data['packedMarks'] = $packedMarks;
		
		$request->validate([
			'evaluation_id' => 'required',
			'standard_id' => 'required',
			'subject_id' => 'required',
			'evaluation_method' => 'required',
			'maximum_marks' => 'required'
		]);
		
		
		try{
		$status = DB::table('registered_evaluations')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Evaluation Entity Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Evaluation Entity could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
