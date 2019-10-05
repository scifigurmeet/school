<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class admission extends Controller
{
    public function addNewAdmission(Request $request){
		$data = $request->toArray();
		return DB::table('students')->insertGetId($data);
	}
}
