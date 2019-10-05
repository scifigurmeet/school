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
        New Subject Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Subjects <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Subject</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="subjectsTable">
                                            <thead>
                                                <tr>
                                                    <th>Subject Code</th>
                                                    <th>Subject Full Name</th>
                                                    <th>Subject Short Name</th>
                                                    <th>Subject Type</th>
													<th>Subject Incharge</th>
													<th>Standard</th>
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
	getAllSubjects();
	getAllEmployees();
	getAllSubjectsTypes();
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
</script>
<!-- Modal -->
<div class="modal fade" id="mediumModal" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Subject</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="subjectsForm">
						@csrf
						<input type="hidden" name="ID" id="subject_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Full Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="subject_full_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Short Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="subject_short_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Code</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="subject_code" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Type</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="subject_type_id" class="form-control"></select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Incharge</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select class="form-control" name="subject_incharge_id">
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Standard</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="standard_id" class="form-control"></select>
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
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewSubject()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#subjectsForm').closest('form').find("input").val("");
		$('#subjectsForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Subject');
		$('#modal-icon').removeClass();
		$('#editConfirm').attr('onclick','addNewSubject();');
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#subject_id").val(id);
		$('#modalTitle').text('Edit Subject');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editSubject('+id+');');
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

function addNewSubject(){
var datax = $('#subjectsForm').serializeArray();
datax.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/subjects",
	  data: datax,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#subjectsTable').DataTable().ajax.reload();
			$('#subjectsForm').trigger("reset");
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

function getAllSubjectsTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjectTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=subject_type_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.type_full_name+" ("+value.type_short_name+")")); 
			});
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
			$('select[name=subject_incharge_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.first_name+" "+value.last_name)); 
			});
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
			$('select[name=standard_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" "+value.standard_short_name)); 
			});
	  }
});
});
}

function getAllSubjects(){
$(document).ready(function(){
	 $('#subjectsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/subjects'+"?token="+$.cookie('token'),
		columns: [
            {data: 'subject_code'},
            {data: 'subject_full_name'},
            {data: 'subject_short_name'},
			{render: function(data, type, row){
				return row.type_full_name+' '+row.type_short_name+' ('+row.subject_type_id+')';
			}},
			{render: function(data, type, row){
				return row.first_name+' '+row.last_name+' ('+row.subject_incharge_id+')';
			}},
			{data: 'standard_id'},
			{data: 'description'},
			{data: 'comments'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteSubject('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjects/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  form = document.getElementById('subjectsForm');
		  for(var i=0; i < form.elements.length; i++){
				var e = form.elements[i];
				$('input[name='+e.name+']').val(response[0][e.name]);
				$('select[name='+e.name+']').val(response[0][e.name]);
				$('textarea[name='+e.name+']').text(response[0][e.name]);
				if(i==(form.elements.length-1)) $('select').trigger('change.select2');
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteSubject(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/subjects/"+id,
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#subjectsTable').DataTable().ajax.reload();
		if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
}

function editSubject(id){
var datax = $('#subjectsForm').serializeArray();
datax.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/subjects/"+id,
	  data: datax,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#subjectsTable').DataTable().ajax.reload();
			$('#subjectsForm').trigger("reset");
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