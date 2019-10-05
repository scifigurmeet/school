<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class students extends Controller{
	
    public function getAllStudents(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$students = $data['VIEW']['students'];
		return datatables()->of(DB::table('students')
		->join('standards','standards.ID','=','students.standard_id')
		->join('sections','sections.ID','=','students.section_id')
		->whereIn('students.ID',$students)
		->select('students.*',DB::raw('CONCAT(student_first_name," ",student_last_name) AS student_full_name'),DB::raw('CONCAT(standards.standard_full_name," (",sections.section_full_name,")") AS standard_section_full_name'),DB::raw('CONCAT(students.father_name," / ",students.mother_name," / ",students.guardian_full_name) AS parents_guardian_names'))->get())->toJson();
	}
	
	public static function getStudentsBySection($givenID){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$students = $data['VIEW']['students'];
		return datatables()->of(DB::table('students')
		->join('standards','standards.ID','=','students.standard_id')
		->join('sections','sections.ID','=','students.section_id')
		->where('students.section_id',$givenID)
		->whereIn('students.ID',$students)
		->select('students.*',DB::raw('CONCAT(student_first_name," ",student_last_name) AS student_full_name'),DB::raw('CONCAT(standards.standard_full_name," (",sections.section_full_name,")") AS standard_section_full_name'),DB::raw('CONCAT(students.father_name," / ",students.mother_name," / ",students.guardian_full_name) AS parents_guardian_names'))->get())->toJson();
	}
	
	public function getStudentsStats(){
		$data['all_students_count'] = DB::table('students')->count();
		$data['students_with_school_roll_no'] = DB::table('students')->where('school_roll_no','!=',NULL)->count();
		$data['students_with_section_roll_no'] = DB::table('students')->where('section_roll_no','!=',NULL)->count();
		return sendJsonResponse($data,200,'Student Stats Successfully.');
	}
	
	public function getStudent($id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$students = $data['VIEW']['students'];
		if(!in_array($id,$students)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this student.');
		$data = DB::table('students')->where('ID',$id)->get()[0];
		return sendJsonResponse($data,200,'Data Fetched Successfully');
	}
	
	public function deleteStudent(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$students = $data['DELETE']['students'];
		
		if(!in_array($request->id,$students)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this student.');	
		try{
		$status = DB::table('students')->where('ID',$request->id)->delete();
		refreshRelationLogics('VIEW_students');
		refreshRelationLogics('EDIT_students');
		refreshRelationLogics('DELETE_students');
		if($status) return sendJsonResponse($data=null,200,'Student Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Student could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewStudent(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$students = $data['ADD']['students'];
		if($students != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new student.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'admission_no' => 'required',
			'student_first_name' => 'required',
			'standard_id' => 'required',
			'section_id' => 'required'
		]);
		
		
		try{
		$status = DB::table('students')->insert(array($data));
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_students',$id);
		relationLogics('EDIT_students',$id);
		relationLogics('DELETE_students',$id);
		return sendJsonResponse($data=null,200,'New Student Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Student could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editStudent(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$students = $data['EDIT']['students'];
		if(!in_array($request->id,$students)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this student.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'admission_no' => 'required',
			'student_first_name' => 'required',
			'standard_id' => 'required',
			'section_id' => 'required'
		]);
		
		
		try{
		$status = DB::table('students')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Student Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Student could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
