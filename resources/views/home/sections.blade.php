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
        New Section Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Sections <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Section</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="SectionsTable">
                                            <thead>
                                                <tr>
													<th>Standard Name</th>
                                                    <th>Section Full Name</th>
                                                    <th>Section Short Name</th>
                                                    <th>Section Code</th>
                                                    <th>Section Incharge</th>
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
	getAllSections();
	getAllEmployees();
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

function getAllEmployees(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employees"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=section_incharge_id]')
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
			$('select[name=standard_ID]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
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
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Section</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="SectionsForm">
						@csrf
						<input type="hidden" name="ID" id="Section_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Choose Section</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select class="form-control" name="standard_ID">
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Section Full Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="section_full_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Section Short Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="section_short_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Section Code</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="section_code" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Section Incharge</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select class="form-control" name="section_incharge_id">
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Description</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <textarea class="form-control" name="section_description"></textarea>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Comments</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <textarea class="form-control" name="section_comments"></textarea>
                                                </div>
                                                
                            </div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewSection()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#SectionsForm').closest('form').find("input").val("");
		$('#SectionsForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Section');
		$('#modal-icon').removeClass();
		$('#editConfirm').attr('onclick','addNewSection();');
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#Section_id").val(id);
		$('#modalTitle').text('Edit Section');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editSection('+id+');');
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

function addNewSection(){
var datax = $('#SectionsForm').serializeArray();
datax.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/sections",
	  data: datax,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#SectionsTable').DataTable().ajax.reload();
			$('#SectionsForm').trigger("reset");
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

function getAllSections(){
$(document).ready(function(){
	 $('#SectionsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/sections?token='+$.cookie('token'),
		columns: [
			{render: function(data, type, row){
				return row.standard_short_name+" ("+row.standard_full_name+")<br>"+row.standard_code;
			}},
            {data: 'section_full_name'},
            {data: 'section_short_name'},
            {data: 'section_code'},
			{render: function(data, type, row){
				return row.first_name+" "+row.last_name+" ("+row.section_incharge_id+")";
			}},
			{data: 'section_description'},
			{data: 'section_comments'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteSection('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/sections/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('SectionsForm');
		  for(var i=0; i < form.elements.length; i++){
				var e = form.elements[i];
				$('input[name='+e.name+']').val(response[0][e.name]);
				$('select[name='+e.name+']').val(response[0][e.name]);
				$('select[name='+e.name+']').trigger('change.select2');
				$('textarea[name='+e.name+']').text(response[0][e.name]);
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteSection(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/sections/"+id,
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#SectionsTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editSection(id){
var datay = $('#SectionsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/sections/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#SectionsTable').DataTable().ajax.reload();
			$('#SectionsForm').trigger("reset");
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