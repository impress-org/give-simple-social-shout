<?php
/**
 * Plugin Name: Simple Social Shout for GiveWP
 * Plugin URI:  https://github.com/impress-org/give-simple-social-shout
 * Description: A demo Addon to how easy it can be to create your own GiveWP Add-on. This add-on adds simple social sharing buttons above your Donation Confirmation table to allow donors to tweet or post their donation to social media.
 * Version:     1.0
 * Author:      Matt Cromwell
 * Author URI:  https://www.mattcromwell.com
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sss-4-givewp
 *
 *
 * Hattip to the following online resources:
 * 1. This Codepen on doing the social links with pure HTML/CSS:
 * https://codepen.io/asheabbott/pen/GoMrzW
 *
 * 2. Socicon for the really easy social icon library with brand colors too:
 * http://www.socicon.com
 */


/**
 * Our Globals for easy Reference.
 * You'll want to make sure you replace "SIMPLE_SOCIAL_SHARE_4_GIVEWP"
 * with your own prefix throughout this whole plugin.
 *
 * Functions are prefixed with "sss4givewp_" and should be replaced as well.
 *
 * The text domain is sss-4-givewp and should be replaced as well.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class SIMPLE_SOCIAL_SHARE_4_GIVEWP
 */
final class SIMPLE_SOCIAL_SHARE_4_GIVEWP {
	/**
	 * Instance.
	 *
	 * @since
	 * @access private
	 * @var SIMPLE_SOCIAL_SHARE_4_GIVEWP
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
	 * @return SIMPLE_SOCIAL_SHARE_4_GIVEWP
	 * @since
	 * @access public
	 *
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof SIMPLE_SOCIAL_SHARE_4_GIVEWP ) ) {
			self::$instance = new SIMPLE_SOCIAL_SHARE_4_GIVEWP();
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

		register_activation_hook( SIMPLE_SOCIAL_SHARE_4_GIVEWP_FILE, array( $this, 'install' ) );
		add_action( 'give_init', array( $this, 'init' ), 10, 1 );
		add_action( 'plugins_loaded', array( $this, 'check_environment' ), 999 );
		add_action( 'wp_enqueue_scripts', array($this, 'load_styles') );
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
		if ( ! defined( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_VERSION' ) ) {
			define( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_VERSION', '1.0' );
		}

		// Set it to latest.
		if ( ! defined( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_MIN_GIVE_VERSION' ) ) {
			define( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_MIN_GIVE_VERSION', '2.5.0' );
		}

		if ( ! defined( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_FILE' ) ) {
			define( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_FILE', __FILE__ );
		}

		if ( ! defined( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR' ) ) {
			define( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR', plugin_dir_path( SIMPLE_SOCIAL_SHARE_4_GIVEWP_FILE ) );
		}

		if ( ! defined( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_URL' ) ) {
			define( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_URL', plugin_dir_url( SIMPLE_SOCIAL_SHARE_4_GIVEWP_FILE ) );
		}

		if ( ! defined( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_BASENAME' ) ) {
			define( 'SIMPLE_SOCIAL_SHARE_4_GIVEWP_BASENAME', plugin_basename( SIMPLE_SOCIAL_SHARE_4_GIVEWP_FILE ) );
		}
	}


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
		if ( ! self::$instance->check_environment() ) {
			return;
		}

		self::$instance->load_files();
	}


	/**
	 * Check plugin environment
	 *
	 * @return bool|null
	 * @since
	 * @access public
	 *
	 */
	public function check_environment() {
		// Bailout.
		if ( ! is_admin() || ! current_user_can( 'activate_plugins' ) ) {
			return null;
		}

		// Load plugin helper functions.
		if ( ! function_exists( 'deactivate_plugins' ) || ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		// Load helper functions.
		require_once SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'includes/misc-functions.php';

        // Load main functions.
        require_once SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'includes/main-functions.php';

		// Flag to check whether deactivate plugin or not.
		$is_deactivate_plugin = false;

		// Verify dependency cases.
		switch ( true ) {
			case doing_action( 'give_init' ):
				if (
					defined( 'GIVE_VERSION' ) &&
					version_compare( GIVE_VERSION, SIMPLE_SOCIAL_SHARE_4_GIVEWP_MIN_GIVE_VERSION, '<' )
				) {
					/* Min. Give. plugin version. */

					// Show admin notice.
					add_action( 'admin_notices', '__SIMPLE_SOCIAL_SHARE_4_GIVEWP_dependency_notice' );

					$is_deactivate_plugin = true;
				}

				break;

			case doing_action( 'activate_' . SIMPLE_SOCIAL_SHARE_4_GIVEWP_BASENAME ):
			case doing_action( 'plugins_loaded' ) && ! did_action( 'give_init' ):
				/* Check to see if Give is activated, if it isn't deactivate and show a banner. */

				// Check for if give plugin activate or not.
				$is_give_active = defined( 'GIVE_PLUGIN_BASENAME' ) ? is_plugin_active( GIVE_PLUGIN_BASENAME ) : false;

				if ( ! $is_give_active ) {
					add_action( 'admin_notices', '__SIMPLE_SOCIAL_SHARE_4_GIVEWP_inactive_notice' );

					$is_deactivate_plugin = true;
				}

				break;
		}

		// Don't let this plugin activate.
		if ( $is_deactivate_plugin ) {

			// Deactivate plugin.
			deactivate_plugins( SIMPLE_SOCIAL_SHARE_4_GIVEWP_BASENAME );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			return false;
		}

		return true;
	}

	/**
	 * Register setting page.
	 *
	 * @param $settings
	 *
	 * @return array
	 */
	function register_setting_page( $settings ) {
		require_once SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'includes/admin/settings.php';

		$settings[] = new SSS_4_GiveWP_Admin_Settings();

		return $settings;
	}

	/**
	 * Load plugin files.
	 *
	 * @since
	 * @access private
	 */
	private function load_files() {
		require_once SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'includes/misc-functions.php';

		if ( is_admin() ) {
			require_once SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'includes/admin/setting-examples.php';
		}
	}


	/**
	 * Setup hooks
	 *
	 * @since
	 * @access private
	 */
	public function load_styles() {
        wp_enqueue_style( 'sss4givewp', SIMPLE_SOCIAL_SHARE_4_GIVEWP_URL . 'assets/sss4givewp-frontend.css', array(), mt_rand(9,9999), 'all' );
        wp_enqueue_style( 'sss4givewp-socicon', 'https://s3.amazonaws.com/icomoon.io/114779/Socicon/style.css?u8vidh', array(), '1.0', 'all' );
	}
}

/**
 * The main function responsible for returning the one true SIMPLE_SOCIAL_SHARE_4_GIVEWP instance
 * to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $recurring = SIMPLE_SOCIAL_SHARE_4_GIVEWP(); ?>
 *
 * @return SIMPLE_SOCIAL_SHARE_4_GIVEWP|bool
 * @since 1.0
 *
 */
function SIMPLE_SOCIAL_SHARE_4_GIVEWP() {
	return SIMPLE_SOCIAL_SHARE_4_GIVEWP::get_instance();
}

SIMPLE_SOCIAL_SHARE_4_GIVEWP();
