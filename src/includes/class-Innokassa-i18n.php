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
class Innokassa_i18n
{


	/**
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'Innokassa',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
