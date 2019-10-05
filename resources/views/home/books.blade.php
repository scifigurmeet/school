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
        New Book Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="fas fa-book"></i>Books<button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Book</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="BookTable">
                                            <thead>
                                                <tr>
													<th>ID</th>
                                                    <th>Book Name</th>
                                                    <th>Authors(s)</th>
                                                    <th>ISBN</th>
                                                    <th>Category</th>
                                                    <th>Publisher</th>
                                                    <th>Quantity</th>
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
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllBooks();
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
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Book Book</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="BookForm">
						<input type="hidden" name="ID" id="Book_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Book Categories</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select id="book_categories_array" multiple>
													</select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Book Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="book_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Author(s)</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="book_authors" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">ISBN</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="book_isbn" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Publisher</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="book_publisher" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Quantity</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="number" id="hf-password" name="quantity" class="form-control" min="0">
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
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewBook()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#BookForm').closest('form').find("input").val("");
		$('#BookForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Book');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('#editConfirm').attr('onclick','addNewBook();');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#Book_id").val(id);
		$('#modalTitle').text('Edit Book');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editBook('+id+');');
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

function getAllBookCategories(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/bookCategories"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('#book_categories_array')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.ID+" | "+value.category_name)); 
			});
	  }
});
});
}

function addNewBook(){
var datay = $('#BookForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
datay.push({name: 'book_categories', value: $('#book_categories_array').val().join(',')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/books",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#BookTable').DataTable().ajax.reload();
			$('#BookForm').trigger("reset");
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

function getAllBooks(){
$(document).ready(function(){
	 $('#BookTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/books'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'book_name'},
            {data: 'book_authors'},
            {data: 'book_isbn'},
            {data: 'book_categories'},
			{data: 'book_publisher'},
			{data: 'quantity'},
			{data: 'description'},
			{data: 'comments'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteBook('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/books/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  
		  form = document.getElementById('BookForm');
		  ehWaliLength = form.elements.length;
		  for(var i=0; i < ehWaliLength; i++){
				var e = form.elements[i];
				try{$('input[name='+e.name+']').val(response[0][e.name]);}catch(ex){}
				try{$('select[name='+e.name+']').val(response[0][e.name]);}catch(ex){}
				try{$('textarea[name='+e.name+']').text(response[0][e.name]);}catch(ex){}
			}
			categories = response[0].book_categories.split(',');
			$.each(categories,function(key,value){
				$('#book_categories_array option[value='+value+']').attr('selected','selected');
			});
			$('#book_categories_array').trigger('change.select2');
		$('#mediumModal').modal('show');
	  }
});
}

function deleteBook(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/books/"+id+"?token="+$.cookie('token'),
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#BookTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editBook(id){
var datay = $('#BookForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/books/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#BookTable').DataTable().ajax.reload();
			$('#BookForm').trigger("reset");
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