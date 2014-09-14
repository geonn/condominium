 
	<?php 
	if(!empty($result['data'])){
	foreach($result['data'] as $k => $val){ ?>	
		<tr>
			 
			<td><?= $val['name'] ?></td>
			<td><?= $val['unitLots'] ?></td>
			<td><?=   date_convert($val['duration'], 'shorten') ?></td>
			<td class="hidden-xs"><?= $val['type'] ?></td>
			<td class="hidden-xs"><?= $val['paymentType'] ?></td>
			<td class="hidden-xs"><?= $val['totalAmount'] ?></td>
			<td><?php 
				if(empty($val['payment'])){
					echo $val['totalAmount'];
				}else{
					echo number_format($val['payment']['balance'],2);
				}
				 ?></td>
			<td class="hidden-xs"><?=   date_convert($val['created'], 'full') ?></td>
			<td>
				<?php 
				if(empty($val['payment']) || $val['payment']['balance'] !== "0"){
					echo '<button type="button" class="btn btn-blue btn-xs" href="'. $this->config->item('domain').'/'.$this->name .'/edit/'.$val['m_id'].'" >Pay Now</button>';
				} 
				 ?>
				 </td>
		</tr>
	<?php
	}
	 } else{ ?>
		<tr><td colspan="8" style="text-align:center;">No records found.</td></tr>
<?php } ?>
