<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class SubjectTypes extends Controller{
	
    public function getAllSubjectTypes(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjectTypes = $data['VIEW']['subject_types'];
		return datatables()->of(DB::table('subject_types')
		->whereIn('ID',$subjectTypes)
		->get())->toJson();
	}
	
	public function getSubjectType(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjectTypes = $data['VIEW']['subject_types'];
		if(!in_array($request->id,$subjectTypes)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this subject Types.');
		return array(DB::table('subject_types')->where('ID',$request->id)->first());
	}
	
	public function deleteSubjectType(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjectTypes = $data['DELETE']['subject_types'];
		
		if(!in_array($request->id,$subjectTypes)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Subject Type.');
			
		$status = DB::table('subject_types')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_subject_types');
		refreshRelationLogics('EDIT_subject_types');
		refreshRelationLogics('DELETE_subject_types');
		
		if($status) return sendJsonResponse($data=null,200,'Subject Type Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Subject Type could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewSubjectType(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjectTypes = $data['ADD']['subject_types'];
		
		if($subjectTypes != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Subject Type.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'type_full_name' => 'required',
			'type_short_name' => 'required'
		]);
		
		
		//try{
			
		$status = DB::table('subject_types')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_subject_types',$id);
		relationLogics('EDIT_subject_types',$id);
		relationLogics('DELETE_subject_types',$id);
		
		return sendJsonResponse($data=null,200,'New Subject Type Added Successfully.');
		//}
		//catch(Exception $ex){
		//	return sendJsonResponse($data=null,201,'Subject Type could not be added.',true,$ex->getMessage());
		//}
		
	}
	
	public function editSubjectType(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjectTypes = $data['EDIT']['subject_types'];
		if(!in_array($request->id,$subjectTypes)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Subject Type.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'type_full_name' => 'required',
			'type_short_name' => 'required'
		]);
		
		
		try{
		$status = DB::table('subject_types')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Subject Type Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Subject Type could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
