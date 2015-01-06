<?php
class Facility_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "facility";
		$this->primary_key = 'f_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function get(){
		$filter = array(
			'p_id' => $this->user->get_memberproperty()
		);
		$result = $this->get_data($filter,'','','updated','DESC');
		
		foreach($result as $k => $val){
			$options = $this->facilityOptions_model->getChildById($val['f_id']);
			$result[$k]['totalOptions'] = count($options['data']);
		}
 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function getFacilityList(){
		$filter = array(
			'status' => 1
		);
		$res = $this->get_data($filter);
		$list = array();
		foreach($res as $k => $val){
			$list[$val['f_id']] = $val['name'];
		}
		
		return $list;
	}
	
	public function getFacilityListByProperty(){
		
		$filter = array(
			'status' => 1,
			'p_id' => $this->user->get_memberproperty()
		);

		$res = $this->get_data($filter);
		$list = array();
		foreach($res as $k => $val){
			$list[$val['f_id']] = $val['name'];
		}
		
		return $list;
	}
	
	public function getById($f_id=""){
		
		if(empty($f_id)){
			$f_id = $this->param['f_id'];
		}
		
		$filter = array(
			$this->primary_key => $f_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByProperty($p_id){
		
		$filter = array(
			'p_id' => $p_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function add(){
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'name'           => $this->param['name'],
				'description' => $this->param['description'],
				'p_id'             => $this->user->get_memberproperty(),
				'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
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
	
	public function edit(){
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'name'           => $this->param['name'],
				'description' => $this->param['description'],
				'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
				'updated'      => date('Y-m-d H:i:s')
			);
			
			$this->update($this->param['f_id'], $data);
			 
			/*** return response***/
			$this->_result['status']     = 'success';
			$this->_result['data']       = $this->param['f_id'];	
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
		$name        = $this->param['name'];
		
		if(empty($name)){
			$statusCode[] = 122;
		}
		
		return $statusCode;
	}
	
	public function delete(){
		$data = array(
			'status'          => 3,
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['f_id'], $data);
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['f_id'];	
		return $this->_result;
	}
}
?>
