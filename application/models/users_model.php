<?php
class Users_Model extends APP_Model{
	public $_result = array();
	public $code = array();
	function __construct() {
		$this->_table      = "users";
		$this->primary_key = 'u_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();
		$this->code = $this->config->item('api_code');	
	}
	
	public function get(){
		$filter   = array();
		$return = array();
		$result = $this->get_data($filter);
		
		$userType = $this->user->get_memberrole();
		if($userType != "3"){
			$count = 0;
			$p_id = $this->user->get_memberproperty();
			$residents = $this->residents_model->getByProperty($p_id);
			foreach($result as $k => $val){
				
					
			   	if($val['type'] == "3"){
					$residents = $this->residents_model->getByUser($val['u_id']);		
					if($residents['data']['p_id'] == $p_id ){
						$return[$count] = $val;
						$return[$count]['unitLots'] = $residents['data']['unitLots'];
						$return[$count]['p_id'] = $residents['data']['p_id'];
						$return[$count]['residentType'] = match($residents['data']['type'],$this->config->item('resident_type'));
						
					}
				}else{
					if($val['type'] == "2"){
						$propadmin = $this->propertyAdmin_model->getByUser($val['u_id']);
					 
						if($propadmin['data']['p_id'] == $p_id ){
							$return[$count] = $val;
						}
					}
				}
					
			
				$count++;
			}
			
		}else{
			$return = $result;	
			
		} 
		 
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $return;	
		return $this->_result;
	}
	
	public function getAdminList(){
		$filter = "(type IN (1,2) AND status=1)";
		$res = $this->get_data($filter);
		
		$this->_result['status']     = 'success';
		$this->_result['data']       = $res;	
		return $this->_result;
	}
	
	/** Retrieve user base on their info  **/
	public function getUser(){
		$u_id     =$this->user_sessions_model->checkUserSession();
			
		if($result) {
			$user = $this->get_data(array($this->primary_key => $u_id));
			
			$this->_result['status']     = 'success';
			$this->_result['data']       = $user[0];	
		} else {
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = 100;
		}		
		
		return $this->_result;
	}

	public function getListByProperty(){
		$res = $this->residents_model->getByProperty($this->user->get_memberproperty());
		$list = array();
		 foreach($res['data'] as $k => $val){
		 	$user = $this->getById($val['u_id']);
		   $list[$val['u_id']] = $val['unitLots'] . "(".$user['data']['firstname'] . " ". $user['data']['lastname'].")";
		}
		
		 return $list;
	}
		
	public function getById($u_id){
		$filter = array(
					$this->primary_key    => $u_id
				  );
		$users   = $this->get_data($filter);
		
		if(!empty($users)){
			foreach($users as $k => $val){
				if($val['type'] == "2"){
					$resident = $this->propertyAdmin_model->getByUser($val['u_id']);
					$users[$k]['admin'] = $resident['data'];
				}
				
				if($val['type'] == "3"){
					$resident = $this->residents_model->getByUser($val['u_id']);
					$users[$k]['residental'] = $resident['data'];
				}
			}
		}

		$this->_result['status']     = 'success';
		$this->_result['data']       = $users[0];	
		return $this->_result;
	}
	
	/** Authenticate and login user**/
	public function loginUser(){
		$check = $this->validateUser();
		$validate = array(103,106);
		
		$ecode = array();
		$desc = array();
		foreach($validate as $vcode){
			if(in_array($vcode, $check)){
				$ecode[]=  $vcode;
				$desc[] = $this->code[$vcode];
			}
		}
		
		/*** return if error detected***/
		if(!empty($ecode)){
			$this->_result['status']     					 = 'error';
			$this->_result['error_code'] 				= $ecode;
			$this->_result['data']['error_msg']     = $desc;
			return $this->_result;
		}
		
		$filter = array(
					'username'    => trim($this->param['username']),
					'password' => md5($this->param['password'])
				  );
		$users   = $this->get_data($filter);
		
		if($users){		
			if($users[0]['status'] == 2){
				$this->_result['status']     = 'error';
				$this->_result['error_code'] = array(101);
				$this->_result['data']['error_msg']       = array($this->code[101]);
			}else{
				
				$this->_result['status']     = 'success';
				$this->_result['data']       = $this->generateSession($users[0]['u_id']);	
				// Set user object
				foreach($users as $info){				
					
					$this->user->set_memberid($info['u_id']);
					$this->user->set_memberemail($info['email']);
					$this->user->set_memberfullname($info['firstname']." ".$info['lastname']);
					$this->user->set_memberusername($info['username']);
					$this->user->set_memberrole($info['type']);
					if($info['type'] == 3){
						$prop = $this->residents_model->getByUser($this->user->get_memberid());
						$this->user->set_memberproperty($prop['data']['p_id']);
					}elseif($info['type'] == 2){
						$prop = $this->propertyAdmin_model->getByUser($this->user->get_memberid());
						$this->user->set_memberproperty($prop['data']['p_id']);
					}
					$this->user->set_memberonline(1);
				}
			}
		}else{
			
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = array(135);
			$this->_result['data']['error_msg']       = array($this->code[135]);
		}
		
		return $this->_result;
	}
	
	
	/** Logout User ***/
	public function logoutUser(){
		$u_id = $this->user_sessions_model->removeUserSession();
		$data = array(
			'lastLogin' 	 => date('Y-m-d H:i:s'),
			'onlineStatus' 	 => 2,
		);				
		$this->update($u_id,$data);
		$this->phpsession->clear(null,'key');
		$this->phpsession->clear(null,'uid');
		$this->phpsession->clear(null,'my_app');
		
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/** Add user to DB  **/
	public function add(){ 
		$validation = $this->validateUser();
		
		$result     = $this->checkUser(); 
		if(empty($validation)) { 
			if(empty($result)) {
				$type = !empty($this->param['type']) ? $this->param['type'] : 3;
				$data = array(
					'firstname'	   => $this->param['firstname'],
					'lastname'	   => $this->param['lastname'],
					'username'    => $this->param['username'],
					'email'            => !empty($this->param['email']) ? $this->param['email'] : "",
					'mobile'            => !empty($this->param['mobile']) ? $this->param['mobile'] : "",
					'password'	   => md5($this->param['password']),
					'type'       => $type,
					'status'       => !empty($this->param['status']) ? $this->param['status'] : 1,
					'onlineStatus'       => 2,
					'created' 	   => date('Y-m-d H:i:s'),
					'updated' 	   => date('Y-m-d H:i:s'),
				);
				$id = $this->insert($data);
				
				/***Add unitLots of Owner/Tenants OR property manage for Admin***/
				if($type == "2"){
					$this->propertyAdmin_model->add($id);	
				}
				if($type == "3"){
					$this->residents_model->add($id);
				}
				
				$this->_result['status']     = 'success';
				 
			} else { 
				$this->_result['status']     = 'error';
				$this->_result['error_code'][] = 102;
				$this->_result['data']['error_msg'] = $this->code[102];
			}
		} else { 
			
				$this->_result['status']     = 'error';
				$this->_result['error_code'] = $validation;
				foreach($validation as $k => $val){
					$this->_result['data']['error_msg'][$k] = $this->code[$val];
				}
		}
		
		return	$this->_result;
	}
	
	public function batchAdd($array){
		$info = $array;
	
		$p_id = $this->user->get_memberproperty(); 
	 	$data = array(
				'firstname'	   => $info[0],
				'lastname'	   => $info[1],
				'username'    => $info[2],
				'email'            => !empty($info[3]) ? $info[3] : "",
				'password'	   => !empty($info[4]) ? md5($info[4]) : md5("123456"),
				'type'       		=> 3, //owner/tenants
				'status'           => 1,
				'onlineStatus'       => 2,
				'created' 	   => date('Y-m-d H:i:s'),
				'updated' 	   => date('Y-m-d H:i:s'),
			);
			
		$id = $this->insert($data);
		$this->residents_model->add($id,$p_id , $info[5], $info[6], "1");
		
	}
	
	public function edit(){
		$validation = $this->validateUser();
		
		if(empty($validation)) { 
			$type = !empty($this->param['type']) ? $this->param['type'] : 3;
			$data = array(
				'firstname' => $this->param['firstname'],
				'lastname'  => $this->param['lastname'], 
				'status'       => !empty($this->param['status']) ? $this->param['status'] : 1,
				'email'         =>  !empty($this->param['email']) ? $this->param['email'] : "",
				'mobile'         =>  !empty($this->param['mobile']) ? $this->param['mobile'] : "",
				'updated' 	 => date('Y-m-d H:i:s'),
			);
			
			/**If user want to update password **/
			if($this->param['password']){
				$pwd = array('password' => md5($this->param['password']));
				$data = $data + $pwd;
			}
			 
			$this->update($this->param['u_id'],$data);
			
			/***Edit unitLots of Owner/Tenants OR property manage for Admin***/
			if($type == "2"){
				$this->propertyAdmin_model->edit($this->param['u_id']);	
			}
			if($type == "3"){
				$this->residents_model->edit($this->param['u_id']);	
			}
			
			$this->_result['status']     = 'success';
				
		 
		} else { 
			
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $validation;
			foreach($validation as $k => $val){
				$this->_result['data']['error_msg'][$k] = $this->code[$val];
			}
		}
		return	$this->_result;
	}
	
	/***update online status***/
	public function updateOnlineStatus(){
		$data = array(
			'onlineStatus' => $this->param['onlineStatus'],
			'updated' 	 => date('Y-m-d H:i:s'),
		);				
		$this->update($this->user->get_memberid(),$data);
		$this->user->set_memberonline($this->param['onlineStatus']);
	}
	
	/**Generate session to user **/
	private function generateSession($u_id){
		$result = $this->user_sessions_model->addUserSession($u_id);
		if($result){
			$data = array(
				'onlineStatus'=> 1,
				'lastLogin' 	 => date('Y-m-d H:i:s'),
		   	);				
			$this->update($u_id,$data);
		}
		
		return $result;
	}
	
	public function changePassword(){
		$result     = $this->checkUser();				
		if($result) {
		
			if(md5($this->param['oldPwd']) == $result['password']){
				$data = array(
					'password' => md5($this->param['newPwd']),
					'updated'    => date('Y-m-d H:i:s'),
				);				
				$this->update($this->param['u_id'],$data);
				$this->_result['status']     = 'success';
			}else{
				$this->_result['status']     = 'error';
				$this->_result['error_code'] = 129;
			}
			
		} else {
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = 100;
		}		
		
		return $this->_result;
		
	}
	
	public function setNewPassword(){
		$data = array(
			'password' => md5($this->param['password']),
			'updated'    => date('Y-m-d H:i:s'),
		);			
		$this->_result['debug'][] =  $this->param;
		$u_id = $this->user_sessions_model->getUserID($this->param['session']);
		$this->_result['debug'][] =  $u_id;
		
		if($u_id){
			$this->update($u_id, $data);
			$this->_result['status']     = 'success';
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = 100;
		}
		return $this->_result;
	}
	
	public function checkPassword(){
		if(isset($this->param['password']) && isset($this->param['password2'])){
			if(empty($this->param['password']) || empty($this->param['password2'])){ 
				$this->_result['status']     = 'error';
				$this->_result['error_code'] =  106;
				$this->_result['data']['error_msg'] = $this->code[106];
				return $this->_result;		
			}
			
			if($this->param['password'] != $this->param['password2']){ 
				$this->_result['status']     = 'error';
				$this->_result['error_code'] =  107;
				$this->_result['data']['error_msg'] = $this->code[107];
				return $this->_result;		
			}
			
		}
		$this->_result['status']     = 'success';
		return $this->_result;		
	}
	
	public function switchCondo(){
		if(!empty($this->param['propertyOptions'])){
			$this->user->set_memberproperty($this->param['propertyOptions']);
			$this->_result['status']     = 'success';
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code']     = '108';
			$this->_result['data']['error_msg'] = $this->code[108];
		}
		return $this->_result;	
	}
	
	public function forgetPassword(){
		
		if(!empty($this->param['email'])){
			if($user = $this->checkEmailExist()){
				$sessionkey = $this->generateSession($user['u_id']);
				$return = $this->sentResetPasswordEmail($sessionkey, $user);
				$this->_result['data']     =  $sessionkey;
				$this->_result['status']     = 'success';
			}else{
				$this->_result['status']     = 'error';
			}
		}else{
			$this->_result['status']     = 'error';
		}
		return $this->_result;
	}
	
	/*********************************************
	******************* PRIVATE CLASS ************
	*********************************************/
	
	private function sentResetPasswordEmail($sessionkey, $user){
		$residents = $this->residents_model->getByUser($user['u_id']);
		$property = $this->property_model->getById($residents['data']['p_id']);
		$to = $this->param['email'];
		$subject = $property['data']['name']." - Forgot your password?";
		$message = "click the link to reset your password. \r\n http://".$this->config->item('master_domain').$this->config->item('domain')."/main/resetPassword/?session=".$sessionkey;
		$header = "From:".$property['data']['email']." \r\n";
		$retval = mail ($to,$subject,$message,$header);
		if( $retval == true )  
		{
		  return "Message sent successfully...";
		}
		else
		{
		  return "Message could not be sent...";
		}
	}
	
	private function checkEmailExist(){
		$filter = array('email' => $this->param['email']);
		$result = $this->get_data($filter);//param : $where,$limit,$offset, $order, $direction('ASC','DESC')	
		if(empty($result)){
			return false;
		}else{
			return $result[0];
		}
	}
	
	/** Check if userdata is exists  **/
	private function validateUser(){
		$firstname  = !empty($this->param['firstname'])  ? trim($this->param['firstname'])  : "";
		$password  = !empty($this->param['password'])   ? trim($this->param['password'])   : "";
		$confirmation  = !empty($this->param['confirmation'])   ? trim($this->param['confirmation'])   : "";
		
		$statusCode = array();
		if(empty($firstname)){
			$statusCode[] = 104;
		}
		
		if(isset ($this->param['edit'])){
			if($this->param['edit'] == 1 &&  isset($this->param['change_password'] ) && ($this->param['change_password'] == '1')){
				
				if(empty($this->param['current_password'])){
					$statusCode[] = 128;
				}else{
					$filter = array(
								'u_id'       => $this->u_id,
							  	'password' => md5($this->param['current_password'])
							  );
					$validateUser = $this->get_data($filter);
					if(empty($validateUser)){
						$statusCode[] = 129;
					}
				}
			}else{
				if($password != $confirmation){
					$statusCode[] = 107;	
				}
			
			}	
		}else{
			if(!$password){
				$statusCode[] = 106;
			}elseif($password != $confirmation){
				$statusCode[] = 107;	
			}
		}
		
		return $statusCode;
	}
	
	/** Check if user registered before/Duplicate ?  **/
	private function checkUser(){
		
		if($this->param){
			if(isset($this->param['u_id']) && !empty($this->param['u_id'])){
				$filter = array($this->primary_key => $this->param['u_id']);
			} elseif( isset($this->param['edit'] ) && $this->param['edit'] == 1) {
				$u_id = $this->user_sessions_model->checkUserSession();
				if($u_id) {
					$user = $this->get_data(array($this->primary_key => $u_id));
					$filter = "(username !='". $user[0]['username']. "' AND username='" . $this->param['username'] . "')";
				}
			} else {
				$filter = array('username' => $this->param['username']);
			}
	 
			$result = $this->get_data($filter);//param : $where,$limit,$offset, $order, $direction('ASC','DESC')	
			if(empty($result)){
				return false;
			}else{
				return $result[0];
			}
			
		}
		
		return false;
	}
	
}
?>
