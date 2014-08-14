<?php
class MessageNotification_Model extends APP_Model{
	public $_result = array();
	public $list        = array();
	function __construct() {
		$this->_table      = "messageNotification";
		$this->primary_key = 'id';	
		
	 
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getByUser(){
		$filter = array(
			'u_id' => $this->user->get_memberid()
		);
		
		$result = $this->get_data($filter);
		$return = array() ; 
		foreach($result as $k => $val){
			$return[$val['c_id']]['id'] =  $val['id'];
			$return[$val['c_id']]['u_id'] =  $val['u_id'];
			$return[$val['c_id']]['badge'] =  $val['badge'];
		}
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function getTotalByUser(){
		$result = $this->getByUser(); 
		$count = 0;
		if(!empty($result['data'])){
			foreach($result['data'] as $k => $val){
				$count += $val['badge'];
			}
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $count;	
		return $this->_result;
	}

	public function add($c_id, $u_id){
		$filter = array(
			'c_id'   => $c_id,
			'u_id'   => $u_id
		);
		
		$result = $this->get_data($filter);
		
		if(!empty($result)){
			$id=  $result[0]['id'] ;
			$data = array(
				'badge' => $result[0]['badge'] + 1,
				'updated'       => date('Y-m-d H:i:s')
			);
			
			$this->update($id ,$data);
			
		}else{
			$data = array(
				'c_id'   => $c_id,
				'u_id'   => $u_id,
				'badge' => 1,
				'created'       => date('Y-m-d H:i:s'),
				'updated'       => date('Y-m-d H:i:s')
			);
			
			$id = $this->insert($data);
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $id;	
	
		
		return $this->_result;
	}
	
	public function resetBadge($chatroom){
		$filter = array(
			'c_id'   => $chatroom,
			'u_id'   => $this->user->get_memberid()
		);
		
		$result = $this->get_data($filter);
		
		if(!empty($result)){
			$this->delete($result[0]['id']);
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode = array();
		$recipient1        = $this->param['recipient1'];
		$recipient2        = $this->param['recipient2'];
		
		if(empty($recipient1)){
			$statusCode[] = 127;
		}
		
		if(empty($recipient2)){
			$statusCode[] = 128;
		}
		
		return $statusCode;
	}
}
?>
