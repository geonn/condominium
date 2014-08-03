
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>Form Elements <small>common form elements &amp; layouts </small></h1>
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
													<div class="thread-image">
														<img src="./assets/images/avatar-2.jpg" alt="">
													</div>
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
													<div class="thread-image">
														<img src="./assets/images/avatar-3.jpg" alt="">
													</div>
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
													<div class="thread-image">
														<img src="./assets/images/avatar-5.jpg" alt="">
													</div>
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
					Form Elements
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
					<h4 class="panel-title">Text <span class="text-bold">Fields</span></h4>
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
				<div class="panel-body">
					<form role="form" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Text Field
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Text Field" id="form-field-1" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Password
							</label>
							<div class="col-sm-9">
								<input type="password" placeholder="Password" id="form-field-2" class="form-control">
							</div>
						</div>
						<div class="form-group has-success">
							<label class="col-sm-2 control-label" for="form-field-3" >
								Success Field
							</label>
							<div class="col-sm-9">
								<input type="text" id="form-field-3" class="form-control">
							</div>
						</div>
						<div class="form-group has-warning">
							<label class="col-sm-2 control-label" for="form-field-4" >
								Warning Field
							</label>
							<div class="col-sm-9">
								<input type="text" id="form-field-4" class="form-control">
							</div>
						</div>
						<div class="form-group has-error">
							<label class="col-sm-2 control-label" for="form-field-5" >
								Error Field
							</label>
							<div class="col-sm-9">
								<input type="text" id="form-field-5" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-6">
								Block Help
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Text Field" id="form-field-6" class="form-control">
								<span class="help-block"><i class="fa fa-info-circle"></i> A block of help text that breaks onto a new line and may extend beyond one line.</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-7">
								Inline Help
							</label>
							<div class="col-sm-7">
								<input type="text" placeholder="Text Field" id="form-field-7" class="form-control">
							</div>
							<span class="help-inline col-sm-2"> <i class="fa fa-info-circle"></i> Inline help text </span>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-8">
								Tooltip and Help Button
							</label>
							<div class="col-sm-9">
								<span class="input-help">
									<input id="form-field-8" class="form-control tooltips" type="text" data-placement="top" title="" placeholder="Tooltip on hover" data-rel="tooltip" data-original-title="Hello Tooltip!">
									<i class="help-button popovers" title="" data-content="More details." data-placement="right" data-trigger="hover" data-rel="popover" data-original-title="Popover on hover"></i> </span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">
								Sizes
							</label>
							<div class="col-sm-2">
								<input type="text" placeholder="Text Field" id="form-field-9" class="form-control">
							</div>
							<div class="col-sm-3">
								<input type="text" placeholder="Text Field" id="form-field-10" class="form-control">
							</div>
							<div class="col-sm-4">
								<input type="text" placeholder="Text Field" id="form-field-11" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-12">
								Large Field
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Text Field" id="form-field-12" class="form-control input-lg">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-13">
								Small Field
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Text Field" id="form-field-13" class="form-control input-sm">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">
								Input with Icon
							</label>
							<div class="col-sm-3">
								<span class="input-icon">
									<input type="text" placeholder="Text Field" id="form-field-14" class="form-control">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="col-sm-3">
								<span class="input-icon">
									<input type="text" placeholder="Text Field" id="form-field-15" class="form-control">
									<i class="fa fa-quote-left"></i> </span>
							</div>
							<div class="col-sm-3">
								<span class="input-icon">
									<input type="text" placeholder="Text Field" id="form-field-16" class="form-control">
									<i class="fa fa-hand-o-right"></i> </span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">
								Right Icon
							</label>
							<div class="col-sm-3">
								<span class="input-icon input-icon-right">
									<input type="text" placeholder="Text Field" id="form-field-17" class="form-control">
									<i class="fa fa-rocket"></i> </span>
							</div>
							<div class="col-sm-3">
								<span class="input-icon input-icon-right">
									<input type="text" placeholder="Text Field" id="form-field-18" class="form-control">
									<i class="fa fa-quote-right"></i> </span>
							</div>
							<div class="col-sm-3">
								<span class="input-icon input-icon-right">
									<input type="text" placeholder="Text Field" id="form-field-19" class="form-control">
									<i class="fa fa-hand-o-left"></i> </span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">
								Add-on
							</label>
							<div class="col-sm-3">
								<div class="input-group">
									<span class="input-group-addon">@</span>
									<input type="text" placeholder="Username" class="form-control">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control">
									<span class="input-group-addon">.00</span>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="text" class="form-control">
									<span class="input-group-addon">.00</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-20">
								With Character Limit
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Text Field" id="form-field-20" class="form-control limited" maxlength="40">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-21">
								Disabled
							</label>
							<div class="col-sm-9">
								<input type="text" placeholder="Text Field" id="form-field-21" class="form-control" disabled="disabled">
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end: TEXT FIELDS PANEL -->
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<!-- start: TEXT AREA PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Text <span class="text-bold">Area</span></h4>
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
				<div class="panel-body">
					<div class="form-group">
						<label for="form-field-22">
							Default
						</label>
						<textarea placeholder="Default Text" id="form-field-22" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="form-field-23">
							With Character Limit
						</label>
						<textarea maxlength="50" id="form-field-23" class="form-control limited"></textarea>
					</div>
					<div>
						<label for="form-field-24">
							Autosize
						</label>
						<textarea class="autosize form-control" id="form-field-24"></textarea>
					</div>
				</div>
			</div>
			<!-- end: TEXT AREA PANEL -->
		</div>
		<div class="col-sm-6">
			<!-- start: SELECT BOX PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Select <span class="text-bold">Box</span></h4>
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
				<div class="panel-body">
					<div class="form-group">
						<label for="form-field-select-1">
							Default
						</label>
						<select id="form-field-select-1" class="form-control">
							<option value="">&nbsp;</option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
					</div>
					<div class="form-group">
						<label for="form-field-select-2">
							Multiple
						</label>
						<select multiple="multiple" id="form-field-select-2" class="form-control">
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
					</div>
					<div class="form-group">
						<label for="form-field-select-3">
							Select 2
						</label>
						<select id="form-field-select-3" class="form-control search-select">
							<option value="">&nbsp;</option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
					</div>
					<div class="form-group">
						<label for="form-field-select-4">
							Dropdown Multiple Select
						</label>
						<select multiple="multiple" id="form-field-select-4" class="form-control search-select">
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
					</div>
				</div>
			</div>
			<!-- end: SELECT BOX PANEL -->
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<!-- start: CHECKBOXES PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Checkboxes</h4>
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
				<div class="panel-body">
					<h5 class="space15"> Inline Checkbox </h5>
					<label class="checkbox-inline">
						<input type="checkbox" value="" class="grey">
						Checkbox 1
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" value="" class="grey">
						Checkbox 2
					</label>
					<h5 class="space15"> Vertical Checkbox </h5>
					<div class="checkbox">
						<label>
							<input type="checkbox" value="" class="grey">
							Checkbox 1
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" value="" class="grey">
							Checkbox 2
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" value="" class="grey">
							Checkbox 3
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" value="" class="grey" disabled="disabled">
							Disabled
						</label>
					</div>
					<h5 class="space15"> Verious Colours </h5>
					<label class="checkbox-inline">
						<input type="checkbox" class="red" value="" checked="checked">
						Checkbox 1
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="green" value="" checked="checked">
						Checkbox 2
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="teal" value="" checked="checked">
						Checkbox 3
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="orange" value="" checked="checked">
						Checkbox 4
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="purple" value="" checked="checked">
						Checkbox 5
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="yellow" value="" checked="checked">
						Checkbox 6
					</label>
					<h5 class="space15"> Verious Styles </h5>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-black" value="" checked="checked">
						Checkbox 1
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-grey" value="" checked="checked">
						Checkbox 2
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-red" value="" checked="checked">
						Checkbox 3
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-green" value="" checked="checked">
						Checkbox 4
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-teal" value="" checked="checked">
						Checkbox 5
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-orange" value="" checked="checked">
						Checkbox 6
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-purple" value="" checked="checked">
						Checkbox 7
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="square-yellow" value="" checked="checked">
						Checkbox 8
					</label>
					<h5 class="space15"> Verious Styles </h5>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-black" value="" checked="checked">
						Checkbox 1
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-grey" value="" checked="checked">
						Checkbox 2
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-red" value="" checked="checked">
						Checkbox 3
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-green" value="" checked="checked">
						Checkbox 4
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-teal" value="" checked="checked">
						Checkbox 5
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-orange" value="" checked="checked">
						Checkbox 6
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-purple" value="" checked="checked">
						Checkbox 7
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" class="flat-yellow" value="" checked="checked">
						Checkbox 8
					</label>
					<h5> Callback </h5>
					<p>
						iCheck provides plenty callbacks, which may be used to handle changes.
					</p>
					<div class="checkbox">
						<label>
							<input type="checkbox" value="" class="grey checkbox-callback">
							Click Me
						</label>
					</div>
				</div>
			</div>
			<!-- end: CHECKBOXES PANEL -->
		</div>
		<div class="col-sm-6">
			<!-- start: RADIO PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Radio</h4>
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
				<div class="panel-body">
					<h5 class="space15"> Inline radio </h5>
					<label class="radio-inline">
						<input type="radio" value="" name="optionsRadios" class="grey">
						Radio Button 1
					</label>
					<label class="radio-inline">
						<input type="radio" value="" name="optionsRadios" class="grey">
						Radio Button 2
					</label>
					<h5 class="space15"> Vertical radio </h5>
					<div class="radio">
						<label>
							<input type="radio" value="" name="optionsRadios2" class="grey">
							Radio Button 1
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" value="" name="optionsRadios2" class="grey">
							Radio Button 2
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" value="" name="optionsRadios2" class="grey">
							Radio Button 3
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" value="" name="optionsRadios2" class="grey" disabled="disabled">
							Disabled
						</label>
					</div>
					<h5 class="space15"> Verious Colours </h5>
					<label class="radio-inline">
						<input type="radio" class="red" value="" checked="checked" name="optionsRadios3">
						Radio Button 1
					</label>
					<label class="radio-inline">
						<input type="radio" class="green" value="" checked="checked" name="optionsRadios4">
						Radio Button 2
					</label>
					<label class="radio-inline">
						<input type="radio" class="teal" value="" checked="checked" name="optionsRadios5">
						Radio Button 3
					</label>
					<label class="radio-inline">
						<input type="radio" class="orange" value="" checked="checked" name="optionsRadios6">
						Radio Button 4
					</label>
					<label class="radio-inline">
						<input type="radio" class="purple" value="" checked="checked" name="optionsRadios7">
						Radio Button 5
					</label>
					<label class="radio-inline">
						<input type="radio" class="yellow" value="" checked="checked" name="optionsRadios8">
						Radio Button 6
					</label>
					<h5 class="space15"> Verious Styles </h5>
					<label class="radio-inline">
						<input type="radio" class="square-black" value="" checked="checked" name="optionsRadios9">
						Radio Button 1
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-grey" value="" checked="checked" name="optionsRadios10">
						Radio Button 2
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-red" value="" checked="checked" name="optionsRadios11">
						Radio Button 3
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-green" value="" checked="checked" name="optionsRadios12">
						Radio Button 4
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-teal" value="" checked="checked" name="optionsRadios13">
						Radio Button 5
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-orange" value="" checked="checked" name="optionsRadios14">
						Radio Button 6
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-purple" value="" checked="checked" name="optionsRadios15">
						Radio Button 7
					</label>
					<label class="radio-inline">
						<input type="radio" class="square-yellow" value="" checked="checked" name="optionsRadios16">
						Radio Button 8
					</label>
					<h5 class="space15"> Verious Styles </h5>
					<label class="radio-inline">
						<input type="radio" class="flat-black" value="" checked="checked" name="optionsRadios17">
						Radio Button 1
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-grey" value="" checked="checked" name="optionsRadios18">
						Radio Button 2
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-red" value="" checked="checked" name="optionsRadios19">
						Radio Button 3
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-green" value="" checked="checked" name="optionsRadios20">
						Radio Button 4
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-teal" value="" checked="checked" name="optionsRadios21">
						Radio Button 5
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-orange" value="" checked="checked" name="optionsRadios22">
						Radio Button 6
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-purple" value="" checked="checked" name="optionsRadios23">
						Radio Button 7
					</label>
					<label class="radio-inline">
						<input type="radio" class="flat-yellow" value="" checked="checked" name="optionsRadios24">
						Radio Button 8
					</label>
					<h5> Callback </h5>
					<p>
						iCheck provides plenty callbacks, which may be used to handle changes.
					</p>
					<label class="radio-inline">
						<input type="radio" value="First" name="optionsRadios25" class="grey radio-callback">
						Radio Button 1
					</label>
					<label class="radio-inline">
						<input type="radio" value="Second" name="optionsRadios25" class="grey radio-callback">
						Radio Button 2
					</label>
				</div>
			</div>
			<!-- end: RADIO PANEL -->
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<!-- start: DATE/TIME PICKER PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Date/Time <span class="text-bold">Picker</span></h4>
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
				<div class="panel-body">
					<p>
						Date Picker
					</p>
					<div class="input-group">
						<input type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker">
						<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
					</div>
					<hr>
					<p>
						Time Picker
					</p>
					<div class="input-group input-append bootstrap-timepicker">
						<input type="text" class="form-control time-picker">
						<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
					</div>
					<hr>
					<p>
						Date Range Picker
					</p>
					<div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
						<input type="text" class="form-control date-range">
					</div>
					<hr>
					<p>
						Date + Time Range Picker
					</p>
					<div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
						<input type="text" class="form-control date-time-range">
					</div>
				</div>
			</div>
			<!-- end: DATE/TIME PICKER PANEL -->
		</div>
		<div class="col-sm-6">
			<!-- start: MASKED INPUT PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Masked <span class="text-bold">Input</span></h4>
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
				<div class="panel-body">
					<div>
						<label for="form-field-mask-1">
							Date <small class="text-success">99/99/9999</small>
						</label>
						<div class="input-group">
							<input type="text" id="form-field-mask-1" class="form-control input-mask-date">
							<span class="input-group-btn">
								<button type="button" class="btn btn-green">
									<i class="fa fa-calendar"></i>
									Go!
								</button> </span>
						</div>
					</div>
					<hr>
					<div>
						<label for="form-field-mask-2">
							Phone <small class="text-warning">(999) 999-9999</small>
						</label>
						<div class="input-group">
							<span class="input-group-addon"> <i class="fa fa-phone"></i> </span>
							<input type="text" id="form-field-mask-2" class="form-control input-mask-phone">
						</div>
					</div>
					<hr>
					<div>
						<label for="form-field-mask-3">
							Product Key <small class="text-error">a*-999-a999</small>
						</label>
						<div class="input-group">
							<input type="text" id="form-field-mask-3" class="form-control input-mask-product">
							<span class="input-group-addon"> <i class="fa fa-key"></i> </span>
						</div>
					</div>
					<hr>
					<div>
						<label for="form-field-mask-4">
							Eye Script <small class="text-info">~9.99 ~9.99 999</small>
						</label>
						<div>
							<input type="text" id="form-field-mask-4" class="form-control input-mask-eyescript">
						</div>
					</div>
					<hr>
					<div>
						<label for="form-field-mask-5">
							Mask Money <small class="text-success">0.00</small>
						</label>
						<div>
							<input type="text" id="form-field-mask-5" class="form-control currency">
						</div>
					</div>
				</div>
			</div>
			<!-- end: MASKED INPUT PANEL -->
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<!-- start: COLOR PICKER PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Color <span class="text-bold">Picker</span></h4>
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
				<div class="panel-body">
					<div class="form-group">
						<label>
							Default
						</label>
						<div>
							<input type="text" value="#8fff00" class="form-control color-picker">
						</div>
					</div>
					<div class="form-group">
						<label>
							RGBA
						</label>
						<div>
							<input type="text" value="rgb(0,194,255,0.78)" class="form-control color-picker-rgba">
						</div>
					</div>
					<div class="form-group">
						<label>
							As Component
						</label>
						<div class="input-group colorpicker-component" data-color="rgb(81, 145, 185)" data-color-format="rgb">
							<input type="text" value="" readonly class="form-control">
							<span class="input-group-addon"><i></i></span>
						</div>
					</div>
					<div class="form-group">
						<label>
							Color Palette
						</label>
						<div class="input-group">
							<input type="text" value="" class="form-control" id="selected-color1">
							<span class="btn input-group-addon btn-azure" data-toggle="dropdown">color</span>
							<ul class="dropdown-menu pull-right center">
								<li>
									<div class="color-palette"></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- end: COLOR PICKER PANEL -->
		</div>
		<div class="col-sm-6">
			<!-- start: TAGS PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Tags</h4>
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
				<div class="panel-body">
					<label>
						Defaults:
					</label>
					<input id="tags_1" type="text" class="tags" value="foo,bar,baz,roffle">
				</div>
			</div>
			<!-- end: TAGS PANEL -->
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<!-- start: FILE UPLOAD PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">File <span class="text-bold">upload</span></h4>
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
				<div class="panel-body">
					<form class="form-horizontal" action="#">
						<div class="form-group">
							<div class="col-sm-12">
								<label>
									Simple
								</label>
								<div data-provides="fileupload" class="fileupload fileupload-new">
									<span class="btn btn-file btn-light-grey"><i class="fa fa-folder-open-o"></i> <span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
										<input type="file">
									</span>
									<span class="fileupload-preview"></span>
									<a data-dismiss="fileupload" class="close fileupload-exists float-none" href="#">
										&times;
									</a>
								</div>
								<p class="help-block">
									Example block-level help text here.
								</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label>
									Advanced
								</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="input-group">
										<div class="form-control uneditable-input">
											<i class="fa fa-file fileupload-exists"></i>
											<span class="fileupload-preview"></span>
										</div>
										<div class="input-group-btn">
											<div class="btn btn-light-grey btn-file">
												<span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
												<span class="fileupload-exists"><i class="fa fa-folder-open-o"></i> Change</span>
												<input type="file" class="file-input">
											</div>
											<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
												<i class="fa fa-times"></i> Remove
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label>
									Image Upload
								</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt=""/>
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail"></div>
									<div>
										<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
											<input type="file">
										</span>
										<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
											<i class="fa fa-times"></i> Remove
										</a>
									</div>
								</div>
								<div class="alert alert-warning">
									<span class="label label-warning">NOTE!</span>
									<span> Image preview only works in IE10+, FF3.6+, Chrome6.0+ and Opera11.1+. In older browsers and Safari, the filename is shown instead. </span>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end: FILE UPLOAD PANEL -->
		</div>
		<div class="col-sm-6">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Input <span class="text-bold">Spinner</span></h4>
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
				<div class="panel-body">
					<h5>Example with postfix (large):</h5>
					<input id="demo1" type="text" value="55" name="demo1">
					<h5>With prefix</h5>
					<input id="demo2" type="text" value="0" name="demo2">
					<h5>Vertical button alignment</h5>
					<input id="demo3" type="text" value="0" name="demo3">
					<h5>Vertical buttons with custom icons</h5>
					<input id="demo4" type="text" value="0" name="demo4">
					<h5>Button postfix</h5>
					<input id="demo5" type="text" value="0" name="demo5">
					<h5>Button postfix (large)</h5>
					<input id="demo6" type="text" value="0" name="demo6" class="form-control input-lg">
					<h5>Button group</h5>
					<div class="input-group">
						<input id="demo7" type="text" class="form-control" name="demo7" value="50">
						<div class="input-group-btn">
							<button type="button" class="btn btn-default">
								Action
							</button>
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="#">
										Action</a>
								</li>
								<li>
									<a href="#">
										Another action</a>
								</li>
								<li>
									<a href="#">
										Something else here</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										Separated link</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<!-- start: WYSIWYG EDITORS PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">WYSIWYG <span class="text-bold">Editors</span></h4>
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
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">
									Custom Summernote Style</label>
								<div class="noteWrap">
									<div class="form-group">
										<textarea class="summernote" placeholder="Write note here..."></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">
									Default Summernote Style
								</label>
								<div class="summernote">
									Hello Summernote
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">
									CKEditor
								</label>
								<textarea class="ckeditor form-control" cols="10" rows="10"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end: WYSIWYG EDITORS PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>