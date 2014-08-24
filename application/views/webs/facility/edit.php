
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>Edit <?= ucwords($this->name) ?> <small>add new <?= $this->name ?> for property </small></h1>
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
					Edit<?= ucwords($this->name) ?>
				</li>
			</ol>
		</div>
	</div>
	<!-- end: BREADCRUMB -->
	<!-- start: PAGE CONTENT -->
	<div class="row">
		<div class="col-sm-12">
			<!-- start: TEXT FIELDS PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"> <span class="text-bold">Basic Information</span></h4>
				 
				</div>
				<div class="panel-body">
					<form role="form" class="form-horizontal" id="form">
						<?= form_hidden('module',  'update') ?>
						<?= form_hidden('f_id',  $result['data']['f_id']) ?>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Facility Name <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_input('fac_name',  $result['data']['name'],' placeholder="Facility Name"  id="fac_name" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Description
							</label>
							<div class="col-sm-9">
								<?= form_input('description',  $result['data']['description'],' placeholder="Description"  id="fac-desc" class="form-control"'); ?>
							</div>
						</div>
						<hr/>
						<h4 class="panel-title"> <span class="text-bold">Facility options</span></h4>
						<br/>
						 
						<?= form_input('facilityOptionName', '',' placeholder="Facility Options"  id="facilityOptions" class="form-control" style="width:50%;display:inline;"'); ?>
						<button type="button" class="btn btn-primary" onClick="return addOptions()">Add Options</button>
						
						<div id="facilityOption"></div>
						<div class="form-group" >
							<label class="col-sm-2 control-label form-field-select-3" for="form-field-select-3"></label>
							<div class="col-sm-9" style="text-align:right;">
								<button data-style="expand-right" class="ladda-button" data-color="green" >
									Update <?= ucwords($this->name) ?> <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>
			
			<!-- end: TEXT FIELDS PANEL -->
		</div>
	</div>

	
	<!-- end: PAGE CONTENT-->
</div>
<script>
	$(function(){
		getOptions();	
	});
	
	 var toastCount = 0;
	 var showSuccessPopUp =  function () {
            var shortCutFunction = "success";
            var msg = 'Facility successfully updated!';//$('#message').val();
            var title = 'Facility Updated';
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
     
    var getOptions = function(){
    	
    	$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getOptions/?f_id=<?= $result['data']['f_id'] ?>", function(result) {
    		$("#facilityOption").html(result);
    	});
    }
    
    var addOptions = function(){ 
    	var str = "f_id=<?= $result['data']['f_id'] ?>&option="+ $("#facilityOptions").val();
     
    	$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/addOptions/", str, function(result) {
			var obj = $.parseJSON(result);
			$("#facilityOptions").val("");
			if(obj.status =="success"){
				showSuccessPopUp();
				getOptions();	
			}else{
				//error message
			}
		});
    	
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