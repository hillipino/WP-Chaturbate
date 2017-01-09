<?php 
		
		// Are Comments Open?		
		
			if ( comments_open() ) {
			
				echo '<section class="obj-comments post" id="comments">';

			
				// Is a password required to make a comment?
				
					if ( post_password_required() ) {
						
						echo '<div class="heading"><span>' . __( 'Password Protected', THEMENAME ) . '</span></div>';
						echo '<div>';
						echo '<p class="date">' . __( 'This post is password protected. Enter the password to view any comments.', THEMENAME ) . '</p><div class="content">';
			
						
						return;
					}			
				
				// Do we have comments?
		
					if ( have_comments() ) {

						echo '<div class="heading"><span>';
							printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), THEMENAME ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
						echo '</span></div><div class="content">';
						
						wp_list_comments( array( 'style' => 'ul', 'callback' => 'nmp_comment' ) );
						
						
	
						if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
							
							echo '<div id="nav-below" class="navigation">';
							
								echo '<div class="nav-previous">';
									previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', THEMENAME ) );
								echo '</div>';
								
								echo '<div class="nav-next">';
									next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', THEMENAME ) );
								echo '</div>';
								
							echo '</div>';
								
							
						}
										
					} else {

						echo '<div class="heading"><span>' . __( 'No Comments', THEMENAME ) . '</span></div>';
						echo '<p class="date">' . __( 'There aren\'t any comments yet. Be the first!', THEMENAME ) . '</p><div class="content">';
						
					}
					

				// Show Comment Form if comments are open.
				
					$usedefault = false;
					
					if ( $usedefault == true )
						comment_form();
					else
						nmp_commentform('','','unboxed');
					
				echo '</div></section>';
					
			
			}


	
?>