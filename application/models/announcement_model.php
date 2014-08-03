<?php
class Announcement_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "announcement";
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
	
	public function add(){
		
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'title'              => $this->param['title'],
				'content'       => $this->param['content'],
				'u_id'             => $this->param['u_id'],
				'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
				'created'       => date('Y-m-d H:i:s'),
				'updated'      => date('Y-m-d H:i:s')
			);
			
			$id = $this->insert($data);
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
		
		/*** return response***/
		return $this->_result;
	}
	
	public function edit(){
		$data = array(
			'title'              => $this->param['title'],
			'content'       => $this->param['content'],
			'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['f_id'], $data);
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['f_id'];	
		return $this->_result;
	}
	
	public function remove(){
		$this->delete($this->param['id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode = array();
		$title        = $this->param['title'];
		$content = $this->param['content'];
		
		if(empty($title)){
			$statusCode[] = 130;
		}
		
		if(empty($content)){
			$statusCode[] = 131;
		}
		
		return $statusCode;
	}
	
}
?>
