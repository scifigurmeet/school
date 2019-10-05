<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;

class fillMarks extends Controller{
	
    public function addNewMarks($evaluation_entity_id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$marksheet_entities = $data['ADD']['marksheet_entities'];
		if(in_array($evaluation_entity_id,$marksheet_entities)) $ADD_Permission = true;
		else $ADD_Permission = false;
		//$data = DB::table('marks')->where('evaluation_entity_ID',$evaluation_entity_id)->get();
		$data = DB::table('registered_evaluations')->where('ID',$evaluation_entity_id)->select('evaluation_method')->get();
		$evaluation_method = $data[0]->evaluation_method;
		$data = request()->request;
		//Evaluation Method 1
		if($evaluation_method==1){
			foreach($data as $key => $value){
				$studentID = explode("T",$key)[1];
				$totalMarks = $value;
				$arr['student_id'] = $studentID;
				$arr['evaluation_entity_id'] = $evaluation_entity_id;
				$arr['obtained_marks'] = $totalMarks;
				$arr['marks_group'] = 0;
				try{
				if($ADD_Permission == false) throw new exception("You do not have the permission to add Marksheet for requested Fee Entity.");
				$check = DB::table('marks')->insert($arr);
				}
				catch(Exception $ex){
					try{
					$data = checkToken(request()->token);
					if($data==401) return show(401);
					if($data==403) return show(403);
					
					$marksheet_entities = $data['EDIT']['marksheet_entities'];
					$this_marksheet_entities = $this->getMarksheetEntitiesIDByEvaluationEntityID($evaluation_entity_id);
					
					if(!(array_intersect($this_marksheet_entities, $marksheet_entities) == $this_marksheet_entities)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to edit or add marksheet for requested Evaluation Entity.');
					DB::table('marks')->where('student_id',$studentID)->where('evaluation_entity_id',$evaluation_entity_id)->update($arr);
					}
					catch(Exception $po){
						return sendJsonResponse($data=null,201,'Marks could not be inserted.',true,$po->getMessage());
					}
				}
			}
			return sendJsonResponse($data=null,201,'Marks Successfully Inserted or Updated.');
		}
		//Evaluation Method 2
		if($evaluation_method==2){
		$bigArr = array();
		$previousStudentID = 0;
		$rightPart = array();
		foreach($data as $key => $value){
			if (strpos($key, 'S') === 0) {
				$arr = explode('S',$key,2);
				$arr = explode('Q',$arr[1],2);
				$arr[2] = $value;
				$studentID = $arr[0];
				$questionID = $arr[1];
				$questionMarks[$questionID] = $arr[2];
				if($studentID == $previousStudentID OR $previousStudentID == 0){
					array_push($rightPart,$questionMarks);
					$bigArr[$studentID] = end($rightPart);
					$previousStudentID = $studentID;
				}
				else {
					array_push($rightPart,$questionMarks);
					$bigArr[$studentID] = end($rightPart);
					$previousStudentID = 0;
					$rightPart = array();
				}
			}
		}
		foreach($bigArr as $key => $value){
			$arr = [];
			$arr['student_id'] = $key;
			$arr['evaluation_entity_ID'] = $evaluation_entity_id;
			$arr['obtained_marks'] = array_sum($value);
			$arr['marks_group'] = serialize($value);
			try{
				if($ADD_Permission == false) throw new exception("You do not have the permission to add Marksheet for requested Evaluation Entity.");
				$check = DB::table('marks')->insert($arr);
			}
			catch(Exception $ex){
				try{
				$data = checkToken(request()->token);
					if($data==401) return show(401);
					if($data==403) return show(403);
					
					$marksheet_entities = $data['EDIT']['marksheet_entities'];
					$this_marksheet_entities = $this->getMarksheetEntitiesIDByEvaluationEntityID($evaluation_entity_id);
					if(!(array_intersect($this_marksheet_entities, $marksheet_entities) == $this_marksheet_entities)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to edit or add marksheet for requested Evaluation Entity.');
					$status = DB::table('marks')->where('student_id',$key)->where('evaluation_entity_id',$evaluation_entity_id)->update($arr);
				}
				catch(Exception $po){
					return sendJsonResponse($data=null,201,'Marks could not be inserted.',true,$po->getMessage());
				}
			}
		}
		}
		return sendJsonResponse($data=null,200,'Marks successfully Inserted or Updated.');
	}
	
	public function getMarks($id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$marksheet_entities = $data['VIEW']['marksheet_entities'];
		$this_marksheet_entities = $this->getMarksheetEntitiesIDByEvaluationEntityID($id);
		if(!(array_intersect($this_marksheet_entities, $marksheet_entities) == $this_marksheet_entities)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view marksheet(s) for requested Evaluation Entity.');
		try{
		$data = DB::table('registered_evaluations')->where('ID',$id)->select('evaluation_method')->get();
		$evaluation_method = $data[0]->evaluation_method;
		$data = DB::table('marks')->where('evaluation_entity_ID',$id)->get();
		if(count($data)==0) throw new exception('Marks were never stored for this entity.');
		$major = array();
		//Evaluation Method 1
		if($evaluation_method==1){
			foreach($data as $key => $value){
				$studentID = $value->student_id;
				$arr['T'.$studentID] = $value->obtained_marks;
				$major = array_merge($major,$arr);
			}
		}
		//Evaluation Method 2
		if($evaluation_method==2){
		foreach($data as $one){
			$studentID = $one->student_id;
			$one->marks_group = unserialize($one->marks_group);
			foreach($one->marks_group as $key => $value){
				$one->marks_group['S'.$studentID.'Q'.$key] = $value;
				unset($one->marks_group[$key]);
			}
			unset($one->student_id);
			unset($one->evaluation_entity_ID);
			unset($one->obtained_marks);
			$major = array_merge($major,$one->marks_group);
		}
		}
		return $major;
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Marks not found.',true,$ex->getMessage());
		}
	}
	
	public function getMarksheetEntitiesIDByEvaluationEntityID($id){
		$data = DB::table('registered_evaluations')->where('ID',$id)->select('ID')->get();
		$arr = array();
		foreach($data as $one){
			array_push($arr,$one->ID);
		}
		return $arr;
	}
	
}	