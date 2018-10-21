<?php
	/**
	 * CodeIgniter Facebook Connect Graph API User Model 
	 * 
	 * Author: Graham McCarthy (graham@hitsend.ca) HitSend inc. (http://hitsend.ca)
	 * 
	 * VERSION: 1.0 (2010-09-30)
	 * LICENSE: GNU GENERAL PUBLIC LICENSE - Version 2, June 1991
	 * 
	 **/
 class User_model extends CI_Model {
   var $user_id = "";
   var $full_name = "";
   var $pwd = "";
   var $fb_uid = "";
   


   function validate_user_facebook($uid = 0) {
		//confirm that facebook session data is still valid and matches
		$this->load->library('fb_connect');
		 //echo "ime edo<br><br><br>";
   		//see if the facebook session is valid and the user id in the sesison is equal to the user_id you want to validate
		$session_uid = 'fb:' .  $this->fb_connect->user_id;
		
		// echo $session_uid;
		if(!$this->fb_connect->fbSession || $session_uid != $uid ) {
   	  		return false;
		}
       // echo "EDOO!<br><br><br>";
   	  	//Receive Data
      	$this->user_id    = $uid;

      //See if User exists
      $this->db->where('user_id', $this->user_id);
      $q = $this->db->get('user');
     $id=0;
     foreach ( $q->result() as $row)
{
    $id = $row->id;
}
      if($q->num_rows == 1) {
         //yes, a user exists,
	 // =================
			
			$user_bean = $this->rb->load( 'user', $id );
				
				$a = new RedBean_AssociationManager($this -> rb ->toolbox);
				
				$related_author_arr = ( $this -> rb -> batch("author", $a ->related( $user_bean, "author" )));
				
				$auth_id = 0;
				$auth_name = "";
				
				foreach ($related_author_arr as $oneauthor ){
					 $oneauthor -> export();
					$auth_id = $oneauthor -> id ;
					$auth_username = $oneauthor -> username ;
					
				}
				$identity_column = $this->config->item('identity');
				$this->session->set_userdata('username',  $auth_username );
				$this->session->set_userdata('user_id',  $auth_id );
				$this->session->set_userdata('fb_user',  'yes' );
				$this->session->set_userdata('fb_uid',  $uid );
				
			// ==================
			
		 return true;
      }

      //no user exists
      return false;
   }
     
   function create_user() {
	/*
      $this->user_id       	= $db_values["user_id"];
      $this->full_name  	= $db_values["full_name"];
      $this->pwd           	= md5($db_values["pwd"]);
      
      if(strlen($db_values['fb_uid']) > 0) {
      	$this->fb_uid 	   = $db_values['fb_uid'];
      } else {
      	 $this->fb_uid = "";
      }
	*/
	$this->load->library('fb_connect');
	$fb_usr = $this->fb_connect->user;
	
	//$uid = $this->fb_connect->fbSession['uid'];
	
	$uid = $this->fb_connect->fbSession;
	
		
      
      $new_user_data = array(
          'email'  => $fb_usr["email"],
          'full_name'  => $fb_usr["name"],
          'user_id' => "fb:".$this->fb_connect->user_id //<---change
      );

      $insert = $this->db->insert('user', $new_user_data);
      
      $id = $this->db->insert_id();
      
      
      	$user_bean = $this -> rb -> load('user', $id );
		

		$author_bean = $this -> rb -> dispense( 'author' );

		$author_bean -> first_name 	= $fb_usr["first_name"];
		$author_bean -> last_name 	= $fb_usr["last_name"];
		$author_bean -> username 	= $this->input->post('alias');
		$author_bean -> email 		= $fb_usr["email"];
		$author_bean -> date_registered = mdate("%Y-%m-%d %h:%i:%s", time());		
		$author_bean -> registered 	= 'Y';
		
		$this -> rb -> store( $author_bean );
		
		
		$a = new RedBean_AssociationManager( $this -> rb -> toolbox );        
		$a -> associate($author_bean, $user_bean);
	
		
		$user_bean = $this->rb->load( 'user', $id );
				
				$a = new RedBean_AssociationManager($this -> rb ->toolbox);
				
				$related_author_arr = ( $this -> rb -> batch("author", $a ->related( $user_bean, "author" )));
				
				$auth_id = 0;
				$auth_name = "";
				
				foreach ($related_author_arr as $oneauthor ){
					 $oneauthor -> export();
					$auth_id = $oneauthor -> id ;
					$auth_username = $oneauthor -> username ;
					
				}
				$identity_column = $this->config->item('identity');
				$this->session->set_userdata('username',  $auth_username );
				$this->session->set_userdata('user_id',  $auth_id );
				$this->session->set_userdata('fb_user',  'yes' );
				$this->session->set_userdata('fb_uid',  $uid );

      return $insert;
		
   }
   
   function get_user_by_fb_uid($fb_uid = 0) {
	   	//returns the facebook user as an array.
	   	$sql = " SELECT * FROM user WHERE 0 = 0 AND user_id = ?";
	   	$usr_qry = $this->db->query($sql, array('fb:'.$fb_uid));
	   	
	   	if($usr_qry->num_rows == 1) {
	   		//yes, a user exists
	   		return $usr_qry->result();
	   	} else {
	   		// no user exists
	   		return false;
	   	}
   }	
 }