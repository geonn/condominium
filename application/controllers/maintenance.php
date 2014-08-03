<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends Web_Controller {

	/** Module name **/
	public $name        = 'maintenance';	
	function __construct() {
		parent::__construct();	
	}
	
	public function index(){
		/**Module name***/
		$data['module'] = "Manage Maintenance";
		
		$this->_render_form('index',$data);
	}
	
	public function create(){
		/**Module name***/
		$data['module'] = "Add Maintenance";
		
		$this->_render_form('create',$data);
	}
	
	public function searchUnit(){
		print_pre($this->param);	
	}
	
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */