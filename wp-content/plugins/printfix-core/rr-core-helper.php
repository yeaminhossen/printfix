<?php
/**
	* Plugin Name: Printfix Core
	* Description: RRdevs elementor core plugin.
	* Plugin URI:  https://wp.rrdevs.net/
	* Version:     1.0.0
	* Author:      RRdevs
	* Author URI:  https://wp.rrdevs.net/
	* Text Domain: rr-core
	* Elementor tested up to: 3.15.3
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Define
*/
define('RRCORE_ADDONS_URL', plugins_url('/', __FILE__));
define('RRCORE_ADDONS_DIR', dirname(__FILE__));
define('RRCORE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('RRCORE_ELEMENTS_PATH', RRCORE_ADDONS_DIR . '/include/elementor');
define('RRCORE_WIDGET_PATH', RRCORE_ADDONS_DIR . '/include/widgets');
define('RRCORE_INCLUDE_PATH', RRCORE_ADDONS_DIR . '/include');
// define('RR_API_URL', 'htRR://harry.test/elementor-block/');
// define('RR_EXT_LOGO_URL', RRCORE_ADDONS_URL.'include/elementor/templates/img/logo-black.svg' );
define('RR_EXT_LOGO_ICON_URL', RRCORE_ADDONS_URL.'assets/img/logo.png' );

define( 'RR_ADDONS_FILE_', __FILE__ );
define( 'RR_ADDONS_VERSION_', '3.1.3');


/**
 * 
 * Elementor blocks
 */

 
// if(did_action('elementor/loaded')){
// 	include_once(RRCORE_ADDONS_DIR . '/include/elementor/templates/api.php');
// 	include_once(RRCORE_ADDONS_DIR . '/include/elementor/templates/init.php');
// 	include_once(RRCORE_ADDONS_DIR . '/include/elementor/templates/import.php');
// 	include_once(RRCORE_ADDONS_DIR . '/include/elementor/templates/load.php');

	
// 	\RR_ELEMENTOR\Templates\RR_Templates::instance()->init();
// 	\RR_ELEMENTOR\Templates\RR_Import::instance()->load();
// 	\RR_ELEMENTOR\Templates\RR_Load::instance()->load();
// }


/** 
 * Include all files
*/
include_once(RRCORE_ADDONS_DIR . '/include/custom-post-services.php');
// include_once(RRCORE_ADDONS_DIR . '/include/custom-post-jobs.php');
include_once(RRCORE_ADDONS_DIR . '/include/custom-post-projects.php');
include_once(RRCORE_ADDONS_DIR . '/include/common-functions.php');
include_once(RRCORE_ADDONS_DIR . '/include/class-ocdi-importer.php');
include_once(RRCORE_ADDONS_DIR . '/include/allow-svg.php');
include_once(plugin_dir_path(__FILE__) . '/include/post-view.php');
include_once(plugin_dir_path(__FILE__) . '/include/social-share.php');;

include_once(RRCORE_ADDONS_DIR . '/include/menu/menu.php');



/**
 * RR Custom Widget
*/
include_once(RRCORE_WIDGET_PATH . '/RR-blog-post-sidebar.php');
include_once(RRCORE_WIDGET_PATH . '/RR-footer-post-no-thumb.php');
include_once(RRCORE_WIDGET_PATH . '/RR-service-list.php');
// include_once(RRCORE_WIDGET_PATH . '/RR-sidebar-list.php');

if ( class_exists('Charitable_Campaign' ) ) {
	include_once(RRCORE_WIDGET_PATH . '/RR-donation-post.php');
}
// include_once(RRCORE_WIDGET_PATH . '/RR-latest-posts-footer.php');



/**
 * Main RR Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class RR_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

	
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rr-core' ),
			'<strong>' . esc_html__( 'RR Core', 'rr-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rr-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rr-core' ),
			'<strong>' . esc_html__( 'RR Core', 'rr-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rr-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rr-core' ),
			'<strong>' . esc_html__( 'RR Core', 'rr-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'rr-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate RR_Core.
new RR_Core();