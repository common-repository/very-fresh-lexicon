<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       freshlabs.net
 * @since      1.0.0
 *
 * @package    Very_Fresh_Lexicon
 * @subpackage Very_Fresh_Lexicon/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Very_Fresh_Lexicon
 * @subpackage Very_Fresh_Lexicon/includes
 * @author     freshlabg GbR <vlad@freshlabs.de>
 */
class Very_Fresh_Lexicon_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'very-fresh-lexicon',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
