<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
	<head>
		<title>
			<?php
				global $page, $paged;

				wp_title( '|', true, 'right' );

				// Add the blog name.
					bloginfo( 'name' );

				// Add the blog description for the home/front page.
					$site_description = get_bloginfo( 'description', 'display' );

					if ( $site_description && ( is_home() || is_front_page() ) )
						echo " | $site_description";

				// Add a page number if necessary:
					if ( $paged >= 2 || $page >= 2 )
						echo ' | ' . sprintf( __( 'Page %s', THEMENAME ), max( $paged, $page ) );
			?>
		</title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<?php
			if ( $nmp_favicon ) // Show favicon if it exists
				echo '<link rel="icon" type="image/png" href="' . $nmp_favicon . '" />';
		?>
		
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,600,700' rel='stylesheet' type='text/css' />
		
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/skel-noscript.css" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" />

		
		<?php wp_head(); ?>
		
		<!--[if lte IE 8]><link href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if lte IE 7]><link href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		
	</head>

	<body <?php body_class( ); ?>>

		
		<div id="header">
		
			<?php nmp_menu(); ?>
		
			<div class="inner">
				
				<div class="heading">
					<span><?php echo bloginfo('name'); ?></span>
				</div>
							
				<p><?php echo bloginfo('description'); ?></p>
				<a href="http://nomoneyinporn.org/chaturbate-wordpress-theme/" class="button">Download it FREE</a>
						
			</div>	
				
		</div>
		
		<!-- Main -->
			<div id="main">
				<div class="container">	
				
		