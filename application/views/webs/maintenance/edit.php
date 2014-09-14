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
									<h4 class="panel-title"> <span class="text-bold">Maintenance Information and Payment for  <?= $result['data']['unitLots'] ?></span></h4>
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
											<td class="column-left" style="width:30%;">ID</td>
											<td class="column-right"> 
											<?= $result['data']['m_id'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Resident Units</td>
											<td class="column-right"> 
											<?= $result['data']['unitLots'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Duration</td>
											<td class="column-right"> 
											<?= date_convert($result['data']['duration'],'ori') ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Total Amount</td>
											<td class="column-right"> MYR <?= $result['data']['totalAmount'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Maintenance Type</td>
											<td class="column-right"> 
											<?= $result['data']['type'] ?></td>
										</tr>
                                        <tr>
											<td class="column-left" style="width:30%;">Payment Type</td>
											<td class="column-right"> 
											<?= $result['data']['paymentType'] ?></td>
										</tr>
										 <tr>
											<td class="column-left" style="width:30%;">Balance (MYR)</td>
											<td class="column-right"> 
											<?php 
													if(empty($result['data']['payment'])){
														echo "<span style='color:#FF0000;font-weight:bold;'>".number_format($result['data']['totalAmount'],2)."</span>";
													}else{
														if(number_format($result['data']['payment']['balance'],2) == "0.00"){
															echo "<span style='color:green;font-weight:bold;'>PAID</span>";
														}else{
															echo "<span style='color:#FF0000;font-weight:bold;'>".number_format($result['data']['payment']['balance'],2)."</span>";
														}
													}
											?></td>
										</tr>
									</tbody>
								</table>
								
								<?php
									
									if((empty($result['data']['payment']) || number_format($result['data']['payment']['balance'],2) != "0.00")){ ?>
								<div class="form-group" >
									<div  style="text-align:left;">
										<button data-style="expand-right" data-size="xs" class="ladda-button" data-color="green" onClick="return showPriceBox()">
											PAY ANY AMOUNT  
										</button>
										OR
										<button data-style="expand-right"  data-size="xs" class="ladda-button" data-color="green" onClick="return payAll()">
											PAY ALL <i class="fa fa-arrow-circle-right"></i>
										</button>
									 
										<div class="col-sm-9" style="padding-top:15px;display:none;" id="payAmountContainer">
											MYR <?= form_input('amount', '',' placeholder="Pay any amount"  id="payAmount" class="form-control" style="width:30%;display:inline;"'); ?>
											<button type="button" class="btn btn-primary" onClick="return payAmounts()">PAY</button>
										</div>
									</div>
								<?php } ?>
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
            var msg = 'Maintenance record successfully updated!';//$('#message').val();
            var title = 'Maintenance Payment Updates';
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
    
    var showPriceBox = function(){
    	$("#payAmountContainer").fadeIn();
    	 return false;
    }
    
    function payAmounts(){
    	var str = "paid="+$('input[name=amount]').val()+"&m_id=<?= $result['data']['m_id'] ?>";
		 
		/**Do create property to system***/
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/payAnyAmount/", str, function(result) {
			 $('input[name=amount]').val("");
			var obj = $.parseJSON(result);
			
			if(obj.status =="success"){
				showSuccessPopUp();
				setTimeout(function(){
					window.location.reload();
				},3000);
				
			}else{
				//error message
			}
		});
		
		return false;
    }
    
	var payAll = function(){
		var str = "m_id=<?= $result['data']['m_id'] ?>";
		
		/**Do create property to system***/
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/payAll/", str, function(result) {
			var obj = $.parseJSON(result);
			
			if(obj.status =="success"){
				showSuccessPopUp();
				setTimeout(function(){
					window.location.reload();
				},3000);
				
			}else{
				//error message
			}
		});
		
		return false;
	}
	
</script>