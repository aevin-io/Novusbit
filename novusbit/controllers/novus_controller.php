<?php

class Novus_controller extends CI_Controller
{
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	public function view_novus( $id )
	{

		if( $current_novus = $this->novus_model->get_novus_by_key( $id ) )
		{
			$this->novus_model->increase_views( $id );

			$this->Tank_auth->validate_logged_user( $data );

			if ( logged() ){
				$this->reset_lastbit_count( $id );
				$this->author_model->hide_notice( $id );
				$data['friends'] = extract_beans( $this->author_model->find_my_friends(true) );
				$data['apnovuses'] = $this->author_model->find_my_appreciated_novus(true);
			}

			$data['novus'] 		= $current_novus->export();
			$data['bits'] 		= extract_beans( $this->bit_model->find_bits( $current_novus ) );
			$desc = $data['novus']['description'];
			
			$data['keywords'] 	= $this->get_keywords( $data['bits'],$desc );
			$data['auth_id']	= $this->session->userdata( 'user_id' );
			
			if( $data['novus']['type_title'] == 'Irriversable' ) $this->get_irreversable ( $data );

			$this->load->view( 'novus_view', $data );
		}
		else
			$this->load->view( 'novus/unavailable_novus_view' );

	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function reset_lastbit_count( $id )
	{
		 $this->novus_model->reset_lastbitcount( $id );
		 $this->novus_model->reset_lastbitcount_my( $id );
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	
	public function next_previous_novus( $id )
	{	 	
		if( is_numeric( $id ) ){
			$data = $this->novus_model->conclude_next_previous( $id );
			echo $this->load->view( 'novus/nextprevious.inc.php', $data, true);
		}
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function remove_novus( $id )
	{
		$this->protect( $id );
		
		$novus_bean = $this->rb->load( 'novus', $id );
		$this->novus_model->remove_novus( $novus_bean );
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
/*
	public function store_comment()
	{
		if ( !logged() ) return false;

		$nvsid  = $_POST['nid'] ;
		$userid = $this->session->userdata( 'user_id' );
		
		$curnvs = $this->rb->load( 'novus', $nvsid );
		$author = $this->rb->load( 'author', $userid );

		$comment_bean = $this->novus_model->create_comment();
						$this->novus_model->assign_comment_author( $author, $comment_bean );
						$this->novus_model->append_comment( $comment_bean, $curnvs );
		
		redirect( $nvsid );
	}
*/
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function start_new_novus( $category = null ) 
	{
		$data['categories'] = $this->novus_model->get_categories();
		$data['types'] 		= $this->novus_model->get_types();
			
		if( $category != null ) $data['create_in'] = $category;
			
		$this->load->view( 'novus_update_view', $data );		
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function store_new_novus()
	{
		if ( !logged() ) return false;
		
		$image	= $this->cover_upload();	
		$novus  = $this->novus_model->create_novus( $image );							
		
		$this->notification_model->send_mail_new_novus();
		
		redirect( '#/' );
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function store_new_bit()
	{
		if ( !logged() ) return false;
				
		$nvsid = $_POST['nid'];
		
		$userid = $this->session->userdata( 'user_id' );
		$curnvs = $this->rb->load( 'novus', $nvsid );
		$author = $this->rb->load( 'author', $userid );

		$bit_bean = $this->bit_model	->create_bit(); 							// Create and Store the bit body	
					$this->bit_model	->assign_author( $author, $bit_bean ); 		// Assign the author to the bit	
					$this->novus_model	->append_bit( $bit_bean, $curnvs ); 		// Assign the bit to the Novus
		
		$this->reset_lastbit_count( $nvsid );
		$this->author_model->hide_notice( $nvsid );
		
		echo $_POST['body'];
		
		$this->notification_model->notify_by_email( $nvsid );
	}
	
	
	

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function update_novus( $id )
	{
		$this->protect( $id );
		
		if ( isset( $_POST['commit'] ) )
		{
			$this->novus_model->update_novus( $id );
			redirect( $id );
		}
		else
		{
			$data['novus'] 		= $this->novus_model->get_novus_by_key( $id )->export();
			$data['categories'] = $this->novus_model->get_categories();
			$data['types'] 		= $this->novus_model->get_types();
			
			$this->load->view( 'novus_update_view', $data );
		}
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function end_novus( $id )
	{
		$this->protect( $id );

		$novus_bean	= $this->rb->load( 'novus', $id );
		$novus_bean->end = 'Y';
		$this->rb->store( $novus_bean );

		redirect( $id );	
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function reopen_novus( $id )
	{
		$this->protect( $id );
			
		$novus_bean	= $this->rb->load( 'novus', $id );
		$novus_bean->end = 'N';
		$this->rb->store( $novus_bean );

		redirect( $id );		
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function appreciate( $id )
	{
		$this->novus_model->appreciate( $id );
		redirect( $id );
	}
	
	public function unappreciate( $id )
	{
		$this->novus_model->unappreciate( $id );
		redirect( $id );
	}
	
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/

	public function broadcast()
	{
		 $res = $this->novus_model->broadcast();
		 return $res;
	}
	
	/* 							PRIVATE FUNCTIONS						*/

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 
	 private function protect( $id )
	 {
		if ( !logged() ) return false;	
			
		$this->Tank_auth->validate_logged_user( $data );
		$data['novus'] = $this->novus_model->get_novus_by_key( $id )->export();

		if ( $data['owner'] != "power_user" && $data['owner'] != $data['novus']['author'] )
			die( "You're trying to alert a novus which is not yours. not cool." );
			
		return true;
	 }
	 
	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
	 	
	 private function cover_upload()
	 {	
		$this->config->load('novusbit');
		$f = $this->config->item('image_upload') ;
		$this->config->set_item('upload_path', '/uploads/novus');
		$this->load->library( 'upload',$f );
		
		if ( !$this->upload->do_upload() ) {
			echo $this->upload->display_errors();
			return;	
		}
		else
		{
			$image_data					 = $this->upload->data();
			$img_config['image_library']	 = 'gd2';
			$img_config['source_image']	 = 'uploads/novus/' . $image_data['file_name'];
			$img_config['create_thumb']	 = FALSE;
			$img_config['maintain_ratio'] = TRUE;
			$img_config['width']			 = 159;
			$img_config['height']		 = 200;
			
			
			$this->load->library( 'image_lib' );
			$this->image_lib->initialize( $img_config );
			
			if ( !$this->image_lib->resize() ){
				echo $this->image_lib->display_errors();
				return;		
			}
			else
			{
				$config['image_library']  = 'gd2';
				$config['source_image']	  = 'uploads/novus/' . $image_data['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width']		  = 159;
				$config['height']		  = 200;
				
				$this->image_lib->initialize( $config );
				$this->image_lib->crop();
			}
			
			return $image_data;
		}
		
		return false;
	}

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
 
	private function get_irreversable ( & $data ){
		$data['bits'] = array_reverse( $data['bits'] );
	}
	

	/*********************************************************************
	 * This will stand out clearly in your code,
	 * But the second example won't.
	 *********************************************************************/
 
	private function get_keywords ( $bits, $desc )
	{
		$this->load->model('textanalysis_model');
		$whole_novus_text = $desc.' ';
		foreach( $bits as $onebit ){
			   $whole_novus_text .= $onebit['body'];
		}
		$this->textanalysis_model->load_textfile( $whole_novus_text );
		$keywords = $this->textanalysis_model->get_count_limit(3);

		return $keywords;
	}
}

/* End of file novus_controller.php */
/* Location: ./novusbit/controllers/novus_controller.php */