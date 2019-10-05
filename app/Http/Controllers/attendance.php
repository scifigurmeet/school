<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;

class attendance extends Controller{
	
    public function getAttendance($section_id,$date){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$attendance_sections = $data['VIEW']['attendance_sections'];
		if(!in_array($section_id,$attendance_sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this attendance of this section.');
		$date = date('y-m-d',strtotime(request()->date));
		try{
		$data = DB::table('attendance')->where('section_id',$section_id)->where('date',$date)->get();
		if(count($data)==0) {
			throw new Exception("No Attendance Exists for this section at provided date.");
		}
		return sendJsonResponse($data,200,"Attendance Fetched Successfully.");
		}
		catch(Exception $ex){
		return sendJsonResponse($data,201,"Attendance Could Not Be Fetched.",true,$ex->getMessage());
		}
	}
	
	public function getAttendanceForStudent($id){
		$student_id = $id;
		$data = DB::table('attendance')->where('student_id',$student_id)->get();
		return datatables()->of($data)->toJson();
	}
	
	public function markAttandance($givenID){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$attendance_sections = (array) $data['ADD']['attendance_sections'];
		if(!in_array($givenID,$attendance_sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to mark the attendance for this section.');
		
		$presentIds = explode(",",request()->presentIds);
		$date = date('y-m-d',strtotime(request()->date));
		$section_id = $givenID;
		
		if(isset(request()->delete)){
			$data = checkToken(request()->token);
				if($data==401) return show(401);
				if($data==403) return show(403);
				$attendance_sections = (array) $data['DELETE']['attendance_sections'];
				if(!in_array($givenID,$attendance_sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete attendance for this section.');
				DB::table('attendance')->where('section_id',$section_id)->where('date',$date)->delete();
				return sendJsonResponse($data=null,200,'Attendance for this section on provided date has been deleted.');
		}
		
		$count = 0;
		foreach($presentIds as $one){
			
			$presentIds[$count] = (int) $one;
			$count++;
		}
		$presentIds = array_diff($presentIds,[0]);

		$data = DB::table('students')->join('standards','standards.ID','=','students.standard_id')->join('sections','sections.ID','=','students.section_id')->where('students.section_id',$givenID)->select('students.*',DB::raw('CONCAT(student_first_name," ",student_last_name) AS student_full_name'),DB::raw('CONCAT(standards.standard_full_name," (",sections.section_full_name,")") AS standard_section_full_name'),DB::raw('CONCAT(students.father_name," / ",students.mother_name," / ",students.guardian_full_name) AS parents_guardian_names'))->get();
		
		$allIds = array();
		
		foreach($data as $one){
			array_push($allIds,$one->ID);
		}
		
		$absentIds = array_values(array_diff($allIds,$presentIds));
		
		$all = array();

		foreach($presentIds as $a){
		$status = 'PRESENT';
		$one = ['date' => $date, 'student_id' => $a, 'section_id' => $section_id, 'status' => $status];
		array_push($all,$one);
		}
		
		foreach($absentIds as $a){
		$status = 'ABSENT';
		$one = ['date' => $date, 'student_id' => $a, 'section_id' => $section_id, 'status' => $status];
		array_push($all,$one);
		}
		
		try{
			try{
			$status = DB::table('attendance')->insert($all);
			if($status) return sendJsonResponse($data=null,200,'Attendance Marked Successfully');
			else throw new exception('Invalid ID Error');
			}
			catch(Exception $exy){
				
				$data = checkToken(request()->token);
				if($data==401) return show(401);
				if($data==403) return show(403);
				$attendance_sections = (array) $data['EDIT']['attendance_sections'];
				if(!in_array($givenID,$attendance_sections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to update attendance for this section.');
				
				
				$str = 'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry';
				if (strpos($exy->getMessage(), $str) !== false) $logic = true;
				if($logic){
					DB::table('attendance')->where('section_id',$section_id)->where('date',$date)->delete();
					DB::table('attendance')->insert($all);
				}
				return sendJsonResponse($data=null,200,'Attendance has been updated.');
			}
		}
		catch(Exception $ex){
			//if($ex->getCode()==23000) return sendJsonResponse($data=null,201,'Attendance could not be Marked.',true,'Same Attendance has already been marked.');
			return sendJsonResponse($data=null,201,'Attendance could not be Marked.',true,$ex->getMessage());
		}
	}
	
}	