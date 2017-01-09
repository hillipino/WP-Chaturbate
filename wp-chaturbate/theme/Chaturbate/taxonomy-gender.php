<?php 

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_header(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//global $wp_query;
	global $query_string;

	// Get Settings
	
		$cb_affid				= get_option( 'cb_affid', AFFID );
		$cb_user				= get_option( 'cb_username', '' );
		$cb_campaign			= get_option( 'cb_campaign', TRACK );
		$cb_mode				= get_option( 'cb_mode', MODE );
		$cb_room				= get_option( 'cb_room', ROOM );
		$cb_related				= get_option( 'cb_related', true );
		$cb_related_cnt			= get_option( 'cb_related_num', 8 );
		$cb_wl					= get_option( 'cb_wl', CBWL );
		$cb_sort				= get_option( 'cb_sort', 'isotope' );
			
		if ( $cb_sort == 'paging' ) {
			$ppp = 27;
		} else {
			$ppp = -1;
		}
		
		$zero = 0;

		query_posts( $query_string . '&posts_per_page= ' . $ppp . '&meta_key=_cb_online&orderby=meta_value_num&meta_value=' . $zero . '&meta_compare=!=&order=ASC' );
		
	// Get Posts

		if ( !have_posts() ) {

			echo '
				<section class="nmp_post 404">
					<h2>Not Found</h2>
					<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
				</section>
			';
			
		} else {
			
			echo '<article class="nmp_post">';
			
			if ( $cb_sort == 'isotope' ) {
				
				echo '

							<section id="options">
							
								<div class="row">
								
									<div class="2u">
										<div class="gender_nav">
											<a class="dropnav button">Gender &nbsp;<i class="fa fa-angle-down"></i></a>
											<ul class="gender">
												<li><a href="' . home_url() . '/webcams/all/">All</a></li>
												<li><a href="' . home_url() . '/webcams/couple/">Couple</i></a></li>
												<li><a href="' . home_url() . '/webcams/female/">Female</a></li>
												<li><a href="' . home_url() . '/webcams/male/">Male</a></li>
												<li><a href="' . home_url() . '/webcams/shemale/">Shemale</a></li>
											</ul>
										</div>
									</div>
											
									<div class="7u">

										<ul id="sort-by" class="option-set clearfix" data-option-key="sortBy" class="sort">
											<li><a href="#sortBy=original-order" data-option-value="original-order" class="button selected">original-order</a></li>
											<li><a href="#sortBy=age" data-option-value="age" class="button">Age</a></li>
											<li><a href="#sortBy=name" data-option-value="name" class="button">Name</a></li>
											<li><a href="#sortBy=online"  data-option-value="online" class="button">Time Online</a></li>
											<li><a href="#sortBy=viewers" data-option-value="viewers" class="button">Viewers</a></li>
										</ul>	
										
									</div>
									
									<div class="3u text-right">
									
										<ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending" class="sort">
											<li><a href="#sortAscending=true" data-option-value="true" class="selected button"><i class="fa fa-angle-double-down"></i></a></li>
											<li><a href="#sortAscending=false" data-option-value="false" class="button"><i class="fa fa-angle-double-up"></i></a></li>
										</ul>
										
									</div>
								
								</div>
								
							</section>
							
				';
						
			} else {
				
				echo '

								<div class="row">
									<div class="12u">
										<div class="gender_nav">
											<a class="dropnav button">Gender &nbsp;<i class="fa fa-angle-down"></i></a>
											<ul class="gender">
												<li><a href="' . home_url() . '/webcams/all/">All</a></li>
												<li><a href="' . home_url() . '/webcams/couple/">Couple</i></a></li>
												<li><a href="' . home_url() . '/webcams/female/">Female</a></li>
												<li><a href="' . home_url() . '/webcams/male/">Male</a></li>
												<li><a href="' . home_url() . '/webcams/shemale/">Shemale</a></li>
											</ul>
										</div>
									</div>	
								</div>
				';
				
			}
					
					echo '
						
						<section class="isotope">
							<div class="row">
								<div class="12u">
									<ul class="cb_thumbs">
									
									
									
					';	
			
			// Start a counter
				
				$count = 0;	

			while ( have_posts() ) {
			
				the_post();
				
				// Get Post Meta
				
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
				
				// Determine how to display the cams.
					
					// Get Permalink
					
						$link = get_permalink();
				
					// Print thumbnails
					
						nmp_thumbnail( $link, $cb_camuser, $cb_image, $cb_show, $cb_age, $cb_gender, $cb_online, $cb_users );
						
					// Increment Counter
					
						$count++;
						
			}
			
			echo '
								</ul>
							</div>
						</div>
					</section>
				</article>
			';
			
		}
			
		if ( $cb_sort == 'paging' ) {
		
			if ( $wp_query->max_num_pages > 1 ) {
				
				echo '
					<div class="clearfix"></div>
						<section class="cb_pager">';
						
						if ( function_exists( nmp_paginate ) ) {
							
							nmp_paginate();
						
						} else {

							echo previous_posts_link( __( 'Newer posts', THEMENAME) );	
							echo next_posts_link( __( 'Older posts', THEMENAME) );
							
						}
				
				echo '
						</section>
					<div class="clearfix"></div>
				';
				
			}
			
		}
	

	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_footer(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>