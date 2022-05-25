<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

/**
 * @link       https://innokassa.ru/
 * @since      1.0.0
 *
 * @package    Innokassa
 * @subpackage Innokassa/public
 */

/**
 * @package    Innokassa
 * @subpackage Innokassa/public
 * @author     Your Name <email@example.com>
 */
class InnokassaPublic
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

    /**
     * @since    1.0.0
     * @param      string    $Innokassa       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
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
            plugin_dir_url(__FILE__) . 'css/Innokassa-public.css',
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
        wp_enqueue_script(
            $this->Innokassa,
            plugin_dir_url(__FILE__) . 'js/Innokassa-public.js',
            array('jquery'),
            $this->version,
            false
        );
    }
}
