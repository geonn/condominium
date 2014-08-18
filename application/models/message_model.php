<?php
class Message_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table            = "message";
		$this->primary_key = 'msg_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById(){
		$filter = array(
			$this->primary_key => $this->param['id']
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByChatroom($chatroom_id){
		$filter = array(
				'c_id' => $chatroom_id
			);
			
		$result = $this->get_data($filter);
	
		if(!empty($result)){
			foreach($result as $k => $val){
				$users1 = $this->users_model->getById($val['recipient']);
				$result[$k]['recipientName'] = $users1['data']['firstname']." ".$users1['data']['lastname'];
				$chatroom = $this->chatroom_model->getById($val['c_id']);
				$result[$k]['chatroom'] = $chatroom['data'];
			}
		}
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}

	public function getLastMessage($chatroom=array()){
		/*** return error if empty chatroom***/
		if(empty($chatroom)){
			$this->_result['status']     = 'error';
			$this->_result['data']       = 'No Chatroom available';	
			return $this->_result;
		}
		
		foreach($chatroom as $k => $val){
			$filter = array(
				'c_id' => $val['id']
			);
			
			$chatroom[$k]['message'] = $this->get_data($filter,1,0,$this->primary_key,'DESC');
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $chatroom;	
		return $this->_result;
	}
	
	public function add($c_id){
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'c_id'  			=> $c_id,
				'recipient'   => $this->param['recipient'],
				'message'     => $this->param['message'],
				'senddate'       => date('Y-m-d H:i:s')
			);
			
			$id = $this->insert($data);
			
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
	private function validate(){
		$statusCode = array();
		$recipient        = $this->param['recipient'];
		$message          = $this->param['message'];
		if(empty($recipient)){
			$statusCode[] = 127;
		}
		
		return $statusCode;
	}
}
?>
