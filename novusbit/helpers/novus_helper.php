<?php

function displayerror(){
	echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<path d="M98.692,80.351L58.485,8.793c-1.73-3.077-4.984-4.981-8.515-4.981c-3.527,0-6.783,1.904-8.512,4.981L1.252,80.351  c-1.698,3.024-1.669,6.721,0.085,9.717c1.751,2.992,4.958,4.831,8.428,4.831h80.413c3.468,0,6.674-1.839,8.426-4.831  c0.893-1.525,1.337-3.228,1.337-4.933C99.941,83.484,99.524,81.837,98.692,80.351z M44.045,59.222V34.75v-1.363  c0.085-4.008,2.388-6.652,5.97-6.652c3.58,0,5.968,2.729,5.968,6.652v1.363v24.472v1.281c-0.085,4.092-2.388,6.649-5.968,6.649  c-3.582,0-5.97-2.643-5.97-6.649V59.222z M50.01,84.744c-3.775,0-6.844-3.068-6.844-6.845s3.068-6.765,6.844-6.765  c3.776,0,6.764,2.988,6.764,6.765S53.786,84.744,50.01,84.744z"></path>
</svg>
Posted by removed member.';
}      
        
function ndiv($novus, $key, $key2=null){
    if($key2==null){
        $value = $novus[$key];
        echo '<div class="novus_'.$key.'">';
    }    
    else
    {
        $value = $novus[$key][$key2];
         echo '<div class="novus_'.$key.'_'.$key2.'">';
    }
    
    
    echo $value;
    echo '</div>';
   
  
}

function bdiv($bit, $key, $key2=null){
    if($key2==null){
        $value = $bit[$key];
        echo '<div class="bit_'.$key.'">';
    }    
    else
    {
        $value = $bit[$key][$key2];
         echo '<div class="bit_'.$key.'_'.$key2.'">';
    }
    
    //echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $value;
    echo '</div>';
 
  
}
     function extract_beans( $arr ) {
        $tmp_bits_arr = array();
        foreach ( $arr as $one_bean ){
            array_push( $tmp_bits_arr, $one_bean -> export() );
        }
        return $tmp_bits_arr;
    }
    
    function get_bean( $arr ){
        return $first_element = reset( $arr );
    }
    
    function logged(){
        $ci = & get_instance();
	//$ci->load->library('Tank_auth');
	$activated = TRUE;
        if(  $ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED) || ( $ci->session->userdata('fb_user') )){
	    return true;
	}
    }
    
        function base64url_encode($plainText) {
			    
			    $base64 = base64_encode($plainText);
			    $base64url = strtr($base64, '+/=', '-_/');
			    return $base64url;   
			}
                        
                        function array_push_assoc($array, $key, $value){
			$array[$key] = $value;
			return $array;
		       }
                       
                       
    function filter($element) {
        
		    $bad_words = array('by','the','The','t','and', 'I','was','is','are','to','a','it','It','didn','as','with','of','on','off','in','at','into','onto','had','have','has','all','would','will',
                                       'out','up','down','left','right','went','she','he','her','his','him','they','we','We','theirs','over','that','which','one','you','me','yours','do','did','not','didnt',
                                       'them','be','was','were','too','no','for','until','before','could','can','should','ought','go','get','gone','what','why',
                                       'where','who','whom','now','any','if','my','mine','yours','only','so','ever','never','yes','yeah','here','than','an',
                                       'anybody','nobody','since','before','there','this','or','been','from','after');  
		    		
		    if(in_array($element, $bad_words)){
			return;
		    }
		
		  
		    return $element;
   }
   
   
function nl(){
    echo chr(10);
}

function uriresolve(){
    $ci = & get_instance();
    if( ! IS_AJAX )
        redirect( "#".$ci->uri->uri_string());
}

function check( $username ){
    $ci = & get_instance();
    //connect to database  
    $auth =  $ci->author_model->get_author_by_username(  $username  );
    if ( $auth != FALSE )
    {
         echo 0; 
    }
    else
    {
         echo 1;  
    }
}

?>