<?php
class Message_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table            = "message";
		$this->primary_key = 'id';	
		
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
	
	public function getByChatroom($c_id){
		$filter = array(
			'c_id' => $c_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function add($c_id){
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'c_id'  			=> $c_id,
				'recipient1'   => $this->param['recipient1'],
				'recipient2'   => $this->param['recipient2'],
				'message'     => $this->param['message'],
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
		$message          = $this->param['message'];
		if(empty($recipient1)){
			$statusCode[] = 127;
		}
		
		if(empty($recipient2)){
			$statusCode[] = 128;
		}
		
		if(empty($recipient2)){
			$statusCode[] = 136;
		}
		
		return $statusCode;
	}
}
?>
