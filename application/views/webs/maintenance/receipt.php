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
						<h1><?= ucwords($this->name) ?> Receipt<small></small></h1>
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
															<strong><?= $property['data']['name']?></strong><br/>
															<?= nl2br($property['data']['address'])?><br/>
														</address>
                                                        <address>
															<strong>Unit No</strong>
															<br>
																<?= $maintenance['data']['unitLots']?>
														</address>
                                                        <address>
                                                        	<strong>Name</strong><br/>
                                                            <?= $maintenance['data']['name']?> 
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
													<table class="table table-striped table-hover">
														<thead>
															<tr>
																<th> Invoice ID </th>
                                                                <th class="hidden-480">Items</th>
                                                                <th class="hidden-480"> Invoice Paid Date </th>  
																<th class=""> Paid Amount(RM)</th> 
															</tr>
														</thead>
														<tbody>
                                                        	<?php 
															$total = 0; 
															if(empty($maintenance['data'] )){
																echo "<tr><td colspan='7'>Owner account receipt</td></tr>";
															}else{ 
																$time = strtotime($maintenance['data']['payment']['created']);
																$invoiceDate = date("Y-m-d", $time);
																$invoiceDue = "";
																$balance = (isset($maintenance['data']['payment']['balance'])) ? $maintenance['data']['payment']['balance']  : $maintenance['data']['totalAmount'];
																$total += $balance;	
																if(isset($maintenance['data']['payment']['created'])){ 
																	$invoiceDue = date_convert($maintenance['data']['payment']['created'],'full');
																	
																}?>
                                                                <tr>
                                                                    <td> <?= $maintenance['data']['m_id']?> </td>
                                                                    <td class="hidden-480"> <?= $maintenance['data']['type']?> </td>
                                                                    <td class="hidden-480"> <?= $invoiceDue?> </td> 
                                                                    <td class="" > <?= number_format($maintenance['data']['totalAmount'],2) ?> </td> 
                                                                </tr>
                                                            <?php 
															}?>
														</tbody>
													</table>
												</div>
											</div>
											<br/>
												<div> Thanks you !  </div>
											<strong><?= $property['data']['name'] ?> Management.</strong><br/><br/>
											<div>This is a computer generated invoice, no signature is required.</div>
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