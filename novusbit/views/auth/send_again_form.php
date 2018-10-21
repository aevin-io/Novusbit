<style>
body {
font-family: 'PT Sans Caption', Arial, helvetica, sans-serif;
letter-spacing: -0.20pt;
font-size: 13px;
color: #555;
}
</style>
<?php
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 20,
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
<strong>You haven't activated your account.</strong> <br>Check your email to find your activation link or we can resend it, just fill in your email below.	<br><br>
		<?php echo form_label('Email Address', $email['id']); ?>
		<?php echo form_input($email); ?>
		
		<?php echo br().form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
	</tr>
</table>
<?php echo form_submit('send', 'Resend'); ?>
<?php echo form_close(); ?>