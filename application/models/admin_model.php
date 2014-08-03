<?php
class Admin_Model extends APP_Model{

	function __construct() {
		$this->_table      = "admin";
		$this->primary_key = 'admin_id';	
	}
	
	public function generateAddButton($module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		if($res[0]['permission'] > 2){ 
			echo '<button type="submit" value="Submit" ><span><span>'. $this->config->item("icon_add") .'Add New </span></span></button>';
		}
	}
	
	public function generateUpdateButton($module,$id=""){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		if($res[0]['permission'] > 2){ 
			echo '<button type="submit" id="submitformbutton"><span><span>'.$this->config->item("icon_edit") .'Update</span></span></button>';	
		}else if($module == "admin" && ($this->user->get_memberid() == $id)){				
			echo '<button type="submit" id="submitformbutton"><span><span>'.$this->config->item("icon_edit") .'Update</span></span></button>';	

		}
	}
	

	public function generateEditButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);		
		if($res[0]['permission'] > 1){	
			echo '<button  onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/edit/'.$id.'\';"><span><span>'.$this->config->item("icon_edit") .'Edit</span></span></button>';			
		}else if($module == "admin" && ($this->user->get_memberid() == $id)){				
				echo '<button  onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/edit/'.$id.'\';"><span><span>'.$this->config->item("icon_edit") .'Edit</span></span></button>';	
		}
	}
	
	public function generateDetailsButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);		
		if($res[0]['permission'] > 1){	
			echo '<button  onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/details/'.$id.'\';"><span><span>Details</span></span></button>';			
		}else if($module == "admin" && ($this->user->get_memberid() == $id)){				
				echo '<button  onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/details/'.$id.'\';"><span><span>Details</span></span></button>';	
		}
	}
	
	public function generateEditImagesButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);		
		if($res[0]['permission'] > 1){
			echo '<button id="img'.$id.'" class="gallery_stalk" onclick="return clickIn(\''.$id.'\');"><span><span>'.$this->config->item("icon_edit") .'Edit</span></span></button>';						
		}
	}
	
	public function generateCustomButton($text, $module="", $function="", $id=""){
		echo ' <button onClick="location.href=\''.$this->config->item('admin_url').'/'.$module.'/'.$function.'/'.$id.'\'" ><span><span>' . $text .'</span></span></button>  ';
	
	}
	
	public function generateDeleteButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		
		if($res[0]['permission'] == 3){ 
			echo '<button  value="Delete" onclick="return confirmRemove(\''.$id.'\');" href="javascript:void(0)"><span><span>'.$this->config->item("icon_cross") .'Delete</span></span></button>';	;
		}
	}
		
	public function generateFilterButton(){
		echo ' <button type="submit" value="Submit "><span><span>' . $this->config->item("icon_search") .' Filter </span></span></button>  ';
	}
	
	public function generateGenerateButton(){
		echo ' <button type="submit" value="Submit "><span><span>' . $this->config->item("icon_search") .' Generate </span></span></button>  ';
	}
	
	public function generateLoading(){
		echo '<div id="loading" name="loading" align="center"><br/><br/><br/>' . $this->config->item("img_loading") . '<br/><br/></div>';
	}
	
	public function generateGoToTop(){
		echo '<div id="go_top" class="goToTop"><a id="scrollTop">' . $this->config->item('icon_gotop') . '</a></div>';
	}
}
 

?>
