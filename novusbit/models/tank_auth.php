<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tank_auth_model extends CI_Model
{
	function validate_logged_user( &$data )
	{
		
		$current_logged_status = logged();
		
		//$ci = & get_instance();
		//$ci->load->library('fb_connect');
		//$fb_usr = $ci->fb_connect->user;
		
	
                if ( $current_logged_status  )
			$current_logged_username = $this->ci->session->userdata('username'); //->username;
			//else
			//$current_logged_username = $ci->session->userdata( 'username' );
		
                
                if ( $current_logged_status )
                {
			$data['auth'] = "authorized";
			
			if ( $current_logged_username == 'admin' )
                        {
				$data['owner'] = "power_user";
                        }
			else
                        {
				$data['owner'] = $current_logged_username;
			}
                }
                else
                {
			$data['auth'] = $data['owner'] = "anonymous";
                }

	}
}