<?php

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_header(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	echo '<article class="post single-page">';
	
	if ( have_posts() ) {
	
		while ( have_posts() ) {
			
			the_post(); 
			
			// Variables
			
				$date						= human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
				$comment_count 				= get_comments_number( $post->ID );		

				
			echo '
				<div class="heading">
					<span>' . get_the_title() . '</span>
				</div>
				';
			
				echo '<div class="content">';
			
						// The Post Content
						
							the_content();
						
						// Clear Floats
						
							echo '<div class="clearfix"></div>';
					
						if( $numpages > 1 ) {
						
							echo '
								
									<div class="row obj-postmeta">
										<div class="12u">

							';

										// Show Page Numbers
							
											wp_link_pages( array( 
															'link_before' => '<span>',
															'link_after' => '</span>',
															'before' => '<div class="pager"><span class="pages">' . __( 'Pages:', THEMENAME ), 
															'after' => '</span></div>' 
														) );
									
							echo '
										</div>
									</div>
								
							
							';
							
						}
						
					echo '</div></article>';
				

					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
					// Show Comments
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
						comments_template( '', true );				
							
				

		}
		
	}
	

	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_footer(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>