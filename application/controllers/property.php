<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends Web_Controller {

	/** Module name **/
	public $name        = 'property';	
	function __construct() {
		parent::__construct();	
	}
	
	public function index(){
		/**Module name***/
		$data['module'] = "Manage Property";
		$data['result']    = $this->property_model->get();
		$this->_render_form('index',$data);
	}
	
	public function create(){
		/**Module name***/
		$data['module'] = "Create Property";
		
		$this->_render_form('create',$data);
	}
	
	public function edit($id){
		/**Module name***/
		$data['module'] = "Manage Property"; 
		$data['result']    = $this->property_model->getById($id);
		$this->_render_form('edit',$data);
	}
	
	public function doCreate(){
		$result = $this->property_model->add();
		echo json_encode($result);
	}
	
	public function deleteLogo(){
		$result = $this->images_model->deleteImage($this->param['img_id']);
		echo json_encode($result);
	}
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */