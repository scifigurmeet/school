<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="//stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/ui/trumbowyg.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
	
	<script>
	$(document).ready(function(){
		abc = $(location).attr("href").split('/');
		check = abc[abc.length-1];
		$('a[href='+check+']').parent().addClass('active');
		$('a[href='+check+']').parent().parent().prev().click();
		setTimeout(function(){
			$('#search').select2();
		},1000);
	});
	</script>
	
	<style>
		@import url('https://fonts.googleapis.com/css?family=Nunito&display=swap');
		* {
			font-family: 'Nunito', sans-serif;
		}
		.dataTables_wrapper{
			margin: 20px;
		}
		.table-data{
			height:auto !important;
		}
		.dataTable{
			margin-bottom: 10px !important;
			width: 100% !important;
		}
		.threeD {
			box-shadow: 1px 1px 25px 1px grey;
		}
		input[type=search] {
			border: 1px solid grey;
			border-radius:15px;
			padding: 5px 10px;
		}
		.btn{
			margin:2px;
		}
		th,td{
			text-align: center !important;
		}
		.toast, .toast.show{
		  background-color: white !important;
		  max-width: 100%;
		  display:inline-block;
		  min-width: 350px;
		}
		#showMenuButton{
			position: fixed;
			top: 2.5vh;
			left: -5px;
			z-index: 999999;
		}
		#showMenuButton, #hideMenuButton{
			border-radius: 100%;
		}
		.navbar-sidebar .fas{
			font-size: 150%;
		}
		@media (max-width:600px)  {
			.main-content{
				padding-bottom: 150px;
			}
			.header-button{
			margin-top: -105px;
			}
			.header-desktop{
				height: 65px;
			}
		}
		ul.navbar-mobile__list{
			padding-left: 10px !important;
		}
		ul.navbar-mobile__list  ul.navbar__sub-list{
			padding-left: 30px !important;
		}
		.toast{
			z-index: 99999999 !important;
			position: fixed;
			top: 85px;
			right: 10px;
			max-width: 600px !important;
		}
		.bgoverlay{
			opacity: 0.25 !important;
			background-color: black !important;
		}
	</style>
</head>

<body class="animsition">
<button id="showMenuButton" class="btn btn-warning" style="display: none;" onclick="showSidebar();"><i class="fas fa-chevron-circle-right"></i></button>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="home">
                           <img src="images/icon/logo.png" alt="CoolAdmin" style="height: 65px !important; margin: 0px 60px;">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
					<ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="home">
                                <i class="fas fa-chart-line"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="attendance">
                                <i class="fas fa-calendar-check"></i>Attendance</a>
                        </li>
						<li>
                            <a href="chat">
                                <i class="fas fa-comments"></i>Messages</a>
                        </li>
						<li>
                            <a href="chat">
                                <i class="fas fa-sms"></i>SMS Notifications</a>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-rupee-sign"></i>Fee Management</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="feeTypes">
										<i class="fas fa-stream"></i>Fee Types</a>
								</li>
								<li>
									<a href="feeManager">
										<i class="fas fa-stream"></i>Fee Manager</a>
								</li>
								<li>
									<a href="feeEntities">
										<i class="fas fa-stream"></i>Fee Entities</a>
								</li>
								<li>
									<a href="fillFee">
										<i class="fas fa-stream"></i>Fee Charges</a>
								</li>
								<li>
									<a href="payFee">
										<i class="fas fa-stream"></i>Fee Payment</a>
								</li>
								<li>
									<a href="feeStats">
										<i class="fas fa-stream"></i>Fee Statistics</a>
								</li>
							</ul>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-medal"></i>Examination</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="evaluations">
										<i class="fas fa-stream"></i>Evaluations</a>
								</li>
								<li>
									<a href="evaluationsEntities">
										<i class="fas fa-stream"></i>Evaluation Entities</a>
								</li>
								<li>
									<a href="fillMarks">
										<i class="fas fa-stream"></i>Fill Marks</a>
								</li>
							</ul>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-book"></i>Library</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="bookCategories">
										<i class="fas fa-stream"></i>Books Categories</a>
								</li>
								<li>
									<a href="books">
										<i class="fas fa-stream"></i>Books</a>
								</li>
								<li>
									<a href="issueBooks">
										<i class="fas fa-stream"></i>Issue Books</a>
								</li>
							</ul>
                        </li>
						<li>
                            <a href="students">
                                <i class="fas fa-users"></i>Students</a>
                        </li>
						<li>
                            <a href="standards">
                                <i class="fas fa-sort-numeric-up"></i>Standards</a>
                        </li>
						<li>
                            <a href="sections">
                                <i class="fas fa-sort-alpha-up"></i>Sections</a>
                        </li>
						<li>
                            <a href="subjects">
                                <i class="fas fa-chalkboard-teacher"></i>Subjects</a>
                        </li>
						<li>
                            <a href="employees">
                                <i class="fas fa-user-tie"></i>Employees</a>
                        </li>
						<li>
                            <a href="assignRolls">
                                <i class="fas fa-user-tie"></i>Roll No. Assignment</a>
                        </li>
						<li>
                            <a href="rooms">
                                <i class="fas fa-chair"></i>Rooms & Seating Plan</a>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Types Management</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="subjectTypes">
										<i class="fas fa-stream"></i>Subject Types</a>
								</li>
								<li>
									<a href="employeesTypes">
										<i class="fas fa-stream"></i>Employee Types</a>
								</li>
							</ul>
                        </li>
						<?php
						if(getUserType()=='student'){
						?>
						<li>
                            <a href="viewAttendance">
                                <i class="fas fa-user-tie"></i>Attendance</a>
                        </li>
						<li>
                            <a href="viewResult">
                                <i class="fas fa-user-tie"></i>Result</a>
                        </li>
						<li>
                            <a href="viewFee">
                                <i class="fas fa-user-tie"></i>Fee</a>
                        </li>
						<?php } ?>
                    </ul>
			   </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="home">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
				<button id="hideMenuButton" class="btn btn-success" style="margin-left:25px;" onclick="hideSidebar();"><i class="fas fa-chevron-circle-left"></i></button>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="home">
                                <i class="fas fa-chart-line"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="attendance">
                                <i class="fas fa-calendar-check"></i>Attendance</a>
                        </li>
						<li>
                            <a href="chat">
                                <i class="fas fa-comments"></i>Messages</a>
                        </li>
						<li>
                            <a href="chat">
                                <i class="fas fa-sms"></i>SMS Notifications</a>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-rupee-sign"></i>Fee Management</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="feeTypes">
										<i class="fas fa-stream"></i>Fee Types</a>
								</li>
								<li>
									<a href="feeManager">
										<i class="fas fa-stream"></i>Fee Manager</a>
								</li>
								<li>
									<a href="feeEntities">
										<i class="fas fa-stream"></i>Fee Entities</a>
								</li>
								<li>
									<a href="fillFee">
										<i class="fas fa-stream"></i>Fee Charges</a>
								</li>
								<li>
									<a href="payFee">
										<i class="fas fa-stream"></i>Fee Payment</a>
								</li>
								<li>
									<a href="feeStats">
										<i class="fas fa-stream"></i>Fee Statistics</a>
								</li>
							</ul>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-medal"></i>Examination</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="evaluations">
										<i class="fas fa-stream"></i>Evaluations</a>
								</li>
								<li>
									<a href="evaluationsEntities">
										<i class="fas fa-stream"></i>Evaluation Entities</a>
								</li>
								<li>
									<a href="fillMarks">
										<i class="fas fa-stream"></i>Fill Marks</a>
								</li>
							</ul>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-book"></i>Library</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="bookCategories">
										<i class="fas fa-stream"></i>Books Categories</a>
								</li>
								<li>
									<a href="books">
										<i class="fas fa-stream"></i>Books</a>
								</li>
								<li>
									<a href="issueBooks">
										<i class="fas fa-stream"></i>Issue Books</a>
								</li>
							</ul>
                        </li>
						<li>
                            <a href="students">
                                <i class="fas fa-users"></i>Students</a>
                        </li>
						<li>
                            <a href="standards">
                                <i class="fas fa-sort-numeric-up"></i>Standards</a>
                        </li>
						<li>
                            <a href="sections">
                                <i class="fas fa-sort-alpha-up"></i>Sections</a>
                        </li>
						<li>
                            <a href="subjects">
                                <i class="fas fa-chalkboard-teacher"></i>Subjects</a>
                        </li>
						<li>
                            <a href="employees">
                                <i class="fas fa-user-tie"></i>Employees</a>
                        </li>
						<li>
                            <a href="assignRolls">
                                <i class="fas fa-user-tie"></i>Roll No. Assignment</a>
                        </li>
						<li>
                            <a href="rooms">
                                <i class="fas fa-chair"></i>Rooms & Seating Plan</a>
                        </li>
						<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Types Management</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li>
									<a href="subjectTypes">
										<i class="fas fa-stream"></i>Subject Types</a>
								</li>
								<li>
									<a href="employeesTypes">
										<i class="fas fa-stream"></i>Employee Types</a>
								</li>
							</ul>
                        </li>
						<?php
						if(getUserType()=='student'){
						?>
						<li>
                            <a href="viewAttendance">
                                <i class="fas fa-user-tie"></i>Attendance</a>
                        </li>
						<li>
                            <a href="viewResult">
                                <i class="fas fa-user-tie"></i>Result</a>
                        </li>
						<li>
                            <a href="viewFee">
                                <i class="fas fa-user-tie"></i>Fee</a>
                        </li>
						<?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container" style="background:url('{{getBackgroundImageURL()}}')">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST" style="visibility:hidden;">
							<h4 class="alert alert-primary" style="background: white; padding: 15px; margin-top:15px; border-radius: 20px;">Management Portal For New S.M.D. Senior Secondary School</h4>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">{{getUnreadMessagesCount()}}</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have {{getUnreadMessagesCount()}} New Messages</p>
                                            </div>
											<?php foreach(getLastThreeReceivedMessages() as $one){
												?>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p><?php echo $one->full_name; ?></p>
                                                    <span><?php echo substr($one->content,0,100).'...'; ?></span>
                                                </div>
                                            </div>
												<?php
											}
											?>
                                            <div class="email__footer">
                                                <a href="chat">See All Messages</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{getUserFullName()}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{getUserFullName()}}</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="settings">
                                                        <i class="zmdi zmdi-account"></i>Account Settings</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="globalSettings">
                                                        <i class="zmdi zmdi-settings"></i>Global Settings</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="relations">
                                                        <i class="zmdi zmdi-money-box"></i>User Rights</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">