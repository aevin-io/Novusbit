<p align="justify"><?php echo _("We've shaken hands with your facebook. Choose your nickname by which you'll be registered in Novusbit."); ?>

<?php echo _("Your nickname should be unique and cannot contain funny characters nor spaces."); ?></p><br>
    	<!-- FB CODE -->
		<div id="fb-root"></div>
		<script type="text/javascript">
		
		$(document).ready(function() {  
		
		
		function attachvalidation( where ){
		$(where).validationEngine('attach', {
					autoHidePrompt : true,
					autoHideDelay: 2500,
					ajaxFormValidation: false,
					scroll: false,
					ajaxFormValidationMethod: 'post',
					promptPosition : "topLeft",
					onAjaxFormComplete: ajaxValidationCallback
					});
	}
	
	attachvalidation('#choose_alias');
	
   $('.ui-button').hide();
        //the min chars for username  
        var min_chars = 3;  
  
        //result texts  
        var characters_error = '<img src="images/error.png"> More than 3 letters, please';  
        var checking_html = '<img src="images/loader.gif"> Checking...';  
  
        //when button is clicked
	$('#alias').keydown( function(){
		
        // $('#check_username_availability').click(function(){  
            //run the character number check  
            if($('#alias').val().length < min_chars){  
                //if it's bellow the minimum show characters_error text '  
                $('#username_availability_result').html(characters_error);  
            }else{  
                //else show the cheking_text and run the function to check  
                $('#username_availability_result').html(checking_html);
		var t=setTimeout("check_availability()",1000);
                
            }  
        });
	

  
  });  
  
//function to check username availability  
function check_availability(){  
  
        //get the username  
        var username = $('#alias').val();  
  
        //use ajax to run the check  
        $.post(base_url+"author_controller/check_if_exists/"+username,  
            function(result){  
                //if the result is 1  
                if(result == 1){  
                    //show that the username is available  
                    $('#username_availability_result').html('<img src="images/tick.png"> Available');
		    $('.ui-button').show();
                }else{  
                    //show that the username is NOT available  
                    $('#username_availability_result').html('<img src="images/error.png"> Not available');
		    $('.ui-button').hide();
                }  
        });  
  
}  
		
		
		
			window.fbAsyncInit = function() {
	        	FB.init({appId: '<?=$appkey?>', status: true, cookie: true, xfbml: true});
	 
	            /* All the events registered */
	            FB.Event.subscribe('auth.login', function(response) {
	    			// do something with response
	                login();
	        	});
	
	            FB.Event.subscribe('auth.logout', function(response) {
	            // do something with response
	                logout();
	          	});
	   		};
	
	        (function() {
		        var e = document.createElement('script');
	            e.type = 'text/javascript';
	            e.src = document.location.protocol + '//connect.facebook.net/de_DE/all.js';
		          e.async = true;
	            document.getElementById('fb-root').appendChild(e);
	   	 	}());
	 
	        function login(){
	        	document.location.href = "<?=$base_url?>";
	     	}
	
	        function logout(){
	        	document.location.href = "<?=$base_url?>";
	 		}
		</script>
		<!-- END OF FB CODE -->
	
			
		
		
		<?php
		
		$session = $fbSession; //$facebook->getSession();

		$me = null;
		// Session based API call.
		if ($session) {
		  try {
		    $me = $user;
		  } catch (FacebookApiException $e) {
		    error_log($e);
		  }
		}
		
		// login or logout url will be needed depending on current user state.
		if ($me) {
		  $logoutUrl = $fbLogoutURL;
		} else {
		  $loginUrl = $fbLoginURL;
		}
?>
    <?php if ($me):?>
    
  
   
   <?php else:?>
   <fb:login-button onlogin="login();" size="medium" perms="email,offline_access,user_birthday,status_update,publish_stream">Connect</fb:login-button>
 
    <?php endif; ?>
<div >
   
    <?php if ($me): ?>
    
     <div id="author_image">
    <img src="https://graph.facebook.com/<?php echo $uid; ?>/picture?type=large" width="80" height="80">
     </div>
    <strong><?php echo $me['name']; endif; ?></strong>



</div>




<?php

$attributes = array('class' => 'aliasform', 'id' => 'choose_alias');
echo form_open('login/create', $attributes); ?>
<div style="float:left; width: 340px;"><br>
Choose your nickname: <br />http://novusbit.com/
<?php // echo form_input('alias', set_value('alias'));  ?>

<input type='text' id='alias' name='alias' placeholder="Your nickname" style="width:150px" class="validate[required,custom[onlyLetterNumber]]">
</div>
<div id='username_availability_result'  style="float:left;margin-top: 28px;"></div> 
<div style="clear:both">
<input type="submit" value="Register" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" style="float:right">
 <a href="<?php echo $logoutUrl; ?>" inject="no">
     <br>not you?<br>
    </a>

</div>
<?php // echo form_submit('submit', 'REGISTERRRRR'); ?>
<?php echo form_close(''); ?>
