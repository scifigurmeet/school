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
	<div class="card threeD">
		<div class="body" style="padding: 20px;">
			<h3><i class="fas fa-check-circle"></i> Mark Attendence</h3><br>
			<div class="row">
				<div class="form-group col col-2">
					<span class="label">Choose Section</span>
				</div>
				<div class="form-group col col-5">
					<select id="section_id" class="form-control" name="section_id" onchange="buttonsLogic($(this).val(),$('#attendanceDate').val());">
					</select>
				</div>
				<div class="form-group col col-5">
					<p id="displayText">
					</p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-2">
					<span class="label">Attendance Date</span>
				</div>
				<div class="form-group col col-5">
					<input type="date" id="attendanceDate" class="form-control" name="attendanceDate" onchange="buttonsLogic($('#section_id').val(),$(this).val());">
				</div>
				<div class="form-group col col-5">
					<input type="hidden" name="smartSectionID">
					<button id="mark" class="btn btn btn-danger" onclick="makeSure($('input[name=smartSectionID]').val())" style="display:none;">Mark Attendance</button>
					<button id="view" class="btn btn btn-info" onclick="viewAttendance($('#section_id').val(),$('#attendanceDate').val());$('#edit').show();" style="display:none;">View Attendance</button>
					<button id="edit" class="btn btn btn-warning" onclick="enableAllInputs();$('#editMark').show();$(this).hide();" style="display:none;">Enable Editing</button>
					<button id="editMark" class="btn btn btn-danger" onclick="makeSure($('input[name=smartSectionID]').val());" style="display:none;">Update Attendance</button>
					<button id="deleteAttendance" class="btn btn btn-danger" onclick="makeSureDelete($('input[name=smartSectionID]').val());" style="display:none;">Delete Attendance</button>
				</div>
				<script>
				function enableAllInputs(){
					$('input').prop('disabled',false);
					$('#deleteAttendance').show();
					
				}
				function makeSure(id){
				var r = confirm("Are you sure to mark attendance?");
				if (r == true) {
				  markAttendance(id);
				}
				}
				function makeSureDelete(id){
				var r = confirm("Are you sure to delete this attendance?");
				if (r == true) {
				  deleteAttendance(id);
				}
				}
				</script>
			</div>
		</div>
	</div>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i><span id="sectionText"></span>Students List</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="evaluationsTable">
                                            <thead>
                                                <tr>
                                                    <th>School Roll No.</th>
                                                    <th>Class Roll No.</th>
                                                    <th>Student Full Name</th>
													<th>Attendance</th>
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
	getAllSections();
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

function getAllSections(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/attendanceSections",
	  data: {token: $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=section_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
			$('#section_id').select2();
	  }
});
});
}

function collectPresentIds(){
	
	presentIds = "";
	
	$('.attendance').each(function() {
    add = $(this).attr('studentID') + ",";
	if($(this).is(':checked')==false) return;
	presentIds += add;
	
	});
	
	return presentIds;
}

function markAttendance(section_id){
	$(document).ready(function(){
	 $.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/markAttendance/"+section_id,
	  data: {
		  date: $('#attendanceDate').val(),
		  presentIds: collectPresentIds(),
		  token: $.cookie('token')
	  },
      success: function(response) {
		if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+'<br>Error(s): '+response.error);
		buttonsLogic($('#section_id').val(),$('#attendanceDate').val());
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
});
}

function deleteAttendance(section_id){
	$(document).ready(function(){
	 $.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/markAttendance/"+section_id,
	  data: {
		  date: $('#attendanceDate').val(),
		  presentIds: collectPresentIds(),
		  token: $.cookie('token'),
		  delete: true
	  },
      success: function(response) {
		  $('#deleteAttendance').hide();
		  $('#editMark').hide();
		if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+'<br>Error(s): '+response.error);
		buttonsLogic($('#section_id').val(),$('#attendanceDate').val());
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
});
}

function viewAttendance(section_id,date){
	getStudentsBySectionForJustView(section_id,true);
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
	  data: {token: $.cookie('token')},
      url: "{{getHomeURL()}}/api/attendance/"+section_id+"/"+date,
      success: function(response) {
			setTimeout(function(){
				data = response.data;
		  $(data).each(function(key,value) {
			studentID = data[key].student_id;
			status = data[key].status;
			if(status=="PRESENT") document.getElementById('studentAttendance'+studentID).checked = true;
		});
			},1000);
		
		if(response.status==200){
			alert('Wait One Second After Clicking OK To See the Attendance.');
			showToast(1,response.message);
		}
		else{
			showToast(0,response.message+'<br>Error(s): '+response.error);
		}
	  },
	  error: function(data) {
			data = data.responseJSON;
			error = '';
			$.each(data.errors, function (i,v) {
				  error += "<li>"+i.replace(/_/g," ").ucwords()+" : "+v+"<br>";
				});
			showToast(0,data.message+'<br>Error(s): '+error);

	  }
});
});
}


function buttonsLogic(section_id,date){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/attendance/"+section_id+"/"+date,
	  data: {token: $.cookie('token')},
      success: function(response) {
		if(response.status==200){
			$('#displayText').text('Attendance for this section and date has already been marked.');
			$('#view').show();
			$('#mark').hide();
			$('#editMark').hide();
		}
		else{
			$('#displayText').text('Kindly first mark the attendance and then click on the Mark Attendance button.');
			$('#view').hide();
			$('#mark').show();
			$('#edit').hide();
			getStudentsBySection(section_id);
		}
	  },
	  error: function(data) {
			data = data.responseJSON;
			error = '';
			$.each(data.errors, function (i,v) {
				  error += "<li>"+i.replace(/_/g," ").ucwords()+" : "+v+"<br>";
				});
			showToast(0,data.message+'<br>Error(s): '+error);

	  }
});
});
}



function getStudentsBySection(id){
	$('#sectionText').text($('#section_id option:selected').text()+" ");
	$('#evaluationsTable').DataTable().clear().destroy();
	$('input[name=smartSectionID]').val(id);
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
        processing: true,
        ajax: '{{getHomeURL()}}/api/studentsBySection/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'school_roll_no'},
            {data: 'section_roll_no'},
            {data: 'student_full_name'},
			{render: function(data, type, row){
				return 'A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="studentAttendance'+row.ID+'" type="checkbox" class="attendance" studentID="'+row.ID+'"><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P';}}
        ]
    });
});
}

function getStudentsBySectionForJustView(id){
	$('#sectionText').text($('#section_id option:selected').text()+" ");
	$('#evaluationsTable').DataTable().clear().destroy();
	$('input[name=smartSectionID]').val(id);
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
        processing: true,
        ajax: '{{getHomeURL()}}/api/studentsBySection/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'school_roll_no'},
            {data: 'section_roll_no'},
            {data: 'student_full_name'},
			{render: function(data, type, row){
				return 'A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch"><input id="studentAttendance'+row.ID+'" type="checkbox" class="attendance" studentID="'+row.ID+'" disabled><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P';}}
        ]
    });
});
}

</script>
@include('home.footer')