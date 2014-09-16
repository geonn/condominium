<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="main-content">
	 
		<!-- end: SPANEL CONFIGURATION MODAL FORM -->
		<div class="container">
			<!-- start: PAGE HEADER -->
			<!-- start: TOOLBAR -->
			<div class="toolbar row">
				<div class="col-sm-6 hidden-xs">
					<div class="page-header">
						<h1>Booking Details <small>check schedule on facility booked</small></h1>
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
						
						<li class="active">
							Booking Calendar
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
						
							<div class="col-sm-9">
								<div id='book-calendar'></div>
							</div>
							<div class="col-sm-3">
								<h4 class="space20">Status categories</h4>
								<div id="event-categories">
									
									<div class="event-category event-offsite" data-class="event-offsite">
										Confirmed
									</div>
								
									<div class="event-category event-cancelled" data-class="event-cancelled">
										Cancelled
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
<div id="readFullEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-md-12">
				
				<h2 class="event-title"></h2>
				<?= form_hidden('fb_id', '') ?>
			</div>
			
			<div class="col-md-6">
				<span class="event-category" id="event-status">Cancelled</span>
			</div>
			<div class="col-md-12">
				<h2 class="event-title" id="event-title"></h2>
				<div class="errorHandler alert alert-danger no-display"> </div>
				
				<div class="event-start">
					<p>Start:</p> 
					<div class="event-day" id="start-day"></div>
					<div class="event-date"  id="start-date"></div> 
					<div class="event-time" id="start-time"></div>
				</div>
				<div class="event-end" style="display: block;">
					<p>End:</p> 
					<div class="event-day" id="end-day"></div>
					<div class="event-date"  id="end-date"></div> 
					<div class="event-time" id="end-time"></div>
				</div>
				
				<button data-style="expand-right" class="ladda-button float-right " data-color="red" id="cancelledEvent" >Cancelled</button>
				<button data-style="expand-right" class="ladda-button float-right " data-color="blue" id="rebookEvent" >Re-book Facility</button>
			</div>
			
			<div class="col-md-12">
				
				<div class="event-content"></div>
			</div>
		</div>
	</div>
</div>
<div id="newFullEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Book a facility</h3>
		<form class="form-full-event">
			<div id="timeListing"></div>
		</form>
	</div>
</div>
<!-- end: SUBVIEW SAMPLE CONTENTS -->

<script>
	$(function(){
		getBookingInfo();
	});
	
	var myBooking = [];
	
	var getBookingInfo = function(){
		
		$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getPropertyFacilityBooking/",  function(result) {
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				$.each(obj.data,function(k,val){
				//	console.log(val);
					myBooking.push({
						id : val['fb_id'],
					    title: val['user']['username'] + ' booked  '+val['facility'],
		                start: new Date(val['bookYear'],val['bookMonth'] -1, val['bookDay'],val['startTime'],0),
		                end: new Date(val['bookYear'], val['bookMonth'] -1, val['bookDay'],val['endTime'],0),
		                className: val['className'],
		                category: 'Off-site work',
		                allDay: false	
					});
				});
				
				/***load to calendar after populate data***/
				runBookingCalendar();
			}
		});
	}
	
	 var toastCount = 0;
	 var showSuccessPopUp =  function () {
            var shortCutFunction = "success";
            var msg = 'Booking is successfully updated!';//$('#message').val();
            var title = 'Booking Activity';
            var toastIndex = toastCount++;

            toastr.options = {
                closeButton:true,
                positionClass:  'toast-top-right',
                onclick: null
            };
            
            toastr.options.showDuration = "1000";
			toastr.options.hideDuration = "1000";
            toastr.options.timeOut = "5000";
            toastr.options.extendedTimeOut = "1000";
            toastr.options.showEasing = "swing";
            toastr.options.hideEasing = "linear";
            toastr.options.showMethod = "fadeIn";
            toastr.options.hideMethod = "fadeOut";

            $("#toastrOptions").text("Command: toastr["
                            + shortCutFunction
                            + "](\""
                            + msg
                            + title
                            + "\")\n\ntoastr.options = "
                            + JSON.stringify(toastr.options, null, 2)
            );
            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
        }
        
	$("#cancelledEvent").click(function(){
			var str = "fb_id="+$("input[name=fb_id]").val();
			$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/cancelledEvent/",str,  function(result) {
				var obj = $.parseJSON(result);
				if(obj.status =="success"){
					//reset calendar
					$('#book-calendar').html("");
					myBooking = [];
					
					getBookingInfo();
					showSuccessPopUp();
					$("#event-status").html("Cancelled" );
					$("#event-status").removeClass("event-offsite" ).addClass('event-cancelled');
				}
			});
	});
	
	$("#rebookEvent").click(function(){
			$(".errorHandler").hide();
			var str = "fb_id="+$("input[name=fb_id]").val();
			$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/reActivateBooking/",str,  function(result) {
				var obj = $.parseJSON(result);
				if(obj.status =="success"){
					//reset calendar
					$('#book-calendar').html("");
					myBooking = [];
					
					getBookingInfo();
					showSuccessPopUp();
					$("#event-status").html("Confirmed" );
					$("#event-status").removeClass("event-cancelled" ).addClass('event-offsite');
				}else{
					$(".errorHandler").show();
					$(".errorHandler").html(obj.data);
				}
				
			});
	});
	
	var hideEditEvent = function() {
		$.hideSubview();
		$('.form-event .summernote').destroy();
		$(".form-event .all-day").bootstrapSwitch('destroy');
	};
	
	var todayDate = function(){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		
		if(dd<10) {
		    dd='0'+dd
		} 
		
		if(mm<10) {
		    mm='0'+mm
		} 
		
		return yyyy+'-'+mm+'-'+dd;
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
        $('#book-calendar').fullCalendar({
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
            droppable: true, // this allows things to be dropped onto the calendar !!!
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
                $('#fbook-calendar').fullCalendar( 'refetchEvents' );
               
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
            	var m = moment(start);
            	var newDt = m.format();
            	//var start = moment(start);
				//defaultRange.end = moment(start).add('hours', 1);
				$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getFacilityBookingByDay/?bookingDate="+newDt,  function(result) {
				//	console.log(result);
					$("#timeListing").html(result);
				});
				$.subview({
					content : "#newFullEvent",
					onShow : function() {
						//editFullEvent();
					},
					onHide : function() {
						hideEditEvent();
					}
				});
            },
            eventClick: function (calEvent, jsEvent, view) {
            	dateToShow = calEvent.start;
            	$(".errorHandler").hide(); 
				//retreive info details 
				$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getBookingInfoById/?fb_id="+calEvent.id,  function(result) {
				
					var obj = $.parseJSON(result);
					if(obj.status =="success"){
						$("input[name=fb_id]").val(obj.data['fb_id'] );
						$("#event-title").html("Booked <strong> "+ obj.data['options'] + " " + obj.data['facility'] +"</strong><br/>By <strong>"+obj.data['user']['firstname'] +" "+obj.data['user']['lastname']  +"</strong> from <strong>"+ obj.data['user']['residental']['unitLots']+"</strong>" );
						$("#event-status").html(obj.data['status']  );
						$("#event-status").addClass(obj.data['className']);
						$("#start-day").html("<h2>"+ obj.data['bookDay'] + "</h2>");
						$("#end-day").html("<h2>"+ obj.data['bookDay'] + "</h2>");
						
						$("#start-date").html("<h3>"+ obj.data['day'] + "</h3><h4>"+ obj.data['date'] + "</h4>");
						$("#end-date").html("<h3>"+ obj.data['day'] + "</h3><h4>"+ obj.data['date'] + "</h4>");
						
						$("#start-time").html("<h3><i class='fa fa-clock-o'></i> "+ obj.data['start_time'] + "</h3>");
						$("#end-time").html("<h3><i class='fa fa-clock-o'></i> "+ obj.data['end_time'] + "</h3>");
						
						if(obj.data['bookDate'] >= todayDate()){
							if(obj.data['status'] == "Confirmed"){
								$("#cancelledEvent").show();
								$("#rebookEvent").hide();
							}else{
								$("#cancelledEvent").hide();
								$("#rebookEvent").show();
							}
						}else{
							$("#cancelledEvent").hide();
							$("#rebookEvent").hide();
						}
						
					}
				});
				
				$.subview({
					content : "#readFullEvent",
					startFrom : "right",
					onShow : function() {
						//readFullEvents(calEvent._id);
					}
				});
                
            }
        });
    };
</script>