<?php
class Chatroom_Model extends APP_Model{
	public $_result = array();
	public $list        = array();
	function __construct() {
		$this->_table      = "chatroom";
		$this->primary_key = 'id';	
		
		$this->list                          = array();
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById(){
		$filter = array(
			$this->primary_key => $this->param['id']
		);
		
		$result = $this->get_data($filter);
		
		if(!empty($result)){
			foreach($result as $k => $val){
				$this->list['chatroomInfo'] = $val;
				$this->list['chatroomMsg'] = $this->message_model->getByChatroom($val['id']);
			}
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->list;	
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
	
	public function add(){
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'recipient1'   => $this->param['recipient1'],
				'recipient2'   => $this->param['recipient2'],
				'created'       => date('Y-m-d H:i:s'),
				'updated'      => date('Y-m-d H:i:s')
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
		$recipient1        = $this->param['recipient1'];
		$recipient2        = $this->param['recipient2'];
		
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
