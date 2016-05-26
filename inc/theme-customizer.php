<?php
/**
 * UW-Madison Customizer Configuration
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */

require_once("menu-dropdown-custom-control.php");

/**
 * Implements UW-Madison theme options into Theme Customizer
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since UW-Madison 1.3
 */
function uwmadison_customize_register( $wp_customize ) {
	$defaults = uwmadison_get_default_theme_mods();

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add settings sections
	$wp_customize->add_section( 'uwmadison_colors_type', array(
		'title'    => __( 'Colors & Typography', 'uw-madison-160' ),
		'priority' => 40,
	) );
	$wp_customize->add_section( 'uwmadison_header', array(
		'title'    => __( 'Header', 'uw-madison-160' ),
		'priority' => 50,
	) );
	$wp_customize->add_section( 'uwmadison_layout', array(
		'title'    => __( 'Layout', 'uw-madison-160' ),
		'priority' => 50,
	) );
	$wp_customize->add_section( 'uwmadison_footer', array(
		'title'    => __( 'Footer', 'uw-madison-160' ),
		'priority' => 140,
	) );



	// Add colors and typography settings and controls
	$wp_customize->add_setting( 'uwmadison_body_bg', array(
		'default'           => $defaults['uwmadison_body_bg'],
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_body_bg' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_body_bg', array(
		'section'    => 'uwmadison_colors_type',
		'label' => 'Page background color',
		'type'       => 'radio',
		'choices'    => uwmadison_get_settings_choices( 'bgcolors' ),
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'uwmadison_header_style', array(
		'default'           => $defaults['uwmadison_header_style'],
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_header_style' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_header_style', array(
		'section'    => 'uwmadison_colors_type',
		'label' => 'Menu bar colors',
		'type'       => 'radio',
		'choices'    => uwmadison_get_settings_choices( 'header_styles' ),
		'capability'        => 'edit_theme_options',
	) );

	// $wp_customize->add_setting( 'uwmadison_navbar_flat', array(
	// 	'default'           => $defaults['uwmadison_navbar_flat'],
	// 	'sanitize_callback' => 'sanitize_key',
	// ) );
	// $wp_customize->get_setting( 'uwmadison_navbar_flat' )->transport = 'postMessage';
	// $wp_customize->add_control( 'uwmadison_navbar_flat', array(
	// 	'section'    => 'uwmadison_colors_type',
	// 	'label' => 'Use “flat” menu style',
	// 	'type'       => 'checkbox',
	// 	'capability'        => 'edit_theme_options',
	// ) );

	$wp_customize->add_setting( 'uwmadison_use_official_uw_type', array(
		'default'           => $defaults['uwmadison_use_official_uw_type'],
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_use_official_uw_type' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_use_official_uw_type', array(
		'section'     => 'uwmadison_colors_type',
		'label'       => 'Use Verlag typeface',
		'description' => '<b>Note:</b> Verlag will not load unless your domain is authorized. (The theme defines fallback fonts to use in this case.) To use Verlag, <a href="mailto:web@umark.wisc.edu">email University Marketing</a> and request permission for your domain. ',
		'type'        => 'checkbox'
	) );

	$wp_customize->add_setting( 'uwmadison_type_production', array(
		'default'           => $defaults['uwmadison_type_production'],
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_type_production' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_type_production', array(
		'section'     => 'uwmadison_colors_type',
		'label'       => 'This is a production site',
		'description' => '<b>Note:</b> A different font file will be loaded for production sites.',
		'type'        => 'checkbox'
	) );

	// Add header settings and controls
	$wp_customize->add_setting( 'uwmadison_use_search', array(
		'default'           => $defaults['uwmadison_use_search'],
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_use_search' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_use_search', array(
		'section'    => 'uwmadison_header',
		'label'      => 'Include search input in header',
		'type'       => 'checkbox'
	) );

	// Add home page hero image
	$wp_customize->add_setting( 'uwmadison_home_hero_img', array(
		'sanitize_callback' => 'absint',
	) );
	// $wp_customize->get_setting( 'uwmadison_home_hero_img' )->transport = 'postMessage';
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'uwmadison_home_hero_img', array(
	  'label' => 'Set home page hero image',
	  'description' => 'Image should be at least 1600x500 pixels.',
	  'section' => 'uwmadison_header',
	  'mime_type' => 'image',
	) ) );

	// Add layout settings and controls
	$wp_customize->add_setting( 'uwmadison_theme_layout', array(
		'default'           => $defaults['uwmadison_theme_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_theme_layout' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_theme_layout', array(
		'section'    => 'uwmadison_layout',
		'type'       => 'radio',
		'choices'    => uwmadison_get_settings_choices( 'layouts' ),
	) );


	// add footer contact and social
	$wp_customize->add_setting( 'uwmadison_email', array(
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->get_setting( 'uwmadison_email' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_email', array(
		'section'    => 'uwmadison_footer',
		'label' => 'Contact email'
	) );

	$wp_customize->add_setting( 'uwmadison_phone', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->get_setting( 'uwmadison_phone' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_phone', array(
		'section'    => 'uwmadison_footer',
		'label' => 'Contact phone'
	) );

	$wp_customize->add_setting( 'uwmadison_social[facebook]', array(
		'sanitize_callback' => 'sanitize_url',
	) );
	$wp_customize->get_setting( 'uwmadison_social[facebook]' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_social[facebook]', array(
		'section'    => 'uwmadison_footer',
		'label' => 'Facebook URL'
	) );

	$wp_customize->add_setting( 'uwmadison_social[twitter]', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->get_setting( 'uwmadison_social[twitter]' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_social[twitter]', array(
		'section'    => 'uwmadison_footer',
		'label' => 'Twitter URL'
	) );

	$wp_customize->add_setting( 'uwmadison_social[instagram]', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->get_setting( 'uwmadison_social[instagram]' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_social[instagram]', array(
		'section'    => 'uwmadison_footer',
		'label' => 'Instagram URL'
	) );

	$wp_customize->add_setting( 'uwmadison_social[youtube]', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->get_setting( 'uwmadison_social[youtube]' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_social[youtube]', array(
		'section'    => 'uwmadison_footer',
		'label' => 'Youtube URL'
	) );

	$wp_customize->add_setting( 'uwmadison_social[linkedin]', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->get_setting( 'uwmadison_social[linkedin]' )->transport = 'postMessage';
	$wp_customize->add_control( 'uwmadison_social[linkedin]', array(
		'section'    => 'uwmadison_footer',
		'label' => 'LinkedIn URL'
	) );

	$wp_customize->add_setting( 'uwmadison_footer_menu_1', array(
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_footer_menu_1' )->transport = 'postMessage';
  $wp_customize->add_control( new Menu_Dropdown_Custom_Control( $wp_customize, 'uwmadison_footer_menu_1', array(
      'label'   => 'Footer Menu 1',
      'section' => 'uwmadison_footer',
      'settings'   => 'uwmadison_footer_menu_1',
      'priority' => 90
  ) ) );

	$wp_customize->add_setting( 'uwmadison_footer_menu_2', array(
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->get_setting( 'uwmadison_footer_menu_2' )->transport = 'postMessage';
  $wp_customize->add_control( new Menu_Dropdown_Custom_Control( $wp_customize, 'uwmadison_footer_menu_2', array(
      'label'   => 'Footer Menu 2',
      'section' => 'uwmadison_footer',
      'settings'   => 'uwmadison_footer_menu_2',
      'priority' => 100
  ) ) );
}
add_action( 'customize_register', 'uwmadison_customize_register' );


/**
 * Returns the default options for UW-Madison.
 *
 * @return Array default values for each setting
 * @since UW-Madison 1.0
 */
function uwmadison_get_default_theme_mods() {
	$default_theme_mods = array(
		'uwmadison_header_style' => 'uw-red-top-bar',
		// 'uwmadison_navbar_flat' => false,
		'uwmadison_theme_layout' => 'content-sidebar',
		'uwmadison_body_bg' => 'uw-white-bg',
		'uwmadison_use_search' => false,
		'uwmadison_use_official_uw_type' => false,
		'uwmadison_type_production' => false,
	);

	if ( is_rtl() )
 		$default_theme_mods['uwmadison_theme_layout'] = 'sidebar-content';

	return apply_filters( 'uwmadison_get_default_theme_mods', $default_theme_mods );
}


/**
 * Settings options array for uw-madison-160 theme settings
 *
 * @return Array The settings options array
 * @since UW-Madison 2.0
 **/
function uwmadison_setting_options() {

	$setting_options = array(
		'bgcolors' => array(
			'uw-white-bg' => array(
				'value' => 'uw-white-bg',
				'label' => __( 'White', 'uw-madison-160' )
			),
			'uw-light-gray-bg' => array(
				'value' => 'uw-light-gray-bg',
				'label' => __( 'Light gray', 'uw-madison-160' )
			),
		),

		'header_styles' => array(
			'uw-red-top-bar' => array(
				'value' => 'uw-red-top-bar',
				'label' => __( 'Red top bar, white main menu', 'uw-madison-160' )
			),
			'uw-white-top-bar' => array(
				'value' => 'uw-white-top-bar',
				'label' => __( 'White top bar, red main menu', 'uw-madison-160' )
			),
		),

		'layouts' => array(
			'content-sidebar' => array(
				'value' => 'content-sidebar',
				'label' => __( 'Content on left', 'uw-madison-160' )
			),
			'sidebar-content' => array(
				'value' => 'sidebar-content',
				'label' => __( 'Content on right', 'uw-madison-160' )
			),
			'content' => array(
				'value' => 'content',
				'label' => __( 'One-column, no sidebar', 'uw-madison-160' )
			),
		)
	);

	return apply_filters( 'uwmadison_setting_options', $setting_options );
}


/**
 * Return values and options for requested setting to be use in add_control()
 *
 * @param String $setting The key for the setting
 * @return Array Value and options for the setting
 * @since UW-Madison 2.0
 **/
function uwmadison_get_settings_choices( $setting ){
	$choices = array();
	$setting_options = uwmadison_setting_options();
	foreach ( $setting_options[$setting] as $option ) {
		$choices[$option['value']] = $option['label'];
	}
	return $choices;
}


/**
 * Print JS for customizer UI
 *
 * @return void
 * @since UW-Madison 2.0
 */
function uwmadison_customizer_js() {
	wp_enqueue_script( 'uwmadison-customizer-js', get_template_directory_uri() . '/inc/theme-customizer-ui.js', array( 'jquery' ), '20160224a', true );
}
add_action( 'customize_controls_print_footer_scripts', 'uwmadison_customizer_js' );


/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 * Used with blogname and blogdescription.
 *
 * @return void
 * @since UW-Madison 1.3
 */
function uwmadison_customize_preview_js() {
	wp_enqueue_script( 'uwmadison-customizer-preview', get_template_directory_uri() . '/inc/theme-customizer-preview.js', array( 'customize-preview' ), '20160224a', true );
}
add_action( 'customize_preview_init', 'uwmadison_customize_preview_js' );


/**
 * Load custom CSS for customizer UI layout option
 *
 * @return void
 **/
function uw_customizer_css() { ?>
	<style>
		#customize-control-uwmadison_theme_layout.customize-control-radio label {
		    margin-left: 0;
		    padding-left: 64px;
		}
		#customize-control-uwmadison_theme_layout label {
	    background: url(/content/themes/uw-madison-160/inc/images/content-sidebar.png) no-repeat left 3px;
	    background-size: 30px;
		}
		#customize-control-uwmadison_theme_layout label:nth-child(2) {
			background-image: url(/content/themes/uw-madison-160/inc/images/sidebar-content.png)
		}
		#customize-control-uwmadison_theme_layout label:nth-child(3) {
			background-image: url(/content/themes/uw-madison-160/inc/images/content.png)
		}
	</style>
<?php }
add_action('customize_controls_print_styles', 'uw_customizer_css');
