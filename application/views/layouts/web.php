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
									  <span id="topMsgBullet"> </span>
									  <span class="username hidden-xs"><?= $this->user->get_memberusername() ?></span>
									
									  <i class="fa fa-caret-down "></i>
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
										<a id="topMessage" href="pages_messages.html">
											My Messages  
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
							 
									echo "<li  class='".$activeMainClass."'>".
											"<a  id='".strtolower($menu['name']) ."' href='javascript:void(0)'><i class='fa ".$menu['icon'] . "'></i> <span class='title'> ".$menu['name'] . " </span> <i class='icon-arrow'></i> </a>";; 
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
									echo "<li  >".
											"<a  id='".strtolower($menu['name']) ."' href=' ".$menu['url'] . "'><i class='fa ".$menu['icon'] . "'></i> <span class='title'> ".$menu['name'] . " </span> </a>";; 
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
			var getUnreadBullet = function(){
				/**Get chatroom message***/
				$.get("<?= $this->config->item('domain') ?>/messages/getUnread/",  function(result) {
					var obj = $.parseJSON(result);
					if(obj.status =="success"){
						if(obj.data > 0){
							$("#topMsgBullet").html('<span class="notifications-count badge badge-default animated bounceIn"> '+obj.data+'</span>');
							$("#messages").html('<i class="fa fa-comments"></i> Messages <span class="notifications-count badge badge-default animated bounceIn"> '+obj.data+'</span>');
							$("#topMessage").html('My Messages   <span class="notifications-count badge badge-default animated bounceIn"> '+obj.data+'</span>');
						}else{
							$("#topMsgBullet").html('');
							$("#messages").html('<i class="fa fa-comments"></i> Messages ');
							$("#topMessage").html('My Messages');
						}
					}
				});
				return false;
			}
		
			jQuery(document).ready(function() {
				Main.init();
				UINotifications.init();
				UIButtons.init();
				FormValidator.init();
				TableData.init();
				Timeline.init();
				getUnreadBullet();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>