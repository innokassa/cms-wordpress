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
class InnokassaI18n
{
    /**
     * @since    1.0.0
     */
    public function loadPluginTextdomain()
    {
        loadPluginTextdomain(
            'Innokassa',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
