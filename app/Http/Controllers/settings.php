<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class settings extends Controller{
	
    public function changePassword(Request $request){
		$token = $request->token;
		$old_password = $request->old_pass;
		$new_password_1 = $request->new_pass1;
		$new_password_2 = $request->new_pass2;
		$old_pass_MD5 = DB::table('users')->where('token',$token)->select('password')->get()[0]->password;
		if(md5($old_password) != $old_pass_MD5) return sendJsonResponse(null,201,'Could Not Change Password.',true,'Provided Current Password does not matches with the actual current password.');
		if($new_password_1==$new_password_2){
			if(strlen($new_password_1)<5) return sendJsonResponse(null,201,'Could not change password.',true,'Password Length should be atleast 5 characters.');
			$data['password'] = md5($new_password_1);
			DB::table('users')->where('token',$token)->update($data);
			return sendJsonResponse(null,200,'Password Changed Successfully.');
		}
		else return sendJsonResponse(null,201,'Could not change password.',true,'Passwords do not match.');
	}
	
	public function changeBackgroundImage(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['change_background'];
		$type = getUserType();
		if($permission != 'allowed' AND $type !='student') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to change the background of Web Interface.');
		if(isset($_FILES["file"]["type"])){
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
		) && ($_FILES["file"]["size"] < 10000000)//Approx. 10 MB files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}
		else
		{
		if (file_exists("images/background/" . $_FILES["file"]["name"])) {
		array_map('unlink', array_filter((array) glob("images/background/*")));
		return sendJsonResponse(null,201,'Could Not Change Image.',true,'This Image Already Exists.');
		}
		else
		{
		$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
		$targetPath = "images/background/".$_FILES['file']['name']; // Target path where file is to be stored
		array_map('unlink', array_filter((array) glob("images/background/*")));
		move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
		$data['url'] = getBackgroundImageURL();
		return sendJsonResponse($data,200,'Image uploaded and Changed Successfully.');
		}
		}
		}
		else
		{
		return sendJsonResponse(null,201,'Could Not Change Image.',true,'The Image Type is Invalid. Only JPEG, JPG and PNG file types are allowed.');
		}
		}
	}
	
	public function saveSchoolInfo(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['school_information'];
		$type = getUserType();
		if($permission != 'allowed' AND $type !='student') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to modify School Information.');
		$data = $request->except('token');
		foreach($data as $key => $value){
			$one['option_name'] = $key;
			$one['option_value'] = $value;
		try{
		DB::table('global_options')->insert($one);
		}
		catch(Exception $ex){
			try{
				DB::table('global_options')->where('option_name',$key)->update($one);
			}
			catch(Exception $px){
				return sendJsonResponse(null,201,'Could Not Update School Information',true,$px->getMessage());
			}
		}
		}
		return sendJsonResponse(null,200,'School Information Saved Successfully.');
	}
	
	public function getSchoolInfo(Request $request){
		$data = DB::table('global_options')->get();
		return sendJsonResponse($data,200,'School Information Fetched Successfully.');
	}
	
}
