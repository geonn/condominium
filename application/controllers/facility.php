<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facility extends Web_Controller {

	/** Module name **/
	public $name        = 'facility';	
	
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
		$data['module'] = "Manage Facility";
		 
		$this->_render_form('index',$data);
	}
	
	public function add(){
		/**Module name***/
		$data['module'] = "Create Facility";
	 
		$this->_render_form('add',$data);
	}
	
	public function booking(){
		/**Module name***/
		$data['module'] = "Check Booking";
 
		$this->_render_form('booking',$data);
	}
}

/* End of file facility.php */
/* Location: ./application/controllers/facility.php */