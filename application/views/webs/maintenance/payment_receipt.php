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
						<h1>My Payment
							 Receipt<small></small></h1>
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
							Receipt
						</li>
					</ol>
				</div>
			</div>
			<!-- end: BREADCRUMB -->
			<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title">Receipt</h4>
									 
									</div>
									<div class="panel-body">
										<div class="invoice">
											<div class="row invoice-logo">
												<div class="col-sm-6">
													<?php 
													if(!empty($property['data']['logo'])){
														echo '<img alt="" src="'.$property['data']['logo'].'">';
													}
													?>
													
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-4">
												 
													<div class="well">
														<address>
															<strong><?= $payment['data']['residental']['unitLots']?>, <?= $property['data']['name']?></strong><br/>
															<?= nl2br($property['data']['address'])?><br/>
														</address>
                                                        
                                                       
													
													</div>
												</div>
												<div class="col-sm-4 pull-right">
													<ul class="list-unstyled invoice-details">
														<li>
															<strong>Date</strong> 
															<br/><?= date_convert(date("Y-m-d"),'ori') ?> 
														</li>
													</ul>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<strong>Dear <?= $payment['data']['name']?> ,</strong> <br/><br/>
													
													Please inform that the management has been received your payment of MYR  <strong><?= $payment['data']['amount']?></strong> at
													<strong>  <?= date_convert($payment['data']['created'], 'full') ?> </strong>.<br/>
													The management will continue to serve you better in the future!
													
												</div>
											</div>
											<br/>
											<div> Thanks you !  </div>
											<strong><?= $property['data']['name'] ?> Management.</strong>
											<br/><br/>
											
											<div>This is a computer generated receipt, no signature is required.</div>
											<div class="row">
												<div class="col-sm-12 invoice-block">
												
													<br>
												
													<a onclick="javascript:window.print();" class="btn btn-lg btn-light-blue hidden-print">
														Print <i class="fa fa-print"></i>
													</a>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
		</div>

	</div>
	<!-- end: PAGE -->
</div>
<?php  if(!empty($maintenance['data'])) { ?>
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
    	var str = "paid="+$('input[name=amount]').val()+"&m_id=<?= $maintenance['data'][0]['m_id'] ?>";
		 
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
	
	
	function confirmPayAll(){
    	$.confirm({
			'title'		: 'Pay All Confirmation',
			'message'	: 'Are you sure want to pay full amount?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
						 payAll(); //remove image
						
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Doesn't do anything						
				}
			}
		});				
		return false;
    }
    
	function payAll(){
		var str = "m_id=<?= $maintenance['data'][0]['m_id'] ?>";
		
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

<?php } ?>