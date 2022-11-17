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
		
		

		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta( $table_query);

		$users_bday = $wpdb->prefix . "publishing_users";		
		$users_bday_query= "
		CREATE TABLE $users_bday (
		ID int(11) NOT NULL AUTO_INCREMENT,
		NAME varchar(150) NOT NULL,
		EMAIL varchar(150) NOT NULL,
		DOB date NOT NULL,
		PRIMARY KEY (ID)
	  ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1";

	  require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
	  dbDelta($users_bday_query);


	  $feuertage = $wpdb->prefix . "publishing_feuertage";		
	  $feuertage_query= "
	  CREATE TABLE $feuertage (
	  ID int(11) NOT NULL AUTO_INCREMENT,
			feuertag_start_date date DEFAULT NULL,
			feuertag_end_date date DEFAULT NULL,
			feuertag_overlap varchar(255) DEFAULT NULL,
			feuertag_display varchar(255) DEFAULT NULL,
			feuertag_color varchar(20) NULL,
	  PRIMARY KEY (ID)
	) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1";

	require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($feuertage_query);
	}