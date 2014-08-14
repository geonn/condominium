<?php 
$me = $this->user->get_memberid();
 $preview = "No conversation yet";
 $lastRecipient = ""; 
 $msgDate = ""; 
 if(!empty($result['data'] )){
foreach($result['data'] as $k => $val){ 
	$preview = limit_text($val['message']);
	$preview = trim(preg_replace('/\s\s+/', ' ', $preview));
	
	if($val['recipient'] == $me){
	 
?>
	<!--USER MESSAGE-->
	<div style="text-align:right;">
		
		<?php  
			$m_date = substr($val['senddate'],0,10);
		 
			if($msgDate != $m_date ){
				echo ' <button type="button" class="btn btn-blue btn-xs" style="display:block;margin:0 auto;">'.$m_date.' </button>';
			}
		?>
		
		<?php if($lastRecipient !=  $val['recipient'] || $msgDate != $m_date) { ?>
		<span class="messages-item-from"  style="color:#3162DC"> 
			<?= $val['recipientName'] ?> ~ 
			<?php  
				$f_date = date_convert($val['senddate'],'full') ;
				$d = explode(' ',$f_date);
				echo $d[1];
			?>   
		</span>
		<span >
 
		<?php } ?>
			<p style="text-align:right; "><?= nl2br($val['message']) ?> </p>
		</span>
<?php }else{ ?>
	<!--OPPONENTS REPLIED-->
	<div>
		<?php  
			$m_date = substr($val['senddate'],0,10);
		 
			if($msgDate != $m_date ){
				echo ' <button type="button" class="btn btn-blue btn-xs" style="display:block;margin:0 auto;">'.$m_date.' </button>';
			}
		?>
		<?php if($lastRecipient !=  $val['recipient'] || $msgDate != $m_date) { ?>
			<span class="messages-item-from"  style="color:#21891D">
				<?= $val['recipientName'] ?>  ~
				<?php  
				$f_date = date_convert($val['senddate'],'full') ;
				$d = explode(' ',$f_date);
				echo $d[1];
			?>   
			</span>
			<div>
		<?php } ?>
			<p style="width:80%;"><?= nl2br($val['message']) ?> </p>
		</div>
<?php } ?>	
		
	</div>
	
<?php 
		$msgDate= $m_date;
		$lastRecipient = $val['recipient'];
	} 
}else{ ?>
	<div><?=  $preview ?></div>
<?php } ?>

<script>
	
	var myVar;
	stopRefreshList();
	function refreshList() {
	    myVar = setTimeout(function(){
	    	
			var str = "chatroom=<?= $result['data'][0]['c_id'] ?>";
			/**Get chatroom message***/
			$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getMessageList/", str, function(result) {
				$("#message_container").html(result);
			});
		
	    	}, 3000);
	}

	function stopRefreshList() {
	    clearTimeout(myVar);
	}
	getUnreadBullet();
	refreshList();
	$("#notification<?= $result['data'][0]['c_id'] ?>").fadeOut();
	$("#preview<?= $result['data'][0]['c_id'] ?>").html("<?=  strip_tags($preview) ?>");
	$("input[name=c_id]").val("<?= $result['data'][0]['c_id'] ?>");
	$("input[name=recipient2]").val("<?= $result['data'][0]['chatroom']['target'] ?>");
	$(".messages-item").removeClass("active");
	$("#messages-item<?= $result['data'][0]['c_id'] ?>").addClass("active");
</script>