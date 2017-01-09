<?php 
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_header();
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	global $wp_query;

	if ( !have_posts() ) {
		
		echo '
			<article class="post 404">
				<div class="heading">
					<span>Not Found</span>
				</div>
				<div class="content">
					<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
				</div>
			</article>
		';
		
	} else {
		
		// Start a counter
			
			$count = 0;	

		while ( have_posts() ) {
		
			the_post();
		
			if ($count % 3 == 0){
				
				// adcode goes here
				
			}
			
			// Increment Counter
			
				$count++;
			
			// Determine how to display the post.
			
				$format = get_post_format();

				if ( $format ) {
					
					// Check for post format fist.
						get_template_part( 'loop', get_post_format() );
						
				} else {
				
					// Check for post type
						get_template_part( 'loop', get_post_type() );
				
			}

		}
		
		if ( $wp_query->max_num_pages > 1 ) {
			
			echo '
				<div class="clearfix"></div>
				<section class="pager
					' . previous_posts_link( __( 'Newer posts', THEMENAME) ) . '	
					' . next_posts_link( __( 'Older posts', THEMENAME) ) . '
				</section>
				<div class="clearfix"></div>
			';
			
		}
		
	}
				
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_footer(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
