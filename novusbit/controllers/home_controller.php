<?php

class Home_controller extends CI_Controller
{
	public function index()
	{				
		$this->load->view( 'global/wireframe');
	}
		
	public function about( $what=null )
	{		  
		$this->load->view( 'about/'.$what);
	}
	
	public function welcome()
	{
		$this->load->view( 'welcome' );	
	}
	

	
	public function notices_drop()
	{
		$this->load->view( 'global/notices_dr' );	
	}
	
	public function welcome_novus()
	{
		  $data['novuses'] =  $this->novus_model->get_novus( 'NEW_FIRST', null, null, 1 ) ;
		  $data['novuses'] = array_reverse($data['novuses'] );
		  $this->load->view( 'novuses_view', $data );
	}
	
	public function welcome_novus_recentbits()
	{
		  $data['novuses'] = $this->novus_model->get_novus( 'RECENT_BITS', null, null, 1 ) ;
		  $data['novuses'] = array_reverse($data['novuses'] );
		  $this->load->view( 'novuses_view', $data );
	}
	
	public function home()
	{
		$data['novuses'] = $this->novus_model->get_novus( 'NEW_FIRST', null, null, $this->pagenumber($data) ) ;
		$data['novuses'] = array_reverse($data['novuses'] );
		$this->load->view( 'novuses_view', $data );	
	}
	
	public function categories( $cat_name = null)
	{
		$data['category']= urldecode( $cat_name );
		$data['novuses'] = $this->novus_model->get_novus( 'NEW_FIRST', urldecode( $cat_name ), null, $this->pagenumber($data) );
		$data['novuses'] = array_reverse($data['novuses'] );
		$this->load->view( 'novuses_view', $data );
	}
	
	
	public function types( $type_name = null)
	{
		$data['type']	 = urldecode( $type_name );
		$data['novuses'] = $this->novus_model->get_novus( 'NEW_FIRST', null, urldecode( $type_name ) , $this->pagenumber($data));
		$data['novuses'] = array_reverse($data['novuses'] );
		$this->load->view( 'novuses_view', $data );
	}
		
	public function signup()
	{
		//
	}
	
	public function start_new_novus( $cat = null )
	{
		if ( logged() )
			redirect( 'novus_controller/start_new_novus/'.$cat );
		else
			$this->signup();
	}
	
	public function options_panel($flag=null, $current=null)
	{	  		 
		  switch ( $flag ) {
		
			default:	
			break;		
			case "categories":				
					$c_data['categories'] 	= $this->novus_model->get_categories();
					$c_data['current'] 		= urldecode( $current );
					$c_data['current_type'] = urldecode( $current );
					$this->load->view( 'categories', $c_data);
			break;
		  }
	}
	
	/* 							PRIVATE FUNCTIONS						*/
	
	private function pagenumber(&$data){
		 parse_str($_SERVER['QUERY_STRING'], $_GET);
		 if(isset($_GET['page'])) $pageno = $_GET['page']; else $pageno = 1;
		 $data['pageno'] = $pageno;
		 return $pageno;
	}
}