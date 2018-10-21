<?php

class Notification_Model extends CI_Model
{
	
	public function notify_by_email( $nvsid ){
		
		$userid = $this->session->userdata( 'user_id' );
		$runningnvs = $this->novus_model->get_novus_by_key( $nvsid );
		$runningnvs = $runningnvs->export();
		$authid 	= $runningnvs['author_id'];
		$authmail 	= $runningnvs['author_email'];
		
		if(  $userid != $authid )	
		{
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$settings = $a->getRow( "SELECT * FROM setting WHERE author_id = " . $authid  );
				
			if( empty( $settings ) || $settings['email_bits'] == "on" )
			{			
				$data['site_name'] = $this->config->item('website_name', 'tank_auth');
				$this->send_email('new_bits', $authmail, $data);
			}
			
			if( empty( $settings ) || $settings['email_bits_my'] == "on" )
			{			
				
				$a = $this->rb->toolbox->getDatabaseAdapter();
				$sql = "SELECT author.email, author.id FROM novus_appreciations, author WHERE novus_appreciations.author_id = author.id AND novus_appreciations.novus_id = ". $nvsid ;
				$email_of_likes = $a->get( $sql );

				
				foreach( $email_of_likes as $one_email )
				{
						$a = $this->rb->toolbox->getDatabaseAdapter();
						$settings = $a->getRow( "SELECT * FROM setting WHERE author_id = " . $one_email['id']  );
							
						if( empty( $settings ) || $settings['email_bits_my'] == "on" )
						{			
							$data['site_name'] = $this->config->item('website_name', 'tank_auth');
							$this->send_email_likes('new_bits', $one_email['email'], $data);
							
							
							
							//echo "Send an email to ".$one_email['email'];
						}			
				 }
						
			}
		}
	}
	
	public function send_mail_new_novus(){
		$this->load->library('email');
		$email_setting  = array('mailtype'=>'html');
		$this->email->initialize($email_setting);


		$data['site_name'] = $this->config->item('website_name', 'tank_auth');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to("hello@novusbit.com");
		$this->email->subject("New Novus", $this->config->item('website_name', 'tank_auth'));
		$this->email->message($_POST['title'], $data, TRUE);
		$this->email->set_alt_message($_POST['title'], $data, TRUE);
		$this->email->send();
	}
	
	public function send_mail_new_member($data){
		$this->load->library('email');
		$email_setting  = array('mailtype'=>'html');
		$this->email->initialize($email_setting);


		$data['site_name'] = $this->config->item('website_name', 'tank_auth');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to("hello@novusbit.com");
		$this->email->subject("New Member", $this->config->item('website_name', 'tank_auth'));
		$this->email->message($data['email'], $data, TRUE);
		$this->email->set_alt_message($data['email'], $data, TRUE);
		$this->email->send();
								
	}
	
		private	function send_email_likes($type, $email, &$data)
	{
		//echo "send mail called....";
		
		$this->load->library('email');
		$email_setting  = array('mailtype'=>'html');
		$this->email->initialize($email_setting);

		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject("New bits on your liked novus", $this->config->item('website_name', 'tank_auth'));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
	
	private	function send_email($type, $email, &$data)
	{
		//echo "send mail called....";
		
		$this->load->library('email');
		$email_setting  = array('mailtype'=>'html');
		$this->email->initialize($email_setting);

		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject("New bits on your novus", $this->config->item('website_name', 'tank_auth'));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}