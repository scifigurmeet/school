<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class Sections extends Controller{
	
    public function getAllSections(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['VIEW']['sections'];
		return datatables()->of(DB::table('sections')->join('standards', 'sections.standard_ID', '=', 'standards.ID')->join('employees', 'employees.ID', '=', 'section_incharge_id')
		->whereIn('sections.ID',$sections)
		->select('sections.*', 'standards.standard_full_name', 'standards.standard_short_name','standards.standard_code','employees.first_name','employees.last_name')->get())->toJson();
	}
	
	public function getSectionsByFeeType($id,Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['VIEW']['sections'];
		$feeTypeSections = DB::table('fee_types')->where('ID',$id)->select('fee_sections')->get()[0]->fee_sections;
		return datatables()->of(DB::table('sections')
		->whereIn('sections.ID',$sections)
		->whereIn('sections.ID',explode(",",$feeTypeSections))
		->get())->toJson();
	}
	
	public function getAttendanceSections(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$attendance_sections = $data['VIEW']['attendance_sections'];
		return datatables()->of(DB::table('sections')->join('standards', 'sections.standard_ID', '=', 'standards.ID')->join('employees', 'employees.ID', '=', 'section_incharge_id')
		->whereIn('sections.ID',$attendance_sections)
		->select('sections.*', 'standards.standard_full_name', 'standards.standard_short_name','standards.standard_code','employees.first_name','employees.last_name')->get())->toJson();
	}
	
	public function getAllSectionsByStandard(Request $request,$thisID){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['VIEW']['sections'];
		return datatables()->of(DB::table('sections')->where('standard_ID',$thisID)
		->whereIn('sections.ID',$sections)
		->get())->toJson();
	}
	
	public function getSection(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['VIEW']['sections'];
		if(!in_array($request->id,$sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this section.');
		return array(DB::table('sections')->where('ID',$request->id)->first());
	}
	
	public function deleteSection(Request $request){
		try{
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['DELETE']['sections'];
		
		if(!in_array($request->id,$sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this section.');
		
		$status = DB::table('sections')->where('ID',$request->id)->delete();
		refreshRelationLogics('VIEW_sections');
		refreshRelationLogics('EDIT_sections');
		refreshRelationLogics('DELETE_sections');
		if($status) return sendJsonResponse($data=null,200,'Section Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Section could not be deleted.',true,$ex->getMessage());
		}
	}
	
	public function addNewSection(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['ADD']['sections'];
		
		if($sections != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new section.');
		
		
		$data = $request->except('token','_token');
		
		$request->validate([
			'standard_ID' => 'required',
			'section_full_name' => 'required',
			'section_short_name' => 'required',
			'section_code' => 'required',
			'section_incharge_id' => 'required'
		]);
		
		
		try{
		DB::table('sections')->insert(array($data));
		$id = DB::getPdo()->lastInsertId();
		relationLogics('VIEW_sections',$id);
		relationLogics('EDIT_sections',$id);
		relationLogics('DELETE_sections',$id);
		
		return sendJsonResponse($data=null,200,'New Section Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Section could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editSection(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$sections = $data['EDIT']['sections'];
		if(!in_array($request->id,$sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this section.');
		
		$data = $request->except('token','_token');
		
		$request->validate([
			'standard_ID' => 'required',
			'section_full_name' => 'required',
			'section_short_name' => 'required',
			'section_code' => 'required',
			'section_incharge_id' => 'required'
		]);
		
		
		try{
		$status = DB::table('sections')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Section Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Section could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
