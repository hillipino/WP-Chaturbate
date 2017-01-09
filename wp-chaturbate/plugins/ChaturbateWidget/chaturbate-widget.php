<?php

/*
Plugin Name: Chaturbate Widget
Plugin URI: http://adultwpthemes.com/
Description: A simple widget to display live cam feeds from Chaturbate - http://chaturbate.com/affiliates/in/9O7D/827SM/?track=chaturbatewidget.
Author: Doni Ronquillo
Version: 1
Author URI: http://www.doni.us/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/* Taxonomy Widget */


	function add_admin_scripts() {	
		wp_enqueue_script('jquery');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		//wp_enqueue_style('chaturbate', WP_PLUGIN_URL . '/ChaturbateWidget/chaturbate.css');
	}
	add_action('init', 'add_admin_scripts');	
	

class chaturbate_Widget extends WP_Widget {

  
	function chaturbate_Widget() {
		$widgets_opt = array('classname' => 'chaturbate_Widget','description'=>'Live Cam Feed from Chaturbate');
		//parent::WP_Widget(false,$name= "Live Cams",$widgets_opt);
		$this->WP_Widget('chaturbate_Widget', 'Chaturbate Widget', $widgets_opt);
	}
  
	// User Options Form
	function form($instance) {
  
		global $post;
		
		$cbTitle = '';
		$cbAffid = '';
		$cbRevenue = '';
		$cbSex = '';
		$cbCount = '';
		//$cbPaged = '';
		
		$cbTitle 	= esc_attr($instance['cbTitle']);	// Title of the Widget
		$cbAffid	= esc_attr($instance['cbAffid']);  	// Chaturbate Affiliate ID
		//$cbTrack	= esc_attr($instance['cbTrack']);  	// Chaturbate Tracking Code
		$cbRevenue	= esc_attr($instance['cbRevenue']);	// The Revenue method you would like to use ( Revshare, Per Signup )
		//$cbLinkto	= esc_attr($instance['cbLinkto']);	// popup, page	
		$cbSex		= esc_attr($instance['cbSex']);		// Which cams to show ( m = male, f = female, c = couple, s = shemale, a = all )		
		$cbCount	= esc_attr($instance['cbCount']); 	// Items to show in widget
		//$cbPaged	= esc_attr($instance['cbPaged']); 	// Show or hide pagination
		//$cbAffil	= esc_attr($instance['cbAffil']); 	// Show affiliate signup link
		//$cbBroad	= esc_attr($instance['cbBroad']); 	// Show Broadcaster Signup
		
		?>

			<p>
				<label for="<?php echo $this->get_field_id('cbTitle'); ?>">Widget Title:</label>
				<input id="<?php echo $this->get_field_id('cbTitle'); ?>" name="<?php echo $this->get_field_name('cbTitle'); ?>" type="text" class="widefat" value="<?php echo $cbTitle;?>" />
			</p>   
	
			<p>
				<label for="<?php echo $this->get_field_id('cbAffid'); ?>">Chaturbate ID: <a href="http://chaturbate.com/affiliates/in/9O7D/827SM/?track=chaturbatewidget" target="_blank">Get One!</a></label>
				<input id="<?php echo $this->get_field_id('cbAffid'); ?>" name="<?php echo $this->get_field_name('cbAffid'); ?>" type="text" class="widefat" value="<?php echo $cbAffid;?>" />
			</p> 

				
			<!--
			<p>
				<label for="<?php echo $this->get_field_id('cbTrack'); ?>">Tracking Code:</label>
				<input id="<?php echo $this->get_field_id('cbTrack'); ?>" name="<?php echo $this->get_field_name('cbTrack'); ?>" type="text" class="widefat" value="<?php echo $cbTrack;?>" />
			</p>
			-->
			
			<p>
				<label for="<?php echo $this->get_field_id('cbCount'); ?>">Amount of Cams:</label>
				<input id="<?php echo $this->get_field_id('cbCount'); ?>" name="<?php echo $this->get_field_name('cbCount'); ?>" type="text" class="widefat" value="<?php echo $cbCount;?>" />
			</p>
			
			<p class="cbRevenue">
				<label for="<?php echo $this->get_field_id('cbRevenue'); ?>">Revenue Type:</label>
				<select name="<?php echo $this->get_field_name('cbRevenue'); ?>" id="<?php echo $this->get_field_id('cbRevenue'); ?>" class="widefat arixTaxonomyType" >';
					<?php
						echo '<option value="revshare"'; 
							if ( $cbRevenue  == "revshare" ) { echo ' selected="selected" '; }
						echo '>Revshare</option>';
						echo '<option value="join"'; 
							if ( $cbRevenue  == "join" ) { echo ' selected="selected" '; }
						echo '>$1.00 Per Join</option>';			
					?>
				</select>
			</p>
			
			<!--
			<p class="cbLinkto">
				<label for="<?php echo $this->get_field_id('cbLinkto'); ?>">Thumbs Link To:</label>
				<select name="<?php echo $this->get_field_name('cbLinkto'); ?>" id="<?php echo $this->get_field_id('cbLinkto'); ?>" class="widefat arixTaxonomyType" >';
					<?php
						echo '<option value="popup"'; 
							if ( $cbLinkto  == "popup" ) { echo ' selected="selected" '; }
						echo '>Popup Iframe</option>';
						echo '<option value="page"'; 
							if ( $cbLinkto  == "page" ) { echo ' selected="selected" '; }
						echo '>Broadcasters Page</option>';			
					?>
				</select>
			</p>
			-->
			
			<p class="cbSex">
				<label for="<?php echo $this->get_field_id('cbSex'); ?>">Sex to Show:</label>
				<select name="<?php echo $this->get_field_name('cbSex'); ?>" id="<?php echo $this->get_field_id('cbSex'); ?>" class="widefat arixTaxonomyType" >';
					<?php
						echo '<option value="a"'; 
							if ( $cbSex  == "a" ) { echo ' selected="selected" '; }
						echo '>All</option>';
						echo '<option value="f"'; 
							if ( $cbSex  == "f" ) { echo ' selected="selected" '; }
						echo '>Females</option>';
						echo '<option value="m"'; 
							if ( $cbSex  == "m" ) { echo ' selected="selected" '; }
						echo '>Males</option>';
						echo '<option value="c"'; 
							if ( $cbSex  == "c" ) { echo ' selected="selected" '; }
						echo '>Couples</option>';
						echo '<option value="s"'; 
							if ( $cbSex  == "s" ) { echo ' selected="selected" '; }
						echo '>Shemales</option>';						
					?>
				</select>
			</p>			

			<!--
			<input type="checkbox" class="checkbox" value="yes" name="<?php echo $this->get_field_name('cbAffil'); ?>" <?php if ( $cbAffil  == "yes" ) { echo ' checked="checked" '; }?> /> <label for="<?php echo $this->get_field_id('cbAffil'); ?>">Show Affiliate Signup</label><br />
			<input type="checkbox" class="checkbox" value="yes" name="<?php echo $this->get_field_name('cbBroad'); ?>" <?php if ( $cbBroad  == "yes" ) { echo ' checked="checked" '; }?> /> <label for="<?php echo $this->get_field_id('cbBroad'); ?>">Show Broadcaster Signup</label><br />
			-->
			
		<?php    
	} 
  
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
  
	// Display Taxonomy Widget
	function widget( $args, $instance ) {
  
		global $post; 
		extract($args);
	
		// Options set in the widget control panel
		$cbTrack = '';
		
		$cbTitle 	= apply_filters('cbTitle',$instance['cbTitle']);
		$cbAffid	= apply_filters('cbAffid',$instance['cbAffid']);
		//$cbTrack	= apply_filters('cbTrack',$instance['cbTrack']);
		$cbRevenue	= apply_filters('cbRevenue',$instance['cbRevenue']);
		//$cbLinkto	= apply_filters('cbLinkto',$instance['cbLinkto']);
		$cbSex		= apply_filters('cbSex',$instance['cbSex']);		
		$cbCount	= apply_filters('cbCount',$instance['cbCount']);
		//$cbAffil	= apply_filters('cbAffil',$instance['cbAffil']);
		//$cbBroad	= apply_filters('cbBroad',$instance['cbBroad']);
		
		
		// Default values if no option set.
		
		if ( $cbTitle == '' ) 	$cbTitle 	= 'Live Webcams';
		if ( $cbAffid == '' ) 	$cbAffid	= '827SM';
		//if ( $cbTrack == '' )	$cbTrack	= 'chaturbatewidget';
		if ( $cbRevenue == '' ) $cbRevenue 	= 'revshare';
		//if ( $cbLinkto == '' ) 	$cbLinkto 	= 'popup';
		if ( $cbSex == '' ) 	$cbSex 		= 'a';
		if ( $cbCount == '' ) 	$cbCount 	= 3;
		//if ( $cbAffil == '' ) 	$cbAffil 	= 'no';
		//if ( $cbBroad == '' ) 	$cbBroad 	= 'no';
		
		echo $before_widget;
		$title = $before_title.$cbTitle.$after_title;
		
		echo $title;
		
		$this->get_cams( $cbAffid, $cbSex, $cbCount, $cbRevenue );

		wp_reset_query();    
		echo $after_widget;
	} 
	
	
	
	// Print each individual cam
	function print_cams($cam , $cbRevenue, $affid) {

		echo '
				
			<li>
			
				<div class="cb_thumbnail">
					<a href="' .plugins_url( 'ChaturbateWidget/cam.php?user=' . $cam->username . '&amp;type=' . $cbRevenue . '&amp;aff=' . $affid . '&amp;width=860&amp;height=540' ).'" class="thickbox"><img src="' . $cam->image_url . '" alt="' . $cam->username . '" width="180" height="148" /></a>
					<div class="cb_status ' . $cam->current_show . '">' . $cam->current_show . '</div>
				</div>
				
				<div class="cb_performer"><a href="' .plugins_url( 'ChaturbateWidget/cam.php?user=' . $cam->username . '&amp;type=' . $cbRevenue . '&amp;aff=' . $affid . '&amp;width=860&amp;height=540' ).'" class="thickbox">' . $cam->username . '</a></div>	

			</li>
					
		';	
		
	}

	// Do the XML Request 
	function get_cams( $affid, $gender, $limit, $cbRevenue ){
		
		$xml 	= 'http://chaturbate.com/affiliates/api/onlinerooms/?format=xml&wm='.$affid.''; // Chaturbate
		$cams 	= new SimpleXMLElement($xml, null, true);
		
		// Count the total cams
		
		if ( $gender != 'a' ) {
		
			$doc = new DOMDocument();
			$doc->load($xml);
			$totalCams = 0;
			foreach( $doc->getElementsByTagName('gender') as $tag ) 
			{
				// to iterate the children
				foreach( $tag->childNodes as $child ) 
				{
					// outputs the xml of the child nodes. Of course, there are any number of
					// things that you could do instead!
					$i = $doc->saveXML($child);
					
					if ($i == $gender )
						$totalCams++;
				}
			}

			
		} else {
		
			$totalCams = count($cams);
			
		}

		echo '<ul class="cb_thumbs">';
		
		$count = 0;
		
		foreach( $cams as $cam ){ 

			if ( $cam->gender == $gender ) {

				if ( $count < $limit ) {
					$this->print_cams($cam, $cbRevenue, $affid);
				}

				$count++;
				
			} 
			
			if ( $gender == 'a' ) {

				if ( $count < $limit ) {
					$this->print_cams($cam, $cbRevenue, $affid);
				}
				
				$count++;
						
			}
			
			
		}
		
		echo '<li class="adultwp"><a href="http://www.adultwpthemes.com" target="_blank">Get this Widget</a></li>';
		
		echo '</ul>';
		
		
		
		echo '<div style="clear: both;">&nbsp;</div>';

					

	}
	
	
	
  
}

add_action('widgets_init', create_function('', 'return register_widget("chaturbate_Widget");'));

?>