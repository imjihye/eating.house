<?php
/*
 * Register colors and layout for the Theme Customizer.
*/

function photos_customize_register($wp_customize) {

	class Photos_Support extends WP_Customize_Control {
		public function render_content() {
			echo __('If you like this theme and if it helped you with your business then please consider supporting the development <a target="_blank" href="http://www.hardeepasrani.com/donate/">by donating some money</a>. This theme is 100% free and will always be. Any amount, even $1.00, is appreciated :)','photos');
		}
	}

	$wp_customize->get_section( 'header_image' )->priority = 20;

	$wp_customize->add_section('donate_section', array(
		'priority' => 5,
		'title' => __('Do You Like This Theme?', 'photos')
	));

	$wp_customize->add_setting( 'donate_section_main', array(
		'sanitize_callback' => 'photos_sanitize_text'
	));

	$wp_customize->add_control( new Photos_Support( $wp_customize, 'donate_section_main', array(
		'section' => 'donate_section',
	)));

	$wp_customize->add_setting('photos_avatar_image', array(
		'default' => get_template_directory_uri().'/assets/images/avatar.jpg',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'photos_avatar_image', array(
		'label' => __('Avatar', 'photos'),
		'section' => 'header_image',
		'priority' => 5,
		'settings' => 'photos_avatar_image'
	)));

	function photos_sanitize_text( $input ) {
		return $input;
	}
}
add_action('customize_register', 'photos_customize_register');

?>
