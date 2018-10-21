<?php

if(!function_exists('test_cookie')) {
    function test_cookie($test = TRUE) {
 
    //Load the CodeIgniter Instance and Cookie Helper
    $CI =& get_instance();
    $CI->load->helper('cookie');
 
    //see if we have post data and that test is true
    if($test && $_POST) {
        //If we don't have the test cookie then fail
        if(!get_cookie('test_cookie')) {
	    
            return FALSE;
        } else {
            return TRUE;
        }
    }
 
    //Set a new test cookie
   // delete_cookie('test_cookie');
   // set_cookie('test_cookie', TRUE, 86400);
    return TRUE; 
 
    }
}