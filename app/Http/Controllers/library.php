<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Validator;


class library extends Controller{
	
    public function getAllBooks(){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$books = $data['VIEW']['books'];
		$data = DB::table('books')
		->whereIn('ID',$books)
		->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getAllBookCategories(){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$bookCategories = $data['VIEW']['book_categories'];
		$data = DB::table('book_categories')
		->whereIn('ID',$bookCategories)
		->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getAllIssuedBooks(){
		$data = DB::table('books')
		->join('issued_books','books.ID','=','issued_books.book_id')
		->join('students','students.ID','=','issued_books.student_id')
		->select('books.*','issued_books.*',DB::raw('CONCAT("Name: ", student_first_name," ",student_last_name," | School Roll No.",school_roll_no," | Section Roll No. ",section_roll_no) AS student_details'))
		->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getAllIssuedBooksByStudent(){
		$data = DB::table('books')
		->join('issued_books','books.ID','=','issued_books.book_id')
		->join('students','students.ID','=','issued_books.student_id')
		->where('issued_books.student_id',request()->id)
		->select('books.*','issued_books.*',DB::raw('CONCAT("Name: ", student_first_name," ",student_last_name," | School Roll No.",school_roll_no," | Section Roll No. ",section_roll_no) AS student_details'))
		->get();
		return datatables()->of($data)->toJson();
	}
	
	public function getBook(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$books = $data['VIEW']['books'];
		if(!in_array($request->id,$books)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this Book.');
		return array(DB::table('books')->where('ID',$request->id)->first());
	}
	
	public function getBookCategory(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$book_categories = $data['VIEW']['book_categories'];
		if(!in_array($request->id,$book_categories)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to view this Book Category.');
		return array(DB::table('book_categories')->where('ID',$request->id)->first());
	}
	
	public function deleteBook(Request $request){
		try{
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$books = $data['DELETE']['books'];
		
		if(!in_array($request->id,$books)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Book.');
			
		$status = DB::table('Books')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_books');
		refreshRelationLogics('EDIT_books');
		refreshRelationLogics('DELETE_books');
		
		if($status) return sendJsonResponse($data=null,200,'Book Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Book could not be added.',true,$ex->getMessage());
		}
	}
	
	public function deleteBookCategory(Request $request){
		try{
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$book_categories = $data['DELETE']['book_categories'];
		
		if(!in_array($request->id,$book_categories)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to delete this Book Category.');
			
		$status = DB::table('book_categories')->where('ID',$request->id)->delete();
		
		refreshRelationLogics('VIEW_book_categories');
		refreshRelationLogics('EDIT_book_categories');
		refreshRelationLogics('DELETE_book_categories');
		
		if($status) return sendJsonResponse($data=null,200,'Book Category Deleted Successfully');
		else throw new exception('Invalid ID Error');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Book Category could not be added.',true,$ex->getMessage());
		}
	}
	
	public function addNewBook(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$books = $data['ADD']['books'];
		
		if($books != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Book.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'book_name' => 'required',
			'book_isbn' => 'required'
		]);
		
		
		try{
		$status = DB::table('books')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		$id = relationLogics('VIEW_books',$id);
		relationLogics('EDIT_books',$id);
		relationLogics('DELETE_books',$id);
		
		return sendJsonResponse($data=null,200,'New Book Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Book could not be added.',true,$ex->getMessage());
		}
		
	}
	
	public function editBook(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$books = $data['EDIT']['books'];
		if(!in_array($request->id,$books)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Book.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'book_name' => 'required',
			'book_isbn' => 'required'
		]);
		
		
		try{
		$status = DB::table('books')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Book Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Book could not be edited.',true,$ex->getMessage());
		}
		
	}
	
	public function editBookCategory(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$book_categories = $data['EDIT']['book_categories'];
		if(!in_array($request->id,$book_categories)) return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to Edit this Book Category.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'category_name' => 'required',
		]);
		
		
		try{
		$status = DB::table('book_categories')->where('ID',$request->id)->update($data);
		return sendJsonResponse($data=null,200,'Book Edited Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Book could not be edited.',true,$ex->getMessage());
		}
		
	}
	
	public function issueBook(Request $request){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['issue_books'];
		$type = getUserType();
		if($permission != 'allowed' AND $type !='student') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to issue a Book.');
		$bookID = $request->book_id;
		$studentID = $request->student_id;
		$issuedCount = DB::table('issued_books')
		->where('book_id',$bookID)
		->where('status','ISSUED')
		->count();
		$stockCount = DB::table('books')->where('ID',$bookID)->select('quantity')->get()[0]->quantity;
		$check = DB::table('issued_books')
		->where('book_id',$bookID)
		->where('student_id',$studentID)
		->where('status','ISSUED')
		->count();
		if($check>0) return sendJsonResponse(null,201,'Could Not Issue Book',true,'One Quantity of this book has already been issued by this student.');
		if($stockCount>0 AND $issuedCount<$stockCount){
			//only then Issue Book
			try{
			$data = array();
			$data['book_id'] = $bookID;
			$data['student_id'] = $studentID;
			$data['issue_date'] = date("Y-m-d H:i:s");
			$data['status'] = 'ISSUED';
			DB::table('issued_books')->insert($data);
			return sendJsonResponse(null,200,'Book Issued Successfully.');
			}
			catch(Exception $ex){
				return sendJsonResponse(null,201,'Could Not Issue Book.',true,$ex->getMessage());
			}
		}
		else if($stockCount == 0){
			return sendJsonResponse(null,201,'Could Not Issue Book',true,'This book is currently not avaiable in Library Stock.');
		}
		else return sendJsonResponse(null,201,'Could Not Issue Book',true,'All Quanities of this book are already issued.');
	}
	
	public function returnBook($issueID){
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$permission = $data['OTHERS']['return_books'];
		$type = getUserType();
		if($permission != 'allowed' AND $type !='student') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have the right to return books.');
		$data = array();
		$data['status'] = 'RETURNED';
		$data['return_date'] = date("Y-m-d H:i:s");
		try{
			DB::table('issued_books')->where('ID',$issueID)->update($data);
			return sendJsonResponse(null,200,'Book Returned Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse(null,201,'Could Not Return Book',true,$ex->getMessage().$ex->getLine());
		}
	}
	
	public function addNewBookCategory(Request $request){
		
		$data = checkToken(request()->token);
		if($data==401) return show(401);
		if($data==403) return show(403);
		$books = $data['ADD']['book_categories'];
		
		if($books != 'allowed') return sendJsonResponse($data=null,201,'Permission Denied.',true,'You do not have permission to add a new Book Category.');
		
		$data = $request->except('_token','token');
		
		$request->validate([
			'category_name' => 'required'
		]);

		
		try{
		$status = DB::table('book_categories')->insert(array($data));
		
		$id = DB::getPdo()->lastInsertId();
		relationLogics('VIEW_book_categories',$id);
		relationLogics('EDIT_book_categories',$id);
		relationLogics('DELETE_book_categories',$id);
		
		return sendJsonResponse($data=null,200,'New Book Category Added Successfully.');
		}
		catch(Exception $ex){
			return sendJsonResponse($data=null,201,'Book Category could not be added.',true,$ex->getMessage());
		}
		
	}
	
}
