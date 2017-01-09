<?php

	// Loads our admin page
	
		function nmp_plugin_options() {
		
			$active_class 		= '';
			$active_sub_class 	= '';			
			
		// Check Posted Data
		
			if ( $_POST ) {
			
				$formname	= nmp_post( $_POST['formname'] );
				$posted		= nmp_post( $_POST['' . $formname . ''] );
				$append		= nmp_post( $_POST['append'] );	
				$initial	= nmp_post( $_POST['initial'] );	
				$tab		= nmp_post( $_POST['tab'] );
			
			} else {
				
				$formname 	= '';
				$posted		= '';
				$append		= '';
				$initial	= '';
				$tab		= '';
			
			}
			
			// If cache form do this.
			
			if ( isset( $formname ) && $formname == 'nmp_import' ) {
		
				add_action('init', nmp_import(),10);

				// Put an settings updated message on the screen 

					echo '
						<script>
							jQuery(function() {				
								jQuery(\'.append_import\').prepend(\'<p class="updated">' . __( 'Feed Successfully Imported', THEMENAME ) . '</p>\'); 
								jQuery(\'.tab_import\').addClass(\'initial\');
							});		
						</script>
					';					

			} else if( isset( $formname ) && $posted == 'Y' ) {
			

				// Save the posted value in the database
				
				if ( isset( $_POST['reset'] ) ) {
					
					foreach ( $_POST as $key => $value ) {
							
						if ( $key != $formname && $key != 'reset' ) 
							delete_option( $key, ax_post( $value ) );
							
					}
							
					// Put an settings updated message on the screen 

					echo '
						<script>
						
							jQuery(function() {		
							
								jQuery(\'.' . $append . '\').prepend(\'<p class="updated">' . __( 'Default Settings Restored', PLUGINNAME ) . '</p>\'); 
								
								';
								
								if ( $tab != '' )
									echo 'jQuery(\'.' . $tab . '\').addClass(\'initial\');';
								
								if ( $initial != '' )
									echo 'jQuery(\'.' . $initial . '\').addClass(\'initial\');';
											
								echo '
								
							});	
							
						</script>
					';								
						
				} else {
					
					foreach ( $_POST as $key => $value ) {
							
						if ( $key != $formname && $key != 'Submit' ) {
						
							update_option( $key, nmp_post( $value ) );
							
						}
							
					}	

					// Put an settings updated message on the screen 

					echo '
						<script>
						
							jQuery(function() {	
							
								jQuery(\'.' . $append . '\').prepend(\'<p class="updated">' . __( 'Settings Saved', PLUGINNAME ) . '</p>\'); 
								
								';
								
								if ( $tab != '' )
									echo 'jQuery(\'.' . $tab . '\').addClass(\'initial\');';
								
								if ( $initial != '' )
									echo 'jQuery(\'.' . $initial . '\').addClass(\'initial\');';
											
								echo '
								
							});	
							
						</script>
					';		

				}
					
			}			

					
			echo '
			
				<div class="wrap">
					<div id="icon-themes" class="icon32"></div>
					<h2>' . PLUGINNAME . ' Settings</h2>
					<div class="nmp_admin_panel nmp_tabpanel">
						<ul class="tabs">
							<li class="tab_dashboard">' . __('Dashboard', PLUGINNAME ) . '</li>
							<li class="tab_settings">' . __('Settings', PLUGINNAME ) . '</li>
							<li class="tab_import">' . __('Import', PLUGINNAME ) . '</li>
							<li>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="8QDFK45CF3UUU">
								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>							
							</li>
						</ul>
						<ul class="panels">
							<li class="append_dashboard">'; nmp_dashboard(); echo '</li>
							<li class="append_settings">'; nmp_settings(); echo '</li>
							<li class="append_import">'; nmp_import_cams(); echo '</li>
						</ul>
						<br class="clear" />
					</div>
				</div>
			';		
	
		}
		
	function nmp_dashboard() {
	
        // The array containing the admin page option values.
            
            $args = array(
				'tab'			=> 'tab_dashboard',
				'initial'		=> '',				
				'append'		=> 'append_dashboard',
                'formname' 		=> 'nmp_dashboard',
				'subformname' 	=> '',
                'title' 		=> __( ' Dashboard', THEMENAME ),
                'description' 	=> __( '', THEMENAME ), 
                'groups'	 	=> array(
				
				// General Settings...
				
					array (
						'before' 			=> '<div class="cache_subpanel">',
						'after' 			=> '</div>',						
						'title' 			=> __( 'Chaturbate Posts Plugin by nomoneyinporn.org', PLUGINNAME ),    
						'description' 		=> '', 
						'preview'			=> NULL,
						'fields' 			=> array(
							
						// Introduction
								
                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Requirements', PLUGINNAME ),
                                'desc' 		=> '',
                                'id' 		=> '',
                                'type' 		=> 'intro',
                                'default' 	=> ''						
                            ),
							
                        )
                    )							
                    
                )

            );
            
            // Load the Form
            
            nmp_adminpage($args);
			
	}
		
    function nmp_settings() {
	
       // The array containing the admin page option values.
            
            $args = array(
				
				'tab'			=> 'tab_settings',
				'initial'		=> '',
				'append'		=> 'append_settings',
                'formname' 		=> 'nmp_submit_settings',			
                'title' 		=> 		__( ' Settings', PLUGINNAME ),
                'description' 	=> __( '', PLUGINNAME ), 
                'groups'	 	=> array(
				
				// General Settings...
				
					array (
						'before' 			=> '<div class="general_subpanel">',
						'after' 			=> '</div>',						
						'title' 			=> __( 'General Settings', PLUGINNAME ),    
						'description' 		=> '', 
						'preview'			=> NULL,
						'fields' 			=> array(
						
						// Chaturbate Username
								
                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Chaturbate Username', PLUGINNAME ),
                                'desc' 		=> __( 'This is only useful if you embed a personal chatroom', PLUGINNAME ),
                                'id' 		=> 'cb_username',
                                'type' 		=> 'text',
                                'default' 	=> USER							
                            ),
							
						// Chaturbate ID
								
                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Chaturbate Affiliate ID', PLUGINNAME ),
                                'desc' 		=> '',
                                'id' 		=> 'cb_affid',
                                'type' 		=> 'text',
                                'default' 	=> AFFID							
                            ),	

						// Chaturbate Campaign ID
								
                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Chaturbate Campaign ID', PLUGINNAME ),
                                'desc' 		=> '',
                                'id' 		=> 'cb_campaign',
                                'type' 		=> 'text',
                                'default' 	=> TRACK							
                            ),	
	
						// Program Mode
							
							array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',
								'name' 		=> __( 'Program Mode', PLUGINNAME ),
								'desc' 		=> '', 
								'id' 		=> 'cb_mode',
								'type' 		=> 'radio',
								'default' 	=> MODE,
								'options' 	=> array(
									array('name' => ' Per Signup', 'value' => 'signup'),
									array('name' => ' Revshare', 'value' => 'revshare')
								)								
							),

						// Paging
							
							array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',
								'name' 		=> __( 'Sort Method', PLUGINNAME ), 
								'desc' 		=> '',
								'id' 		=> 'cb_sort',
								'type' 		=> 'radio', // text,textarea,select,radio,checkbox
								'default' 	=> 'isotope',
								'options' 	=> array(
									array('name' => ' Isotope', 'value' => 'isotope'),
									array('name' => ' Paging', 'value' => 'paging')
								)								
							),							

						// Featured Chatroom
							
							array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',
								'name' 		=> __( 'Featured Chatroom', PLUGINNAME ), 
								'desc' 		=> 'The chatroom that is displayed if the current provider is offline.',
								'id' 		=> 'cb_room',
								'type' 		=> 'radio', // text,textarea,select,radio,checkbox
								'default' 	=> ROOM,
								'options' 	=> array(
									array('name' => ' Top', 'value' => 'top'),
									array('name' => ' Personal', 'value' => 'personal'),
									array('name' => ' Male', 'value' => 'male'),
									array('name' => ' Transexual', 'value' => 'transexual'),
								)								
							),
							
						// Show Related
							
							array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',
								'name' 		=> __( 'Show Related Cams', PLUGINNAME ), 
								'desc' 		=>  __( 'Shows related cams on the single cam page.', PLUGINNAME ),
								'id' 		=> 'cb_related',
								'type' 		=> 'radio', // text,textarea,select,radio,checkbox
								'default' 	=> 'yes',
								'options' 	=> array(
									array('name' => ' Yes', 'value' => 'yes'),
									array('name' => ' No', 'value' => 'no')
								)								
							),
							
						// Related Title
								
                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Related Cams Title', PLUGINNAME ),
                                'desc' 		=> '',
                                'id' 		=> 'cb_related_title',
                                'type' 		=> 'text',
                                'default' 	=> 'More Free Cams'							
                            ),								

						// Related Count
								
                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Number of Related Cams', PLUGINNAME ),
                                'desc' 		=> '',
                                'id' 		=> 'cb_related_num',
                                'type' 		=> 'text',
                                'default' 	=> 10							
                            ),								

						// Whitelabel Domain

                            array(
								'before' 	=> '<div class="nmp_group">',
								'after' 	=> '</div>',								
                                'name' 		=> __( 'Whitelabel Domain', PLUGINNAME ),
                                'desc' 		=> __( 'If you are using a whitelabel and want to promote using this domain instead of chaturbate.com set it below.', PLUGINNAME ),
                                'id' 		=> 'cb_wl',
                                'type' 		=> 'text',
                                'default' 	=> CBWL							
                            )									
                        )
                    ),

 
                )

            );
            
            // Load the Form
            
            nmp_adminpage($args);	

    }

	// Builds the admin page based on array input.
		
	function nmp_adminpage( $args ) {
	
		if ( current_user_can( 'edit_theme_options' ) ) {
		
			wp_enqueue_script( 'nmp_tabs');
			
			$hidden_field_name 	= $args[ 'formname' ];	 
			
			// The form header			
			
			echo '<div class="nmp_form">';
					
			echo '<form name="' . $args[ 'formname' ] . '" method="post" action="">'.
					'<input type="hidden" name="' . $hidden_field_name . '" value="Y" />'.	
					'<input type="hidden" name="formname" value="' . $args[ 'formname' ] . '" />'.
					'<input type="hidden" name="tab" value="' . $args[ 'tab' ] . '" />'.
					'<input type="hidden" name="initial" value="' . $args[ 'initial' ] . '" />'.
					'<input type="hidden" name="append" value="' . $args[ 'append' ] . '" />';
				
			// Print each option group
			
			foreach ( $args[ 'groups' ] as $group ) {
				
				if ( $group[ 'before' ] ) 
					echo $group[ 'before' ];
				
				if ( $group[ 'title' ] ) 
					echo '<h3>' . $group[ 'title' ] . '</h3><hr />';
					
				if ( $group[ 'description' ] ) 
					echo '<p>' . $group[ 'description' ] . '</p>';

				// Typography Preview Windows

					if ( $group[ 'preview' ] ) 
						nmp_showprev( $group[ 'preview' ] );
										
			 
				
				// Print each field within the option group
				
				foreach ( $group[ 'fields' ] as $field ) {
					  
					// get the value of the current field.
					$formargs = stripslashes( get_option( $field[ 'id' ] ) );
	
					echo $field[ 'before' ];
					
					echo '<label for="'. $field['id'] .'" class="nmp_label">'. $field['name']. '</label>';
					
					if ( $field['type'] == 'radio' )
						echo '<div class="nmp_radio">';
					
					switch ( $field[ 'type' ] ) {
					
						case 'text':
						  
							echo '<input type="text" name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] .'" value="'. ( stripslashes( $formargs ) ? stripslashes( $formargs ) : $field[ 'default' ] ) . '" class="nmp_input" />';
							break;
							  
						case 'textarea':
						  
							echo $field[ 'before' ] . '<textarea name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] . '" cols="60" rows="4" class="nmp_input" >'. ( stripslashes( $formargs ) ? stripslashes( $formargs ) : stripslashes( $field[ 'default' ] ) ) . '</textarea>' . $field[ 'after' ];
							break;
							  
						case 'select':
							
							echo '<select name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] . '" class="nmp_select">';
							
							foreach ( $field[ 'options' ] as $option ) {

								echo '<option value="'. $option[ 'value' ] . '"'; 

								if ( $formargs == $option[ 'value' ] ) {
								
									echo ' selected="selected"';
									
								} elseif ( !$formargs && $field[ 'default' ] == $option[ 'value' ] ) {
								
									echo ' selected="selected"';
									
								}
									
								echo'>'. $option[ 'name' ] . '</option>';
								
							}
							
							echo '</select>';

							break;
							  
						case 'radio':
						  
							foreach ( $field['options'] as $option ) {
	
								echo '<input type="radio" id="' . $field[ 'id' ] . $option['value'] . '" name="' . $field[ 'id' ] . '" value="' . $option['value'] . '"';

								if ( $formargs == $option[ 'value' ] )  
									echo ' checked="checked"';
								else if ( !$formargs && $field[ 'default' ] == $option[ 'value' ] )
									echo ' checked="checked"';
								
								echo ' /><label for="' . $field[ 'id' ] . $option['value'] . '" class="' . $field[ 'id' ] . $option['value'] . '">' . $option[ 'name' ] . '</label>';
							}
							break;
							  
						case 'checkbox':
						  
							echo '<input type="checkbox" name="' . $field[ 'id' ] . '" value="' . $field[ 'value' ] . '" ';

								if ( $formargs == $option[ 'value' ] )  
									echo ' checked="checked"';
								else if ( $field[ 'default' ] == $option[ 'value' ] )
									echo ' checked="checked"'; 
							
							echo ' /> ' . $field[ 'title' ];
							break;
							
						case 'slider':
						  
							echo '
								<input type="text" name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] .'" value="'. ( stripslashes( $formargs ) ? stripslashes( $formargs ) : $field[ 'default' ] ) . '" class="nmp_input_slider right-float" />
								<div id="slider' . $field[ 'id' ] . '" class="input_slider"></div>
								<script>
									jQuery(function() {
										jQuery( "#slider' . $field[ 'id' ] . '" ).slider({
											range: "max",
											min: 0,
											max: 1,
											step: 0.01,
											value: '. ( stripslashes( $formargs ) ? stripslashes( $formargs ) : $field[ 'default' ] ) . ',
											slide: function( event, ui ) {
												jQuery( "#' . $field[ 'id' ] . '" ).val( ui.value );
												jQuery(ui.value).val(jQuery("#' . $field[ 'id' ] . '").val());
											}
										});
										jQuery("#' . $field[ 'id' ] . '").keyup(function() {
											jQuery("#slider' . $field[ 'id' ] . '").slider("value" , jQuery(this).val())											
										});

									});
								</script>	
								
							';
							
							
							break;							
							
						case 'upload':
						
							echo '
							
								<div class="block">
									<input type="text" name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] .'" value="'. ( $formargs ? $formargs : $field[ 'default' ] ) . '" class="nmp_upload" />
									<input id="'. $field[ 'id' ] . '_button" type="button" value="' . __( 'Upload Image', PLUGINNAME ) . '" class="nmp_button" />
									 
									 <script>		
									 
										var uploadID = ""; 
										
										jQuery(document).ready(function() {
											jQuery(\'#' . $field[ 'id' ] . '_button\').click(function() {
												uploadID = jQuery(this).prev(\'input\');
												tb_show(\'' . __( 'Upload a Custom Background', PLUGINNAME ) . '\', \'media-upload.php?post_id=0&amp;type=image&amp;amp;TB_iframe=true\');
												return false;
											});

											window.send_to_editor = function(html) {
												imgurl = jQuery(\'img\',html).attr(\'src\');
												uploadID.val(imgurl);
												tb_remove();
											}
										});									
						
									 </script>
								</div>

							';
							break;
							
						case 'hidden':
						
							echo '<input type="hidden" name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] .'" value="'. ( $formargs ? $formargs : $field[ 'default' ] ) . '"  />';
							break;	
							
						case 'intro':
						
							echo '
							
								<p>
									The first thing you will need to do for this plugin to make any sense is create a <a href="http://chaturbate.com/affiliates/in/07kX/827SM/?track=default" target="_blank"><strong>Chaturbate Affiliate Account</strong></a>.
									If you have one already just move on to the next step.
								</p>
								
								<p>
									The second thing you will need to do is configure the settings for the plugin, otherwise I will get credit for all of your referrals! Feel free to forget this step, I won\'t complain :). To configure the settings, just hit the settings tab to the left.
								</p>
								
								<p>
									Last but not least, click the import tab and import the feed. It will probably take a few minutes to complete. The plugin is scheduled to auto import every 30 minutes.
								</p>
								
								<p>Feel free to customize or modify this plugin as you see fit. If you do happen to add something cool, I would love to have a copy! </p>
													
							
							';
							break;
							
					}
					
					if ( $field['type'] == 'radio' )
						echo '</div><br class="clear" />';
						

					if ( $field[ 'desc' ] ) 
						echo '<p>' . $field[ 'desc' ] . '</p>';	

					 echo $field[ 'after' ];
					 
				} // End Fields
				
				if ( $group[ 'after' ] ) 
					echo $group[ 'after' ];
				
			} // End Group
			
			if ( $args[ 'formname' ] == 'nmp_import' ) {
			
				$input_text = __( 'Import', THEMENAME);
	
			} else {			
				
				$input_text = __( 'Save Changes', PLUGINNAME);
			}
			
			if ( $args[ 'formname' ] != 'nmp_dashboard' )
				echo '<p class="submit"><input type="submit" name="Submit" class="nmp_button" value="' . $input_text . '" />';
			
			if ( $args[ 'formname' ] != 'nmp_import' && $args[ 'formname' ] != 'nmp_dashboard' )
				echo '<input type="submit" name="reset" class="nmp_button" value="' . __( 'Restore Defaults', PLUGINNAME ) . '" />';
					
			echo '</p></form></div>';
					
		} else {
		
			wp_die( __( 'You do not have sufficient permissions to access this page.', PLUGINNAME ) );
		
		}

	}