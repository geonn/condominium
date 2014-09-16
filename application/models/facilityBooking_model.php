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
		$details = $this->_extractDetails($result);
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $details[0];	
		return $this->_result;
	}
	
	public function cancelled(){
		$data = array(
			'status' => 2,
			'updated' => date('Y-m-d H:i:s')
		);
		
		$this->update($this->param['fb_id'], $data);
		/*** return response***/
		$this->_result['status']     = 'success';
		return $this->_result;
	}
	
	public function getByUser($u_id){
		$filter = array(
			'u_id'  => $u_id
		);
		
		$result = $this->get_data($filter);
		$details = $this->_extractDetails($result);
		
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $details;	
		return $this->_result;
	}
	
	public function getFacilityBookingByDay($date, $resident){
		$time_arr = $this->config->item('time_range');
		
		$options = $this->facilityOptions_model->getChildById($this->param['bookingFacility']);
		$totalOptions = count($options['data']);
			
		$filter = array(
			'bookDate' => $date,
			'f_id'            => $this->param['bookingFacility']
		);
		
		$result = $this->get_data($filter);
		
		$avail = array();
		foreach($time_arr  as $k => $val){
			$avail[$k]['time'] = $val;
			$avail[$k]['booking'] = 0;
			$avail[$k]['userBooked'] = 0;
			$avail[$k]['availability'] = 1;
		}
		
		foreach($result  as $r => $ral){
			if($ral['status'] == 1){
				$avail[$ral['bookTime']]['booking']++;
				
				if($ral['u_id'] == $resident){
					$avail[$ral['bookTime']]['userBooked'] = 1;
					$avail[$ral['bookTime']]['userInfo'][$r]['fb_id'] = $ral['fb_id']; 
					$opt = $this->facilityOptions_model->getById($ral['fo_id']);
					$avail[$ral['bookTime']]['userInfo'][$r]['options'] = $opt['data']['option']; 
				}
				
				if($avail[$ral['bookTime']]['booking'] >= $totalOptions){
					$avail[$ral['bookTime']]['availability'] = 2;
				}	
			}
		}
		//print_pre($avail);
		return $avail;
	}
	
	public function getFacilityBookingHistoryByDay($date){
		$time_arr = $this->config->item('time_range');
		
		$fac = $this->facility_model->get();
		$facs = array();
		foreach( $fac['data'] as $k => $val){
			$facs[] = $val['f_id'];
		}
		$facilities = implode(',', $facs);
		
		$filter = "(f_id IN (".$facilities.") AND bookDate ='".$date."')";
		$result = $this->get_data($filter);
		//print_pre($result);
		$avail = array();
		foreach($time_arr  as $k => $val){
			$avail[$k] = array();
		}
		
		$details = $this->_extractDetails($result);
		$count = 0;
		foreach($details  as $r => $ral){
			$count = count( $avail[$ral['bookT']]);
			$avail[$ral['bookT']][$count] = $ral; 
			$count++;
		}
		return $avail;
		
	}
	
	public function getByProperty($p_id){
		$fac = $this->facility_model->getByProperty($p_id);
		
		$facilities  = array();
		foreach($fac['data'] as $k => $val){
			$facilities[] = $val['f_id'];
		}
		$facility = implode(',' , $facilities);
		
		$filter = "f_id IN (".$facility.")";
		$result = $this->get_data($filter);
		$details = $this->_extractDetails($result);
		/*** return response***/
		$this->_result['status']     = 'success';
		$this->_result['data']       = $details;	
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
			'status' => 1
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
			
			$user = $this->user->get_memberid();
			if(!empty($this->param['bookingUser'])){
				$user = $this->param['bookingUser'];
			}
			
			$bookingTimes = $this->_checkUserBookingTimes($user);
			$resi = $this->residents_model->getByUser($this->user->get_memberid());
			$prop = $this->property_model->getById($resi['data']['p_id']);
			if($bookingTimes > $prop['data']['facility_book'] ){
				/*** return response***/
				$this->_result['status']     = 'error';
				$this->_result['error_code'] = 141;
				$this->_result['data']       = $this->code[141];	 
				return $this->_result;
			}
			
			$data = array(
				'f_id' => $this->param['bookingFacility'],
				'fo_id' => $pick,
				'u_id'  => $user,
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
				$this->_result['error_code'] = 138;
				$this->_result['data']       = $this->code[138];	 
				return $this->_result;
			}
		}
	}
	
	public function reActivateBooking(){
		/***retrieve booking info***/
		$filter = array(
			$this->primary_key => $this->param['fb_id']
		);
		$result = $this->get_data($filter);
		
		if(!empty($result)){
			/***Check if someone took the book***/
			$check = array(
				"f_id"   => $result[0]['f_id'],
				"fo_id" => $result[0]['fo_id'],
				"bookDate" => $result[0]['bookDate'],
				"bookTime" => $result[0]['bookTime'],
				"status" => 1
			);
			$res = $this->get_data($check);
		
			if(!empty($res)){
				/*** return response***/
				$this->_result['status']     = 'error';
				$this->_result['error_code'] = 137;
				$this->_result['data']       = $this->code[137];	
				
			}else{
				$data = array(
					'status' => 1,
					'updated' => date('Y-m-d H:i:s')
				);
				
				$this->update($this->param['fb_id'], $data);
				/*** return response***/
				$this->_result['status']     = 'success';
			}
		}
		
		return $this->_result;
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
	
	private function _checkUserBookingTimes($u_id){
		$filter = array(
			'u_id' => $u_id,
			'status' => 1,
			'DATE(created)' => date('Y-m-d')
		);
		
		$res = $this->get_data($filter);
		
		return count($res);
	}
	
	private function _extractDetails($result=array()){
		foreach($result as $k => $val){
			/**Extract User Info**/
			$user = $this->users_model->getById($val['u_id']);
			$result[$k]['user'] = $user['data'];
			
			$facility = $this->facility_model->getById($val['f_id']);
			$result[$k]['facility'] = $facility['data']['name'];
			
			/**Extract Booking Facility**/
			$facility = $this->facility_model->getById($val['f_id']);
			$result[$k]['facility'] = $facility['data']['name'];
			
			/**Extract Booking Facility Options**/
			$options = $this->facilityOptions_model->getById($val['fo_id']);
			$result[$k]['options'] = $options['data']['option'];
			$result[$k]['bookT']   = $val['bookTime'];
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
			
			$startDateInfo = date_convert( $val['bookDate'] . " ". $startTime[0] .":00:00","complete");
			$di = explode(',', $startDateInfo);
			$result[$k]['day'] = $di[0]; 
			$result[$k]['date'] = $di[1]; 
			$result[$k]['start_time'] = strtoupper($di[2]); 
			
			$endDateInfo = date_convert( $val['bookDate'] . " ". $endTime[0] .":00:00","complete");
			$di2 = explode(',', $endDateInfo);
			$result[$k]['end_time'] = strtoupper($di2[2]); 
			
			$result[$k]['status'] =match($val['status'], $this->config->item('booking_status'));
			if($val['status'] == "1"){
				$result[$k]['className'] = "event-offsite";
			}else{
				$result[$k]['className'] = "event-cancelled";
			}
		}
		
		return $result;
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
