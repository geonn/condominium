<!-- start: LOGIN BOX -->
<div class="box-login">
	<h3>Sign in to your account</h3>
	<p>
		Please enter your name and password to log in.
	</p>
	<form class="form-login" action="index.html">
		<div class="errorHandler alert alert-danger no-display">
			<i class="fa fa-remove-sign"></i> <span id="errorHandler1">You have some form errors. Please check below.</span>
		</div>
		<fieldset>
			<div class="form-group">
				<span class="input-icon">
					<input type="text" class="form-control" name="username" placeholder="Username">
					<i class="fa fa-user"></i> </span>
			</div>
			<div class="form-group form-actions">
				<span class="input-icon">
					<input type="password" class="form-control password" name="password" placeholder="Password">
					<i class="fa fa-lock"></i>
					<a class="forgot" href="#">
						I forgot my password
					</a> </span>
			</div>
			<div class="form-actions">
				<label for="remember" class="checkbox-inline">
					<input type="checkbox" class="grey remember" id="remember" name="remember">
					Keep me signed in
				</label>
				<button type="submit" class="btn btn-green pull-right">
					Login <i class="fa fa-arrow-circle-right"></i>
				</button>
			</div>
			
		</fieldset>
	</form>
	<!-- start: COPYRIGHT -->
	<div class="copyright">
		 <? echo date('Y');?> &copy; <?= $this->config->item('project_developer') ?>
	</div>
	<!-- end: COPYRIGHT -->
</div>
<!-- end: LOGIN BOX -->
<!-- start: FORGOT BOX -->
<div class="box-forgot">
	<h3>Forget Password?</h3>
	<p>
		Enter your e-mail address below to reset your password.
	</p>
	<form class="form-forgot">
		<div class="errorHandler alert alert-danger no-display">
			<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
		</div>
		<fieldset>
			<div class="form-group">
				<span class="input-icon">
					<input type="email" class="form-control" name="email" placeholder="Email">
					<i class="fa fa-envelope"></i> </span>
			</div>
			<div class="form-actions">
				<a class="btn btn-light-grey go-back">
					<i class="fa fa-chevron-circle-left"></i> Log-In
				</a>
				<button type="submit" class="btn btn-green pull-right">
					Submit <i class="fa fa-arrow-circle-right"></i>
				</button>
			</div>
		</fieldset>
	</form>
	<!-- start: COPYRIGHT -->
	<div class="copyright">
		 <? echo date('Y');?> &copy; <?= $this->config->item('project_developer') ?>
	</div>
	<!-- end: COPYRIGHT -->
</div>
<!-- end: FORGOT BOX -->
		