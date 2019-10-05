<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class Employees extends Controller{
	
    public function getAllEmployees(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees = $data['VIEW']['employees'];
		return datatables()->of(DB::table('employees')->join('employees_types', 'employees.type', '=', 'employees_types.ID')
		->whereIn('employees.ID',$employees)
		->select('employees.*','employees_types.type_name',DB::raw('CONCAT(employees.first_name," ",employees.last_name) AS employee_full_name'))->get())->toJson();
	}
	
	public function getEmployee(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees = $data['VIEW']['employees'];
		if(!in_array($request->id,$employees)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this employee.');
		return array(DB::table('employees')->where('ID',$request->id)->first());
	}
	
	public function deleteEmployee(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees = $data['DELETE']['employees'];
		
		if(!in_array($request->id,$employees)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this employee.');	
			
		$status = DB::table('employees')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_employees');
		refreshRelationLogics('EDIT_employees');
		refreshRelationLogics('DELETE_employees');
		
		if($status) return sendJsonResponse($data=null,200,'Employee Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Employee could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewEmployee(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees = $data['ADD']['employees'];
		
		if($employees != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new employee.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'mobile_no' => 'required|numeric',
			'type' => 'required',
			'dob' => 'required'
		]);
		
		
		try{
		$status = DB::table('employees')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_employees',$id);
		relationLogics('EDIT_employees',$id);
		relationLogics('DELETE_employees',$id);
		
		return sendJsonResponse($data=null,200,'New Employee Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Employee could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editEmployee(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$employees = $data['EDIT']['employees'];
		if(!in_array($request->id,$employees)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this section.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'mobile_no' => 'required|numeric',
			'type' => 'required',
			'dob' => 'required'
		]);
		
		
		try{
		$status = DB::table('employees')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Employee Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Employee could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
