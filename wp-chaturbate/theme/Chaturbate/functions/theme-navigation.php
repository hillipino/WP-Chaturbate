<?php


	// Register Custom Menus
	
		register_nav_menus( array ( 
			'primary' => __( 'Primary Navigation', THEMENAME ), 
		) );
		
		
	// If custom menu exists print it, otherwise show the default wp_page_menu
	
		function nmp_menu() {
		
			if ( function_exists( 'wp_nav_menu' ) ) {
			
			wp_nav_menu( array( 
				'container_class' 	=> 'menu', 
				'container_id' 		=> '',
				'menu_id' 			=> '',
				'theme_location' 	=> 'primary', 
				'depth'				=> 0,
				'fallback_cb'     	=> 'nmp_fallbackMenu'
			) );
				
			} else {
			
				nmp_fallbackMenu();
				
			}
			
		}
		
	// Arguments for wp_page_menu
	
		function nmp_fallbackMenu() {
		
			wp_page_menu( array( 
				'show_home'			=> __( 'Home',THEMENAME ), 
				'sort_column' 		=> 'menu_order' 
			) );
			
		}		
		

	// Replace div with nav
		
		function nmp_dropclass( $liclass ) {
		
			return preg_replace( '<div class="menu">', 'nav id="nav" class="" ', $liclass, 1 );
			
		}
		add_filter( 'wp_page_menu','nmp_dropclass' );	
		add_filter( 'wp_nav_menu','nmp_dropclass' );
		
		function nmp_dropclass2( $liclass ) {
		
			return preg_replace( '</div>', '/nav', $liclass, 1 );
			
		}
		add_filter( 'wp_page_menu','nmp_dropclass2' );	
		add_filter( 'wp_nav_menu','nmp_dropclass2' );


		function nmp_linkclass( $liclass ) {
		
			return preg_replace( '<ul class=\'xoxo blogroll\'>', 'ul class="style1"', $liclass, 1 );
			
		}
		add_filter( 'wp_list_bookmarks','nmp_linkclass' );	
	
		
		
	// Add class to prev and next posts links.
	
		function nmp_ppl_l( $class ) {
		
			return 'class="button prev alignleft"';
			
		}
		function nmp_ppl_r( $class ) {
		
			return 'class="button next alignright"';
			
		}			
		add_filter('next_posts_link_attributes','nmp_ppl_r');
		add_filter('previous_posts_link_attributes','nmp_ppl_l');
		
	// Paginate
	
		function nmp_paginate( $args = array() ) {
		
			$defaults = array(
				'range' 			=> NMP_PAGINATE_RANGE,
				'custom_query' 		=> FALSE,
				'previous_string' 	=> NMP_PAGINATE_PREV,
				'next_string' 		=> NMP_PAGINATE_NEXT,
				'view_fp' 			=> TRUE,
				'view_lp' 			=> TRUE,
				'before_output' 	=> NMP_PAGINATE_BEFORE,
				'after_output' 		=> NMP_PAGINATE_AFTER
			);
		 
			$args = wp_parse_args(
				$args,
				apply_filters( 'fb_paging_bar_defaults', $defaults )
			);
		 
			$args[ 'range' ] = (int) $args[ 'range' ] - 1;
			
			if ( !$args[ 'custom_query' ] )
				$args[ 'custom_query' ] = @$GLOBALS[ 'wp_query' ];
				$count = (int) $args[ 'custom_query' ]->max_num_pages;
				$page = intval( get_query_var( 'paged' ) );
				$ceil = ceil( $args[ 'range' ] / 2 );
		 
			if ( $count <= 1 )
				return FALSE;
			 
			if ( !$page )
				$page = 1;
		 
			if ( $count > $args[ 'range' ] ) {
			
				if ( $page <= $args[ 'range' ] ) {
					$min = 1;
					$max = $args[ 'range' ] + 1;
				} else if ( $page >= ( $count - $ceil ) ) {
					$min = $count - $args[ 'range' ];
					$max = $count;
				} else if ( $page >= $args[ 'range' ] && $page < ( $count - $ceil ) ) {
					$min = $page - $ceil;
					$max = $page + $ceil;
				}
				
			} else {
				$min = 1;
				$max = $count;
			}
			 
			$echo = '';
			$previous = intval( $page ) - 1;
			$previous = esc_attr( get_pagenum_link( $previous ) );
			$firstpage = esc_attr( get_pagenum_link( 1 ) );
			 
			if ( $args['view_fp'] && $firstpage && ( 1 != $page ) )
				$echo .= '<a href="' . $firstpage . '" title="first" class="button prev">' . __('First',THEMENAME) . '</a>';			
			
			if ( $previous && ( 1 != $page ) )
				$echo .= '<a href="' . $previous . '" title="previous" class="button prev">' . $args[ 'previous_string' ] . '</a>';
				
			$echo .= '<span class="pages">';

			if ( !empty( $min ) && !empty( $max ) ) {
			
				for( $i = $min; $i <= $max; $i++ ) {
				
					if ($page == $i)
						$echo .= '<span class="button current">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span>';
					else
						$echo .= sprintf( '<a href="%s" class="button">%002d</a>', esc_attr( get_pagenum_link( $i ) ), $i );
				}
				
			}
			
			$echo .= '</span>';
			
			$next = intval( $page ) + 1;
			$next = esc_attr( get_pagenum_link( $next ) );
			
			if ( $next && ( $count != $page ) )
				$echo .= '<a href="' . $next . '" title="next" class="button">' . $args[ 'next_string' ] . '</a>';			
			 
			if ( $args[ 'view_lp' ] ) {
			
				$lastpage = esc_attr( get_pagenum_link( $count ) );
				
				if ( $lastpage && ( $count != $page ) ) {
					$count = str_pad( (int)$count, 2, '0', STR_PAD_LEFT );
					$echo .= '<a href="' . $lastpage . '" title="last" class="button">' . __( 'Last',THEMENAME ) . '</a>';
				}
				
			}
			 

			 
			if ( isset( $echo ) )
				echo $args[ 'before_output' ] . $echo . $args[ 'after_output' ];
				
		}
		
?>