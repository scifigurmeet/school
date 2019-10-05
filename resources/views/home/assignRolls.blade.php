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
        New Student Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Assign Roll Numbers</h3>
		<div class="row" style="padding: 0px 30px 30px 30px;">
			<div class="col col-12">
				<h4>Roll Numbers Statistics</h4><br>
				<p>Total Number of Eligible Students: <b id="eligible">0</b></p>
				<p>Total Number of Students With Assigned School Roll Numbers: <b id="assignedSchool">0</b></p>
				<p>Total Number of Students With Assigned Section Roll Numbers: <b id="assignedSection">0</b></p>
			</div>
		</div>
		<div class="row" style="padding: 0px 30px 30px 30px;">
			<div class="col col-12">
				<h4>Auto Assign Roll Numbers</h4><br>
				<select id="type" onchange="buttonsLogic();">
					<option value="0">Whole School Roll Numbers Only</option>
					<option value="1">Particular Section Roll Numbers Only</option>
					<option value="2">Whole School Roll Numbers + All Section Roll Numbers</option>
				</select><br>
				<span id="sectionWise">
				<select id="section_id" style="display:none;">
				</select><br>
				<button class="btn btn-danger" onclick="autoSection($('#section_id').val());" id="autoAssignSectionRolls">Auto Assign Selected Section Roll Numbers</button>
				</span>
				<button class="btn btn-danger" onclick="autoWholeSchoolOnly();" id="autoAssignSchoolRolls" style="display:none;">Auto Assign Whole School Roll Numbers</button>
				<button class="btn btn-danger" onclick="autoSchoolSection();" id="autoAssignSchoolSectionRolls" style="display:none;">Auto Assign Whole School Roll Numbers and All Section Roll Numbers</button>
				<script>
				function buttonsLogic(){
					if($('#type').val()==0){
						$('#autoAssignSchoolRolls').show();
						$('#sectionWise').hide();
						$('#autoAssignSchoolSectionRolls').hide();
					}
					if($('#type').val()==2){
						$('#autoAssignSchoolRolls').hide();
						$('#sectionWise').hide();
						$('#autoAssignSchoolSectionRolls').show();
					}
					if($('#type').val()==1){
						$('#autoAssignSchoolRolls').hide();
						$('#sectionWise').show();
						$('#autoAssignSchoolSectionRolls').hide();
					}
				}
				</script>
			</div>
		</div>
		<div class="row" style="padding: 0px 30px 30px 30px;">
			<div class="col col-12">
				<h4>Manual Roll Numbers Assignment</h4><br>
				<span class="label">Choose Standard</span>
				<select id="standard_id" onchange="getSectionsByStandard($(this).val());"></select><br>
				<span class="label">Choose Section</span>
				<select id="section_id_list" onchange="getStudentsBySection($(this).val());"></select><br>
				<span class="label">Choose Student</span>
				<select id="student_id"></select><br>
				<span class="label">Choose Assignment Type</span>
				<select id="typeTwo" onchange="buttonsLogicTwo();">
					<option value="0">Assign Student's Section Roll Number</option>
					<option value="1">Assign Student's School Roll Number</option>
					<option value="2">Assign Student's Section + School Roll Number</option>
				</select><br>
				<span id="onlySection" style="display:none;">
				<span class="label">Section Roll Number</span>
				<input type="text" id="section_roll_no" class="form-control" placeholder="Section Roll Number"><br>
				<button class="btn btn-danger" onclick="manualSectionOnly($('#student_id').val(),$('#section_roll_no').val())">Assign Section Roll Number</button>
				</span>
				<span id="onlySchool" style="display:none;">
				<span class="label">School Roll Number</span>
				<input type="text" id="school_roll_no" class="form-control" placeholder="School Roll Number"><br>
				<button class="btn btn-danger" onclick="manualSchoolOnly($('#student_id').val(),$('#school_roll_no').val())">Assign School Roll Number</button>
				</span>
				<span id="both" style="display:none;">
				<span class="label">School Roll Number</span>
				<input type="text" id="school_roll_no_both" class="form-control" placeholder="School Roll Number"><br>
				<span class="label">Section Roll Number</span>
				<input type="text" id="section_roll_no_both" class="form-control" placeholder="Section Roll Number"><br>
				<button class="btn btn-danger" onclick="manualBoth($('#student_id').val(),$('#section_roll_no_both').val(),$('#school_roll_no_both').val())">Assign School Roll Number + Section Roll Number</button>
				</span>
				<script>
				function buttonsLogicTwo(){
					if($('#typeTwo').val()==0){
						$('#onlySection').show();
						$('#onlySchool').hide();
						$('#both').hide();
					}
					if($('#typeTwo').val()==2){
						$('#onlySection').hide();
						$('#onlySchool').hide();
						$('#both').show();
					}
					if($('#typeTwo').val()==1){
						$('#onlySection').hide();
						$('#onlySchool').show();
						$('#both').hide();
					}
				}
				</script>
			</div>
		</div>
    </div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllSections();
	getAllStandards();
	setTimeout(function(){
		$('#type').select2();
		$('#typeTwo').select2();
		},1000);
	buttonsLogic();
	buttonsLogicTwo();
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/students/stats",
      success: function(response) {
		  $('#eligible').text(response.data.all_students_count);
		  $('#assignedSchool').text(response.data.students_with_school_roll_no);
		  $('#assignedSection').text(response.data.students_with_section_roll_no);
	  }
	});

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
      url: "{{getHomeURL()}}/api/sections?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#section_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
			$('#section_id').select2();
	  }
});
});
}


function getAllStandards(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standards?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#standard_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
			});
			$('#standard_id').select2();
			getSectionsByStandard(data[0].ID);
	  }
});
});
}


function autoSection(id){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/autoSection?token="+$.cookie('token'),
	  data: {section_id : id},
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}

function autoWholeSchoolOnly(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/autoWholeSchoolOnly?token="+$.cookie('token'),
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}

function autoSchoolSection(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/autoSchoolSection?token="+$.cookie('token'),
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}

function manualSectionOnly(id,roll){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/manualSection?token="+$.cookie('token'),
	  data: {
		  student_id : id,
		  section_roll_no: roll
	  },
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}

function manualSchoolOnly(id,roll){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/manualSchool?token="+$.cookie('token'),
	  data: {
		  student_id : id,
		  school_roll_no: roll
	  },
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}

function manualBoth(id,rollSection,rollSchool){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/manualBoth?token="+$.cookie('token'),
	  data: {
		  student_id : id,
		  section_roll_no: rollSection,
		  school_roll_no: rollSchool
	  },
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}


function getSectionsByStandard(id){
	$('#evaluationsTable').DataTable().clear().draw();
	$('#evaluationsTable').DataTable().destroy();
	if(!(id>0)) return;
	$(document).ready(function(){
		$('#section_id_list').select2();
		$('#section_id_list').find('option').remove().end();
		$('#section_id_list').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/sectionsByStandard/"+id,
	  data: {token : $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $('#section_id_list').prop('disabled',false);
		  $.each(data, function(key,value) {   
			$('#section_id_list')
				 .append($("<option></option>")
							.attr("value",value.ID)
		  .text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
			$('#section_id_list').select2();
			getStudentsBySection(data[0].ID);
	  }
	  
});
});
}

function getStudentsBySection(id){
	if(!(id>0)) return;
	$(document).ready(function(){
		$('#student_id').select2();
		$('#student_id').find('option').remove().end();
		$('#student_id').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/studentsBySection/"+id,
	  data: {token : $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $('#student_id').prop('disabled',false);
		  $.each(data, function(key,value) {   
			$('#student_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
		  .text(value.student_first_name+" "+value.student_last_name+" (Father's Name: "+value.father_name+" | Mother's Name: "+value.mother_name+")")); 
			});
			$('#student_id').select2();
	  }
});
});
}


</script>
@include('home.footer')