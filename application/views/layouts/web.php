<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?= $template['title']; ?> | <?= $this->config->item('project_name') ?></title>
		<?= $template['partials']['includes']; ?>
		<script>
			var doLogout = function(){
				/**Do login to system***/
				$.post("<?= $this->config->item('domain') ?>/main/doLogout/", function(result) {
					window.location.href="<?= $this->config->item('domain') ?>/main/login";
				});
			};
			
		</script>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<!-- start: SLIDING BAR (SB) -->
		<div id="slidingbar-area">
			<div id="slidingbar">
				<div class="row">
					<!-- start: SLIDING BAR FIRST COLUMN -->
					<div class="col-md-4 col-sm-4">
						<h2>My Options</h2>
						<div class="row">
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-folder-open-o"></i>
									Projects <span class="badge badge-info partition-red"> 4 </span>
								</button>
							</div>
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-envelope-o"></i>
									Messages <span class="badge badge-info partition-red"> 23 </span>
								</button>
							</div>
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-calendar-o"></i>
									Calendar <span class="badge badge-info partition-blue"> 5 </span>
								</button>
							</div>
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-bell-o"></i>
									Notifications <span class="badge badge-info partition-red"> 9 </span>
								</button>
							</div>
						</div>
					</div>
					<!-- end: SLIDING BAR FIRST COLUMN -->
					<!-- start: SLIDING BAR SECOND COLUMN -->
					<div class="col-md-4 col-sm-4">
						<h2>My Recent Works</h2>
						<div class="blog-photo-stream margin-bottom-30">
							<ul class="list-unstyled">
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image01_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image02_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image03_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image04_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image05_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image06_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image07_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image08_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image09_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?= $this->config->item('domain') ?>/public/images/image10_th.jpg"></a>
								</li>
							</ul>
						</div>
					</div>
					<!-- end: SLIDING BAR SECOND COLUMN -->
					<!-- start: SLIDING BAR THIRD COLUMN -->
					<div class="col-md-4 col-sm-4">
						<h2>My Info</h2>
						<address class="margin-bottom-40">
							Peter Clark
							<br>
							12345 Street Name, City Name, United States
							<br>
							P: (641)-734-4763
							<br>
							Email:
							<a href="#">
								peter.clark@example.com
							</a>
						</address>
						<a class="btn btn-transparent-white" href="#">
							<i class="fa fa-pencil"></i> Edit
						</a>
					</div>
					<!-- end: SLIDING BAR THIRD COLUMN -->
				</div>
				<div class="row">
					<!-- start: SLIDING BAR TOGGLE BUTTON -->
					<div class="col-md-12 text-center">
						<a href="#" class="sb_toggle"><i class="fa fa-chevron-up"></i></a>
					</div>
					<!-- end: SLIDING BAR TOGGLE BUTTON -->
				</div>
			</div>
		</div>
		<!-- end: SLIDING BAR -->
		<div class="main-wrapper">
			<!-- start: TOPBAR -->
			<header class="topbar navbar navbar-inverse navbar-fixed-top inner">
				<!-- start: TOPBAR CONTAINER -->
				<div class="container">
					<div class="navbar-header">
						<a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
							<i class="fa fa-bars"></i>
						</a>
						<!-- start: LOGO -->
						<a class="navbar-brand" href="index.html">
							<img src="<?= $this->config->item('domain') ?>/public/images/logo.png" alt="Rapido"/>
						</a>
						<!-- end: LOGO -->
					</div>
					<div class="topbar-tools">
						<!-- start: TOP NAVIGATION MENU -->
						<ul class="nav navbar-right">
							<!-- start: USER DROPDOWN -->
							<li class="dropdown current-user">
								<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
									 <span class="username hidden-xs"><?= $this->user->get_memberusername() ?></span> <i class="fa fa-caret-down "></i>
								</a>
								<ul class="dropdown-menu dropdown-dark">
									<li>
										<a href="<?= $this->config->item('domain') ?>/account/edit">
											My Profile
										</a>
									</li>
									<li>
										<a href="pages_calendar.html">
											My Calendar
										</a>
									</li>
									<li>
										<a href="pages_messages.html">
											My Messages (3)
										</a>
									</li>
									<li>
										<a href="<?= $this->config->item('domain') ?>/main/lockScreen">
											Lock Screen
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" onClick="doLogout();">
											Log Out
										</a>
									</li>
								</ul>
							</li>
							<!-- end: USER DROPDOWN -->
						
						</ul>
						<!-- end: TOP NAVIGATION MENU -->
					</div>
				</div>
				<!-- end: TOPBAR CONTAINER -->
			</header>
			<!-- end: TOPBAR -->
			<!-- start: PAGESLIDE LEFT -->
			<a class="closedbar inner hidden-sm hidden-xs" href="#">
			</a>
			<nav id="pageslide-left" class="pageslide inner">
				<div class="navbar-content">
					<!-- start: SIDEBAR -->
					<div class="main-navigation left-wrapper transition-left">
						<div class="navigation-toggler hidden-sm hidden-xs">
							<a href="#main-navbar" class="sb-toggle-left">
							</a>
						</div>
						 
						<!-- start: MAIN NAVIGATION MENU -->
						<ul class="main-navigation-menu">
						  <?php 
					    	foreach($this->menu as $modul => $menu){
								if(!empty($this->sub_menu[$modul])){
									$activeMainClass ="";
										if($modul == $this->name){
											$activeMainClass ="open active";
										}
							 
									echo "<li class='".$activeMainClass."'>".
											"<a href='javascript:void(0)'><i class='fa ".$menu['icon'] . "'></i> <span class='title'> ".$menu['name'] . " </span> <i class='icon-arrow'></i> </a>";; 
									echo '<ul class="sub-menu">';
									foreach($this->sub_menu[$modul] as $sm => $sub_menu){
										$activeSubClass ="";
										if($module == $sm){
											$activeSubClass ="active";
										}
										
										echo '<li class="'.$activeSubClass.'">'.
														'<a href="'.$sub_menu.'">'.
														'	<span class="title"> '.$sm.' </span>'.
														'</a>'.
													'</li>';
									}
									echo '</ul>';
								}else{
									echo "<li>".
											"<a href=' ".$menu['url'] . "'><i class='fa ".$menu['icon'] . "'></i> <span class='title'> ".$menu['name'] . " </span> </a>";; 
								}
								echo	"</li>";
					    	} 
				    	?>
						</ul>
						<!-- end: MAIN NAVIGATION MENU -->
					</div>
					<!-- end: SIDEBAR -->
				</div>
				<div class="slide-tools">
					<div class="col-xs-6 text-left no-padding">
						<?php
							$online = $this->user->get_memberonline();
							$status = "";
							if($online != 1){
								$status = "offline";
							}
						?>
						<a class="btn btn-sm status <?= $status ?>" href="#">
							Status <i class="fa fa-dot-circle-o text-green"></i> 
							<span>
								<?php
								if($online == 1){
									echo "Online";
								}else{
									echo "Offline";
								}
								?>
							</span>
						</a>
					</div>
					<div class="col-xs-6 text-right no-padding">
						<a class="btn btn-sm log-out text-right"  href="javascript:void(0);" onClick="doLogout();">
							<i class="fa fa-power-off"></i> Log Out
						</a>
					</div>
				</div>
			</nav>
			<!-- end: PAGESLIDE LEFT -->
			
			<!-- start: MAIN CONTAINER -->
			<?= $template['body'] ?>
			<!-- end: MAIN CONTAINER -->
			<!-- start: FOOTER -->
			<?= $template['partials']['footer']; ?>
			<!-- end: FOOTER -->
	
		</div>
		
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?= $this->config->item('domain') ?>/public/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				UINotifications.init();
				UIButtons.init();
				FormValidator.init();
				TableData.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>