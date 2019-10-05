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

<div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Evaluation Registration With Subjects & Marking Structure</h3>
                                        </div>
                                        <hr>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Choose Evaluation</label>
                                                <select id="evaluation_id" name="evaluation_id" onchange="getStandardsByEvaluation(this.value);" disabled>
												</select>
                                            </div>
											<div class="form-group">
                                                <label class="control-label mb-1">Choose Standard</label>
                                                <select id="standard_id" name="standard_id" onchange="getSubjectsByStandard(this.value);" disabled>
												<option disabled>Choose Standard</option>
												</select>
                                            </div>
											<div class="form-group">
                                                <label class="control-label mb-1">Choose Subject</label>
                                                <select id="subject_id" name="subject_id" disabled>
												<option disabled>Choose Subject</option>
												</select>
                                            </div>
											<div class="form-group">
                                                <label class="control-label mb-1">Evaluation Method</label>
                                                <select id="evaluation_method" name="evaluation_method" onchange="theLogic();">
												<option value="1">Obtained Marks Out of Maximum Marks</option>
												<option value="2">Obtained Marks Out of Maximum Marks For Each Question</option>
												</select>
                                            </div>
											
											<script>
											function theLogic(option=null){
												if(option==null) var option = $('#evaluation_method').val();
												if(option==1){
													$('#option1 input').prop('disabled',false);
													$('input[name=maximum_marks]').val(0);
													$('input[name=no_of_questions]').val(0);
													$('#option2').hide();
													mm_generator(0);
												}
												else{
													$('#option1 input').prop('disabled',true);
													$('input[name=maximum_marks]').val(0);
													$('input[name=no_of_questions]').val(0);
													$('#option2').show();
												}
											}
											</script>
											
											<div id="option2" class="form-group" style="display: none;">
                                                <label class="control-label mb-1">No. of Questions.</label>
                                                <input class="form-control" type="number" name="no_of_questions" min="0" oninput="mm_generator(this.value);">
                                            </div>
											
											<script>
											document.addEventListener('DOMContentLoaded', function(){ 
												theLogic(0);
												mm_generator(1);
												mm_generator(0);
												theLogic(1);
											}, false);
											function getSum(total, num) {
												if(total=="") total=0;
												if(num=="") num=0;
												  return parseInt(total) + parseInt(num);
												}
											function mm_generator(no,logic=false){
											
												
												count = $('#mm_body tr').length;
												
												var questionData = [];
												var marksData = [];
												
												
												for(var j=1;j<=count;j++){
													questionData[j] = $('input[name=question_no_'+j+']').val();
													marksData[j] = $('input[name=mm_question_'+j+']').val();
												}
												
												if(logic==true) {
													$('input[name=maximum_marks]').val(marksData.reduce(getSum,0));
													$('input[name=mm_question_'+no+']').focus()
													return;
												}
												
												$('#questionsMarks').hide();
												if(no>0) $('#questionsMarks').show();
												$('#mm_body').html("");
												for(var i=1;i<=no;i++){
												$('#mm_body').append('<tr><td><input class="form-control question_no" type="text" name="question_no_'+i+'" placeholder="Enter Question Number"></td><td><input class="form-control question_marks" type="number" name="mm_question_'+i+'" placeholder="Enter Maximum Marks" min="0" value="0" oninput="mm_generator('+i+',true);"></td></tr>');
												}
												
												for(var j=1;j<=count;j++){
												$('input[name=question_no_'+j+']').val(questionData[j]);
												$('input[name=mm_question_'+j+']').val(marksData[j]);
												}
												
												$('input[name=no_of_questions]').val($('#mm_body tr').length);
												$('input[name=maximum_marks]').val(marksData.reduce(getSum,0));
												$('input[name=mm_question_'+no+']').focus();
												
											}
											
											
											function setValues(a,b,c,d,e=null,max){
												$('body').append('<div id="loader" class="page-loader"><div class="page-loader__spin"></div></div>');
												
												setTimeout(function(){
													
													$('select[name=evaluation_id]').val(a);
													$('select[name=evaluation_id]').trigger('change.select2');
													getStandardsByEvaluation(a);
													
													setTimeout(function(){
													$('select[name=standard_id]').val(b);
													$('select[name=standard_id]').trigger('change.select2');
													getSubjectsByStandard(b);
													
														setTimeout(function(){
															$('select[name=subject_id]').val(c);
															$('select[name=subject_id]').trigger('change.select2');
															$('#loader').remove();
														}, 1000);
													
													}, 1000);
													
												}, 1000);
													
												$('select[name=evaluation_method]').val(d);
												$('select[name=evaluation_method]').trigger('change.select2');
												$('input[name=maximum_marks]').val(max);
												if(e!=null){
												$('select[name=no_of_questions]').val(e.length);
												mm_generator(Object.keys(e).length);
												
												questionData = [];
												marksData = [];
												
												
												for(var j=1;j<=Object.keys(e).length;j++){
													questionData[j] = Object.keys(e)[j-1];
													marksData[j] = e[questionData[j]];
													
													if(j==Object.keys(e).length){
														for(var i=1;i<=Object.keys(e).length;i++){
															$('input[name=question_no_'+i+']').val(questionData[i]);
															$('input[name=mm_question_'+i+']').val(marksData[i]);
														}
													}
												}
												
												mm_generator(Object.keys(e).length);
												}
												
											}
											
											function getEntity(id){
												$(document).ready(function(){
												 $.ajax({
												  type: 'GET',
												  url: "{{getHomeURL()}}/api/evaluationEntities/"+id,
												  success: function(resultData) {
													  var data = resultData.data;
													  a = data[1][0];
													  b = data[2][0];
													  c = data[3][0];
													  d = data[4][0];
													  e = data[6];
													  max = data[5][0];
													 setValues(a,b,c,d,e,max);
												  }
											});
											});
											}
											</script>
											
											<div id="questionsMarks" class="form-group" style="display: none;">
                                                <table class="table table-striped">
												<thead>
												<tr>
												<th>Question Number</th>
												<th>Maximum Marks</th>
												</tr>
												</thead>
												<tbody id="mm_body">
												<tr>
												<td><input class="form-control" type="text" name="question_no_"></td>
												<td><input class="form-control" type="number" name="mm_question_"></td>
												</tr>
												</tbody>
												</table>
												<br>
												<center>
												<button class="btn btn-danger" onclick="mm_generator(($('#mm_body tr').length)-1);">Delete Last Question <i class="fas fa-minus-circle"></i></button>
												<button class="btn btn-success" onclick="mm_generator(($('#mm_body tr').length)+1);">Add One More Question <i class="fas fa-plus-circle"></i></button>
												</center>
                                            </div>
											
											<div id="option1" class="form-group">
                                                <label class="control-label mb-1">Maximum Marks</label>
                                                <input class="form-control" type="number" name="maximum_marks" min="0" value="0">
                                            </div>
											
											
                                            <div>
                                                <button id="submitButton" type="submit" class="btn btn-lg btn-info btn-block" onclick="addNewEvaluationEntity();">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span >Register Evaluation For This Subject</span>
                                                </button>
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
<?php
if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	echo '
	<script>
	$(document).ready(function(){
		getEntity('.$id.');
		$("#submitButton").removeAttr("onclick");
		$("#submitButton").attr("onclick","editEvaluationEntity('.$id.');");
	});
	</script>
	';
}
?>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllEvaluations();
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

//Summarize Marks of data of each questionData

function packQuestionsMarks(){
	var count = $('#mm_body tr').length;
	data = [];
	for(i=1;i<=count;i++){
		data[$('input[name=question_no_'+i+']').val()] = $('input[name=mm_question_'+i+']').val();
		if(i==count) return data;
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
			$('#evaluation_id').prop('disabled',false);
			$('#evaluation_id')
				 .append($('<option></option>')
							.attr("value",value.ID)
							.text(value.full_name+" ("+value.short_name+")")); 
			});
			getStandardsByEvaluation(data[0].ID);
	  }
});
});
}

function getStandardsByEvaluation(id){
	if(id==null) return;
	$(document).ready(function(){
		$('#standard_id').find('option').remove().end();
		$('#standard_id').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standardsByEvaluation/"+id,
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
			getSubjectsByStandard(data[0].ID);
	  }
});
});
}

function getSubjectsByStandard(id){
	if(!(id>0)) return;
	$(document).ready(function(){
		$('#subject_id').find('option').remove().end();
		$('#subject_id').trigger('change.select2');
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/subjectsByStandard/"+id,
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

//Add New
function addNewEvaluationEntity(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/evaluationEntities",
	  data: {
		  token: $.cookie('token'),
			evaluation_id: $('select[name=evaluation_id]').val(),
			standard_id: $('select[name=standard_id]').val(),
			subject_id: $('select[name=subject_id]').val(),
			evaluation_method: $('select[name=evaluation_method]').val(),
			maximum_marks: $('input[name=maximum_marks]').val(),
			packedMarks:  $.extend({}, packQuestionsMarks())
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

//Edit
function editEvaluationEntity(id){
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/evaluationEntities/"+id,
	  data: {
			token: $.cookie('token'),
			evaluation_id: $('select[name=evaluation_id]').val(),
			standard_id: $('select[name=standard_id]').val(),
			subject_id: $('select[name=subject_id]').val(),
			evaluation_method: $('select[name=evaluation_method]').val(),
			maximum_marks: $('input[name=maximum_marks]').val(),
			packedMarks:  $.extend({}, packQuestionsMarks())
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
$(document).ready(function(){
	setTimeout(function(){
		$('select').select2();
	},1000);
});
</script>
@include('home.footer')