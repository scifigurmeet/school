<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class userAccounts extends Controller{
	public function getAllUserAccounts(){
		$type = getUserType();
		if($type!='master') return sendJsonResponse(null,201,'Permission Denied.',true,'Only Master User Can View User Accounts.');
		$data = DB::table('users')
		->select('ID','username',DB::raw('UCASE(userType) as userType'),'type_ID')
		->where('userType','!=','master')
		->get();
		foreach($data as $one){
			if($one->userType=='STUDENT'){
				$single = DB::table('students')->where('ID',$one->type_ID)->select('student_first_name','student_last_name')->get()[0];
				$one->full_name = $single->student_first_name.' '.$single->student_last_name;
			}
			if($one->userType=='EMPLOYEE'){
				$one->type = 'Employee';
				$single = DB::table('employees')->where('ID',$one->type_ID)->select('first_name','last_name')->get()[0];
				$one->full_name = $single->first_name.' '.$single->last_name;
			}
		}
		return datatables()->of($data)->toJson();
	}
	
	public function createUserAccount(Request $request){
		$type = getUserType();
		if($type!='master') return sendJsonResponse(null,201,'Permission Denied.',true,'Only Master User Can Create User Accounts.');
		$data['username'] = $request->username;
		$data['password'] = md5($request->password);
		$data['userType'] = $request->userType;
		$data['type_ID'] = $request->userTypeID;
		$data['token'] = uniqid();
		try{
			DB::table('users')->insert($data);
			return sendJsonResponse(null,200,'User Account Created Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'User Account Could Not Be Created',true,$ex->getMessage());
		}
	}
	
	public function changePassword($id,Request $request){
		$type = getUserType();
		if($type!='master') return sendJsonResponse(null,201,'Permission Denied.',true,'Only Master User Can Change User Account Passwords.');
		$data['password'] = md5($request->password);
		try{
			DB::table('users')->where('ID',$id)->update($data);
			return sendJsonResponse(null,200,'Password Changed Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'Password Could Not Be Changed.',true,$ex->getMessage());
		}
	}
	
	public function deleteUserAccount($id){
		$type = getUserType();
		if($type!='master') return sendJsonResponse(null,201,'Permission Denied.',true,'Only Master User Can Delete User Accounts.');
		try{
			DB::table('users')->where('ID',$id)->delete();
			return sendJsonResponse(null,200,'User Account Deleted Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'User Account Could Not Be Deleted.',true,$ex->getMessage());
		}
	}
	
}
