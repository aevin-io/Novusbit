<?php

/*
|--------------------------------------------------------------------------
| IMAGE UPLOAD 
|--------------------------------------------------------------------------
|
| 
| 
| 
| 
|
*/
$config['image_upload'] = array(
			 'max_size' => 2000,
			'max_width' => 0,
			'max_height' => 0,
			'max_filename' => 0,
			'allowed_types' => "gif|png|jpg",
			'disallowed_types' => "",
			'file_temp' => "",
			'file_name' => "",
			'orig_name' => "",
			'file_type' => "",
			'file_size' => "",
			'file_ext' => "",
			'upload_path' => "./uploads/novus",
			'overwrite' => FALSE,
			'encrypt_name' => TRUE,
			'is_image' => TRUE,
			'image_width' => '',
			'image_height' => '',
			'image_type' => '',
			'image_size_str' => '',
			'error_msg' => array(),
			'mimes' => array(),
			'remove_spaces' => TRUE,
			'xss_clean' => FALSE,
			'temp_prefix' => "temp_file_" 
		);

$config['author_image_upload'] = array(
			 'max_size' => 2000,
			'max_width' => 0,
			'max_height' => 0,
			'max_filename' => 0,
			'allowed_types' => "gif|png|jpg",
			'disallowed_types' => "",
			'file_temp' => "",
			'file_name' => "",
			'orig_name' => "",
			'file_type' => "",
			'file_size' => "",
			'file_ext' => "",
			'upload_path' => "./uploads/authors",
			'overwrite' => FALSE,
			'encrypt_name' => TRUE,
			'is_image' => TRUE,
			'image_width' => '',
			'image_height' => '',
			'image_type' => '',
			'image_size_str' => '',
			'error_msg' => array(),
			'mimes' => array(),
			'remove_spaces' => TRUE,
			'xss_clean' => FALSE,
			'temp_prefix' => "temp_file_" 
		);