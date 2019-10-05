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
			<h3><i class="fas fa-check-circle"></i> Fill Fee Structure</h3><br>
			<div class="row">
				<div class="form-group col col-3">
					<span class="label">Choose Fee Entity ID</span>
				</div>
				<div class="form-group col col-5">
					<select id="fee_entity_ID" class="form-control" onchange="hello()"></select>
				</div>
			</div>
			<div class="row">
			<div class="col">
				<button id="start" class="btn btn-success" onclick="getEntity($('#fee_entity_ID').val())">Load Fee Structure Sheet For Applicable Sections/Standards</button>
				<br><br>
				<p id="displayText"></p>
				<br>
				<button id="saveFeeStructure" class="btn btn-success" onclick="saveFee(document.getElementById('fee_entity_ID').value);">Save / Update</button>
			</div>
			</div>
		</div>
	</div>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i><span id="sectionText"></span>Fee Charges For Different <span class="sectionsStandards">Sections/Standards</span></h3>
                                    <div class="table-responsive">
									<form id="feeDataAll" method="POST">
										<input type="hidden" name="type" id="sectionsStandards">
                                        <table class="table" id="evaluationsTable">
                                            <thead>
                                                <tr>
                                                    <th class="sectionsStandards">Sections/Standard</th>
													<th id="fee">Charges</th>
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
<input type="hidden" id="fullString">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllFeeEntities();
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

function getAllFeeEntities(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/feeEntities?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) { 
			$('#fee_entity_ID')
				 .append($('<option></option>')
							.attr("value",value.ID)
							.text(value.fee_type_info+" (Method - "+value.fee_method+")")); 
			});
			$('#fee_entity_ID').select2();
	  }
});
});
}

function doSum(item){
		sum = 0;
		sectionORstandardID = item.parent().attr('sectionORstandardID');
		values = $('div[sectionORstandardID='+sectionORstandardID+'] input.individualQuestionMarks');
		$(values).each(function() {
			if(!isNaN(parseInt($(this).val()))){
			sum = parseInt(sum) + parseInt($(this).val());
			return;
			}
		});
		$('div[sectionORstandardID='+sectionORstandardID+'] input.totalMarksIndividual').val(sum);
	}

function getEntity(id){
	$('#setFee').prop('disabled',true);
					$(document).ready(function(){
						$.ajax({
							type: 'GET',
							url: "{{getHomeURL()}}/api/feeManager/"+id+"?token="+$.cookie('token'),
							success: function(resultData) {
								var data = resultData.data;
								type = data[6][0];
								fee_type = data[1][0];
								if(type=='sections') getSectionsByFeeType(fee_type);
								else getStandardsByFeeType(fee_type);
								getFee(id);
								d = data[2][0];
								if(d==1){
									setTimeout(function(){
										$('.totalMarksIndividual').prop('disabled',false);
									},1000);
								}
								e = data[3][0];
								obj = data[4];
								fullString = "";
								count=1;
								for (var key in obj) {
									current = '<input style="width: 100% !important;" name="giveNameHereQ'+count+'" question="'+key+'" class="form-control individualQuestionMarks" type="number" min="0" max="'+obj[key]+'" oninput="doSum($(this));" onchange="doSum($(this));" placeholder="'+key+'">';
									fullString += current;
									count++;
								}
								$('#fullString').val(fullString);
								$('#evaluation_method').val(d);
								$('#max_fee').val(e);
								$('#fee').text("Fee Structure (Maximum Total Of "+e+")");
								$('#displayText').html('');
								if(d==1) $('#displayText').html('This Fee Entity follows Method 1. You have to fill only total fee out of the maximum fee of <strong>'+e+'</strong> of each section or standard one by one.');
								if(d==2) $('#displayText').html('This Fee Entity follows Method 2. You have to fill fee for each charge for each section or standard one by one.');
							},
							error: function(){
								$('#displayText').html('Make sure the details are correct.');
							}
					});
					});
					}
					
					
function getStandardsByFeeType(id){
	$('.sectionsStandards').html('Standards');
	$('#sectionsStandards').val('standards');
	$('#evaluationsTable').DataTable().clear().destroy();
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
		paging: false,
        ajax: '{{getHomeURL()}}/api/standardsByFeeType/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'standard_full_name'},
			{render: function(data, type, row){
				method = $('#evaluation_method').val();
				maxMarks = $('#max_fee').val();
				if(method==1) content = '<input style="width: 100% !important;" name="T'+row.ID+'" class="form-control" type="number" min="0" max="'+maxMarks+'" name="ob_fee_'+row.ID+'">';
				else{
					fullString = $('#fullString').val();
					fullString = fullString.replace(/giveNameHere/g,"S"+row.ID);
					totalMarksString = '<input class="totalMarksIndividual form-control" name="T'+row.ID+'" type="number" placeholder="Total Fees" disabled>';
					content = '<div sectionORstandardID="'+row.ID+'" class="form-inline group-fee-individual">'+fullString+totalMarksString+'</div>';
				}
				return content;
				}
			}
        ]
    });
	
});
}

function getSectionsByFeeType(id){
	$('.sectionsStandards').html('Sections');
	$('#sectionsStandards').val('sections');
	$('#sectionsStandards').val('sections');
	$('#evaluationsTable').DataTable().clear().destroy();
$(document).ready(function(){
	 $('#evaluationsTable').DataTable({
		paging: false,
        ajax: '{{getHomeURL()}}/api/sectionsByFeeType/'+id+"?token="+$.cookie('token'),
		columns: [
            {data: 'section_full_name'},
			{render: function(data, type, row){
				method = $('#evaluation_method').val();
				maxMarks = $('#max_fee').val();
				if(method==1) content = '<input style="width: 100% !important;" name="T'+row.ID+'" class="form-control" type="number" min="0" max="'+maxMarks+'" name="ob_fee_'+row.ID+'">';
				else{
					fullString = $('#fullString').val();
					fullString = fullString.replace(/giveNameHere/g,"S"+row.ID);
					totalMarksString = '<input class="totalMarksIndividual form-control" type="number" placeholder="Total Fees" disabled>';
					content = '<div sectionORstandardID="'+row.ID+'" class="form-inline group-fee-individual">'+fullString+totalMarksString+'</div>';
				}
				return content;
				}
			}
        ]
    });
	
});
}

function saveFee(id){
		$(document).ready(function(){
						$.ajax({
							type: 'POST',
							url: "{{getHomeURL()}}/api/fillFee/"+id+'?token='+$.cookie('token'),
							data: $('#feeDataAll').serialize(),
							success: function(resultData) {
							if(resultData.status==201) showToast(0,resultData.message+"<br>Error(s): "+resultData.error);
							if(resultData.status==200) showToast(1,resultData.message);
							}			
					});
					});
}

function getFee(id){
	$('#getFee').append('<div id="loader" class="page-loader__spin"></div>');
	setTimeout(function(){
		$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/fillFee/"+id+'?token='+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData;
		  $.each(data, function(key,value) { 
				$('input[name='+key+']').val(value);
				if(key.startsWith('S')) doSum($('input[name='+key+']'));
			});
			$('#loader').hide();
			$('#setFee').prop('disabled',false);
			if(resultData.status==201) showToast(0,resultData.message+"<br>Error(s): "+resultData.error);
	  }
});
});
$('#loader').remove();
	},1000);
}
</script>
@include('home.footer')