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
		$valid_pages = array("publishing-urlaubs");

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if (in_array($page, $valid_pages)) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/publishing-urlaubs-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style('roboto-font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');
			wp_enqueue_style('Bootstrap min cdn', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css');
			wp_enqueue_style('Fullcalendar min cdn', 'https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3/main.min.css,npm/fullcalendar@5.11.3/main.min.css');
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
		$valid_pages = array("publishing-urlaubs");

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if (in_array($page, $valid_pages)) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/publishing-urlaubs-admin.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script('Jquery cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
			wp_enqueue_script('Bootstrap js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js');
			wp_enqueue_script('Popper ', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js');
			wp_enqueue_script('Fullcalendar js', 'https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3,npm/fullcalendar@5.11.3/main.min.js,npm/fullcalendar@5.11.3/locales-all.min.js,npm/fullcalendar@5.11.3/locales-all.min.js');
			wp_enqueue_script('Sweetalert cdn', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js');
			wp_enqueue_script('MomentJs cdn', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js');
		}
	}

	/**
	 * Add custom menu
	 *
	 * @since    1.0.0
	 */

	function PublishingMenu()
	{


		add_menu_page('Publishing Urlaubs', 'Publishing Urlaubs', 'manage_options', 'publishing-urlaubs', array($this, 'PublishingAdminDashboard'), plugin_dir_url(__FILE__) . 'img/publishing-urlaubs.png', 2);

	}

	public function PublishingAdminDashboard()
	{
		//return views 
		require_once 'partials/publishing-urlaubs-admin-display.php';
		echo publishingUrlaubs();
	}

}
