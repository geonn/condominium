<?php
class propertyAdmin_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "propertyAdmin";
		$this->primary_key = 'pa_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById($id){
		$filter = array(
			$this->primary_key => $id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
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
				$result[$k]['pa_id'] 		= $val['pa_id'];
				$result[$k]['property'] = $property['data']['name'];
			}
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByProperty(){
		$filter = array(
			'p_id' => $this->param['p_id']
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function add($u_id){
		$data = array(
			'u_id'                   => $u_id,
			'p_id'                   => $this->param['p_id'],
			'created'             => date('Y-m-d H:i:s'),
			'updated'            => date('Y-m-d H:i:s')
		);
		
		$id = $this->insert($data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $id;	
		return $this->_result;
	}
	
	public function edit(){
		$data = array(
			'p_id'              => $this->param['p_id'],
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['pa_id'], $data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['pa_id'];	
		return $this->_result;
	}
	
	public function remove(){
		$this->delete($this->param['rpa_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
}
?>
