<?php
class Payment_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "payment";
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
			$res = $this->residents_model->getByUser($u_id);
		 	
		 	/**Convert array standard**/
		 	$resident['data'][$res['data']['r_id']]['u_id'] = $res['data']['u_id'];
		 	$resident['data'][$res['data']['r_id']]['unitLots'] = $res['data']['unitLots'];
		 	
			$filter = array(
				'r_id' => $res['data']['r_id']
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
	 
		$return = array();
	 
		if(!empty($result)){
			foreach($result as $r => $ret){
				$return[$r] = $ret;
				$return[$r]['type']     			  = match($ret['type'], $this->config->item('maintenance_type'));
				$return[$r]['paymentType']   = match($ret['paymentType'], $this->config->item('payment_type'));
				$return[$r]['unitLots'] 			= $resident['data'][$ret['r_id']]['unitLots'];
				
				/**get user info**/
				$user = $this->users_model->getById($resident['data'][$ret['r_id']]['u_id']);
				$return[$r]['name'] 			= $user['data']['firstname'];
			}
		}
	 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
		
	}
	
	public function getByMid($m_id){
		$filter = array(
			'm_id' => $m_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		
		if(empty($result)){
			$this->_result['data']       = array();
		}else{
			$this->_result['data']       = $result[0];	
		}
		
		return $this->_result;
	}
	
	public function add(){
		$validation = $this->validate();
		
		$filter = array('m_id' => $this->param['m_id']);
		$res    = $this->get_data($filter);
		
		if(empty($validation)) { 
			$maintenance = $this->maintenance_model->getById();
			$total = $maintenance['data']['totalAmount'];
			
			if(!empty($res)){
				$balance = $total - ($this->param['paid'] + $res[0]['paid']);
				$data = array(
					'paid'      			  => $this->param['paid'] + $res[0]['paid'],
					'balance'              => $balance,
					'updated'             => date('Y-m-d H:i:s')
				);
				
				$this->update($res[0]['id'], $data);
			}else{
				$balance = $total - $this->param['paid'];
				
				$data = array(
					'm_id'                   => $this->param['m_id'],
					'paid'      			  => $this->param['paid'],
					'balance'              => $balance,
					'created'               => date('Y-m-d H:i:s'),
					'updated'             => date('Y-m-d H:i:s')
				);
				
				$id = $this->insert($data);
			}
			
			/*** return response***/
			$this->_result['status']     = 'success';
			
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
	
	public function clearOff(){
		$filter = array('m_id' => $this->param['m_id']);
		$res    = $this->get_data($filter);
		
		$maintenance = $this->maintenance_model->getById();
		
		if(!empty($res)) { 
			$data = array(
					'paid'      			  => $maintenance['data']['totalAmount'],
					'balance'              => 0,
					'updated'             => date('Y-m-d H:i:s')
				);
			
			$this->update($res[0]['id'], $data);
			
			/*** return response***/
			$this->_result['status']     = 'success'; 
		}else{
			
				$data = array(
					'm_id'                   => $this->param['m_id'],
					'paid'      			  => $maintenance['data']['totalAmount'],
					'balance'              => 0,
					'created'               => date('Y-m-d H:i:s'),
					'updated'             => date('Y-m-d H:i:s')
				);
				
				$id = $this->insert($data);
				
			/*** return response***/
			$this->_result['status']     = 'success';
		}
		return $this->_result;
	}
	
	public function remove(){
		$this->delete($this->param['m_id']);
		
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
