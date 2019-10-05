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
        New Student Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Students <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Student</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="studentsTable">
                                            <thead>
                                                <tr>
                                                    <th>School Roll No.</th>
                                                    <th>Section Roll No.</th>
                                                    <th>Full Name</th>
                                                    <th>Gender</th>
                                                    <th>Standard (Section)</th>
                                                    <th>Date of Birth</th>
                                                    <th>Father's Name</th>
                                                    <th>Mother's Name</th>
                                                    <th>Guardian's Name</th>
                                                    <th>Father Mobile</th>
                                                    <th>Mother Mobile</th>
                                                    <th>Guardian Mobile</th>
                                                    <th>Admission No.</th>
                                                    <th>Home Address</th>
                                                    <th>Landline Contact</th>
                                                    <th>Aadhar No.</th>
													<th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllStudents();
	getAllStandards();
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

function getAllStandards(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standards?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=standard_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
			});
	  }
});
});
}

function getAllSectionsByStandard(standard_id){
	$('select[name=section_id]').find('option').remove().end();
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/sectionsByStandard/"+standard_id+"?token="+$.cookie('token'),
      success: function(resultData) {
		  $("select[name=section_id]").prop("disabled", false);
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=section_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
	  }
});
});
}
</script>
<!-- Modal -->
<div class="modal fade" id="mediumModal" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Student</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="studentsForm">
						@csrf
						<input type="hidden" name="ID" id="student_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Admission Number</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="admission_no" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Standard</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="standard_id" class="form-control" onchange="getAllSectionsByStandard(this.value);">
													<option selected disabled>Choose Standard...</option>
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Section</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="section_id" class="form-control" disabled></select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">First Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="student_first_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Last Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="student_last_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Gender</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="gender">
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="Others">Others</option>
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Date of Birth</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="date" id="hf-password" name="dob" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Aadhar Number</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="aadhar_no" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Father Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="father_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Mother Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="mother_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Home Address</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="home_address" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Landline Contact</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="landline_contact" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Guardian Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="guardian_full_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Father's Mobile</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="father_mobile" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Mother's Mobile</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="mother_mobile" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Guardian's Mobile</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="guardian_mobile" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Description</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Comments</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <textarea class="form-control" name="comments"></textarea>
                                                </div>
                                                
                            </div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewStudent()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#studentsForm').closest('form').find("input").val("");
		$('#studentsForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Student');
		$('#modal-icon').removeClass();
		$('#editConfirm').attr('onclick','addNewStudent();');
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#student_id").val(id);
		$('#modalTitle').text('Edit Student');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editStudent('+id+');');
		$('#mediumModal').modal('show');
}

function viewModal(id){
		viewForm(id);
		$('#modalTitle').text('Information View');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-eye');
		$('.modal-footer').hide();
}

function addNewStudent(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/students?token="+$.cookie('token'),
	  data: $('#studentsForm').serialize(),
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#studentsTable').DataTable().ajax.reload();
			$('#studentsForm').trigger("reset");
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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

function getAllStudents(){
$(document).ready(function(){
	 $('#studentsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/students?token='+$.cookie('token'),
		columns: [
            {data: 'school_roll_no'},
            {data: 'section_roll_no'},
            {data: 'student_full_name'},
            {data: 'gender'},
            {data: 'standard_section_full_name'},
			{data: 'dob'},
			{data: 'father_name'},
			{data: 'mother_name'},
			{data: 'guardian_full_name'},
			{data: 'father_mobile'},
			{data: 'mother_mobile'},
			{data: 'guardian_mobile'},
			{data: 'admission_no'},
			{data: 'home_address'},
			{data: 'landline_contact'},
			{data: 'aadhar_no'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteStudent('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/students/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('studentsForm');
		  for(var i=0; i < form.elements.length; i++){
				var e = form.elements[i];
				$('input[name='+e.name+']').val(response.data[e.name]);
				$('select[name='+e.name+']').val(response.data[e.name]);
				$('select[name='+e.name+']').trigger('change.select2');
				$('textarea[name='+e.name+']').text(response.data[e.name]);
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteStudent(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/students/"+id+"?token="+$.cookie('token'),
	  data: {
        "_token": '@csrf'
        },
      success: function(response) {
		  $('#studentsTable').DataTable().ajax.reload();
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
}

function editStudent(id){
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/students/"+id+"?token="+$.cookie('token'),
	  data: $('#studentsForm').serialize(),
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#studentsTable').DataTable().ajax.reload();
			$('#studentsForm').trigger("reset");
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
</script>
@include('home.footer')