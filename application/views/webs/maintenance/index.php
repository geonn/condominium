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
						<h1>Manage Property <small>view all available properties in the system</small></h1>
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
							<h4 class="panel-title"><span class="text-bold">Property List</span></h4>
						
						</div>
						<div class="panel-body">
							
							<table class="table table-striped table-bordered table-hover table-full-width" id="maintenanceTable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Ownder Name</th>
										<th>Unit Lots</th>
										<th>Payment For</th>
										<th class="hidden-xs"> Maintenance Type</th>
										<th class="hidden-xs">Payment Type</th>
										<th class="hidden-xs">Payment Amount</th>
										<th class="hidden-xs">Transaction Date</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if(!empty($result['data'])){
								foreach($result['data'] as $k => $val){ ?>	
									<tr>
										<td><?= $val['m_id'] ?></td>
										<td><?= $val['name'] ?></td>
										<td><?= $val['unitLots'] ?></td>
										<td><?=   date_convert($val['duration'], 'shorten') ?></td>
										<td class="hidden-xs"><?= $val['type'] ?></td>
										<td class="hidden-xs"><?= $val['paymentType'] ?></td>
										<td class="hidden-xs"><?= $val['totalAmount'] ?></td>
										<td class="hidden-xs"><?=   date_convert($val['created'], 'full') ?></td>
									</tr>
								<?php
								}
								 } else{ ?>
									<tr><td colspan="8" style="text-align:center;">No records found.</td></tr>
										
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