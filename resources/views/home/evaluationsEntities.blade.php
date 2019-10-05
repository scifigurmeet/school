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
                                        <i class="zmdi zmdi-account-calendar"></i>Evaluations <a href="evaluationsManager" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>Add New Evaluation</a></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="evaluationsTable">
                                            <thead>
                                                <tr>
                                                    <th>Entity ID</th>
                                                    <th>Evaluation Full Name (Short Name)</th>
                                                    <th>Standard Full Name (Short Name)</th>
                                                    <th>Subject Code | Full Name (Short Name)</th>
                                                    <th>Evaluation Method</th>
                                                    <th>Maximum Marks</th>
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
      url: "{{getHomeURL()}}/api/standards",
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
		window.location.replace("{{getHomeURL()}}/evaluationsManager?edit="+id);
}

function viewModal(id){
		viewForm(id);
		$('#modalTitle').text('Information View');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-eye');
		$('.modal-footer').hide();
}

function getAllEvaluations(){
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/evaluationEntities?token='+$.cookie('token'),
		columns: [
            {data: 'ID'},
            {data: 'evaluation_info'},
            {data: 'standard_info'},
            {data: 'subject_info'},
            {render: function(data,type,row){
				if(row.evaluation_method==1){
					return '<strong>METHOD 1:</strong> Total Marks Only';
				}
				if(row.evaluation_method==2){
					return '<strong>METHOD 2:</strong> Marks For Each Question';
				}
			}},
            {data: 'maximum_marks'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteEvaluation('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}


function deleteEvaluation(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/evaluationEntities/"+id,
	  data: {
        "token": $.cookie('token')
        },
      success: function(response) {
		  $('#evaluationsTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
}
</script>
@include('home.footer')