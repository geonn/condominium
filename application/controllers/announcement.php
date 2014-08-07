<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcement extends Web_Controller {

	/** Module name **/
	public $name        = 'announcement';	
	function __construct() {
		parent::__construct();	
	}
	
	public function index(){
		/**Module name***/
		$data['module'] = "Manage Announcement";
		$data['result']    = $this->announcement_model->get();
		$this->_render_form('index',$data);
	}
	
	public function create(){
		/**Module name***/
		$data['module'] = "Create Announcement";
		
		$this->_render_form('create',$data);
	}
	
	public function edit($id=""){
		/**Module name***/
		$data['module'] = "Edit Announcement";
	 	$data['result']    = $this->announcement_model->getById($id);
	 
		$this->_render_form('edit',$data);
	}
	
	public function doCreate(){
		$result = $this->announcement_model->add();
		echo json_encode($result);
	}
	
	public function doUpdate(){
		$result = $this->announcement_model->edit();
		echo json_encode($result);
	}
	
	
	public function dashboard(){
		/**Module name***/
		$data['module'] = "Dashboard";
		
		$this->_render_form('index',$data);
	}
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */