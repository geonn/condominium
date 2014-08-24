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
		$data['result']    = $this->facility_model->get();
		$this->_render_form('index',$data);
	}
	
	public function add(){
		/**Module name***/
		$data['module'] = "Create Facility";
	 
		$this->_render_form('add',$data);
	}
	
	public function edit(){
		/**Module name***/
		$data['module'] = "Create Facility";
		$this->param['f_id'] = $this->uri->segment(3);
	 
	 	$data['result'] = $this->facility_model->getById();
	  
		$this->_render_form('edit',$data);
	}
	
	public function memberAddBooking(){
		/**Module name***/
		$data['module'] = "Check Booking";
 
		$this->_render_form('memberAddBooking',$data);
	}
	
	public function booking(){
		/**Module name***/
		$data['module'] = "Check Booking";
 		
		$this->_render_form('booking',$data);
	}
	
	public function memberBooking(){
		/**Module name***/
		$data['module'] = "Check Booking";
 		
 		
 		//print_pre($data);exit;
		$this->_render_form('memberBooking',$data);
	}
	
	public function getMemberBookingInfo(){
		$data['booking'] = $this->facilityBooking_model->getByUser($this->user->get_memberid());
		echo json_encode($data['booking']);
	}
	
	public function getPropertyFacilityBooking(){
		$data['booking'] = $this->facilityBooking_model->getByProperty($this->user->get_memberproperty());
	 	echo json_encode($data['booking']);
	}

	public function getBookingInfoById(){ 
		$data['booking'] = $this->facilityBooking_model->getById();
		echo json_encode($data['booking']);
	}
	
	public function cancelledEvent(){
		$data['info'] = $this->facilityBooking_model->cancelled();
		echo json_encode($data['info']);
	}
	
	public function checkAvailablity(){ 
		$this->param['bookingDate'] = convertToDBDate($this->param['bookingDate']); 
		$result = $this->facilityBooking_model->checkAvailablity();
		echo json_encode($result);
	}
	
	public function reActivateBooking(){
		$result = $this->facilityBooking_model->reActivateBooking();
		echo json_encode($result);
	}
	
	public function doAdd(){
		$result = $this->facility_model->add();
		echo json_encode($result);
	}
	
	public function doUpdate(){ 
		$this->param['name'] = $this->param['fac_name'];
		$result = $this->facility_model->edit();
		echo json_encode($result);
	}
	
	public function updateOptions(){  
		$result = $this->facilityOptions_model->edit();
		echo json_encode($result);
	}
	
	public function addOptions(){
		$result = $this->facilityOptions_model->add();
		echo json_encode($result);
	}
	
	public function getOptions(){
		$data['result'] = $this->facilityOptions_model->getChildById($this->param['f_id']);
		$table_row = $this->load->view('/webs/'.$this->name.'/_facility_option',$data,true);
		echo $table_row;	
	}
	
	public function getFacilityOptionStatus(){
		echo json_encode($this->config->item('facilities_status'));
	}
}

/* End of file facility.php */
/* Location: ./application/controllers/facility.php */