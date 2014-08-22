<?php
class FacilityBooking_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "facilitiesBooking";
		$this->primary_key = 'fb_id';	
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getById(){
		$filter = array(
			$this->primary_key => $this->param['fb_id']
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result[0];	
		return $this->_result;
	}
	
	public function getByUser($u_id){
		$filter = array(
			'u_id'  => $u_id
		);
		
		$result = $this->get_data($filter);
		
		foreach($result as $k => $val){
			/**Extract Booking Facility**/
			$facility = $this->facility_model->getById($val['f_id']);
			$result[$k]['facility'] = $facility['data']['name'];
			
			/**Extract Booking Facility Options**/
			$options = $this->facilityOptions_model->getById($val['fo_id']);
			$result[$k]['options'] = $options['data']['option'];
			
			$result[$k]['bookTime'] = match($val['bookTime'], $this->config->item('time_range'));
			/**Extract Booking Date**/
			$bookDate = explode('-', $val['bookDate']);
			$result[$k]['bookYear'] = $bookDate[0];
			$result[$k]['bookMonth'] = $bookDate[1];
			$result[$k]['bookDay'] = $bookDate[2];
			
			/**Extract Booking Time**/
			$result[$k]['bookTime'] = match($val['bookTime'], $this->config->item('time_range'));
			$bookTime = explode(' - ', $result[$k]['bookTime']);
	
			$startTime = explode(':', $bookTime[0]);
			$result[$k]['startTime'] = $startTime[0];
			
			$endTime = explode(':', $bookTime[1]);
			$result[$k]['endTime'] = $endTime[0];
			
		}
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}

	public function getByFacility($f_id){
		$filter = array(
			'f_id'  => $f_id
		);
		
		$result = $this->get_data($filter);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $result;	
		return $this->_result;
	}
	
	public function checkAvailablity(){
		$filter = array(
			'f_id' => $this->param['bookingFacility'],
			'bookDate' => $this->param['bookingDate'],
			'bookTime' => $this->param['bookingTime'],
		);
		
		$result = $this->get_data($filter);
		
		/***get facility options***/
		$options = $this->facilityOptions_model->getChildById($this->param['bookingFacility'], 1);
		
		if(empty($result)){
			$pick = "";
			if(!empty($options)){
				/***Assign an option for the booking***/
				$pick = $options['data'][0]['fo_id'];
			}
			
			$data = array(
				'f_id' => $this->param['bookingFacility'],
				'fo_id' => $pick,
				'u_id'  => $this->user->get_memberid(),
				'bookDate' => $this->param['bookingDate'],
				'bookTime' => $this->param['bookingTime'],
				'status'        => 1,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s'),
			);
			
			$id = $this->insert($data);
			 
			/*** return response***/
			$this->_result['status']     = 'success';
			$this->_result['data']       = $id;	
			return $this->_result;
		}else{
			//check options	
			$op = array();
			$pick = "";
			if(!empty($options)){
				foreach($options['data'] as $b => $bal){
					$op[$bal['fo_id']] = $bal['fo_id'];
				}
			}
			
			foreach($result as $p => $pal){
				if(in_array($pal['fo_id'], $op)){
					unset($op[$pal['fo_id']]);
				}
			}
			
			if(count($op) > 0){
				$count = 0 ;
				foreach($op as $opt){
					if($count  == 0) {
						$data = array(
							'f_id' => $this->param['bookingFacility'],
							'fo_id' => $opt,
							'u_id'  => $this->user->get_memberid(),
							'bookDate' => $this->param['bookingDate'],
							'bookTime' => $this->param['bookingTime'],
							'status'        => 1,
							'created' => date('Y-m-d H:i:s'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
						$id = $this->insert($data);
						$count++;
					}
				
				}
				/*** return response***/
				$this->_result['status']     = 'success';
				$this->_result['data']       = $id;	
				return $this->_result;
			}else{
				/*** return response***/
				$this->_result['status']     = 'error';
				$this->_result['data']       = "Booking Full. Please choose others date or time.";	
				return $this->_result;
			}
		}
		
		
	}
	
	public function add(){
		$data = array(
			'f_id'              => $this->param['f_id'],
			'fo_id'            => $this->param['fo_id'],
			'u_id'             => $this->param['u_id'],
			'bookDate'   => $this->param['bookDate'],
			'bookTime'  => $this->param['bookTime'],
			'remark'       => $this->param['remark'],
			'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
			'created'       => date('Y-m-d H:i:s'),
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$id = $this->insert($data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $id;	
		return $this->_result;
	}
	
	public function edit(){
		$data = array(
			'bookDate'   => $this->param['bookDate'],
			'bookTime'  => $this->param['bookTime'],
			'remark'       => $this->param['remark'],
			'status'          => !empty($this->param['status']) ? $this->param['status'] : 1,
			'updated'      => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['fb_id'], $data);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $this->param['fb_id'];	
		return $this->_result;
	}
	
	public function remove(){
		$this->delete($this->param['fb_id']);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	/*** Do checking before send to database***/
	private function validate(){
		$statusCode     = array();
		$bookDate       = $this->param['bookDate'];
		$bookTime       = $this->param['bookTime'];
		
		if(empty($bookDate)){
			$statusCode[] = 125;
		}
		
		if(empty($bookTime)){
			$statusCode[] = 126;
		}
		
		return $statusCode;
	}
}
?>
