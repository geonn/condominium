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
						<h1>Edit <?= ucwords($this->name) ?> <small>Please get permit from your superior before do any changes.</small></h1>
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
							Edit Payment Type - <?= match($result['data']['type'], $this->config->item('maintenance_type')) ?>
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
									<h4 class="panel-title"> <span class="text-bold">Account Information for mid <?= $result['data']['m_id'] ?></span></h4>
								</div>
								<?= form_hidden('edit',1) ?>
								<?= form_hidden('m_id',$result['data']['m_id'] ) ?>
								<?= form_hidden('r_id',$result['data']['r_id'] ) ?>
                                <?php $duration  = explode("-",$result['data']['duration']);?>
                                <?= form_hidden('year',	$duration[0] ) ?>
								<?= form_hidden('month',$duration[1] ) ?>
								<?= form_hidden('duration',$result['data']['duration']  ) ?>
								<?= form_hidden('totalAmount',$result['data']['totalAmount']  ) ?>
								<?= form_hidden('type',$result['data']['type']  ) ?>
								<?= form_hidden('paymentType',$result['data']['paymentType']   ) ?>
								<?= form_hidden('status',$result['data']['status']   ) ?>
							 
								<table id="user" class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td class="column-left" style="width:30%;">Mid</td>
											<td class="column-right"> 
											<?= $result['data']['m_id'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Rid</td>
											<td class="column-right"> 
											<?= $result['data']['r_id'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Duration</td>
											<td class="column-right"> 
											<?= $result['data']['duration'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Total Amount</td>
											<td class="column-right"> 
											<?= $result['data']['totalAmount'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Maintenance Type</td>
											<td class="column-right"> 
											<?= match($result['data']['type'], $this->config->item('maintenance_type')) ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Payment Type</td>
											<td class="column-right"> 
											<?= match($result['data']['paymentType'], $this->config->item('payment_type')) ?></td>
										</tr>
										<tr>
											<td style="width:30%;">Account Status</td>
											<td>
                                            <?php if($this->user->get_memberrole() != "3") { ?>
												<a href="#" id="status" data-type="select" data-pk="1"  data-value="<?= $result['data']['status'] ?>" data-original-title="Account Status">
													<?= match($result['data']['status'],$this->config->item('status') ) ?>
                                                </a>
											<?php }else{  ?>
													<?= match($result['data']['status'],$this->config->item('status') ) ?>
											<?php }  ?>
                                            </td>
										</tr>
									</tbody>
								</table>
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