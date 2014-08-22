
<div class="main-container inner">
	<!-- start: PAGE -->
	<div class="container">
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>Booking Form For <?= ucwords($this->name) ?> <small>reserved <?= $this->name ?> for your preferred date and time</small></h1>
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
						View My Booking
					</a>
				</li>
				<li class="active">
					Book A Facility
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
					<h4 class="panel-title"> <span class="text-bold">Basic Information</span></h4>
				 
				</div>
				<div class="panel-body">
					<div class="errorHandler alert alert-danger no-display" style="display: none;"> </div>
					<form role="form" class="form-horizontal" id="bookingForm">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-1">
								Book For <span class="symbol required"></span>
							</label>
							<div class="col-sm-9">
								<span class="input-icon">
									<i class="fa fa-gamepad"></i>
									<?= form_dropdown('bookingFacility', array(""=>"Choose Facility")  + $this->facility_model->getFacilityList(), '',' id="bookingFacility" class="form-control search-select"  style="width:97%;margin-left:30px;"'); ?> 
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Date
							</label>
							<div class="col-sm-9">
								<div class="all-day-range">
									<div class="col-md-12">
										<span class="input-icon">
												<i class="fa fa-calendar"></i> 
											<input type="text" id="bookingDate" class="event-range-date form-control date-range" name="bookingDate" placeholder="Range date"/>
										</span>
									</div>
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-field-2">
								Time
							</label>
							<div class="col-sm-9">
								<span class="input-icon">
								<i class="fa fa-clock-o"></i><?= form_dropdown('bookingTime', array(""=>"Choose Time")+$this->config->item('time_range'), '',' id="time" class="form-control search-select" style="width:97%;margin-left:30px;"'); ?> 
							</span>
							</div>
						</div>
					
						<div class="form-group" >
							<label class="col-sm-2 control-label form-field-select-3" for="form-field-select-3"></label>
							<div class="col-sm-9" style="text-align:right;">
								<button data-style="expand-right" class="ladda-button" data-color="green">
									Check Availability <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>
			
			<!-- end: TEXT FIELDS PANEL -->
		</div>
	</div>

	
	<!-- end: PAGE CONTENT-->
</div>
 

<script>
	var date = new Date();
	date.setDate(date.getDate()-1);
	$(function(){
		$("#bookingDate").datepicker({ 
			format: 'dd/mm/yyyy ' ,
			startDate: date,
		});
		runbookingForm();
	});
	
	 var toastCount = 0;
	 var showSuccessPopUp =  function () {
            var shortCutFunction = "success";
            var msg = 'Facility successfully created!';//$('#message').val();
            var title = 'New Facility';
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
        
     var runbookingForm = function () {
        var form2 = $('#bookingForm');
        var errorHandler2 = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
        
            ignore: "",
            rules: {
                bookingFacility: { 
                    required: true
                },
                bookingDate: { 
                    required: true
                },
                bookingTime: {
                    required: true 
                }
            },
            messages: {
                bookingFacility: "Please select a facility",
                bookingDate: "Please specify booking date",
                bookingTime: "Please specify booking time",
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler2.show();
                errorHandler2.hide();
                // submit form
                checkAvailablity();
            }
        });
         
       
    };
        
	var checkAvailablity = function(){
		var str = $('form').serialize();
		/**Do create property to system***/
		$(".errorHandler").hide();
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/checkAvailablity/", str, function(result) { 
			var obj = $.parseJSON(result);
			
			if(obj.status =="success"){
				showSuccessPopUp();
				setTimeout(function(){window.location.href="../<?= $this->name ?>/edit/"+obj.data;}, 2000);
			}else{
				//error message
				
				$(".errorHandler").show();
				$(".errorHandler").html(obj.data);
			}
		});
		
		return false;
	}
	
</script>