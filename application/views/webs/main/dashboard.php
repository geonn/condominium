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
									<h1>Announcement / News <small>mailbox sample</small></h1>
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
									<!-- start: TOP NAVIGATION MENU -->
									<ul class="nav navbar-right">
										<!-- start: TO-DO DROPDOWN -->
										<li class="dropdown">
											<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
												<i class="fa fa-plus"></i> SUBVIEW
												<div class="tooltip-notification hide">
													<div class="tooltip-notification-arrow"></div>
													<div class="tooltip-notification-inner">
														<div>
															<div class="semi-bold">
																HI THERE!
															</div>
															<div class="message">
																Try the Subview Live Experience
															</div>
														</div>
													</div>
												</div>
											</a>
											<ul class="dropdown-menu dropdown-light dropdown-subview">
												<li class="dropdown-header">
													Notes
												</li>
												<li>
													<a href="#newNote" class="new-note"><span class="fa-stack"> <i class="fa fa-file-text-o fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-danger"></i> </span> Add new note</a>
												</li>
												<li>
													<a href="#readNote" class="read-all-notes"><span class="fa-stack"> <i class="fa fa-file-text-o fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Read all notes</a>
												</li>
												<li class="dropdown-header">
													Calendar
												</li>
												<li>
													<a href="#newEvent" class="new-event"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-danger"></i> </span> Add new event</a>
												</li>
												<li>
													<a href="#showCalendar" class="show-calendar"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Show calendar</a>
												</li>
												<li class="dropdown-header">
													Contributors
												</li>
												<li>
													<a href="#newContributor" class="new-contributor"><span class="fa-stack"> <i class="fa fa-user fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-danger"></i> </span> Add new contributor</a>
												</li>
												<li>
													<a href="#showContributors" class="show-contributors"><span class="fa-stack"> <i class="fa fa-user fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Show all contributor</a>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
												<span class="messages-count badge badge-default hide">3</span> <i class="fa fa-envelope"></i> MESSAGES
											</a>
											<ul class="dropdown-menu dropdown-light dropdown-messages">
												<li>
													<span class="dropdown-header"> You have 9 messages</span>
												</li>
												<li>
													<div class="drop-down-wrapper ps-container">
														<ul>
															<li class="unread">
																<a href="javascript:;" class="unread">
																	<div class="clearfix">
																		
																		<div class="thread-content">
																			<span class="author">Nicole Bell</span>
																			<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
																			<span class="time"> Just Now</span>
																		</div>
																	</div>
																</a>
															</li>
															<li>
																<a href="javascript:;" class="unread">
																	<div class="clearfix">
																		
																		<div class="thread-content">
																			<span class="author">Steven Thompson</span>
																			<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
																			<span class="time">8 hrs</span>
																		</div>
																	</div>
																</a>
															</li>
															<li>
																<a href="javascript:;">
																	<div class="clearfix">
																		
																		<div class="thread-content">
																			<span class="author">Kenneth Ross</span>
																			<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
																			<span class="time">14 hrs</span>
																		</div>
																	</div>
																</a>
															</li>
														</ul>
													</div>
												</li>
												<li class="view-all">
													<a href="pages_messages.html">
														See All
													</a>
												</li>
											</ul>
										</li>
										<li class="menu-search">
											<a href="#">
												<i class="fa fa-search"></i> SEARCH
											</a>
											<!-- start: SEARCH POPOVER -->
											<div class="popover bottom search-box transition-all">
												<div class="arrow"></div>
												<div class="popover-content">
													<!-- start: SEARCH FORM -->
													<form class="" id="searchform" action="#">
														<div class="input-group">
															<input type="text" class="form-control" placeholder="Search">
															<span class="input-group-btn">
																<button class="btn btn-main-color btn-squared" type="button">
																	<i class="fa fa-search"></i>
																</button> </span>
														</div>
													</form>
													<!-- end: SEARCH FORM -->
												</div>
											</div>
											<!-- end: SEARCH POPOVER -->
										</li>
									</ul>
									<!-- end: TOP NAVIGATION MENU -->
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
									<li class="active">
										Messages
									</li>
								</ol>
							</div>
						</div>
						<!-- end: BREADCRUMB -->
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-md-12">
								<!-- start: INBOX PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title">Inbox</h4>
										<div class="panel-tools">
											<div class="dropdown">
												<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
													<i class="fa fa-cog"></i>
												</a>
												<ul class="dropdown-menu dropdown-light pull-right" role="menu">
													<li>
														<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
													</li>
													<li>
														<a class="panel-refresh" href="#">
															<i class="fa fa-refresh"></i> <span>Refresh</span>
														</a>
													</li>
													<li>
														<a class="panel-config" href="#panel-config" data-toggle="modal">
															<i class="fa fa-wrench"></i> <span>Configurations</span>
														</a>
													</li>
													<li>
														<a class="panel-expand" href="#">
															<i class="fa fa-expand"></i> <span>Fullscreen</span>
														</a>
													</li>
												</ul>
											</div>
											<a class="btn btn-xs btn-link panel-close" href="#">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="panel-body messages">
										<ul class="messages-list col-md-4">
											<li class="messages-search">
												<form action="#" class="form-inline">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Search messages...">
														<div class="input-group-btn">
															<button class="btn btn-green" type="button">
																<i class="fa fa-search"></i>
															</button>
														</div>
													</div>
												</form>
											</li>
											<li class="messages-item">
												<span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span>
											
												<span class="messages-item-from">Peter Clark</span>
												<div class="messages-item-time">
													<span class="text">10:23 PM</span>
													<div class="messages-item-actions">
														<a data-toggle="dropdown" title="Reply" href="#"><i class="fa fa-mail-reply"></i></a>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Move to folder" href="#"><i class="fa fa-folder-open"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																		<i class="fa fa-pencil"></i> Mark as Read
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-ban"></i> Spam
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-trash-o"></i> Delete
																	</a>
																</li>
															</ul>
														</div>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Attach to tag" href="#"><i class="fa fa-tag"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#"><i class="tag-icon red"></i>Important</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon blue"></i>Work</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon green"></i>Home</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<span class="messages-item-subject">Lorem ipsumdolor sit amet ...</span>
												<span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
											</li>
											<li class="messages-item active starred">
												<span title="Remove star" class="messages-item-star"><i class="fa fa-star"></i></span>
												<span class="messages-item-from">Nicole Bell</span>
												<div class="messages-item-time">
													<span class="text">08:46 PM</span>
													<div class="messages-item-actions">
														<a data-toggle="dropdown" title="Reply" href="#"><i class="fa fa-mail-reply"></i></a>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Move to folder" href="#"><i class="fa fa-folder-open"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																		<i class="fa fa-pencil"></i> Mark as Read
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-ban"></i> Spam
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-trash-o"></i> Delete
																	</a>
																</li>
															</ul>
														</div>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Attach to tag" href="#"><i class="fa fa-tag"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#"><i class="tag-icon red"></i>Important</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon blue"></i>Work</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon green"></i>Home</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<span class="messages-item-subject">Duis autem vel eum iriure ...</span>
												<span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
											</li>
											<li class="messages-item">
												<span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span>
												<span class="messages-item-attachment"><i class="fa fa-paperclip"></i></span>
												<span class="messages-item-from">Steven Thompson</span>
												<div class="messages-item-time">
													<span class="text">04:03 PM</span>
													<div class="messages-item-actions">
														<a data-toggle="dropdown" title="Reply" href="#"><i class="fa fa-mail-reply"></i></a>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Move to folder" href="#"><i class="fa fa-folder-open"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																		<i class="fa fa-pencil"></i> Mark as Read
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-ban"></i> Spam
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-trash-o"></i> Delete
																	</a>
																</li>
															</ul>
														</div>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Attach to tag" href="#"><i class="fa fa-tag"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#"><i class="tag-icon red"></i>Important</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon blue"></i>Work</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon green"></i>Home</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<span class="messages-item-subject">Lorem ipsumdolor sit amet ...</span>
												<span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
											</li>
											<li class="messages-item">
												<span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span>
												<span class="messages-item-from">Peter Clark</span>
												<div class="messages-item-time">
													<span class="text">11:16 AM</span>
													<div class="messages-item-actions">
														<a data-toggle="dropdown" title="Reply" href="#"><i class="fa fa-mail-reply"></i></a>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Move to folder" href="#"><i class="fa fa-folder-open"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																		<i class="fa fa-pencil"></i> Mark as Read
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-ban"></i> Spam
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="fa fa-trash-o"></i> Delete
																	</a>
																</li>
															</ul>
														</div>
														<div class="dropdown">
															<a data-toggle="dropdown" title="Attach to tag" href="#"><i class="fa fa-tag"></i></a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#"><i class="tag-icon red"></i>Important</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon blue"></i>Work</a>
																</li>
																<li>
																	<a href="#"><i class="tag-icon green"></i>Home</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<span class="messages-item-subject">Duis autem vel eum iriure ...</span>
												<span class="messages-item-preview">Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do antera ...</span>
											</li>
										</ul>
										<div class="messages-content col-md-8">
											<div class="message-header">
												<div class="message-time">
													11 NOV 2014, 11:46 PM
												</div>
												<div class="message-from">
													Nicole Bell &lt;nicole@example.com&gt;
												</div>
												<div class="message-to">
													To: Peter Clark
												</div>
												<div class="message-subject">
													New frontend layout
												</div>
												<div class="message-actions">
													<a title="Move to trash" href="#"><i class="fa fa-trash-o"></i></a>
													<a title="Reply" href="#"><i class="fa fa-reply"></i></a>
													<a title="Reply to all" href="#"><i class="fa fa-reply-all"></i></a>
													<a title="Forward" href="#"><i class="fa fa-long-arrow-right"></i></a>
												</div>
											</div>
											<div class="message-content">
												<p>
													<strong>Lorem ipsum</strong> dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
												</p>
												<p>
													Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem.
													Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.
												</p>
												<p>
													Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.
													Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut blandit ligula. In accumsan mauris at augue feugiat consequat. Aenean consequat sem sed velit sagittis dignissim. Phasellus quis convallis est. Praesent porttitor mauris nec lectus mollis, eget sodales libero venenatis. Cras eget vestibulum turpis. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam turpis velit, tempor vitae libero ac, fermentum laoreet dolor.
												</p>
											</div>
										</div>
									</div>
								</div>
								<!-- end: INBOX PANEL -->
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