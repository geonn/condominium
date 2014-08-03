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
		/*****get admin property incharge*****/
		$admin = $this->propertyAdmin_model->getByUser($this->user->get_memberid());
		$this->param['p_id'] = $admin['data']['p_id'];
		
		/*****check if residents exists*****/
		$resident = $this->residents_model->getByUnitLots();
		
		
	
		/*****get resident info*****/
		$user = array();
		if(!empty($resident['data'])){
			
			/*****get residents maintenance records*****/
			$this->param['r_id'] = $resident['data']['r_id'];
			$this->param['limit'] = 1;
			$maintenance = $this->maintenance_model->getByResident();
		
			$data['result'] = $this->users_model->getById($resident['data']['u_id']);
			$data['result']['data']['maintenance'] = array();
			
			if(!empty($maintenance['data'])){
				$data['result']['data']['maintenance'] = $maintenance['data'][0];
			}
			
		}else{
			$data['result']= $resident;
		}
	
		$table_row = $this->load->view('/webs/'.$this->name.'/_user_table',$data,true);
		echo $table_row;
	}
	
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */