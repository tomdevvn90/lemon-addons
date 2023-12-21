<?php
/**
 * Plugin Name: Lemon Addons
 * Description: Extra custom post type and elements for Elementor.
 * Plugin URI:  https://bearsthemes.com/bearsthemes-addons/
 * Version:     2.3.1
 * Author:      Bearsthemes
 * Author URI:  https://bearsthemes.com/
 * Text Domain: bearsthemes-addons
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Bearsthemes Addons Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.0.0
 */
final class Bearsthemes_Addons {

	/**
	 * Plugin Version
	 *
	 * @since 2.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '2.3.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 2.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 2.0.0
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

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'bearsthemes-addons' );
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
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'bearsthemes_enqueue_scripts' ) );

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

		// SVG Icons class.
		require_once( 'icons/class-svg-icons.php' );
		require_once( 'icons/icon-functions.php' );

		// Custom post type
		require_once( plugin_dir_path(__FILE__) . 'custom-post-type.php' );

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( plugin_dir_path(__FILE__) . '/plugin.php' );

		// Custom elementor default
		require_once( plugin_dir_path(__FILE__) . 'custom-elementor.php' );

		//require_once ( plugin_dir_path(__FILE__) . 'template-library/editor/init.php');

		//require_once ( plugin_dir_path(__FILE__) . 'template-library/template-library-base.php');
		//require_once ( plugin_dir_path(__FILE__) . 'template-library/editor/manager/api.php');

	}

	public function bearsthemes_load_elementor_breakpoint_variables() {
	
		$breakpoints_default = \Elementor\Plugin::$instance->breakpoints->get_default_config();
		$breakpoints_active = \Elementor\Plugin::$instance->breakpoints->get_active_breakpoints();

		$breakpoints =  ':root{';

		if( !empty( $breakpoints_default ) ){
			foreach ($breakpoints_default as $key => $breakpoint ) {
				$value = $breakpoint['default_value'];
				$variable = "--e-global-default-break-$key: {$value}px;";
				$breakpoints .= $variable;
			}
		}

		if( !empty( $breakpoints_active ) ){
			foreach ($breakpoints_active as $key => $breakpoint ) {
				$value = $breakpoint->get_value();
				$variable = "--e-global-active-break-$key: {$value}px;";
				$breakpoints .= $variable;
			}
		}

		$breakpoints .=  '}';

		return $breakpoints;
	}

	/**
	 * Enqueue scripts
	 */
	public function bearsthemes_enqueue_scripts() {
		wp_enqueue_style( 'lemon-addons-plugin', plugins_url( '/dist/css/plugin.css', __FILE__ ), array(), rand(11111, 99999) );
		wp_enqueue_script( 'lemon-addons-plugin', plugin_dir_url( __FILE__ ) . 'dist/js/plugin.js',   array( 'jquery' ), rand(11111, 99999999), true);
	
		$breakpoint_variables = $this->bearsthemes_load_elementor_breakpoint_variables();
		wp_add_inline_style( 'lemon-addons-plugin', $breakpoint_variables );
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
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'bearsthemes-addons' ),
			'<strong>' . esc_html__( 'Bearsthemes Addons', 'bearsthemes-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'bearsthemes-addons' ) . '</strong>'
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'bearsthemes-addons' ),
			'<strong>' . esc_html__( 'Bearsthemes Addons', 'bearsthemes-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'bearsthemes-addons' ) . '</strong>',
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'bearsthemes-addons' ),
			'<strong>' . esc_html__( 'Bearsthemes Addons', 'bearsthemes-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'bearsthemes-addons' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Bearsthemes_Addons.
new Bearsthemes_Addons();
