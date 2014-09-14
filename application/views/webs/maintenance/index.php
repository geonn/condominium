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
							<h4 class="panel-title"><span class="text-bold"><?= ucwords($this->name) ?> List</span></h4>
						</div>
						
						<div style="padding:0px 15px 0 15px">
							<label>Sort By 
									<?= form_dropdown('category', array(""=>"All Category")+$this->config->item('maintenance_type'), $type,' id="category" size="1"'); ?> 
							</label>
							<br/>
							<table class="table table-striped table-bordered table-hover table-full-width" id="maintenanceTable">
								<thead>
									<tr>
										 
										<th>Ownder Name</th>
										<th>Unit Lots</th>
										<th>Payment For</th>
										<th class="hidden-xs"> Maintenance Type</th>
										<th class="hidden-xs">Payment Type</th>
										<th class="hidden-xs">Total Amount</th>
										<th >Balance</th>
										<th class="hidden-xs">Transaction Date</th>
										<?php 
										$role = $this->user->get_memberrole(); 
										if($role != 3){
										?>
										<th >Action</th>
									<?php } ?>
									</tr>
								</thead>
								<tbody>
									 <?php 
										if(!empty($result['data'])){
										foreach($result['data'] as $k => $val){ ?>	
											<tr>
												 
												<td><?= $val['name'] ?></td>
												<td><?= $val['unitLots'] ?></td>
												<td><?=   date_convert($val['duration'], 'shorten') ?></td>
												<td class="hidden-xs"><?= $val['type'] ?></td>
												<td class="hidden-xs"><?= $val['paymentType'] ?></td>
												<td class="hidden-xs"  style="text-align:right;"><?= number_format($val['totalAmount'],2) ?></td>
												<td style="text-align:right;"><?php 
													if(empty($val['payment'])){
														echo number_format($val['totalAmount'],2);
													}else{
														echo number_format($val['payment']['balance'],2);
													}
													 ?></td>
												<td class="hidden-xs"><?=   date_convert($val['created'], 'full') ?></td>
												<?php if($role != 3){ ?>
												<td>
													<?php 
													if(empty($val['payment']) || $val['payment']['balance'] !== "0"){
														echo '<a type="button" class="btn btn-blue btn-xs" href="'. $this->config->item('domain').'/'.$this->name .'/edit/'.$val['m_id'].'" >Pay Now</a>';
													} 
													 ?>
													 </td>
													<?php } ?>
											</tr>
										<?php
										}
										 } else{ ?>
											<tr><td colspan="9" style="text-align:center;">No records found.</td></tr>
									<?php } ?>
								</tbody>
							</table>
							<br/>
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
	var queryString  = "<?= $this->config->item('domain') ?>/<?= $this->name ?>/get_list/";
	
	var TableData = function() {
	"use strict";
	
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

	
	$("#category").change(function(){
		var queryParam   = "?category="+ $( this ).val();
	 
		window.location.href = queryParam;
		//$('#geomilano').dataTable();
	});
</script>