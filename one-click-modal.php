<?php

/*
Plugin Name: One Click Modal Window
Plugin URI: https://wordpress.org/plugins/one-click-modal/
Description: Simple plugin that allows you to show any Elementor widget inside of a modal window. Requires Elementor
Author: Shabti Kaplan
Version: 1.0.1
Author URI:  https://kaplanwebdev.com/
*/

define( 'OCMW_VERSION', '1.0.1' );
define( 'OCMW_PATH', __FILE__ );
define( 'OCMW_NAME', plugin_basename( __FILE__ ) );
define( 'OCMW_URL', plugin_dir_url( __FILE__ ) );
define( 'OCMW_TITLE', 'One Click Modal Window' );
define( 'OCMW_NS', 'one-click-modal' );
define( 'OCMW_PREFIX', 'ocmw' );

if ( !class_exists( 'One_Click_Modal' ) ) {
	/**
	 * Main Frontend Admin Class
	 *
	 * The main class that initiates and runs the plugin.
	 *
	 * @since 1.0.1
	 */
	final class One_Click_Modal
	{
		/**
		 * Minimum PHP Version
		 *
		 * @since 1.0.1
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.2.4' ;
		/**
		 * Instance
		 *
		 * @since 1.0.1
		 *
		 * @access private
		 * @static
		 *
		 * @var One_Click_Modal The single instance of the class.
		 */
		private static  $_instance = null ;
		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 1.0.1
		 *
		 * @access public
		 * @static
		 *
		 * @return One_Click_Modal An instance of the class.
		 */
		public static function instance()
		{
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		
		/**
		 * Constructor
		 *
		 * @since 1.0.1
		 *
		 * @access public
		 */
		public function __construct()
		{
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'after_setup_theme', [ $this, 'init' ] );
		
		}
		
		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * Fired by `init` action hook.
		 *
		 * @since 1.0.1
		 *
		 * @access public
		 */
		public function i18n()
		{
			load_plugin_textdomain( OCMW_NS, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
		
		/**
		 * Initialize the plugin
		 *
		 * Load the plugin only after ACF is loaded.
		 * Checks for basic plugin requirements, if one check fail don't continue,
		 * If all checks have passed load the files required to run the plugin.
		 *
		 * Fired by `plugins_loaded` action hook.
		 *
		 * @since 1.0.1
		 *
		 * @access public
		 */
		public function init()
		{			
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}
			$this->plugin_includes();
		}
		
		public function plugin_includes()
		{
			
			if ( did_action( 'elementor/loaded' ) ) {
				require_once __DIR__ . '/elementor.php';
			}
	
		}
	
	}
	One_Click_Modal::instance();
}