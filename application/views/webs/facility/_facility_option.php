
<script src="<?= $this->config->item('domain') ?>/public/plugins/x-editable/demo-mock.js"></script>
<script src="<?= $this->config->item('domain') ?>/public/plugins/x-editable/demo.js"></script>
<style>
	.popover-content {
		padding: 9px 25px;	
	}
</style>
 
	<table id="user" class="table table-bordered table-striped" style="width:65%;margin-top:20px;">
	<tbody>
		<?php  
	foreach($result['data'] as $k => $val){ ?>
		<tr>
			<td>
				<a href="#" id="<?= $val['fo_id'] ?>" class="facilitiesOptions" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="Facility Option" >
					<?= $val['option'] ?>
				</a>
			</td>
			<td class="column-left" style="width:30%;">
				<a href="#" id="<?= $val['fo_id'] ?>" class="optionStatus" data-type="select" data-pk="1" data-value="<?= $val['status'] ?>" data-source="<?= $this->config->item('domain') ?>/<?= $this->name ?>/getFacilityOptionStatus"   data-original-title="Facility Option Status">
					<?= match($val['status'], $this->config->item('facilities_status')) ?>
				</a>
			</td>
		</tr>
<?php	} ?>
	</tbody>
</table> 
