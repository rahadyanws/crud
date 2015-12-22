<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('message_result'))
{
    function message_result($var = '')
    {
    	$CI = get_instance();
		if (empty($var)) {
			//error_log("error empty");
			$CI->session->set_flashdata('message', 'Failed Connected Server');
			return "empty";
		} else {
			//error_log("error lain");
			return "fill";
		}
	}
}