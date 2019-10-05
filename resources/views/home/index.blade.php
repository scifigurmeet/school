@include('home.header')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Overview</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="text">
                                                <h2 id="totalStudents"></h2>
                                                <span>Total Active Students For This Session</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                            <div class="text">
                                                <h2 id="messagesSent"></h2>
                                                <span>Messages Sent In Last 30 Days</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                            <div class="text">
                                                <h2 id="avgAttendance"></h2>
                                                <span>Average Attendance For Last 30 Days</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-rupee-sign"></i>
                                            </div>
                                            <div class="text">
                                                <h2 id="feeThisMonth"></h2>
                                                <span>Total Fee Collected This Month</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
<script>
$(document).ready(function(){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/students/stats",
      success: function(response) {
		  $('#totalStudents').text(response.data.all_students_count);
	  }
	});
	$.ajax({
		  type: 'GET',
		  url: "{{getHomeURL()}}/api/feeCollectedThisMonth",
		  success: function(response) {
			  $('#feeThisMonth').text('₹ '+response);
		  }
	});
	$.ajax({
		  type: 'GET',
		  url: "{{getHomeURL()}}/api/messagesSentLast30Days",
		  success: function(response) {
			  $('#messagesSent').text(response);
		  }
	});
	$.ajax({
		  type: 'GET',
		  url: "{{getHomeURL()}}/api/avgAttendanceLast30Days",
		  success: function(response) {
			  $('#avgAttendance').text(response+' %');
		  }
	});
});
</script>
@include('home.footer')