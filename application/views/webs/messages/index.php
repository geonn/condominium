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
						<h1><?= ucwords($this->name) ?> <small>contact admin for any enquiry</small></h1>
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
							<a href="<?= $this->config->item('domain') ?>/main/dashboard">
								Dashboard
							</a>
						</li>
						<li class="active">
							Messages
						</li>
					</ol>
				</div>
			</div>
			<!-- end: BREADCRUMB -->
			<!-- start: PAGE CONTENT -->
			<div class="row">
				<div class="col-md-12">
					<!-- start: INBOX PANEL -->
					<div class="panel panel-white" style="min-height:450px;">
						<div class="panel-heading">
							<h4 class="panel-title">Inbox</h4>
						 
						</div>
						<div class="panel-body messages">
							<ul class="messages-list col-md-4">
							
							<?php 
						 
							$defaultChatroom = !empty($this->param['chatroom']) ? $this->param['chatroom'] : $result['data'][0]['id'];
					 //	 print_pre($result);
							foreach($result['data'] as $k => $val) { 
								$totalMsg = count($val['message']);
								$latestMsg = "";
								if($totalMsg > 0){
									$latestMsg = $val['message'][$totalMsg-1];
								}
								
							?>
								<li class="messages-item" id="messages-item<?= $val['id'] ?>" onClick="getMessageList('<?= $val['id'] ?>')">
									<span class="messages-item-from">
										<?php if($val['isOnline'] == "1"){ ?>
											<i class="fa fa-dot-circle-o text-green"></i>
										<?php }else{ ?>
											<i class="fa fa-dot-circle-o"></i>
										<?php } ?>
										<?= $val['targetName'] ?>
										 </span>
									<div class="messages-item-time">
									
										<span class="text"><?= !empty($latestMsg) ? date_convert($latestMsg['senddate'],'full') :"" ?> </span>
										<?php
											if(!empty($val['notification'])){
										 ?>
										<div class="notifications-count badge badge-default animated bounceIn" id="notification<?= $val['id'] ?>" style="float:right;"><?= $val['notification']['badge'] ?></div>
									<?php } ?>
									</div> 
									
									<span class="messages-item-preview" id="preview<?= $val['id'] ?>" ><?=  !empty($latestMsg) ?  limit_text($latestMsg['message'],'120') : "" ?></span>

								</li>
							<?php } ?>
							</ul>
							<div class="messages-content col-md-8" style="background-color:#FAFAFA;padding:10px;">
								
								<div class="message-content" id="message_container" style="height:300px;overflow-y:scroll;padding:5px;">
									
								</div>
								<div>
									<form id="msgForm" class="form-inline">
										<?= form_hidden('c_id', $defaultChatroom) ?>
										<?= form_hidden('recipient2', $val['target']) ?>
										<textarea class="form-control" id="editor2" name="message" cols="10" rows="3" style="width:80%;"></textarea>
										<button type="button" class="btn btn-primary" onClick="return sendMsg()">Send</button>
									</form>
								</div>
								 
								
							</div>
						</div>
					</div>
					<!-- end: INBOX PANEL -->
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
			getMessageList('<?=$defaultChatroom	?>');
			$("#message_container").scrollTo(document.body.scrollHeight,0);
		});
		
		var getMessageList = function(chatroom){
			var str = "chatroom="+chatroom;
			/**Get chatroom message***/
			$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/getMessageList/", str, function(result) {
			//	console.log(result);
				$("#message_container").html(result);
	    		$("#message_container").scrollTo(document.body.scrollHeight,0);
			});
			return false;
		}
	
		var sendMsg = function(){
			var str = $("#msgForm").serialize();
			var msg = $("#editor2").val();
			if(msg.trim() == ""){
				return false;
			}
			/**Get chatroom message***/
			$.post("<?= $this->config->item('domain') ?>/<?= $this->name ?>/doCreate/", str, function(result) {
				
				$("#editor2").val("");
				getMessageList($("input[name=c_id]").val());
			});
			return false;
		}
</script>
