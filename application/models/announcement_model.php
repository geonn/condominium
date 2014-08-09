<?php
class Announcement_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "announcement";
		$this->primary_key = 'id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function get(){
		/** Get property that admin in-charged**/
		$roles = $this->user->get_memberrole();
		$return = array();
		if($roles == "3"){
			$user	 = $this->residents_model->getByUser($this->user->get_memberid()); 
			
			$filter = array(
				'p_id' => $user['data']['p_id'],
				'status' => 1
			);
		}else{
			$filter = array();
		}
		
		$result = $this->get_data($filter,'','',$this->primary_key,'DESC');
		
		$month = array();
		foreach($result as $k => $val){
			if($roles == "3"){
				
				$user = $this->users_model->getById($val['u_id']);
				
				$date = date_convert($val['updated']);
				$date = explode(' ', $date);
				
				$month = $date[1];
				$return[$month][$k] = $val;
				$return[$month][$k]['postBy'] = $user['data']['firstname'] . " " .$user['data']['lastname'];
				$return[$month][$k]['day']  	  = $date[0];
				$return[$month][$k]['month']  = $month;
				$return[$month][$k]['year'] 	 = $date[2];
				$return[$month][$k]['dayOfWeek'] 	 = $date[3];
				$monthList[strtolower($month)] = $month;
			}else{
				$return[$k] = $val;
				$user = $this->users_model->getById($val['u_id']);
				$return[$k]['postBy'] = $user['data']['firstname'] . " " .$user['data']['lastname'];
			}
			
		}
		
		if($roles == "3"){
			$return['monthList'] = $monthList;
		}
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function getById($id){
		$filter = array(
			$this->primary_key => $id
		);
		
		$result = $this->get_data($filter);
		foreach($result as $k => $val){
			$user = $this->users_model->getById($val['u_id']);
			$result[$k]['postBy'] = $user['data']['firstname'] . " " .$user['data']['lastname'];
		}
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function add(){
		
		$validation = $this->validate();
		
		if(empty($validation)) { 
			$data = array(
				'title'              => $this->param['announcementTitle'],
				'content'       => $this->param['announcementContent'],
				'u_id'             =>  $this->user->get_memberid(),
				'p_id'             =>  $this->user->get_memberproperty(),
				'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
				'created'       => date('Y-m-d H:i:s'),
				'updated'      => date('Y-m-d H:i:s')
			);
			
			$id = $this->insert($data);
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
		
		/*** return response***/
		return $this->_result;
	}
	
	public function edit(){
		$data = array(
			'title'              => $this->param['announcementTitle'],
			'content'       => $this->param['announcementContent'],
			'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['id'], $data);
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['id'];	
		return $this->_result;
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
		$title        = $this->param['announcementTitle'];
		$content = $this->param['announcementContent'];
		
		if(empty($title)){
			$statusCode[] = 130;
		}
		
		if(empty($content)){
			$statusCode[] = 131;
		}
		
		return $statusCode;
	}
	
}
?>
