<?php echo validation_errors(); ?><?php echo form_open('redux_controller/login'); ?>
<div style="float:left">User name<?php echo form_input('email', 'fake-x'); ?>
</div>
<div style="float:left">
Password
<?php echo form_password('password', 'dokimi'); ?>
</div>
<div style="float:left">
<?php echo form_submit( array( 'value'=> 'login', 'inject' => 'no',  'class' => 'button' )); ?>

<a href="signup" class="button">Sign up</a>
</div>
<?php echo form_close(''); ?>
<div style="float:right; " id="fb_panel">
	<!-- <img src="<?=base_url();?>/images/loader.gif" id="loading">-->
	</div>

	