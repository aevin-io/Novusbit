<? if(isset($error)) echo $error;?>

  <?php
  $attributes = array('class' => 'profileform', 'id' => 'profileform');


echo form_open_multipart('author_controller/update_profile/'. $author['id'], $attributes );

$data = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => $author['username'],
              'readonly'=>'',
              'maxlength'   => '100',
              'size'        => '60',
              'class'		=> 'validate[required]',
              'style'       => 'width:250px',
            );
echo "<p>";
echo form_label( "Username","username");
echo form_input($data);
echo "</p>";
 
	 
$data = array(
              'name'        => 'last_name',
              'id'          => 'last_name',
              'value'       => $author['last_name'],
              'maxlength'   => '100',
              'size'        => '60',
              
              'style'       => 'width:250px',
            );
echo "<p>";
echo form_label(   "Last name",'last_name');
echo form_input($data);
echo "</p>";


$data = array(
              'name'        => 'first_name',
              'id'          => 'first_name',
              'value'       => $author['first_name'],
              'maxlength'   => '100',
              'size'        => '60',
              
              'style'       => 'width:250px',
            );

echo "<p>";
echo form_label(   "First name",'first_name');
echo form_input($data);
echo "</p>";
	
$data = array(
              'name'        => 'email',
              'id'          => 'email',
              'value'       => $author['email'],
               'class'		=> 'validate[required,custom[email]]',
              'maxlength'   => '100',
              'size'        => '60',
              'style'       => 'width:250px',
            );
			      
echo "<p>";
echo form_label(   "Your email",'email');
echo form_input($data);
echo "</p>";
	
 if(isset($logged_author['fb_user'])){ 
	  
echo "<p>";

echo form_label( "Picture",'userfile');



	?>

	<div id="author_image">
		<?php if(!isset($author['fb_user'])): ?>
		<?php if(isset($author['picture'])): ?>
			<img src="<?php echo (base_url().'uploads/authors/'.$author['picture']);?>" width="120" height="120" align="absbottom" />
		<?php else: ?>
			<img src="<?php echo (base_url().'images/logo.jpg');?>" width="120" height="120" align="absbottom" />
		<?php endif; ?>

		<?php else: ?>
			<img src="https://graph.facebook.com/<?php echo $author['fb_uid']; ?>/picture?type=large" width="120" height="120">
		<?php endif; 
			
		?>
	</div> <!-- author_image -->
	
	
	
	
<div style="clear:both"></div>
	  <input type="file" name="userfile" id="userfile" name="userfile" size="10" />
	 </p>
	 
	 <? } ?>
	         <input type="submit" type="submit" value="Save" class="welcome_button button button-gray sumbit_novus">
	  <?php
	
	
echo form_hidden('commit','yes');
     //echo form_submit('submit', 'save');
    
     echo form_close();
     
  ?>

</div>


<style>
input[type=text], textarea {
padding: 15px;
margin: 0px 0px 15px 0;
border-radius: 3px;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
-ms-border-radius: 3px;
-o-border-radius: 3px;
border-radius: 3px;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
border: 1px solid #ddd;
border-left: 6px rgba(46, 100, 138, 0.2) solid;
-webkit-transition: all 0.3s ease-out;
-moz-transition: all 0.3s ease-out;
-o-transition: all 0.3s ease-out;
transition: all 0.3s ease-out;
}
input[type=text]:focus, textarea:focus, input[type=text]:active, textarea:active {
	-webkit-box-shadow: inset 0px 0px 3px 1px rgba(0, 0, 0, 0.2);

		box-shadow: inset 0px 0px 3px 1px rgba(0, 0, 0, 0.2);
		border-left: 6px rgba(24, 68, 99, 0.3) solid;
	
}
.input_focused {
	border-left: 6px rgba(24, 68, 99, 1) solid !important;
}
input[type=text]:hover, textarea:hover {
background:#fafafa;	border-left: 6px rgba(24, 68, 99, 1) solid;
	
}

p label {
	padding-right: 10px;
}
 
</style>
<script>
$(document).ready(function() {  
	
	function attachvalidation( where ){
		$(where).validationEngine('attach', {
					autoHidePrompt : true,
					autoHideDelay: 2500,
					ajaxFormValidation: false,
					scroll: false,
					ajaxFormValidationMethod: 'post',
					promptPosition : "topLeft"
					});
	}
	
	attachvalidation('#profileform');
});
</script>