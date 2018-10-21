<?php
/**
* CodeIgniter Facebook Connect Library (http://www.haughin.com/code/facebook/)
*
* Author: Elliot Haughin (http://www.haughin.com), elliot@haughin.com
*
* VERSION: 1.0 (2009-05-18)
* LICENSE: GNU GENERAL PUBLIC LICENSE - Version 2, June 1991
*
**/


    include(APPPATH.'libraries/facebook/facebook.php');

    class Facebook_connect {

        private $_obj;
        private $_api_key        = NULL;
        private $_secret_key    = NULL;
        public     $user             = NULL;
        public     $user_id         = FALSE;
        public     $info            = NULL;
        
        public $fb;
        public $client;

        function Facebook_connect()
        {
            $this->_obj =& get_instance();

            $this->_obj->load->config('facebook');
            $this->_obj->load->library('session');
            
            $this->_api_key        = $this->_obj->config->item('facebook_api_key');
            $this->_secret_key    = $this->_obj->config->item('facebook_secret_key');
	    
	    

            $this->fb = new Facebook($this->_api_key, $this->_secret_key);
            
            $this->client = $this->fb->api_client;
                        
            if($this->fb->get_loggedin_user()) {
                try {
                    //Get some sample data from facebook, you can do whatever you want here really..
                    $this->user_id = $this->client->fql_query('SELECT uid, pic_square, first_name FROM user WHERE uid = ' . $this->fb->get_loggedin_user());
                } catch (Exception $ex) {
                    //Need to destroy the session. This is the important part!
                    $this->fb->clear_cookie_state();
                }
                $this->user_id = $this->fb->get_loggedin_user();                
            } else {
                $this->user_id = NULL;
            }
            

            $this->_manage_session();

            if ( $this->user_id !== NULL )
            {
                
            }
        }

        private function _manage_session()
        {
            if($this->_obj->session->userdata('facebook_user')){
                $user = $this->_obj->session->userdata('facebook_user');
            }else{
                $user=FALSE;
                }

            if ( $user === FALSE && $this->user_id !== NULL )
            {
                $profile_data = array('uid','first_name', 'last_name', 'name', 'locale', 'pic_square', 'profile_url', 'email');
                $info = $this->fb->api_client->users_getInfo($this->user_id, $profile_data);
                if (isset($info[0])) {
                        $user = $info[0];
                        $this->_obj->session->set_userdata('facebook_user', $user);
                    }
            }
            elseif ( $user !== FALSE && $this->user_id === NULL )
            {
                // Need to destroy session
        $this->_obj->session->unset_userdata('facebook_user');

            }

            if ( $user !== FALSE )
            {
                $this->user = $user;
            }
        }
    } 