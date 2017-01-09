<?php

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Create meta boxes
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 
	class NMP_Meta_Box {

		protected $_meta_box;	
		public $postid    = null;
		private $template = null;		

		// create meta box based on given data
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		function __construct($meta_box) {
		
			if (!is_admin()) return;			

			$this->_meta_box = $meta_box;

			add_action('admin_menu', array(&$this, 'add'));
			add_action('save_post', array(&$this, 'save'));
			
		}
		
		function __destruct() {
			$this->meta     = null;
			$this->postid   = null;
			$this->template = null;
		}		

		/// Add meta box for multiple post types
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		function add() {
		
			$this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
			$this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
			$this->_meta_box['template'] = empty($this->_meta_box['template']) ? '' : $this->_meta_box['template'];
			$this->_meta_box['pages'] = empty($this->_meta_box['pages']) ? '' : $this->_meta_box['pages'];
			
			foreach ( $this->_meta_box['pages'] as $page ) {

					if ( $this->_meta_box['template'] == $this->template ) 
						add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
					else if ( $this->_meta_box['template'] == '' )
						add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);

			}
			
		}

		// Callback function to show fields in meta box
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		public function show() {		
		
			global $post;
			
			if ( $this->_meta_box['context'] == 'side' )
				$group = 'nmp_meta_group_sidebar';
			else
				$group = 'nmp_meta_group';

			// Use nonce for verification
			
			echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

			foreach ($this->_meta_box['fields'] as $field) {
			
				// get current post meta data

					$meta = get_post_meta($post->ID, $field['id'], true);
					$meta = strtolower($meta);
					
				echo '
					<div class="' . $group . '">
						<label for="' . $field['id'] . '"  class="nmp_label">' . $field['name'] . '</label>';
						
				if ( $field['desc'] )
					echo '<p>' . $field['desc'] . '</p>';
						
				if ( $field['type'] == 'radio' )
					echo '<div class="nmp_radio">';		
				
				switch ($field['type']) {
				
					case 'text':
						echo '<input type="text" name="'. $field['id']. '" id="' . $field['id'] . '" value="' . ($meta ? $meta : $field['std']) . '" class="nmp_input" /><br />';
						break;
						
					case 'textarea':
						echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" cols="60" rows="4" class="nmp_input">' . $meta ? $meta : $field['std'] . '</textarea>',
							'<br />';
						break;
						
					case 'select':
						echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '" class="nmp_select">';
							foreach ($field['options'] as $option) {
							
								echo '<option ';
								
								if ( $meta == $option[ 'value' ] ) {
								
									echo ' selected="selected"';
									
								} else if ( !$meta && $field[ 'std' ] == $option[ 'value' ] ) {
								
									echo ' selected="selected"';		
								
								}
								
								echo ' id="' . $option[ 'value' ] . '">' . $option[ 'name' ] . '</option>';
								
							}
						echo '</select>';
						break;
						
					case 'radio':
						foreach ($field['options'] as $option) {
						   
							echo '<input type="radio" id="' . $field[ 'id' ] . $option['value'] . '" name="' . $field[ 'id' ] . '" value="' . $option['value'] . '"'; 

							if ( $meta == $option[ 'value' ] ) {
							
								echo ' checked="checked"';
							
							} else if ( !$meta && $field[ 'std' ] == $option[ 'value' ] ) {
							
								echo ' checked="checked"';
							
							}
							
							echo ' /><label for="' . $field[ 'id' ] . $option['value'] . '">' . $option[ 'name' ] . '</label>'; 
						}
						break;
						
					case 'checkbox':
						echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
						break;
						
					case 'file':
						echo $meta ? "$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
							'<br />';
						break;
						
					case 'wysiwyg':
						echo '<textarea name="', $field['id'], '" id="', $field['id'], '" class="theEditor" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
							'<br />';
						break;
						
					case 'bgimage':
						
						echo '<ul class="bgimages">';
							
							foreach ( $field['options'] as $option ) {
								
								echo '
									<li>
										<label for="' . $field[ 'id' ] . $option['value'] . '" class="bgimage-' . $option['value'] . '">' . $option[ 'name' ] . '</label>
										<input type="radio" id="' . $field[ 'id' ] . $option['value'] . '" name="' . $field[ 'id' ] . '" value="' . $option['value'] . $option[ 'img_type' ] .'"';

											if ( $meta == $option[ 'value' ]. $option[ 'img_type' ] )  
												echo ' checked="checked"';
											else if ( !$meta && $field[ 'std' ] == $option[ 'value' ] )
												echo ' checked="checked"';
								
								echo ' /></li>';								
								
							}
							
						echo '</ul>';
							
						break;								

					
					case 'colorpicker':
					
					// load font admin specific CSS
					
						wp_enqueue_style( 'colorpicker' );
					
					// load font admin specific JS
					
						wp_enqueue_script( 'nmp_colorpicker' );
						wp_enqueue_script( 'eye' );
						wp_enqueue_script( 'utils' );
						wp_enqueue_script( 'layout' );

						?>

						<script>
					
							jQuery(document).ready(function() {
								
								// bind ColorPicker plugin to text inputs on Color Scheme Pages

									jQuery('input[id^="<?php echo PREFIX; ?>color"]').ColorPicker({
										onSubmit: function(hsb, hex, rgb, el) {
											var className = jQuery(el).attr('id');
											jQuery(el).val('#' + hex);
											jQuery(el).ColorPickerHide();
											jQuery(el).trigger('change');
											jQuery( '.' + className ).css( 'background-color','#' + hex );
										},
										onBeforeShow: function () {
											jQuery(this).ColorPickerSetColor(this.value);
										}
									})
									.bind('keyup', function(){
										jQuery(this).ColorPickerSetColor(this.value);
									});
								
							});
						
						</script>						

						<?php
				
						echo '
							<div class="color_picker">
								<div class="nmp_color_picker_selector">
									<div style="background-color: '. ( $meta ? $meta : $field[ 'std' ] ) . '" class="' . $field[ 'id' ] . '"></div>
								</div>
								<div id="' . $field[ 'colorpicker' ] . '" class="nmp_colorpicker_holder"></div>
								<input type="text" name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] .'" value="'. ( $meta ? $meta : $field[ 'std' ] ) . '" class="nmp_colorpicker" />
							</div>	
						';							
						break;						
						
					case 'upload':
						
						echo '
							
							<div class="block">
								<input type="text" name="'. $field[ 'id' ] . '" id="'. $field[ 'id' ] .'" value="'. ( $meta ? $meta : $field[ 'std' ] ) . '" class="nmp_upload" />
								<input id="'. $field[ 'id' ] . '_button" type="button" value="' . __( 'Upload Image', THEMENAME ) . '" class="nmp_button" />
									 
								 <script>		
									 
									var uploadID = ""; 
										
									jQuery(document).ready(function() {
										jQuery(\'#' . $field[ 'id' ] . '_button\').click(function() {
											uploadID = jQuery(this).prev(\'input\');
											tb_show(\'' . __( 'Upload a Custom Background', THEMENAME ) . '\', \'media-upload.php?post_id=0&amp;type=image&amp;amp;TB_iframe=true\');
											return false;
										});

										window.send_to_editor = function(html) {
											imgurl = jQuery(\'img\',html).attr(\'src\');
											uploadID.val(imgurl);
											tb_remove();
										}
									});									
						
									</script>
							</div>

						';
						break;						
						
						
				}
				
				if ( $field['type'] == 'radio' )
					echo '</div>';
				
				echo '</div>';

			}

		}

		// Save data from meta box
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		public function save($post_id) {
		
			// verify nonce
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if ( isset($_POST['wp_meta_box_nonce']) ) {
				$nonce = $_POST['wp_meta_box_nonce'];
			} else { 
				$nonce = '';
			}
			
			if (!wp_verify_nonce($nonce, basename(__FILE__))) {
				return $post_id;
			}

			// check autosave
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}

			// check permissions
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if ('page' == $_POST['post_type']) {
				if (!current_user_can('edit_page', $post_id)) {
					return $post_id;
				}
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}

			foreach ($this->_meta_box['fields'] as $field) {
			
				$name 	= $field['id'];
				$old 	= get_post_meta($post_id, $name, true);
				$new 	= $_POST[$field['id']];

				if ($field['type'] == 'wysiwyg') {
					$new = wpautop($new);
				}

				if ($field['type'] == 'textarea') {
					$new = htmlspecialchars($new);
				}

				// validate meta value
				if (isset($field['validate_func'])) {
					$ok = call_user_func(array('NMP_Meta_Box_Validate', $field['validate_func']), $new);
					if ($ok === false) { // pass away when meta value is invalid
						continue;
					}
				}

				if ( $new && $new != $old ) {
					update_post_meta($post_id, $name, $new);
				} elseif ( '' == $new && $old ) {
					delete_post_meta($post_id, $name, $old);
				}
			}
		}
		
		public function set_postid($axPostId = 0) {
			$postID  = null;
			$postID2 = null;
			
			if ($axPostId > 0) {
				$this->postid = $axPostId;
			} else {
				
				if ( isset( $_GET['post'] ) ) {
					
					$postID  = filter_var( $_GET['post'], FILTER_VALIDATE_INT );
				
					if ( isset( $_POST['post_ID'] ) ) {
						$postID2 = filter_var( $_POST['post_ID'], FILTER_VALIDATE_INT );
					} else {
						$postID2 = '';
					}
				
					$this->postid = $postID ? $postID : $postID2 ;		
				}
			}
		}		
		
		public function get_postid() {
			return $this->postid;
		}		
		
		public function set_template() {
			$this->template = get_post_meta($this->postid,'_wp_page_template',TRUE);
		}
		
		public function get_template() {
			return $this->template;
		}			
		
	}

?>
