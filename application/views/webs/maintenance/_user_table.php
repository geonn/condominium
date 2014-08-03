<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Property</th>
		
			<th class="hidden-xs">Last Payment</th>
			<th>Action </th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if(!empty($result['data'])){ ?>	
		<tr>
			<td><?= $result['data']['firstname'] . " " .$result['data']['lastname'] ?></td>
			<td><?= $result['data']['username'] ?></td>
			<td><?= $result['data']['residental']['property'] ?></td>
			
			<td class="hidden-xs"><?php
					if(!empty($result['data']['maintenance'])){
						 echo date_convert($result['data']['maintenance']['duration'], 'shorten');
					 }else{
					 	echo 'No payment yet';
					 } ?></td>
			<td>
				<a class="btn btn-purple" href="javascript:void(0);" onclick="showMaintenanceForm('<?= $result['data']['firstname'] . " " .$result['data']['lastname'] ?>')">
					ADD <i class="fa fa-plus"></i>
				</a>
			</td>
		</tr>
	<?php } else{ ?>
				<tr><td colspan="5" style="text-align:center;">No records found.</td></tr>
	<?php }   ?>
	</tbody>
</table>

