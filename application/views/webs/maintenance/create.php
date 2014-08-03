
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>Create <?= ucwords($this->name) ?> <small>add new account for owners/tenants, and new admin </small></h1>
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
					<h4 class="panel-title"> <span class="text-bold">Owner Information</span></h4>
				 
				</div>
				<div class="panel-body" >
					<form role="form" class="form-horizontal" id="form">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Search Unit Lots
							</label>
							<div class="col-sm-9">
								<?= form_input('unitLot', '',' placeholder="Owner\'s Unit Lots (eg. 01-01)"  id="unitLot" class="form-control" style="width:50%;display:inline;"'); ?>
								<button type="button" class="btn btn-primary" onClick="return searchUnit()">Search</button>
												
							</div>
						</div>
					</form>
					<div id="userTable"></div>
				</div>
			</div>
				<!-- start: TEXT FIELDS PANEL -->
			<div class="panel panel-white"  id="maintenanceBox" style="display:none;">
				<div class="panel-heading">
					<h4 class="panel-title"> <span class="text-bold">Payment Record</span></h4>
				</div>
				<div class="panel-body">
					<form role="form" class="form-horizontal" id="form">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Name
							</label>
							<div class="col-sm-9" id="residentName">
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Payment For  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_dropdown('month', $this->config->item('month'),date('m'),'  id="month" class="form-control" style="width:30%;display:inline;"'); ?>
								<?= form_dropdown('year', $this->config->item('yearRecent'),date('Y'),'  id="year" class="form-control" style="width:30%;display:inline;"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Total Amount
							</label>
							<div class="col-sm-9">
								<?= form_input('totalAmount', '',' placeholder="Total Amount"  id="totalAmount" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Maintenance Type  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_dropdown('type', $this->config->item('maintenance_type'),'','  id="type" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group" id="manageProperty" >
							<label class="col-sm-2 control-label" for="form-field-1">
								Payment Type
							</label>
							<div class="col-sm-9">
								<?= form_dropdown('paymentType', $this->config->item('payment_type'),'','  id="paymentType" class="form-control"'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div>
									<span class="symbol required"></span>Required Fields
									<hr>
								</div>
							</div>
						</div>
						<div class="form-group" >
							<label class="col-sm-2 control-label form-field-select-3" for="form-field-select-3"></label>
							<div class="col-sm-9" style="text-align:right;">
								<button data-style="expand-right" class="ladda-button" data-color="green">
									Create <?= ucwords($this->name) ?> <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>
			
			<!-- end: TEXT FIELDS PANEL -->
			<!-- end: TEXT FIELDS PANEL -->
		</div>
	</div>

	
	<!-- end: PAGE CONTENT-->
</div>
<script>
	$( "#accountType" ).change(function() {
	 	
	 	 if($( this ).val()  == "3"){
	  		$("#manageProperty").hide();
	  		$("#unitLots2").show();
		}else if($( this ).val()  == "2"){
			$("#manageProperty").show();
	  		$("#unitLots2").hide();
		}else{
			$("#manageProperty").hide();
	  		$("#unitLots2").hide();
		}
	});
	
	var showMaintenanceForm = function(residentName) {
		$("#maintenanceBox").show();
		$("#residentName").html(residentName);
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