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
                                        <th>Status</th>
                                        <th>Action</th>
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
                                        <td> <?= match($val['status'], $this->config->item('maintenance_status')) ?></td>
                                        <td>
											<a class="btn btn-purple" href="<?= $this->config->item('domain').'/'.$this->name ?>/edit/<?= $val['m_id'] ?>">
												EDIT <i class="fa fa-edit"></i>
											</a>
										</td>
									</tr>
								<?php
								}
								 } else{ ?>
									<tr><td colspan="10" style="text-align:center;">No records found.</td></tr>
										
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
	var TableData = function() {
	"use strict";
	//function to initiate DataTable
	//DataTable is a highly flexible tool, based upon the foundations of progressive enhancement,
	//which will add advanced interaction controls to any HTML table
	//For more information, please visit https://datatables.net/
	
	var runDataTable_maintenance = function(){
			var oTable = $('#maintenanceTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[0, 'desc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});
		$('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
		// modify table search input
		$('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
		$('#sample_1_wrapper .dataTables_length select').select2();
		// initialzie select2 dropdown
		$('#sample_1_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
		});
	}

	return {
		//main function to initiate template pages
		init : function() {
			runDataTable_maintenance();
		}
	};
}();

</script>