<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Web_Controller {

	/** Module name **/
	public $name        = 'account';	
	
	/**Module open to public**/
	public $denied   = false; 
	
	function __construct() {
		parent::__construct();	
		
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $this->name);		
		if(empty($res) || $res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
	}
	
	public function index(){
		/**Module name***/
		$data['module'] = "Manage Account";
		$data['result']    = $this->users_model->get();
		$this->_render_form('index',$data);
	}
	
	public function create(){
		/**Module name***/
		$data['module'] = "Create Account";
	 
		$this->_render_form('create',$data);
	}
	
	public function edit($id=""){
		if(empty($id)){
			$id = $this->u_id;
		}
		/**Module name***/
		$data['module'] = "Edit Account";
	 	$data['result']    = $this->users_model->getById($id);
	 	
		$this->_render_form('edit',$data);
	}

	public function getPropertyList(){
		echo json_encode($this->property_model->getList());
	}
	
	public function doAdd(){
		$result = $this->users_model->add();
		echo json_encode($result);
	}
	
	public function doUpdate(){
		$result = $this->users_model->edit();
		echo json_encode($result);
	}
	
	public function changeOnlineStatus(){
		$this->users_model->updateOnlineStatus();
		print_pre($this->param);
	}
	
	public function register(){
		$result = $this->users_model->add();	
		json_encode($result);
	}
	
	
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */