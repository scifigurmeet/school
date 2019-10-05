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
        New User Account Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>User Accounts <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Create New User Account</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="UserAccountsTable">
                                            <thead>
                                                <tr>
													<th>User ID</th>
													<th>Username</th>
													<th>User Type</th>
													<th>User Type ID</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllUsers();
	getAllStudents();
	getAllUserAccounts();
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
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New User Account</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="UserAccountsForm">
						<input type="hidden" name="ID" id="UserAccount_id">
							<div class="row form-group" id="username">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Choose Username</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="username" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Choose Password</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="password" id="hf-password" name="password" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group" id="userType">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">User Type</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="userType" onchange="if($(this).val() == 'student'){$('#student').show();$('#employee').hide();}else{$('#student').hide();$('#employee').show();};">
														<option value="student">Student</option>
														<option value="employee">Employee</option>
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group" id="student">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Choose Student</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select id="student_id">
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group" id="employee">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Choose Employee</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select id="employee_id">
													</select>
                                                </div>
                                                
                            </div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewUserAccount()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function getAllStudents(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/students"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#student_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text("ID: "+value.ID+" | "+value.student_full_name+" ("+value.father_name+") | "+value.standard_section_full_name)); 
			});
			$('#student_id').select2();
	  }
});
});
}

function getAllUserAccounts(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employees"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#employee_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text("ID: "+value.ID+" | "+value.employee_full_name+" ("+value.type_name+")")); 
			});
			$('#employee_id').select2();
	  }
});
});
}

function addNewModal(){
		if($('select[name=userType]').val() == 'student'){$('#student').show();$('#employee').hide();}else{$('#student').hide();$('#employee').show();};
		$('#userType').show();
		$('#username').show();
		$('#UserAccountsForm').closest('form').find("input").val("");
		$('#UserAccountsForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New User Account');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('#editConfirm').attr('onclick','addNewUserAccount();');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#UserAccount_id").val(id);
		$('#employee').hide();
		$('#username').hide();
		$('#student').hide();
		$('#userType').hide();
		$('#modalTitle').text('Change User Account Password');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editUserAccount('+id+');');
		$('#mediumModal').modal('show');
}

function viewModal(id){
		$('#employee').show();
		$('#student').show();
		$('#userType').show();
		viewForm(id);
		$('#modalTitle').text('Information View');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-eye');
		$('.modal-footer').hide();
}

function addNewUserAccount(){
	userType = $('select[name=userType]').val();
	if($('select[name=userType]').val()=='student') userTypeID = $('#student_id').val();
	if($('select[name=userType]').val()=='employee') userTypeID = $('#employee_id').val();
var datay = $('#UserAccountsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
datay.push({name: 'userType', value: userType});
datay.push({name: 'userTypeID', value: userTypeID});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/userAccounts",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#UserAccountsTable').DataTable().ajax.reload();
			$('#UserAccountsForm').trigger("reset");
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

function getAllUsers(){
$(document).ready(function(){
	 $('#UserAccountsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/userAccounts'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'username'},
            {data: 'userType'},
            {data: 'type_ID'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Change Password <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteUserAccount('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}



function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employees/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('UserAccountsForm');
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

function deleteUserAccount(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/userAccounts/"+id+"?token="+$.cookie('token'),
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#UserAccountsTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editUserAccount(id){
var datay = $('#UserAccountsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/userAccounts/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#UserAccountsTable').DataTable().ajax.reload();
			$('#UserAccountsForm').trigger("reset");
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