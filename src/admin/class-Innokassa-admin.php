<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

/**
 * @link       https://innokassa.ru/
 * @since      1.0.0
 *
 * @package    Innokassa
 * @subpackage Innokassa/admin
 */

/**
 * @package    Innokassa
 * @subpackage Innokassa/admin
 */
class InnokassaAdmin
{
    /**
     * @since    1.0.0
     * @access   private
     * @var      string    $Innokassa    The ID of this plugin.
     */
    private $Innokassa;

    /**
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    public function __construct($Innokassa, $version)
    {
        $this->Innokassa = $Innokassa;
        $this->version = $version;
    }

    /**
     * @since    1.0.0
     */
    public function enqueueStyles()
    {
        wp_enqueue_style(
            $this->Innokassa,
            plugin_dir_url(__FILE__) . 'css/Innokassa-admin.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * @since    1.0.0
     */
    public function enqueueScripts()
    {
        wp_enqueue_script("jquery");
        wp_enqueue_script('Innokassa-admin', plugin_dir_url(__FILE__) . 'js/Innokassa-admin.js', array('jquery'));
        wp_enqueue_script('qrcode.min.js', plugin_dir_url(__FILE__) . 'js/qrcode.min.js', array('jquery'));
    }

    public function addMenu()
    {
        $hook = add_submenu_page(
            'woocommerce',
            __('Настройки Innokassa', 'Innokassa'),
            __('Настройки Innokassa', 'Innokassa'),
            'manage_options',
            'Innokassa_submenu',
            array($this, 'renderAdminPage')
        );
    }

    public function registerSettings()
    {
        register_setting('Innokassa-option-group', 'innokassa_option_actor_id');
        register_setting('Innokassa-option-group', 'innokassa_option_actor_token');
        register_setting('Innokassa-option-group', 'innokassa_option_cashbox');
        register_setting('Innokassa-option-group', 'innokassa_option_scheme');
        register_setting('Innokassa-option-group', 'innokassa_option_status_first_receipt');
        register_setting('Innokassa-option-group', 'innokassa_option_status_second_receipt');
        register_setting('Innokassa-option-group', 'innokassa_option_place_of_settlement');
        register_setting('Innokassa-option-group', 'innokassa_option_taxation');
        register_setting('Innokassa-option-group', 'innokassa_option_type_of_receipt_position');
        register_setting('Innokassa-option-group', 'innokassa_option_vat');
        register_setting('Innokassa-option-group', 'innokassa_option_delivery_vat');
    }

    public function renderAdminPage()
    {
        $this->render('partials/Innokassa-admin-display.php', []);
    }

    private function render($viewPath, $args)
    {
        extract($args);
        include(plugin_dir_path(__FILE__) . $viewPath);
    }
}
