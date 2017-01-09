<?php


	// Minimize CSS
	
		function minimizeCSS($s)
		{
			$s = preg_replace('@/\*.*\*/@m', '', $s);
			$s = preg_replace('/^\s+/m', '', $s);
			$s = str_replace(array("\r", "\n"), '', $s);
			return $s;
		} 		
		
	// Remove Wordpress Version
	
		function nmp_RemoveGen() { return ''; }
		
		add_filter( 'the_generator', 'nmp_RemoveGen' );
		
	// Human readable date
	
		function nmp_human_date( $date ) {
		
			$date = human_time_diff( strtotime( $date ), current_time( 'timestamp' ) ) . __( ' ago', THEMENAME );
			return $date;
			
		}		
	
	// Append a class to next post link
	
		function nmp_link_next_class($link) {
			
			$link = str_replace( '<a', '<a class="button" ', $link );
			return $link;
		} 
		
		add_filter( 'next_post_link', 'nmp_link_next_class' );
			
		
	// Append a class to previous post link
	
		function nmp_link_prev_class($link) {
			
			$link = str_replace( '<a', '<a class="button" ', $link );
			return $link;
		} 
		
		add_filter( 'previous_post_link', 'nmp_link_prev_class' );		


	// Sets the post excerpt length to 30 characters.
	
		function nmp_excerpt_length( $length ) {
		
			return NMP_EXCERPT_L;
			
		}
		
		add_filter( 'excerpt_length', 'nmp_excerpt_length' );

	// Function to Limit words of string.

		function limit_words( $string, $word_limit ) {
		 
			$string = preg_replace( "/&#?[a-z0-9]{2,8};/i", "", strip_tags( $string ) );
			$words 	= explode( ' ', $string );
			
			if ( count( $words ) > $word_limit ) {
			
				return implode( ' ', array_slice($words, 0, $word_limit ) ) . " [...]";
				
			} else {
			
				return implode( ' ', array_slice( $words, 0, $word_limit ) );
				
			}
		 
		}	
	
						
		// Check The wordpress version 
		
			function is_wp_version( $is_ver ) {
			
				$wp_ver = explode( '.', get_bloginfo( 'version' ) );
				$is_ver = explode( '.', $is_ver );
				
				for( $i=0; $i<=count( $is_ver ); $i++ )
					if( !isset( $wp_ver[$i] ) ) array_push( $wp_ver, 0 );
			 
				foreach( $is_ver as $i => $is_val )
					if( $wp_ver[$i] < $is_val ) return false;
					
				return true;
				
			}	
		

		// Human Readable Time

			function nmp_ago( $secs ) {
			
				$secs = intval(str_replace(" ", "", $secs));
			
				$second = 1;
				$minute = 60;
				$hour = 60*60;
				$day = 60*60*24;
				$week = 60*60*24*7;
				$month = 60*60*24*7*30;
				$year = 60*60*24*7*30*365;
				 
				if ($secs <= 0) { $output = "offline";
				}elseif ($secs > $second && $secs < $minute) { $output = round($secs/$second)." second";
				}elseif ($secs >= $minute && $secs < $hour) { $output = round($secs/$minute)." minute";
				}elseif ($secs >= $hour && $secs < $day) { $output = round($secs/$hour)." hour";
				}elseif ($secs >= $day && $secs < $week) { $output = round($secs/$day)." day";
				}elseif ($secs >= $week && $secs < $month) { $output = round($secs/$week)." week";
				}elseif ($secs >= $month && $secs < $year) { $output = round($secs/$month)." month";
				}elseif ($secs >= $year && $secs < $year*10) { $output = round($secs/$year)." year";
				}else{ $output = " more than a decade ago"; }
				 
				if ($output <> "offline"){
				$output = (substr($output,0,2)<>"1 ") ? $output."s" : $output;
				}
				return $output;
				
			}	
		
		
		// Function to Limit characters of string.

			function nmp_limit_chars( $string, $word_limit ) {
			 
				$string = preg_replace( "/&#?[a-z0-9]{2,8};/i", "", strip_tags( $string ) );
				$words 	= explode( ' ', $string );
				
				$new_string = substr( $string, 0, $word_limit );
				
				return $new_string;
			 
			}			
		
	
		// Wrappers for GET and POST
		
			function nmp_get($x) {
				if ( isset( $_GET[$x] ) ) return $_GET[$x]; return NULL; 		
			}
			
			function nmp_post($x) {
			
				if ( isset( $x ) ) {
				
					$x = trim( htmlentities( strip_tags( $x ) ) );
					
					if (get_magic_quotes_gpc())
						$x = stripslashes($x);
				 
					$x = mysql_real_escape_string($x);	
					
					return $x; 
				
				} else {	
				
					return NULL; 
				
				}
				
			}		

		



	

	
		
		
?>