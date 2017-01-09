<?php

    function nmp_import_cams() {
	
        // The array containing the admin page option values.
            
            $args = array(
				'tab'			=> 'tab_import',
				'initial'		=> '',				
				'append'		=> 'append_import',
                'formname' 		=> 'nmp_import',
				'subformname' 	=> '',
                'title' 		=> __( ' Import Cams', THEMENAME ),
                'description' 	=> __( '', THEMENAME ), 
                'groups'	 	=> array(
				
				// General Settings...
				
					array (
						'before' 			=> '<div class="import_subpanel">',
						'after' 			=> '</div>',						
						'title' 			=> __( 'Import Cams', THEMENAME ),    
						'description' 		=> __( 'Imports the Chaturbate XML Feed ( be patient, it may take a few minutes to complete)<br /> The plugin is also set to automatically import once every 30 minutes.', THEMENAME ), 
						'preview'			=> NULL,
						'fields' 			=> array(
							
									
                        )
                    )							
                    
                )

            );
            
            // Load the Form
            
            nmp_adminpage($args);
			
	}
	
    function nmp_import() {
	
		$cb_wl		= get_option( 'cb_wl', CBWL );
		$cb_affid	= get_option( 'cb_affid', AFFID );
		
		global $wpdb;

		// Reset the hours online and viewers to move offline cams to the end of the list.
		
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = %d WHERE meta_key = %s", 0, '_cb_online' ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = %d WHERE meta_key = %s", 0, '_cb_users' ) );

		
		// The XML Feed URL
		
			$xml = 'http://' . $cb_wl . '/affiliates/api/onlinerooms/?format=xml&wm='. $cb_affid .'';	
		
		// Fetch the feed
		
			
			$headers = @get_headers($xml);
			
			if ( $headers ) {
			
				$imported = 'yes';
		
				$cams = new SimpleXMLElement($xml, null, true);

				foreach( $cams as $cam ){ 

					switch ( $cam->gender) {
						
						case f:
							$gender = 'female';
							break;
						case m:
							$gender = 'male';
							break;
						case c:
							$gender = 'couple';
							break;
						case s:
							$gender = 'shemale';
							break;
						default:
							$gender = '';
					}
					
				// Filters for asian or latin
					
					$asian = array( 'philippines','china','vietnam','japan','india','korea','malaysia','singapore','laos','cambodia' );	
					
					$latin = array( 'brazil','mexico','colombia','argentina','peru','venezuela','chile','ecuador','guatemala','cuba','haiti','bolivia','domincan republic','honduras','paraguay','el salvador','nicaragua','costa rica','puerto rico','panama','uruguay','spain' );		

					$asianMatches = array();
					$asiansFound = preg_match_all(
									"/\b(" . implode( $asian,"|") . ")\b/i", 
									$cam->location, 
									$asianMatches
								  );	

					$latinaMatches = array();
					$latinasFound = preg_match_all(
									"/\b(" . implode( $latin,"|") . ")\b/i", 
									$cam->location, 
									$latinaMatches
								  );					
					
					$online  = intval($cam->seconds_online);
					$viewers = intval($cam->num_users);
					$age = intval($cam->age);
				

				// Check if Webcam already exists
				
					if ( nmp_post_exists( $cam->username ) ) {
						
						$post_id = nmp_post_exists( $cam->username );
						
						// Insert Post
							
							$my_post = array(
								'ID'			=> $post_id[ID],
								'post_title' 	=> $cam->username,
								'post_status' 	=> 'publish',
								'post_type' 	=> 'webcam'
							);

							wp_update_post($my_post);	

						// Add Meta Data
							
							update_post_meta($post_id[ID], '_cb_age', $age);
							update_post_meta($post_id[ID], '_cb_birthdate', ''.$cam->birthday.'');
							update_post_meta($post_id[ID], '_cb_camuser', ''.$cam->username.'');
							update_post_meta($post_id[ID], '_cb_displayname', ''.$cam->display_name.'');
							update_post_meta($post_id[ID], '_cb_iframe_revshare', ''.$cam->iframe_embed_revshare.'');
							update_post_meta($post_id[ID], '_cb_iframe_signup', ''.$cam->iframe_embed.'');
							update_post_meta($post_id[ID], '_cb_image', ''.$cam->image_url.'');
							update_post_meta($post_id[ID], '_cb_gender', $gender );
							update_post_meta($post_id[ID], '_cb_online', $online );
							update_post_meta($post_id[ID], '_cb_language', ''.$cam->spoken_languages.'');
							update_post_meta($post_id[ID], '_cb_location', ''.$cam->location.'');
							update_post_meta($post_id[ID], '_cb_recorded', ''.$cam->recorded.'');
							update_post_meta($post_id[ID], '_cb_show', ''.$cam->current_show.'');
							update_post_meta($post_id[ID], '_cb_users', $viewers);
							update_post_meta($post_id[ID], '_cb_chat_url', ''.$cam->chat_room_url.'');
							update_post_meta($post_id[ID], '_cb_chat_url_rev', ''.$cam->chat_room_url_revshare.'');
								
						// Set Terms

							wp_set_object_terms( $post_id[ID], array( $gender, 'all'), 'gender' );
							
							if ( $asiansFound )						
								wp_set_object_terms( $post_id[ID], array( 'Asian'), 'ethnicity' );
								
							if ( $latinasFound )						
								wp_set_object_terms( $post_id[ID], array( 'Latin'), 'ethnicity' );								

					} else {
					
						// Insert Post

							$my_post = array(
								 'post_title' 		=>	$cam->username,
								 'post_status' 		=> 	'publish',
								 'post_type' 		=> 	'webcam'
								 );

							$post_id = wp_insert_post($my_post);
								
								
						// Add Meta Data
							
							update_post_meta($post_id, '_cb_age', $age);
							update_post_meta($post_id, '_cb_birthdate', ''.$cam->birthday.'');
							update_post_meta($post_id, '_cb_camuser', ''.$cam->username.'');
							update_post_meta($post_id, '_cb_displayname', ''.$cam->display_name.'');
							update_post_meta($post_id, '_cb_iframe_revshare', ''.$cam->iframe_embed_revshare.'');
							update_post_meta($post_id, '_cb_iframe_signup', ''.$cam->iframe_embed.'');
							update_post_meta($post_id, '_cb_image', ''.$cam->image_url.'');
							update_post_meta($post_id, '_cb_gender', $gender);
							update_post_meta($post_id, '_cb_online', $online);
							update_post_meta($post_id, '_cb_language', ''.$cam->spoken_languages.'');
							update_post_meta($post_id, '_cb_location', ''.$cam->location.'');
							update_post_meta($post_id, '_cb_recorded', ''.$cam->recorded.'');
							update_post_meta($post_id, '_cb_show', ''.$cam->current_show.'');
							update_post_meta($post_id, '_cb_users', $viewers);
							update_post_meta($post_id, '_cb_chat_url', ''.$cam->chat_room_url.'');
							update_post_meta($post_id, '_cb_chat_url_rev', ''.$cam->chat_room_url_revshare.'');						
								
						// Set Terms

							wp_set_object_terms( $post_id, array( $gender, 'all'), 'gender' );
							
							if ( $asiansFound )						
								wp_set_object_terms( $post_id[ID], array( 'Asian'), 'ethnicity' );
								
							if ( $latinasFound )						
								wp_set_object_terms( $post_id[ID], array( 'Latin'), 'ethnicity' );								

					}

					
				}
				
			} else {
				
				$imported = 'no';
				
			}
			
			return $imported;

    }
	
	// Check if post exists
	
		function nmp_post_exists($title) {
			global $wpdb;
			return $wpdb->get_row("SELECT * FROM wp_posts WHERE post_title = '" . $title . "'", 'ARRAY_A');
		}	
	