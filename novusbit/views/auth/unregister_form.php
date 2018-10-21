<style>
body {
font-family: 'PT Sans Caption', Arial, helvetica, sans-serif;
letter-spacing: -0.20pt;
font-size: 13px;
color: #555;
}
</style>
<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label('Password', $password['id']); ?></td>
		<td><?php echo form_password($password); ?></td>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('cancel', 'Delete account'); ?>
<?php echo form_close(); ?>