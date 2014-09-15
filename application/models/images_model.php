<?php
class Images_Model extends APP_Model{
	
	public $targetFolder = "";
	public $categoryType = "";
	
	function __construct() {
		$this->_table      = "images";
		$this->primary_key = 'img_id';
		$this->targetFolder = '/public/'; 
		$this->categoryType = array('property' => 1, 'banner' => 2);
	}
	
	public function addPhoto($u_id,$type, $item_id){
		//Insert Image to table
		$data = array(
				'img_uid' => $u_id,
				'img_photoCate' => $this->categoryType[$type],
				'img_photoCateID' => $item_id, //location ID or UserID
				'img_status' => 1,						
				'created'	=> date('Y-m-d H:i:s'),
				'updated'	=> date('Y-m-d H:i:s')	
			);
		$id = $this->insert($data);
		return $id;
	}
	
	public function getPhotoList($id,$type,$allImg,$extra=""){
		
		$result = $this->getPhoto($id,$type,$allImg);
	
		if(($type == 2) && ($extra == 2)){
			if($result){
				
				$result[0]['img_thumb'] = $this->targetFolder. $this->getSmallThumb($result[0]['img_path'],'128');
			}
			
		}else{
			foreach($result as $k => $val){
				$result[$k]['img_thumb'] = $this->targetFolder. $this->getSmallThumb($val['img_path'],'150');//getcwd() . 
				$result[$k]['img_300thumb'] = $this->targetFolder. $this->getSmallThumb($val['img_path'],'300');//getcwd() . 
			}
		}

		return $result;
	}
	
	public function getPhoto($id,$type,$allImg=FALSE){
		$return = array();
		$search = array('img_photoCateID'  => $id,'img_photoCate' => $type);
		$res = $this->get_data($search);
		if($allImg === FALSE){
			$search = array('img_photoCateID'  => $id,'img_photoCate' => $type, 'is_featured' => 1);
			$res_f = $this->get_data($search);
			
			if(empty($res_f) && !empty($res)){
				$count = 0;
				foreach($res as $k => $val){
				
					if($count == 0){
						$return[$count] = $val;
					}					
					$count++;
				}				
			}else{
				$return = $res_f;
			}			
		}else{
			$return = $res;
		}					
		return $return;
	}
	
	/** Retrieve Image by photo ID**/
	public function getPhotoByID($id){
		$search = array($this->primary_key  => $id);
		return $this->get_data($search);
	} 
	
	public function testUploadImages(){
		$_POST  = $_REQUEST['request'];
		$_FILES = $_REQUEST['files'];
		return $this->uploadPhoto();
	}
	
	/** Upload Images and convert it to specific thumb size(130 & 260)**/
	public function uploadPhoto($skipReturn ="", $thumbSize = '150'){		
		
		// Define a destination
		$u_id    = $_REQUEST['request']['u_id'];
		$item_id = $_REQUEST['request']['item_id'];
		$type    = $_REQUEST['request']['type'];
		$extra   = $_REQUEST['request']['extra_id'];
		//print_pre($_REQUEST);
		if(empty($u_id)){
			$u_id = $this->param['u_id'];
		}
		
		if(empty($item_id)){
			$item_id = $this->param['u_id'];
		}
		
		if(empty($type)){
			$type = "products";
		}
		
		$this->targetFolder = $this->targetFolder.$type;
		$img_id  = substr(md5( time(). $item_id),2,9);
		if (!empty($_REQUEST['files']) ) {
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','JPG'); // File extensions
			$fileParts = pathinfo($_REQUEST['files']['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				$tempFile   = $_REQUEST['files']['Filedata']['tmp_name'];
				$targetPath = getcwd()  . $this->targetFolder. '/';
				
				if(!is_dir($targetPath )){
					mkdir($targetPath,0777);
				}
				
				//Insert Image to table				
				$id = $this->addPhoto($u_id,$type,$item_id);
				
				$arr1 = str_split($id);
				$deep = "";
				foreach($arr1 as $a){
					if(!is_dir($targetPath .$a)){	
						$old_umask = umask(0);
						mkdir($targetPath .$a,0777);
						umask($old_umask);
					}
					$targetPath = $targetPath .$a."/";
					$deep .= $a."/";
				}
				$upd = array(
					'img_path'  => $type."/".$deep.$img_id . '.' .$fileParts['extension'],
				);
				
				$this->update($id ,$upd);
				$targetFile = rtrim($targetPath,'/') . '/' . $_REQUEST['files']['Filedata']['name'];
				
				if(file_exists($_REQUEST['files']['Filedata']['tmp_name'])){
					
					move_uploaded_file($tempFile,$targetFile);
				}else{
					$oriTmpFile = getcwd() .'/public/tmp/'.$_REQUEST['files']['Filedata']['name'];
					copy( $oriTmpFile, $targetFile);
					unlink($oriTmpFile);
				}
				$new_name = $targetPath . '/' .$img_id . '.' .$fileParts['extension'];
				rename($targetFile, $new_name );
				
				if(($type == 'banner') && ($extra == "2")){
					resize_banner('public/'.$type.'/'.$deep, $img_id . '.' .$fileParts['extension'],128,'public/'.$type.'/'.$deep.'/thumb');
				}else{
					resize('public/'.$type.'/'.$deep, $img_id . '.' .$fileParts['extension'],$thumbSize,'public/'.$type.'/'.$deep.'/thumb');
					resize('public/'.$type.'/'.$deep, $img_id . '.' .$fileParts['extension'],'300','public/'.$type.'/'.$deep.'/thumb');
				}
				
				$small = $this->getSmallThumb($type."/".$deep.$img_id . '.' .$fileParts['extension'],$thumbSize);
				
				if(empty($skipReturn)){
					return $small . '===' .$id;
				}
				
			} else {
				if(empty($skipReturn)){
					return 'Invalid file type - ' . $fileParts['extension'];
				}				
			}
		}
	}
	
	/** Declare an image as featured image**/
	public function setFeaturesImage(){
		$id = $this->input->post('img_id');
		
		if(!empty($id)){
			//Check image info
			$filter = array($this->primary_key => $id);
			$imgByLoc = $this->get_data($filter);
			$loc_id = $imgByLoc[0]['img_photoCateID'];
			
			$all_img = array(
						  'img_photoCateID' => $loc_id,
						  'img_photoCate'   => 1
					   );
			$imgToRst = $this->get_data($all_img);
			foreach($imgToRst as $k => $val){
				//Reset all to default
				$datax = array(
					'is_featured'   => 0,																																																							
				);			
				$this->update($val['img_id'], $datax);
			}			
			
			//SET Featured image
			$data = array(
				'is_featured'   => 1,																																																							
			);
			//print_pre($loc_id);
			$this->update($id, $data);
			return 'success';
		}else{
			return 'fail: empty image id';	
		}
	}
	
	/** Upload location description/caption **/ 
	public function updateImageCaption(){		
		$id      = $this->input->post('img_id');
		$caption = $this->input->post('caption');
		if(!empty($id)){
			$data = array(
				'img_caption'   => $caption,																																																							
			);
			
			$id = $this->update($id, $data);
			return 'success';
		}else{
			return 'fail: empty image id';	
		}
	}
	
	/** Upload location description/caption **/   
	public function getSmallThumb($img_path,$img_size ="150"){
		//Thumb file
		$file = explode('/',$img_path);
		$link = "";
		$c = 0;
		if(!empty($img_size)){
			$img_size = "_".$img_size;
		}
		
		for($t =0; $t < count($file); $t++){
			
			$thumb = explode('.',$file[count($file)-1] );
			if(count($file)-1 == $c){
				$link .= '/thumb/';
			}
			if($t != count($file)-1){				
				$link .= '/'.$file[$t];
			}			
						
			$c++;
		}
		$link .= $thumb[0].$img_size.".".$thumb[1];
		
		return $link;
	}
	
	/** Delete image by img_id **/ 
	public function deleteImage($img_id){
		$id      = !empty($img_id) ? $img_id : $this->input->post('img_id');
		$size    = array('128','150','300');
		if(!empty($id)){			
			$info = $this->find_by($id);
			$targetFile = getcwd(). $this->targetFolder.  $info['img_path'];
			if(file_exists($targetFile)){
				
				unlink($targetFile);
				
				//Thumb file
				foreach($size as $val){
					$link = $this->getSmallThumb($info['img_path'],$val);
					$thumbFile = getcwd() . $this->targetFolder.$link;
					unlink($thumbFile);
				}				
				
				$id = $this->delete($id);
				return 'success';
			}else{
				return 'fail: file not exists';	
			}
			
		}else{
			return 'fail: empty image id';	
		}
	
	}
	
	/** Retrieve all images from database and do regeneate thumb **/ 
	public function getAllThumbAndRegen(){
		$filter=array();
		$res = $this->get_data($filter);	
		foreach($res as $k => $val){			
			$this->regenerateImageThumb($val['img_path']);	
			echo $val['img_path']."<br/>";
		}
		
		return 'Success';
	}
	
	/** BATCH REGENERATE IMAGES THUMB **/
	public function regenerateImageThumb($image){
		
		/** Get ori thumb and remove previous thumb  **/
		$ori = $this->getSmallThumb($image,'130');
		$targetFile = getcwd(). $this->targetFolder.  $ori;
		unlink($targetFile);
		

		
		/** Get new image thumb path  **/
		$file      = explode('/',$image);
		$thumbName = "";
		$link      = "";
		$c         = 0;
		for($t =0; $t < count($file); $t++){
			
			if($t <= 6){
				$link .= $file[$t].'/';
			}
			
			if($t == count($file)-1){
				$thumbName =$file[$t] ;
			}
			
			$c++;
		}
		$link = substr($link,0,-1);
		
		/** Resize to 150 x 150 **/
		resize('public/'.$link, $thumbName,'150','public/'.$link.'/thumb');
		
		
	}
	

}
?>
