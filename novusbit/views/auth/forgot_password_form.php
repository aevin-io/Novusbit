<style>
body {
font-family: 'PT Sans Caption', Arial, helvetica, sans-serif;
letter-spacing: -0.20pt;
font-size: 13px;
color: #555;
}
</style>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>
<strong>Have you forgot your password?</strong><br>No problemo, fill in your email and we can send you a new password!<br><br>	
<?php echo form_open($this->uri->uri_string()); ?>
<?php echo form_label($login_label, $login['id']); ?><br>
<?php echo form_input($login); ?><br>
<?php echo form_error($login['name']) ; ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>

<?php echo form_submit('reset', 'Get a new password'); ?>
<?php echo form_close(); ?>