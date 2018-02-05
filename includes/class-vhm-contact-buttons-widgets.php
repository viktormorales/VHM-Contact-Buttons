<?php

/**
 * The file that defines the Widget Plugin Class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Vhm_Contact_Buttons
 * @subpackage Vhm_Contact_Buttons/includes
 * @author     Viktor H. Morales <hello@viktormorales.com>
 */
class Vhm_Contact_Buttons_Widget extends WP_Widget {

	
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	private static $plugin_name = 'vhm-contact-buttons';


	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		parent::__construct(
			self::$plugin_name, // Base ID
			esc_html__( 'VHM Contact Buttons', self::$plugin_name ), // Name
			array( 'description' => esc_html__( 'Add contact buttons', self::$plugin_name ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact us now!', self::$plugin_name );
		$facebook_active = ! empty( $instance['facebook'] ) ? true : false ;
		$whatsapp_active = ! empty( $instance['whatsapp'] ) ? true : false ;
		$skype_active = ! empty( $instance['skype'] ) ? true : false ;
		$email_active = ! empty( $instance['email'] ) ? true : false ;

		$active = get_option( 'vhm_contact_buttons_active' );
		$facebook = get_option( 'vhm_contact_buttons_facebook' );
		$whatsapp = get_option( 'vhm_contact_buttons_whatsapp' );
		$skype = get_option( 'vhm_contact_buttons_skype' );
		$email = get_option( 'vhm_contact_buttons_email' );
		$send_text = get_option( 'vhm_contact_buttons_send_text' );

		if ($active)
		{
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
			}	
		
			$output .= '<ul class="vhm-contact-buttons-list">';
			if ($facebook && $facebook_active) {
				$output .= '<li><a id="vhm-contact-buttons-facebook" href="//m.me/'.$facebook.'"><i class="fa fa-facebook-official"></i> ' . __('Facebook Messenger', self::$plugin_name) . '</a></li>';
			}
			if ($whatsapp && $whatsapp_active) {
				$output .= '<li><a id="vhm-contact-buttons-whatsapp" href="//api.whatsapp.com/send?phone='.$whatsapp.'&text='. urlencode($send_text) .'"><i class="fa fa-whatsapp"></i> ' . __('WhatsApp', self::$plugin_name) . '</a></li>';
			}
			if ($skype && $skype_active) {
				$output .= '<li><a id="vhm-contact-buttons-skype" href="skype:'.$skype.'?chat[&topic='. urlencode($send_text) .']"><i class="fa fa-skype"></i> ' . __('Skype', self::$plugin_name) . '</a></li>';
			}
			if ($email && $email_active) {
				$output .= '<li><a id="vhm-contact-buttons-email" href="'.$email.'"><i class="fa fa-envelope"></i> ' . __('Email', self::$plugin_name) . '</a></li>';
			}
			$output .= '</ul>';

			echo $output;

			echo $args['after_widget'];
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact us now!', self::$plugin_name );
		$facebook_active = ! empty( $instance['facebook'] ) ? true : false ;
		$whatsapp_active = ! empty( $instance['whatsapp'] ) ? true : false ;
		$skype_active = ! empty( $instance['skype'] ) ? true : false ;
		$email_active = ! empty( $instance['email'] ) ? true : false ;
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label>
		<input name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="checkbox"<?php echo ($facebook_active) ? ' checked="checked"' : false ; ?>> <?php esc_attr_e( 'Facebook Messenger', self::$plugin_name ); ?>
		</label> 
		</p>

		<p>
		<label>
		<input name="<?php echo esc_attr( $this->get_field_name( 'whatsapp' ) ); ?>" type="checkbox"<?php echo ($whatsapp_active) ? ' checked="checked"' : false ; ?>> <?php esc_attr_e( 'WhatsApp', self::$plugin_name ); ?>
		</label> 
		</p>

		<p>
		<label>
		<input name="<?php echo esc_attr( $this->get_field_name( 'skype' ) ); ?>" type="checkbox"<?php echo ($skype_active) ? ' checked="checked"' : false ; ?>> <?php esc_attr_e( 'Skype', self::$plugin_name ); ?>
		</label> 
		</p>

		<p>
		<label>
		<input name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="checkbox"<?php echo ($email_active) ? ' checked="checked"' : false ; ?>> <?php esc_attr_e( 'Email', self::$plugin_name ); ?>
		</label> 
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['whatsapp'] = ( ! empty( $new_instance['whatsapp'] ) ) ? strip_tags( $new_instance['whatsapp'] ) : '';
		$instance['skype'] = ( ! empty( $new_instance['skype'] ) ) ? strip_tags( $new_instance['skype'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';

		return $instance;
	}
}