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
                                            <h3 class="text-center title-2">Fee Structure Manager</h3>
                                        </div>
                                        <hr>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Choose Fee Type</label>
                                                <select id="feeType_id" name="feeType_id">
												</select>
                                            </div>
											<div class="form-group">
                                                <label class="control-label mb-1">Fee Structure Method</label>
                                                <select id="fee_method" name="fee_method" onchange="theLogic();">
												<option value="1">Fixed Total Fees</option>
												<option value="2">Structure Wise Fees</option>
												</select>
                                            </div>
											
											<script>
											function theLogic(option=null){
												if(option==null) var option = $('#fee_method').val();
												if(option==1){
													$('#option1 input').prop('disabled',false);
													$('input[name=fee_max_amount]').val(0);
													$('input[name=no_of_charges]').val(0);
													$('#option2').hide();
													mm_generator(0);
												}
												else{
													$('#option1 input').prop('disabled',true);
													$('input[name=fee_max_amount]').val(0);
													$('input[name=no_of_charges]').val(0);
													$('#option2').show();
												}
											}
											</script>
											
											<div id="option2" class="form-group" style="display: none;">
                                                <label class="control-label mb-1">No. of Chargeable Entities</label>
                                                <input class="form-control" type="number" name="no_of_charges" min="0" oninput="mm_generator(this.value);">
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
													questionData[j] = $('input[name=charge_no_'+j+']').val();
													marksData[j] = $('input[name=mm_charge_'+j+']').val();
												}
												
												if(logic==true) {
													$('input[name=fee_max_amount]').val(marksData.reduce(getSum,0));
													$('input[name=mm_charge_'+no+']').focus()
													return;
												}
												
												$('#chargesDetails').hide();
												if(no>0) $('#chargesDetails').show();
												$('#mm_body').html("");
												for(var i=1;i<=no;i++){
												$('#mm_body').append('<tr><td><input class="form-control charge_no" type="text" name="charge_no_'+i+'" placeholder="Enter Charge Name"></td><td><input class="form-control question_marks" type="number" name="mm_charge_'+i+'" placeholder="Enter Maximum Marks" min="0" value="0" oninput="mm_generator('+i+',true);"></td></tr>');
												}
												
												for(var j=1;j<=count;j++){
												$('input[name=charge_no_'+j+']').val(questionData[j]);
												$('input[name=mm_charge_'+j+']').val(marksData[j]);
												}
												
												$('input[name=no_of_charges]').val($('#mm_body tr').length);
												$('input[name=fee_max_amount]').val(marksData.reduce(getSum,0));
												$('input[name=mm_charge_'+no+']').focus();
												
											}
											
											
											function setValues(a,d,e=null,max){
												$('body').append('<div id="loader" class="page-loader"><div class="page-loader__spin"></div></div>');
												
												setTimeout(function(){
													
													$('#feeType_id').val(a);
													$('#feeType_id').trigger('change.select2');
													$('#loader').hide();
													
												}, 1000);
													
												$('select[name=fee_method]').val(d);
												$('select[name=fee_method]').trigger('change.select2');
												$('input[name=fee_max_amount]').val(max);
												if(e!=null){
												$('select[name=no_of_charges]').val(e.length);
												mm_generator(Object.keys(e).length);
												
												questionData = [];
												marksData = [];
												
												
												for(var j=1;j<=Object.keys(e).length;j++){
													questionData[j] = Object.keys(e)[j-1];
													marksData[j] = e[questionData[j]];
													
													if(j==Object.keys(e).length){
														for(var i=1;i<=Object.keys(e).length;i++){
															$('input[name=charge_no_'+i+']').val(questionData[i]);
															$('input[name=mm_charge_'+i+']').val(marksData[i]);
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
												  url: "{{getHomeURL()}}/api/feeManager/"+id,
												  success: function(resultData) {
													  var data = resultData.data;
													  a = data[1][0];
													  d = data[2][0];
													  e = data[4];
													  max = data[3][0];
													 setValues(a,d,e,max);
												  }
											});
											});
											}
											</script>
											
											<div id="chargesDetails" class="form-group" style="display: none;">
                                                <table class="table table-striped">
												<thead>
												<tr>
												<th>Charge Description</th>
												<th>Maximum Amount</th>
												</tr>
												</thead>
												<tbody id="mm_body">
												<tr>
												<td><input class="form-control" type="text" name="charge_no_"></td>
												<td><input class="form-control" type="number" name="mm_charge_"></td>
												</tr>
												</tbody>
												</table>
												<br>
												<center>
												<button class="btn btn-danger" onclick="mm_generator(($('#mm_body tr').length)-1);">Delete Last Charge <i class="fas fa-minus-circle"></i></button>
												<button class="btn btn-success" onclick="mm_generator(($('#mm_body tr').length)+1);">Add One More Charge <i class="fas fa-plus-circle"></i></button>
												</center>
                                            </div>
											
											<div id="option1" class="form-group">
                                                <label class="control-label mb-1">Maximum Fee Amount</label>
                                                <input class="form-control" type="number" name="fee_max_amount" min="0" value="0">
                                            </div>
											
											
                                            <div>
                                                <button id="submitButton" type="submit" class="btn btn-lg btn-info btn-block" onclick="addNewFeeEntity();">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span >Register This Fee Type</span>
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
		$("#submitButton").attr("onclick","editFeeEntity('.$id.');");
	});
	</script>
	';
}
?>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllFeeTypes();
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

function packChargesDetails(){
	var count = $('#mm_body tr').length;
	data = [];
	for(i=1;i<=count;i++){
		data[$('input[name=charge_no_'+i+']').val()] = $('input[name=mm_charge_'+i+']').val();
		if(i==count) return data;
	}
}

function getAllFeeTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/feeTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#feeType_id').prop('disabled',false);
			$('#feeType_id')
				 .append($('<option></option>')
							.attr("value",value.ID)
							.text(value.fee_full_name+" ("+value.fee_for+")")); 
			});
	  }
});
});
}

//Add New
function addNewFeeEntity(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/feeManager",
	  data: {
		  token: $.cookie('token'),
			fee_type_id: $('#feeType_id').val(),
			fee_method: $('#fee_method').val(),
			fee_max_amount: $('input[name=fee_max_amount]').val(),
			packed_structure:  $.extend({}, packChargesDetails())
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
function editFeeEntity(id){
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/feeManager/"+id,
	  data: {
			 token: $.cookie('token'),
			fee_type_id: $('#feeType_id').val(),
			fee_method: $('#fee_method').val(),
			fee_max_amount: $('input[name=fee_max_amount]').val(),
			packed_structure:  $.extend({}, packChargesDetails())
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