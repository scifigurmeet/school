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
                                        <i class="zmdi zmdi-account-calendar"></i>Fee Payment Manager</h3>
			<div class="row">
				<div class="col">
					<div class="table-responsive">
                                        <table class="table" id="feeTable">
                                            <thead>
                                                <tr>
                                                    <th>Fee Name</th>
                                                    <th>Fee For</th>
                                                    <th>Fee Description</th>
                                                    <th>Payable Amount</th>
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
								
			<div class="user-data m-b-30 threeD" id="receipt" style="display:none;">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Fee Structure Details</h3>
			<div class="row">
				<div class="col" style="padding: 0px 50px 30px 50px;">
					Student ID: <span id="studentID"></span><br>
					Student Full Name: <b id="studentName"></b><br>
					Father's Name: <b id="studentFatherName"></b><br><br>
					<h4>Fee Details</h4><b id="feeDetails"></b><br><br>
					<h4>Fee Structure</h4><br>
					<table class="table table-borderd">
						<thead>
							<tr>
								<th>Charge Description</th>
								<th>Charge Amount</th>
							</tr>
						</thead>
						<tbody id="charges">
						</tbody>
						<tfoot>
							<tr>
								<th>Total Amount</th>
								<th id="total_payable_fee"></th>
							</tr>
						</tfoot>
					</table><br>
					<span class="label">Comments</span>
					<textarea id="comments" class="form-control"></textarea>
					<br>
					<button sID="" class="btn btn-danger" id="payFee" onclick="payFee($(this).attr('sID'));">Mark Fee As Paid</button>
				</div>
			</div>
            </div>
								
	</div>
</div>
<input type="hidden" id="student_id">
<style>
.modal {
  z-index: 99999;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
$(document).ready(function(){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/userTypeId",
      success: function(resultData) {getAllDueFees(resultData);
	  $('#student_id').val(resultData);}
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

function getAllDueFees(id){
$(document).ready(function(){
	$('#feeTable').DataTable().clear().destroy();
	 $('#feeTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/payFee/'+id+'?token='+$.cookie('token')+"&student_id="+id,
		columns: [
            {data: 'fee_full_name'},
            {data: 'fee_for'},
            {data: 'fee_description'},
            {data: 'total_payable_fee'},
			{render: function(data, type, row){
			if(row.fee_status=="DUE") return '<div class="btn-group"><button onclick="getPayReceiptWithStructureID('+row.ID+')" class="btn btn-success">Pay Now</button>';
			if(row.fee_status=="PAID") return '<div class="btn-group"><button onclick="" class="btn btn-danger">Print Receipt</button>';
		}}
        ]
    });
});
}

function getStudentDetails(id){
	$.ajax({
      type: 'GET',
      url: '{{getHomeURL()}}/api/students/'+id+'?token='+$.cookie('token')+"&student_id="+id,
      success: function(response) {
		  response = response.data;
		  $('#studentName').text(response.student_first_name+" "+response.student_last_name);
		  $('#studentFatherName').text(response.father_name);
		  $('#studentID').text(response.ID);
	  }
});
}

function payFee(id){
	$.ajax({
      type: 'POST',
      url: '{{getHomeURL()}}/api/payFee/'+id+'?token='+$.cookie('token')+"&student_id="+id,
	  data: {
		  student_id: $('#student_id').val(),
		  comments: $('#comments').val()
	  },
      success: function(response) {
		  if(response.status==200) showToast(1,response.message);
		  else if(response.status==201) showToast(0,response.message+"<br><b>Error(s):</b> "+response.error);
		  getAllDueFees($('#student_id').val());
	  }
});
}

function getPayReceiptWithStructureID(id){
	$('#receipt').show();
	 $('html, body').animate({
        scrollTop: $("#receipt").offset().top - 50
    }, 100);
	getStudentDetails($('#student_id').val());
	$.ajax({
      type: 'GET',
      url: '{{getHomeURL()}}/api/payFeeParticular/'+id+'?token='+$.cookie('token')+"&student_id="+id,
      success: function(response) {
		  $('#charges').html('');
		  $('#payFee').attr('sID',id);
		  $('#feeDetails').html(response.fee_full_name+" | "+response.fee_for+" | "+response.fee_description);
		  packedStructure = response.packed_structure;
		  feeStructure = response.fee_structure;
		  $('#total_payable_fee').text("₹ "+response.total_payable_fee);
		  var count = 1;
		  $.each(packedStructure,function(key,value){
			  $('#charges').append('<tr><td>'+key+'</td><td id="amount'+count+'"></td></tr>');
			  count++;
		  });
		  var count = 1;
		  $.each(feeStructure,function(key,value){
			  $('#amount'+count).text("₹ "+value);
			  count++;
		  });
	  }
});
}

</script>
@include('home.footer')