<?php

/**
 * Fired during plugin activation
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Publishing_Urlaubs
 * @subpackage Publishing_Urlaubs/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Publishing_Urlaubs
 * @subpackage Publishing_Urlaubs/includes
 * @author     Julian Muslia <juli.muslia@gmail.com>
 */
class Publishing_Urlaubs_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		datatable_creation ();
	}
}
	function datatable_creation (){
		global $wpdb;
		
		$table_name = $wpdb->prefix . "publishing_urlaubs";
	
		$table_query = "
			CREATE TABLE $table_name (
			event_id int(11) NOT NULL AUTO_INCREMENT,
			event_name varchar(255) DEFAULT NULL,
			event_start_date date DEFAULT NULL,
			event_end_date date DEFAULT NULL,
			color varchar(20) NULL,
			t_stamp timestamp,
			PRIMARY KEY (event_id)
		  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
		
		
		// CREATE TABLE $table_name (
		// id int(11) NOT NULL AUTO_INCREMENT,
		// title varchar(255) NOT NULL,
		// color varchar(20) NOT NULL,
		// start datetime NULL,
		// end datetime NULL,
		// status int(11) NULL,
		// t_stamp timestamp,
		// PRIMARY KEY  (id)
		// )ENGINE=InnoDB DEFAULT CHARSET=latin1";
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta( $table_query);
	}
