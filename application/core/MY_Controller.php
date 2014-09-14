<?php 
/** 
** The heart of controller 
** Initialize share param and object
** by GEO
**/
class APP_Controller extends CI_Controller{
	public	$path = '';
	public	$code  = '';	
	public  $param = "";
	public  $debug = "";
	
	function __construct() {
		parent::__construct();
		$this->CI           = & get_instance();
		$this->path      = '/'.$this->name.'/';
		$this->code      = $this->config->item('api_code');
		/***********************************************
		|  Load Model
		************************************************/ 
		$this->load
			 ->model(array(
				'admin_model','permissions_model','user_sessions_model','users_model',
				'facility_model','facilityOptions_model','maintenance_model', 'property_model',
				'residents_model', 'propertyAdmin_model', 'facilityBooking_model','announcement_model',
				'chatroom_model','message_model','messageNotification_model','payment_model'
			));
			
		/***********************************************
		|  Load Library
		************************************************/ 
		$this->load->library('form_validation');		
		$this->load->library('pagination');	
		$this->load->library('email');		
		
	
	}
	
	public function _remap($method, $args) {
      // Call before action
      $this->before();      
      call_user_func_array(array($this, $method), $args);      
      // Call after action
      $this->after();
    }
    
    /** Action to do before launch controller function**/
	protected function before() {    	
		$this->convertParam();
    }
    
     /** Action to do after launch controller function**/
	protected function after() { 
    	if($this->debug){
    		print_pre($this->result); 
    	}
    	
    	if(!empty($this->result)){
	    	echo json_encode($this->result);
	    }
    }
    
    /** Convert all $_GET and $_POST to framework parameters**/
    public function convertParam(){
    	foreach($_REQUEST as $key => $val){
	    	$val = str_replace(array("\\\\\\"),array(""),$val); 
	    	$this->param[$key] = $val;
        }
    }
    
    /**Get user ID if user is logined**/
    protected function checkUserSession(){
		if(!empty($this->param['session']) && isset($this->param['session'])){			
			$res = $this->user_sessions_model->checkUserSession();
			if($res > 0){
				$this->param['u_id'] = $res;
				return 1;
			}else{
				return 162; //Havent login
			}			
		}else{
			return 160; //NO session
		}
	} 
	
    /** Render and generate view(html) form**/ 
	public function _render_form($action,$data=array()){
	//	$this->template->set_partial('content',$this->path.'/_form');
		$this->template->build($this->path.$action, $data);		
	}
}
 
class API_Controller extends APP_Controller {
	public        $_result        = array();
	public        $user             = "";
	protected $api_param  = '';	
	
	function __construct() {
		parent::__construct();
		
		/** Set HTML templates **/
		$this->template->set_layout('html');
		$this->path  ='/'.$this->name.'/';
		
		/** Config code of Authenticate API **/
		$this->api_param = $this->config->item('api_param');
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function _remap($method, $args) {
      // Call before action
      $this->before();      
      call_user_func_array(array($this, $method), $args);      
      // Call after action
      $this->after();
    }
        
	/**
     * These shouldn't be accessible from outside the controller
    **/
    protected function before() {    	
    	$this->convertParam();
    	
    	 /** Turn ON debug mode **/
	   	if(isset($_REQUEST['debug'])){
			$this->debug = true;	
		}
		
		/** CHECK AUTHENTICATE **/
		$result = $this->checkParam();	
		if($result == 1){
			// Safe to generate data to client	
			if(!isset($this->param['skipSession'] ) || empty($this->param['skipSession'])){
				$ses = $this->checkUserSession();	
				
				if($ses == 1 ){		
					
				}else{
					if(!$this->param['u_id'] ){		
						/** Called function without session authentication**/
						if(!in_array($this->uri->segments[2], $this->config->item('skip_auth'))){
							$this->_result['status']     = 'error';
							$this->_result['error_code'] = $ses;
							$this->_result['data']       = $this->code[$ses];	
							echo json_encode($this->_result);
							exit;
						}				
					}
				}
			
			}
		} else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $result;
			$this->_result['data']       = $this->code[$result];	
			echo json_encode($this->_result);
			exit;
		}		    	 
   	}
   	
	protected function authenticateKey($user,$key){
		$keyList = $this->config->item('api_key');
		 
		if(!isset($keyList[$user])){
			return 190; //Invalid User
		}
		
		if($keyList[$user] == $key){
			$this->users = $user;
			return 1; //Success
		}else{
			return 192; //Wrong Key
		}
		
		return 180; //Unknown Error
	}
	
	/**
	*	Validate the param sent from client
	**/
	protected function checkParam(){
		
		if(empty($this->param['user']) ||empty($this->param['key'])  ){
			$result = 188;
		}else{
			// If user and key provided
			$user = htmlspecialchars(trim($this->param['user']));
			$key  = htmlspecialchars(trim($this->param['key']));
			 
			//Check the result from provided key
			$result = $this->authenticateKey($user,$key);
		}
		
		return $result;
	}
	

}

class Web_Controller extends APP_Controller {
	
	public $roles   			   = '';
	public $param		        = "";
	public $session              = "";
	public $u_id                   = "";
	public $skip_auth         = "";
	public $menu  			    = array();
	public $sub_menu		= array();
	public $nav                 	= array();
	public $sorted 				  = array();
	protected $api_param  = '';	
	
	function __construct() {
		parent::__construct();		
		$this->CI =& get_instance();	
		$this->path ='/webs/'.$this->name.'/';
		 
		/** Load layout template **/
		$this->template->set_layout('web');
		$this->template->set_partial('message', 'webs/_message');		
		
		/** Load config **/
		$this->account_status = $this->config->item('account_status');	
		$this->sorted 		       = $this->config->item('sorted');	
		$this->roles 		         = $this->config->item('roles');
		$this->api_param       = $this->config->item('api_param');
		$this->skip_auth       = $this->config->item('skip_auth');
	
		/*** retrive user session***/
		$this->session         = $this->phpsession->get(null,'session');
		$this->u_id              = $this->phpsession->get(null,'uid');
		
		$keyList  = $this->config->item('api_key');
		
		$roles = $this->user->get_memberrole();
		
		if($roles){
			$this->menu 		  	   = $this->config->item('menu'.$roles );
			$this->sub_menu 	  = $this->config->item('sub_menu'.$roles );		
		//	print_pre($this->sub_menu);
		//	$this->nav = $list[$this->user->get_memberrole()];
		}
		
		/***********************************************
		|   Load partial files (includes file like js)
		************************************************/
		$this->template->set_partial('includes' , $this->config->item('template_dir').'/_web_includes');   
		$this->template->set_partial('footer'   , $this->config->item('template_dir').'/_web_footer');   
		$this->template->set_partial('message'  , 'webs/_message');
		 
		 /***********************************************
		|   Check if module need to authenticate
		************************************************/
		$controller = $this->uri->segment(1);
		$module = $this->uri->segment(2);
 		$isAuth   = 1;
		if(isset($this->skip_auth[$controller]) ){
			if(in_array($module, $this->skip_auth[$controller])){
				//do nothing
				$isAuth   = 0;
			} 
		}
	 	
	 	/*** Redirect to login page if haven't login***/
	 	if($isAuth){
	 		$this->authenticate->validate_user_login();
	 	}
	 	
		$this->param['user'] = API_USER;
		$this->param['key']  = API_KEY;
	}
	
	public function goHome(){
		redirect($this->config->item('admin_url').'/'.$this->name.'/index');
	}
	
}

