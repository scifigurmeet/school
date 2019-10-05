<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use DB;

use Exception;

class authLogin extends Controller
{
	public function setSessionToken(Request $request){
		$username = $request->username;
		$token = $request->token;
		if(isset($username) AND isset($token))
		return $this->login($username,$token,$request);
		else {
			return $this->checkIfLogin($request);
		}
	}
	
	public function login($username,$token,$request){
		$query = "SELECT * FROM sessions WHERE username = '".$username."' AND token = '".$token."'";
		$result = DB::select($query);

		if(count($result)==1) $login = true;
		else $login = false;
		
		if($login) {
			$request->session()->put('username', $username);
			$request->session()->put('token', $token);
			return view('home/index');
		}
		else {			
			$request->session()->forget('username');
			$request->session()->forget('token');
			return Redirect::to('login?invalidToken');
		}
	}
	
	
	public function logout(Request $request){
		$request->session()->forget('username');
		$request->session()->forget('token');
		return Redirect::to(url('/login?loggedOut'));
	}

}
