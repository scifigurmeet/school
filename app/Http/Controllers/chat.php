<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class chat extends Controller{
	
    public function getAllMessages(Request $request){
		$userID = checkToken($request->token)['userID'];
		$data = DB::table('chats')->where('user_ID',$userID)->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getAllReceivedMessages(Request $request){
		$type = getUserType();
		$typeID = getUserTypeID();
		
		if($type=='student'){
			$studentSectionID = getStudentSectionID();
			$studentStandardID = getStudentStandardID();
		}
		
		if($type=='student')
		$data = DB::table('chats')
		->orWhereRaw($typeID.' IN (students_ids)')
		->orWhereRaw($studentSectionID.' IN (section_ids)')
		->orWhereRaw($studentStandardID.' IN (standard_ids)')
		->orWhere('send_to','all')
		->orderBy('dateTime','DESC')
		->get();
		
		if($type=='developer' OR $type=='master') $data = DB::table('chats')->orderBy('dateTime','DESC')->get();
		
		if($type=='employee') $data = DB::table('chats')->whereRaw($typeID.' IN (employee_ids)')->orWhere('send_to','allEmployees')->orderBy('dateTime','DESC')->get();
		
		foreach($data as $one){
			$one->full_name = getUserFullName($one->user_ID);
		}
		
		return datatables()->of($data)->toJson();
		
	}
	
	public function getMessage($id){
		$data = DB::table('chats')->where('ID',$id)->get()[0];
		try{
		$dataO = array();
		$dataO['user_ID'] = getUserAccountID();
		$dataO['message_ID'] = $id;
		DB::table('read_messages')->insert($dataO);
		}
		catch(Exception $ex){}
		return sendJsonResponse($data,200,'Message Fetched Successfully.');
	}
	
	
	public function deleteDraft(Request $request){
		try{
		$status = DB::table('chats')->where('ID',$request->id)->select('status')->get()[0]->status;
		if($status=='Sent') return sendJsonResponse($data=null,201,'Could Not Delete this Message.',true,'Sent Messages could not be deleted.');
		$status = DB::table('chats')->where('ID',$request->id)->delete();
		if($status) return sendJsonResponse($data=null,200,'Message Deleted Successfully.');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Message could not be deleted.',true,$ex->getMessage());
		}
	}
	
	public function saveDraft(Request $request){
		
		if(is_numeric($request->id)){
		try{
		$check = DB::table('chats')->where('ID',$request->id)->select('status')->get()[0]->status;
		if($check == 'Sent') return sendJsonResponse($data=null,201,'This Message could not be edited.',true,'It has already been sent. Copy it to a new draft if you want to send it again.');
		}
		catch(Exception $ex){
			
		}
		}
		
		
		$data = array();
		$data['content'] = $request->content;
		$data['status'] = 'Draft';
		$data['user_ID'] = checkToken($request->token)['userID'];
		
		try{
			if($request->id == 'newDraft'){
				$id = DB::table('chats')->insertGetId($data);
				$data['draft_ID'] = $id;
				$data['last_saved'] = date('h:i:s A d M Y');
				return sendJsonResponse($data,200,'New Draft Saved Successfully.');
			}
			else{
				DB::table('chats')->where('ID',$request->id)->update($data);
				$data['draft_ID'] = $request->id;
				$data['last_saved'] = date('h:i:s A d M Y');
				return sendJsonResponse($data,200,'Draft Updated Successfully.');
			}
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Draft could not be saved.',true,$ex->getMessage());
		}
		
	}
	
	public function sendMessage(Request $request){
		
		$request->validate([
			'content' => 'required',
		]);
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$allStudents = $data['VIEW']['students'];
		$allSections = $data['VIEW']['sections'];
		$allStandards = $data['VIEW']['standards'];
		$allEmployees = $data['VIEW']['employees'];
		
		$id = $request->id;
		
		$data = $request->except('token','id');
		
		if(is_numeric($request->id)){
		try{
		$check = DB::table('chats')->where('ID',$request->id)->select('status')->get()[0]->status;
		if($check == 'Sent') return sendJsonResponse($data=null,201,'This Message has already been sent.',true,'It has already been sent. Copy it to a new draft if you want to send it again.');
		}
		catch(Exception $ex){
			
		}
		}
		else if($request->id == 'newDraft'){
				$data['status'] = 'Draft';
				$data['user_ID'] = checkToken($request->token)['userID'];
				$data['signatures'] = getUserSignatures();
				$id = DB::table('chats')->insertGetId($data);
				$dataT = array();
				$dataT['draft_ID'] = $id;
				$dataT['last_saved'] = date('h:i:s A d M Y');
			}
		else return sendJsonResponse(null,201,'Inavlid Request.');
		
		
		
		$sendTo = $data['send_to'];
		
		$data['status'] = 'Sent';
		
		
		if($sendTo == 'students'){
		if(!in_array($request->students_ids,$allStudents)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to send Message to all or some of the requested students.');
			$data['section_ids'] = $data['standard_ids'] = $data['employee_ids'] = null;
		}
		
		if($sendTo == 'standards'){
		if(!in_array($request->standard_ids,$allStandards)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to send Message to all or some of the requested standards.');
			$data['section_ids'] = $data['students_ids'] = $data['employee_ids'] = null;
		}
		
		if($sendTo == 'sections'){
		if(!in_array($request->section_ids,$allSections)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to send Message to all or some of the requested standards.');
			$data['standard_ids'] = $data['students_ids'] = $data['employee_ids'] = null;
		}
		
		if($sendTo == 'employees'){
		if(!in_array($request->employee_ids,$allEmployees)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to send Message to all or some of the requested standards.');
			$data['standard_ids'] = $data['students_ids'] = $data['section_ids'] = null;
		}
		
		if($sendTo == 'all'){
			$data['standard_ids'] = $data['students_ids'] = $data['section_ids'] = null;
		}
		
		try{
				DB::table('chats')->where('ID',$id)->update($data);
				$data['message_ID'] = $id;
				$data['sent_time'] = date('h:i:s A d M Y');
				return sendJsonResponse($data,200,'Message Sent Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Message could not be sent.',true,$ex->getMessage());
		}
		
	}
	
}
