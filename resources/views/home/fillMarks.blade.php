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
			<h3><i class="fas fa-check-circle"></i> Fill Marks</h3><br>
			<div class="row">
				<div class="form-group col col-3">
					<span class="label">Choose Evaluation</span>
				</div>
				<div class="form-group col col-5">
					<select id="evaluation_id" class="form-control" name="evaluation_id" onchange="getStandardsByEvaluation(this.value);$('#getMarks').prop('disabled',true);hello();"></select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-3">
					<span class="label">Choose Standard</span>
				</div>
				<div class="form-group col col-5">
					<select id="standard_id" class="form-control" name="standard_id" onchange="getSubjectsByStandard(this.value);$('#getMarks').prop('disabled',true);hello();">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-3">
					<span class="label">Choose Subject</span>
				</div>
				<div class="form-group col col-5">
					<select id="subject_id" class="form-control" name="subject_id" onchange="$('#start').prop('disabled',false);getSectionsByStandard($('#standard_id').val());$('#getMarks').prop('disabled',true);hello();">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-3">
					<span class="label">Choose Section</span>
				</div>
				<div class="form-group col col-5">
					<select id="section_id" class="form-control" name="section_id" onchange="idByABC($('#evaluation_id').val(),$('#standard_id').val(),$('#subject_id').val());$('#getMarks').prop('disabled',true);hello();">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-12">
					<p id="displayText"></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-12">
					<button id="start" class="btn btn-success" onclick="idByABC($('#evaluation_id').val(),$('#standard_id').val(),$('#subject_id').val());$('#getMarks').prop('disabled',false);" disabled>Get Marking Structure Details <i class="fas fa-hand-peace"></i></button>
				</div>
			</div>
			<div class="row">
				<div class="form-group col col-12">
					<button id="getMarks" class="btn btn-info" onclick="getMarks($('#evaluation_entity_id').val());" disabled>Load Marksheet <i class="fas fa-download"></i></button>
					<button id="setMarks" class="btn btn-danger" onclick="saveMarks($('#evaluation_entity_id').val());">Save/Update Marks <i class="fas fa-upload"></i></button>
				</div>
			</div>
			<input type="hidden" id="evaluation_method">
			<input type="hidden" id="max_marks">
			<input type="hidden" id="evaluation_entity_id">
			<textarea style="display:none;" id="fullString"></textarea>
		</div>
	</div>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i><span id="sectionText"></span>Students List</h3>
                                    <div class="table-responsive">
									<form id="marksDataAll" method="POST">
                                        <table class="table" id="evaluationsTable">
                                            <thead>
                                                <tr>
                                                    <th>School Roll No.</th>
                                                    <th>Class Roll No.</th>
                                                    <th>Student Full Name</th>
													<th id="marks">Marks</th>
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
<style>
.modal {
  z-index: 99999;
}
td, td *{
	width: auto !important;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllEvaluations();
	setTimeout(function(){
		getStandardsByEvaluation($('#evaluation_id').val());
	},1000);
});

function hello(){
	setTimeout(function(){$('#start').trigger('click');},1000);
	$('#displayText').html('<div class="page-loader__spin"></div>');
}

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

function getAllEvaluations(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/evaluations"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('#evaluation_id')
				 .append($('<option></option>')
							.attr("value",value.ID)
							.text(value.full_name+" ("+value.short_name+")")); 
			});
			$('#evaluation_id').select2();
	  }
});
});
}

function getStandardsByEvaluation(id){
	if(id==null) return;
	$(document).ready(function(){
		$('#standard_id').select2();
		$('#standard_id').find('option').remove().end();
		$('#standard_id').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standardsByEvaluation/"+id+"?token="+$.cookie('token'),
	  data: {token : $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $('#standard_id').prop('disabled',false);
		  $.each(data, function(key,value) {   
			$('#standard_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
			});
			$('#standard_id').trigger('change.select2');
	  }
});
});
}

function getSectionsByStandard(id){
	$('#evaluationsTable').DataTable().clear().draw();
	$('#evaluationsTable').DataTable().destroy();
	if(!(id>0)) return;
	$(document).ready(function(){
		$('#section_id').select2();
		$('#section_id').find('option').remove().end();
		$('#section_id').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/sectionsByStandard/"+id+"?token="+$.cookie('token'),
	  data: {token : $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $('#section_id').prop('disabled',false);
		  $.each(data, function(key,value) {   
			$('#section_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
		  .text(value.section_full_name+" ("+value.section_short_name+")")); 
			});
	  }
});
});
}

function getSubjectsByStandard(id){
	if(!(id>0)) return;
	$(document).ready(function(){
		$('#subject_id').select2();
		$('#subject_id').find('option').remove().end();
		$('#subject_id').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjectsByStandard/"+id+"?token="+$.cookie('token'),
	  data: {token : $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $('#subject_id').prop('disabled',false);
		  $.each(data, function(key,value) {   
			$('#subject_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
		  .text(value.subject_code+" | "+value.subject_full_name+" ("+value.subject_short_name+")")); 
			});
	  }
});
});
}

function getStudentsBySection(id){
	$('#evaluationsTable').DataTable().clear().destroy();
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
		paging: false,
        ajax: '{{getHomeURL()}}/api/studentsBySection/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'school_roll_no'},
            {data: 'section_roll_no'},
            {data: 'student_full_name'},
			{render: function(data, type, row){
				method = $('#evaluation_method').val();
				maxMarks = $('#max_marks').val();
				if(method==1) content = '<input style="width: 100% !important;" name="T'+row.ID+'" class="form-control" type="number" min="0" max="'+maxMarks+'" name="ob_marks_'+row.ID+'">';
				else{
					fullString = $('#fullString').val();
					fullString = fullString.replace(/giveNameHere/g,"S"+row.ID);
					totalMarksString = '<input class="totalMarksIndividual form-control" type="number" placeholder="Total Obtained Marks" disabled>';
					content = '<div studentID="'+row.ID+'" class="form-inline group-marks-individual">'+fullString+totalMarksString+'</div>';
				}
				return content;
				}
			}
        ]
    });
	
});
}

function doSum(item){
		sum = 0;
		studentID = item.parent().attr('studentID');
		values = $('div[studentID='+studentID+'] input.individualQuestionMarks');
		$(values).each(function() {
			if(!isNaN(parseInt($(this).val()))){
			sum = parseInt(sum) + parseInt($(this).val());
			return;
			}
		});
		$('div[studentID='+studentID+'] input.totalMarksIndividual').val(sum);
	}

function idByABC(a,b,c){
	$(document).ready(function(){
						$.ajax({
							type: 'GET',
							url: "{{getHomeURL()}}/api/idByABC/"+a+"/"+b+"/"+c+"?token="+$.cookie('token'),
							success: function(resultData) {
								$('#evaluation_entity_id').val(resultData);
								getEntity(resultData);
							}			
					});
					});
}

function getEntity(id){
	$('#setMarks').prop('disabled',true);
					$(document).ready(function(){
						$.ajax({
							type: 'GET',
							url: "{{getHomeURL()}}/api/evaluationEntities/"+id+"?token="+$.cookie('token'),
							success: function(resultData) {
								var data = resultData.data;
								d = data[4][0];
								e = data[5][0];
								obj = data[6];
								fullString = "";
								count=1;
								for (var key in obj) {
									current = '<input style="width: 100px !important;" name="giveNameHereQ'+count+'" question="'+key+'" class="form-control individualQuestionMarks" type="number" min="0" max="'+obj[key]+'" oninput="doSum($(this));" onchange="doSum($(this));" placeholder="Q. '+key+'">';
									fullString += current;
									count++;
								}
								$('#fullString').val(fullString);
								$('#studentList').prop('disabled',false);
								$('#evaluation_method').val(d);
								$('#max_marks').val(e);
								$('#marks').text("Marks (Out Of "+e+")");
								$('#displayText').html('');
								if(d==1) $('#displayText').html('This Evaluation Entity follows Method 1. You have to fill only total marks obtained out of the maximum marks of <strong>'+e+'</strong> of each student one by one.');
								if(d==2) $('#displayText').html('This Evaluation Entity follows Method 2. You have to fill marks obtained for each question for each student one by one.');
							},
							error: function(){
								$('#displayText').html('Make sure the details are correct.');
							}
					});
					});
					}

function saveMarks(id){
		$(document).ready(function(){
						$.ajax({
							type: 'POST',
							url: "{{getHomeURL()}}/api/fillMarks/"+id+"?token="+$.cookie('token'),
							data: $('#marksDataAll').serialize(),
							success: function(resultData) {
							if(resultData.status==201) showToast(0,resultData.message+"<br>Error(s): "+resultData.error);
							if(resultData.status==200) showToast(1,resultData.message);
							}			
					});
					});
}

function getMarks(id){
	$('#getMarks').append('<div id="loader" class="page-loader__spin"></div>');
	getStudentsBySection($('#section_id').val());
	setTimeout(function(){
		$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/fillMarks/"+id+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData;
		  $.each(data, function(key,value) { 
				$('input[name='+key+']').val(value);
				doSum($('input[name='+key+']'));
			});
			$('#loader').hide();
			$('#setMarks').prop('disabled',false);
			if(resultData.status==201){
			showToast(0,resultData.message+"<br>Error(s): "+resultData.error);
			}
	  }
});
});
$('#loader').remove();
	},1000);
}
</script>
@include('home.footer')