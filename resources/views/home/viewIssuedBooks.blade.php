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
                                        <i class="fas fa-book"></i>Your Issued Books</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="IssuedBookTable">
                                            <thead>
                                                <tr>
													<th>Issue ID</th>
                                                    <th>Book Name</th>
                                                    <th>Authors(s)</th>
                                                    <th>ISBN</th>
                                                    <th>Publisher</th>
													<th>Status</th>
													<th>Return Date</th>
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
	getAllIssuedBooks({{getUserTypeID()}});
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
function getAllIssuedBooks(id){
$(document).ready(function(){
	 $('#IssuedBookTable').DataTable({
		order: [[ 6, "ASC" ]],
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/issuedBooksByStudent/'+id+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'book_name'},
            {data: 'book_authors'},
            {data: 'book_isbn'},
			{data: 'book_publisher'},
			{data: 'status'},
			{data: 'return_date'}
        ]
    });
});
}
</script>
@include('home.footer')