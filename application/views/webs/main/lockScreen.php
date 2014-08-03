<script>
	var doLogin = function(){
		/**Do login to system***/
 	 
		$.post("<?= $this->config->item('domain') ?>/main/doLogin/",$('form').serialize(), function(result) {
			 
			var obj = $.parseJSON(result);
			
			if(obj.status =="error"){
				$("#errorHandler1").html(obj.data.error_msg);
				$("#divErrorHandler").removeClass("no-display");
			}else{
				window.location.href="../main";
			}
		});
		return false;
	} 
</script>
<?php
	$displayName = $this->user->get_memberfullname();
	if(empty($displayName)){
		$displayName = $this->user->get_memberusername();
	}
?>
<body class="lock-screen">
	<div class="main-ls animated flipInX">
		<div class="logo">
			<img src="<?= $this->config->item('domain') ?>/public/images/logo.png">
		</div>
		<div class="box-ls">
			<div class="user-info">
				<h1><i class="fa fa-lock"></i> <?= $displayName ?></h1>
				<span><?= $this->user->get_memberemail() ?></span>
				<span><em>Please enter your password to un-lock.</em></span>
				<form>
					<?= form_hidden('username', $this->user->get_memberusername()) ?>
					<div id="divErrorHandler" class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> <span id="errorHandler1"></span>
					</div>
					<div class="input-group">
						<input type="password" name="password" placeholder="Password" class="form-control">
						<span class="input-group-btn">
							<button class="btn btn-green" onClick=" return doLogin();">
								<i class="fa fa-chevron-right"></i>
							</button> </span>
					</div>
					<div class="relogin">
						<a href="<?= $this->config->item('domain') ?>/main/login">
							Not <?= $displayName ?>?</a>
					</div>
				</form>
			</div>
		</div>
		<div class="copyright">
			 <? echo date('Y');?> &copy; <?= $this->config->item('project_developer') ?>
		</div>
	</div>
	<!-- start: MAIN JAVASCRIPTS -->
	<!--[if lt IE 9]>
	<script src="<?= $this->config->item('domain') ?>/public/plugins/respond.min.js"></script>
	<script src="<?= $this->config->item('domain') ?>/public/plugins/excanvas.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<!--<![endif]-->
	<script src="<?= $this->config->item('domain') ?>/public/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	<script src="<?= $this->config->item('domain') ?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= $this->config->item('domain') ?>/public/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="<?= $this->config->item('domain') ?>/public/js/main.js"></script>
	<!-- end: MAIN JAVASCRIPTS -->
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script>
		jQuery(document).ready(function() {
			Main.init();
		});
	</script>
</body>