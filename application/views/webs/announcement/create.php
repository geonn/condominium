
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>Create <?= ucwords($this->name) ?> <small>add new property to manage the peoples, maintenance and facilities </small></h1>
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
					<h4 class="panel-title"> <span class="text-bold"><?= ucwords($this->name) ?> Information</span></h4>
				 
				</div>
			
				<div class="panel-body">
					<form role="form" class="form-horizontal"  id="form" >
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Announcement successfully submitted!
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2">
								Title <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<?= form_input('announcementTitle', '',' placeholder="Announcement Title"  id="title" class="form-control"'); ?>
							</div>
						</div>
					
					
						<div class="form-group">
							<label class="control-label  col-sm-2">
								Content
							</label>
							<div class="col-sm-9">
								<textarea class="ckeditor form-control" id="editor2" name="announcementContent" cols="10" rows="10"></textarea>
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
			alert(result);
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