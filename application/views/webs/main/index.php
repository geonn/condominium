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
									<h1>Dashboard <small>overview &amp; of property activities </small></h1>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<a href="#" class="back-subviews">
									<i class="fa fa-chevron-left"></i> BACK
								</a>
								<a href="#" class="close-subviews">
									<i class="fa fa-times"></i> CLOSE
								</a>
								<div class="toolbar-tools pull-right">
								
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
											Dashboard
										</a>
									</li>
								
								</ol>
							</div>
						</div>
						<!-- end: BREADCRUMB -->
						<!-- start: PAGE CONTENT -->
						
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="panel panel-white">
									<div class="panel-heading border-light">
										<h4 class="panel-title">Latest <span class="text-bold">Facilities Booked</span></h4>
										<ul class="panel-heading-tabs border-light">
											<li class="panel-tools" onclick="viewMoreBooking();">
												<span style="color:#01DF01;font-weight:bold;cursor:pointer;">VIEW MORE</span>
											</li>
										</ul>
									</div>
									<div class="panel-body">
										<div class="col-md-12">
											<div >
												<div id="chart4" class='with-3d-shadow with-transitions'>
													<?php
														if(!empty($list['data'] )){ ?>
														<table class="table table-bordered table-hover" id="sample-table-1">
															<thead>
																<tr>
																	<th class="center">Name</th>
																	<th class="center">Unit Lots</th>
																	<th class="center">Facility</th>
																	<th class="center">Ground</th>
																	<th class="center">Date</th>
																	<th class="center">Time</th>
																	<th class="center">Status</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($list['data'] as $k => $val){ 
																$val['user']['residental']['unitLots'] = (!empty($val['user']['residental']['unitLots']))?$val['user']['residental']['unitLots']:"";
																?>
																<tr>
																	<td class="center"> <?= $val['user']['firstname'] . " ". $val['user']['lastname'] ?></td>
																	<td class="center"><?= $val['user']['residental']['unitLots'] ?> </td>
																	<td class="center"><?= $val['facility'] ?> </td>
																	<td class="center"><?= $val['options'] ?> </td>
																	<td class="center"><?= date_convert($val['bookDate'], 'ori') .", ". $val['day'] ?> </td>
																	<td class="center"><?= $val['start_time']." - ". $val['end_time']  ?> </td>
																	<td class="center"><?php 
																		if($val['status'] == "Confirmed"){
																			echo "<span style='color:#298A08;'>";
																		}else{
																			echo "<span style='color:#886A08;'>";
																		}
																		echo $val['status'] ."</span>";
																		
																		?> </td>
																</tr>
																
																<?php } ?>
															</tbody>
														</table>
													<?php	}else{
														echo "No records found";	
													} ?>
												</div>
											</div>
										</div>
									</div>
								</div>
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
	var viewMoreBooking = function(){
		window.location.href = "<?= $this->config->item('domain') ?>/facility/booking";
	}
</script>