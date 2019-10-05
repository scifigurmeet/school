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
        New Employee Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Employees <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Employee</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="EmployeesTable">
                                            <thead>
                                                <tr>
													<th>Employee ID</th>
                                                    <th>Full Name</th>
                                                    <th>Type</th>
                                                    <th>Mobile Number</th>
                                                    <th>Date of Birth</th>
													<th>Email</th>
													<th>Description</th>
													<th>Comments</th>
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
<script>
function addData(){
jQuery.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/newAdmission",
      data: jQuery("#new-admission").serialize(),
      success: function(response) { alert(response); }
});
}
</script>
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
	getAllEmployees();
	getAllEmployeesTypes();
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
</script>
<!-- Modal -->
<div class="modal fade" id="mediumModal" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Employee</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="EmployeesForm">
						@csrf
						<input type="hidden" name="ID" id="Employee_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">First Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="first_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Last Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="last_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Mobile Number</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="mobile_no" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Description</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="email" id="hf-password" name="email" class="form-control">
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
                                                    <label for="hf-password" class=" form-control-label">Type</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select class="form-control" name="type">
													</select>
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
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewEmployee()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#EmployeesForm').closest('form').find("input").val("");
		$('#EmployeesForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Employee');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('#editConfirm').attr('onclick','addNewEmployee();');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#Employee_id").val(id);
		$('#modalTitle').text('Edit Employee');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editEmployee('+id+');');
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

function addNewEmployee(){
var datay = $('#EmployeesForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/employees",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#EmployeesTable').DataTable().ajax.reload();
			$('#EmployeesForm').trigger("reset");
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+"<br>Error(s): "+response.error);
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

function getAllEmployeesTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employeesTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=type]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.type_name)); 
			});
	  }
});
});
}

function getAllEmployees(){
$(document).ready(function(){
	 $('#EmployeesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/employees'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'employee_full_name'},
            {data: 'type_name'},
            {data: 'mobile_no'},
            {data: 'dob'},
			{data: 'email'},
			{data: 'description'},
			{data: 'comments'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteEmployee('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employees/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('EmployeesForm');
		  for(var i=0; i < form.elements.length; i++){
				var e = form.elements[i];
				$('input[name='+e.name+']').val(response[0][e.name]);
				$('select[name='+e.name+']').val(response[0][e.name]);
				$('textarea[name='+e.name+']').text(response[0][e.name]);
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteEmployee(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/employees/"+id+"?token="+$.cookie('token'),
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#EmployeesTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editEmployee(id){
var datay = $('#EmployeesForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/employees/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#EmployeesTable').DataTable().ajax.reload();
			$('#EmployeesForm').trigger("reset");
			if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
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