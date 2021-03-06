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
        New Room Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Rooms <button class="btn btn-success float-right" onclick="addNewModal();"><i class="fas fa-plus-circle"></i>Add New Room</button></h3>
                                    <div class="table-responsive">
                                        <table class="table" id="RoomsTable">
                                            <thead>
                                                <tr>
													<th>Room ID</th>
                                                    <th>Room Name</th>
                                                    <th>No. of Rows</th>
                                                    <th>No. of Seats (In Each Row)</th>
													<th>Total Seating Capacity</th>
													<th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
        </div>
	<div class="user-data m-b-30 threeD">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Seating Plan Generator </h3>
							<div style="padding: 0px 30px 30px 30px;">
										<span class="label">Choose Standards</span>
										<select id="standard_id" multiple></select><br>
										<span class="label">Choose Rooms</span>
										<select id="room_id" multiple></select>
										<br>
										<button class="btn btn-success">Generate Seating Plan</button>
							</div>
        </div>
	</div>
</div>
<script>
function addData(){
jQuery.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/newAdmission",
      data: jQuery("#new-admission").serialize(),
      success: function(response) { alert(response); }
});
}
</script>
<style>
.modal {
  z-index: 99999;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#mediumModal").appendTo("body");
	getAllRooms();
	getAllRoomsTwo();
	getAllStandards();
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
</script>
<!-- Modal -->
<div class="modal fade" id="mediumModal" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="mediumModalLabel"><i id="modal-icon" class="fas fa-plus-circle"></i> <span id="modalTitle">Add A New Room</span></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="roomsForm">
						<input type="hidden" name="ID" id="room_id">
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Room Name</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="text" id="hf-password" name="room_name" class="form-control">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Number of Rows</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="number" name="no_of_rows" class="form-control" min="0">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Number of Seats In Each Row</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <input type="number" name="no_of_seats_per_row" class="form-control" min="0">
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Description</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                                
                            </div>
							<div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="hf-password" class=" form-control-label">Comments</label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <textarea class="form-control" name="comments"></textarea>
                                                </div>
                                                
                            </div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" id="editConfirm" class="btn btn-primary" onclick="addNewRoom()">Confirm <i class="fas fa-check-circle"></i></button>
						</div>
					</div>
				</div>
</div>
<script>
function addNewModal(){
		$('#roomsForm').closest('form').find("input").val("");
		$('#roomsForm').closest('form').find("textarea").html("");
		$('#modalTitle').text('Add A New Room');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-plus-circle');
		$('#editConfirm').attr('onclick','addNewRoom();');
		$('.modal-footer').show();
		$('#mediumModal').modal('show');
}

function editModal(id){
		viewModal(id);
		$("#room_id").val(id);
		$('#modalTitle').text('Edit Room');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-pen-square');
		$('.modal-footer').show();
		$('#editConfirm').removeAttr('onclick');
		$('#editConfirm').attr('onclick','editRoom('+id+');');
		$('#mediumModal').modal('show');
}

function viewModal(id){
		viewForm(id);
		$('#modalTitle').text('Information View');
		$('#modal-icon').removeClass();
		$('#modal-icon').addClass('fas');
		$('#modal-icon').addClass('fas fa-eye');
		$('.modal-footer').hide();
}

function getAllStandards(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/standards"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#standard_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.standard_full_name+' ('+value.standard_short_name+')')); 
			});
			$('#standard_id').select2();
	  }
});
});
}

function getAllRoomsTwo(){
	$(document).ready(function(){
	 $.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/rooms"+"?token="+$.cookie('token'),
      success: function(resultData) {
		  var data = resultData.data;
		  $.each(data, function(key,value) {   
			$('#room_id')
				 .append($("<option></option>")
							.attr("value",value.ID)
							.text(value.room_name)); 
			});
			$('#room_id').select2();
	  }
});
});
}

function addNewRoom(){
var datay = $('#roomsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/rooms",
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#RoomsTable').DataTable().ajax.reload();
			$('#roomsForm').trigger("reset");
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+"<br>Error(s): "+response.error);
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

function getAllRooms(){
$(document).ready(function(){
	 $('#RoomsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{getHomeURL()}}/api/rooms'+"?token="+$.cookie('token'),
		columns: [
			{data: 'ID'},
			{data: 'room_name'},
            {data: 'no_of_rows'},
            {data: 'no_of_seats_per_row'},
            {data: 'seating_capacity'},
			{render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-info" onclick="viewModal('+row.ID+')">View <i class="fas fa-eye"></i><button><button class="btn btn-secondary" onclick="editModal('+row.ID+')">Edit <i class="fas fa-pen-square"></i><button><button class="btn btn-danger" onclick="deleteRoom('+row.ID+')">Delete  <i class="fas fa-times-circle"></i><button></div>';}}
        ]
    });
});
}

function viewForm(id){
	$.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/api/rooms/"+id+"?token="+$.cookie('token'),
      success: function(response) {
		  response = response.data;
		  form = document.getElementById('roomsForm');
		  for(var i=0; i < form.elements.length; i++){
				var e = form.elements[i];
				$('input[name='+e.name+']').val(response[e.name]);
				$('select[name='+e.name+']').val(response[e.name]);
				$('textarea[name='+e.name+']').text(response[e.name]);
			}
		$('#mediumModal').modal('show');
	  }
});
}

function deleteRoom(id){
	$.ajax({
      type: 'DELETE',
      url: "{{getHomeURL()}}/api/rooms/"+id+"?token="+$.cookie('token'),
	  data: {
        token: $.cookie('token')
        },
      success: function(response) {
		  $('#RoomsTable').DataTable().ajax.reload();
		  if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	  }
});
}

function editRoom(id){
var datay = $('#roomsForm').serializeArray();
datay.push({name: 'token', value: $.cookie('token')});
$.ajax({
      type: 'PUT',
      url: "{{getHomeURL()}}/api/rooms/"+id,
	  data: datay,
      success: function(response) {
			$('#mediumModal').modal('toggle');
			$('#RoomsTable').DataTable().ajax.reload();
			$('#roomsForm').trigger("reset");
			if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
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
</script>
@include('home.footer')