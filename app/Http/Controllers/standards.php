<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class standards extends Controller
{
    public function getAllStandards(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$standards = $data['VIEW']['standards'];
		return datatables()->of(DB::table('standards')->join('employees','standards.standard_incharge_id','=','employees.ID')
		->whereIn('standards.ID',$standards)
		->select('standards.*','employees.first_name','employees.last_name')->get())->toJson();
	}
	
	public function getStandardsByFeeType($id,Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$standards = $data['VIEW']['standards'];
		$feeTypeStandards = DB::table('fee_types')->where('ID',$id)->select('fee_standards')->get()[0]->fee_standards;
		return datatables()->of(DB::table('standards')
		->whereIn('standards.ID',$standards)
		->whereIn('standards.ID',explode(",",$feeTypeStandards))
		->get())->toJson();
	}
	
	public function getStandard(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$standards = $data['VIEW']['standards'];
		if(!in_array($request->id,$standards)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this standard.');
		return array(DB::table('standards')->where('ID',$request->id)->first());
	}
	
	public function deleteStandard(Request $request){
		try{
			$data = checkToken(request()->token);
			if($data==401) return show(401);
			if($data==403) return show(403);
			$standards = $data['DELETE']['standards'];
		
		if(!in_array($request->id,$standards)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this standard.');
			
		$status = DB::table('standards')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_standards');
		refreshRelationLogics('EDIT_standards');
		refreshRelationLogics('DEL_standards');
		
		if($status) return sendJsonResponse($data=null,200,'Standard Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Standard could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewStandard(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$standards = $data['ADD']['standards'];
		
		if($standards != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new standard.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'standard_full_name' => 'required',
			'standard_short_name' => 'required',
			'standard_code' => 'required',
		]);
		
		
		try{
		$status = DB::table('standards')->insert(array($data));
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_standards',$id);
		relationLogics('EDIT_standards',$id);
		relationLogics('DEL_standards',$id);
		
		return sendJsonResponse($data=null,200,'New Standard Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Standard could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editStandard(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$standards = $data['EDIT']['standards'];
		if(!in_array($request->id,$standards)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this standard.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'standard_full_name' => 'required',
			'standard_short_name' => 'required',
			'standard_code' => 'required',
		]);
		
		
		try{
		$status = DB::table('standards')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Standard Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Standard could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
