<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Web_Controller {
	
	/** Module name **/
	public $name      = 'main';	
	
	/**Module open to public**/
	public $denied   = false; 
	
	function __construct() {
		parent::__construct();	
		
	}
	
	public function index(){
		/**Module name***/
		$data['module'] = "Dashboard";
	 	
	 	$type = $this->user->get_memberrole();
	 
	 	if($type == "3"){
	 		$this->dashboard();
	 	}else if($type == "1" && !$this->user->get_memberproperty()){
			redirect($this->config->item('base_url').'main/switchCondo');
		}else{
	 		$this->_render_form('index',$data);
	 	}
		
	}
	
	public function dashboard(){
		/**Module name***/
		$data['module'] = "Dashboard";
	 	$role = $this->user->get_memberrole();
	 	
	 	if($role == 3){
	 		$data['result'] = $this->announcement_model->get();
	 		$data['monthList'] = $data['result']['data']['monthList'];
			unset($data['result']['data']['monthList']);
	 		$this->_render_form('dashboard'.$role,$data);
	 	}else{
	 		$this->_render_form('dashboard',$data);
	 	}
	}
	
	public function articles($id){
		/**Module name***/
		$data['module'] = "Dashboard";
		
		$data['result'] = $this->announcement_model->getById($id);
	 
		$this->_render_form('articles',$data);
	}
	
	public function login(){
		$data = array();
		$this->template->set_layout('login');
		$this->template->set_partial('includes' , $this->config->item('template_dir').'/_login_includes');   
		$this->_render_form('login',$data);
	}
	
	public function lockScreen(){
		$data = array();
		$this->template->set_layout('lockScreen');
		$this->template->set_partial('includes' , $this->config->item('template_dir').'/_login_includes');   
		$this->_render_form('lockScreen',$data);
	}
	
	public function switchCondo(){
		$data = array();
		$res = $this->property_model->get();
		$data['property_list'] = $res['data'];
		$this->template->set_layout('lockScreen');
		$this->template->set_partial('includes' , $this->config->item('template_dir').'/_login_includes');   
		$this->_render_form('switchCondo',$data);
	}
	
	public function doLogin(){
		$result = $this->users_model->loginUser();
		echo json_encode($result);
	}
	
	public function doSwitchCondo(){
		$result = $this->users_model->switchCondo();
		echo json_encode($result);
	}
	
	public function doLogout(){
		$result = $this->users_model->logoutUser();
		echo json_encode($result);
		exit;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */