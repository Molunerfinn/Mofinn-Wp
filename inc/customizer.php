<?php
/**
 * EverBox Theme Customizer
 *
 * @package EverBox
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function everbox_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
    $wp_customize->add_section( 'everbox_general_section' , array(
        'title' => __( 'General', 'everbox' )
    ) );

    // Primary Color
    $wp_customize->add_setting( 'everbox_primary_color',
        array(
            'default' => '', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'everbox_sanitize_hex_color'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_primary_color', //Set a unique ID for the control
        array(
            'label' => __( 'Primary Color', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_general_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_primary_color', //Which setting to load and manipulate (serialized is okay)
        ) 
    ) );

    // Post excerpt length
    $wp_customize->add_setting( 'everbox_excerpt_length',
        array(
            'default' => 60, //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'everbox_sanitize_integer'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_excerpt_length', //Set a unique ID for the control
        array(
            'label' => __( 'Post excerpt length', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_general_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_excerpt_length', //Which setting to load and manipulate (serialized is okay)
            'type' => 'number'
        ) 
    ) );

    // Cagetory link
    $wp_customize->add_setting( 'everbox_category_link',
        array(
            'default' => 1, //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'everbox_sanitize_bool'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_category_link', //Set a unique ID for the control
        array(
            'label' => __( 'Show cagetory link', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_general_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_category_link', //Which setting to load and manipulate (serialized is okay)
            'type' => 'checkbox'
        ) 
    ) );

    // Infinite loading
    $wp_customize->add_setting( 'everbox_infinite',
        array(
            'default' => 0, //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'everbox_sanitize_bool'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_infinite', //Set a unique ID for the control
        array(
            'label' => __( 'Infinite Pagination with jetpack', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_general_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_infinite', //Which setting to load and manipulate (serialized is okay)
            'type' => 'checkbox'
        ) 
    ) );

    // Credit
    $wp_customize->add_setting( 'everbox_credit',
        array(
            'default' => 1, //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'everbox_sanitize_bool'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_credit', //Set a unique ID for the control
        array(
            'label' => __( 'Footer Credit', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_general_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_credit', //Which setting to load and manipulate (serialized is okay)
            'type' => 'checkbox'
        ) 
    ) );


   $wp_customize->add_section( 'everbox_icons_section' , array(
        'title'      => __( 'ICONS', 'everbox' )
    ) );

    // LOGO
    $wp_customize->add_setting( 'everbox_logo',
        array(
            'default' => '', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'esc_url_raw'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_logo', //Set a unique ID for the control
        array(
            'label' => __( 'LOGO', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_icons_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_logo', //Which setting to load and manipulate (serialized is okay)
        ) 
    ) );

    // favicon
    $wp_customize->add_setting( 'everbox_favicon',
        array(
            'default' => '', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'esc_url_raw'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_favicon', //Set a unique ID for the control
        array(
            'label' => __( 'Favicon', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_icons_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_favicon', //Which setting to load and manipulate (serialized is okay)
        ) 
    ) );

    // iPhone App icon
    $wp_customize->add_setting( 'everbox_app',
        array(
            'default' => '', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'esc_url_raw'
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'everbox_app', //Set a unique ID for the control
        array(
            'label' => __( 'iPhone Retina icon (sizes:120x120)', 'everbox' ), //Admin-visible name of the control
            'section' => 'everbox_icons_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'everbox_app', //Which setting to load and manipulate (serialized is okay)
        ) 
    ) );
}
add_action( 'customize_register', 'everbox_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function everbox_customize_preview_js() {
    wp_enqueue_script( 'everbox_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'everbox_customize_preview_js' );

/**
 * Adjusting color
 * @param  [type] $hex   color need to be adjusted
 * @param  [type] $steps adjust by step
 * @return [type]        hex color
 */
function everbox_adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

function everbox_custom_head() {
	
    $primary_color = get_theme_mod( 'everbox_primary_color', '' );
	$favicon_url   = get_theme_mod('everbox_favicon', '');
	$iphone_icon   = get_theme_mod('everbox_app', '');
?>
	<!--[if lt IE 9]>
    <script src="<?php echo EVERBOX_URL . '/js/' ?>html5shiv-printshiv.js"></script>
  	<![endif]-->
	<!-- Set the viewport. -->
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- Allow web app to be run in full-screen mode. -->
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<!-- Make the app title different than the page title. -->
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	 <!-- Configure the status bar. -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<!-- Disable automatic phone number detection. -->
	<meta name="format-detection" content="telephone=no">

	<!-- ICONS -->
    <?php if(!empty($favicon_url)) : ?>
	<link href="<?php echo esc_url( $favicon_url ); ?>" rel="icon">
    <?php endif; ?>
   	<?php if(!empty($iphone_icon)) : ?>
    <!-- iPhone 5/6 icon -->
    <link href="<?php echo esc_url( $iphone_icon ); ?>" sizes="120x120" rel="apple-touch-icon-precomposed">
   	<?php endif; ?>

    <?php if(!empty($primary_color)) : ?>
    <style type="text/css">
        a {
            color: <?php echo esc_textarea($primary_color) ?>;
        }
        #secondary .secondary-toggle { 
            background-color: <?php echo esc_textarea($primary_color) ?>; 
        }
        a:hover {
            color: <?php echo everbox_adjustBrightness($primary_color, -25); ?>;
        }
        .archive-header .archive-title, 
        .search-header .search-title {
            border-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .post-meta.category-links a:hover {
            background-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .post-meta a:hover {
            color: <?php echo esc_textarea($primary_color) ?>;
        }
        .post-meta .author {
            color: <?php echo esc_textarea($primary_color) ?>;
        }
        .pagination .current {
            background-color: <?php echo esc_textarea($primary_color) ?>;
            border-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .comments-area .comment-header .comment-title {
            border-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .comments-list li .comment-body .comment-heading .comment-reply-link:hover {
            color: <?php echo esc_textarea($primary_color) ?>;
        }
        .comments-list li .comment-body .comment-byauthor {
            background: <?php echo esc_textarea($primary_color) ?> !important;
        }
        .filter-button.active {
            color: <?php echo esc_textarea($primary_color) ?>;
        }
        .filter-button.active a {
            color: <?php echo esc_textarea($primary_color) ?>;
        }
        .widget .widget-head .widgettitle, 
        .widget .widget-head .widget-title {
            border-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .tagcloud a:hover, .page-tags a:hover {
            background-color: <?php echo esc_textarea($primary_color) ?>;
            border-color: <?php echo esc_textarea($primary_color) ?>;
        }
        #wp-calendar tbody td a {
            background: <?php echo esc_textarea($primary_color) ?>;
        }
        #wp-calendar tbody td:hover a {
            background: <?php echo everbox_adjustBrightness($primary_color, 15); ?>;
        }
        #wp-calendar caption {
            background: <?php echo esc_textarea($primary_color) ?>;
        }
        .link-pages > span {
            background-color: <?php echo esc_textarea($primary_color) ?>;
            border-color: <?php echo esc_textarea($primary_color) ?>; 
        }
        .link-pages > span:hover {
            background-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .pagination .current {
            background-color: <?php echo esc_textarea($primary_color) ?>;
            border-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .pagination .current:hover {
            background-color: <?php echo esc_textarea($primary_color) ?>;
        }
        .site-header {
            background: <?php echo esc_textarea($primary_color) ?>;
            border-bottom: 1px solid <?php echo everbox_adjustBrightness($primary_color, -15); ?>;
        }
        div.main-nav > ul ul.sub-menu, 
        div.main-nav > ul ul.children,
        ul.main-nav ul.sub-menu,
        ul.main-nav ul.children {
            background: <?php echo everbox_adjustBrightness($primary_color, -15); ?>;
        }
        .mobile-menu-container, 
        .mobile-search-container {
            background: <?php echo everbox_adjustBrightness($primary_color, -20); ?>;
        }
        .site-search-area .searchform #s {
            border: 1px solid <?php echo everbox_adjustBrightness($primary_color, -20); ?>;
        }
        @media (device-width: 375px) and (height: 667px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2) {
            .site-header {
              background: <?php echo esc_textarea($primary_color) ?>;
              background-image: none;
            }
            .mobile-menu-container, .mobile-search-container {
              background: <?php echo everbox_adjustBrightness($primary_color, -15); ?>;
            }
        }
    </style>
    <?php endif; ?>
<?php
}
add_action('wp_head', 'everbox_custom_head');