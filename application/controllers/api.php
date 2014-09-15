<?php if (! defined('BASEPATH')) exit('No direct script access');

class API extends API_Controller {
	
	public $result = "";
	public $name        = 'api';	
	function __construct() {
		parent::__construct();	
	}
	
	
	/**
	*	Upload attachment
	**/
	public function uploadAttachment() { 
		$this->result = $this->images_model->uploadPhoto();
		//echo json_encode($return);
		
	}
	
}

?>

