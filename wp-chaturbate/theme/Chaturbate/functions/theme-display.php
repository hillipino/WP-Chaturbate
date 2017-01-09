<?php
		// Show Cam Thumbnail
		
			function nmp_thumbnail( $link, $user, $image, $show, $age, $gender, $online, $viewers ) {
				echo '
					<li class="element ' . $gender . '">
					
						<div class="cb_thumbnail">
							<a href="' . $link . '" title="' . $user . '\'s Free Webcam"><img src="' . $image . '" alt="' . $user . '" /></a>
							<div class="cb_status ' . $show . '">' . $show . '</div>
						</div>

						<div class="cb_user">
							<a href="' . $link . '" title="' . $user . '\'s Free Webcam"><i class="fa fa-user"></i>&nbsp;<span class="name">' . nmp_limit_chars( $user, 20 ) . '</span></a>
							<span class="cb_age"><span class="age">' . $age . '</span> <span class="cb_gender">' . $gender . '</span></span>
						</div>
						<span class="online" style="display: none;">' . $online . '</span>
						<div class="cb_time_online"><i class="fa fa-clock-o"></i>&nbsp;' .  nmp_ago( $online ) . '</div>
						<div class="cb_num_users"><span class="viewers">' . $viewers . '</span>&nbsp;<i class="fa fa-eye"></i></div>
					</li>
				';			
			}
			
		// Featured Cam
		
			function nmp_featured( $mode, $room, $wl, $aff, $track, $user, $height  ) {
			
				switch ( $mode ) {
					
					case signup: 	//signup mode
					
						switch ( $room ) {
							
							case personal:
								$go = 'Jrvi';
								break;
							case top:
								$go = 'NxHf';
								break;								
							case male:
								$go = 'SKWo';
								break;								
							case transexual:
								$go = 'JXvq';
								break;	
								
						}
						
						break;

					default: 		// revshare mode

						switch ( $room ) {
							
							case personal:
								$go = '9oGW';
								break;
							case top:
								$go = 'dTm0';
								break;								
							case male:
								$go = 'CoeM';
								break;								
							case transexual:
								$go = 'zoQq';
								break;	
								
						}					
						
						break;

				}			
			
				if ( $room == 'personal' )
					echo '<iframe src="http://' . $wl . '/affiliates/in/' . $go . '/' . $aff . '/?track=' . $track . '&amp;room=' . $user . '&amp;bgcolor=transparent" height="' . $height . '" width="850" ></iframe>';
				else
					echo '<iframe src="http://' . $wl . '/affiliates/in/' . $go . '/' . $aff . '/?track=' . $track . '&amp;bgcolor=transparent" height="' . $height . '" width="850" ></iframe>';
			
			}			

			

	
	// Get Related Cams
	
		function nmp_get_related( $title = NULL, $gender = 'female', $count = 9 ) {
		
			global $post;
	
			echo '<section class="obj-related nmp_post">';
			
			if ( $title )
				echo '<div class="heading"><span>' . $title . '</span></div>';				
			
			echo '
				<div class="row">
					<div class="12u">
						<ul class="cb_thumbs">
			';				

					$backup = $post;  // backup the current object
					
					$zero = 0;
	
						$args=array(
							'post__not_in' 			=> array($post->ID), 
							'post_type' 			=> 'webcam',
							'gender'				=> $gender,
							'posts_per_page'		=> $count,
							'ignore_sticky_posts'	=> 1,
							'meta_query' => array(
								array(
									'key' => '_cb_online',
									'value' => $zero,
									'compare' => '!='
								)
							),								
			
						);
						$my_query = new WP_Query($args);
			
						if( $my_query->have_posts() ) {
						
							while ($my_query->have_posts()) {							
								
								$my_query->the_post(); 
								
								$cb_camuser 			= trim( get_post_meta( get_the_ID(), '_cb_camuser', TRUE ) );
								$cb_displayname 		= trim( get_post_meta( get_the_ID(), '_cb_displayname', TRUE ) );
								$cb_age 				= trim( get_post_meta( get_the_ID(), '_cb_age', TRUE ) );
								$cb_gender 				= trim( get_post_meta( get_the_ID(), '_cb_gender', TRUE ) );
								$cb_birthdate 			= trim( get_post_meta( get_the_ID(), '_cb_birthdate', TRUE ) );
								$cb_image	 			= trim( get_post_meta( get_the_ID(), '_cb_image', TRUE ) );
								$cb_location 			= trim( get_post_meta( get_the_ID(), '_cb_location', TRUE ) );
								$cb_language 			= trim( get_post_meta( get_the_ID(), '_cb_language', TRUE ) );
								$cb_iframe_revshare 	= trim( get_post_meta( get_the_ID(), '_cb_iframe_revshare', TRUE ) );
								$cb_iframe_signup 		= trim( get_post_meta( get_the_ID(), '_cb_iframe_signup', TRUE ) );	
								$cb_online 				= trim( get_post_meta( get_the_ID(), '_cb_online', TRUE ) ); 		// seconds online
								$cb_users 				= trim( get_post_meta( get_the_ID(), '_cb_users', TRUE ) );			// viewers
								$cb_show 				= trim( get_post_meta( get_the_ID(), '_cb_show', TRUE ) );			// current_show: "public", "private", "group", or "away".
								$cb_recorded 			= trim( get_post_meta( get_the_ID(), '_cb_recorded', TRUE ) );		// recorded: "true" or "false".
								$cb_chaturl 			= trim( get_post_meta( get_the_ID(), '_cb_chat_url', TRUE ) );
								$cb_chaturl_rev 		= trim( get_post_meta( get_the_ID(), '_cb_chat_url_rev', TRUE ) );
								
								if ( !$cb_camuser || $cb_camuser == '' ) { $cb_camuser = ''; }
								if ( !$cb_displayname || $cb_displayname == '' ) { $cb_displayname = ''; }
								if ( !$cb_age || $cb_age == '' ) { $cb_age = ''; }
								if ( !$cb_gender || $cb_gender == '' ) { $cb_gender = ''; }
								if ( !$cb_birthdate || $cb_birthdate == '' ) { $cb_birthdate = ''; }
								if ( !$cb_image || $cb_image == '' ) { $cb_image = ''; }
								if ( !$cb_location || $cb_location == '' ) { $cb_location = ''; }
								if ( !$cb_language || $cb_language == '' ) { $cb_language = ''; }
								if ( !$cb_iframe_revshare || $cb_iframe_revshare == '' ) { $cb_iframe_revshare = ''; }
								if ( !$cb_iframe_signup || $cb_iframe_signup == '' ) { $cb_iframe_signup = ''; }
								if ( !$cb_online || $cb_online == '' ) { $cb_online = 0; }
								if ( !$cb_users || $cb_users == '' ) { $cb_users = 0; }
								if ( !$cb_show || $cb_show == '' ) { $cb_show = ''; }
								if ( !$cb_recorded || $cb_recorded == '' ) { $cb_recorded = ''; }
								if ( !$cb_chaturl || $cb_chaturl == '' ) { $cb_chaturl = ''; }
								if ( !$cb_chaturl_rev || $cb_chaturl_rev == '' ) { $cb_chaturl_rev = ''; }			

								
								// Get Permalink
								
									$link = get_permalink();								

								nmp_thumbnail( $link, $cb_camuser, $cb_image, $cb_show, $cb_age, $cb_gender, $cb_online, $cb_users );

							}
							
						} else {
			
							echo '<header><h2>' . __('No related posts found!', THEMENAME) . '</h2>';
							
						}

							$post = $backup;  // copy it back
							wp_reset_query(); // to use the original query again

							echo '
							</ul>
						</div>
					</div>
				</section>
			';	
			
		}