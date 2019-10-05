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
        New BookCategory Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="fas fa-book"></i>Book Categories<button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Book Category</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="BookCategoryTable">
                                            <thead>
                                                <tr>
													<th>ID</th>
                                                    <th>Category Name</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
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
</script>
<!-- Modal -->
<div class="modal fade" id="mediumModal" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Book Category</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="BookCategoryForm">
						<input type="hidden" name="ID" id="BookCategory_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Category Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="category_name" class="form-control">
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
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewBookCategory()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#BookCategoryForm').closest('form').find("input").val("");
		$('#BookCategoryForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Book Category');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('#editConfirm').attr('onclick','addNewBookCategory();');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#BookCategory_id").val(id);
		$('#modalTitle').text('Edit Book Category');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editBookCategory('+id+');');
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

function addNewBookCategory(){
var datay = $('#BookCategoryForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/bookCategories",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#BookCategoryTable').DataTable().ajax.reload();
			$('#BookCategoryForm').trigger("reset");
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

function getAllBookCategories(){
$(document).ready(function(){
	 $('#BookCategoryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/bookCategories'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'category_name'},
			{data: 'description'},
			{data: 'comments'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteBookCategory('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/bookCategories/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('BookCategoryForm');
		  ehWaliLength = form.elements.length;
		  for(var i=0; i < ehWaliLength; i++){
				var e = form.elements[i];
				try{$('input[name='+e.name+']').val(response[0][e.name]);}catch(ex){}
				try{$('select[name='+e.name+']').val(response[0][e.name]);}catch(ex){}
				try{$('textarea[name='+e.name+']').text(response[0][e.name]);}catch(ex){}
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteBookCategory(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/bookCategories/"+id+"?token="+$.cookie('token'),
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#BookCategoryTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editBookCategory(id){
var datay = $('#BookCategoryForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/bookCategories/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#BookCategoryTable').DataTable().ajax.reload();
			$('#BookCategoryForm').trigger("reset");
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