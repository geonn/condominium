<?php
class User_payment_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "user_payment";
		$this->primary_key = 'id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function get(){
		/** Check user type**/
		$role = $this->user->get_memberrole();
		
		if($role == 3){
			/** Normal user query**/
			$u_id	 = $this->user->get_memberid();
		 
			$filter = array(
				'u_id' => $u_id
			);
		}else{
			/** for admin: Get property that admin in-charged**/
			$p_id	 = $this->user->get_memberproperty();
			$resident = $this->residents_model->getByProperty($p_id);
			$res=  array();
			foreach($resident ['data'] as $k => $val){
				$res[] = $k;
			}
			$r_id = implode(',' , $res);
			$filter = "";
			if(!empty($r_id)){
				$filter =  "r_id IN (".$r_id.")";
			}else{
				/** to avoid get any records from query**/
				$filter =  "type =999";
			}
		}
	 
		$result = $this->get_data($filter,'','',$this->primary_key,'DESC'); 
	 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
		
	}
	
	public function getById($id){
		$filter = array(
			'id' => $id
		);
		$result = $this->get_data($filter);
		
		
		foreach($result as $k => $val){
			$user = $this->users_model->getById($val['u_id']);
 
			$result[$k]['u_id'] 			  = $user['data']['u_id'];
			$result[$k]['name'] 			= $user['data']['firstname'];
			$result[$k]['residental']     = $user['data']['residental'];
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		
		if(empty($result)){
			$this->_result['status']     = 'error';
			$this->_result['error_code']  = 100;
			$this->_result['data']       = array();
		}else{
			$this->_result['data']       = $result[0];	
		}
		
		return $this->_result;
	}
	
	public function add($amount, $u_id){
		$data = array(
			'u_id'                   => $u_id,
			'amount'              => $amount,
			'created'               => date('Y-m-d H:i:s'),
			'updated'             => date('Y-m-d H:i:s')
		);
		
		$id = $this->insert($data);
		
		return $id;
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
		$m_id        = $this->param['m_id'];
		$paidAmount = $this->param['paid'];
		
		
		if(empty($m_id)){
			$m_id[] = 139;
		}
		
		if(empty($paidAmount)){
			$statusCode[] = 140;
		}
		
		return $statusCode;
	}
	
}
?>
