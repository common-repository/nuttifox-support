<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://nuttifox.com
 * @since      1.0.0
 *
 * @package    Nuttifox_Support
 * @subpackage Nuttifox_Support/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nuttifox_Support
 * @subpackage Nuttifox_Support/includes
 * @author     Nuttifox <hello@nuttifox.com>
 */
class Nuttifox_Support_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nuttifox-support',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
