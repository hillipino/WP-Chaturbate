<?php

	function nmp_reply_class($link, $args, $comment, $post){
	  return str_replace( 'comment-reply-link', 'comment-reply-link button alt', $link);
	}
	add_filter('comment_reply_link', 'nmp_reply_class', 10, 4);

	function nmp_edit_class($link){
	  return str_replace( 'comment-edit-link', 'comment-edit-link button alt', $link);
	}
	add_filter('edit_comment_link', 'nmp_edit_class', 10, 1);

	// Comment
	
		if ( !function_exists( 'nmp_comment' ) ) {
		
			function nmp_comment( $comment, $args, $depth ) {
			
				$GLOBALS['comment'] = $comment;
				extract($args, EXTR_SKIP);
				
				//print_r($args);
				
				switch ( $comment->comment_type ) {
				
					case '':
						?>
						
						<article <?php comment_class( 'box' ); ?> id="comment-<?php comment_ID(); ?>">

							<span class="image alignleft"><?php echo get_avatar( $comment, NMP_COMMENT_AVATAR ); ?></span>
							
							<h3>
								<?php echo get_comment_author_link(); ?> | <?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago'; ?>
						
								<span class="replyedit">
									<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'mnmp_depth' => $args['mnmp_depth'] ) ) ); ?>
									<?php edit_comment_link( __( 'Edit', THEMENAME ), ' ' ); ?>
								</span>
							</h3>	
							


							<?php comment_text(); ?>

						</article>								
							
						<?php
						break;
					case 'pingback':
					case 'trackback':
						?>	
							
							<article class="post pingback">
								<p><?php _e( 'Pingback:', THEMENAME ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', THEMENAME), ' ' ); ?></p>
							</article>
						<?php
						break;
					default:
						break;
						
				}
			}
		}
		
	// Comment Form

		function nmp_commentform( $args = array(), $post_id = null, $class = null ) {
		
			global $id;

			if ( null === $post_id )
				$post_id = $id;
			else
				$id = $post_id;

			$commenter 		= wp_get_current_commenter();
			$user 			= wp_get_current_user();
			$user_identity 	= ! empty( $user->ID ) ? $user->display_name : '';
			$req 			= get_option( 'require_name_email' );
		
			$fields 		=  array(
								'author' => '
									<div class="row">
										<div class="6u">							
											<input class="text" placeholder="' . __( 'Name', THEMENAME ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  />
										</div>
								',
								
								'email'  => '
										<div class="6u">						
											<input class="text" placeholder="' . __( 'Email', THEMENAME ) . '"  id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"  />
										</div>
									</div>
								',
								
								'url'    => '
									<div class="row">
										<div class="12u">								
											<input class="text" placeholder="' . __( 'Website', THEMENAME ) . '"  id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
										</div>
									</div>
								',
								
							);

			$required_text 	= sprintf( ' ' . __('Required fields are marked %s', THEMENAME), '<span class="required">*</span>' );
			$defaults 		= array(
								'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
								
								'comment_field'        => '
									<div class="row">
										<div class="12u">
											<textarea placeholder="' . __( 'Comment', THEMENAME ) . '" id="comment" name="comment" ></textarea>
										</div>
									</div>',
									
								'must_log_in'          => '<p class="date must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', THEMENAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
								'logged_in_as'         => '<p class="date logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', THEMENAME ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
								'comment_notes_before' => '<p class="date comment-notes">' . __( 'Your email address will not be published.', THEMENAME ) . ( $req ? $required_text : '' ) . '</p>',
								'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', THEMENAME ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
								'id_form'              => 'arixwp_commentForm',
								'id_submit'            => 'submit',
								'title_reply'          => __( 'Leave a Reply', THEMENAME ),
								'title_reply_to'       => __( 'Leave a Reply to %s', THEMENAME ),
								'cancel_reply_link'    => __( 'Cancel reply', THEMENAME ),
								'label_submit'         => __( 'Comment', THEMENAME ),
							);

			$args 			= wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

			if ( comments_open() ) { 
			
				do_action( 'comment_form_before' ); 
				
					if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { 
					
						echo '<section id="respond" class="post">';
						
							echo '<div class="heading"><span>';
								comment_form_title( $args['title_reply'], $args['title_reply_to'] );
								echo '<small>';
								cancel_comment_reply_link( $args['cancel_reply_link'] );
								echo '</small>';
							echo '</span></div><div class="content">';

				
								echo $args['must_log_in']; 
								do_action( 'comment_form_must_log_in_after' ); 
				
						echo '</div></section>';
						
					} else { 
						
						echo '<section id="respond">';
								
							echo '<form action="' . site_url( '/wp-comments-post.php' ) . '" method="post" id="' . esc_attr( $args['id_form'] ) . '" class="' . $class . '">';
						
								echo '<div class="heading"><span>';
									comment_form_title( $args['title_reply'], $args['title_reply_to'] );
									echo '<small>';
										cancel_comment_reply_link( $args['cancel_reply_link'] );
									echo '</small>';
								echo '</span></div><div class="content">';

					
						
									do_action( 'comment_form_top' ); 
						
									if ( is_user_logged_in() ) { 
										
										echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
										do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); 
										
									} else { 
										
										//echo $args['comment_notes_before'];
										do_action( 'comment_form_before_fields' );
										
										foreach ( (array) $args['fields'] as $name => $field ) {
											echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
										}
										
										do_action( 'comment_form_after_fields' );
									
									} 
						
									echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); 
							
						
									echo '
										<div class="row">
											<div class="12u">							
												' . $args['comment_notes_after'] . '
											</div>
										</div>							
									
										<div class="row">
											<div class="12u">							
												<input name="submit" type="submit" id="' . esc_attr( $args['id_submit'] ) . '" value="' . esc_attr( $args['label_submit'] ) . '" class="button" />
											</div>
										</div>
									';
							
									comment_id_fields( $post_id ); 
	
									do_action( 'comment_form', $post_id ); 
							

								
							echo '</form>';
						
						echo '</div></section>';
				
					} 
				
				
				

			
				do_action( 'comment_form_after' ); 
			
			} else {
				
				do_action( 'comment_form_comments_closed' ); 

			} 

		}
	
	
?>