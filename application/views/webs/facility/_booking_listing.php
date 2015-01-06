
<?php if($date < date('Y-m-d')){ ?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
		 
		</div>
	</div>
	
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<?php if(!empty($result)) {  ?>
			<table class="table table-bordered table-hover" id="sample-table-1">
						<thead>
							<tr>
								<th class="center"> Time</th>
								<th class="center">Agenda</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach($result as $k => $val){ ?>
							<tr>
								<td class="center"> <?= match($k, $this->config->item('time_range')) ?></td>
								<td class="center"><?php
									
									if(!empty($val)){
										echo "<ul>";
										foreach($val as $index => $agenda){
											if(empty($agenda['options'])){
												echo  "<li style='text-align:left;'>". $agenda['user']['firstname']." ".$agenda['user']['lastname'] . " ". $agenda['facility']. "</li>";
											}else{
												echo  "<li style='text-align:left;'>". $agenda['user']['firstname']." ".$agenda['user']['lastname'] . " ". $agenda['facility'] . " (".$agenda['options'].")</li>";
											}
										}
										echo "</ul>";
									}
									  ?> </td>
								
							</tr>
							<?php } ?>
						</tbody>
					</table>
		<?php } ?>
		</div>
	</div>

<?php }else{ ?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>
					Facility  <?= form_dropdown('facility', array(""=>"Choose Facility")+$facilities, $facility,' id="pickFacility" size="1"'); ?>  
					<span id="book4Resident" style="padding-top:15px;display:none;">Resident  <?= form_dropdown('resident', array(""=>"Choose Resident")+$residents, $resident,' id="pickResident" size="1"'); ?></span>
			</label>
		</div>
	</div>
	
	</div>
	
	<div class="col-md-12">
		<div class="form-group">
			<?php if(!empty($facility)) {  ?>
			<table class="table table-bordered table-hover" id="sample-table-1">
						<thead>
							<tr>
								<th class="center"> Time</th>
								<th class="center">Availablity</th>
								<th class="center">Book</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($result as $k => $val){ ?>
							<tr>
								<td class="center"> <?= $val['time'] ?></td>
								<td class="center"><?= match($val['availability'], $this->config->item('yesno')) ?> </td>
								<td class="center">
									<?php
										$t = explode(' - ', $val['time']);
										$startTime = $t[0];
										 $shwBook = 0;
										if(date("H:i") < $startTime && (date("Y-m-d") == $date)){
											$shwBook =1; 
										 }elseif(date("Y-m-d") != $date){  
											$shwBook =1; 
										} 
										
										if($shwBook ==1){ 
											if($val['userBooked'] ==1){
												foreach($val['userInfo'] as $i => $info ){
											?>
										<div style="padding-bottom:10px;"><span style="color:green;">Booked <?= $info['options'] ?></span> <button class="btn btn-red btn-xs" onClick="return confirmCancelBooking(<?= $info['fb_id'] ?>);">Cancel</button></div>
									<?php 
												}
											}	
											if($val['availability'] == "1"){
											 ?>
													<button class="btn btn-blue btn-xs" onClick="return confirmBookFacility(<?= $k ?>);">Book</button>
											<?php   
										}
											}else{
												if($val['userBooked'] ==1){
													echo "BOOKED (EXPIRED)";
													 }
											 } ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
		<?php } ?>
		</div>
	</div>

</div>
<?php } ?>
<div class="pull-right">
	<div class="btn-group">
		<a href="#" class="btn btn-info close-subview-button" id="closeListingCalendar">
			Close
		</a>
	</div>

</div>
						
<script>
	$("#closeListingCalendar").click(function(){
		hideEditEvent();
	});

    $("#pickFacility").change(function(){
	
		var role  = "<?= $this->user->get_memberrole() ?>";
		$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getFacilityBookingByDay/?bookingDate=<?= $date ?>&bookingFacility="+ $( this ).val()+"&resident=" +$("#pickResident").val()  ,  function(result) {
			$("#timeListing").html(result);
			
			if(role != "3"){
				$("#book4Resident").fadeIn();
			}
			
		});
	});
	
	$("#pickResident").change(function(){
	 
		var role  = "<?= $this->user->get_memberrole() ?>";
		$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getFacilityBookingByDay/?bookingDate=<?= $date ?>&bookingFacility="+  $("#pickFacility").val() +"&resident=" +$( this ).val() ,  function(result) {
			$("#timeListing").html(result);
			if(role != "3"){
				$("#book4Resident").fadeIn();
			}
		});
	});
	
	function confirmBookFacility(time){
    	$.confirm({
			'title'		: 'Booking Confirmation',
			'message'	: 'You are about to book this facility. <br />Are you sure want to book?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
						 bookFacility(time); //remove image
						
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Doesn't do anything						
				}
			}
		});				
		return false;
    }
    
    function confirmCancelBooking(fb_id){
    	$.confirm({
			'title'		: 'Cancel Booking Confirmation',
			'message'	: 'You are about to cancel this booking. <br />Are you sure want to cancel?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
						 cancelBooking(fb_id); //remove image
						
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Doesn't do anything						
				}
			}
		});				
		return false;
    }
    
	var cancelBooking = function(fb_id){
		var str = "fb_id="+fb_id;
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/cancelledEvent/",str,  function(result) {
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				showSuccessPopUp();
				setTimeout(function(){location.reload();}, 1500);
			}
		});
	};
	
	var bookFacility  = function(time){
		var resident = $("#pickResident").val();
		var resQuery = "";
		if(resident != ""){
			var resQuery = "&bookingUser="+resident;
		}else{
			alert("Please select resident");
			return false;
		}
		console.log("<?= $this->config->item('domain') ?>/<?= $this->name ?>/checkAvailablity/?dateConvert=1&bookingDate=<?= $date ?>&bookingFacility=<?= isset($facility) ? $facility: '' ?>&bookingTime=" +time + resQuery);
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/checkAvailablity/?dateConvert=1&bookingDate=<?= $date ?>&bookingFacility=<?= isset($facility) ? $facility: '' ?>&bookingTime=" +time + resQuery,  function(result) {
			 
			var obj = $.parseJSON(result);
			if(obj.status =="success"){
				showSuccessPopUp();
				setTimeout(function(){location.reload();}, 1500);
			}else{
				alert(obj.data);
			}
			
		});
		return false;	
	};
</script>