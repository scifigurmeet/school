<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class relations extends Controller{
	
	public function getAllUsers(){
		return DB::table('users')->select('username')->get();
	}
	
	public function getAllTables(){
		$arr = array();
		$data = (array)DB::select('SHOW TABLES');
		foreach($data as $single){
			array_push($arr,$single->Tables_in_school);
		}
		return $arr;
	}
	
	public function saveRights(){
		try{
		$username = request()->username;
		$data = request()->except('token','username');
		
		foreach ($data as $key => $value) {
			if (is_null($value)) {
				 $data[$key] = "";
			}
		}
		
		$relation_id = DB::table('users')->where('username',$username)->select('relation_id')->get()[0]->relation_id;
		if($relation_id == 0 AND !isset(request()->allRights)){
			$this_id = DB::table('relations')->insertGetId($data);
			DB::table('users')->where('username',$username)->update(['relation_id' => $this_id]);
		}
		else if(request()->allRights == true){
			DB::table('relations')->where('ID',$relation_id)->delete();
			DB::table('users')->where('username',$username)->update(['relation_id' => 0]);
		}
		else{
			DB::table('relations')->where('ID',$relation_id)->update($data);
		}
		return sendJsonResponse($data=null,200,'Rights successfully Updated');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Rights could not be updated.',true,$ex->getMessage());
		}
	}
	
	public function getRights(){
		try{
		
		request()->validate([
        'username' => 'required',
		]);
		
		$username = request()->username;
		$relation_id = DB::table('users')->where('username',$username)->select('relation_id')->get()[0]->relation_id;
		if($relation_id == 0){
			$data = ["allRights" => true];
		}
		else{
			return $data = (array) DB::table('relations')->where('ID',$relation_id)->get()[0];
		}
		return sendJsonResponse($data,200,'Rights retreived successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Rights could not be retreived.',true,$ex->getMessage());
		}
	}
	
}
