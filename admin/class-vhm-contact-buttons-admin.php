<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/admin
 * @author     Viktor H. Morales <hello@viktormorales.com>
 */
class Vhm_Contact_Buttons_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'vhm_contact_buttons';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vhm-contact-buttons-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vhm-contact-buttons-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Register a widget
	 *
	 * @since  1.0.0
	 */
	public function register_widget() {
		register_widget( 'Vhm_Contact_Buttons_Widget' );
	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'VHM Contact Buttons Settings', $this->plugin_name ),
			__( 'VHM Contact Buttons', $this->plugin_name ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/'.$this->plugin_name.'-admin-display.php';
	}
	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', $this->plugin_name ),
			array( $this, $this->option_name .'_general_cb' ),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_active',
			__( 'Active', $this->plugin_name ),
			array( $this, $this->option_name .'_active_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_active' )
		);

		add_settings_field(
			$this->option_name . '_send_text',
			__( 'Text to send', $this->plugin_name ),
			array( $this, $this->option_name .'_send_text_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_send_text' )
		);

		add_settings_field(
			$this->option_name . '_applications',
			__( 'Applications', $this->plugin_name ),
			array( $this, $this->option_name .'_applications_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_facebook' )
		);
		
		register_setting( $this->plugin_name, $this->option_name . '_active' );
		register_setting( $this->plugin_name, $this->option_name . '_send_text' );
		register_setting( $this->plugin_name, $this->option_name . '_facebook' );
		register_setting( $this->plugin_name, $this->option_name . '_whatsapp' );
		register_setting( $this->plugin_name, $this->option_name . '_telegram' );
		register_setting( $this->plugin_name, $this->option_name . '_skype' );
		register_setting( $this->plugin_name, $this->option_name . '_email' );
	}
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function vhm_contact_buttons_general_cb() {
		echo '<p>' . __( 'Add contact buttons on your website.', $this->plugin_name ) . '</p>';
	}

	/**
	 * Render the input field for "element" option
	 *
	 * @since  1.0.0
	 */
	public function vhm_contact_buttons_active_cb() {
		$active = get_option( $this->option_name . '_active' );

		echo '<label><input type="checkbox" name="' . $this->option_name . '_active' . '" id="' . $this->option_name . '_active' . '"';
		echo ($active)? " checked" : false;
		echo '>';
		echo __('Tick the box if you want to display the buttons.', $this->plugin_name) . '</label>';
	}

	/**
	 * Render the input field for "Text to send" option
	 *
	 * @since  1.0.0
	 */
	public function vhm_contact_buttons_send_text_cb() {
		$send_text = get_option( $this->option_name . '_send_text' );

		echo '<input type="text" name="' . $this->option_name . '_send_text' . '" id="' . $this->option_name . '_send_text' . '" value="'.$send_text.'">';
		echo '<p class="description">' . __('Enter a text you want to send.', $this->plugin_name) . '</p>';
	}

	/**
	 * Render the textarea field for "before items template" option
	 *
	 * @since  1.0.0
	 */
	public function vhm_contact_buttons_applications_cb() {
		$facebook = get_option( $this->option_name . '_facebook' );
		$whatsapp = get_option( $this->option_name . '_whatsapp' );
		$telegram = get_option( $this->option_name . '_telegram' );
		$skype = get_option( $this->option_name . '_skype' );
		$email = get_option( $this->option_name . '_email' );
		
		echo '<fieldset><legend class="screen-reader-text"><span>Applications</span></legend>';
		
		/* Contact on Facebook Messenger */
		echo '<p><input type="text" name="' . $this->option_name . '_facebook' . '" id="' . $this->option_name . '_facebook' . '" value="' . $facebook . '"></p>';
		echo '<p class="description">' . __('Your Facebook Messenger personal or page ID.', $this->plugin_name) . '</p><br>';

		/* Contact on WhatsApp */
		echo '<p><input type="text" name="' . $this->option_name . '_whatsapp' . '" id="' . $this->option_name . '_whatsapp' . '" value="' . $whatsapp . '"></p>';
		echo '<p class="description">' . __('Your WhatsApp phone number.', $this->plugin_name) . '</p><br>';

		/* Contact on Telegram */
		echo '<p><input type="text" name="' . $this->option_name . '_telegram' . '" id="' . $this->option_name . '_telegram' . '" value="' . $telegram . '"></p>';
		echo '<p class="description">' . __('Your Telegram username.', $this->plugin_name) . '</p><br>';
		
		/* Contact on Skype */
		echo '<input type="text" name="' . $this->option_name . '_skype' . '" id="' . $this->option_name . '_skype' . '" value="' . $skype . '">';
		echo '<p class="description">' . __('Your Skype ID.', $this->plugin_name) . '</p><br>';

		/* Contact through email */
		echo '<input type="text" name="' . $this->option_name . '_email' . '" id="' . $this->option_name . '_email' . '" value="' . $email . '">';
		echo '<p class="description">' . __('Your email.', $this->plugin_name) . '</p>';

		echo '</fieldset>';
	}

}
