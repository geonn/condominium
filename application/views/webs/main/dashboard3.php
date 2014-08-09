<!-- start: MAIN CONTAINER -->
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="main-content">
		
		<div class="container">
			<!-- start: PAGE HEADER -->
			<!-- start: TOOLBAR -->
			<div class="toolbar row">
				<div class="col-sm-6 hidden-xs">
					<div class="page-header">
						<h1>Dashboard<small>all latest news, activities and notice board</small></h1>
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
				 <br/>
				</div>
			</div>
			<!-- end: BREADCRUMB -->			
			<!-- start: PAGE CONTENT -->
			<div class="row">
				<div class="col-md-12">
					<!-- start: TIMELINE PANEL -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h4 class="panel-title">Announcement Timeline</h4>
						</div>
						<div class="panel-body">
							<ul class="timeline-scrubber inner-element">
								<?php
								$counter = 0;
								 foreach($monthList as $key => $value) { 
								 		if($counter != 0){
								 ?>
								 	<li class="clearfix">
								<?php }else{ ?>
									<li class="selected">
								<?php } ?>
								
									<a href="#<?= $key ?>" data-separator="#<?= $key ?>"><?= $value ?></a>
								</li>
								<?php $counter++; } ?> 
							</ul>
							<div id="timeline" class="demo1">
								<div class="timeline">
									<div class="spine"></div>
									
									<?php foreach($result['data'] as $k => $val) { ?>
									<div class="date_separator" id="<?= strtolower($k) ?>" data-appear-top-offset="-400">
										<span><?= $k ?> 2014</span>
									</div>
									<ul class="columns">
										<?php foreach($val as $b => $bal){ ?>
										<li>
											<div class="timeline_element partition-white">
												<div class="timeline_date">
													<div>
														<div class="inline-block">
															<span class="day text-bold"><?= $bal['day'] ?></span>
														</div>
														<div class="inline-block">
															<span class="block week-day text-extra-large"><?= $bal['dayOfWeek'] ?></span>
															<span class="block month text-large text-light"><?= $bal['month'] ?> <?= $bal['year'] ?></span>
														</div>
													</div>
												</div>
												<div class="timeline_title">
													<h4 class="light-text no-margin padding-5"><?= $bal['title'] ?></h4>
												</div>
												<div class="timeline_content">
													<?= limit_text($bal['content'],660) ?>
												</div>
												<div class="readmore">
													<a href="<?= $this->config->item('domain')."/".$this->name ?>/articles/<?= $bal['id']  ?>" class="btn btn-green">
														Read More <i class="fa fa-arrow-circle-right"></i>
													</a>
												</div>
											</div>
										</li>
										<?php } ?>
										
							
									</ul>
									
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<!-- end: TIMELINE PANEL -->
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