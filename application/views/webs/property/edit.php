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
									<h1>Edit Property <small>Amended information of property selected</small></h1>
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
											Manage Property
										</a>
									</li>
									<li class="active">
										Edit  <?= $result['data']['name'] ?>
									</li>
								</ol>
							</div>
						</div>
						<!-- end: BREADCRUMB -->
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title"> <span class="text-bold">Edit Property Information for <?= $result['data']['name'] ?></span></h4>
									
									</div>
									<div class="panel-body">
									 	
										<table id="user" class="table table-bordered table-striped">
											<tbody>
												<tr>
													<td class="column-left">Property Name</td>
													<td class="column-right">
													<a href="#" id="property_name" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="Property Name" >
														<?= $result['data']['name'] ?>
													</a></td>
												</tr>
												<tr>
													<td>Email Address</td>
													<td><a href="#" id="email" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="Email Address">
													<?= $result['data']['email'] ?>
													</a></td>
												</tr>
												<tr>
													<td>Contact Number</td>
													<td><a href="#" id="contact_no" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="Contact Number">
													<?= $result['data']['contact_no'] ?>
													</a></td>
												</tr>
												<tr>
													<td>Fax Number</td>
													<td>
													<a href="#" id="fax_no" data-type="text" data-pk="1"   data-placeholder="Required" data-original-title="Fax Number">
														<?= $result['data']['fax_no'] ?>
													</a></td>
												</tr>
												<tr>
													<td>Developer Name</td>
													<td>
													<a href="#" id="developer_name" data-type="text" data-pk="1"   data-placeholder="Required" data-original-title="Developer Name">
														<?= $result['data']['developer_name'] ?>
													</a></td>
												</tr>
												<tr>
													<td>Address</td>
													<td><a href="#" id="address" data-type="textarea" data-pk="1"  data-placeholder="Required" data-original-title="Address"><?= trim($result['data']['address']) ?></a></td>
												</tr>
											
											</tbody>
										</table>
										<div class="form-group" >
											 
											<div  style="text-align:right;">
												<button data-style="expand-right" class="ladda-button" data-color="green">
													Update Property <i class="fa fa-arrow-circle-right"></i>
												</button>
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