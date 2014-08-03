<?php
class FacilityBooking_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "facilitiesBooking";
		$this->primary_key = 'fb_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById(){
		$filter = array(
			$this->primary_key => $this->param['fb_id']
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByUser($u_id){
		$filter = array(
			'u_id'  => $u_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}

	public function getByFacility($f_id){
		$filter = array(
			'f_id'  => $f_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function add(){
		$data = array(
			'f_id'              => $this->param['f_id'],
			'fo_id'            => $this->param['fo_id'],
			'u_id'             => $this->param['u_id'],
			'bookDate'   => $this->param['bookDate'],
			'bookTime'  => $this->param['bookTime'],
			'remark'       => $this->param['remark'],
			'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
			'created'       => date('Y-m-d H:i:s'),
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$id = $this->insert($data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $id;	
		return $this->_result;
	}
	
	public function edit(){
		$data = array(
			'bookDate'   => $this->param['bookDate'],
			'bookTime'  => $this->param['bookTime'],
			'remark'       => $this->param['remark'],
			'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['fb_id'], $data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['fb_id'];	
		return $this->_result;
	}
	
	public function remove(){
		$this->delete($this->param['fb_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode     = array();
		$bookDate       = $this->param['bookDate'];
		$bookTime       = $this->param['bookTime'];
		
		if(empty($bookDate)){
			$statusCode[] = 125;
		}
		
		if(empty($bookTime)){
			$statusCode[] = 126;
		}
		
		return $statusCode;
	}
}
?>
