<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://kamalabs.com
 * @since      1.0.0
 *
 * @package    Wp_Embed_Quran
 * @subpackage Wp_Embed_Quran/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Embed_Quran
 * @subpackage Wp_Embed_Quran/includes
 * @author     Mustafa Kamal <mustafakamal87@gmail.com>
 */
class Wp_Embed_Quran_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-embed-quran',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
