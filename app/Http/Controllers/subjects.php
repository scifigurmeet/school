<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class subjects extends Controller{
	
    public function getAllSubjects(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjects = $data['VIEW']['subjects'];
		return datatables()->of(DB::table('subjects')->join('subject_types','subject_types.ID','=','subjects.subject_type_id')->join('employees','employees.ID','=','subjects.subject_incharge_id')
		->whereIn('subjects.ID',$subjects)
		->select('subjects.*','subject_types.type_full_name','subject_types.type_short_name','employees.first_name','employees.last_name')->get())->toJson();
	}
	
	public function getSubject(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjects = $data['VIEW']['subjects'];
		if(!in_array($request->id,$subjects)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this subject.');
		return array(DB::table('subjects')->where('ID',$request->id)->first());
	}
	
	public function deleteSubject(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjects = $data['DELETE']['subjects'];
		
		if(!in_array($request->id,$subjects)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this subject.');	
		
		$status = DB::table('subjects')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_subjects');
		refreshRelationLogics('EDIT_subjects');
		refreshRelationLogics('DELETE_subjects');
		
		if($status) return sendJsonResponse($data=null,200,'Subject Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Subject could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewSubject(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjects = $data['ADD']['subjects'];
		
		if($subjects != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new subject.');
		
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'subject_code' => 'required',
			'subject_full_name' => 'required',
			'subject_short_name' => 'required'
		]);
		
		
		try{
		$status = DB::table('subjects')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_subjects',$id);
		relationLogics('EDIT_subjects',$id);
		relationLogics('DELETE_subjects',$id);
		
		
		return sendJsonResponse($data=null,200,'New Subject Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Subject could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editSubject(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$subjects = $data['EDIT']['subjects'];
		if(!in_array($request->id,$subjects)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this subject.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'subject_code' => 'required',
			'subject_full_name' => 'required',
			'subject_short_name' => 'required'
		]);
		
		
		try{
		$status = DB::table('subjects')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Subject Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Subject could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
