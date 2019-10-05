<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Exception;

class globalOptions extends Controller
{
	public function sendResponse($data,$code,$message,$error=false){
		$arr[0] = ['status'=>$code,'message'=>$message,'data'=>$data];
		return response()->json($arr,$code);
	}
	
	public function getAll(){
		return response()->json(DB::table('global_options')->get(),200);
	}
	
	public function getByID($id){
		if(!is_numeric($id)){
			$message = 'ID must be Numeric.';
			$status = 404;
			$error = true;
			$errorMessage = 'ID paramter provided is not numeric.';
			$data = null;
		}
		else{
		$data = DB::table('global_options')->where('ID', $id)->get();
		$message = 'Data Retreived Successfully.';
		$status = 200;
		$error = false;
		$errorMessage = null;
		if(count($data)==0){
			$message = 'No Results Found!';
			$status = 404;
			$error = true;
			$errorMessage = 'No option found with ID '.$id.'.';
		}
		}
		return sendJsonResponse($data,$status,$message,$error,$errorMessage);
	}
	
	public function getByOptionName($option){
		return response()->json(DB::table('global_options')->where('option_name', $option)->get(),200);
	}
	
	public function addNewOption(Request $request){
		$data = json_decode($request->getContent(),true);
		
		$check = DB::table('global_options')->where('option_name',$data['option_name'])->get();
		
		if(count($check)>0) {
			$message = 'Duplicate Option Entry Not Possible.';
			$status = 404;
			$error = true;
			$errorMessage = "The Option '".$data['option_name']."' already exists and can not be duplicated.";
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
			
		if(isset($data['option_name']) AND isset($data['option_value'])){
			$data['ID'] = DB::table('global_options')->insertGetId($data);
			$message = 'Option Added Successfully.';
			$status = 200;
			ksort($data);
			return sendJsonResponse($data,$status,$message);
		}
		else if(!isset($data['option_value']) AND !isset($data['option_name'])){
			$message = 'Missing Required Parameters.';
			$status = 404;
			$error = true;
			$errorMessage = 'Missing Paramters: option_value, option_value.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
			}
		else if(!isset($data['option_name'])){
			$message = 'Missing Required Parameters.';
			$status = 404;
			$error = true;
			$errorMessage = 'Missing Paramter: option_name.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
			}
		else if(!isset($data['option_value'])){
			$message = 'Missing Required Parameters.';
			$status = 404;
			$error = true;
			$errorMessage = 'Missing Paramter: option_value.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
			}
		else {
			$message = 'Unknown Error Occured.';
			$status = 404;
			$error = true;
			$errorMessage = 'Error could not be identified.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
	}
	
	public function updateOption(Request $request){
		$data = json_decode($request->getContent(),true);
		
		$check = DB::table('global_options')->where('option_name',$data['option_name'])->get();
		
		if(!count($check)>0) {
			$message = 'Option Does not exists';
			$status = 404;
			$error = true;
			$errorMessage = "The Option '".$data['option_name']."' does not exists and hence can not be updated.";
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
		
		if(isset($data['option_name']) AND isset($data['option_value'])){
		$option = $data['option_name'];
		$value = $data['option_value'];
		$code = DB::table('global_options')->where('option_name', $option)->update(['option_value' => $value]);
	
		if($code==1) {
		$status = 200;
		$message = 'Option Updated Successfully';
		return sendJsonResponse($data,$status,$message);
		}
		else {
			$message = 'No Changes Required.';
			$status = 404;
			$error = true;
			$errorMessage = 'Updated Data Same as Existing Data';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
		
		}
		else if(!isset($data['option_value']) AND !isset($data['option_name'])){
			$message = 'Missing Required Parameters.';
			$status = 404;
			$error = true;
			$errorMessage = 'Missing Paramters: option_value, option_value.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
			}
		else if(!isset($data['option_name'])){
			$message = 'Missing Required Parameters.';
			$status = 404;
			$error = true;
			$errorMessage = 'Missing Paramter: option_name.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
			}
		else if(!isset($data['option_value'])){
			$message = 'Missing Required Parameters.';
			$status = 404;
			$error = true;
			$errorMessage = 'Missing Paramter: option_value.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
			}
		else {
			$message = 'Unknown Error Occured.';
			$status = 404;
			$error = true;
			$errorMessage = 'Error could not be identified.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
	}
	
	public function deleteOption(Request $request){
		$data = json_decode($request->getContent(),true);
		$option = $data['option_name'];
		$code = DB::table('global_options')->where('option_name', $option)->delete();
		if($code==1) {
			$message = 'Option Deleted Successfully.';
			$status = 200;
			return sendJsonResponse($data=null,$status,$message);
		}
		else if($code==0){
			$message = 'Deletion Not Possible.';
			$status = 404;
			$error = true;
			$errorMessage = 'Requested option to delete does not exisits.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
		else {
			$message = 'Unknown Error Occured.';
			$status = 404;
			$error = true;
			$errorMessage = 'Error could not be identified.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
	}
}
