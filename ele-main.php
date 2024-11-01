<?php

namespace COOELEMENTOR;

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

class COOAllianceElePack
{
	public $version = '1.0.0';

	/**
	 * Minimum Elementor Version
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
		// set the constants first
		$this->setConstants();

		// Register the custom autoloading function.
		spl_autoload_register([$this, 'autoload']);

		// register the activation
		register_activation_hook(__FILE__, [$this, 'activate']);

		// registser the deactivation
		register_deactivation_hook(__FILE__, [$this, 'deactivate']);

        // Hook into WordPress after theme setup
		add_action('after_setup_theme', array($this, 'coo_podcasts_thumbnail_size'));

	}

    // Register a custom thumbnail size
	function coo_podcasts_thumbnail_size() {
		add_image_size('coo-podcast-thumb', 1280, 506, true);
	}

	public function setConstants()
	{
		define('COOELEMENTOR_VERSION', $this->version);
		define('COOELEMENTOR_FILE', __FILE__);
		define('COOELEMENTOR_NAME', 'COOAlliance Elementor Pack');
		define('COOELEMENTOR_PATH', dirname(COOELEMENTOR_FILE));
		define('COOELEMENTOR_INC', COOELEMENTOR_PATH . '/inc');
		define('COOELEMENTOR_URL', plugins_url('', COOELEMENTOR_FILE));
		define('COOELEMENTOR_ASSETS', COOELEMENTOR_URL . '/assets');
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin Name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'cooalliance-ele'),
			'<strong>' . esc_html__(COOELEMENTOR_NAME, 'cooalliance-ele') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'cooalliance-ele') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'cooalliance-ele'),
			'<strong>' . esc_html__(COOELEMENTOR_NAME, 'cooalliance-ele') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'cooalliance-ele') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'cooalliance-ele'),
			'<strong>' . esc_html__(COOELEMENTOR_NAME, 'cooalliance-ele') . '</strong>',
			'<strong>' . esc_html__('PHP', 'cooalliance-ele') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init()
	{

		add_action('elementor/widgets/register', [$this, 'register_widgets']);
	}



	/**
	 * activate.
	 * function that runs on plugin activation
	 * @author   COOALLIANCE
	 * @since   v0.0.1
	 * @version   v1.1.0   
	 * @access   public
	 * @return   void
	 */
	public function activate()
	{
		// flush rewrite rules
		flush_rewrite_rules();

		$isInstalled = get_option('COOALLIANCEELEMENTOR_installed');

		if (!$isInstalled) {
			update_option('COOALLIANCEELEMENTOR_installed', time());
		}

		update_option('COOELEMENTOR_Version', COOELEMENTOR_VERSION);
	}

	/**
	 * deactivate.
	 * function that runs on plugin deactivation
	 * @author   COOALLIANCE
	 * @since   v0.0.1
	 * @version   v1.1.0   
	 * @access   public
	 * @return   void
	 */
	public function deactivate()
	{
		// Flush reqrite rules
		flush_rewrite_rules();
	}

	// autoload files for load classes dynamically
	public function autoload($class_name)
	{
		// Define the base namespace for your classes
		$base_namespace = 'inc\\widgets\\';

		// Check if the class uses the base namespace
		if (strpos($class_name, $base_namespace) === 0) {
			// Convert namespace separators to directory separators
			$relative_class_name = substr($class_name, strlen($base_namespace));
			$file_path = COOELEMENTOR_PATH . '/inc/widgets/' . str_replace('\\', '/', $relative_class_name) . '.php';

			if (file_exists($file_path)) {
				require $file_path;
			}
		}
	}
	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{

		// Include Widget configurations
		require_once COOELEMENTOR_PATH . '/inc/widgets/basewidget.php';

		// Register your widgets dynamically based on the class names.
		$widgets = [
			\inc\widgets\podcasts\Main::class,
			\inc\widgets\reviews\Main::class,
			\inc\widgets\CaptivatePlayer\Main::class,
			\inc\widgets\CaptivatePlayerSingle\Main::class,

		];

		foreach ($widgets as $widget_class) {
			$widgets_manager->register(new $widget_class());
		}
	}
}