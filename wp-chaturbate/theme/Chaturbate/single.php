<?php

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	get_header(); 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	if ( have_posts() ) {
	
		while ( have_posts() ) {
			
			the_post(); 
	
			// Variables
			
				$date						= human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
				$comment_count 				= get_comments_number( $post->ID );			

			// Get the author information
				
				$author_id					= get_the_author_meta( 'ID' );

				
				echo '
					<article id="post-' . get_the_ID() . '" '; post_class( 'post' ); echo '>
						<div class="heading">
							<span>' . get_the_title() . '</span>
						</div>	
						<p class="date">' . $date . '</p>
						
						<div class="content">
				';
				
				// The Post Content
						
					the_content();
						
				// Clear Floats
						
				echo '
						</div>
						<div class="clearfix"></div>
					</article>
				';
														

			/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
			// Post Meta
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////		
						
			if( $numpages > 1 ) {
						
					echo '
					
						<div class="row obj-postmeta box">
							<div class="6u">
					';
							
					// Show Categories

						if ( has_category() ) {
													
							echo '
								<p class="cats">
									' . __( 'Posted in ', THEMENAME ) . get_the_category_list( __( ', ', THEMENAME ) ) . '	
								</p>
							';
						
						}
						
					// Show Tags

						if ( has_tag() ) {
							
							echo '
								<p class="tags">
									' . __( 'Tagged ', THEMENAME ) . get_the_tag_list( '', __( ', ', THEMENAME ) ) . '
								</p>
							';
												
						}
					
					echo '
							</div>
							<div class="6u">
					';
											
					// Show Page Numbers
							
							wp_link_pages( array( 
											'link_before' 	=> '<span>',
											'link_after' 	=> '</span>',
											'before' 		=> '<div class="pager"><span class="pages">' . __( 'Pages:', THEMENAME ), 
											'after' 		=> '</span></div>' 
										) );
									
					echo '
							</div>
						</div>
					';
							
			}
						
								
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// Show Post Navigation
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////

			echo '<section class="post-nav">';
								
			// Show Previous Post Link
										
				echo '<div class="prev alignleft">';
						
					previous_post_link( '%link', __( 'Previous Post', THEMENAME ) );
										
					if(!get_adjacent_post(false, '', true)) { 
						echo '<span class="button dim">' . __( 'Previous', THEMENAME ) . '</span>'; 
					} // if there are no older articles
										
				echo '</div>';
								
			// Show Next Post Link
								
				echo '<div class="next alignright">';
									
					next_post_link( '%link', __( 'Next Post', THEMENAME ) );
								   
					if(!get_adjacent_post(false, '', false)) { 
						echo '<span class="button dim">' . __( 'Next', THEMENAME ) . '</span>'; 
					} // if there are no newer articles 
									
				echo '</div>';
									
				echo '<br class="clear" />';
									
			echo '</section>';
		
						
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