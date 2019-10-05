<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;

class login extends Controller
{
    public function checkLogin(Request $request){
		$username = $request->username;
		$password = $request->password;
		$result = DB::table('users')->where([['username',$username],['password',md5($password)]])->get();
		
		if(count($result)==1) $login = true;
		else $login = false;
		
		if($login){
			$data['username'] = $username;
			$data['token'] = str_random(100);
			DB::table('sessions')->where('username',$username)->delete();
			DB::table('sessions')->insert($data);
			DB::table('users')->where('username',$username)->update(['token' => str_random(100)]);
			$status = 200;
			$message = 'Login Successfull';
			return sendJsonResponse($data,$status,$message);
		}
		else {
			$status = 201;
			$message = 'Login Failed';
			$error = true;
			$errorMessage = 'Wrong Username or Password.';
			return sendJsonResponse($data=null,$status,$message,$error,$errorMessage);
		}
		
	}

}
