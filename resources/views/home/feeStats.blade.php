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
                                        <i class="zmdi zmdi-account-calendar"></i>Fee Statistics</h3>
			<div class="row">
				<div class="col col-md-6" style="padding: 0px 50px 30px 50px;">
					<span class="label">Choose Fee Type</span><br>
					<select id="fee_type" onchange="getAllStudentsFees(this.value)">
					</select><br>
					<button class="btn btn-success" onclick="getAllStudentsFees($('#fee_type').val())">Fetch Details</button>
				</div>
			</div>
			<div class="row">
				<div class="col" style="padding: 0px 20px 30px 20px;">
					<div class="table-responsive">
                                        <table class="table" id="feeTable">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Student Name</th>
                                                    <th>Section (Standard)</th>
                                                    <th>School Roll No. (Class Roll No.)</th>
                                                    <th>Fee Amount</th>
                                                    <th>Status</th>
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

function getAllStudentsFees(id){
$(document).ready(function(){
	$('#feeTable').DataTable().clear().destroy();
	 $('#feeTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/feeStats/'+id+'?token='+$.cookie('token')+"&student_id="+id,
		columns: [
			{data: 'student_id'},
			{render: function(data, type, row){
			return row.student_first_name + " " +row.student_last_name;
			}},
			{render: function(data, type, row){
			return row.section_full_name + " (" +row.standard_full_name + ")";
			}},
			{render: function(data, type, row){
			return row.school_roll_no + " (" +row.section_roll_no + ")";
			}},
			{data: 'fee_amount'},
			{data: 'fee_status'},
			{render: function(data, type, row){
			if(row.fee_status=="DUE") return '<div class="btn-group"><button onclick="getPayReceiptWithStructureID('+row.ID+')" class="btn btn-success">Pay Now</button>';
			if(row.fee_status=="PAID") return '<div class="btn-group"><button onclick="" class="btn btn-danger">Print Receipt</button>';
		}}
        ]
    });
});
}

function getAllFeeTypes(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/feeTypes"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#fee_type')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.fee_full_name)); 
			});
			$('#fee_type').select2();
	  }
});
});
}

</script>
@include('home.footer')