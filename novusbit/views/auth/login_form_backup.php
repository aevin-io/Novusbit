<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
		<meta name="robots" content="no-cache" />
<meta name="description" content="My Great Site" />
<meta name="keywords" content="love, passion, intrigue, deception" />
<meta name="robots" content="no-cache" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="http://www.novusbit.com/dev/novusbit/js/libraries/jquery-ui-1.8.11.custom/css/custom-theme/jquery-ui-1.8.11.custom.css">
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans|Istok+Web|Muli|Alef|PT+Sans+Caption|Inconsolata|Numans&subset=latin,greek' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="http://www.novusbit.com/dev/novusbit/styles/reset.css">
	<link type="text/css" rel="stylesheet" href="http://www.novusbit.com/dev/novusbit/styles/basic.css">
	<link type="text/css" rel="stylesheet" href="http://www.novusbit.com/dev/novusbit/styles/validationEngine.jquery.css" />
	<!-- <link type="text/css" rel="stylesheet" href="http://www.novusbit.com/dev/novusbit/styles/grey.css"> -->
	<link type="text/css" rel="stylesheet" href="http://www.novusbit.com/dev/novusbit/js/libraries/tipTip.css">
	<link type="image/x-icon" rel="shortcut icon" href="http://www.novusbit.com/dev/images/favicon.ico">
	
	<title>Novusbit. Twist your story!</title>

			<script type="text/javascript">
	var base_url = "http://www.novusbit.com/dev/";
		var logged = false; 
	</script>

	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery_address/jquery.address-1.3.2.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/nicEdit.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery.tipTip.minified.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/tagInput/jquery.tagInput.js"></script>
	<script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/novusbit-core.js"></script>
    <script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery.validationEngine-en.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://www.novusbit.com/dev/novusbit/js/libraries/jquery.validationEngine.js" charset="utf-8"></script>
          
	</head>

<body>
<div class="body_normal" id="page_body">
<div id="welcome">
	<div id="logo_text_welcome" class="logo_text">Novus<font color="#2e648a">bit</font>
		<div id="welcome_quote">Twist your story - Beta</div>
	</div>
</div>
<div class="loginbox" style="display: block; margin: 0 auto; position: relative;">


			
	
		
	<form action="http://www.novusbit.com/dev/auth/loginMainPage" method="post" accept-charset="utf-8" class="front_login">	
		

	<div style="float:left">
		<input tabindex="1" type="text" placeholder="User Name" name="login" id="login" value="" class="welcome_login_input welcome_ux validate[required]">
	</div>
	
	<div style="float:left">
		<input tabindex="2" type="password" placeholder="Password" name="password" id="password" value="" class="welcome_login_input welcome_ux validate[required]">
	</div>
	
	<p style="margin-bottom: 0.5em; line-height: 28px;">
			
			<input style="vertical-align: middle; margin-left: 0;" name="remember" class="no-border" type="checkbox" id="remember" tabindex="3" value="true">
			<label style="vertical-align: middle; cursor: pointer; " for="remember">Remember me</label>
				
			<input tabindex="4" type="submit" class="button button-gray toplogin-submit" value="login" id="toplogin-submit" inject="no">
		</p>
	
	
	
	
		

	
	
	</form>	


</div>
</div>





<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label($login_label, $login['id']); ?></td>
		<td><?php echo form_input($login); ?></td>
		<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Password', $password['id']); ?></td>
		<td><?php echo form_password($password); ?></td>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</tr>

	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</td>
		<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
		<?php echo $recaptcha_html; ?>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="3">
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
		<td><?php echo form_input($captcha); ?></td>
		<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
	</tr>
	<?php }
	} ?>

	<tr>
		<td colspan="3">
			<?php echo form_checkbox($remember); ?>
			<?php echo form_label('Remember me', $remember['id']); ?>
			<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
			<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>
		</td>
	</tr>
</table>
<?php echo form_submit('submit', 'Let me in'); ?>
<?php echo form_close(); ?>