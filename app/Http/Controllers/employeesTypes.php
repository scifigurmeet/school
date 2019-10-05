<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class EmployeesTypes extends Controller{
	
    public function getAllEmployeesTypes(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees_types = $data['VIEW']['employees_types'];
		return datatables()->of(DB::table('employees_types')
		->whereIn('ID',$employees_types)
		->get())->toJson();
	}
	
	public function getEmployeesType(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees_types = $data['VIEW']['employees_types'];
		if(!in_array($request->id,$employees_types)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this employee_type.');
		return array(DB::table('employees_types')->where('ID',$request->id)->first());
	}
	
	public function deleteEmployeesType(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees_types = $data['DELETE']['employees_types'];
		
		if(!in_array($request->id,$employees_types)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Employees Type.');
			
		$status = DB::table('employees_types')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_employees_types');
		refreshRelationLogics('EDIT_employees_types');
		refreshRelationLogics('DELETE_employees_types');
		
		if($status) return sendJsonResponse($data=null,200,'Employee Type Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Employee Type could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewEmployeesType(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees_types = $data['ADD']['employees_types'];
		
		if($employees_types != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Employee Type.');
		
		
		$request->validate([
			'type_name' => 'required'
		]);
		
		$data = $request->except('token','_token');
		
		
		try{
		$status = DB::table('employees_types')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		relationLogics('VIEW_employees_types',$id);
		relationLogics('EDIT_employees_types',$id);
		relationLogics('DELETE_employees_types',$id);
		
		return sendJsonResponse($data=null,200,'New Employee Type Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Employee Type could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editEmployeesType(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees_types = $data['EDIT']['employees_types'];
		if(!in_array($request->id,$employees_types)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Employee Type.');
		
		$data = $request->except('token','_token');
		
		
		$request->validate([
			'type_name' => 'required'
		]);
		
		try{
		$status = DB::table('employees_types')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Employee Type Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Employee Type could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
