<?php
class Property_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "property";
		$this->primary_key = 'p_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function get(){
		$filter = array();
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function getById($id){
		$filter = array(
			$this->primary_key => $id
		);
		
		$result = $this->get_data($filter);
		
		foreach($result as $k => $val){
			$photo = $this->images_model->getPhoto($val['p_id'], 1);
			if(!empty($photo)){
				$result[$k]['img_id'] = $photo[0]['img_id'];
				$result[$k]['logo'] = $this->config->item('domain')."/public/".$photo[0]['img_path'];
			}
			
		} 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getList(){
		$filter = array();
		$result = $this->get_data($filter);
		
		$list = array();
		foreach($result as $k => $val){
			$list[$val['p_id']] = $val['name'];
		}
		
		/*** return response***/
		return $list;
	}
	
	public function add(){
		$validation = $this->validate();
		
		if(empty($validation)) {
			$data = array(
				'name'                   => $this->param['name'],
				'address'               => $this->param['address'],
				'contact_no'         => $this->param['contact_no'],
				'fax_no'                 => $this->param['fax_no'],
				'email'                   => $this->param['email'],
				'developer_name'      => $this->param['developer_name'],
				'created'                => date('Y-m-d H:i:s'),
				'updated'              => date('Y-m-d H:i:s')
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
	
	public function edit(){
		$validation = $this->validate();
		
		if(empty($validation)) {
			$data = array(
				'name'                   => $this->param['name'],
				'address'               => $this->param['address'],
				'contact_no'         => $this->param['contact_no'],
				'fax_no'                 => $this->param['fax_no'],
				'email'                   => $this->param['email'],
				'developer_name'      => $this->param['developer_name'],
				'updated'             => date('Y-m-d H:i:s')
			);
			
			$this->update($this->param['p_id'], $data);
			
			/*** return response***/
			$this->_result['status']     = 'success';
			$this->_result['data']       = $this->param['p_id'];	
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
		$this->delete($this->param['p_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode = array();
		$name          = $this->param['name'];
		$contact_no = $this->param['contact_no'];
		
		if(empty($name)){
			$statusCode[] = 120;
		}
		
		if(empty($contact_no)){
			$statusCode[] = 121;
		}
		
		return $statusCode;
	}
}
?>
