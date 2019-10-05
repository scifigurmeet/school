<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class rooms extends Controller{
	
	public function getAllRooms(Request $request){
		$data = DB::table('rooms')->get();
		foreach($data as $one){
			$one->seating_capacity = $one->no_of_rows * $one->no_of_seats_per_row;
		}
		return datatables()->of($data)->toJson();
	}
	
	public function getRoom($id){
		$one = DB::table('rooms')->where('ID',$id)->get()[0];
		$one->seating_capacity = $one->no_of_rows * $one->no_of_seats_per_row;
		return sendJsonResponse($one,200,'Room Fetched Successfully.');
	}
	
	public function addNewRoom(Request $request){
		$data = $request->except('token');
		try{
			DB::table('rooms')->insert($data);
			return sendJsonResponse(null,200,'New Room Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'New Room Could Not Be Added.',true,$ex->getMessage());
		}
	}
	
	public function editRoom($id,Request $request){
		$data = $request->except('token');
		try{
			DB::table('rooms')->where('ID',$id)->update($data);
			return sendJsonResponse(null,200,'Room Information Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'Room Information Could Not Be Edited.',true,$ex->getMessage());
		}
	}
	
	public function deleteRoom($id){
		try{
			DB::table('rooms')->where('ID',$id)->delete();
			return sendJsonResponse(null,200,'Room Deleted Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'Room Could Not Be Deleted.',true,$ex->getMessage());
		}
	}
	
	public function makePlan(Request $request){
		$standard_ids = $request->standard_ids;
		$room_ids = $request->room_ids;
		$standard_ids = [1,2];
		$room_ids = [3,4];
		$students = DB::table('students')
		->whereIn('standard_id',$standard_ids)
		->orderBy('school_roll_no','ASC')
		->select('standard_id')
		->get();

	
		
		
		
		
	}
	
}
