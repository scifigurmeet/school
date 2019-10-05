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
                                        <i class="zmdi zmdi-account-calendar"></i>Fee Types <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Fee Type</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="FeeTypesTable">
                                            <thead>
                                                <tr>
													<th>Fee Type ID</th>
                                                    <th>Fee Full Name</th>
													<th>Fee For</th>
													<th>Fee Description</th>
													<th>Fee Wise</th>
													<th>Fee Sections</th>
													<th>Fee Standards</th>
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
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllFeeTypes();
	buttonsLogic($('select[name=fee_wise]').val());
	getAllSections();
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
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add New Fee Type</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="FeeTypesForm">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Fee Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" name="fee_full_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Fee For</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" name="fee_for" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Fee Description</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" name="fee_description" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Fee Wise</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="fee_wise" onchange="buttonsLogic(this.value)">
													<option name="sections" value="sections">Sections</option>
													<option name="standards" value="standards">Standards</option>
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group" id="sections">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Fee Sections</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select class="form-control" name="fee_sections" multiple></select>
                                                </div>
                                                
                            </div>
							<div class="row form-group" id="standards">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Fee Standards</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select name="fee_standards" multiple>
													</select>
                                                </div>
                                                
                            </div>
							<script>
								function buttonsLogic(value){
									if(value=='sections'){
										$('#sections').show();
										$('#standards').hide();
									}
									if(value=='standards'){
										$('#sections').hide();
										$('#standards').show();
									}
								}
							</script>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewFeeType()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#FeeTypesForm').closest('form').find("input").val("");
		$('#FeeTypesForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Employee Type');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#editConfirm').attr('onclick','addNewFeeType();');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#Employee_id").val(id);
		$('#modalTitle').text('Edit Employee Type');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editFeeType('+id+');');
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

function getAllSections(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/sections"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=fee_sections]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
			$('select[name=fee_sections]').select2({
			 dropdownParent: $('#mediumModal')
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
			$('select[name=fee_standards]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
			});
			$('select[name=fee_standards]').select2({
			 dropdownParent: $('#mediumModal')
			});
	  }
});
});
}

function addNewFeeType(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/feeTypes?token="+$.cookie('token'),
	  data: {
		  fee_full_name: $('input[name=fee_full_name]').val(),
		  fee_for: $('input[name=fee_for]').val(),
		  fee_description: $('input[name=fee_description]').val(),
		  fee_wise: $('select[name=fee_wise]').val(),
		  fee_sections: $('select[name=fee_sections]').val().join(','),
		  fee_standards: $('select[name=fee_standards]').val().join(',')
	  },
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#FeeTypesTable').DataTable().ajax.reload();
			$('#FeeTypesForm').trigger("reset");
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

function getAllFeeTypes(){
$(document).ready(function(){
	 $('#FeeTypesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/feeTypes'+"?token="+$.cookie('token'),
		columns: [
            {data: 'ID'},
            {data: 'fee_full_name'},
            {data: 'fee_for'},
            {data: 'fee_description'},
            {data: 'fee_wise'},
            {data: 'sections_involved_names'},
            {data: 'standards_involved_names'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteFeeType('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/feeTypes/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('FeeTypesForm');
		  for(var i=0; i < form.elements.length; i++){
				var e = form.elements[i];
				try{
				$('input[name='+e.name+']').val(response[0][e.name]);
				}
				catch(Exception){}
				try{
				$('select[name='+e.name+']').val(response[0][e.name]);
				$('select[name='+e.name+']').trigger('change.select2');}
				catch(Exception){}
				try{
				$('textarea[name='+e.name+']').text(response[0][e.name]);}
				catch(Exception){}
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteFeeType(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/feeTypes/"+id,
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#FeeTypesTable').DataTable().ajax.reload();
		 if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editFeeType(id){
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/feeTypes/"+id+"?token="+$.cookie('token'),
	  data: {
		  fee_full_name: $('input[name=fee_full_name]').val(),
		  fee_for: $('input[name=fee_for]').val(),
		  fee_description: $('input[name=fee_description]').val(),
		  fee_wise: $('select[name=fee_wise]').val(),
		  fee_sections: $('select[name=fee_sections]').val().join(','),
		  fee_standards: $('select[name=fee_standards]').val().join(',')
	  },
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#FeeTypesTable').DataTable().ajax.reload();
			$('#FeeTypesForm').trigger("reset");
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