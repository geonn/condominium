<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/********************
****API AUTH Key****
********************/
$config['api_key'] = array(
	'web'    => '981bce3f4b506c6eb5473debb3275c27',
	'app'     => '06b53047cf294f7207789ff5293ad2dc',
);

/**********************
****API AUTH Param****
**********************/
$config['api_param'] = array(
	'user' , 'key'
);

/**********************
API Return code message
**********************/
$config['api_code'] = array(
	  1	  => 'Success',
	100	  => 'No Result',
	101   => 'Your account are inactive. Please contact administrator to seek for assistant.',
	102   => 'Duplicate',
	103   => 'Empty username',
	104   => 'Empty user first name',
	105   => 'Invalid email',
	106   => 'Empty password',
	107   => 'Both password must same',
	108   => 'Please choose property',
	109   => 'Invalid verification code',
	110   => 'Empty weekend working hours',
	111   => 'Empty order destination area',
	112   => 'Empty order destination location',
	113   => 'Empty order product',
	114   => 'No user',
	
	120   => 'Missing property name',
	121   => 'Missing property contact number',
	1211   => 'Missing property contact person',
	122   => 'Missing facility name',
	123   => 'Missing facility options',
	124   => 'Missing residents unit lots',
	125   => 'Missing book date',
	126   => 'Missing book time',
	127   => 'Missing sender ID',
	128   => 'Missing receiver ID',
	129   => 'Wrong password',
	130   => 'Title cannot be empty',
	131   => 'Announcement content cannot be empty',
	132   => 'Missing maintenance duration',
	133   => 'Missing maintenance total amount',
	135   => 'Login fail',
	136   => 'Message cannot be empty',
	137   => 'This court was taken by someone. Try book for another time.',
	138   => 'Booking Full. Please choose others date or time.',
	139   => 'Payment maintenance ID is missing',
	140   => 'Payment amount is missing',
	141   => 'Exceeded daily booking limit',
	160   => 'No session param passed.',	
	162	  => 'Can\'t retrieved user session. Please login again.',
	170   => 'User is banned for review',
	180   => 'Unknown error. Could be connection problem or server down.',
	188	  => 'User param or API key param is missing',
	190	  => 'Invalid user',
	192	  => 'Wrong user key provided',

	
);

/* End of file config_api.php */
/* Location: ./application/config/config_api.php */
