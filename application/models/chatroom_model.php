<?php
class Chatroom_Model extends APP_Model{
	public $_result = array();
	public $list        = array();
	function __construct() {
		$this->_table      = "chatroom";
		$this->primary_key = 'id';	
		
	 
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getByChatroom($id){
		$recipient = $this->user->get_memberid();
		
		$filter = array(
			$this->primary_key => $id
		);
		
		$result = $this->get_data($filter);
		foreach($result as $k => $val){
			$list = explode(',', $val['recipient']);
			if(in_array($recipient, $list)){
				
				foreach($list as $rec){
						if($recipient != $rec){
							$users = $this->users_model->getById($rec);
							$result[$k]['target'] = $rec;
							$result[$k]['targetName'] = $users['data']['firstname']." ".$users['data']['lastname'];
						} 
						
				}
			}
		}
		
	
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getById($id){
		$recipient = $this->user->get_memberid();
		
		$filter = array(
			$this->primary_key => $id
		);
		
		$result = $this->get_data($filter);
		$return = array();
		if(!empty($result)){
			foreach($result as $k => $val){
				$return = $val;
				
				$list = explode(',', $val['recipient']);
				if(in_array($recipient, $list)){
					foreach($list as $rec){
						if($recipient != $rec){
							$users = $this->users_model->getById($rec);
							$return['target'] = $rec;
							$return['targetName'] = $users['data']['firstname']." ".$users['data']['lastname'];
						} 
						
					}
				}
			} 
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function getByUser(){
		$recipient = $this->user->get_memberid();
		
		$filter = "recipient LIKE ('%".$recipient. "%')";
		
		$result = $this->get_data($filter,'','','updated','DESC');
		$return = array();
		$count = 0;
		$noti = $this->messageNotification_model->getByUser();
		foreach($result as $k => $val){
			$list = explode(',', $val['recipient']);
			if(in_array($recipient, $list)){
				$return[$count] = $val;
				$return[$count]['notification'] = array();
				if(isset($noti['data'][$val['id']])){
					$return[$count]['notification'] = $noti['data'][$val['id']];
				} 
				foreach($list as $rec){
					if($recipient != $rec){
						$users = $this->users_model->getById($rec);
						$return[$count]['isOnline'] = $users['data']['onlineStatus'];
						$return[$count]['target'] = $rec;
						$return[$count]['targetName'] = $users['data']['firstname']." ".$users['data']['lastname'];
					}
				}
				$count++;
			}
		} 
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function getChatroomList(){
	//	$this->message_model->getByChatroom();
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function setupChatroom(){
		$user = $this->users_model->getById($this->user->get_memberid());
		$adminList = $this->users_model->getAdminList();

		foreach($adminList['data']  as $k => $admin){
			if($admin['type'] == 2){
				$propertyAdmin = $this->propertyAdmin_model->getByProperty($user['data']['residental']['p_id']);
				if(empty($propertyAdmin['data'])){
					unset($adminList['data'][$k]);
				}
			}else{
			
				$this->add($this->user->get_memberid(), $admin['u_id'],1 );
			}
		}
		 
	}
	
	public function add($r1 ="", $r2="", $isReg=""){
			 
		$r1 = !empty($r1) ? $r1 : $this->param['recipient1'];
		$r2 = !empty($r2) ? $r2 : $this->param['recipient2'];
		$validation = $this->validate($r1,$r2);
		
		if(empty($validation)) { 
			$re_list = array($r1,$r2 );
			asort($re_list);
			$recipient = implode(',',$re_list);
			
			$filter = array('recipient' => $recipient);
			
			$result= $this->get_data($filter);
			
			if(empty($result)){
				$data = array(
					'recipient'   => $recipient,
					'created'       => date('Y-m-d H:i:s'),
					'updated'      => date('Y-m-d H:i:s')
				);
				
				$id = $this->insert($data);
			}else{
				$data = array(
					'updated'      => date('Y-m-d H:i:s')
				);
				$this->update($result[0]['id'],$data);
				$id = $result[0]['id'];
			}
			
			//add unread status to targeted recipient
			if(empty($isReg)){
				$this->messageNotification_model->add($id, $r2 );
			}
			
			/*** return response***/
			$this->_result['status']     = 'success';
			$this->_result['data']       = $id;	
		}else{
			/***Set Error Message***/
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $validation;
			foreach($validation as $k => $val){
				$this->_result['data']['error_msg'][$k] = $this->code[$val];
			}
		}
		
		return $this->_result;
	}
	
	public function remove(){
		$this->delete($this->param['f_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate($r1,$r2){
		$statusCode = array();
		$recipient1        = $r1;
		$recipient2        = $r2;
		
		if(empty($recipient1)){
			$statusCode[] = 127;
		}
		
		if(empty($recipient2)){
			$statusCode[] = 128;
		}
		
		return $statusCode;
	}
}
?>
