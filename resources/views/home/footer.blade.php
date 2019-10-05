<div class="row">
                            <div class="col-md-12">
                               <!-- <div class="copyright">
                                    <p>School Management System. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/trumbowyg.min.js"></script>

	
	<style>
	/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
	</style>

    <!-- Main JS-->
    <script src="js/main.js"></script>
	<script>
	$(document).ready(function(){
		//$(document).ajaxError(function() {
		//location.reload();
		//});
	$('table').on('draw.dt', function() {
    $('.dataTables_wrapper a:not([href])').attr("href", "#");
		});
	$('select').select2({
		dropdownParent: $("#mediumModal")
	});
	});
	
	$(document).ready(function(){
			$('.toast').css('display','none');
			$('body').after($('.toast'));
	});
	
	function showToast(statusCode,message){
		$('.toast').attr('data-autohide',true);
		$('.toast').attr('data-delay',5000);
		$('body').addClass('bgoverlay');
		$('.toast').removeAttr('style');
	if(statusCode==1){
		$('#status').html('<span style="color:green; font-size: 110%;"><i class="fas fa-check-circle"></i> Success</span>');
		$('#message').html(message);
		$('.toast').toast('show');
	}
	else {
		$('.toast').removeAttr('data-delay');
		$('.toast').attr('data-autohide',false);
		$('#status').html('<span style="color:red; font-size: 110%;"><i class="fas fa-times-circle"></i> Error</span>');
		$('#message').html(message);
		$('.toast').toast('show');
	}
		
	}
	
	$('.toast').on('hidden.bs.toast', function () {
		$('body').removeClass('bgoverlay');
	})
	
	String.prototype.ucwords = function() {
    str = this.toLowerCase();
    return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
        function($y){
            return $y.toUpperCase();
        });
}
	</script>
	<style>
	@keyframes moveLeft {
	  0%   {margin-left: 0px;}
	  100% {margin-left: -300px;}
	}
	@keyframes moveRight {
	  0%   {margin-left: -300px;}
	  100% {margin-left: 0px;}
	}
	.hideSidebar {
	-webkit-animation: moveLeft 0.5s ease-in-out 0s 1 forwards;
	}
	.showSidebar {
	-webkit-animation: moveRight 0.5s ease-in-out 0s 1 forwards;
	}
	</style>
	<script>
	function hideSidebar(){
		$("aside").removeClass("showSidebar");
		$(".page-container").removeClass("showSidebar");
		$(".header-desktop").removeClass("showSidebar");
		$("aside").addClass("hideSidebar");
		$(".page-container").addClass("hideSidebar");
		$(".header-desktop").addClass("hideSidebar");
		$("#showMenuButton").show(500);

	}
	function showSidebar(){
		$("aside").removeClass("hidSidebar");
		$(".page-container").removeClass("hidSidebar");
		$(".header-desktop").removeClass("hidSidebar");
		$("aside").addClass("showSidebar");
		$(".page-container").addClass("showSidebar");
		$(".header-desktop").addClass("showSidebar");
		$("#showMenuButton").hide();

	}
	</script>
</body>

</html>
<!-- end document-->
