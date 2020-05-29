<?php
/**
 * Plugin Name: GiveWP Pixel Tracking
 * Plugin URI:  https://github.com/impress-org/givewp-facebook-pixel-tracking
 * Description: Extends Facebook Pixel Tracking to add donation-specific events
 * Version:     1.0
 * Author:      GiveWP
 * Author URI:  https://givewp.com
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: givewppt4fb
 *
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class GIVEWP_PT4FB
 */
final class GIVEWP_PT4FB {
	/**
	 * Instance.
	 *
	 * @since
	 * @access private
	 * @var GIVEWP_PT4FB
	 */
	private static $instance;

	/**
	 * Singleton pattern.
	 *
	 * @since
	 * @access private
	 */
	private function __construct() {
	}


	/**
	 * Get instance.
	 *
	 * @return GIVEWP_PT4FB
	 * @since
	 * @access public
	 *
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof GIVEWP_PT4FB ) ) {
			self::$instance = new GIVEWP_PT4FB();
			self::$instance->setup();
		}

		return self::$instance;
	}


	/**
	 * Setup
	 *
	 * @since
	 * @access private
	 */
	private function setup() {
		self::$instance->setup_constants();

		register_activation_hook( GIVEWP_PT4FB_FILE, array( $this, 'install' ) );
		add_action( 'give_init', array( $this, 'init' ), 10, 1 );
		add_action( 'admin_init', array( $this, 'check_environment' ), 999 );
		add_action( 'admin_notices', array( $this, 'admin_notices' ), 15 );
		add_action( 'admin_enqueue_scripts', array($this, 'load_admin_styles') );
		add_action( 'wp_enqueue_scripts', array($this, 'load_frontend_scripts') );
		add_filter( 'give-settings_get_settings_pages', array( $this, 'register_setting_page' ) );
	}


	/**
	 * Setup constants
	 *
	 * Defines useful constants to use throughout the add-on.
	 *
	 * @since
	 * @access private
	 */
	private function setup_constants() {

		// Defines addon version number for easy reference.
		if ( ! defined( 'GIVEWP_PT4FB_VERSION' ) ) {
			define( 'GIVEWP_PT4FB_VERSION', '1.0' );
		}

		// Set it to latest.
		if ( ! defined( 'GIVEWP_PT4FB_MIN_GIVE_VERSION' ) ) {
			define( 'GIVEWP_PT4FB_MIN_GIVE_VERSION', '2.5' );
		}

		if ( ! defined( 'GIVEWP_PT4FB_FILE' ) ) {
			define( 'GIVEWP_PT4FB_FILE', __FILE__ );
		}

		if ( ! defined( 'GIVEWP_PT4FB_DIR' ) ) {
			define( 'GIVEWP_PT4FB_DIR', plugin_dir_path( GIVEWP_PT4FB_FILE ) );
		}

		if ( ! defined( 'GIVEWP_PT4FB_URL' ) ) {
			define( 'GIVEWP_PT4FB_URL', plugin_dir_url( GIVEWP_PT4FB_FILE ) );
		}

		if ( ! defined( 'GIVEWP_PT4FB_BASENAME' ) ) {
			define( 'GIVEWP_PT4FB_BASENAME', plugin_basename( GIVEWP_PT4FB_FILE ) );
		}
	}

	/**
	 * Notices (array)
	 *
	 * @var array
	 */
	public $notices = array();

	/**
	 * Plugin installation
	 *
	 * @since
	 * @access public
	 */
	public function install() {
		// Bailout.
		if ( ! self::$instance->check_environment() ) {
			return;
		}

		// Number of days you want the notice delayed by.
		$delayindays = 15;

		// Create timestamp for when plugin was activated.
		$triggerdate = mktime( 0, 0, 0, date('m')  , date('d') + $delayindays, date('Y') );

		// If our option doesn't exist already, we'll create it with today's timestamp.
		if ( ! get_option( 'givewppt4fb_activation_date' ) ) {
			add_option( 'givewppt4fb_activation_date', $triggerdate, '', 'yes' );
		}
	}

	/**
	 * Plugin installation
	 *
	 * @param Give $give
	 *
	 * @return void
	 * @since
	 * @access public
	 *
	 */
	public function init( $give ) {

		// Don't hook anything else in the plugin if we're in an incompatible environment.
		if ( ! $this->get_environment_warning() ) {
			return;
		}

		$this->load_textdomain();

		self::$instance->load_files();
	}

	/**
	 * Loads the plugin language files.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @return void
	 */
	public function load_textdomain()
	{

		// Set filter for Give's languages directory
		$give_lang_dir = dirname(plugin_basename(GIVEWP_PT4FB_FILE)) . '/languages/';
		$give_lang_dir = apply_filters('givewppt4fb_languages_directory', $give_lang_dir);

		// Traditional WordPress plugin locale filter.
		$locale = is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale();
		$locale = apply_filters('plugin_locale', $locale, 'givewppt4fb');

		unload_textdomain('givewppt4fb');
		load_textdomain('givewppt4fb', WP_LANG_DIR . '/givewp-pixel-tracking/' . $locale . '.mo');
		load_plugin_textdomain('givewppt4fb', false, $give_lang_dir);
	}


	/**
	 * Check plugin environment.
	 *
	 * @since  2.1.1
	 * @access public
	 *
	 * @return bool
	 */
	public function check_environment() {
		// Flag to check whether plugin file is loaded or not.
		$is_working = true;
		// Load plugin helper functions.
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		/* Check to see if GiveWP is activated, if it isn't deactivate and show a banner. */

		$is_give_active = defined( 'GIVE_PLUGIN_BASENAME' ) ? is_plugin_active( GIVE_PLUGIN_BASENAME ) : false;

		if ( empty( $is_give_active ) ) {
			// Show admin notice.
			$this->add_admin_notice( 'prompt_give_activate', 'error', sprintf( __( '<strong>Activation Error:</strong> You must have the <a href="%s" target="_blank">GiveWP</a> plugin installed and activated for GiveWP Pixel Tracking to activate.', 'givewppt4fb' ), 'https://givewp.com' ) );

			// Deactivate plugin.
			deactivate_plugins( GIVEWP_PT4FB_BASENAME );
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$is_working = false;
		}

		return $is_working;
	}

	/**
	 * Check plugin for Give environment.
	 *
	 * @since  2.1.1
	 * @access public
	 *
	 * @return bool
	 */
	public function get_environment_warning() {
		// Flag to check whether plugin file is loaded or not.
		$is_working = true;

		// Verify dependency cases.
		if (
			defined( 'GIVE_VERSION' )
			&& version_compare( GIVE_VERSION, GIVEWP_PT4FB_MIN_GIVE_VERSION, '<' )
		) {
			/* Min. Give. plugin version. */
			// Show admin notice.
			$this->add_admin_notice( 'prompt_give_incompatible', 'error', sprintf( __( '<strong>Activation Error:</strong> You must have the <a href="%s" target="_blank">GiveWP</a> core version %s for the GiveWP Pixel Tracking add-on to activate.', 'givewppt4fb' ), 'https://givewp.com', GIVEWP_PT4FB_MIN_GIVE_VERSION ) );
			
			$is_working = false;

		}

		return $is_working;
	}

	/**
	 * Allow this class and other classes to add notices.
	 *
	 * @param string $slug Notice Slug.
	 * @param string $class Notice Class.
	 * @param string $message Notice Message.
	 */
	public function add_admin_notice( $slug, $class, $message ) {
		$this->notices[ $slug ] = array(
			'class'   => $class,
			'message' => $message,
		);
	}

	/**
	 * Display admin notices.
	 */
	public function admin_notices() {
		$allowed_tags = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
				'class' => array(),
				'id'    => array(),
			),
			'br'     => array(),
			'em'     => array(),
			'span'   => array(
				'class' => array(),
			),
			'strong' => array(),
		);
		foreach ( (array) $this->notices as $notice_key => $notice ) {
			echo "<div class='" . esc_attr( $notice['class'] ) . "'><p>";
			echo wp_kses( $notice['message'], $allowed_tags );
			echo '</p></div>';
		}
	}

	/**
	 * Register setting page.
	 *
	 * @param $settings
	 *
	 * @return array
	 */
	function register_setting_page( $settings ) {
		require_once GIVEWP_PT4FB_DIR . 'includes/admin/settings.php';

		$settings[] = new GiveWP_PT4FB_Admin_Settings();

		return $settings;
	}

	/**
	 * Load plugin files.
	 *
	 * @since
	 * @access private
	 */
	private function load_files() {

		//require_once GIVEWP_PT4FB_DIR . 'includes/admin/form-settings.php';

		//require_once GIVEWP_PT4FB_DIR . 'includes/admin/settings.php';

		require_once GIVEWP_PT4FB_DIR . 'includes/admin/notice.php';

		require_once GIVEWP_PT4FB_DIR . 'includes/frontend-scripts.php';
	}

	/**
	 * Setup hooks
	 *
	 * @since
	 * @access private
	 */
	public function load_admin_styles() {
        wp_enqueue_style( 'givewppt4fb-admin', GIVEWP_PT4FB_URL . 'assets/givewppt4fb-admin.css', array(), GIVEWP_PT4FB_VERSION, 'all' );
	}

	/**
	 * Setup hooks
	 *
	 * @since
	 * @access private
	 */
	public function load_frontend_scripts() {
        //wp_enqueue_script( 'givewppt4fb-script', GIVEWP_PT4FB_URL . 'assets/js/givewppt4fb-frontend.js', array(), GIVEWP_PT4FB_VERSION );
	}

}

/**
 * The main function responsible for returning the one true GIVEWP_PT4FB instance
 * to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $givewp_pixel = GIVEWP_PT4FB(); ?>
 *
 * @return GIVEWP_PT4FB|bool
 * @since 1.0
 *
 */
function GIVEWP_PT4FB() {
	return GIVEWP_PT4FB::get_instance();
}

GIVEWP_PT4FB();
