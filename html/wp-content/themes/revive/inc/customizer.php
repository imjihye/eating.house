<?php
/**
 * revive Theme Customizer
 *
 * @package revive
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function revive_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'revive' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'revive_logo' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'revive_logo',
	        array(
	            'label' => __('Upload Logo','revive'),
	            'section' => 'title_tagline',
	            'settings' => 'revive_logo',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'revive_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'revive_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'revive_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','revive'),
	            'section' => 'title_tagline',
	            'settings' => 'revive_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'revive_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function revive_logo_enabled($control) {
		$option = $control->manager->get_setting('revive_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override revive_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('revive_site_titlecolor', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'revive_site_titlecolor', array(
			'label' => __('Site Title Color','revive'),
			'section' => 'colors',
			'settings' => 'revive_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('revive_header_desccolor', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'revive_header_desccolor', array(
			'label' => __('Site Tagline Color','revive'),
			'section' => 'colors',
			'settings' => 'revive_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings for Nav Area
	$wp_customize->add_setting( 'revive_disable_active_nav' , array(
	    'default'     => true,
	    'sanitize_callback' => 'revive_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'revive_disable_active_nav', array(
		'label' => __('Disable Highlighting of Current Active Item on the Menu.','revive'),
		'section' => 'nav',
		'settings' => 'revive_disable_active_nav',
		'type' => 'checkbox'
	) );
	
	//Settings for Header Image
	$wp_customize->add_setting( 'revive_himg_style' , array(
	    'default'     => true,
	    'sanitize_callback' => 'revive_sanitize_himg_style'
	) );
	
	/* Sanitization Function */
	function revive_sanitize_himg_style( $input ) {
		if (in_array( $input, array('contain','cover') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'revive_himg_style', array(
		'label' => __('Header Image Arrangement','revive'),
		'section' => 'header_image',
		'settings' => 'revive_himg_style',
		'type' => 'select',
		'choices' => array(
				'contain' => __('Contain','revive'),
				'cover' => __('Cover Completely','revive'),
				)
	) );
	
	$wp_customize->add_setting( 'revive_himg_align' , array(
	    'default'     => true,
	    'sanitize_callback' => 'revive_sanitize_himg_align'
	) );
	
	/* Sanitization Function */
	function revive_sanitize_himg_align( $input ) {
		if (in_array( $input, array('center','left','right') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'revive_himg_align', array(
		'label' => __('Header Image Alignment','revive'),
		'section' => 'header_image',
		'settings' => 'revive_himg_align',
		'type' => 'select',
		'choices' => array(
				'center' => __('Center','revive'),
				'left' => __('Left','revive'),
				'right' => __('Right','revive'),
			)
		
	) );
	
	$wp_customize->add_setting( 'revive_himg_repeat' , array(
	    'default'     => true,
	    'sanitize_callback' => 'revive_sanitize_checkbox'
	) );
	
	$wp_customize->add_control(
	'revive_himg_repeat', array(
		'label' => __('Repeat Header Image','revive'),
		'section' => 'header_image',
		'settings' => 'revive_himg_repeat',
		'type' => 'checkbox',
	) );
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'revive_hide_title_tagline',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_hide_title_tagline', array(
		    'settings' => 'revive_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'revive' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'revive_branding_below_logo',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_branding_below_logo', array(
		    'settings' => 'revive_branding_below_logo',
		    'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'revive' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		    'active_callback' => 'revive_title_visible'
		)
	);
	
	function revive_title_visible( $control ) {
		$option = $control->manager->get_setting('revive_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	$wp_customize->add_setting(
		'revive_center_logo',
		array( 
			'sanitize_callback' => 'revive_sanitize_checkbox',
			'default' => true )
	);
	
	$wp_customize->add_control(
			'revive_center_logo', array(
		    'settings' => 'revive_center_logo',
		    'label'    => __( 'Center Align.', 'revive' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	
	
	// SLIDER PANEL
	$wp_customize->add_panel( 'revive_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Main Slider','revive'),
	) );
	
	$wp_customize->add_section(
	    'revive_sec_slider_options',
	    array(
	        'title'     => __('Enable/Disable','revive'),
	        'priority'  => 0,
	        'panel'     => 'revive_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'revive_main_slider_enable',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_main_slider_enable', array(
		    'settings' => 'revive_main_slider_enable',
		    'label'    => __( 'Enable Slider.', 'revive' ),
		    'section'  => 'revive_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'revive_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'revive_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'revive_main_slider_count', array(
		    'settings' => 'revive_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 3)' ,'revive'),
		    'section'  => 'revive_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','revive'),
		    
		)
	);
	
	
	$wp_customize->add_section(
	    'revive_sec_upgrade',
	    array(
	        'title'     => __('Discover Revive Pro','revive'),
	        'priority'  => 45,
	    )
	);
	
	$wp_customize->add_setting(
			'revive_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'revive_upgrade',
	        array(
	            'label' => __('More of Everything','revive'),
	            'description' => __('Revive Pro has more of Everything. More New Features, More Options, Unlimited Slides, More Colors, More Fonts, More Layouts, Configurable Slider, Inbuilt Advertising Options, Multiple Skins, More Widgets, and a lot more options and comes with Dedicated Support. To Know More about the Pro Version, click here: <a href="http://inkhive.com/product/revive-pro/">Upgrade to Pro</a>.','revive'),
	            'section' => 'revive_sec_upgrade',
	            'settings' => 'revive_upgrade',			       
	        )
		)
	);
		
	
	if ( get_theme_mod('revive_main_slider_count') > 0 ) :
		$slides = get_theme_mod('revive_main_slider_count');
		
		for ( $i = 1 ; $i <= $slides ; $i++ ) :
			//Create the settings Once, and Loop through it.
			if ($i >= 4) {
				break;
			}
			$wp_customize->add_setting(
				'revive_slide_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'revive_slide_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'revive_slide_sec'.$i,
			            'settings' => 'revive_slide_img'.$i,			       
			        )
				)
			);
			
			
			$wp_customize->add_section(
			    'revive_slide_sec'.$i,
			    array(
			        'title'     => __('Slide ','revive').$i,
			        'priority'  => $i,
			        'panel'     => 'revive_slider_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'revive_slide_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'revive_slide_title'.$i, array(
				    'settings' => 'revive_slide_title'.$i,
				    'label'    => __( 'Slide Title','revive' ),
				    'section'  => 'revive_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'revive_slide_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'revive_slide_desc'.$i, array(
				    'settings' => 'revive_slide_desc'.$i,
				    'label'    => __( 'Slide Description','revive' ),
				    'section'  => 'revive_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			
			$wp_customize->add_setting(
				'revive_slide_CTA_button'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'revive_slide_CTA_button'.$i, array(
				    'settings' => 'revive_slide_CTA_button'.$i,
				    'label'    => __( 'Custom Call to Action Button Text(Optional)','revive' ),
				    'section'  => 'revive_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'revive_slide_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'revive_slide_url'.$i, array(
				    'settings' => 'revive_slide_url'.$i,
				    'label'    => __( 'Target URL','revive' ),
				    'section'  => 'revive_slide_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	
	endif;
	
	

	
	// CREATE THE FCA PANEL
	$wp_customize->add_panel( 'revive_fca_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Featured Content Areas','revive'),
	    'description'    => '',
	) );
	
	
	//FEATURED AREA 1
	$wp_customize->add_section(
	    'revive_fc_boxes',
	    array(
	        'title'     => __('Featured Area 1','revive'),
	        'priority'  => 10,
	        'panel'     => 'revive_fca_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'revive_box_enable',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_box_enable', array(
		    'settings' => 'revive_box_enable',
		    'label'    => __( 'Enable Featured Area 1.', 'revive' ),
		    'section'  => 'revive_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'revive_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'revive_box_title', array(
		    'settings' => 'revive_box_title',
		    'label'    => __( 'Title for the Boxes','revive' ),
		    'section'  => 'revive_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'revive_box_cat',
	    array( 'sanitize_callback' => 'revive_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Revive_WP_Customize_Category_Control(
	        $wp_customize,
	        'revive_box_cat',
	        array(
	            'label'    => __('Category For Square Boxes.','revive'),
	            'settings' => 'revive_box_cat',
	            'section'  => 'revive_fc_boxes'
	        )
	    )
	);
	
	//FEATURED AREA 2
	$wp_customize->add_section(
	    'revive_fc_fa2',
	    array(
	        'title'     => __('Featured Area 2','revive'),
	        'priority'  => 10,
	        'panel'     => 'revive_fca_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'revive_fa2_enable',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_fa2_enable', array(
		    'settings' => 'revive_fa2_enable',
		    'label'    => __( 'Enable Featured Area 2.', 'revive' ),
		    'section'  => 'revive_fc_fa2',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'revive_fa2_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'revive_fa2_title', array(
		    'settings' => 'revive_fa2_title',
		    'label'    => __( 'Title for the Featured Area 2','revive' ),
		    'section'  => 'revive_fc_fa2',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'revive_fa2_cat',
	    array( 'sanitize_callback' => 'revive_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Revive_WP_Customize_Category_Control(
	        $wp_customize,
	        'revive_fa2_cat',
	        array(
	            'label'    => __('Category For Featured Area 2.','revive'),
	            'settings' => 'revive_fa2_cat',
	            'section'  => 'revive_fc_fa2'
	        )
	    )
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'revive_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','revive'),
	) );
	
	$wp_customize->add_section(
	    'revive_design_options',
	    array(
	        'title'     => __('Blog Layout','revive'),
	        'priority'  => 0,
	        'panel'     => 'revive_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'revive_blog_layout',
		array( 'sanitize_callback' => 'revive_sanitize_blog_layout' )
	);
	
	function revive_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','grid_3_column','revive') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'revive_blog_layout',array(
				'label' => __('Select Layout','revive'),
				'settings' => 'revive_blog_layout',
				'section'  => 'revive_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Basic Blog Layout','revive'),
						'revive' => __('Revive Default Layout','revive'),
						'grid_2_column' => __('Grid - 2 Column','revive'),
						'grid_3_column' => __('Grid - 3 Column','revive'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'revive_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','revive'),
	        'priority'  => 0,
	        'panel'     => 'revive_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'revive_disable_sidebar',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_disable_sidebar', array(
		    'settings' => 'revive_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','revive' ),
		    'section'  => 'revive_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'revive_disable_sidebar_home',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_disable_sidebar_home', array(
		    'settings' => 'revive_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','revive' ),
		    'section'  => 'revive_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'revive_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'revive_disable_sidebar_front',
		array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'revive_disable_sidebar_front', array(
		    'settings' => 'revive_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','revive' ),
		    'section'  => 'revive_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'revive_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'revive_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'revive_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'revive_sidebar_width', array(
		    'settings' => 'revive_sidebar_width',
		    'label'    => __( 'Sidebar Width','revive' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','revive'),
		    'section'  => 'revive_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'revive_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function revive_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('revive_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Revive_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'revive_custom_codes',
    array(
    	'title'			=> __('Custom CSS','revive'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','revive'),
    	'priority'		=> 11,
    	'panel'			=> 'revive_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'revive_custom_css',
	array(
		'default'		=> '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
	    new Revive_Custom_CSS_Control(
	        $wp_customize,
	        'revive_custom_css',
	        array(
	            'section' => 'revive_custom_codes',
	            'settings' => 'revive_custom_css'
	        )
	    )
	);
	
	function revive_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'revive_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','revive'),
    	'description'	=> __('Enter your Own Copyright Text.','revive'),
    	'priority'		=> 11,
    	'panel'			=> 'revive_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'revive_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'revive_footer_text',
	        array(
	            'section' => 'revive_custom_footer',
	            'settings' => 'revive_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'revive_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','revive'),
	        'priority'  => 41,
	    )
	);
	
	$font_array = array('Lato','Khula','Open Sans','Droid Sans','Droid Serif','Roboto Condensed','Bree Serif','Oswald','Slabo','Lora');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'revive_title_font',
		array(
			'default'=> 'Lato',
			'sanitize_callback' => 'revive_sanitize_gfont' 
			)
	);
	
	function revive_sanitize_gfont( $input ) {
		if ( in_array($input, array('Lato','Khula','Open Sans','Droid Sans','Droid Serif','Roboto Condensed','Bree Serif','Oswald','Slabo','Lora') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'revive_title_font',array(
				'label' => __('Title','revive'),
				'settings' => 'revive_title_font',
				'section'  => 'revive_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'revive_body_font',
			array(	'default'=> 'Lato',
					'sanitize_callback' => 'revive_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'revive_body_font',array(
				'label' => __('Body','revive'),
				'settings' => 'revive_body_font',
				'section'  => 'revive_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('revive_social_section', array(
			'title' => __('Social Icons','revive'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','revive'),
					'facebook' => __('Facebook','revive'),
					'twitter' => __('Twitter','revive'),
					'google-plus' => __('Google Plus','revive'),
					'instagram' => __('Instagram','revive'),
					'rss' => __('RSS Feeds','revive'),
					'vine' => __('Vine','revive'),
					'vimeo-square' => __('Vimeo','revive'),
					'youtube' => __('Youtube','revive'),
					'flickr' => __('Flickr','revive'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'revive_social_'.$x, array(
				'sanitize_callback' => 'revive_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'revive_social_'.$x, array(
					'settings' => 'revive_social_'.$x,
					'label' => __('Icon ','revive').$x,
					'section' => 'revive_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'revive_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'revive_social_url'.$x, array(
					'settings' => 'revive_social_url'.$x,
					'description' => __('Icon ','revive').$x.__(' Url','revive'),
					'section' => 'revive_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function revive_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function revive_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function revive_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function revive_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'revive_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function revive_customize_preview_js() {
	wp_enqueue_script( 'revive_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'revive_customize_preview_js' );
