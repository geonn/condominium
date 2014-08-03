<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Login  | <?= $this->config->item('project_name') ?></title>
		<?= $template['partials']['includes']; ?>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo">
				<img src="<?= $this->config->item('domain') ?>/public/images/logo.png">
			</div>
		<?= $template['body'] ?>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?= $this->config->item('domain') ?>/public/plugins/respond.min.js"></script>
		<script src="<?= $this->config->item('domain') ?>/public/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?= $this->config->item('domain') ?>/public/plugins/jQuery/jquery-2.1.1.min.js"></script>
		<!--<![endif]-->
		<script src="<?= $this->config->item('domain') ?>/public/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?= $this->config->item('domain') ?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= $this->config->item('domain') ?>/public/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?= $this->config->item('domain') ?>/public/plugins/jquery.transit/jquery.transit.js"></script>
		<script src="<?= $this->config->item('domain') ?>/public/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?= $this->config->item('domain') ?>/public/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?= $this->config->item('domain') ?>/public/js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>