<?php
	
	// Register the Post Type

		function nmp_post_type_webcam()
		{
			// Create The Labels (Output) For The Post Type
			$labels = 
			array(

				'name' 					=> __( 'Webcams', PLUGINNAME ), 
				'singular_name' 		=> __( 'Webcam', PLUGINNAME ),
				'rewrite' 				=> array( 'slug' => __( 'webcam', PLUGINNAME  ) ),
				'add_new' 				=> __( 'Add Webcam', PLUGINNAME ), 
				'edit_item' 			=> __( 'Edit Webcam', PLUGINNAME ),
				'new_item' 				=> __( 'New Webcam', PLUGINNAME ), 
				'view_item' 			=> __( 'View Webcam', PLUGINNAME ),
				'search_items' 			=> __( 'Search Webcams', PLUGINNAME ), 
				'not_found' 			=> __( 'No Webcams Found', PLUGINNAME ),
				'not_found_in_trash' 	=> __( 'No Webcams Found In Trash', PLUGINNAME ),
				'parent_item_colon' 	=> '' 
			);

			$args = 
			array(

				'labels' 				=> $labels, 
				'public' 				=> true, 
				'publicly_queryable' 	=> true, 
				'show_ui' 				=> true, 
				'query_var' 			=> true, 
				'rewrite' 				=> true, 
				'capability_type' 		=> 'post', 
				'hierarchical' 			=> false, 
				'menu_position' 		=> 5, 
				'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions', 'page-attributes' ) 
			);
			
			// Register The Post Type
			register_post_type(__( 'webcam', PLUGINNAME  ),$args);
			
			
		} 
	
	// Register Taxonomy

		function nmp_webcam_filter()
		{
			// Register the Taxonomy
			register_taxonomy(__( "gender", PLUGINNAME  ), 
			array(__( "webcam", PLUGINNAME  )), 
			array(
				"hierarchical" 		=> true, 
				"label" 			=> __( "Gender", PLUGINNAME  ), 
				"singular_label" 	=> __( "Gender", PLUGINNAME  ), 
				"show_admin_column" => true,
				"rewrite" => array(
						'slug' 			=> 'webcams', 
						'hierarchical' 	=> true
						)
				)
			); 
		} 
		
	// Register Taxonomy

		function nmp_webcam_filter2()
		{
			// Register the Taxonomy
			register_taxonomy(__( "ethnicity", PLUGINNAME  ), 
			array(__( "webcam", PLUGINNAME  )), 
			array(
				"hierarchical" 		=> false, 
				"label" 			=> __( "Ethnicity", PLUGINNAME  ), 
				"singular_label" 	=> __( "Ethnicity", PLUGINNAME  ), 
				"show_admin_column" => true,
				"rewrite" => array( 'slug' => 'ethnicity' )
				)
			); 
		} 		

		add_action('init', 'nmp_post_type_webcam');
		add_action( 'init', 'nmp_webcam_filter', 0 );
		add_action( 'init', 'nmp_webcam_filter2', 0 );
		
	
?>