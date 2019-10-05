<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;
use Illuminate\Validation\Rule;



class FeeManager extends Controller{
	
    public function getAllFeeEntities(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_entities = $data['VIEW']['fee_amounts'];
		$data = DB::table('fee_amounts')
		->join('fee_types','fee_types.ID','=','fee_type_ID')
		->whereIn('fee_amounts.ID',$fee_entities)
		->select('fee_amounts.*',
		DB::raw('CONCAT(fee_types.fee_full_name," (",fee_types.fee_for,")") AS fee_type_info'),'fee_types.fee_wise as fee_wise')
		->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getFeeEntity(Request $request,$id){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_amounts = $data['VIEW']['fee_amounts'];
		if(!in_array($request->id,$fee_amounts)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this Fee Entity.');
		$data = DB::table('fee_amounts')
		->join('fee_types','fee_types.ID','=','fee_type_ID')
		->where('fee_amounts.ID',$id)
		->select('fee_amounts.*',
		DB::raw('CONCAT(fee_types.fee_full_name," (",fee_types.fee_for,")") AS fee_type_info'),'fee_types.fee_wise as fee_wise')
		->get()[0];
		$data = (array) $data;
		$data['packed_structure'] = unserialize($data['packed_structure']);
		return datatables()->of($data)->toJson();
	}
	
	public function getIdByABC($a,$b,$c){
		$data = DB::table('fee_amounts')->where('fee_type_ID',$a)->where('standard_id',$b)->where('subject_id',$c)->select('ID')->get();
		try{
		return $data[0]->ID;
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Entity Not Found.',true,$ex->getMessage());
		}
	}
	
	public function deleteFeeEntity(Request $request){
		try{
			
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_entities = $data['DELETE']['fee_amounts'];
		if(!in_array($request->id,$fee_entities)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Fee Entity.');	
			
		$status = DB::table('fee_amounts')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_fee_amounts');
		refreshRelationLogics('EDIT_fee_amounts');
		refreshRelationLogics('DELETE_fee_amounts');
		
		if($status) return sendJsonResponse($data=null,200,'Fee Entity Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Entity could not be deleted.',true,$ex->getMessage());
		}
	}
	
	public function addNewFeeEntity(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_amounts = $data['ADD']['fee_amounts'];
		
		if($fee_amounts != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Fee Entity.');
		
		$packed_structure = serialize($request->packed_structure);

		$data = $request->except('packed_structure','token');
		
		$data = (array)$data;

		try{
		$data['packed_structure'] = $packed_structure;
		}
		catch(Exception $ex){}
		
		$request->validate([
			'fee_type_id' => 'required',
			'fee_method' => 'required',
			'fee_max_amount' => 'required'
		]);
		
		
		try{
		$status = DB::table('fee_amounts')->insert($data);
		
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_fee_amounts',$id);
		relationLogics('EDIT_fee_amounts',$id);
		relationLogics('DELETE_fee_amounts',$id);
		
		return sendJsonResponse($data=null,200,'New Fee Entity Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Entity could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editFeeEntity(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$fee_amounts = $data['EDIT']['fee_amounts'];
		if(!in_array($request->id,$fee_amounts)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Fee Entity.');
		
		$data = $request->except('packed_structure','token');
		
		$data = (array)$data;

		try{
		$data['packed_structure'] = $packed_structure;
		}
		catch(Exception $ex){}
		
		$request->validate([
			'fee_type_id' => 'required',
			'fee_method' => 'required',
			'fee_max_amount' => 'required'
		]);
		
		
		try{
		$status = DB::table('fee_amounts')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Fee Entity Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Fee Entity could not be edited.',true,$ex->getMessage());
		}
		
	}
	
}
