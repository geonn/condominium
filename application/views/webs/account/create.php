
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
					Create New <?= ucwords($this->name) ?>
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
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								First Name  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_input('firstname', '',' placeholder="First Name"  id="form-field-1" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Last Name
							</label>
							<div class="col-sm-9">
								<?= form_input('lastname', '',' placeholder="Last Name"  id="form-field-2" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Username  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_input('username', '',' placeholder="Username"  id="form-field-3" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Password  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_password('password', '',' placeholder="Password"  id="password" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Confirm Password  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_password('confirmation', '',' placeholder="Confirm Password"  id="confirmation" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label form-field-select-3" for="form-field-select-3">
								Account Type  <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
									<?= form_dropdown('type', array(""=>"Choose Account Type")+$this->config->item('user_type'), '',' id="accountType" class="form-control search-select"'); ?> 
							</div>
						</div>
						<div class="form-group" id="unitLots2" style="display:none;">
							<label class="col-sm-2 control-label" for="form-field-1">
								Unit Lots
							</label>
							<div class="col-sm-9">
								<?= form_input('unitLots', '',' placeholder="Unit Lots"  id="form-field-6" class="form-control"'); ?>
							</div>
						</div>
						<div class="form-group" id="manageProperty" style="display:none;">
							<label class="col-sm-2 control-label" for="form-field-1">
								Property Manage
							</label>
							<div class="col-sm-9">
								<?= form_dropdown('p_id', array(""=>"Choose Property")+$this->property_model->getList(),'','  id="form-field-7" class="form-control"'); ?>
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