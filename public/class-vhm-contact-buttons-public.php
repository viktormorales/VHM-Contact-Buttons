<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/public
 * @author     Viktor H. Morales <hello@viktormorales.com>
 */
class Vhm_Contact_Buttons_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private static $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vhm_Contact_Buttons_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vhm_Contact_Buttons_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vhm-contact-buttons-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vhm_Contact_Buttons_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vhm_Contact_Buttons_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vhm-contact-buttons-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/054c37251c.js', false, $this->version, true );

	}

	public function register_shortcodes() {
	    add_shortcode( 'vhm-contact-buttons', array( $this, 'shortcode') );
	}

	public function shortcode($atts) {
		$messenger_opt = get_option( 'vhm_contact_buttons_facebook' );
		$whatsapp_opt = get_option( 'vhm_contact_buttons_whatsapp' );
		$skype_opt = get_option( 'vhm_contact_buttons_skype' );
		$send_text_opt = get_option( 'vhm_contact_buttons_send_text' );

		extract( shortcode_atts( array(		
			'messenger' => 1,
			'whatsapp' => 1,
			'skype' => 1
		), $atts ) );

		$output .= '<ul class="vhm-contact-buttons-list">';
		if ($messenger_opt && $messenger) {
			$output .= '<li><a id="vhm-contact-buttons-facebook" href="//m.me/'.$messenger_opt.'"><i class="fa fa-facebook-official"></i> ' . __('Facebook Messenger', self::$plugin_name) . '</a></li>';
		}
		if ($whatsapp_opt && $whatsapp) {
			$output .= '<li><a id="vhm-contact-buttons-whatsapp" href="//api.whatsapp.com/send?phone='.$whatsapp_opt.'&text='. urlencode($send_text_opt) .'"><i class="fa fa-whatsapp"></i> ' . __('WhatsApp', self::$plugin_name) . '</a></li>';
		}
		if ($skype_opt && $skype) {
			$output .= '<li><a id="vhm-contact-buttons-skype" href="skype:'.$skype_opt.'?chat[&topic='. urlencode($send_text_opt) .']"><i class="fa fa-skype"></i> ' . __('Skype', self::$plugin_name) . '</a></li>';
		}
		$output .= '</ul>';

		echo $output;
	}

}
