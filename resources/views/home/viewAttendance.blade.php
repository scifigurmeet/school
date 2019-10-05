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
                                        <i class="zmdi zmdi-account-calendar"></i> Your Attendance</h3>
                                    <div class="table-responsive">
									<form id="attendance" method="POST">
                                        <table class="table" id="attendanceTable">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Day</th>
                                                    <th>Present/Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
										</form>
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
      success: function(resultData) {getStudentAttendance(resultData);}
	});
setTimeout(function(){
	$('#attendanceTable_length > label > select').select2();
},1000);

});

function getStudentAttendance(id){
	 $('#attendanceTable').DataTable({
        processing: true,
        ajax: '{{getHomeURL()}}/api/attendanceByStudent/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'date'},
			{render: function ( data, type, row) {
				var dt = new Date(row.date);
				day = dt.getDay();
				var weekday = new Array(7);
				weekday[0] = "Sunday";
				weekday[1] = "Monday";
				weekday[2] = "Tuesday";
				weekday[3] = "Wednesday";
				weekday[4] = "Thursday";
				weekday[5] = "Friday";
				weekday[6] = "Saturday";
				return weekday[day];
			}},
			{render: function ( data, type, row) {
			if(row.status=='PRESENT') return '<button class="btn btn-success">Present</button>'; 
			if(row.status=='ABSENT') return '<button class="btn btn-danger">Absent</button>'; 
			if(row.status=='LEAVE') return '<button class="btn btn-info">On Leave</button>'; 
			}}
        ]
    });
}
</script>
@include('home.footer')