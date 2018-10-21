<!-- <link type="text/css" rel="stylesheet" href="<?=base_url();?>novusbit/styles/welcome.css"> -->

<style>
#switch-wrap {
    height:26px;
    margin:0 260px;
    width: 300px;
    
}
#switch-wrap label, #switch-wrap div {
    float:left;
    line-height:21px;
    margin:5px;
    font-weight:bold;
   
}
#switch-wrap #switch {
    width: 57px;
    height:26px;
    cursor:pointer;
}
#switch-wrap  #switch { 
    background: url(<?=base_url();?>images/switch.png) 0px 0px no-repeat;
}
#switch-wrap  #switch.on { 
    background: url(<?=base_url();?>images/switch.png) 0px -33px no-repeat;
}
</style>
<!--
<div id="whatsanovus-wrap">
	<div id="close_whatsnovus" class="closex"><?php echo _("close"); ?></div>
	<div id="whatsanovus">
		<h2><?php echo _("novus_description"); ?></h2>
	</div>
</div>
-->


<div id="welcome">
	<div id="logo_text_welcome" class="logo_text"><?php echo _("Novus"); ?><font color="#2e648a"><?php echo _("bit"); ?></font>
		<div id="welcome_quote"><?php echo _("Twist your story "); ?></div>
	</div>
</div>
<!--	
<div id="whatis"></div>
-->
		
<ul id="nav">
	<li id="prev">Previous</li>
	<li id="next" title="">Next</li>
</ul>	
	
<div id="welcome_novus"></div>

<div id="switch-wrap">
	<label>Recent Novus</label>
	<div id="switch" class=""></div>
	<label>Recent Bits</label>
</div>



<div id="registration_area">
		<div id="frontshadow"></div>
		<div id="email_registration">
				
				<?php echo validation_errors(); echo form_open('/auth/registerFirstPage', array('id' => 'front_registration','class' => 'front_registration')); ?>
				<ul class="inputs">
						<li class="welcome_input welcome_ux">
								<span class="icon" title="email address"><!--?xml version="1.0" encoding="utf-8"?-->
							<!-- Generator: Adobe Illustrator 15.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
							
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="64px" viewBox="0 0 100 64" enable-background="new 0 0 100 64" xml:space="preserve">
							<polygon points="50.001,45.022 50.001,45.023 50,45.022 0,9.464 0,64 100,64 100,9.465 "></polygon>
							<polygon points="99.497,0 0.504,0 50,35.097 "></polygon>
							</svg>
							</span>
								    <input type="text" placeholder="Email Address" name="email" id="email" class="validate[required,custom[email]]">
						</li>
						<li class="welcome_input welcome_ux">
								<span class="icon" title="password"><!--?xml version="1.0" encoding="utf-8"?-->
							<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
							
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
							<path d="M79.244,100H20.757c-2.085,0-3.774-1.689-3.774-3.775V58.113c0-2.084,1.689-3.773,3.774-3.773h3.773V38.191
								c0-14.066,11.403-25.47,25.471-25.47c14.065,0,25.47,11.403,25.47,25.47V54.34h3.773c2.084,0,3.773,1.689,3.773,3.773v38.111
								C83.018,98.311,81.328,100,79.244,100z M63.482,38.945c0-7.445-6.037-13.48-13.481-13.48c-7.446,0-13.481,6.035-13.481,13.48V54.34
								h26.962V38.945L63.482,38.945z"></path>
							</svg>
							</span>
								<!--<input type="password" id="id_password" name="password" class="input-text" placeholder="Password">-->
								  <input type="password" placeholder="Password" name="password" id="password" class="validate[required,funcCall[checkPassword]]">        
								    <span class="error"></span>    
						</li>
						
						<li class="welcome_input welcome_ux">
								<span class="icon" title="username"><svg id="tnp-user-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="75px" height="100px" viewBox="0 0 75 100" style="enable-background:new 0 0 75 100;" xml:space="preserve">
							<path d="M37.5,50C16.797,50,0,66.797,0,87.5C0,94.409,5.591,100,12.5,100h50c6.909,0,12.5-5.591,12.5-12.5  C75,66.797,58.203,50,37.5,50z"></path>
							<path d="M56.25,18.75c0,10.352-8.398,18.75-18.75,18.75s-18.75-8.398-18.75-18.75S27.148,0,37.5,0  S56.25,8.398,56.25,18.75z"></path>
							</svg>
							</span>
								<!--<input type="text" id="id_username" name="username" maxlength="30" class="input-text" placeholder="Username">-->
								  <input type="text" placeholder="Username" name="username" id="username" class="validate[required,custom[onlyLetterNumber]]">
								    <span class="error"></span>
								</li>
				</ul>

				<div style="float:left">
					<input type="submit" name="" value="Sign Up!" class="welcome_ux welcome_button welcome_signup_button" id="novusup">
				</div>
				
				<?php echo form_close(''); ?>
				<div style="clear:both; padding-top: 8px;"><a href="" class="arrow" id="register_with_fb">&nbsp; &nbsp; Use your Facebook to login</a></div>
				
		</div>
<style>
.inputs li {
width: 200px;
padding: 6px 0px;
margin: 10px 10px 0px 0;
border-radius: 3px;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
-ms-border-radius: 3px;
-o-border-radius: 3px;
border-radius: 3px;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
float: left;
}
.inputs li .icon {
margin-right: 5px;
}
.inputs li svg {
fill: #b3b3b3;
}
.icon svg {
width: 16px;
height: 16px;
}
.inputs li input {
border: none;
color: black;
font-size: 14px;
padding: 0;
width: 140px;
background:transparent;
}
</style>
		<div id="fb_registration">
				
				<div  id="fb_panel_welcome">
				</div>
				<button class="facebook button fb-auth"><span class="icon"><!--?xml version="1.0" encoding="utf-8"?-->
				<!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
				
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
				<path d="M20.944,7.111h5.333V0h-5.979c-4.688,0-8.243,3.556-8.243,7.111v3.555H6.722v7.111h5.333V32h7.111V17.777H24.5v-7.111
					h-5.333V8.889C19.167,7.781,20.337,7.111,20.944,7.111"></path>
				</svg>
				</span>Login with Facebook</button>
				<span><a href="" id="register_by_email" class="arrow">&nbsp; &nbsp; Sign up with your email instead</a></span>
		</div>
		
</div>
<style>
#registration_area{
		text-align: center;
		height:100px;

}
#email_registration {
		height:100px;
}

#registration_area .button {
font-family:  "Helvetica", Arial, sans-serif;
font-size: 18px;
line-height: 18px;
}
.loginbox .button {
font-family:  "Helvetica", Arial, sans-serif;
font-size: 13px;
line-height: 18px;
}
.button .icon {
padding-right: 18px;
height: 28px;
display: inline-block;
position: relative;
top: -4px;
}

.button .icon svg {
position: relative;
top: 7px;
left: 0px;
fill: white;
height: 18px;
width: 18px;
-webkit-transition-property: fill;
-moz-transition-property: fill;
-ms-transition-property: fill;
-o-transition-property: fill;
transition-property: fill;
-webkit-transition-duration: 0.3s;
-moz-transition-duration: 0.3s;
-ms-transition-duration: 0.3s;
-o-transition-duration: 0.3s;
transition-duration: 0.3s;
-webkit-transition-timing-function: ease;
-moz-transition-timing-function: ease;
-ms-transition-timing-function: ease;
-o-transition-timing-function: ease;
transition-timing-function: ease;
}
</style>


<div class="formmessage_register"></div>
