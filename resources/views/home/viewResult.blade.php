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
                                        <i class="zmdi zmdi-account-calendar"></i> Your Results</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="resultsTable">
                                            <thead>
                                                <tr>
                                                    <th>Evaluation Name</th>
                                                    <th>Published On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
								
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i> Result Marksheet</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="resultsViewTable">
                                            <thead>
                                                <tr>
                                                    <th>Subject Code</th>
                                                    <th>Subject Full Name</th>
                                                    <th>Subject Type</th>
                                                    <th>Obtained Marks</th>
                                                    <th>Maximum Marks</th>
                                                    <th>Marks Structure (If Any)<br>Question - M.O./M.M</th>
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
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/userTypeId",
      success: function(resultData) {getStudentResults(resultData);}
	});
setTimeout(function(){
	$('#resultsTable_length > label > select').select2();
},1000);

});

function getStudentResults(id){
	 $('#resultsTable').DataTable({
        processing: true,
		serverSide: true,
        ajax: '{{getHomeURL()}}/api/publishedEvaluations/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'full_name'},
			{render: function ( data, type, row) {
			if(row.result_status=='PUBLISHED') return '<button class="btn btn-success">PUBLISHED</button><br>('+row.publish_date+')'; 
			if(row.result_status=='PENDING') return '<button class="btn btn-danger">PENDING</button>'; 
			}},
			{render: function ( data, type, row) {
			if(row.result_status=='PUBLISHED') return '<button class="btn btn-success" onclick="getStudentResultByEvaluation('+row.ID+','+id+');">VIEW</button>'; 
			if(row.result_status=='PENDING') return '<button class="btn btn-warning">Wait Till Announced</button>'; 
			}}
        ]
    });
}

function getStudentResultByEvaluation(eval_id,student_id){
		 $('html, body').animate({
        scrollTop: $("#resultsViewTable").offset().top
    }, 1000);
	 $('#resultsViewTable').DataTable().destroy();
	 $('#resultsViewTable').DataTable({
        processing: true,
		paging: false,
        ajax: '{{getHomeURL()}}/api/studentResult/'+eval_id+'/'+student_id+"?token="+$.cookie('token'),
		columns: [
            {data: 'subject_code'},
            {data: 'subject_full_name'},
            {data: 'type_full_name'},
            {data: 'total_obtained_marks'},
            {data: 'total_maximum_marks'},
            {render: function ( data, type, row) {
			string = '';
			$.each(row.marks_structure,function(key,value){
				string += key+" - "+value+"<br>";
			});
			return string;
			}}
        ]
    });
}

</script>
@include('home.footer')