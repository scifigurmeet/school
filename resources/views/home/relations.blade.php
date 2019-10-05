@include('home.header')
<div class="row">
	<div class="col col-lg">
	<!-- Toast -->
    <div class="toast" data-delay="5000">
      <div class="toast-header">
        <strong class="mr-auto" id="status">Success</strong>
        <small class="text-muted">Just now&nbsp;&nbsp;</small>
        <button type="button" class="btn btn-sm btn-success" data-dismiss="toast" aria-label="Close">
          Close
        </button>
      </div>
      <div class="toast-body" id="message">
        New Standard Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>User Rights <div id="saveRelations" style="padding: 5px; background: white; border-radius:5px;" class="threeD"><button class="btn btn-success float-right" onclick="saveRelations();"><i class="fas fa-street-view"></i>Save Changes</button></div></h3>
        </div>
	</div>
</div>
<div class="row">
	<div class="col col-lg">
			<div class="user-data m-b-30 threeD" style="padding: 35px;">
					<div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label class="form-control-label">Users</label>
                                                </div>
                                                <div class="col-4 col-md-4">
                                                    <select id="users" name="users" style="width: 100% !important;" onchange="getRelations();">
														
													</select>
                                                </div>
                    </div>
					<div class="row form-group">
																	 <div class="col col-md-2">
                                                    <label class="form-control-label">Permissions</label>
                                                </div>
                                                <div class="col-10 col-md-10">
                                                   Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="userPermissions" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#allPermissions').show(); else $('#allPermissions').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
                                                </div>
					</div>
					<style>
					#allPermissions .card{
						margin-bottom: 0px !important;
					}
					</style>
					<div class="row" id="allPermissions" style="display:none;">
					<div class="accordion" id="accordionExample">
  <div class="card" style="min-width: 100% !important;">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          View Permissions
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
	<p style="margin:10px;">The following sections allows you to assign the VIEW Rights of different entities of the whole school management software for the selected User.
	Leave selection for any enitity as blank under Customized option if you dont want to assign any rights of that particular entity to the user.</p><hr>
      <div class="card-body">
	  <div id="VIEW">
	  <!-- VIEW Attendance Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Attendance Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_attendance_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_attendance_sections').show(); else $('#view_attendance_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_attendance_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="attendance_sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Attendance Sections END -->
		<!-- VIEW Fill Marksheet Entity -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Marksheet Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_marksheet_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_marksheet_entities').show(); else $('#view_marksheet_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_marksheet_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Marksheet Entities
                                                   <select name="marksheet_entities" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Fill Marksheet Entity END -->
		<!-- VIEW Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_sections').show(); else $('#view_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Sections END -->
		<!-- VIEW Standards -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Standards</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_standards" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_standards').show(); else $('#view_standards').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_standards">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="standards" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Standards END -->
		<!-- VIEW Students -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Students</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_students" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_students').show(); else $('#view_students').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_students">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Students
                                                   <select name="students" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Students END -->
		<!-- VIEW Employees -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employees" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_employees').show(); else $('#view_employees').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_employees">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Employees
                                                   <select name="employees" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Employees END -->
		<!-- VIEW EmployeesTypes -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employeesTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_employeesTypes').show(); else $('#view_employeesTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_employeesTypes">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Employees Types
                                                   <select name="employeesTypes" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW EmployeesTypes END -->
		<!-- VIEW Evaluations -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluations" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_evaluations').show(); else $('#view_evaluations').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_evaluations">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Evaluations
                                                   <select name="evaluations" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Evaluations END -->
		<!-- VIEW EvaluationEntities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluationEntities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_evaluationEntities').show(); else $('#view_evaluationEntities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_evaluationEntities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Evaluations Entities
                                                   <select name="evaluationEntities" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW EvaluationEntities END -->
		<!-- VIEW Subjects -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subjects</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjects" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_subjects').show(); else $('#view_subjects').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_subjects">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Subjects
                                                   <select name="subjects" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Subjects END -->
		<!-- VIEW Subjects Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subject Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjectTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_subjectTypes').show(); else $('#view_subjectTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_subjectTypes">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Subject Types
                                                   <select name="subjectTypes" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Subjects Types END -->
		<!-- VIEW Admissions -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Admissions</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_admissions" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_admissions').show(); else $('#view_admissions').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_admissions">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Admissions
                                                   <select name="admissions" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Admissions END -->
		<!-- VIEW FeeTypes -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_types" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_fee_types').show(); else $('#view_fee_types').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_fee_types">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Types
                                                   <select name="fee_types" multiple>
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW FeeTypes END -->
		<!-- VIEW Fee Entities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_fee_entities').show(); else $('#view_fee_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_fee_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Entities
                                                   <select name="fee_entities" multiple>
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Fee Entities END -->
		<!-- VIEW Fee Charges -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Charges</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_charges" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_fee_charges').show(); else $('#view_fee_charges').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_fee_charges">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Charges
                                                   <select name="fee_charges" multiple>
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Fee Charges END -->
		<!-- VIEW Books -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Books</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_books" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_books').show(); else $('#view_books').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_books">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Library Books
                                                   <select name="books" multiple>
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Books END -->
		<!-- VIEW Book Categories -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Book Categories</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_book_categories" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#view_book_categories').show(); else $('#view_book_categories').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="view_book_categories">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Library Book Categories
                                                   <select name="book_categories" multiple>
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- VIEW Book Categories END -->
		</div>
      </div>
    </div>
  </div>
  
  <!-- EDIT START -->
   <!-- EDIT START -->
    <!-- EDIT START -->
	 <!-- EDIT START -->
	  <!-- EDIT START -->
  
  
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-warning collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Edit Permissions
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
	<p style="margin:10px;">The following sections allows you to assign the VIEW Rights of different entities of the whole school management software for the selected User.
	Leave selection for any enitity as blank under Customized option if you dont want to assign any rights of that particular entity to the user.</p><hr>
      <div class="card-body">
        <div id="EDIT">
	  <!-- EDIT Attendance Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Attendance Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_attendance_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_attendance_sections').show(); else $('#edit_attendance_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_attendance_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="attendance_sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Attendance Sections END -->
		<!-- EDIT Fill Marksheet Entity -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Marksheet Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_marksheet_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_marksheet_entities').show(); else $('#edit_marksheet_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_marksheet_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Marksheet Entities
                                                   <select name="marksheet_entities" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Fill Marksheet Entity END -->
		<!-- EDIT Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_sections').show(); else $('#edit_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Sections END -->
		<!-- EDIT Standards -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Standards</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_standards" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_standards').show(); else $('#edit_standards').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_standards">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="standards" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Standards END -->
		<!-- EDIT Students -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Students</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_students" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_students').show(); else $('#edit_students').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_students">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Students
                                                   <select name="students" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Students END -->
		<!-- EDIT Employees -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employees" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_employees').show(); else $('#edit_employees').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_employees">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Employees
                                                   <select name="employees" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Employees END -->
		<!-- EDIT EmployeesTypes -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employeesTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_employeesTypes').show(); else $('#edit_employeesTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_employeesTypes">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Employees Types
                                                   <select name="employeesTypes" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT EmployeesTypes END -->
		<!-- EDIT Evaluations -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluations" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_evaluations').show(); else $('#edit_evaluations').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_evaluations">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Evaluations
                                                   <select name="evaluations" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Evaluations END -->
		<!-- EDIT EvaluationEntities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluationEntities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_evaluationEntities').show(); else $('#edit_evaluationEntities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_evaluationEntities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Evaluations Entities
                                                   <select name="evaluationEntities" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT EvaluationEntities END -->
		<!-- EDIT Subjects -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subjects</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjects" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_subjects').show(); else $('#edit_subjects').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_subjects">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Subjects
                                                   <select name="subjects" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Subjects END -->
		<!-- EDIT Subjects Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subject Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjectTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_subjectTypes').show(); else $('#edit_subjectTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_subjectTypes">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Subject Types
                                                   <select name="subjectTypes" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Subjects Types END -->
		<!-- EDIT Admissions -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Admissions</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_admissions" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_admissions').show(); else $('#edit_admissions').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_admissions">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Admissions
                                                   <select name="admissions" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Admissions END -->
		<!-- EDIT Fee Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_types" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_fee_types').show(); else $('#edit_fee_types').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_fee_types">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Types
                                                   <select name="fee_types" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Fee Types END -->
		<!-- EDIT Fee Entities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_fee_entities').show(); else $('#edit_fee_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_fee_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Entities
                                                   <select name="fee_entities" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Fee Entities END -->
		<!-- EDIT Fee Charges -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Charges</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_charges" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_fee_charges').show(); else $('#edit_fee_charges').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_fee_charges">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Charges
                                                   <select name="fee_charges" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Fee Charges END -->
		<!-- EDIT Library Books -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Books</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_books" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_books').show(); else $('#edit_books').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_books">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Library Books
                                                   <select name="books" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Library Books END -->
		<!-- EDIT Library Book Categories -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Book Categories</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_book_categories" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#edit_book_categories').show(); else $('#edit_book_categories').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="edit_book_categories">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Library Book Categories
                                                   <select name="book_categories" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- EDIT Library Book Categories END -->
		</div>
      </div>
    </div>
  </div>
  
  <!-- ADD --->
   <!-- ADD --->
    <!-- ADD --->
	 <!-- ADD --->
	  <!-- ADD --->
  
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Add Permissions
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
	<p style="margin:10px;">The following sections allows you to assign the VIEW Rights of different entities of the whole school management software for the selected User.
	Leave selection for any enitity as blank under Customized option if you dont want to assign any rights of that particular entity to the user.</p><hr>
      <div class="card-body">
        <div id="ADD">
	  <!-- ADD Attendance Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Attendance Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_attendance_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_attendance_sections').show(); else $('#add_attendance_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="add_attendance_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="attendance_sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- ADD Attendance Sections END -->
		<!-- ADD Fill Marksheet Entity -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Marksheet Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_marksheet_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_marksheet_entities').show(); else $('#add_marksheet_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="add_marksheet_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Marksheet Entities
                                                   <select name="marksheet_entities" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- ADD Fill Marksheet Entity END -->
		<!-- ADD Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_sections').show(); else $('#add_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Sections END -->
		<!-- ADD Standards -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Standards</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_standards" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_standards').show(); else $('#add_standards').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Standards END -->
		<!-- ADD Students -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Students</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_students" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_students').show(); else $('#add_students').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Students END -->
		<!-- ADD Employees -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employees" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_employees').show(); else $('#add_employees').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Employees END -->
		<!-- ADD EmployeesTypes -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employeesTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_employeesTypes').show(); else $('#add_employeesTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>

		<hr>
		<!-- ADD EmployeesTypes END -->
		<!-- ADD Evaluations -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluations" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_evaluations').show(); else $('#add_evaluations').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>

		<hr>
		<!-- ADD Evaluations END -->
		<!-- ADD EvaluationEntities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluationEntities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_evaluationEntities').show(); else $('#add_evaluationEntities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD EvaluationEntities END -->
		<!-- ADD Subjects -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subjects</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjects" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_subjects').show(); else $('#add_subjects').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Subjects END -->
		<!-- ADD Subjects Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subject Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjectTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_subjectTypes').show(); else $('#add_subjectTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Subjects Types END -->
		<!-- ADD Admissions -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Admissions</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_admissions" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_admissions').show(); else $('#add_admissions').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Admissions END -->
		<!-- ADD Fee Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_types" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_fee_types').show(); else $('#add_fee_types').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Fee Types END -->
		<!-- ADD Fee Entities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_fee_entities').show(); else $('#add_fee_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Fee Entities END -->
		<!-- ADD Fee Charges -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Charges</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_charges" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_fee_charges').show(); else $('#add_fee_charges').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Fee Charges END -->
		<!-- ADD Library Books -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Books</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_books" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_books').show(); else $('#add_books').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Library Books END -->
		<!-- ADD Library Book Categories -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Book Categories</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_book_categories" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#add_books').show(); else $('#add_books').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
		<hr>
		<!-- ADD Library Book Categories END -->
		</div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Delete Permissions
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
	<p style="margin:10px;">The following sections allows you to assign the VIEW Rights of different entities of the whole school management software for the selected User.
	Leave selection for any enitity as blank under Customized option if you dont want to assign any rights of that particular entity to the user.</p><hr>
      <div class="card-body">
        <div id="DELETE">
	  <!-- DELETE Attendance Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Attendance Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_attendance_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_attendance_sections').show(); else $('#delete_attendance_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_attendance_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="attendance_sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Attendance Sections END -->
		<!-- DELETE Fill Marksheet Entity -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Marksheet Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_marksheet_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_marksheet_entities').show(); else $('#delete_marksheet_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_marksheet_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Marksheet Entities
                                                   <select name="marksheet_entities" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Fill Marksheet Entity END -->
		<!-- DELETE Sections -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Sections</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_sections" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_sections').show(); else $('#delete_sections').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_sections">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="sections" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Sections END -->
		<!-- DELETE Standards -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Standards</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_standards" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_standards').show(); else $('#delete_standards').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_standards">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Sections
                                                   <select name="standards" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Standards END -->
		<!-- DELETE Students -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Students</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_students" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_students').show(); else $('#delete_students').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_students">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Students
                                                   <select name="students" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Students END -->
		<!-- DELETE Employees -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employees" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_employees').show(); else $('#delete_employees').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_employees">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Employees
                                                   <select name="employees" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Employees END -->
		<!-- DELETE EmployeesTypes -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Employees Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_employeesTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_employeesTypes').show(); else $('#delete_employeesTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_employeesTypes">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Employees Types
                                                   <select name="employeesTypes" multiple>
												   
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE EmployeesTypes END -->
		<!-- DELETE Evaluations -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluations" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_evaluations').show(); else $('#delete_evaluations').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_evaluations">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Evaluations
                                                   <select name="evaluations" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Evaluations END -->
		<!-- DELETE EvaluationEntities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Evaluations Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_evaluationEntities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_evaluationEntities').show(); else $('#delete_evaluationEntities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_evaluationEntities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Evaluations Entities
                                                   <select name="evaluationEntities" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE EvaluationEntities END -->
		<!-- DELETE Subjects -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subjects</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjects" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_subjects').show(); else $('#delete_subjects').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_subjects">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Subjects
                                                   <select name="subjects" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Subjects END -->
		<!-- DELETE Subjects Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Subject Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_subjectTypes" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_subjectTypes').show(); else $('#delete_subjectTypes').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_subjectTypes">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Subject Types
                                                   <select name="subjectTypes" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Subjects Types END -->
		<!-- DELETE Admissions -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Admissions</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_admissions" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_admissions').show(); else $('#delete_admissions').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_admissions">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Admissions
                                                   <select name="admissions" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Admissions END -->
		<!-- DELETE Fee Types -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Types</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_types" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_fee_types').show(); else $('#delete_fee_types').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_fee_types">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Admissions
                                                   <select name="fee_types" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Fee Types END -->
		<!-- DELETE Fee Entities -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Entities</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_entities" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_fee_entities').show(); else $('#delete_fee_entities').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_fee_entities">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Entities
                                                   <select name="fee_entities" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Fee Entities END -->
		<!-- DELETE Fee Charges -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Charges</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_fee_charges" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_fee_charges').show(); else $('#delete_fee_charges').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_fee_charges">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Fee Charges
                                                   <select name="fee_charges" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Fee Charges END -->
		<!-- DELETE Library Books -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Books</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_books" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_books').show(); else $('#delete_books').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_books">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Library Books
                                                   <select name="books" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Library Books END -->
		<!-- DELETE Library Book Categories -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Library Book Categories</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="all_book_categories" type="checkbox" checked onchange="if($(this).prop('checked')==false) $('#delete_book_categories').show(); else $('#delete_book_categories').hide();"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All
        </div>
		</div>
			<div class="row form-group" style="display:none;" id="delete_book_categories">
                                                <div class="col-12 col-md-12">
												Leave Blank OR Choose Library Book Categories
                                                   <select name="book_categories" multiple>
													
												   </select>
                                                </div>
		</div>
		<hr>
		<!-- DELETE Library Book Categories END -->
		</div>
      </div>
    </div>
  </div>
    <div class="card">
    <div class="card-header" id="headingFive">
      <h5 class="mb-0">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Other Permissions
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
	<p style="margin:10px;">The following sections allows you to assign the VIEW Rights of different entities of the whole school management software for the selected User.
	Leave selection for any enitity as blank under Customized option if you dont want to assign any rights of that particular entity to the user.</p><hr>
      <div class="card-body">
        <div id="OTHER">
			<!-- OTHER Fee Collection -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Fee Collection</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Not Allowed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="fee_payment" type="checkbox" checked><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allowed
        </div>
		</div>
		<hr>
		<!-- OTHER Fee Collection END -->
		<!-- OTHER Roll Numbers Assignment -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Roll Numbers Assignment</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Not Allowed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="roll_numbers_assignment" type="checkbox" checked><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allowed
        </div>
		</div>
		<hr>
		<!-- OTHER Roll Numbers Assignment END -->
		<!-- OTHER Issue Books -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Issue Books</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Not Allowed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="issue_books" type="checkbox" checked><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allowed
        </div>
		</div>
		<hr>
		<!-- OTHER Issue Books END -->
		<!-- OTHER Return Books -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Return Books</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Not Allowed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="return_books" type="checkbox" checked><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allowed
        </div>
		</div>
		<hr>
		<!-- OTHER Return Books END -->
		<!-- OTHER Modify School Information -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Modify School Information</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Not Allowed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="school_information" type="checkbox" checked><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allowed
        </div>
		</div>
		<hr>
		<!-- OTHER Modify School Information END -->
		<!-- OTHER Change Web Interface Background -->
		<div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <h3>Change Web Interface Background</h3>
                                                </div>
		</div>
		<div  class="row form-group">
		<div class="col-12 col-md-12">
            Not Allowed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="change_background" type="checkbox" checked><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allowed
        </div>
		</div>
		<hr>
		<!-- OTHER Change Web Interface Background END -->
		</div>
      </div>
    </div>
  </div>
</div>
					</div>
			</div>
	</div>
</div>
<style>
.modal {
  z-index: 99999;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('body').append('<div id="loader" class="page-loader"><div class="page-loader__spin"></div></div>');
	setTimeout(function(){
		getRelations();
		setTimeout(function(){
			$('#loader').hide();
		},100);
	},4000);
	getAllStandards();
	getAllUsers();
	getAllTables();
	getAllSections();
	getAllStandards();
	getAllStudents();
	getAllEmployees();
	getAllEmployeesTypes();
	getAllEvaluations();
	getAllEvaluationEntities();
	getAllSubjects();
	getAllSubjectTypes();
	getAllAdmissions();
	getAllFeeTypes();
	getAllFeeEntities();
	getAllBooks();
	getAllBookCategories();
});
window.onmousedown = function (e) {
    var el = e.target;
    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
        e.preventDefault();

        // toggle selection
        if (el.hasAttribute('selected')) el.removeAttribute('selected');
        else el.setAttribute('selected', '');

        // hack to correct buggy behavior
        var select = el.parentNode.cloneNode(true);
        el.parentNode.parentNode.replaceChild(select, el.parentNode);
    }
}

function addNewStandard(){
var datay = $('#standardsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/standards",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#standardsTable').DataTable().ajax.reload();
			$('#standardsForm').trigger("reset");
			if(response[0].status==200) showToast(1,response[0].message);
			else showToast(0,response[0].message+"<br>Error(s): "+response[0].error);
	  },
	  error: function(data) {
			data = data.responseJSON;
			$('#mediumModal').modal('toggle');
			error = '';
			$.each(data.errors, function (i,v) {
				  error += "<li>"+i.replace(/_/g," ").ucwords()+" : "+v+"<br>";
				});
			showToast(0,data.message+'<br>Error(s): '+error);
	  }
});
}

function getAllUsers(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/users"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData;
		  $.each(data, function(key,value) {   
			$('select[name=users]')
				 .append($("<option></option>")
							.attr("value",value.username)
							.text(value.username)); 
			});
			$('select[name=users]').select2();
	  }
});
});
}

function getAllTables(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/tables"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData;
		  $.each(data, function(key,value) {   
			$('.tables')
				 .append($("<option></option>")
							.attr("value",value)
							.text(value)); 
			});
			$('.tables').select2();
	  }
});
});
}

function getAllSections(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/sections"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=sections]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.section_full_name+" ("+value.section_short_name+")")); 
			$('select[name=attendance_sections]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
			$('select[name=sections]').select2();
			$('select[name=attendance_sections]').select2();
	  }
});
});
}

function getAllStandards(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standards"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=standards]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
			});
			$('select[name=standards]').select2();
	  }
});
});
}

function getAllStudents(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/students"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=students]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.student_full_name+" ("+value.father_name+")")); 
			});
			$('select[name=students]').select2();
	  }
});
});
}

function getAllEmployees(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employees"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=employees]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.employee_full_name+" ("+value.ID+")")); 
			});
			$('select[name=employees]').select2();
	  }
});
});
}

function getAllEmployeesTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employeesTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=employeesTypes]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.type_name)); 
			});
			$('select[name=employeesTypes]').select2();
	  }
});
});
}

function getAllFeeTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/feeTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=fee_types]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.fee_full_name+"("+value.fee_for+")")); 
			});
			$('select[name=fee_types]').select2();
	  }
});
});
}

function getAllFeeEntities(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/feeEntities"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=fee_entities], select[name=fee_charges]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.fee_type_info)); 
			});
			$('select[name=fee_entities], select[name=fee_charges]').select2();
	  }
});
});
}

function getAllEvaluations(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/evaluations"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=evaluations]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.full_name+" ("+value.short_name+")")); 
			});
			$('select[name=evaluations]').select2();
	  }
});
});
}

function getAllEvaluationEntities(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/evaluationEntities"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=evaluationEntities]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.subject_info+" - "+value.evaluation_info)); 
			$('select[name=marksheet_entities]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.subject_info+" - "+value.evaluation_info)); 
			});
			$('select[name=evaluationEntities]').select2();
			$('select[name=marksheet_entities]').select2();
	  }
});
});
}

function getAllSubjects(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjects"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=subjects]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.subject_code+" | "+value.subject_full_name+" ("+value.subject_short_name+")")); 
			});
			$('select[name=subjects]').select2();
	  }
});
});
}

function getAllBooks(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/books"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=books]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.ID+" | "+value.book_name+" | "+value.book_authors+" ("+value.book_publisher+" - "+value.book_isbn+")")); 
			});
			$('select[name=books]').select2();
	  }
});
});
}

function getAllBookCategories(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/bookCategories"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=book_categories]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.ID+" | "+value.category_name)); 
			});
			$('select[name=book_categories]').select2();
	  }
});
});
}

function getAllSubjectTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjectTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=subjectTypes]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.type_full_name+" ("+value.type_short_name+")")); 
			});
			$('select[name=subjectTypes]').select2();
	  }
});
});
}

function getAllAdmissions(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjectTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('select[name=admissions]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.type_full_name+" ("+value.type_short_name+")")); 
			});
			$('select[name=admissions]').select2();
	  }
});
});
}

function saveRights(){
	mainRight = $('#userPermissions').prop('checked');
	if(mainRight==true) return {allRights:true , username: $('#users').val()};
	arr = ["attendance_sections","marksheet_entities","sections","standards","students","employees","employeesTypes","evaluations","evaluationEntities","subjects","subjectTypes","admissions","fee_types","fee_entities","fee_charges","books","book_categories"];
	finalArr = [];
	for(one in arr){
		value = arr[one];
		check = $('#VIEW #all_'+value).prop('checked');
		if(check) finalArr['VIEW_'+value] = "all";
		else finalArr['VIEW_'+value] = $('#VIEW select[name='+value+']').val().join(',');
	}
	for(one in arr){
		value = arr[one];
		check = $('#EDIT #all_'+value).prop('checked');
		if(check) finalArr['EDIT_'+value] = "all";
		else finalArr['EDIT_'+value] = $('#EDIT select[name='+value+']').val().join(',');
	}
	for(one in arr){
		value = arr[one];
		check = $('#DELETE #all_'+value).prop('checked');
		if(check) finalArr['DELETE_'+value] = "all";
		else finalArr['DELETE_'+value] = $('#DELETE select[name='+value+']').val().join(',');
	}
	for(one in arr){
		value = arr[one];
		check = $('#ADD #all_'+value).prop('checked');
		if(check) finalArr['ADD_'+value] = "allowed";
		else finalArr['ADD_'+value] = "";
		if(value=="attendance_sections" || value=="marksheet_entities"){
		check = $('#ADD #all_'+value).prop('checked');
		if(check) finalArr['ADD_'+value] = "all";
		else finalArr['ADD_'+value] = $('#ADD select[name='+value+']').val().join(',');
		}
		
	}
	finalArr['username'] = $('#users').val();
	
	//Fee Payment
	check = $('#OTHER #fee_payment').prop('checked');
	if(check) finalArr['OTHER_fee_payment'] = 'allowed';
	else finalArr['OTHER_fee_payment'] = '';
	
	//Roll Numbers Assignment
	check = $('#OTHER #roll_numbers_assignment').prop('checked');
	if(check) finalArr['OTHER_roll_numbers_assignment'] = 'allowed';
	else finalArr['OTHER_roll_numbers_assignment'] = '';
	
	//Issue Books
	check = $('#OTHER #issue_books').prop('checked');
	if(check) finalArr['OTHER_issue_books'] = 'allowed';
	else finalArr['OTHER_issue_books'] = '';
	
	//Return Books
	check = $('#OTHER #return_books').prop('checked');
	if(check) finalArr['OTHER_return_books'] = 'allowed';
	else finalArr['OTHER_return_books'] = '';
	
	//Modify School Information
	check = $('#OTHER #school_information').prop('checked');
	if(check) finalArr['OTHER_school_information'] = 'allowed';
	else finalArr['OTHER_school_information'] = '';
	
	//Change Background
	check = $('#OTHER #change_background').prop('checked');
	if(check) finalArr['OTHER_change_background'] = 'allowed';
	else finalArr['OTHER_change_background'] = '';
	
	return finalArr;
}

serialize = function(obj) {
	if(typeof(obj)!="object") return obj;
  var str = [];
  for (var p in obj)
    if (obj.hasOwnProperty(p)) {
      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    }
  return str.join("&");
}


function saveRelations(){
$.ajax({
	  contentType: 'application/json; charset=utf-8',
      dataType: 'json',
      type: 'GET',
	  data: serialize(saveRights()),
      url: "{{getHomeURL()}}/api/relations"+"?token="+$.cookie('token'),
      success: function(response) {
		if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function getRelations(){
$.ajax({
      type: 'GET',
	  data: {username: $('#users').val()},
      url: "{{getHomeURL()}}/api/getRelations"+"?token="+$.cookie('token'),
      success: function(response) {
		if(typeof response.data !== 'undefined'){
			if(response.data.allRights==true){
				$('#allPermissions').hide();
				$('#userPermissions').prop('checked',true);
				return;
			}
		}
		else{
		$('#allPermissions').show();
		$('#userPermissions').prop('checked',false);
		viewArr = [];
		editArr = [];
		addArr = [];
		deleteArr = [];
			$.each(response, function (key, value) {
				a = key.split('_')[0];
				b = key.split('_').slice(1).join('_');
				if(a=='VIEW'){
					if(value == 'all'){
						$('#VIEW #all_'+b).prop('checked',true);
						$('#view_'+b).hide();
					}
					else{
						$('#VIEW #all_'+b).prop('checked',false);
						$('#view_'+b).show();
						values = value.split(',');
						$.each(values, function(key,value){
							$('#VIEW select[name='+b+'] option[value="'+value+'"]').prop("selected", true);
							$('#VIEW select[name='+b+']').trigger('change.select2');
						})
					}
				}
				if(a=='EDIT'){
					if(value == 'all'){
						$('#EDIT #all_'+b).prop('checked',true);
						$('#edit_'+b).hide();
					}
					else{
						$('#EDIT #all_'+b).prop('checked',false);
						$('#edit_'+b).show();
						values = value.split(',');
						$.each(values, function(key,value){
							$('#EDIT select[name='+b+'] option[value="'+value+'"]').prop("selected", true);
							$('#EDIT select[name='+b+']').trigger('change.select2');
						})
					}
				}
				if(a=='DELETE'){
					if(value == 'all'){
						$('#DELETE #all_'+b).prop('checked',true);
						$('#delete_'+b).hide();
					}
					else{
						$('#DELETE #all_'+b).prop('checked',false);
						$('#delete_'+b).show();
						values = value.split(',');
						$.each(values, function(key,value){
							$('#DELETE select[name='+b+'] option[value="'+value+'"]').prop("selected", true);
							$('#DELETE select[name='+b+']').trigger('change.select2');
						})
					}
				}
				if(a=='ADD'){
					if(value == 'allowed'){
						$('#ADD #all_'+b).prop('checked',true);
					}
					else{
						$('#ADD #all_'+b).prop('checked',false);
					}
				}
				if(a=='OTHER'){
					if(value == 'allowed'){
						$('#OTHER #'+b).prop('checked',true);
					}
					else{
						$('#OTHER #'+b).prop('checked',false);
					}
				}
			});
		}
		if(response.status==201) showToast(0,response.message+"<br>Error(s): "+response.error);
		else showToast(1,'Rights Fetched Successfully.');
	  }
});
}
</script>
<style>
#saveRelations{
	position: fixed;
	z-index: 9999999;
	bottom: 20px;
	right: 40px;
}
</style>
@include('home.footer')