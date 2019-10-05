<?php

	function sendJsonResponse($data,$code,$message,$error=false,$errorMessage = null){
			if($error==true) $arr = ['status'=>$code,'message'=>$message,'error'=>$errorMessage];
			else if($data==null) $arr = ['status'=>$code,'message'=>$message];
			else $arr = ['status'=>$code,'message'=>$message,'data'=>$data];
			return response()->json($arr,$code);
		}
		
	function show($code){
		if($code==401) return sendJsonResponse($data=null,$code,"Unauthorized Access",true,'Token Not Provided.');
		if($code==403) return sendJsonResponse($data=null,$code,"Unauthorized Access",true,'Invalid Token Provided');
	}
	
	function getHomeURL(){
		return 'http://localhost/school';
	}
	
	function getUserType(){
		$request = request();
		$username = $request->session()->get('username');
		return DB::table('users')->where('username',$username)->select('userType')->get()[0]->userType;
	}
	
	function getUserAccountID(){
		$request = request();
		$username = $request->session()->get('username');
		return DB::table('users')->where('username',$username)->select('ID')->get()[0]->ID;
	}
	
	function getUserFullName($id=null){
		if($id==null) $id = getUserAccountID();
		$one = DB::table('users')
		->select('ID','username',DB::raw('UCASE(userType) as userType'),'type_ID')
		->where('ID',$id)
		->get()[0];
		if($one->userType=='STUDENT'){
				$single = DB::table('students')->where('ID',$one->type_ID)->select('student_first_name','student_last_name')->get()[0];
				$one->full_name = $single->student_first_name.' '.$single->student_last_name.' ('.$one->type_ID.')';
		}
		else if($one->userType=='EMPLOYEE'){
				$one->type = 'Employee';
				$single = DB::table('employees')->where('ID',$one->type_ID)->select('first_name','last_name')->get()[0];
				$one->full_name = $single->first_name.' '.$single->last_name.' ('.$one->type_ID.')';
		}
		else $one->full_name = 'Master Account';
		return $one->full_name;
	}
	
	function getUserTypeID(){
		$request = request();
		$username = $request->session()->get('username');
		return DB::table('users')->where('username',$username)->select('type_ID')->get()[0]->type_ID;
	}
	
	function totalFeeCollectedThisMonth(){
		$data = DB::table('paid_fees')
		->whereRaw('MONTH(payment_date) = MONTH(CURRENT_DATE())')
		->whereRaw('YEAR(payment_date) = YEAR(CURRENT_DATE())')
		->sum('fee_amount');
		return number_format($data);
	}
	
	function messagesSentLast30Days(){
		$data = DB::table('chats')
		->whereRaw('MONTH(dateTime) = MONTH(CURRENT_DATE())')
		->whereRaw('YEAR(dateTime) = YEAR(CURRENT_DATE())')
		->count();
		return number_format($data);
	}
	
	function avgAttendanceLast30Days(){
		$presentCount = DB::table('attendance')
		->where('status','PRESENT')
		->whereRaw('date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()')
		->count();
		$totalCount = DB::table('attendance')
		->whereRaw('date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()')
		->count();
		try{
		return round($presentCount/$totalCount*100,2);
		}
		catch(Exception $ex){
			return 0;
		}
	}
	
	function getStudentSectionID($id=null){
		if(strlen($id)==0) $id = getUserTypeID();
		try{
		return DB::table('students')->where('ID',$id)->select('section_id')->get()[0]->section_id;
		}
		catch(Exception $ex){
			return 0;
		}
	}
	
	function getStudentStandardID($id=null){
		if(strlen($id)==0) $id = getUserTypeID();
		try{
		return DB::table('students')->where('ID',$id)->select('standard_id')->get()[0]->standard_id;
		}
		catch(Exception $ex){
			return 0;
		}
	}
	
	function getUserSignatures($id=null){
		$request = request();
		$username = $request->session()->get('username');
		return DB::table('users')->where('username',$username)->select('signatures')->get()[0]->signatures;
	}
	
	
	function allowOrNot($uri){
		$request = request();
		$username = $request->session()->get('username');
		$token = $request->session()->get('token');
		$result = DB::table('sessions')->where([['username',$username],['token',$token]])->get();
		$value = $request->session()->get('home');
		if(count($result)==1) $login = true;
		else $login = false;
		if($login){
			DB::table('users')->where('username',$username)->update(['token' => str_random(100)]);
			$token = DB::table('users')->where('username',$username)->select('token')->get()[0]->token;
			setcookie("token", $token);
		}
		if(!$login) return Redirect::to(url('/login?loginFirst'));
		else return view('home/'.$uri);
	}
	
	function startsWith ($string, $startString) { 
			$len = strlen($startString); 
			return (substr($string, 0, $len) === $startString); 
		} 
	
	function getBackgroundImageURL(){
		$firstFile = scandir("images/background/")[2];
		return getHomeURL().'/images/background/'.$firstFile;
	}
	
	function relationLogics($property,$id){
		$allArr = array();
		$er = explode('_',$property,2)[0]."_";
		$table = strtolower(explode('_',$property,2)[1]);
		$ids = DB::table($table)->select('ID')->get();
		foreach($ids as $value){
			array_push($allArr,$value->ID);
		}
		$relation_id = DB::table('users')->select('relation_id')->where('token',request()->token)->get()[0]->relation_id;
		if($relation_id==0) $arr = implode(',',$allArr);
		else{
		if($table == 'attendance_sections') $property = $er.'sections';
		if($table == 'marksheet_entities') $property = $er.'registered_evaluations';
		if($table == 'employees_types') $property = $er.'employeesTypes';
		if($table == 'registered_evaluations') $property = $er.'evaluationEntities';
		if($table == 'subject_types') $property = $er.'subjectTypes';
		if($table == 'fee_amounts') $property = $er.'fee_entities';
		if($table == 'fee_structures') $property = $er.'fee_charges';
		
		$arr = DB::table('relations')->select($property)->where('ID',$relation_id)->get()[0]->$property;
		if($arr=="all") return;
		$arr = explode(',',$arr);
		array_push($arr,$id);
		$arr = array_intersect($allArr,$arr);
		$arr = implode(',',$arr);
		}
		if($table == 'attendance_sections') $property = $er.'sections';
		if($table == 'marksheet_entities') $property = $er.'registered_evaluations';
		if($table == 'employees_types') $property = $er.'employeesTypes';
		if($table == 'registered_evaluations') $property = $er.'evaluationEntities';
		if($table == 'subject_types') $property = $er.'subjectTypes';
		if($table == 'fee_amounts') $property = $er.'fee_entities';
		if($table == 'fee_structures') $property = $er.'fee_charges';
		DB::table('relations')->where('ID',$relation_id)->update([$property => $arr]);
		return $id;
		}
		
	function refreshRelationLogics($property){
		$allArr = array();
		$er = explode('_',$property,2)[0]."_";
		$table = strtolower(explode('_',$property,2)[1]);
		$ids = DB::table($table)->select('ID')->get();
		foreach($ids as $value){
			array_push($allArr,$value->ID);
		}
		$relation_id = DB::table('users')->select('relation_id')->where('token',request()->token)->get()[0]->relation_id;
		if($relation_id==0) $arr = implode(',',$allArr);
		else{
		if($table == 'attendance_sections') $property = $er.'sections';
		if($table == 'marksheet_entities') $property = $er.'registered_evaluations';
		if($table == 'employees_types') $property = $er.'employeesTypes';
		if($table == 'registered_evaluations') $property = $er.'evaluationEntities';
		if($table == 'subject_types') $property = $er.'subjectTypes';
		return $table.$property;
		$arr = DB::table('relations')->select($property)->where('ID',$relation_id)->get()[0]->$property;
		if($arr=="all") return;
		$arr = explode(',',$arr);
		$arr = array_intersect($allArr,$arr);
		$arr = implode(',',$arr);
		}
		if($table == 'attendance_sections') $property = $er.'sections';
		if($table == 'marksheet_entities') $property = $er.'registered_evaluations';
		if($table == 'employees_types') $property = $er.'employeesTypes';
		if($table == 'registered_evaluations') $property = $er.'evaluationEntities';
		if($table == 'subject_types') $property = $er.'subjectTypes';
		DB::table('relations')->where('ID',$relation_id)->update([$property => $arr]);
		}
	
	function checkToken($token=null){
		if($token==null) return 401;
		$sectionsList = array();
		$standardsList = array();
		$subjectsList = array();
		if(count(DB::table('users')->where('token',$token)->get())==0) return 403;
		$id = DB::table('users')->where('token',$token)->select('relation_id')->get()[0]->relation_id;
		$userID = DB::table('users')->where('token',$token)->select('ID')->get()[0]->ID;
		if($id==0){
			$ids1 = DB::table('sections')->select('ID')->get();
			$ids2 = DB::table('standards')->select('ID')->get();
			$ids3 = DB::table('employees')->select('ID')->get();
			$ids4 = DB::table('employees_types')->select('ID')->get();
			$ids5 = DB::table('evaluations')->select('ID')->get();
			$ids6 = DB::table('global_options')->select('ID')->get();
			$ids7 = $ids17 = DB::table('registered_evaluations')->select('ID')->get();
			$ids8 = DB::table('relations')->select('ID')->get();
			$ids9 = DB::table('admissions')->select('ID')->get();
			$ids10 = DB::table('subjects')->select('ID')->get();
			$ids11 = DB::table('subject_types')->select('ID')->get();
			$ids12 = DB::table('students')->select('ID')->get();
			$ids13 = DB::table('sections')->select('ID')->get();
			$ids14 = DB::table('fee_types')->select('ID')->get();
			$ids15 = DB::table('fee_amounts')->select('ID')->get();
			$ids16 = DB::table('fee_structures')->select('ID')->get();
			$ids18 = DB::table('books')->select('ID')->get();
			$ids19 = DB::table('book_categories')->select('ID')->get();
			
			for($i=1;$i<=19;$i++){
				${'arr'.$i} = array();
				foreach(${'ids'.$i} as $id){
					array_push(${'arr'.$i},$id->ID);
				}
			}
			
			$edit = $view = $delete = array(
			"attendance_sections" => $arr1,
			"standards" => $arr2,
			"employees" => $arr3,
			"employees_types" => $arr4,
			"evaluations" => $arr5,
			"global_options" => $arr6,
			"registered_evaluations" => $arr7,
			"relations" => $arr8,
			"admissions" => $arr9,
			"subjects" => $arr10,
			"subject_types" => $arr11,
			"students" => $arr12,
			"sections" => $arr13,
			"fee_types" => $arr14,
			"fee_amounts" => $arr15,
			"fee_structures" => $arr16,
			"marksheet_entities" => $arr17,
			"books" => $arr18,
			"book_categories" => $arr19
			);
			
			$add = array(
			"attendance_sections" => $arr1,
			"standards" => "allowed",
			"employees" => "allowed",
			"employees_types" => "allowed",
			"evaluations" => "allowed",
			"global_options" => "allowed",
			"registered_evaluations" => "allowed",
			"relations" => "allowed",
			"admissions" => "allowed",
			"subjects" => "allowed",
			"subject_types" => "allowed",
			"students" => "allowed",
			"sections" => "allowed",
			"fee_types" => "allowed",
			"fee_amounts" => "allowed",
			"fee_structures" => "allowed",
			"marksheet_entities" => $arr17,
			"books" => "allowed",
			"book_categories" => "allowed"
			);
			
			$others = array(
			"fee_payment" => "allowed",
			"roll_numbers_assignment" => "allowed",
			"issue_books" => "allowed",
			"return_books" => "allowed",
			"school_information" => "allowed",
			"change_background" => "allowed"
			);
			
			return array('VIEW' => $view, 'EDIT' => $edit, 'DELETE' => $delete, 'ADD' => $add, 'userID' => $userID, 'OTHERS' => $others);
			
		}
		
		$view = array();
		$others = array();
		$data = DB::table('relations')->where('ID',$id)->get()[0];
		foreach($data as $key => $value){
			if(!(startsWith($key,'VIEW') OR startsWith($key,'ADD') OR startsWith($key,'EDIT') OR startsWith($key,'DEL') OR startsWith($key,'OTHER'))) continue;
			$newKey = explode('_',$key,2)[1];
			$table = $newKey;
			if($newKey == 'attendance_sections') $table = 'sections';
			if($newKey == 'marksheet_entities') $table = 'registered_evaluations';
			if($newKey == 'employeesTypes') $table = $newKey = 'employees_types';
			if($newKey == 'evaluationEntities') $table = $newKey = 'registered_evaluations';
			if($newKey == 'subjectTypes') $table = $newKey = 'subject_types';
			if($newKey == 'fee_entities') $table = $newKey = 'fee_amounts';
			if($newKey == 'fee_charges') $table = $newKey = 'fee_structures';
			if(startsWith($key,'VIEW')) {
				//$newKey = substr($key,5);
				if($value=='all'){
					$ids = DB::table($table)->select('ID')->get();
					$arr = array();
					foreach($ids as $id){
						array_push($arr,$id->ID);
					}
					$view[$newKey] = $arr;
				}
				else $view[$newKey] = explode(',',$value);
			}
			if(startsWith($key,'ADD')) {
				//$newKey = substr($key,4);
				if($newKey == 'attendance_sections' OR $newKey == 'marksheet_entities'){
					if($value=='all'){
						$ids = DB::table($table)->select('ID')->get();
						$arr = array();
						foreach($ids as $id){
							array_push($arr,$id->ID);
						}
						$add[$newKey] = $arr;
					}
					else $add[$newKey] = explode(',',$value);
				}
				else $add[$newKey] = $value;
			}
			if(startsWith($key,'EDIT')) {
				//$newKey = substr($key,5);
				if($value=='all'){
					$ids = DB::table($table)->select('ID')->get();
					$arr = array();
					foreach($ids as $id){
						array_push($arr,$id->ID);
					}
					$edit[$newKey] = $arr;
				}
				else $edit[$newKey] = explode(',',$value);
			}
			if(startsWith($key,'DEL')) {
				//$newKey = substr($key,4);
				if($value=='all'){
					$ids = DB::table($table)->select('ID')->get();
					$arr = array();
					foreach($ids as $id){
						array_push($arr,$id->ID);
					}
					$delete[$newKey] = $arr;
				}
				else $delete[$newKey] = explode(',',$value);
			}
			if(startsWith($key,'OTHER')) {
				$others[$newKey] = $value;
			}
		}
		
		return array('VIEW' => $view, 'EDIT' => $edit, 'DELETE' => $delete, 'ADD' => $add, 'userID' => $userID, 'OTHERS' => $others);
		
		
		
	}
	
	function getAllReceivedMessagesCount(){
		$request = request();
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
		->get();
		
		if($type=='developer' OR $type=='master') $data = DB::table('chats')->get();
		
		if($type=='employee') $data = DB::table('chats')->whereRaw($typeID.' IN (employee_ids)')->orWhere('send_to','allEmployees')->get();
		
		foreach($data as $one){
			$one->full_name = getUserFullName($one->user_ID);
		}
		
		return count($data);
		
	}
	
	function getReadMessagesCount(){
		$id = getUserAccountID();
		return DB::table('read_messages')->where('user_ID',$id)->count();
	}
	
	function getUnreadMessagesCount(){
		return getAllReceivedMessagesCount() - getReadMessagesCount();
	}
	
	function getLastThreeReceivedMessages(){
		$request = request();
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
		->limit(3)
		->get();
		
		if($type=='developer' OR $type=='master') $data = DB::table('chats')->orderBy('dateTime','DESC')->limit(3)->get();
		
		if($type=='employee') $data = DB::table('chats')->whereRaw($typeID.' IN (employee_ids)')->orderBy('dateTime','DESC')->orWhere('send_to','allEmployees')->limit(3)->get();
		
		foreach($data as $one){
			$one->full_name = getUserFullName($one->user_ID);
		}
		
		return $data;
		
	}
	
?>
