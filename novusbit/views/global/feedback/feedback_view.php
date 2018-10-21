

<?php
$attributes = array('class' => '', 'id' => 'feedback_form');
echo form_open_multipart('feedback_controller/store_feedback',$attributes);
        echo form_label('Subject', 'subject');
        echo br();
        $data = array(
              'name'        => 'subject',
              'id'          => 'subject',
              'value'       => '',
             
              'maxlength'   => '60',
              'size'        => '60',
              'style'       => 'width:450px',
            );
        echo form_input($data);
       
        echo br(2);
        echo form_label('Description', 'description');
        echo br();
         $data = array(
              'name'        => 'description',
              'id'          => 'description',
              'placeholder'       => "What's up?",
              'maxlength'   => '600',
              'value'       => '',
              'style'       => 'width:450px',
               'rows'   => '8'
            
            );
        echo form_textarea( $data );
        echo br(2);
      
	echo "Tell us anything! Did you discover a bug? Tell us about it and we will do our best to fix it! Did you like Novusbit and you want to scream and shout about it? Let us know! Did you got this awesome idea about a new feature you'd like to see on Novusbit, we want to hear about it too.";
	//echo br(2);
	//echo form_label('Refferal URI', 'uri');
       
        $data = array(
              'name'        => 'uri',
              'id'          => 'uri',
              'value'       => $uri,
             'type'=>'hidden',
              'maxlength'   => '60',
              'size'        => '60',
              'style'       => 'width:450px',
            );
    echo form_input($data);
   // echo br(2);
	//echo form_label('User', 'user');
       
        $data = array(
              'name'        => 'user',
              'id'          => 'user',
              'value'       => $owner,
              'type'=>'hidden',
              'maxlength'   => '60',
              'size'        => '60',
              'style'       => 'width:450px',
            );
        echo form_input($data);
	?>

<?php echo form_close(''); ?>

 
