<?php
class FacilityOptions_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "facilityOptions";
		$this->primary_key = 'fo_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById($fo_id){
		$filter = array(
			'fo_id' => $fo_id
		);
		$result = $this->get_data($filter);
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getChildById($f_id, $activeOnly=""){
		if(!empty($activeOnly)){
			$filter = array(
				'f_id' => $f_id,
				'status' => 1
			);
		}else{
			$filter = array(
				'f_id' => $f_id
			);
		}
		
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
				'f_id'              => $this->param['f_id'],
				'option'         => $this->param['option'],
				'status'          => !empty($this->param['optionStatus']) ? $this->param['optionStatus'] : 1,
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
		if(isset($this->param['option'])){
			$data = array(
				'option'         => $this->param['option'], 
				'updated'      => date('Y-m-d H:i:s')
			);
		}elseif(isset($this->param['status'])){
			$data = array( 
				'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
				'updated'      => date('Y-m-d H:i:s')
			);
		}
		
		$this->update($this->param['fo_id'], $data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['fo_id'];	
		return $this->_result;
	}
	

	
	public function remove(){
		$this->delete($this->param['fo_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}

	/*** Do checking before send to database***/
	private function validate(){
		$statusCode = array();
		$option        = $this->param['option'];
		
		if(empty($option)){
			$statusCode[] = 123;
		}
		
		return $statusCode;
	}	
}
?>
