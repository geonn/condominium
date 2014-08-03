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
	 		$this->_render_form('dashboard',$data);
	 	}else{
	 		$this->_render_form('index',$data);
	 	}
		
	}
	
	public function dashboard(){
		/**Module name***/
		$data['module'] = "Dashboard";
	 
		$this->_render_form('dashboard',$data);
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
	
	public function doLogin(){
		$result = $this->users_model->loginUser();
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