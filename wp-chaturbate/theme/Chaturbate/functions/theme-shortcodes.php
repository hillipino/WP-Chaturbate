<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Theme Shortcodes
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/*	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// Shortcode Template [shortcode att=]
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	
		function nmp_shortcode_sc( $atts, $content=null ) {
		
			global $wp_embed;
			
			extract( shortcode_atts( array(
				'container'			=> NMP_VIDEO_CONTAINER,
				'title'				=> NULL,
				'url'				=> ''
			), $atts ) );			
			
			ob_start();
				

			// Do stuff
			
			$nmp_shortcode = ob_get_contents();
					
			ob_end_clean();
			
			return $nmp_shortcode;
			
		}
		add_shortcode( 'shortcode', 'nmp_shortcode_sc' );	
		
	*/


	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// Grid [row]Lorem ipsum dolor...[/row]
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	
		function nmp_row_sc( $atts, $content=null ) {
			$nmp_shortcode = '<div class="row">' . parse_shortcode_content( $content ) . '</div>';
			return $nmp_shortcode;
		}
		add_shortcode( 'row', 'nmp_row_sc' );			
		
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// Grid [column]Lorem ipsum dolor...[/column]
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	
		function nmp_column_sc( $atts, $content=null ) {
			extract( shortcode_atts( array(
				'size'					=> '',
				'class'					=> ''
			), $atts ) );		
			$nmp_shortcode = '<section class="' . $size . ' ' . $class . '">' .  parse_shortcode_content( $content ) . '</section>';
			return $nmp_shortcode;
		}
		add_shortcode( 'column', 'nmp_column_sc' );

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
// Clean up nested shortcodes.
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	function parse_shortcode_content( $content ) {

	   /* Parse nested shortcodes and add formatting. */
		$content = trim( do_shortcode(  shortcode_unautop( $content ) ) );

		///* Remove '' from the start of the string. */
		if ( substr( $content, 0, 4 ) == '' )
			$content = substr( $content, 4 );

		/* Remove '' from the end of the string. */
		if ( substr( $content, -3, 3 ) == '' )
			$content = substr( $content, 0, -3 );

		/* Remove any instances of ''. */
		$content = str_replace( array( '<p></p>' ), '', $content );
		$content = str_replace( array( '<p>  </p>' ), '', $content );

		return $content;
	}
	
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	add_filter( 'the_content', 'shortcode_unautop', 100 );	

	
?>