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
        New Fee Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Fee <a href="feeManager" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>Add New Fee</a></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="evaluationsTable">
                                            <thead>
                                                <tr>
                                                    <th>Entity ID</th>
                                                    <th>Fee Type</th>
                                                    <th>Fee Method</th>
                                                    <th>Fee Maximum Amount</th>
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
	getAllFeeEntities();
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

<script>
function editModal(id){
		window.location.replace("{{getHomeURL()}}/feeManager?edit="+id);
}


function getAllFeeEntities(){
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/feeEntities/?token='+$.cookie('token'),
		columns: [
            {data: 'ID'},
            {data: 'fee_type_info'},
            {render: function(data,type,row){
				if(row.fee_method==1){
					return '<strong>METHOD 1:</strong> Total Fees Only';
				}
				if(row.fee_method==2){
					return '<strong>METHOD 2:</strong> Fees with All Charges Explained';
				}
			}},
            {data: 'fee_max_amount'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteFee('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}


function deleteFee(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/feeManager/"+id,
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