<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Publishing_Urlaubs
 * @subpackage Publishing_Urlaubs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Publishing_Urlaubs
 * @subpackage Publishing_Urlaubs/admin
 * @author     Julian Muslia <juli.muslia@gmail.com>
 */
class Publishing_Urlaubs_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Publishing_Urlaubs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Publishing_Urlaubs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$valid_pages = array('publishing-urlaubs','publishing-add-birthday','publishing-add-feuertage');

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if (in_array($page, $valid_pages)) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/publishing-urlaubs-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style('roboto-font', plugin_dir_url( __FILE__ ) . 'css/css2.css');
			wp_enqueue_style('Bootstrap min cdn',plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');
			wp_enqueue_style('Fullcalendar min cdn', plugin_dir_url( __FILE__ ) . 'css/main.min.css');
			wp_enqueue_style('FontAwesome', plugin_dir_url( __FILE__ ) . 'css/all.min.css');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Publishing_Urlaubs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Publishing_Urlaubs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$valid_pages = array('publishing-urlaubs','publishing-add-birthday','publishing-add-feuertage');

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if (in_array($page, $valid_pages)) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/publishing-urlaubs-admin.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script('Jquery cdn', plugin_dir_url( __FILE__ ) . 'js/jquery.min.js');
			wp_enqueue_script('Bootstrap js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js');
			wp_enqueue_script('Popper ', plugin_dir_url( __FILE__ ) . 'js/popper.min.js');
			wp_enqueue_script('Fullcalendar js', plugin_dir_url( __FILE__ ) . 'js/locales-all.min.js');
			wp_enqueue_script('Sweetalert cdn', plugin_dir_url( __FILE__ ) . 'js/sweetalert.min.js');
			wp_enqueue_script('MomentJs cdn', plugin_dir_url( __FILE__ ) . 'js/moment.min.js');
			wp_enqueue_script('Fontawesome cdn', plugin_dir_url( __FILE__ ) . 'js/all.min.js');
			wp_enqueue_script('Tinymce', plugin_dir_url( __FILE__ ) . 'js/tinymce/tinymce.min.js');
		}
	}

	/**
	 * Add custom menu
	 *
	 * @since    1.0.0
	 */

	function PublishingMenu()
	{

		// Creating the MAIN MENU 
		add_menu_page('Publishing Urlaubs', 'Publishing Urlaubs', 'edit_others_posts', 'publishing-urlaubs', array($this, 'PublishingAdminDashboard'), plugin_dir_url(__FILE__) . 'img/publishing-urlaubs.png', 2);


		// Creating the Submenu
		add_submenu_page("publishing-urlaubs","Add Birthday","Add Birthday","manage_options","publishing-add-birthday",array($this, 'PublishingBirthday'),22,"dashicons-calendar-alt" );
		
		// Creating the Submenu
		add_submenu_page("publishing-urlaubs","Holidays & Email Config","Holidays & Email Config","manage_options","publishing-add-feuertage",array($this, 'PublishingFeuertagen'),22,"dashicons-calendar-alt" );

	
	
	}



	public function PublishingAdminDashboard()
	{
		//return views 
		require_once 'partials/publishing-urlaubs-admin-display.php';
		echo publishingUrlaubs();
	}

	public function PublishingBirthday()
	{
		//return views 
		require_once 'partials/workers.php';
		echo addPublishingWorkers();
	}

	public function PublishingFeuertagen()
	{
		//return views 
		require_once 'partials/feuertagen_ui.php';
		echo addPublishingFeuertagen();
	}

}
