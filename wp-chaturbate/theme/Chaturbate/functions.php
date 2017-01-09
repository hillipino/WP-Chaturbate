<?php
	
	require_once( get_template_directory(). '/functions/theme-data.php' );  								// Theme specific data can be configured here.
		
	// Load Other Function Files in an attempt to organize this file a bit.
	
		require_once( get_template_directory(). '/functions/theme-comments.php' );							// Custom comment form function.	
		require_once( get_template_directory(). '/functions/theme-display.php' );							// Controls the layout of cam thumbnails.	
		require_once( get_template_directory(). '/functions/theme-navigation.php' );						// Controls how the menus and pagination appear.
		require_once( get_template_directory(). '/functions/theme-shortcodes.php' );			   	    	// This holds the shortcodes for the theme.
		require_once( get_template_directory(). '/functions/theme-utilities.php' );							// Misc. utilities used throughout the theme.
		require_once( get_template_directory(). '/functions/theme-search.php' );							// Controls the search bar.
		require_once( get_template_directory(). '/functions/theme-shortcodes.php' );						// Shortcodes.
		
	// Required by wordpress, we don't use this. I just stuck it here so that the theme would pass the checks in that validation plugin.
	
	if ( ! isset( $content_width ) ) $content_width = '';
		
		
	// Load Scripts and Styles
	
		function nmp_scripts() {
	
			// SCRIPTS
	
				wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery') );
				wp_enqueue_script( 'skel', get_template_directory_uri() . '/js/skel.min.js', array('jquery') );
				wp_enqueue_script( 'skel-panels', get_template_directory_uri() . '/js/skel-panels.min.js', array('jquery') );				
				wp_enqueue_script( 'init', get_template_directory_uri() . '/js/init.js', array('jquery') );
												
				if ( is_singular() )
					wp_enqueue_script( "comment-reply" );
		
		}	
		
		add_action( 'wp_enqueue_scripts', 'nmp_scripts' ); 
	
	// Setup
	
	function nmp_setup() {		

		// This theme uses post thumbnails
		
			if ( function_exists( 'add_theme_support' ) ) {
													
				add_theme_support( 'post-thumbnails' );
				add_image_size( 'port', 300, 300 );

			}

		// Add default posts and comments RSS feed links to head
		
			add_theme_support( 'automatic-feed-links' );

		// Add Editor Style
			
			add_editor_style();
			

	}
		
	add_action( 'after_setup_theme', 'nmp_setup' );
		
?>