<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Login
Route::get('/login',function(){
	return view('home/login');
});

//Dashboard
Route::get('/logout','authLogin@logout');
Route::get('/home',function(){
	return AllowOrNot('index');
});
Route::post('/home','authLogin@setSessionToken');

Route::get('/admission',function(){
	return AllowOrNot('admission');
});


//standards
Route::get('/standards',function(){return AllowOrNot('standards');});

//standards API
Route::get('api/standards','standards@getAllStandards');
Route::get('api/standardsByFeeType/{id}','standards@getStandardsByFeeType');
Route::get('api/standards/{id}','standards@getStandard');
Route::post('api/standards','standards@addNewStandard');
Route::put('api/standards/{id}','standards@editStandard');
Route::delete('api/standards/{id}','standards@deleteStandard');

//sections
Route::get('/sections',function(){return AllowOrNot('sections');});

//sections API
Route::get('api/sections','sections@getAllSections');
Route::get('api/sectionsByFeeType/{id}','sections@getSectionsByFeeType');
Route::get('api/attendanceSections','sections@getAttendanceSections');
Route::get('api/sectionsByStandard/{thisID}','sections@getAllSectionsByStandard');
Route::get('api/sections/{id}','sections@getSection');
Route::post('api/sections','sections@addNewSection');
Route::put('api/sections/{id}','sections@editSection');
Route::delete('api/sections/{id}','sections@deleteSection');

//employees
Route::get('/employees',function(){return AllowOrNot('employees');});

//employees API
Route::get('api/employees','employees@getAllemployees');
Route::get('api/employees/{id}','employees@getemployee');
Route::post('api/employees','employees@addNewemployee');
Route::put('api/employees/{id}','employees@editemployee');
Route::delete('api/employees/{id}','employees@deleteemployee');

//employeesType
Route::get('/employeesTypes',function(){return AllowOrNot('employeesTypes');});

//employeesType API
Route::get('api/employeesTypes','employeesTypes@getAllEmployeesTypes');
Route::get('api/employeesTypes/{id}','employeesTypes@getEmployeesType');
Route::post('api/employeesTypes','employeesTypes@addNewEmployeesType');
Route::put('api/employeesTypes/{id}','employeesTypes@editEmployeesType');
Route::delete('api/employeesTypes/{id}','employeesTypes@deleteEmployeesType');

//subjectType
Route::get('/subjectTypes',function(){return AllowOrNot('subjectTypes');});

//subjectType API
Route::get('api/subjectTypes','subjectTypes@getAllSubjectTypes');
Route::get('api/subjectTypes/{id}','subjectTypes@getSubjectType');
Route::post('api/subjectTypes','subjectTypes@addNewSubjectType');
Route::put('api/subjectTypes/{id}','subjectTypes@editSubjectType');
Route::delete('api/subjectTypes/{id}','subjectTypes@deleteSubjectType');

//subjects
Route::get('/subjects',function(){return AllowOrNot('subjects');});

//subjects API
Route::get('api/subjects','subjects@getAllSubjects');
Route::get('api/subjects/{id}','subjects@getSubject');
Route::post('api/subjects','subjects@addNewSubject');
Route::put('api/subjects/{id}','subjects@editSubject');
Route::delete('api/subjects/{id}','subjects@deleteSubject');

//students
Route::get('/students',function(){return AllowOrNot('students');});

//students API
Route::get('api/students','students@getAllStudents');
Route::get('api/students/stats','students@getStudentsStats');
Route::get('api/studentsBySection/{id}','students@getStudentsBySection');
Route::get('api/students/{id}','students@getStudent');
Route::post('api/students','students@addNewStudent');
Route::put('api/students/{id}','students@editStudent');
Route::delete('api/students/{id}','students@deleteStudent');

//evaluation
Route::get('/evaluations',function(){return AllowOrNot('evaluations');});
Route::get('/evaluationsManager',function(){return AllowOrNot('evaluationsManager');});
Route::get('/evaluationsEntities',function(){return AllowOrNot('evaluationsEntities');});

//evaluation API
Route::get('api/evaluations','evaluations@getAllEvaluations');
Route::get('api/publishedEvaluations/{id}','evaluations@getAllPublishedEvaluations');
Route::get('api/evaluations/{id}','evaluations@getEvaluation');
Route::post('api/evaluations','evaluations@addNewEvaluation');
Route::put('api/evaluations/{id}','evaluations@editEvaluation');
Route::delete('api/evaluations/{id}','evaluations@deleteEvaluation');

Route::get('api/standardsByEvaluation/{id}','evaluations@standardsByEvaluation');
Route::get('api/subjectsByStandard/{id}','evaluations@subjectsByStandard');

//evaluation Entities API
Route::get('api/evaluationEntities','evaluationsManager@getAllEvaluationEntities');
Route::get('api/evaluationEntities/{id}','evaluationsManager@getEvaluationEntity');
Route::post('api/evaluationEntities','evaluationsManager@addNewEvaluationEntity');
Route::put('api/evaluationEntities/{id}','evaluationsManager@editEvaluationEntity');
Route::delete('api/evaluationEntities/{id}','evaluationsManager@deleteEvaluationEntity');

Route::get('api/standardsByEvaluation/{id}','evaluations@standardsByEvaluation');
Route::get('api/subjectsByStandard/{id}','evaluations@subjectsByStandard');
Route::get('api/idByABC/{a}/{b}/{c}','evaluationsManager@getIdByABC');


//Attendance
Route::get('/attendance',function(){return AllowOrNot('attendance');});
Route::get('/viewAttendance',function(){return AllowOrNot('viewAttendance');});

//Attendance API

Route::post('api/markAttendance/{id}','attendance@markAttandance');
Route::get('api/attendance/{id}/{date}','attendance@getAttendance');
Route::get('api/attendanceByStudent/{id}','attendance@getAttendanceForStudent');
Route::post('api/attendance','attendance@addNewEvaluationEntity');
Route::put('api/attendance/{id}','attendance@editEvaluationEntity');
Route::delete('api/attendance/{id}','attendance@deleteEvaluationEntity');

//Fill Marks
Route::get('/fillMarks',function(){return AllowOrNot('fillMarks');});

//API
Route::get('api/fillMarks/{id}','fillMarks@getMarks');
Route::post('api/fillMarks/{id}','fillMarks@addNewMarks');

//Relations
Route::get('/relations',function(){return AllowOrNot('relations');});

//Relations API

Route::get('api/users','relations@getAllUsers');
Route::get('api/tables','relations@getAllTables');
Route::get('api/relations','relations@saveRights');
Route::get('api/getRelations','relations@getRights');

//Relations
Route::get('/chat',function(){return AllowOrNot('chat');});

//Chat API
Route::get('api/chat','chat@getAllMessages');
Route::get('api/chat/{id}','chat@getMessage');
Route::get('api/messages','chat@getAllReceivedMessages');
Route::post('api/chat','chat@saveDraft');
Route::post('api/chat/send','chat@sendMessage');
Route::delete('api/chat','chat@deleteDraft');

//FeeTypes
Route::get('/feeTypes',function(){return AllowOrNot('feeTypes');});

//FeeTypes API
Route::get('api/feeTypes','feeTypes@getAllFeeTypes');
Route::post('api/feeTypes','feeTypes@addNewFeeType');
Route::get('api/feeTypes/{id}','feeTypes@getFeeType');
Route::put('api/feeTypes/{id}','feeTypes@editFeeType');
Route::delete('api/feeTypes/{id}','feeTypes@deleteFeeType');

//FeeManager
Route::get('/feeManager',function(){return AllowOrNot('feeManager');});
Route::get('/feeEntities',function(){return AllowOrNot('feeEntities');});
Route::get('/fillFee',function(){return AllowOrNot('fillFee');});
Route::get('/viewFee',function(){return AllowOrNot('viewFee');});

//FeeManager API
Route::get('api/feeEntities','feeManager@getAllFeeEntities');
Route::get('api/feeManager/{id}','feeManager@getFeeEntity');
Route::put('api/feeManager/{id}','feeManager@editFeeEntity');
Route::post('api/feeManager','feeManager@addNewFeeEntity');
Route::delete('api/feeManager/{id}','feeManager@deleteFeeEntity');

Route::get('api/fillFee/{id}','fillFee@getFee');
Route::post('api/fillFee/{id}','fillFee@addNewFee');

//Assign Rolls
Route::get('/assignRolls',function(){return AllowOrNot('assignRolls');});

//Assign Rolls API
Route::post('api/autoWholeSchoolOnly','assignRolls@autoWholeSchoolOnly');
Route::post('api/autoSection','assignRolls@autoSection');
Route::post('api/autoSchoolSection','assignRolls@autoSchoolSection');
Route::post('api/manualSection','assignRolls@manualSection');
Route::post('api/manualSchool','assignRolls@manualSchool');
Route::post('api/manualBoth','assignRolls@manualBoth');

//Pay Fee
Route::get('/payFee',function(){return AllowOrNot('payFee');});
Route::get('/feeStats',function(){return AllowOrNot('feeStats');});

//Pay Fee API
Route::get('api/payFee/{id}','payFee@getAllDueFeesByStudent');
Route::get('api/feeStats/{id}','payFee@getFeeStudentStats');
Route::get('api/payFeeParticular/{id}','payFee@getParticularDueFeeByStructureID');
Route::post('api/payFee/{id}','payFee@markFeeAsPaid');

//viewResult
Route::get('/viewResult',function(){return AllowOrNot('viewResult');});

//viewResult API
Route::get('api/studentResult/{eval_id}/{student_id}','evaluations@getStudentResultForEvaluation');
Route::get('api/userTypeId',function(){return getUserTypeID();});
Route::get('api/feeCollectedThisMonth',function(){return totalFeeCollectedThisMonth();});
Route::get('api/messagesSentLast30Days',function(){return messagesSentLast30Days();});
Route::get('api/avgAttendanceLast30Days',function(){return avgAttendanceLast30Days();});

//rooms
Route::get('/rooms',function(){return AllowOrNot('rooms');});

//roomsAPI
Route::get('/api/rooms','rooms@getAllRooms');
Route::get('/api/makeSeatingPlan','rooms@makePlan');
Route::get('/api/rooms/{id}','rooms@getRoom');
Route::post('/api/rooms','rooms@addNewRoom');
Route::put('/api/rooms/{id}','rooms@editRoom');
Route::delete('/api/rooms/{id}','rooms@deleteRoom');

//user Accounts
Route::get('/userAccounts',function(){return AllowOrNot('userAccounts');});

//settings
Route::get('/settings',function(){return AllowOrNot('settings');});

//globalSettings
Route::get('/globalSettings',function(){return AllowOrNot('globalSettings');});

//change Password
Route::post('/api/changePassword','settings@changePassword');
//change Background Image
Route::post('/api/changeBackgroundImage','settings@changeBackgroundImage');

//SchoolInfo
Route::post('/api/saveSchoolInfo','settings@saveSchoolInfo');
Route::get('/api/getSchoolInfo','settings@getSchoolInfo');

//Library Books
Route::get('/books',function(){return AllowOrNot('books');});

//Library API
Route::get('/api/books','library@getAllBooks');
Route::get('/api/books/{id}','library@getBook');
Route::post('/api/books','library@addNewBook');
Route::put('/api/books/{id}','library@editBook');
Route::delete('/api/books/{id}','library@deleteBook');

//Issue Books
Route::get('/issueBooks',function(){return AllowOrNot('issueBooks');});
Route::get('/viewIssuedBooks',function(){return AllowOrNot('viewIssuedBooks');});

//Issue Books API
Route::post('/api/issueBook','library@issueBook');
Route::get('/api/issuedBooks','library@getAllIssuedBooks');
Route::get('/api/issuedBooksByStudent/{id}','library@getAllIssuedBooksByStudent');
Route::post('/api/returnBook/{id}','library@returnBook');

//Book Categories
Route::get('/bookCategories',function(){return AllowOrNot('bookCategories');});
Route::get('/api/bookCategories','library@getAllBookCategories');
Route::get('/api/bookCategories/{id}','library@getBookCategory');
Route::post('/api/bookCategories','library@addNewBookCategory');
Route::put('/api/bookCategories/{id}','library@editBookCategory');
Route::delete('/api/bookCategories/{id}','library@deleteBookCategory');

//User Accounts API
Route::get('/api/userAccounts','userAccounts@getAllUserAccounts');
Route::post('/api/userAccounts','userAccounts@createUserAccount');
Route::put('/api/userAccounts/{id}','userAccounts@changePassword');
Route::delete('/api/userAccounts/{id}','userAccounts@deleteUserAccount');

Route::get('/globalOptions','globalOptions@getAll');
Route::get('/globalOptions/{id}','globalOptions@getByID');
Route::get('/globalOptions/name/{option}','globalOptions@getByOptionName');
Route::post('/globalOptions','globalOptions@addNewOption');
Route::put('/globalOptions','globalOptions@updateOption');
Route::delete('/globalOptions','globalOptions@deleteOption');

//Login API
Route::post('/api/login','login@checkLogin');
