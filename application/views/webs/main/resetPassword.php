<!-- start: LOGIN BOX -->

<script>
	var doSetNewPassword = function(){
		/**Do login to system***/
 	 
		$.post("<?= $this->config->item('domain') ?>/main/doSetNewPassword/",$('#form-forgot').serialize(), function(result) {
console.log(result);
			var obj = $.parseJSON(result);
			
			if(obj.status =="error"){
				$("#errorHandler1").html(obj.data.error_msg);
				$("#divErrorHandler").removeClass("no-display");
			}else{
				window.location.href="../<?= $this->name ?>/login";
			}
		});
		return false;
	} 
</script>
<div class="box-login">
	<h3>Forget Password?</h3>
	<p>
		Enter your new password.
	</p>
	<form class="form-forgot" id="form-forgot">
		<div class="errorHandler alert alert-danger no-display">
			<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
		</div>
		<fieldset>
			<div class="form-group">
				<span class="input-icon">
                	<input type="hidden" class="form-control" name="session" value="<?= $session?>"/>
					<input type="password" class="form-control" name="password" placeholder="New Password">
					<i class="fa fa-envelope"></i> </span>
			</div>
			<div class="form-actions">
				<a class="btn btn-light-grey go-back">
					<i class="fa fa-chevron-circle-left"></i> Log-In
				</a>
				<button class="btn btn-green pull-right" onClick=" return doSetNewPassword();">
					Submit <i class="fa fa-arrow-circle-right"></i>
				</button>
			</div>
		</fieldset>
	</form>
	<!-- start: COPYRIGHT -->
	<div class="copyright">
		 <? echo date('Y');?> &copy; <?php echo $this->config->item('project_developer'); ?>
	</div>
	<!-- end: COPYRIGHT -->
</div>
<!-- end: FORGOT BOX -->
		