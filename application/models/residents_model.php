<?php
class Residents_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "residents";
		$this->primary_key = 'r_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById($rid = ""){
		$rid = !empty($rid) ? $rid : $this->param['r_id'];
		$filter = array(
			$this->primary_key => $rid
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByUnitLots(){
		$filter = array(
			'p_id'		 => $this->param['p_id'],
			'unitLots' => $this->param['unitLots']
		);
		
		$result = $this->get_data($filter);
		$return = array();
		if(!empty($result)){
			$return = $result[0];
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
		
	}
	
	public function getByUser($u_id){
		$filter = array(
			'u_id' => $u_id
		);
		
		$result = $this->get_data($filter);
		
		if(!empty($result)){
			foreach($result as $k => $val){
				$property = $this->property_model->getById($val['p_id']);
				$result[$k]['r_id'] 		= $val['r_id'];
				$result[$k]['property'] = $property['data']['name'];
				$result[$k]['unitLots']  = $val['unitLots'];
				$result[$k]['residentType']  = match($val['type'], $this->config->item('resident_type'));
			}
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByProperty($pid = ''){
		$pid = !empty($pid) ? $pid : $this->param['p_id'];
		$filter = array(
			'p_id' => $pid
		);
		
		$result = $this->get_data($filter);
		$return = array();
		
		foreach($result as $k => $val){
			$return[$val['r_id']]['u_id'] = $val['u_id'];
			$return[$val['r_id']]['unitLots'] = $val['unitLots'];
		}
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function add($u_id){
		$validation = $this->validate();
		$p_id = $this->param['p_id'];
		
		if(empty($validation)) {
			$data = array(
				'u_id'                   => $u_id,
				'p_id'                   => $p_id,
				'unitLots'            => $this->param['unitLots'],
				'type'                  => !empty($this->param['residentType']) ? $this->param['residentType'] : 1,
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
	
	public function edit($u_id){
		$validation = $this->validate();
		$result        = $this->getByUser($u_id);
		if(empty($validation)) {
			$data = array(
				'p_id'                     => $this->param['p_id'],
				'unitLots'              => $this->param['unitLots'],
				'type'                    => !empty($this->param['residentType']) ? $this->param['residentType'] : 1,
				'updated'             => date('Y-m-d H:i:s')
			);
			
			$this->update($result['data']['r_id'], $data);
			
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
		$this->delete($this->param['r_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode = array();
		$unitLots        = $this->param['unitLots'];
		
		if(empty($unitLots)){
			$statusCode[] = 124;
		}
		
		return $statusCode;
	}
}
?>
