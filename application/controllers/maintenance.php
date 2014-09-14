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
		$data['result']    = $this->maintenance_model->get();
		$this->_render_form('index',$data);
	}
	
	function get_list(){		  
		$data['result']  =  $this->maintenance_model->get(); 
		$table_row = $this->load->view('/webs/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	public function edit($id=""){
		/**Module name***/
		$data['module'] = "Edit Maintenance";
		$this->param['m_id'] = $id;
	 	$data['result']    = $this->maintenance_model->getById();
	 	
		$this->_render_form('edit',$data);
	}
	
	public function create(){
		/**Module name***/
		$data['module'] = "Add Maintenance";
		
		$this->_render_form('create',$data);
	}

	public function doAdd(){
		$result = $this->maintenance_model->add();
		echo json_encode($result);
	}
	
	public function searchUnit(){
		/*****get admin property incharge*****/
		$this->param['p_id'] =  $this->user->get_memberproperty();
		
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