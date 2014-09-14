<script>
	var doswitchCondo = function(){
		/**Do login to system***/
 	 
		$.post("<?= $this->config->item('domain') ?>/main/doSwitchCondo/",$('form').serialize(), function(result) {
			var obj = $.parseJSON(result);
			if(obj.status =="error"){
				$("#errorHandler1").html(obj.data.error_msg);
				$("#divErrorHandler").removeClass("no-display");
			}else{
				window.location.href="../<?= $this->name ?>/index";
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
				<span><em>Switch your property at here</em></span>
				<form>
					<?= form_hidden('username', $this->user->get_memberusername()) ?>
					<div id="divErrorHandler" class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> <span id="errorHandler1"></span>
					</div>
					<div class="input-group">
                    	<ul class="dd-list">
                        	<?php 
								foreach($property_list as $value){
									$checked = ($value['p_id'] == $p_id)?"checked":"";
									echo "<li><input ".$checked." type='radio' name='propertyOptions' class='grey' style='margin-right:10px;' value='".$value['p_id']."'><span>".$value['name']."</span></li>";
								}
							?>
                        </ul>
						<span class="input-group-btn">
							<button class="btn btn-green" onClick=" return doswitchCondo();">
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
	