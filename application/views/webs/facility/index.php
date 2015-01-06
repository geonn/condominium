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
						<h1>Manage <?= ucwords($this->name) ?> <small>view all available <?= $this->name ?> in the system</small></h1>
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<a href="#" class="back-subviews">
						<i class="fa fa-chevron-left"></i> BACK
					</a>
					<a href="#" class="close-subviews">
						<i class="fa fa-times"></i> CLOSE
					</a>
					
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
						
					</ol>
				</div>
			</div>
			<!-- end: BREADCRUMB -->
			<!-- start: PAGE CONTENT -->
			<div class="row">
				<div class="col-md-12">
					<!-- start: DYNAMIC TABLE PANEL -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h4 class="panel-title"><span class="text-bold"><?= ucwords($this->name) ?> List</span></h4>
						
						</div>
						<div class="panel-body">
							
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
								<thead>
									<tr>
										<th>Facility Name</th>
										<th class="hidden-xs">Status</th>
										<th>Action </th>
									</tr>
								</thead>
								<tbody>
								<?php  
								if(!empty($result['data'])){
									foreach($result['data'] as $k => $val){ ?>	
									<tr>
										<td><?= $val['name'] ?></td>
										<td class="hidden-xs">
											 <?= match($val['status'], $this->config->item('facility_status')) ?>
										</td>
										<td>
											<a class="btn btn-purple" href="<?= $this->config->item('domain').'/'.$this->name ?>/edit/<?= $val['f_id'] ?>">
												EDIT <i class="fa fa-edit"></i>
											</a>
                                            <a class="btn btn-purple" onClick="return confirmDeleteFacility('<?= $val['f_id'] ?>')" href="#<?= $this->config->item('domain').'/'.$this->name ?>/delete/<?= $val['f_id'] ?>">
												DELETE <i class="fa fa-edit"></i>
											</a>
										</td>
									</tr>
								<?php } 
								}else{ ?>
									<tr><td colspan="7" style="text-align:center;">No records found.</td></tr>
										
							<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- end: DYNAMIC TABLE PANEL -->
				</div>
			</div>
			<!-- end: PAGE CONTENT-->
		</div>
		<div class="subviews">
			<div class="subviews-container"></div>
		</div>
	</div>
	<!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<script>
function confirmDeleteFacility(f_id){
    	$.confirm({
			'title'		: 'Delete Confirmation',
			'message'	: 'You are about to delete this facility. <br />Are you sure want to delete?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
						 removeFacility(f_id); //remove image
						
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

function removeFacility(f_id){
	  	var form_data = "f_id="+f_id;
	  	 
	  	// Remove image action
	  	$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/delete",form_data,function(data){
	  			showSuccessPopUp();
				 setTimeout(function(){
					window.location.reload();
				},2000);
	  	});
    }
var toastCount = 0;
 var showSuccessPopUp =  function () {
            var shortCutFunction = "success";
            var msg = 'Facility successfully delete!';//$('#message').val();
            var title = 'Facility Updates';
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
</script>