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
						<h1>Edit <?= ucwords($this->name) ?> <small>Amended information of <?= $this->name ?> selected</small></h1>
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
							Edit  <?= ucwords($this->name) ?>
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
						<div class="panel-heading">
							<h4 class="panel-title"> <span class="text-bold">Edit Property Information for <?= $result['data']['title'] ?></span></h4>
						
						</div>
						<div class="panel-body">
						 	
							<div class="form-group">
								<?= form_hidden('id',$result['data']['id']) ?>
								<?= form_hidden('status',$result['data']['status']   ) ?>
								<table id="user" class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td class="column-left" style="width:30%;">	Title <span class="symbol required"></span></td>
											<td class="column-right"> <?= form_input('announcementTitle',  $result['data']['title'] ,' placeholder="Announcement Title"  id="title" class="form-control"'); ?></td>
										</tr>
										<tr>
											<td class="column-left" style="width:30%;">Content</td>
											<td class="column-right"> <textarea class="ckeditor form-control" id="editor2" name="announcementContent" cols="10" rows="10"><?=  $result['data']['content'] ?></textarea></td>
										</tr>
										<tr>
											<td style="width:30%;">Status</td>
											<td><a href="#" id="status" data-type="select" data-pk="1"  data-value="<?= $result['data']['status'] ?>" data-original-title="Account Status">
												<?= match($result['data']['status'],$this->config->item('status') ) ?>
											</a></td>
										</tr>
									</tbody>
								</table>
							
							</div>
						
							<div class="form-group" >
								 
								<div  style="text-align:right;">
									<button data-style="expand-right" class="ladda-button" data-color="green"  onClick="return update()">
										Update <?= $this->name ?> <i class="fa fa-arrow-circle-right"></i>
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
            var msg = '<?= ucwords($this->name) ?> successfully updated!';//$('#message').val();
            var title = '<?= ucwords($this->name) ?>  Updates';
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