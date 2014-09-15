<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>
					<?= form_dropdown('facility', array(""=>"Choose Facility")+$facilities, $facility,' id="pickFacility" size="1"'); ?> 
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
								<td class="center"><button class="btn btn-blue btn-xs" onClick="return bookFacility(<?= $k ?>);">Book</button></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
		<?php } ?>
		</div>
	</div>

</div>
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
		var queryParam   = "?date=<?= $date ?>&facility="+ $( this ).val() ;
		$.get("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getFacilityBookingByDay/?bookingDate=<?= $date ?>&bookingFacility="+ $( this ).val() ,  function(result) {
			$("#timeListing").html(result);
		});
	});
	
	var bookFacility  = function(time){
	
		$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/checkAvailablity/?dateConvert=1&bookingDate=<?= $date ?>&bookingFacility=<?= $facility ?>&bookingTime=" +time ,  function(result) {
			showSuccessPopUp();
			setTimeout(function(){window.location.href="../<?= $this->name ?>/booking";}, 2000);
		});
	 
		return false;	
	}
</script>