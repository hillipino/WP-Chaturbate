<?php
/*
Plugin Name: Chaturbate Posts
Plugin URI: https://nomoneyinporn.org
Description: Imports the Chaturbate XML Feed as a custom post type.
Version: 1.0
Author: Hillipino
Author URI: http://nomoneyinporn.org
License: GPL2

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

	// Include Files
	
		$dir = plugin_dir_path( __FILE__ );
		
		include( $dir . 'functions/functions.php' );		
		include( $dir . 'functions/admin/admin.php' );
		include( $dir . 'functions/admin/import.php' );			
		include( $dir . 'functions/post_types/type-webcam.php' );
		include( $dir . 'functions/meta/meta-class.php' );
		include( $dir . 'functions/meta/meta-data.php' );
		
	// How often to auto update	hourly(60min), halfhourly(30min), quarterhourly(15min)
	// If you change this deactivate and reactivate the plugin for the setting to take effect.
	
		define ( 'CRON',			'quarterhourly');		
	
	// Defaults
	
		define ( 'PLUGINNAME',		'Chaturbate' );
		define ( 'USER',			'blogbabes' );						
		define ( 'AFFID',			'827SM' );
		define ( 'TRACK',			'NMPTHEME' );	
		define ( 'MODE',			'revshare' );
		define ( 'ROOM',			'top' );	
		define ( 'CBWL',			'chaturbate.com' );
		define ( 'RELATED_TITLE',	'More Free Cams' );
		
    // Navigation / Pagination
    
		define ( 'NMP_PAGINATE_RANGE', 				'2' );													// pagination range
		define ( 'NMP_PAGINATE_PREV', 				__( 'Previous', THEMENAME ) );							// pagination previous text
		define ( 'NMP_PAGINATE_NEXT', 				__( 'Next', THEMENAME ) );								// pagination next text
		define ( 'NMP_PAGINATE_BEFORE', 				'<div class="paged">' );								// pagination previous text
		define ( 'NMP_PAGINATE_AFTER', 				'</div>' );												// pagination next text		
			
	// Create Admin Menu
		
		function nmp_plugin_menu() {		
			add_theme_page( __( PLUGINNAME . ' Settings',PLUGINNAME ), __(PLUGINNAME . ' Settings',PLUGINNAME ), 'manage_options', 'nmp-plugin-options', 'nmp_plugin_options', plugins_url( 'ChaturbatePosts/images/icon.png' ), 6 );	
		}
	
		add_action('admin_menu', 'nmp_plugin_menu');
		
		
	// Run the import halfhourly

		register_activation_hook( __FILE__, 'nmp_import_activation' );
		
	// On deactivation, remove all functions from the scheduled action hook.
	
		register_deactivation_hook( __FILE__, 'nmp_import_deactivation' );
		




?>
