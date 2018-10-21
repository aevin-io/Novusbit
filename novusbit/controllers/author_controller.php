<?php
class Author_controller extends CI_Controller
{
	public $current_author;
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	    
	public function my( $where = 'account' )
	{
		if ( logged() )
		{
			$t['title'] = 'Welcome to Novusbit | Sing up and start your writing career!';
			
			$data = array();
			
			$this->load->view( 'account/menu' );
			
			if ( $where == "profile" )
			{
				$auth_id		= $this->session->userdata( 'user_id' );
				$author_bean	= $this->rb->load( 'author', $auth_id );
				$data['author'] = $author_bean->export();
			}
			
			$this->load->view( 'account/' . $where, $data );
				
		}
		else
			redirect('/home_controller/signup');
	}
		
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
		
	public function update_profile ( $author_id )
	{
	 
		$author_bean = $this -> rb -> load('author', $author_id );		
	
		$author_bean -> first_name 	= $this->input->post('first_name');
		$author_bean -> last_name 	= $this->input->post('last_name');
		$author_bean -> username 	= $this->input->post('username');
		$author_bean -> email 		= $this->input->post('email');
		
		$this->config->load('novusbit');
		$f = $this->config->item('author_image_upload') ;
				
		
		$this->load->library( 'upload',$f );
		
				
						
		if ( !$this->upload->do_upload() ) {
		if( $this->upload->display_errors()  != "You did not select a file to upload." )
		{
		  
		}
		else
		{
		
		}
			
		}
		else
		{
			$image_data					  = $this->upload->data();
			$img_config['image_library']  = 'gd2';
			$img_config['source_image']	  = 'uploads/authors/' . $image_data['file_name'];
			$img_config['create_thumb']	  = FALSE;
			$img_config['maintain_ratio'] = TRUE;
			$img_config['width']		  = 150;
			$img_config['height']		  = 130;
			
			
			$this->load->library( 'image_lib' );
			$this->image_lib->initialize( $img_config );
			
			if ( !$this->image_lib->resize() )
			{
					echo $this->image_lib->display_errors();	
			}
			
			else
			{
					$config['image_library']  = 'gd2';
					$config['source_image']	  = 'uploads/authors/' . $image_data['file_name'];
					$config['maintain_ratio'] = FALSE;
					$config['width']		  = 100;
					$config['height']		  = 100;
					
					$this->image_lib->initialize( $config );
					$this->image_lib->crop();
			}
			
			$filename = $image_data['file_name'];
			$author_bean -> picture = $filename;
		
		}
	
		$this -> rb -> store( $author_bean );
		redirect('#/profile');
		 
	}
		
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function view_author( $author_username = NULL )
	{
		   		
		if( $author_username == NULL ){
					 $author_username = $this->uri->segment( 1 );  
					 $this->view_author( $author_username );
					 return;
				}
				
			 
			   $auth = $this->author_model->get_author_by_username( $author_username );
				
		if ( $auth != FALSE )
				{
			$auth_data['author']	 = $auth->export();
						$this->Tank_auth->validate_logged_user( $auth_data );
					   
							 if ( logged() ){
						
						$auth_data['friends'] = extract_beans( $this->author_model->find_my_friends(true) );
							 }
			$this->load->view( 'author/profile', $auth_data );
		}
				else
				{
			$this->load->view( 'nouser_view' );
		}		 
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function author_contents_page( $author_username, $location="" )
	{
	 
	 $auth = $this->author_model->get_author_by_username( $author_username );
	// echo $location ;
	 //die();
	 switch ( $location ) {
		
				case "":
				case "undefined":
				case "novus":

				$this->Tank_auth->validate_logged_user( $n_data );
				$n_data['novuses'] = ( $this->author_model->find_my_novus() );
				$n_data['novuses'] = array_reverse($n_data['novuses'] );
				$this->pagenumber($n_data);

				$this->load->view( 'novuses_view', $n_data );
				break;

				case "watching":
							 $this->Tank_auth->validate_logged_user( $f_data );
			if ( $f_data['owner'] == $author_username || $f_data['owner'] == "power_user" )
				$f_data['friends'] = extract_beans( $this->author_model->friends_and_notices() );
			else
				$f_data['friends'] = extract_beans( $this->author_model->find_my_friends() );
								
				$this->load->view( 'author/friends', $f_data );
				break;

				case "watchedby":
								
								$f_data['friends'] = extract_beans( $this->author_model->find_my_followers() );
				$this->load->view( 'author/followedby', $f_data );
				break;

				case "appreciations":
				case 'likes':
				$a_data['title'] = "My appreciations";
								$this->Tank_auth->validate_logged_user( $a_data );
			  //  $a_data['novuses'] = extract_beans( $this->author_model->find_my_appreciated_novus() );
								$a_data['novuses'] = $this->author_model->find_my_appreciated_novus();
								$this->pagenumber($a_data);
								$a_data['novuses'] = array_reverse($a_data['novuses'] );
				$this->load->view( 'novuses_view', $a_data );
				break;

				case "bits":
								$a_data['title'] = "My bits";
				$b_data['bits'] = extract_beans( $this->author_model->find_my_bits() );
				$this->load->view( 'author/bits', $b_data );
				break;

				default:

				break;
		}
	}
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 	
	private function pagenumber(&$data){
		 parse_str($_SERVER['QUERY_STRING'], $_GET);
		 if(isset($_GET['page'])) $pageno = $_GET['page']; else $pageno = 1;
		 $data['pageno'] = $pageno;
		 return $pageno;
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 	
		public function remove_fb_author(){
		 
			$auth_id		   = $this->session->userdata( 'user_id' );
			$author_bean	= $this->rb->load( 'author', $auth_id );
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			

			$related_user_arr = ( $this -> rb -> batch("user", $a ->related(	 $author_bean, "user" )));

			$fb_id		 = $this->session->userdata( 'fb_uid' );
			$user_bean	  = get_bean( $related_user_arr );
			
			$a->unassociate( $author_bean, $user_bean );

			$this->rb->trash( $user_bean );

			redirect('/signout');

		}
		
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function add_to_watch( $watch_auth_id )
	{
		$this->author_model->assign_watcher( $watch_auth_id );
				// should now see if error found and show the view...
		//redirect( $this->redux_auth->profile()->username."/watching" );
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 		
	public function hide_notice( $novus_id )
	{
		$this->author_model->hide_notice( $novus_id );
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function unwatch_author( $watch_auth_id )
	{
		$this->author_model->unassign_watcher( $watch_auth_id );
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 	
	public function check_if_exists( $username ){
		return check( $username );
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function email_notification( $setting, $value )
	{
		
				
				$a       	= new RedBean_AssociationManager( $this->rb->toolbox );
				$adp     	= $this->rb->toolbox->getDatabaseAdapter();	
				$author_id	= $this->session->userdata( 'user_id' );
		
				$sql     	= "SELECT * FROM setting WHERE author_id =". $author_id;
				
				$fb_user 	= $adp->getRow( $sql );
		
				if( empty( $fb_user ) )
				{
					$setting_bean = $this->rb->dispense( 'setting' );
					switch( $setting )
					{
						case "new_novus":	
							$setting_bean->email_new_novus 		= $value;
						break;
						case "bits":
							$setting_bean->email_bits 		= $value;
						break;
						case "bits_my":
							$setting_bean->email_bits_my 	= $value;
						break;
					}				
					$setting_bean->author_id = $author_id;
					$this->rb->store( $setting_bean );

				}
				else
				{
					$sql     = "update setting set email_".$setting. "='".$value. "' where author_id=".$author_id;
					$adp->exec( $sql );
				}

	}






	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function ajaxValidateUsername(){
		$validateValue=$_REQUEST['fieldValue'];
		$validateId=$_REQUEST['fieldId'];
		
		
		$validateError= "This username is already taken";
		$validateSuccess= "This username is available";
		
		
		
			/* RETURN VALUE */
			$arrayToJs = array();
			$arrayToJs[0] = $validateId;
		
		if( $this->author_model->get_author_by_username(	$validateValue	) == FALSE ){		// validate??
			$arrayToJs[1] = true;			// RETURN TRUE
			echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
		}else{
			for($x=0;$x<1000000;$x++){
				if($x == 990000){
					$arrayToJs[1] = false;
					echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
				}
			}
			
		}
		}

}
