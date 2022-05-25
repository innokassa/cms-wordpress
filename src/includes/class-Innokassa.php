<?php

/**
 * @link       https://innokassa.ru/
 * @since      1.0.0
 *
 * @package    Innokassa
 * @subpackage Innokassa/includes
 */

/**
 * @since      1.0.0
 * @package    Innokassa
 * @subpackage Innokassa/includes
 */
class Innokassa
{

	/**
	 * @since    1.0.0
	 * @access   protected
	 * @var      Innokassa_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $Innokassa    The string used to uniquely identify this plugin.
	 */
	protected $Innokassa;

	/**
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('INNOKASSA_VERSION')) {
			$this->version = INNOKASSA_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->Innokassa = 'Innokassa';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-Innokassa-loader.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-Innokassa-i18n.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-Innokassa-admin.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-Innokassa-public.php';

		$this->loader = new Innokassa_Loader();
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Innokassa_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{
		$plugin_admin = new Innokassa_Admin($this->get_Innokassa(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$this->loader->add_action('admin_menu', $plugin_admin, 'addMenu');
		$this->loader->add_action('admin_init', $plugin_admin, 'registerSettings');
		$this->loader->add_action('woocommerce_payment_complete', 'custom_process_order', 10, 1);
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Innokassa_Public($this->get_Innokassa(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_Innokassa()
	{
		return $this->Innokassa;
	}

	/**
	 * @since     1.0.0
	 * @return    Innokassa_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
