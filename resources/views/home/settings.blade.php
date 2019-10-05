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
        New Employee Addedd Successfully!
      </div>
    </div><br>
	<div class="user-data m-b-30 threeD" style="padding: 30px;">
	<h3><i class="fas fa-key"></i>&nbsp;&nbsp;Change Account Password</h3><br>
	This option enables you to change your user account password. Firstly, enter your existing password and then enter the new password twice and then click on the Change Password button.
	<br><br>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Enter Existing Password</label>
        </div>
        <div class="col col-md-3">
            <input type="password" name="existing_password" class="form-control">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Enter New Password</label>
        </div>
        <div class="col col-md-3">
            <input type="password" name="new_password_1" class="form-control" onfocusout="matchPasswords();">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Enter New Password Again</label>
        </div>
        <div class="col col-md-3">
            <input type="password" name="new_password_2" class="form-control" oninput="matchPasswords();">
        </div>   
		<div class="col col-md-6">
            <span id="displayText"></span>
        </div> 
    </div>
	<button onclick="changePassword();" class="btn btn-danger">Change Password&nbsp;&nbsp;<i class="fas fa-unlock"></i></button>
	
	</div>
	</div>
</div>
<script>
function matchPasswords(){
	var pass1 = $('input[name=new_password_1]').val();
	var pass2 = $('input[name=new_password_2]').val();
	if(pass1 != pass2) $('#displayText').html('<span class="badge badge-danger">Passwords do not match!</span>');
	else $('#displayText').html('');
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
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

function changePassword(){
$.ajax({
      type: 'POST',
      url: "{{getHomeURL()}}/api/changePassword?token="+$.cookie('token'),
	  data: {
		  old_pass: $('input[name=existing_password]').val(),
		  new_pass1: $('input[name=new_password_1]').val(),
		  new_pass2: $('input[name=new_password_2]').val()
	  },
      success: function(response) {
			if(response.status==200) showToast(1,response.message);
			else showToast(0,response.message+"<br>Error(s): "+response.error);
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
</script>
@include('home.footer')