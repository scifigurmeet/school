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
                                        <i class="fas fa-book"></i>Issued Books<button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Issue A Book</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="IssuedBookTable">
                                            <thead>
                                                <tr>
													<th>Issue ID</th>
                                                    <th>Book Name</th>
                                                    <th>Authors(s)</th>
                                                    <th>ISBN</th>
                                                    <th>Publisher</th>
													<th>Student Details</th>
													<th>Status</th>
													<th>Return Date</th>
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
	getAllIssuedBooks();
	getAllBooks();
	getAllStudents();
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
                                                    <label for="hf-password" class=" form-control-label">Book ID</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select id="book_id"></select>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Student ID</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <select id="student_id"></select>
                                                </div>
                                                
                            </div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="issueBook();">Confirm <i class="fas fa-check-circle"></i></button>
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
		$('#editConfirm').attr('onclick','issueBook();');
		$('.modal-footer').show();
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

function getAllIssuedBooks(){
$(document).ready(function(){
	 $('#IssuedBookTable').DataTable({
		order: [[ 6, "ASC" ]],
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/issuedBooks'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'book_name'},
            {data: 'book_authors'},
            {data: 'book_isbn'},
			{data: 'book_publisher'},
			{data: 'student_details'},
			{data: 'status'},
			{data: 'return_date'},
			{render: function(data, type, row){
				if(row.status=='ISSUED')
				return '<div class="btn btn-danger" onclick="returnBook('+row.ID+')">Return &nbsp;<i class="fas fa-undo"></i><div>';
				if(row.status=='RETURNED')
				return '<div class="alert alert-success" disabled>Returned <i class="fas fa-check-circle"></i><div>';
			}}
        ]
    });
});
}

function getAllBooks(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/books"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#book_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.ID+" | "+value.book_name+" | "+value.book_authors+" | "+value.book_publisher+" | "+value.book_isbn)); 
			});
	  }
});
});
}

function returnBook(id){
	if(!confirm('You are about to mark this Book as returned? Are you sure?')) return;
	$(document).ready(function(){
	 $.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/returnBook/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  $('#IssuedBookTable').DataTable().ajax.reload();
		   if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
});
}

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
							.text(value.ID+" | "+value.student_full_name+" ("+value.father_name+")"+" | "+value.standard_section_full_name+" | School Roll No. "+value.school_roll_no+" | Section Roll No. "+value.section_roll_no)); 
			});
	  }
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
				try{$('#'+e.name).val(response[0][e.name]);}catch(ex){}
				try{$('#'+e.name).val(response[0][e.name]);}catch(ex){}
				try{$('#'+e.name).text(response[0][e.name]);}catch(ex){}
			}
		$('#mediumModal').modal('show');
	  }
});
}

function issueBook(){
	$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/issueBook?token="+$.cookie('token'),
	  data: {
		  student_id: $('#student_id').val(),
		  book_id: $('#book_id').val()
	  },
      success: function(response) {
		  $('#IssuedBookTable').DataTable().ajax.reload();
		 if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
		$('#mediumModal').modal('hide');
	  }
});
}
</script>
@include('home.footer')