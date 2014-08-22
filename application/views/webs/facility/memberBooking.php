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
									<h1>Calendar <small>with draggable and editable events </small></h1>
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
										Calendar
									</li>
								</ol>
							</div>
						</div>
						<!-- end: BREADCRUMB -->
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-sm-12">
								<!-- start: FULL CALENDAR PANEL -->
								<div class="panel panel-white">
								 
									<div class="panel-body">
										<div class="col-sm-12 space20">
											<a href="<?= $this->config->item('domain') ?>/<?= $this->name ?>/memberAddBooking" class="btn btn-green add-event"><i class="fa fa-plus"></i> Book Facility</a>
										</div>
										<div class="col-sm-9">
											<div id='booking-calendar'></div>
										</div>
										<div class="col-sm-3">
											<h4 class="space20">Draggable categories</h4>
											<div id="event-categories">
												<div class="event-category event-generic" data-class="event-generic">
													Generic
												</div>
												<div class="event-category event-home" data-class="event-home">
													Home
												</div>
												<div class="event-category event-overtime" data-class="event-overtime">
													Overtime
												</div>
												<div class="event-category event-job" data-class="event-job">
													Job
												</div>
												<div class="event-category event-offsite" data-class="event-offsite">
													Off-site work
												</div>
												<div class="event-category event-todo" data-class="event-todo">
													To Do
												</div>
												<div class="event-category event-cancelled" data-class="event-cancelled">
													Cancelled
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="grey" id="drop-remove" />
														Remove after drop
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end: FULL CALENDAR PANEL -->
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
	$(function(){
			getBookingList();
	});

	var myBooking = [];
	
	var getBookingList = function(){
		/**Get booking info***/
		$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getMemberBookingInfo/", function(result) {
				
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				 console.log(obj.data);
				 var info = obj.data;
				 $.each(info, function(key,  val ) {
				  console.log( val['facility'] );
				   myBooking.push({
				   		title: "Booked for "+ val['facility'] ,
				   		start : new Date(val['bookYear'], val['bookMonth'] -1 , val['bookDay'], val['startTime'], 0),
						end : new Date(val['bookYear'], val['bookMonth'] -1, val['bookDay'], val['endTime'], 0),
						className: 'event-job',
			            category: 'Job',
						allDay : false,
						content : val['remark']
				   	});
				});

			//	
			}else{
				//error message
			}
			
			runBookingCalendar();
		});
		return false;
	}
	
	    //function to initiate Full Calendar
    var runBookingCalendar = function () {
    	$(".add-event").off().on("click", function() {
    					subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
    	$.subview({
					content : subViewContent,
					onShow : function() {
						editFullEvent();
					},
					onHide : function() {
						hideEditEvent();
					}
				});
    	});
    	
        $('#event-categories div.event-category').each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 50 //  original position after the drag
            });
        });
        /* initialize the calendar
		-----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear(); 
        var form = '';
        $('#booking-calendar').fullCalendar({
            buttonText: {
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: myBooking,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                
                var $categoryClass = $(this).attr('data-class');
                var $category = $categoryClass.replace("event-", "").toLowerCase().replace(/\b[a-z]/g, function(letter) {
				    return letter.toUpperCase();
				});
                // we need to copy it, so that multiple events don't have a reference to the same object

                
                
                newEvent = new Object;
				newEvent.title = originalEventObject.title, newEvent.start = new Date(date), newEvent.end =  moment(new Date(date)).add('hours', 1), newEvent.allDay = true, newEvent.className = $categoryClass, newEvent.category = $category, newEvent.content = "";

                myBooking.push(newEvent);
                $('#booking-calendar').fullCalendar( 'refetchEvents' );
               
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
            	defaultRange.start = moment(start);
				defaultRange.end = moment(start).add('hours', 1);
				$.subview({
					content : "#newFullEvent",
					onShow : function() {
						editFullEvent();
					},
					onHide : function() {
						hideEditEvent();
					}
				});
            },
            eventClick: function (calEvent, jsEvent, view) {
            	dateToShow = calEvent.start;

				$.subview({
					content : "#readFullEvent",
					startFrom : "right",
					onShow : function() {
						readFullEvents(calEvent._id);
					}
				});
                
            }
        });
    };
</script>