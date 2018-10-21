

<?php echo $this->session->flashdata('message'); ?><?php echo validation_errors(); ?><?php echo form_open('redux_controller/register'); ?>            Username<br>
        
<?php echo form_input('username', set_value('username')); ?><br>            Email Address<br><?php echo form_input('email', set_value('email')); ?><br>        Password<br><?php echo form_password('password'); ?><br>
<!--          Optional Fields<br>        First Name<br><?php echo form_input('first_name', set_value('first_name')); ?><br>
            Last Name<br><?php echo form_input('last_name', set_value('last_name')); ?><br> -->
<?php echo form_submit('submit', 'Register'); ?>   

<?php echo form_close(''); ?>
<br>
Or you can simply connect your facebook account.
<br><br>

         
                    
                  