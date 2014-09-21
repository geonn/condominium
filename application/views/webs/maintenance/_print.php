<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>

<?=  $this->load->view('/layouts/_web_includes'); ?>
<style>
	body{background-color:#ffffff; }
	div{margin:0; padding:0;font-weight:bold; }
	#id{left: 160px; top:79px;}
	#s_name{left: 80px; top: 103px;}
	#s_address{left:80px; top:123px;text-align:left;}
	#s_city{left:80px; top:203px;}
	#s_state{left: 250px; top:203px;}
	#s_postcode{left:80px; top: 223px;}
	#s_email{left:80px; top: 243px;}

	#c_name{left:540px; top:170px;}
	#c_amount{left:660px; top:170px;}
	
	#r_name{left: 80px; top: 307px;}
	#r_address{left:80px; top:327px;text-align:left;}
	#r_city{left:80px; top:421px;}
	#r_state{left: 250px; top:421px;}
	#r_postcode{left:80px; top: 441px;}
	#r_email{left:80px; top: 461px;}
	
	
/** GREEN BUTTON **/
.green_button {
	
	padding: 6px 10px;
	color: #fff;
	font-size: 14px;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#a4d04a), to(#459300));
	text-shadow: #050505 0 -1px 0;
	background-color: #459300;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	border-radius: 4px;
	border: solid 1px transparent;
	font-weight: bold;
	cursor: pointer;
	letter-spacing: 1px;
}

.green_button:hover {
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#a4d04a), to(#a4d04a), color-stop(80%, #76b226));
	text-shadow: #050505 0 -1px 2px;
	background-color: #a4d04a;
	color: #fff;
}

/** RED BUTTON **/
.red_button {
	
	padding: 6px 10px;
	color: #fff;
	font-size: 14px;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FE2E64), to(#B40431));
	text-shadow: #050505 0 -1px 0;
	background-color: #B40431;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	border-radius: 4px;
	border: solid 1px transparent;
	font-weight: bold;
	cursor: pointer;
	letter-spacing: 1px;
}

.red_button:hover {
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FE2E64), to(#B40431), color-stop(80%, #DF0101));
	text-shadow: #050505 0 -1px 2px;
	background-color: #FE2E64;
	color: #fff;
}
</style>
</head>
<body>
	<br/><br/>
	<div style="float:right;width:20%;" class="utility">
	<input type=button  class="green_button" name=print value="Print" onClick="return printCourier()">
	<input type=button  class="red_button" name=close value="Close" onClick="closePrint();">
</div>
<br/>
<div style="padding-top:15px;padding-bottom:15px;width:95%;margin:0 auto;clear:both;">
	<table class="table table-striped table-bordered table-hover table-full-width" id="maintenanceTable">
		<thead>
			<tr>
				 
				<th>Ownder Name</th>
				<th>Unit Lots</th>
				<th>Payment For</th>
				<th> Maintenance Type</th>
				<th>Total Amount</th>
				<th >Balance</th>
				<th>Transaction Date</th>
				
			</tr>
		</thead>
		<tbody>
			 <?php 
				if(!empty($result['data'])){
				foreach($result['data'] as $k => $val){ ?>	
					<tr>
						 
						<td><?= $val['name'] ?></td>
						<td><?= $val['unitLots'] ?></td>
						<td><?=   date_convert($val['duration'], 'shorten') ?></td>
						<td><?= $val['type'] ?></td>
						<td  style="text-align:right;"><?= number_format($val['totalAmount'],2) ?></td>
						<td style="text-align:right;"><?php 
							if(empty($val['payment'])){
								echo "<span style='color:#FF0000;font-weight:bold;'>".number_format($val['totalAmount'],2)."</span>";
							}else{
								
								if(number_format($val['payment']['balance'],2) == "0.00"){
									echo "<span style='color:green;font-weight:bold;'>PAID</span>";
								}else{
									echo "<span style='color:#FF0000;font-weight:bold;'>".number_format($val['payment']['balance'],2)."</span>";
								}
							}
							 ?></td>
						<td><?=   date_convert($val['created'], 'full') ?></td>
						
					</tr>
				<?php
				}
				 } else{ ?>
					<tr><td colspan="9" style="text-align:center;">No records found.</td></tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<body>
</body>
</html>
<div style="float:right;width:20%;" class="utility">
	<input type=button  class="green_button" name=print value="Print" onClick="return printCourier()">
	<input type=button  class="red_button" name=close value="Close" onClick="closePrint();">
</div>
<script type="text/javascript" >	
	function printCourier(){
		$(".utility").hide();
		setTimeout(function(){
			$(".utility").show();
		},100);
		window.print();	
	
		return false;
	}
	
	function closePrint(){
			this.close();
	}

</script>
