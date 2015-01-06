<?php
class Maintenance_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "maintenance";
		$this->primary_key = 'm_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function get(){
		/** Check user type**/
		$role = $this->user->get_memberrole();
		$category = !empty($this->param['category']) ? $this->param['category'] : "";
		$paid = !empty($this->param['paid']) ? $this->param['paid'] : "";
		
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
			
			if(!empty($category)){
				$cate = array('type' => $category);
				$filter = $filter + $cate;
			}
			
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
			if(!empty($category)){
				$filter = "(type=".$category .") AND ";
			}
		
			if(!empty($r_id)){
				$filter .=  "r_id IN (".$r_id.")";
			}else{
				/** to avoid get any records from query**/
				$filter .=  "type =999";
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
				$return[$r]['name'] 			  = $user['data']['firstname'];
				
				/**get payment info**/
				$payment              				  = $this->payment_model->getByMid($ret['m_id']);
				$return[$r]['payment']		 = $payment['data'];
				
				$bal = !empty($payment['data']['balance']) ? $payment['data']['balance']  : "";
				
				if(!empty($paid)){
		 			if($paid == "1"){
		 				if( $bal != "0.00"){
		 					unset($return[$r]);
		 				}
		 			}else{
						if( $bal == "0.00"){
		 					unset($return[$r]);
		 				}
					}
				}
				
			}
		}
	
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
		
	}
	
	public function getById(){
		$filter = array(
			$this->primary_key => $this->param['m_id']
		);
		
		$result = $this->get_data($filter);
		foreach($result as $r => $ret){
				$return[$r] = $ret;
				$return[$r]['type']     			  = match($ret['type'], $this->config->item('maintenance_type'));
				$return[$r]['paymentType']   = match($ret['paymentType'], $this->config->item('payment_type'));
				$resident                                   = $this->residents_model->getById($ret['r_id']); 
				$return[$r]['unitLots'] 			= $resident['data']['unitLots'];
				$return[$r]['p_id'] 			    	= $resident['data']['p_id'];
				/**get payment info**/
				$payment              				  = $this->payment_model->getByMid($ret['m_id']);
				$return[$r]['payment']		 = $payment['data'];
				/**get user info**/
				$user = $this->users_model->getById($resident['data']['u_id']);
				$return[$r]['u_id'] 			  = $resident['data']['u_id'];
				$return[$r]['name'] 			= $user['data']['firstname'];
		}
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return[0];	
		return $this->_result;
	}
	
	public function getByResident(){
		$limit = !empty( $this->param['limit']) ?  $this->param['limit'] : '';
		$filter = array(
			'r_id' => $this->param['r_id']
		);
		
		$result = $this->get_data($filter,$limit,0 ,$this->primary_key,'DESC');

		foreach($result as $r => $ret){
				$return[$r] = $ret;
				/**get payment info**/
				$payment              		 = $this->payment_model->getByMid($ret['m_id']);
				$return[$r]['payment']		 = $payment['data'];
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function getMaintenanceByResident(){
		$limit = !empty( $this->param['limit']) ?  $this->param['limit'] : '';
		$filter = array(
			'r_id' => $this->param['r_id']
		);
		
		$result = $this->get_data($filter,$limit,0 ,$this->primary_key,'DESC');

		foreach($result as $r => $ret){
				$return[$r] = $ret;
				/**get payment info**/
				$payment              		 = $this->payment_model->getByMid($ret['m_id']);
				 
				if(isset($payment['data']['balance'] )){
					if($payment['data']['balance'] > 0){
						$return[$r]['payment']		 = $payment['data'];
					}else{
						unset($return[$r]);
					}
				}
				
		}
	
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function add(){
		$validation = $this->validate();
		$duration   = $this->param['year']."-". $this->param['month'] . "-01";
		if(empty($validation)) { 
			$data = array(
				'r_id'                     => $this->param['r_id'],
				'duration'             => $duration,
				'totalAmount'      => $this->param['totalAmount'],
				'type'                     => !empty($this->param['type']) ? $this->param['type'] : 1,
				'paymentType'     => !empty($this->param['paymentType']) ? $this->param['paymentType'] : 1,
				'created'                => date('Y-m-d H:i:s'),
				'updated'               => date('Y-m-d H:i:s')
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
	
	public function batchAdd($array=array()){
		$info = explode(',', $array);
		$p_id = $this->user->get_memberproperty();
	 	$resident = $this->residents_model->getByUnitLots($p_id,$info[0],1 ); 
	 	if($resident['status'] == "success" &&  !empty($resident['data'])){
	 		$data = array(
				'r_id'                     => $resident['data']['r_id'],
				'duration'             => $info[1],
				'totalAmount'      => !empty($info[2]) ? $info[2] : "0.00",
				'type'                     => !empty($info[3]) ? $info[3] : 1,
				'paymentType'     => 1,
				'created'                => date('Y-m-d H:i:s'),
				'updated'               => date('Y-m-d H:i:s')
			);
			
			$id = $this->insert($data);
	 	}
	 	
		
	}
	
	public function edit(){
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'duration'             => $this->param['duration'],
				'status'                  => $this->param['status'],
				'totalAmount'      => $this->param['totalAmount'],
				'type'                     => !empty($this->param['type']) ? $this->param['type'] : 1,
				'paymentType'     => !empty($this->param['paymentType']) ? $this->param['paymentType'] : 1,
				'updated'      => date('Y-m-d H:i:s')
			);
			
			$this->update($this->param['m_id'], $data);
			
			/*** return response***/
			$this->_result['status']     = 'success';
			$this->_result['data']       = $this->param['m_id'];	
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
		$this->delete($this->param['m_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode = array();
		$year        = $this->param['year'];
		$month        = $this->param['month'];
		$totalAmount = $this->param['totalAmount'];
		
		if(empty($year) || empty($month)){
			$statusCode[] = 132;
		}
		
		if(empty($totalAmount)){
			$statusCode[] = 133;
		}
		
		return $statusCode;
	}
	
}
?>
