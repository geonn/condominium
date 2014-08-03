<!-- start: MAIN CONTAINER -->
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="main-content">
		<!-- start: PANEL CONFIGURATION MODAL FORM -->
		<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">Panel Configuration</h4>
					</div>
					<div class="modal-body">
						Here will be a configuration form
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary">
							Save changes
						</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- end: SPANEL CONFIGURATION MODAL FORM -->
		<div class="container">
			<!-- start: PAGE HEADER -->
			<!-- start: TOOLBAR -->
			<div class="toolbar row">
				<div class="col-sm-6 hidden-xs">
					<div class="page-header">
						<h1>Edit User <?= ucwords($this->name) ?> <small>Amended information of owners, tenants and admin</small></h1>
					</div>
				</div>
				 
			</div>
			<!-- end: TOOLBAR -->
			<!-- end: PAGE HEADER -->
			<!-- start: BREADCRUMB -->
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li>
							<a href="<?= $this->config->item('domain').'/'.$this->name ?>/index">
								Manage <?= ucwords($this->name) ?>
							</a>
						</li>
						<li class="active">
							Edit  <?= $result['data']['username'] ?>
						</li>
					</ol>
				</div>
			</div>
			<!-- end: BREADCRUMB -->
			<!-- start: PAGE CONTENT -->
			<div class="row">
				<div class="col-sm-12">
					<form role="form"  id="form">
						<div class="panel panel-white">
							
							<div class="panel-body">
							 	<div class="panel-heading">
									<h4 class="panel-title"> <span class="text-bold">Account Information for <?= $result['data']['username'] ?></span></h4>
								</div>
								<?= form_hidden('edit',1) ?>
								<?= form_hidden('u_id',$result['data']['u_id'] ) ?>
								<?= form_hidden('username',$result['data']['username'] ) ?>
								<?= form_hidden('type',$result['data']['type']  ) ?>
								<?= form_hidden('firstname',$result['data']['firstname']  ) ?>
								<?= form_hidden('lastname',$result['data']['lastname']  ) ?>
								<?= form_hidden('email',$result['data']['email']   ) ?>
								<?= form_hidden('status',$result['data']['status']   ) ?>
								<table id="user" class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td class="column-left" style="width:30%;">Userame</td>
											<td class="column-right"> 
											<?= $result['data']['username'] ?></td>
										</tr>
										<tr>
											<td class="column-left" style="width:30%;">Account Type</td>
											<td class="column-right">
											<?= match($result['data']['type'],$this->config->item('user_type')) ?></td>
										</tr>
										<tr>
											<td class="column-left" style="width:30%;">First Name</td>
											<td class="column-right">
											<a href="#" id="firstname" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="First Name" >
												<?= $result['data']['firstname'] ?>
											</a></td>
										</tr>
											<tr>
											<td class="column-left" style="width:30%;">Last Name</td>
											<td class="column-right">
											<a href="#" id="lastname" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="Last Name" >
												<?= $result['data']['lastname'] ?>
											</a></td>
										</tr>
										<tr>
											<td style="width:30%;">Email Address</td>
											<td><a href="#" id="email" data-type="text" data-pk="1"   data-original-title="Email Address">
												<?= $result['data']['email'] ?>
											</a></td>
										</tr>
										<tr>
											<td style="width:30%;">Account Status</td>
											<td><a href="#" id="status" data-type="select" data-pk="1"  data-value="<?= $result['data']['status'] ?>" data-original-title="Account Status">
												<?= match($result['data']['status'],$this->config->item('status') ) ?>
											</a></td>
										</tr>
									</tbody>
								</table>
								
								<!-- Normal Admin -->
								<?php if($result['data']['type'] == "2") { ?>
								<?= form_hidden('p_id',$result['data']['admin']['p_id']   ) ?>
								<?= form_hidden('pa_id',$result['data']['admin']['pa_id']   ) ?>
								<div class="panel-heading">
									<h4 class="panel-title"> <span class="text-bold">Account Residental Information for <?= $result['data']['username'] ?></span></h4>
								</div>
								<table id="user" class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td style="width:30%;">Property In-charge</td>
											<td><a href="#" id="residentProperty" data-type="select" data-pk="1" data-value="<?= $result['data']['admin']['p_id'] ?>" data-source="<?= $this->config->item('domain') ?>/<?= $this->name ?>/getPropertyList"   data-original-title="Resident Property">
												<?= $result['data']['admin']['property'] ?>
											</a></td>
										</tr>
								
									</tbody>
								</table>
								<?php } ?>
								
								<!--Owner/ Tenants -->
								<?php if($result['data']['type'] == "3") { ?>
								<?= form_hidden('p_id',$result['data']['residental']['p_id']   ) ?>
								<?= form_hidden('unitLots',$result['data']['residental']['unitLots']  ) ?>
								<?= form_hidden('residentType',$result['data']['residental']['type'] ) ?>
								<div class="panel-heading">
									<h4 class="panel-title"> <span class="text-bold">Account Residental Information for <?= $result['data']['username'] ?></span></h4>
								</div>
								<table id="user" class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td style="width:30%;">Resident Property</td>
											<td><a href="#" id="residentProperty" data-type="select" data-pk="1" data-value="<?= $result['data']['residental']['p_id'] ?>" data-source="<?= $this->config->item('domain') ?>/<?= $this->name ?>/getPropertyList"   data-original-title="Resident Property">
												<?= $result['data']['residental']['property'] ?>
											</a></td>
										</tr>
										<tr>
											<td style="width:30%;">Unit Lots</td>
											<td><a href="#" id="unitLots" data-type="text" data-pk="1"   data-original-title="Unit Lots">
												<?= $result['data']['residental']['unitLots'] ?>
											</a></td>
										</tr>
										<tr>
											<td style="width:30%;">Residental Type</td>
											<td>
												<a href="#" id="residentType" data-type="select" data-pk="1" data-value="<?= $result['data']['residental']['type'] ?>"    data-original-title="Resident Type">
												<?= $result['data']['residental']['residentType'] ?>
											</a></td>
										</tr>
									</tbody>
								</table>
								<?php } ?>
								<div class="form-group" >
									 
									<div  style="text-align:right;">
										<button data-style="expand-right" class="ladda-button" data-color="green" onClick="return update()">
											Update <?= ucwords($this->name) ?> <i class="fa fa-arrow-circle-right"></i>
										</button>
									
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end: PAGE CONTENT-->
		</div>

	</div>
	<!-- end: PAGE -->
</div>

<!-- end: MAIN CONTAINER -->
<script>
	 var toastCount = 0;
	 var showSuccessPopUp =  function () {
            var shortCutFunction = "success";
            var msg = 'Account successfully updated!';//$('#message').val();
            var title = 'Account Updates';
            var toastIndex = toastCount++;

            toastr.options = {
                closeButton:true,
                positionClass:  'toast-top-right',
                onclick: null
            };
            
            toastr.options.showDuration = "1000";
			toastr.options.hideDuration = "1000";
            toastr.options.timeOut = "5000";
            toastr.options.extendedTimeOut = "1000";
            toastr.options.showEasing = "swing";
            toastr.options.hideEasing = "linear";
            toastr.options.showMethod = "fadeIn";
            toastr.options.hideMethod = "fadeOut";

            $("#toastrOptions").text("Command: toastr["
                            + shortCutFunction
                            + "](\""
                            + msg
                            + title
                            + "\")\n\ntoastr.options = "
                            + JSON.stringify(toastr.options, null, 2)
            );
            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
        }
        
	var update = function(){
		var str = $('form').serialize();
		
		/**Do create property to system***/
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/doUpdate/", str, function(result) {
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				showSuccessPopUp();
			}else{
				//error message
			}
		});
		
		return false;
	}
	
</script>