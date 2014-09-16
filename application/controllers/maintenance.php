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
		$data['type']      = !empty($this->param['category']) ? $this->param['category'] : "";
		$data['paid']      = !empty($this->param['paid']) ? $this->param['paid'] : "";
  		$data['result']    = $this->maintenance_model->get();
		$this->_render_form('index',$data);
	}
	
	public function edit($id=""){
		/**Module name***/
		$data['module'] = "Edit Maintenance";
		$this->param['m_id'] = $id;
	 	$data['result']    = $this->maintenance_model->getById();
	 	
		$this->_render_form('edit',$data);
	}
	
	public function invoice($id=""){
		/**Module name***/
		$data['module'] = "Maintenance Invoice";
		$data['user']    = $this->users_model->getById($id);
		$data['residential']    = $this->residents_model->getByUser($id);
		$this->param['r_id'] = $data['residential']['data']['r_id'];
	 	$data['maintenance']    = $this->maintenance_model->getMaintenanceByResident();

		$data['property']    = $this->property_model->getById($data['residential']['data']['p_id']); 
		$this->_render_form('invoice',$data);
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
	
	public function payAnyAmount(){  
		$result = $this->payment_model->add();
		echo json_encode($result);
	}
	
	public function payAll(){
		$result = $this->payment_model->clearOff();
		echo json_encode($result);
	}
	
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */