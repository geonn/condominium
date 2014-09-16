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
						<h1><?= ucwords($this->name) ?> Invoice<small></small></h1>
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
							Invoice
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
										<h4 class="panel-title">Invoice</h4>
										<div class="panel-tools">
											<div class="dropdown">
												<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
													<i class="fa fa-cog"></i>
												</a>
												<ul class="dropdown-menu dropdown-light pull-right" role="menu">
													<li>
														<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
													</li>
													<li>
														<a class="panel-refresh" href="#">
															<i class="fa fa-refresh"></i> <span>Refresh</span>
														</a>
													</li>
													<li>
														<a class="panel-config" href="#panel-config" data-toggle="modal">
															<i class="fa fa-wrench"></i> <span>Configurations</span>
														</a>
													</li>
													<li>
														<a class="panel-expand" href="#">
															<i class="fa fa-expand"></i> <span>Fullscreen</span>
														</a>
													</li>
												</ul>
											</div>
											<a class="btn btn-xs btn-link panel-close" href="#">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="panel-body">
										<div class="invoice">
											<div class="row invoice-logo">
												<div class="col-sm-6">
													<img alt="" src="assets/images/your-logo-here.png">
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-4">
													<h4>Client:</h4>
													<div class="well">
														<address>
															<strong><?= $property['data']['name']?></strong><br/>
															<?= nl2br($property['data']['address'])?><br/>
														</address>
                                                        <address>
															<strong>Unit No</strong>
															<br>
																<?= $residential['data']['unitLots']?>
														</address>
                                                        <address>
                                                        	<strong>Name</strong><br/>
                                                            <?= $user['data']['firstname']?> 
                                                            <?= $user['data']['lastname']?>
                                                        </address>
														<address>
															<strong>E-mail</strong>
															<br>
															<a href="mailto:<?= $user['data']['email']?> ">
																<?= $user['data']['email']?> 
															</a>
														</address>
													</div>
												</div>
												<div class="col-sm-4 pull-right">
													<ul class="list-unstyled invoice-details">
														<li>
															<strong>Date</strong> 
															<br/><?= date("Y-m-d")?> 
														</li>
													</ul>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<table class="table table-striped table-hover">
														<thead>
															<tr>
																<th> ID </th>
                                                                <th class="hidden-480"> Invoice Date </th>
                                                                <th class="hidden-480"> Invoice Due Date </th>
																<th class="hidden-480"> Description </th>
                                                                <th class=""> Total Amount </th>
																<th class=""> Paid </th>
																<th> Balance </th>
															</tr>
														</thead>
														<tbody>
                                                        	<?php 
															$total = 0;
															foreach($maintenance['data'] as $val){
															$time = strtotime($val['created']);
															$invoiceDate = date("Y-m-d", $time);	
															$time = strtotime($val['payment']['created']);
															$invoiceDue = date("Y-m-d", $time);
															$total += $val['payment']['balance'];	
															?>
															<tr>
																<td> <?= $val['m_id']?> </td>
																<td class="hidden-480"> <?= $invoiceDate?> </td>
																<td class="hidden-480"> <?= $invoiceDue?> </td>
																<td class="hidden-480"> <?= match($val['type'], $this->config->item('maintenance_type'));?> </td>
																<td class=""> <?= $val['totalAmount']?> </td>
                                                                <td class=""> <?= $val['payment']['paid']?> </td>
																<td> <?= $val['payment']['balance']?> </td>
															</tr>
                                                            <?php }?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12 invoice-block">
													<ul class="list-unstyled amounts">
															<strong>Total:</strong>
                                                            RM <?= number_format($total, 2);?>
														</li>
													</ul>
													<br>
													<a onclick="javascript:window.print();" class="btn btn-lg btn-light-blue hidden-print">
														Print <i class="fa fa-print"></i>
													</a>
													<a class="btn btn-lg btn-green hidden-print">
														Submit Your Invoice <i class="fa fa-check"></i>
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