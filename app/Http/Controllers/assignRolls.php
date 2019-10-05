<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;

class assignRolls extends Controller{
	
    public function autoWholeSchoolOnly(){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['roll_numbers_assignment'];
		if($permission != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to assign Roll Numbers of any kind.');
		$data = DB::table('students')
		->orderBy('standard_id','asc')
		->orderBy('section_id','asc')
		->orderBy('student_first_name','asc')
		->orderBy('student_last_name','asc')
		->orderBy('father_name','asc')
		->select('ID')->get();
		$school_roll_no = 1;
		foreach($data as $one){
			DB::table('students')->where('ID',$one->ID)->update(['school_roll_no' => $school_roll_no]);
			$school_roll_no++;
		}
		return sendJsonResponse($data=null,200,'School Roll Numbers Automatically Assigned to All Eligible Students in the Ascending Order of Standards, Sections, Student First Name, Student Last Name and Father Name Respectively.');
	}
	
	public function autoSection(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['roll_numbers_assignment'];
		if($permission != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to assign Roll Numbers of any kind.');
		$data = DB::table('students')
		->where('section_id',$request->section_id)
		->orderBy('student_first_name','asc')
		->orderBy('student_last_name','asc')
		->orderBy('father_name','asc')
		->select('ID')->get();
		$section_roll_no = 1;
		foreach($data as $one){
			DB::table('students')->where('ID',$one->ID)->update(['section_roll_no' => $section_roll_no]);
			$section_roll_no++;
		}
		return sendJsonResponse($data=null,200,'Section Roll Numbers Automatically Assigned to All Eligible Students of selected Section in the Ascending Order of Standards, Sections, Student First Name, Student Last Name and Father Name Respectively.');
	}
	
	public function autoSchoolSection(){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['roll_numbers_assignment'];
		if($permission != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to assign Roll Numbers of any kind.');
		$this->autoWholeSchoolOnly();
		$section_ids = DB::table('students')->select('section_id')->get();
		foreach($section_ids as $section_id){
			$data = DB::table('students')
			->where('section_id',$section_id->section_id)
			->orderBy('student_first_name','asc')
			->orderBy('student_last_name','asc')
			->orderBy('father_name','asc')
			->select('ID')->get();
			$section_roll_no = 1;
			foreach($data as $one){
				DB::table('students')->where('ID',$one->ID)->update(['section_roll_no' => $section_roll_no]);
				$section_roll_no++;
			}
		}
		return sendJsonResponse($data=null,200,'Section Roll Numbers and School Roll Numbers automatically assigned to Whole School Students.');
		
	}
	
	public function manualSection(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['roll_numbers_assignment'];
		if($permission != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to assign Roll Numbers of any kind.');
		$student_id = $request->student_id;
		$section_id = getStudentSectionID($student_id);
		$section_roll_no = $request->section_roll_no;
		$checkSectionRoll = DB::table('students')->where('ID',$student_id)->select('section_roll_no')->get()[0]->section_roll_no;
		$count = DB::table('students')
		->where('section_id',$section_id)
		->where('section_roll_no',$section_roll_no)
		->count();
		if($count!=0 AND $checkSectionRoll != $section_roll_no) return sendJsonResponse(null,201,'Can not assign provided section roll number',true,'Section Roll Number Already Assigned to some other student.');
		DB::table('students')->where('ID',$student_id)->update(['section_roll_no' => $section_roll_no]);
		return sendJsonResponse($data=null,200,'Provided Section Roll Number has assigned successfully to requested Student.');
	}
	
	public function manualSchool(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['roll_numbers_assignment'];
		if($permission != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to assign Roll Numbers of any kind.');
		$student_id = $request->student_id;
		$section_id = getStudentSectionID($student_id);
		$school_roll_no = $request->school_roll_no;
		$checkSchoolRoll = DB::table('students')->where('ID',$student_id)->select('school_roll_no')->get()[0]->school_roll_no;
		$count = DB::table('students')
		->where('school_roll_no',$school_roll_no)
		->count();
		if($count!=0 AND $checkSchoolRoll != $school_roll_no) return sendJsonResponse(null,201,'Can not assign provided school roll number',true,'School Roll Number Already Assigned to some other student.');
		DB::table('students')->where('ID',$student_id)->update(['school_roll_no' => $school_roll_no]);
		return sendJsonResponse($data=null,200,'Provided School Roll Number has assigned successfully to requested Student.');
	}
	
	public function manualBoth(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['roll_numbers_assignment'];
		if($permission != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to assign Roll Numbers of any kind.');
		$student_id = $request->student_id;
		$section_id = getStudentSectionID($student_id);
		$school_roll_no = $request->school_roll_no;
		$section_roll_no = $request->section_roll_no;
		$checkSchoolRoll = DB::table('students')->where('ID',$student_id)->select('school_roll_no')->get()[0]->school_roll_no;
		$checkSectionRoll = DB::table('students')->where('ID',$student_id)->select('section_roll_no')->get()[0]->section_roll_no;
		$count = DB::table('students')
		->where('section_id',$section_id)
		->where('school_roll_no',$school_roll_no)
		->count();
		if($count!=0 AND $checkSchoolRoll != $school_roll_no) return sendJsonResponse(null,201,'Can not assign provided school roll number',true,'School Roll Number Already Assigned to some other student.');
		$count = DB::table('students')
		->where('section_roll_no',$section_roll_no)
		->count();
		if($count!=0 AND $checkSectionRoll != $section_roll_no) return sendJsonResponse(null,201,'Can not assign provided section roll number',true,'School Roll Number Already Assigned to some other student.');
		DB::table('students')->where('ID',$student_id)->update(['school_roll_no' => $school_roll_no, 'section_roll_no' => $section_roll_no]);
		return sendJsonResponse($data=null,200,'Provided School Roll Number and Section Roll Number has assigned successfully to requested Student.');
	}
	
}	