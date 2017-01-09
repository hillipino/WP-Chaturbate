<?php

// Register meta boxes

	$prefix = _cb_;

	$meta_boxes = array();

	// Webcam Post Meta
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	$meta_boxes[] = array(
		'id' 			=> 'webcam_meta',
		'title' 		=> __( 'Webcam Options', THEMENAME ),
		'pages' 		=> array('webcam'),
		'template'		=> '',
		'context' 		=> 'normal', // normal, advanced, side (optional)
		'priority' 		=> 'high', // high, low (optional)
		'fields' 		=> array(	

			// Performer Username 
			
				array(
					'name' 		=> __( 'Performer Username', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'camuser',
					'type' 		=> 'text',
					'std' 		=> ''
				),	
				
			// Performer Display Name 
			
				array(
					'name' 		=> __( 'Performer Display Name', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'displayname',
					'type' 		=> 'text',
					'std' 		=> ''
				),	
				
			// Performer Age 
			
				array(
					'name' 		=> __( 'Performer Age', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'age',
					'type' 		=> 'text',
					'std' 		=> ''
				),	
				
			// Program Mode
							
				array(
					'name' 		=> __( 'Performer Gender', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'gender',
					'type' 		=> 'radio',
					'std' 		=> 'female',
					'options' 	=> array(
						array('name' => ' Female', 'value' => 'female'),
						array('name' => ' Male', 'value' => 'male'),
						array('name' => ' Couple', 'value' => 'couple'),
						array('name' => ' Shemale', 'value' => 'shemale'),
					)								
				),				

			// Performer Birthdate 
			
				array(
					'name' 		=> __( 'Performer Birthdate', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'birthdate',
					'type' 		=> 'text',
					'std' 		=> ''
				),	

			// Performer Image 
			
				array(
					'name' 		=> __( 'Performer Image', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'image',
					'type' 		=> 'text',
					'std' 		=> ''
				),					
				
			// Performer Location 
			
				array(
					'name' 		=> __( 'Performer Location', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'location',
					'type' 		=> 'text',
					'std' 		=> ''
				),	

			// Performer Language
			
				array(
					'name' 		=> __( 'Performer Language', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'language',
					'type' 		=> 'text',
					'std' 		=> ''
				),				

			// Iframe Revshare
			
				array(
					'name' 		=> __( 'Revshare Iframe', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'iframe_revshare',
					'type' 		=> 'text',
					'std' 		=> ''
				),	
				
			// Iframe Signup
			
				array(
					'name' 		=> __( 'Signup Iframe', THEMENAME ),
					'desc' 		=> '',
					'id' 		=> $prefix . 'iframe_signup',
					'type' 		=> 'text',
					'std' 		=> ''
				),	
				
		)
	);
	
	// Create the Meta Boxes	
		
	foreach ($meta_boxes as $meta_box) {
		
		$my_box = new NMP_Meta_Box($meta_box);
		$my_box->set_postId();
		$my_box->set_template();

	}

	// Validate value of meta fields
	// Define ALL validation methods inside this class
	// and use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)

	class NMP_Meta_Box_Validate {
		function check_text($text) {
			return true;
		}
	}