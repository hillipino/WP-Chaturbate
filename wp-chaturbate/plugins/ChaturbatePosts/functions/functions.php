<?php

	// Load Scripts and CSS
		
		add_action( 'admin_enqueue_scripts', 'nmp_adminscripts' );
		
		function nmp_adminscripts() {	
			wp_enqueue_style( 'nmp_admin_css', plugins_url( 'ChaturbatePosts/css/admin.css' ) );	
			wp_enqueue_script( 'nmp_admin_init', plugins_url( 'ChaturbatePosts/js/admin.js' ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-button' ));
			wp_register_script( 'nmp_tabs', plugins_url( 'ChaturbatePosts/js/nmp_tabs.js' ), array('jquery'), '1.0', false );
			wp_enqueue_script( 'jquery-ui-slider', array('jquery') );		
		}
		
	// Add Cron schedules to WP-Cron

		function nmp_half_hour( $schedules ) {
		
		// add a '30min' schedule to the existing set
		
			$schedules['halfhourly'] = array(
				'interval' => 1800,
				'display' => __('Half Hourly')
			);
			
		// add a '15min' schedule to the existing set	
			$schedules['quarterhourly'] = array(
				'interval' => 900,
				'display' => __('Quarter Hourly')
			);
			
			return $schedules;
		}
		add_filter( 'cron_schedules', 'nmp_half_hour' ); 	

		function nmp_import_activation() {
			wp_schedule_event( time(), CRON, 'nmp_halfhourly_event' );
		}

		add_action( 'nmp_halfhourly_event', 'nmp_import_halfhourly' );
		
		function nmp_import_halfhourly() {
			nmp_import();
		}
	
		function nmp_import_deactivation() {
			wp_clear_scheduled_hook( 'nmp_halfhourly_event' );
		}	
		