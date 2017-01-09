<?php 

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_header(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Get Settings
	
		$cb_affid				= get_option( 'cb_affid', AFFID );
		$cb_user				= get_option( 'cb_username', '' );
		$cb_campaign			= get_option( 'cb_campaign', TRACK );
		$cb_mode				= get_option( 'cb_mode', MODE );
		$cb_room				= get_option( 'cb_room', ROOM );
		$cb_related				= get_option( 'cb_related', 'yes' );
		$cb_related_cnt			= get_option( 'cb_related_num', 10 );
		$cb_related_title		= get_option( 'cb_related_title', RELATED_TITLE );
		$cb_wl					= get_option( 'cb_wl', CBWL );
		
	
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
		if ( !$cb_online || $cb_online == '' ) { $cb_online = ''; }
		if ( !$cb_users || $cb_users == '' ) { $cb_users = ''; }
		if ( !$cb_show || $cb_show == '' ) { $cb_show = ''; }
		if ( !$cb_recorded || $cb_recorded == '' ) { $cb_recorded = ''; }
		if ( !$cb_chaturl || $cb_chaturl == '' ) { $cb_chaturl = ''; }
		if ( !$cb_chaturl_rev || $cb_chaturl_rev == '' ) { $cb_chaturl_rev = ''; }
			
	// The Post
			
		echo '<article class="nmp_post">';
	
		if ( $cb_online == 0 ) {
			
			echo '
				<div class="heading">
					<span>' . $cb_camuser . 'is currently offline.</span>
					<a rel="nofollow" class="offsite button" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Register to tip this Hot Model</a>
				</div>	
			';
		
		} else {
		
			echo '
				<div class="heading">
					<span>' . $cb_camuser . '\'s Free Webcam Show</span>
					<a rel="nofollow" class="offsite button" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Register to tip ' . $cb_camuser . '</a>
				</div>	
			';
			
		}
			
		echo '		
			<div class="row">
				<div class="9u">
					<section class="cb_video video-wrapper">
					';					

						
						if ( $cb_mode == 'revshare' ) {
						
							if ( $cb_online == 0 )
								$iframe = nmp_featured( 'revshare', $cb_room, $cb_wl, $cb_affid, $cb_campaign, $cb_user, 528  );
							else 
								$iframe = str_replace( 'chaturbate.com', $cb_wl, $cb_iframe_revshare );
	
									
							echo $iframe;

						} else {
						
							if ( $cb_online == 0 )
								$iframe = nmp_featured( 'signup', $cb_room, $cb_wl, $cb_affid, $cb_campaign, $cb_user, 528  );
							else						
								$iframe = str_replace( 'chaturbate.com', $cb_wl, $cb_iframe_signup );
	
							echo $iframe;
									
						}
								
						
						
						echo '
						
					</section>
				</div>
				<div class="3u">
					<ul class="list1">		
						<li>' . $cb_age . ' ' . $cb_gender . '</li>
						<li>' . $cb_location . '</li>
						<li><i class="fa fa-clock-o"></i>&nbsp; ' . nmp_ago( $cb_online ) . '</li>
						<li><i class="fa fa-eye"></i>&nbsp; ' . $cb_users . '</li>
						';
	
						if( $cb_mode == 'revshare' ) {
							echo '<li><a rel="nofollow" class="offsite button" href="' . $cb_chaturl_rev . '" >View Profile</a></li>';
						} else {
							echo '<li><a rel="nofollow" class="offsite button" href="' . $cb_chaturl . '" >View Profile</a></li>';
						}
										
						echo '
					</ul>
				</div>
			</div>
	';
	
	
		if ( $cb_online == 0 ) {
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Offline
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		

			$offline_desc = array(
			
				'<p>Unfortunately <strong>' . $cb_camuser . '</strong> is currently offline. However, to chat with the current model, view their private profile photos and video clips, and many more member-only features... you\'ll need a <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '"><strong>FREE</strong> account</a>. <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Create your <strong>FREE</strong> account</a> now to join in on the fun!</p>',	
				
				'<p>Sadly, <strong>' . $cb_camuser . '</strong> isn\'t online at the moment. Not to worry though, because there are dozens of other models that are available for some fun this very second. Simply <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up</a> and get unlimited access to private photos, exclusive video clips and reap the rewards of a <strong>FREE</strong> account. <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Create your <strong>FREE</strong> account</a> today and come and have some fun.</p>',

				'<p>The user <strong>' . $cb_camuser . '</strong> is current offline. Thankfully, we have plenty of other models that you can have fun with once you <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">create your <strong>FREE</strong> account</a>. Get unlimited live cam action today and enjoy the many members-only features we boast! It\'ll only take a few minutes, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">so come on in</a> and let\'s have some fun.</p>',

				'<p>The model <strong>' . $cb_camuser . '</strong> is currently offline. Not to worry though, as our site is jam packed full of hot models that are looking for live sex fun. Why not <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up today</a> and watch some of the best sex cam performers around having fun in front of you? It will only take a minute and best of all, your account is 100% <strong>FREE</strong>!</p>',

				'<p><strong>' . $cb_camuser . '</strong> is currently offline: don\'t worry, though. Our site has a large number of attractive models that are ready and willing to let you see them have fun in the nude. All you need to do is <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up for a <strong>FREE</strong> account</a> and we\'ll give you plenty of bonus features including model chat, exclusive videos, private model pictures and more. Don\'t delay, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">join today</a>!</p>',
				
				'<p>The model <strong>' . $cb_camuser . '</strong> is currently offline and unavailable for chat. If you would like to look for more cam models to have <strong>FREE</strong> live sex with, simply <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up today</a> and get <strong>FREE</strong> access to a bunch of bonus features we know you\'ll love. <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Create your account today</a> and see more great models like <strong>' . $cb_camuser . '</strong>.</p>',

				'<p>Unfortunately, <strong>' . $cb_camuser . '</strong> is currently offline and unavailable for live sex chatting. If you would like to view a webcam model that is currently online and ready for some fun, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">create a <strong>FREE</strong> account</a> today and do exactly that. We know you\'ll love all the benefits that come with <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">signing up</a>: so get inside and let\'s have some fun!</p>',

				'<p><strong>' . $cb_camuser . '</strong> is currently offline, sorry! Not to worry though: there are dozens of online models that are waiting for you to come and have some fun. If you want the best <strong>FREE</strong> live sex of your life, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">create an account today</a>!</p>',

				'<p>We\'re sorry, but <strong>' . $cb_camuser . '</strong> is currently offline and unavailable for live chat. If you would like to talk to a different model that is online, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">create a <strong>FREE</strong> account today</a> and get instant access to a number of members-only features. What are you waiting on? Let\'s have some fun today!</p>',

				'<p>The user <strong>' . $cb_camuser . '</strong> is currently unavailable for live chat as they are offline. If you would still like to have webcam sex, a number of other models are online and ready for some fun. So don\'t delay and let\'s have some live sex today! <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Click here to join in</a>!</p>',

				'<p>Hey there. <strong>' . $cb_camuser . '</strong> isn\'t online at the moment, but there are a number of other models you can come and have some fun with after you <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up for your <strong>FREE</strong> account</a>. Reap the benefits of <strong>FREE</strong> chat and unlimited access to private photos and videos featuring cam models like <strong>' . $cb_camuser . '</strong>. What are you waiting for? <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Become a part of the #1 cam community now</a>!</p>'
				
			);
			
			$offline_rand = array_rand( $offline_desc, 1 );
			
			echo '
				<section>
					' . $offline_desc[$offline_rand] . '
				</section>
			';	
			
		} else {
		

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Online
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			

			$online_desc = array(
			
				'<p>Welcome to <strong>' . $cb_camuser . '\'s</strong> live stream and chat room! Watching <strong>' . $cb_camuser . '</strong> getting naked, fucking, sucking, etc... is completely <strong>FREE</strong>! However, to chat with <strong>' . $cb_camuser . '</strong>, view <strong>' . $cb_camuser . '\'s</strong> private profile photos and video clips, and many more member-only features... you\'ll need a <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '"><strong>FREE</strong> account</a>. Right now, <strong>' . $cb_camuser . '</strong> is responding live to viewers... <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Create your <strong>FREE</strong> account</a> now to join in on the fun!</p>',
				
				'<p>Hey there! It\'s great to see that you want to visit <strong>' . $cb_camuser . '\'s</strong> live sex stream. You can come here and watch them get naked, play with themselves and generally have a great time in front of the webcam. Sticking around and watching is <strong>FREE</strong>, but if you\'d like to chat with <strong>' . $cb_camuser . '</strong>, you\'re going to have to <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up for an account</a>! Don\'t worry, it doesn\'t cost anything, and it even comes with plenty of features that we know you\'ll love. So what are you waiting for? <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Join us today</a> and chat with <strong>' . $cb_camuser . '</strong>!</p>',

				'<p>Welcome to the <strong>FREE</strong> sex chat room of <strong>' . $cb_camuser . '</strong>. You\'re more than welcome to sit here and enjoy the session of <strong>FREE</strong> cam sex, but you should know that if you want to chat with <strong>' . $cb_camuser . '</strong>, you\'ll need to create a <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '"><strong>FREE</strong> account</a>. It doesn\'t take that long, and with <strong>FREE</strong> access to a bunch of bonus features including exclusive videos and hot pictures, you\'ll love signing up! <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Come and join in today</a>, <strong>' . $cb_camuser . '</strong> is waiting!</p>',
				
				'<p>Howdy. You\'re currently viewing <strong>' . $cb_camuser . '\'s</strong> live cam sex chat room. You\'re going to see a lot of erotic action right here, and we hope you enjoy it as much as possible! That said, if you want to take your experience to the next level and actually chat with <strong>' . $cb_camuser . '</strong>, be sure to <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up for a <strong>FREE</strong> account</a>. You get plenty of bonus features including access to hot videos and pictures that are uploaded by the cammers themselves! Don\'t hesitate and <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">join today</a> - you\'ll love chatting to <strong>' . $cb_camuser . '</strong>.</p>',
				
				'<p>You\'re currently looking at the live sex stream of <strong>' . $cb_camuser . '</strong>. While you\'re <strong>FREE</strong> to enjoy this content as much as you like, you should know that in order to chat with the model, you will need an account. <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Signing up to our site</a> is totally <strong>FREE</strong> and comes with a bunch of bonus features, including access to exclusive model pictures and videos. So what are you waiting for? <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Sign up to our site today</a> and have more fun with <strong>' . $cb_camuser . '</strong> than you could possibly imagine!</p>',

				'<p>Hey there: you\'re currently enjoying the <strong>FREE</strong> live sex stream of <strong>' . $cb_camuser . '</strong>. You can stay here for as long as you like and watch them strip, suck and fuck, but you should know that in order to chat to <strong>' . $cb_camuser . '</strong> and have access to their private video and picture collection, you\'ll need to <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up for a <strong>FREE</strong> account</a>. It only takes a few minutes, and we guarantee the payoff of chatting live with <strong>' . $cb_camuser . '</strong> is more than worth it! <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Sign up today</a>.</p>',

				'<p>You are enjoying the chat room and <strong>FREE</strong> live sex stream of <strong>' . $cb_camuser . '</strong>. If you would like to chat directly with <strong>' . $cb_camuser . '</strong> and take a look at their exclusive video and photo collection, a <strong>FREE</strong> account is the way to do it! Simply <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up today</a> and reap the benefits of a 100% <strong>FREE</strong> account that will be sure to bring you plenty of fun and excitement. <strong>' . $cb_camuser . '</strong> is waiting for you: <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">won\'t you come and say hello</a>?</p>',

				'<p>Hello! You are currently watching the live sex feed of <strong>' . $cb_camuser . '</strong>. If you would like to join in on the chat and take a look at <strong>' . $cb_camuser . '\'s</strong> exclusive photos and videos uploaded for members of the site, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up today</a>! It only takes a minute, and you\'ll have the instant ability to talk to <strong>' . $cb_camuser . '</strong>. So what are you waiting for? <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">Create your <strong>FREE</strong> account</a> now and reap the benefits instantly!</p>',
				
				'<p>This is the chat room and webcam stream of <strong>' . $cb_camuser . '</strong>. You can stay here and watch the best cam action around for as long as you want, but if you\'d like to talk directly to <strong>' . $cb_camuser . '</strong>, you will need to <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">create an account</a>. It only takes a minute, and you\'ll be given the instant benefit of being able to see every members-only picture and video we have inside. So don\'t delay and <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">join today</a>: <strong>' . $cb_camuser . '</strong> is waiting for you.</p>',

				'<p>Welcome to the live sex stream and interactive chat room of <strong>' . $cb_camuser . '</strong>. While you can watch <strong>' . $cb_camuser . '</strong> get naked, play with themselves and generally have a great time, if you\'d like to chat and take a look at their private profile pictures and video clips, you\'ll need to <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">create an account</a>. It\'s 100% <strong>FREE</strong> and takes less than a minute, so <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">come and chat</a> with <strong>' . $cb_camuser . '</strong> today and let\'s all have some sexy fun!</p>',
				
				'<p><strong>' . $cb_camuser . '</strong> is currently streaming live and you\'re watching their show! While you\'re <strong>FREE</strong> to enjoy it as much as possible, we think those that <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up</a> have the most fun as they can chat directly to the model. To take advantage of this members-only feature, as well as a number of other benefits that come with a <strong>FREE</strong> account, <a rel="nofollow" class="offsite" href="http://' . $cb_wl . '/affiliates/in/3Mc9/' . $cb_affid . '/?track=' . $cb_campaign . '">sign up today</a> and have some fun with <strong>' . $cb_camuser . '</strong>.</p>'
			
			);
			
			$online_rand = array_rand( $online_desc, 1 );
			
			echo '
				<section>
					' . $online_desc[$online_rand] . '
				</section>
			';
			
		}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// The Content
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		the_content();	
						
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Show Related Posts
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
		if ( $cb_related )
			nmp_get_related( $cb_related_title, $cb_gender, $cb_related_cnt );

	echo '</article>';
	


	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_footer(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>