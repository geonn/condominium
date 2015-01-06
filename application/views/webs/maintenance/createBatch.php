
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-12 hidden-xs">
			<div class="page-header">
				<h1>Create Batch <?= ucwords($this->name) ?> <small>add new account for owners/tenants, and new admin </small></h1>
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
					Add New <?= ucwords($this->name) ?>
				</li>
			</ol>
		</div>
	</div>
	<!-- end: BREADCRUMB -->
	<!-- start: PAGE CONTENT -->
	<div class="row">
		<div class="col-sm-12">
			<!-- start: TEXT FIELDS PANEL -->
			<div class="panel panel-white" style="ming-height:300px;">
				<div class="panel-heading">
					<h4 class="panel-title"> <span class="text-bold">Batch Submit Maintenance Information</span></h4>
				 
				</div>
				<div class="panel-body" >
					Download the maintenance form templates and fill in before upload to the system. <br/>
					[<a href="../public/attachment/templates/maintenance.csv">DOWNLOAD</a>] <br/><br/>
					
					Reference : <br/>
					<table class="table table-striped table-bordered table-hover table-full-width dataTable">
						<tr><th>Unit Lots</th><td>Owner's property unit lots</td><tr>
						<tr><th>Date</th><td>Date that issued the invoice. Date format in  yyyy-mm-dd (eg.2015-01-15)</td><tr>
						<tr><th>Amount</th><td>Total amount that owner need to pay of the particular record.</td><tr>
						<tr><th>Type</th><td>Fill in the <strong><u>number</u></strong> base on the purpose of the record:<br>
								<strong>1</strong> : Maintenane & Sinking Fund<br/>
								<strong>2 </strong>: Electrical<br/>
								<strong>3</strong> : Broadband<br/>
								<strong>4</strong> : Water<br/>
								<strong>5 </strong>: Others<br/>
						</td><tr>	
					</table>			
					<hr/>
					<?php echo  form_open_multipart('/'.$this->name.'/batchUpload/','id="updateform"'); ?>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Upload .csv file
							</label>
							<div class="col-sm-9">
								
								<input type="file" name="file" id="file">
								<button type="submit" class="btn btn-primary"  >Upload</button> 
							</div>
						</div>
					</form>
					<div id="userTable"></div>
				</div>
			</div>
		
		</div>
	</div>

	
	<!-- end: PAGE CONTENT-->
</div>
<script>
	$( "#searchform" ).keypress(function(e) {
	 	var key = e.which;
		 if(key == 13) {
		    searchUnit();
		    return false;  
		  }
	});
	
	var showMaintenanceForm = function(residentName,r_id) {
		$("#maintenanceBox").show();
		$("#residentName").html(residentName);
		$("input[name=r_id]").val(r_id);
	}
	
	 var toastCount = 0;
	 var showSuccessPopUp =  function () {
            var shortCutFunction = "success";
            var msg = 'An account successfully created!';//$('#message').val();
            var title = 'New Account';
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
     
     var searchUnit  = function(){
     	var unitLots = $("#unitLot").val();
     	if(unitLots == "" ){
     		alert("Please fill in unit Lots");
     		return false;	
     	}
     	/**Do create property to system***/
		$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/searchUnit/?unitLots="+unitLots,  function(result) {
			$("#userTable").html(result);
		});
    }
    
	var create = function(){
		var str = $('form').serialize();
		var totalAmount = $("#totalAmount").val();
     	if(totalAmount == "" ){
     		alert("Please fill in total amount");
     		return false;	
     	}
		/**Do create property to system***/
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/doAdd/", str, function(result) {
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				showSuccessPopUp();
				setTimeout(function(){window.location.href="../<?= $this->name ?>/index";}, 2000);
			}else{
				//error message
			}
		});
		
		return false;
	}
	
</script>