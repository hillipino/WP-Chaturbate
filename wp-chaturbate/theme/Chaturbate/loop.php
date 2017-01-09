<?php
	
	// Variables
			
		$date						= human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
		$comment_count 				= get_comments_number( $post->ID );	
		
	// Get the author information
		
		$author_id					= get_the_author_meta( 'ID' );

		
		echo '

				<article class="post" id="post-' . get_the_ID() . '">
					<div class="heading">
						<span><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></span>
					</div>
					<p class="date">' . $date . '</p>
					<div class="content">
					';

				// Display the full post.
						
					the_content();
											
	
					echo '<br class="clear" />';
	
					echo '						
					</div>
				</article>
		';	
			
?>