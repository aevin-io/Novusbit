<?php

class Feedback_controller extends CI_Controller
{
	public function index()
	{
		$data['uri'] = $_POST['uri'];
		
		$this->Tank_auth->validate_logged_user( $data ); 
		$this->load->view( 'global/feedback/feedback_view', $data );	
	}
	
	public function store_feedback()
	{
	    
	    try {
			$feedback_bean            	= $this->rb->dispense( 'feedback' );
			$feedback_bean->subject  	= $_POST['subject'];
			$feedback_bean->description    	= $_POST['description'];
			//$feedback_bean->resolution 	= $_POST['resolution'];
			$feedback_bean->user	 	= $_POST['user']; 
			$feedback_bean->uri	 	= $_POST['uri'];
			$feedback_bean->resolved	= "N";
			
			$this->rb->store( $feedback_bean );
			
			$this->load->library('email');
			$email_setting  = array('mailtype'=>'html');
			$this->email->initialize($email_setting);
	
	
			$data['site_name'] = $this->config->item('website_name', 'tank_auth');
			$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
			$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
			$this->email->to("hello@novusbit.com");
			$this->email->subject("New Feedback from Novusbit", $this->config->item('website_name', 'tank_auth'));
			$this->email->message($_POST['description'], $data, TRUE);
			$this->email->set_alt_message("you got new feedback", $data, TRUE);
			$this->email->send();
		
		}
		catch ( Exception $e ) {
		}
	    
	    redirect('/');
	}
	
}