<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class feeTypes extends Controller{
	
    public function getAllFeeTypes(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_types = $data['VIEW']['fee_types'];
		$feeTypes = DB::table('fee_types')
		->whereIn('ID',$fee_types)
		->get();
		
		$data = array();
		foreach($feeTypes as $feeType){
			$standardIds = explode(',',$feeType->fee_standards);
			$sectionIds = explode(',',$feeType->fee_sections);
		$standards = DB::table('standards')->whereIn('ID',$standardIds)->select('standard_full_name','standard_short_name')->get();
		$sections = DB::table('sections')->whereIn('ID',$sectionIds)->select('section_full_name','section_short_name')->get();
		$string = "";
		foreach($standards as $standard){
			$string .= $standard->standard_full_name.' ('.$standard->standard_short_name.'), ';
		}
		$string2 = "";
		foreach($sections as $section){
			$string2 .= $section->section_full_name.' ('.$section->section_short_name.'), ';
		}
		$string = substr($string,0,-2);
		$string2 = substr($string2,0,-2);
		$dataOB = DB::table('fee_types')->where('ID',$feeType->ID)->select('fee_types.*',DB::raw('CONCAT("'.$string.'") AS standards_involved_names'),DB::raw('CONCAT("'.$string2.'") AS sections_involved_names'))->get();
		$dataOB = (array)$dataOB[0];
		array_push($data,$dataOB);
	}
	return datatables()->of($data)->toJson();
	}
	
	public function getFeeType(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_types = $data['VIEW']['fee_types'];
		if(!in_array($request->id,$fee_types)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this Fee Type');
		return array(DB::table('fee_types')->where('ID',$request->id)->first());
	}
	
	public function deleteFeeType(Request $request){
		try{
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_types = $data['DELETE']['fee_types'];
		
		if(!in_array($request->id,$fee_types)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Fee Type.');	
		
		$status = DB::table('fee_types')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_fee_types');
		refreshRelationLogics('EDIT_fee_types');
		refreshRelationLogics('DELETE_fee_types');
		
		if($status) return sendJsonResponse($data=null,200,'Fee Type Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Type could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewFeeType(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_types = $data['ADD']['fee_types'];
		
		if($fee_types != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Fee Type.');
		
		$request->validate([
			'fee_full_name' => 'required',
			'fee_for' => 'required',
			'fee_description' => 'required'
		]);
		
		$data = $request->except('token');
		
		
		try{
		$status = DB::table('fee_types')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_fee_types',$id);
		relationLogics('EDIT_fee_types',$id);
		relationLogics('DELETE_fee_types',$id);
		
		return sendJsonResponse($data=null,200,'New Fee Type Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Type could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editFeeType(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_types = $data['EDIT']['fee_types'];
		if(!in_array($request->id,$fee_types)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Fee Type.');
		
		$request->validate([
			'fee_full_name' => 'required',
			'fee_for' => 'required',
			'fee_description' => 'required'
		]);
		
		$data = $request->except('token');
		
		try{
		$status = DB::table('fee_types')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Fee Type Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Type could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
