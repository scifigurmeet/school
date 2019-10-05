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
        New Evaluation Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Evaluations <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Evaluation</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="evaluationsTable">
                                            <thead>
                                                <tr>
                                                    <th>Evaluation ID</th>
                                                    <th>Evaluation Full Name</th>
                                                    <th>Evaluation Short Name</th>
                                                    <th>Standards Involved</th>
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
	getAllEvaluations();
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
      url: "{{getHomeURL()}}/api/standards"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#standards_involved')
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
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Evaluation</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="evaluationsForm">
						<input type="hidden" name="ID" id="evaluation_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Evaluation Full Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="full_name" name="full_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Evaluation Short Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="short_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Standards Involved</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select id="standards_involved" name="standards_involved[]" multiple>
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
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewEvaluation()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#evaluationsForm').closest('form').find("input").val("");
		$('#evaluationsForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Evaluation');
		$('#modal-icon').removeClass();
		$('#editConfirm').attr('onclick','addNewEvaluation();');
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#evaluation_id").val(id);
		$('#modalTitle').text('Edit Evaluation');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editEvaluation('+id+');');
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

function addNewEvaluation(){
var datay = $('#evaluationsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/evaluations",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#evaluationsTable').DataTable().ajax.reload();
			$('#evaluationsForm').trigger("reset");
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

function getAllEvaluations(){
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/evaluations'+"?token="+$.cookie('token'),
		columns: [
            {data: 'ID'},
            {data: 'full_name'},
            {data: 'short_name'},
            {data: 'standards_involved_names'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteEvaluation('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/evaluations/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  $('input[name=full_name]').val(response['full_name']);
		  $('input[name=short_name]').val(response['short_name']);
		  $('textarea[name=comments]').html(response['comments']);
		  $('textarea[name=description]').html(response['description']);

			$("#standards_involved option:selected").prop("selected", false);
		  var result = response['standards_involved'];
					results = result.split(',');
					var vals = $("#standards_involved").val();
					for(var i=0;i<results.length;i++){
						vals.push(results[i]);
					}
					$("#standards_involved").val(vals);
					$('#standards_involved').trigger('change.select2');
		$('#mediumModal').modal('show');
	  }
});
}

function deleteEvaluation(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/evaluations/"+id,
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#evaluationsTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editEvaluation(id){
var datay = $('#evaluationsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/evaluations/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#evaluationsTable').DataTable().ajax.reload();
			$('#evaluationsForm').trigger("reset");
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