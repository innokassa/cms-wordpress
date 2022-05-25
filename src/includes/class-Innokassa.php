<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

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

        $this->loadDependencies();
        $this->setLocale();
        $this->defineAdminHooks();
        $this->definePublicHooks();
    }

    /**
     * @since    1.0.0
     * @access   private
     */
    private function loadDependencies()
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
    private function setLocale()
    {
        $plugin_i18n = new InnokassaI18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'loadPluginTextdomain');
    }

    /**
     * @since    1.0.0
     * @access   private
     */
    private function defineAdminHooks()
    {
        $plugin_admin = new InnokassaAdmin($this->getInnokassa(), $this->getVersion());

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
    private function definePublicHooks()
    {
        $plugin_public = new InnokassaPublic($this->getInnokassa(), $this->getVersion());

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
    public function getInnokassa()
    {
        return $this->Innokassa;
    }

    /**
     * @since     1.0.0
     * @return    Innokassa_Loader    Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }
}
