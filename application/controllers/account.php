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
		$data['module'] = "Manage User";
		$data['result']    = $this->users_model->get();
		$this->_render_form('index',$data);
	}
	
	
	public function downloadList(){
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=users_'.localDate().'.csv'); 
		 $path =  getcwd()."/public/attachment/users_".localDate().".csv";
		 $file = fopen('php://output' ,"a+");
		$data['results']    = $this->users_model->get();
		$list = array();
		$title[0] = array(
			'u_id'          => 'User ID',
			'firstname' =>'First Name',
			'lastname' => 'Last Name', 
			'username' => 'Username', 
			'email' => 'Email', 
			'status' => 'Status',
			'unitLots' => 'Unit Lots', 
			'residentType' => 'Resident Type',
			'created' => 'Date Joined',
		);
		
		foreach ($title as $fields) {
		   fputcsv($file, $fields);
		}
		
		 foreach ($data['results']['data'] as $k => $val) {
		 	$list[$k]['u_id'] = $val['u_id'];
			$list[$k]['firstname'] = $val['firstname'];
			$list[$k]['lastname'] = $val['lastname'];
			$list[$k]['username'] = $val['username'];
			$list[$k]['email'] = $val['email'];
			$list[$k]['status'] = match($val['status'], $this->config->item('status'));
			$list[$k]['unitLots'] = $val['unitLots'];
			$list[$k]['residentType'] = $val['residentType'];
			$list[$k]['donedate'] = date_convert($val['created'],'full');
		 }
		
		foreach ($list as $fields) {
		    fputcsv($file, $fields);
		}
	    fclose($file);
	}
	
	public function create(){
		/**Module name***/
		
		$data['module'] = "Create User";
		if($this->user->get_memberrole() != 3){
	 		$data['p_id'] = $this->user->get_memberproperty();
		}
		$this->_render_form('create',$data);
	}
	
	public function edit($id=""){
		if(empty($id)){
			$id = $this->u_id;
		}
		/**Module name***/
		$data['module'] = "Edit User";
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
	}
	
	public function batchUsers(){
		/**Module name***/
		$data['module'] = "Add User";
		
		$this->_render_form('createBatch',$data);
	}
	
	public function batchUpload(){
		$destination = "";
		  if ($_FILES["file"]["error"] > 0){
	  		 echo "Error: " . $_FILES["file"]["error"] . "<br>";
		  }else{
			 if (file_exists("upload/" . $_FILES["file"]["name"])){
		      	echo $_FILES["file"]["name"] . " already exists. ";
		     }else{
		     	$destination = getcwd()."/public/attachment/" . $_FILES["file"]["name"];
				move_uploaded_file($_FILES["file"]["tmp_name"],
				getcwd()."/public/attachment/" . $_FILES["file"]["name"]);
				//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		     }
		  }
		  
		  if(!empty($destination)){
			$data = array_map('str_getcsv', file($destination));
			if(!empty($data)){
				$num = count($data);
				for ($c=1; $c < $num; $c++) {
					if(!empty($data[$c][0])){
						$this->users_model->batchAdd($data[$c]); 
					}
				}
			}
		 	$this->goHome();
		}
	}
	
	public function register(){
		$result = $this->users_model->add();	
		json_encode($result);
	}
	
	
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */