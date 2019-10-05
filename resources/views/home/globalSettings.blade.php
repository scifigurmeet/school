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
	<h3><i class="fas fa-info-circle"></i>&nbsp;&nbsp;School Information</h3><br>
	This section allows you to add/edit the Basic School Information.
	<br><br>
	<form id="schoolInfo">
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Full School Name</label>
        </div>
        <div class="col col-md-9">
            <input type="text" name="school_full_name" class="form-control">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Short School Name</label>
        </div>
        <div class="col col-md-9">
            <input type="text" name="school_short_name" class="form-control">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">School Address</label>
        </div>
        <div class="col col-md-9">
            <textarea name="school_address" class="form-control"></textarea>
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Town or City</label>
        </div>
        <div class="col col-md-9">
            <input type="text" name="town_city" class="form-control">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">District</label>
        </div>
        <div class="col col-md-9">
            <input type="text" name="district" class="form-control">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">State</label>
        </div>
        <div class="col col-md-9">
            <input type="text" name="state" class="form-control">
        </div>   
    </div>
	<div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Pincode</label>
        </div>
        <div class="col col-md-9">
            <input type="text" name="pincode" class="form-control" maxlength="6" size="6">
        </div>   
    </div>
	</form>
	<button class="btn btn-success" onclick="saveSchoolInfo();">Save&nbsp;&nbsp;<i class="fas fa-save"></i></button>
	
	</div>
	<div class="user-data m-b-30 threeD" style="padding: 30px;">
	<h3><i class="fas fa-image"></i>&nbsp;&nbsp;Background Image</h3><br>
	This allows you to change the Web Interface Background Image.
	<br><br>
	<div class="row form-group">
        <div class="col col-md-2">
            <label class=" form-control-label">Choose Image</label>
        </div>
        <div class="col col-md-10">
			<form method="POST" enctype="multipart/form-data" id="uploadImage">
            <input type="file" name="file">
			</form>
        </div>   
    </div>
	<button class="btn btn-success" onclick="changeBackgroundImage()">Upload & Change Image&nbsp;&nbsp;<i class="fas fa-upload"></i></button>
	
	</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	getSchoolInfo();
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

function saveSchoolInfo(){
	$.ajax({
	url: '{{getHomeURL()}}/api/saveSchoolInfo?token='+$.cookie('token'), // Url to which the request is send
	type: 'POST',             // Type of request to be send, called as method
	data: $('#schoolInfo').serialize(), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	success: function(response)   // A function to be called if request succeeds
	{	
		if(response.status==200) showToast(1,response.message);
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	}
	});
}

function getSchoolInfo(){
	$.ajax({
	url: '{{getHomeURL()}}/api/getSchoolInfo', // Url to which the request is send
	type: 'GET',             // Type of request to be send, called as method // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	success: function(response)   // A function to be called if request succeeds
	{	
		data = response.data;
		$.each(data,function(key,value){
			try{
				$('input[name='+value.option_name+']').val(value.option_value);
			}
			catch(ex){}
			try{
				$('textarea[name='+value.option_name+']').html(value.option_value);
			}
			catch(ex){}
		});
	}
	});
}

function changeBackgroundImage(){
	$.ajax({
	url: '{{getHomeURL()}}/api/changeBackgroundImage?token='+$.cookie('token'), // Url to which the request is send
	type: 'POST',             // Type of request to be send, called as method
	data: new FormData($('#uploadImage')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	contentType: false,       // The content type used when sending data to the server.
	cache: false,             // To unable request pages to be cached
	processData:false,        // To send DOMDocument or non processed data file it is set to false
	success: function(response)   // A function to be called if request succeeds
	{	
		if(response.status==200){
			$('.page-container').css('background',"url('"+response.data.url+"')");
		showToast(1,response.message);}
		else showToast(0,response.message+"<br>Error(s): "+response.error);
	}
	});
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