
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>Create Property <small>add new property to manage the peoples, maintenance and facilities </small></h1>
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
					<a href="#">
						Manage Property
					</a>
				</li>
				<li class="active">
					Create New Property
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
					<h4 class="panel-title"> <span class="text-bold">New Property Information</span></h4>
				 
				</div>
			
				<div class="panel-body">
					<form role="form" class="form-horizontal"  id="form" >
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Your form validation is successful!
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2">
								Property Name <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Property Name" class="form-control" id="name" name="name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label  col-sm-2">
								Email Address <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<input type="email" placeholder="Text Field" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">
								Contact Person <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Contact Person" class="form-control" id="contact_person" name="contact_person">
							</div>
						</div>
                        <div class="form-group">
							<label class="control-label col-sm-2">
								Contact Number <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Contact Number" class="form-control" id="contact_no" name="contact_no">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">
								Fax Number  
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Fax Number" class="form-control" id="fax_no" name="fax_no">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label  col-sm-2">
								Developer Name 
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Developer Name" class="form-control" id="developer_name" name="developer_name">
							</div> 
						</div>
						<div class="form-group">
							<label class="control-label  col-sm-2">
								Address
							</label>
							<div class="col-sm-9">
								<textarea   placeholder="Address"  name="address" class="form-control" rows="4"></textarea>
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
									Create Property <i class="fa fa-arrow-circle-right"></i>
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
	  		$("#unitLots").show();
		}else if($( this ).val()  == "2"){
			$("#manageProperty").show();
	  		$("#unitLots").hide();
		}else{
			$("#manageProperty").hide();
	  		$("#unitLots").hide();
		}
	});
	
	var create = function(){
		var str = $('form').serialize();
		 
		/**Do create property to system***/
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/doCreate/", str, function(result) {
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				window.location.href="../<?= $this->name ?>/index";
			}else{
				//error message
			}
		});
		
		return false;
	}
	
</script>