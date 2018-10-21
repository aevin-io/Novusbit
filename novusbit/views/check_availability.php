<?php

$ci = & get_instance();
//connect to database  
$auth =  $ci->author_model->get_author_by_username(   $_POST['username']  );
if ( $auth != FALSE )
{
     echo 1; 
}
else
{
     echo 0;  
}
/*
//get the username  
$username = mysql_real_escape_string($_POST['username']);  
  
//mysql query to select field username if it's equal to the username that we check '  
$result = mysql_query('select username from users where username = "'. $username .'"');  
  
//if number of rows fields is bigger them 0 that means it's NOT available '  
if(mysql_num_rows($result)>0){  
    //and we send 0 to the ajax request  
    echo 0;  
}else{  
    //else if it's not bigger then 0, then it's available '  
    //and we send 1 to the ajax request  
    echo 1;  
}
*/