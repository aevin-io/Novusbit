<?php

class RedBean {
    function __construct(){
        
       
        $this->ci =& get_instance();

        // Include database configuration
        include(APPPATH.'/config/database.php');
        
        // Include required files
        include(APPPATH.'/thirdparty/redbean/redbean.inc.php');
        
        // Database data
        $hostname     = $db[$active_group]['hostname'];
        $username     = $db[$active_group]['username'];
        $password     = $db[$active_group]['password'];
        $database     = $db[$active_group]['database'];
        
        // Create RedBean instance
        $toolbox = RedBean_Setup::Kickstart('mysql:host='.$hostname.';dbname='.$database, $username, $password);
        $this->ci->rb = $toolbox->getRedBean();
        $this->ci->rb->toolbox = $toolbox;
    }
}

