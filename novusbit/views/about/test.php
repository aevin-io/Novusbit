
	 <script>
 $(document).ready(function () {$('#loading').hide();});
 </script>
				
				<div  id="fb_panel_welcome"></div>
				<button class="facebook button button_loginbox fb-auth"><span class="icon_loginbox"><!--?xml version="1.0" encoding="utf-8"?-->
				<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
				
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="12px" y="12px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve" >
				<path d="M20.944,7.111h5.333V0h-5.979c-4.688,0-8.243,3.556-8.243,7.111v3.555H6.722v7.111h5.333V32h7.111V17.777H24.5v-7.111
					h-5.333V8.889C19.167,7.781,20.337,7.111,20.944,7.111"></path>
				</svg>
				</span>Login with Facebook</button>
	
		
	<?php 
		echo validation_errors();
		echo form_open('auth/loginMainPage', array('class' => 'front_login')); 
	?>
	
		

	<div style="">
		<input  tabindex="1" type="text" placeholder="<?php echo _("Username"); ?>" name="login" id="login" value="" class="welcome_login_input welcome_ux validate[required]">
	</div>
	
	<div style="">
		<input  tabindex="2" type="password" placeholder="<?php echo _("Password"); ?>" name="password" id="password" value="" class="welcome_login_input welcome_ux validate[required]">
	</div>
	<div class="formmessage">&nbsp;</div>	
	<p style="margin-bottom: 0.5em; line-height: 28px;">
			
			<input style="vertical-align: middle; margin-left: 0;" name="remember" class="no-border" type="checkbox" id="remember" tabindex="3" value="true" checked="true">
			<label style="vertical-align: middle; cursor: pointer; " for="remember">Remember me</label>
			
			<input tabindex="4" type="submit" class="button toplogin-submit welcome_button" value="login" id="toplogin-submit" inject="no" >
		</p>
	
	
	
	
	
	

	
	
	<?php echo form_close(''); ?>
	

