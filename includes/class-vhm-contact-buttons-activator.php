<?php

/**
 * Fired during plugin activation
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/includes
 * @author     Viktor H. Morales <hello@viktormorales.com>
 */
class Vhm_Contact_Buttons_Activator {
	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private static $option_name = 'vhm_contact_buttons';
	
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	private static $plugin_name = 'vhm-contact-buttons';

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Add default options
		update_option(self::$option_name . '_active', 'on');
		update_option(self::$option_name . '_applications', array('facebook','whatsapp', 'skype'));
	}

}
