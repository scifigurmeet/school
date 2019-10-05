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
			<h3><i class="fas fa-check-circle"></i> Messages and Notifications</h3><br>
			<div class="row">
				<div class="form-group col col-2">
					<span class="label">Message To</span>
				</div>
				<div class="form-group col col-5">
					<select id="message_to" class="form-control" name="message_to" onchange="displayLogic(this.value);">
					<option value="allSchoolStudents" selected>All Students of School</option>
					<option value="allSchoolEmployees" selected>All Employees of School</option>
					<option value="selectiveStudents">Selective Student(s)</option>
					<option value="selectiveSections">Selective Section(s)</option>
					<option value="selectiveStandards">Selective Standard(s)</option>
					<option value="selectiveEmployees">Selective Employee(s)</option>
					</select>
				</div>
			</div>
			<div class="row" id="sections">
				<div class="form-group col col-2">
					<span class="label">Choose Section(s)</span>
				</div>
				<div class="form-group col col-5">
					<select id="section_id" class="form-control" name="section_id" multiple>
					</select>
				</div>
			</div>
			<div class="row" id="standards">
				<div class="form-group col col-2">
					<span class="label">Choose Standard(s)</span>
				</div>
				<div class="form-group col col-5">
					<select id="standard_id" class="form-control" name="standard_id" multiple>
					</select>
				</div>
			</div>
			<div class="row" id="students">
				<div class="form-group col col-2">
					<span class="label">Choose Student(s)</span>
				</div>
				<div class="form-group col col-5">
					<select id="student_id" class="form-control" name="student_id" multiple>
					</select>
				</div>
			</div>
			<div class="row" id="employees">
				<div class="form-group col col-2">
					<span class="label">Choose Employee(s)</span>
				</div>
				<div class="form-group col col-5">
					<select id="employee_id" class="form-control" name="employee_id" multiple>
					</select>
				</div>
			</div>
			<input type="hidden" name="messageStatusID" value="newDraft">
			<div class="row" style="padding:20px;">
				<button class="btn btn-secondary" onclick="newDraft();">New <i class="fa fa-plus-circle"></i></button>
				<button class="btn btn-info" onclick="saveDraft();">Save <i class="fa fa-save"></i></button>
				<button id="delete" style="display:none;" class="btn btn-danger" onclick="deleteDraftAndNewDraft($('input[name=messageStatusID]').val());">Delete <i class="fa fa-trash"></i></button>
				<button class="btn btn-success" onclick="sendMessage();">Send <i class="fa fa-share"></i></button>
			</div>
		</div>
	</div>
			<div class="user-data m-b-30 threeD" style="padding:25px;">
						<h3 class="title-3 m-b-30">
							<i class="zmdi zmdi-account-calendar"></i><span id="sectionText"></span>Message Content</h3>
							<p id="displayText" style="font-size: 120%;">
					Currently Viewing - <span id="currentText">New Draft</span>
					</p>
					<form method="post">
						<div id="messageArea"></div>
					</form>
			</div>
				<div class="user-data m-b-30 threeD" id="sentMessages">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>All Sent Messages</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="messagesTable">
                                            <thead>
                                                <tr>
													<th>Message ID</th>
                                                    <th>Content</th>
                                                    <th>Last Saved</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                </div>
				<div class="user-data m-b-30 threeD" id="receivedMessages">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>All Received Messages</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="receivedMessagesTable">
                                            <thead>
                                                <tr>
													<th>Message ID</th>
                                                    <th>Content</th>
                                                    <th>Received On</th>
                                                    <th>Sent By</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                </div>
	</div>
</div>

<input type="hidden" id="sendTo" value="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!-- Modal -->
<div class="modal fade" id="mediumModal" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-eye"></i> <span id="modalTitle">Message Viewer</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<div id="msgText"></div>
						</div>
					</div>
				</div>
</div>
<script>
function viewMessage(id){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/chat/"+id,
	  data: {token: $.cookie('token')},
      success: function(response) {
		  $("#mediumModal").modal('show');
		  if(response.status==200){
			var data = response.data.content;
			$('#msgText').html(data);
			  }
		else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
});
}


function displayLogic(value){
	if(value=='allSchoolStudents'){
		$('#sections, #standards, #students, #employees').hide();
		$('#sendTo').val('all');
	}
	if(value=='allSchoolEmployees'){
		$('#sections, #standards, #students, #employees').hide();
		$('#sendTo').val('allEmployees');
	}
	if(value=='selectiveStudents'){
		$('#sections, #standards, #employees').hide(); $('#students').show();
		$('#sendTo').val('students');
		
	}
	if(value=='selectiveSections'){
		$('#students, #standards, #employees').hide(); $('#sections').show();
		$('#sendTo').val('sections');
	}
	if(value=='selectiveStandards'){
		$('#sections, #students, #employees').hide(); $('#standards').show();
		$('#sendTo').val('standards');
	}
	if(value=='selectiveEmployees'){
		$('#sections, #students, #standards').hide(); $('#employees').show();
		$('#sendTo').val('employees');
	}
}

$(document).ready(function(){
	displayLogic($('#message_to').val());
	$("#mediumModal").appendTo("body");
	getAllSections();
	$('#messageArea').trumbowyg();
	getAllMessages();
	getAllStandards();
	getAllStudents();
	getAllEmployees();
	getAllReceivedMessages();
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
			$('#message_to').select2();
	  }
});
});
}

function getAllEmployees(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/employees",
	  data: {token: $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=employee_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.employee_full_name+" ("+value.type_name+")")); 
			});
			$('#employee_id').select2();
	  }
});
});
}

function getAllStudents(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/students",
	  data: {token: $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=student_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.student_full_name+" ("+value.student_last_name+") | "+value.standard_section_full_name)); 
			});
			$('#student_id').select2();
	  }
});
});
}


function getAllStandards(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standards",
	  data: {token: $.cookie('token')},
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('select[name=standard_id]')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+" ("+value.standard_short_name+")")); 
			});
			$('#standard_id').select2();
	  }
});
});
}

function loadMessage(id){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/chat/"+id,
	  data: {token: $.cookie('token')},
      success: function(response) {
		  if(response.status==200){
			var data = response.data.content;
			$('#messagesTable').DataTable().ajax.reload();
			$('#delete').show();
			$('input[name=messageStatusID]').val(response.data.ID);
			$('#currentText').text("Draft #"+response.data.ID+" | Last Saved: "+response.data.dateTime);
		  $('#messageArea').html(data);
			  showToast(1,response.message);
			  }
		else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
});
}

function newDraft(){
	$('input[name=messageStatusID]').val('newDraft');
	content: $('#messageArea').html('');
	$('#currentText').text("New Draft");
	$('#delete').hide();
	showToast(1,'New Message Draft Loaded Successfully.');
}

function deleteDraftAndNewDraft(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/chat"+"?token="+$.cookie('token'),
      data: {
		  id: id
	  },
      success: function(response) {
		  if(response.status==200){
			  $('#messagesTable').DataTable().ajax.reload();
			  showToast(1,response.message);
			  newDraft();
			  }
		else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
}

function deleteDraft(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/chat"+"?token="+$.cookie('token'),
      data: {
		  id: id
	  },
      success: function(response) {
		  if(response.status==200){
			  $('#messagesTable').DataTable().ajax.reload();
			  showToast(1,response.message);
			  }
		else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
}

function saveDraft(check=false){
	$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/chat"+"?token="+$.cookie('token'),
      data: {
		  id: $('input[name=messageStatusID]').val(),
		  content: $('#messageArea').html()
	  },
      success: function(response) {
		  if(response.status==200){
			  $('#messagesTable').DataTable().ajax.reload();
			  if(check==false) showToast(1,response.message);
			  $('#delete').show();
			  $('input[name=messageStatusID]').val(response.data.draft_ID);
		  $('#currentText').text("Draft #"+response.data.draft_ID+" | Last Saved: "+response.data.last_saved);
			  }
		else showToast(0,response.message+'<br>Error(s): '+response.error);
	  }
});
}

function sendMessage(){
	$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/chat/send"+"?token="+$.cookie('token'),
      data: {
		  id: $('input[name=messageStatusID]').val(),
		  content: $('#messageArea').html(),
		  send_to: $('#sendTo').val(),
		  students_ids: $('#student_id').val().join(','),
		  standard_ids: $('#standard_id').val().join(','),
		  section_ids: $('#section_id').val().join(','),
		  employee_ids: $('#employee_id').val().join(',')
	  },
      success: function(response) {
		  if(response.status==200){
			  showToast(1,response.message);
			  $('#messagesTable').DataTable().ajax.reload();
			  $('#delete').show();
			  $('input[name=messageStatusID]').val(response.data.message_ID);
		  $('#currentText').text("Message #"+response.data.message_ID+" | Message Sent Date-Time: "+response.data.sent_time);
			  }
		else showToast(0,response.message+'<br>Error(s): '+response.error);
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
}

function getAllMessages(){
$(document).ready(function(){
	 $('#messagesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/chat'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{render: function(data, type, row){
				return '<div style="max-width: 300px; max-height:150px; word-break: break-word; overflow-y:scroll; display:block">'+escapeHtml(row.content)+'</div>';}},
            {data: 'dateTime'},
            {data: 'status'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="loadMessage('+row.ID+')">Load <i class="fas fa-eye"></i></button><button class="btn btn-danger" onclick="deleteDraft('+row.ID+')">Delete  <i class="fas fa-times-circle"></i></button></div>';}}
        ]
    });
});
}

function getAllReceivedMessages(){
$(document).ready(function(){
	 $('#receivedMessagesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/messages'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{render: function(data, type, row){
				return '<div style="max-width: 300px; max-height:150px; word-break: break-word; overflow-y:scroll; display:block">'+escapeHtml(row.content)+'</div>';}},
            {data: 'dateTime'},
            {data: 'full_name'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewMessage('+row.ID+')">View <i class="fas fa-eye"></i></button></div>';}}
        ]
    });
});
}

function escapeHtml(text) {
  return text
	  .replace(/&amp/g, "&")
      .replace(/&lt;/g, "<")
      .replace(/&gt;/g, ">")
      .replace(/&quot;/g, '"')
      .replace(/&#039;/g, "'");
}
</script>
@include('home.footer')