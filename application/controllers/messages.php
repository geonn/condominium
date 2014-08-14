<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends Web_Controller {

	/** Module name **/
	public $name        = 'messages';	
	function __construct() {
		parent::__construct();	
	}
	
	public function index(){
		/**Module name***/
		$data['module'] = "Messages";
		$chatroom    = $this->chatroom_model->getByUser();
		if(!empty($chatroom['data'])){
			$data['result']    = $this->message_model->getLastMessage($chatroom['data']);
		}else{
			$data['result']    = $this->chatroom_model->setupChatroom();
		}
 
		$this->_render_form('index',$data);
	}
	
	public function getMessageList(){
		$this->messageNotification_model->resetBadge($this->param['chatroom']);
		$data['result']    = $this->message_model->getByChatroom($this->param['chatroom']);
		$table_row = $this->load->view('/webs/'.$this->name.'/_message',$data,true);
		echo $table_row;
	}
	
	public function getUnread(){
		$result    = $this->messageNotification_model->getTotalByUser();
		echo json_encode($result);
	}
	
	public function doCreate(){
		$this->param['recipient'] = $this->param['recipient1'] = $this->user->get_memberid();
		$result = $this->chatroom_model->add();	
		$message = $this->message_model->add($result['data']);
		$data['result']    = $this->message_model->getByChatroom($result['data']);
		$table_row = $this->load->view('/webs/'.$this->name.'/_message',$data,true);
		echo $table_row;
	}
	
}

/* End of file messages.php */
/* Location: ./application/controllers/messages.php */