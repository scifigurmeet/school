<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
<style>
		@import url('https://fonts.googleapis.com/css?family=Nunito&display=swap');
		* {
			font-family: 'Nunito', sans-serif;
		}
		@media (max-width:600px)  {
			.login-content{
				margin-bottom: 150px !important;
			}
		}
	</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5" style="background:url('images/school.jpg');">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content" style="box-shadow: 1px 1px 10px 1px grey;">
						<?php if(isset($_GET['loginFirst'])){?> 
						<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> You need to login first.</div>
						<?php }?>
						<?php if(isset($_GET['loggedOut'])){?> 
						<div class="alert alert-warning"><i class="fas fa-check-circle"></i> You're successfully logged out.</div>
						<?php }?>
						<div class="alert alert-danger" id="wrongCredentials" style="display:none;"><i class="fas fa-exclamation-circle"></i> Username or Password you entered is wrong.</div>
						<div class="alert alert-success" id="loginSuccessful" style="display:none;"><i class="fas fa-sync fa-spin"></i>&nbsp;&nbsp;Login Successful, just a second...</div>
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form id="login" action="" method="post">
							@csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" id="username" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox float-right">
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                            </form>
							<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" onclick="validateLogin();">sign in&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
	
	<script>
	function validateLogin(){
		jQuery.ajax({
		  type: 'POST',
		  url: "{{getHomeURL()}}/api/login",
		  data: jQuery("#login").serialize(),
		  success: function(response) {
			  var status = response.status;
			  if(status==200) {
				  jQuery(".alert").hide();
				  jQuery("#loginSuccessful").show();
				  username = $('#username').val();
				  token = response.data.token;
				  sendToLogin(username,token);
			  }
			  else {
				  jQuery(".alert").hide();
				  jQuery("#wrongCredentials").show();
			  }
		  }
		});
	}
	function sendToLogin(username,token){
		jQuery.ajax({
		  type: 'POST',
		  url: "{{getHomeURL()}}/home",
		  data: {
			  "username":username,
			  "token":token,
			  "_token":$("input[name=_token]").val()
		  },
		  success: function(response) {
			window.location.replace("home");
		  }
		});
	}

$(document).keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    validateLogin();
    return false;  
  }
});   
</script>

</body>

</html>
<!-- end document-->