<?php

class Bit_controller extends CI_Controller
{	
	public function appreciate( $novus_id, $bit_id )
	{
		try {
			$appr_bean            = $this->rb->dispense( 'bit_likes' );
			$appr_bean->novus_id  = $novus_id;
			$appr_bean->bit_id    = $bit_id;
			$appr_bean->author_id = $this->session->userdata( 'user_id' );
			$this->rb->store( $appr_bean );
		}
		catch ( Exception $e ) {
		}
	}
	
	public function spam( $novus_id, $bit_id )
	{
		try {
			$spam_bean            = $this->rb->dispense( 'bit_spam' );
			$spam_bean->novus_id  = $novus_id;
			$spam_bean->bit_id    = $bit_id;
			$spam_bean->author_id = $this->session->userdata( 'user_id' );
			$this->rb->store( $spam_bean );
		}
		catch ( Exception $e ) {
		}
	}
	
	public function remove_bit( $nid, $bid )
	{		
		$bit_bean = $this->rb->load( 'bits', $bid );
		$tmp      = $bit_bean;
		$this->bit_model->find_my_author( $tmp );
		$data['bit'] = $tmp->export();
		
		$this->Tank_auth->validate_logged_user( $data ); 
		$userid = $this->session->userdata( 'user_id' );
		if ( $data['owner'] != "power_user" && $userid != $data['bit']['author']['id'] )
			die( "You're trying to remove a bit which is not yours. That's not cool." );

		$this->novus_model->remove_bit( $bid, $nid );
		
		 $this->novus_model->reset_lastbitcount( $nid );
		 $this->novus_model->reset_lastbitcount_my( $nid );
	}
}

