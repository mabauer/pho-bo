<?php
/**
 * pho Theme Customizer
 *
 * @package pho
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pho_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'pho_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pho_customize_preview_js() {
	wp_enqueue_script( 'pho_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pho_customize_preview_js' );

/**
 * Add custom heading background color and site-wide link color
 */

function pho_register_theme_customizer( $wp_customize ) {

    $wp_customize->add_setting(
        'pho_header_color',
        array(
            'default'     => '#0587BF',
            'sanitize_callback'    => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_color',
            array(
                'label'      => __( 'Header Color', 'pho' ),
                'section'    => 'colors',
                'settings'   => 'pho_header_color'
            )
        )
    );

    $wp_customize->add_setting(
        'pho_link_color',
        array(
            'default'     => '#000000',
            'sanitize_callback'    => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color',
            array(
                'label'      => __( 'Link Color', 'pho' ),
                'section'    => 'colors',
                'settings'   => 'pho_link_color'
            )
        )
    );
    
    // Add option to select sidebar position in the theme
    $wp_customize->add_section(
	// ID
	'option_section',
	// Arguments array
	array(
            'title' => __( 'Theme Options', 'pho' ),
            'capability' => 'edit_theme_options',
            'description' => __( 'Change the default display options for the theme.', 'pho' )
        )
    );
    
    // Sidebar layout
    
    $wp_customize->add_setting(
        // ID
        'layout_setting',
        // Arguments array
        array(
            'default' => 'right-sidebar',
            'type' => 'option',
            'sanitize_callback' => 'pho_sanitize_layout'
        )
    );
    $wp_customize->add_control(
	// ID
	'layout_control',
	// Arguments array
	array(
            'type' => 'radio',
            'label' => __( 'Sidebar position', 'pho' ),
            'section' => 'option_section',
            'choices' => array(
                'left-sidebar' => __( 'Left sidebar', 'pho' ),
                'right-sidebar' => __( 'Right sidebar', 'pho' )
            ),
            // This last one must match setting ID from above
            'settings' => 'layout_setting'
        )
    );
    
    // Archive content display
    $wp_customize->add_setting(
        // ID
        'archive_setting',
        // Arguments array
        array(
            'default' => 'excerpt',
            'type' => 'option',
            'sanitize_callback' => 'pho_sanitize_archive'
        )
    );
    $wp_customize->add_control(
	// ID
	'archive_control',
	// Arguments array
	array(
            'type' => 'radio',
            'label' => __( 'Archive display', 'pho' ),
            'description' => __( 'Display excerpts or full content with optional "More" tag in the blog index and archive pages.', 'pho' ),
            'section' => 'option_section',
            'choices' => array(
                'excerpt' => __( 'Excerpt', 'pho' ),
                'content' => __( 'Full content', 'pho' )
            ),
            // This last one must match setting ID from above
            'settings' => 'archive_setting'
        )
    );

}
add_action( 'customize_register', 'pho_register_theme_customizer' );

// Sanitize sidebar layout
function pho_sanitize_layout( $value ) {
    if ( ! in_array( $value, array( 'left-sidebar', 'right-content' ) ) )
        $value = 'right-sidebar';
 
    return $value;
}

// Sanitize archive display
function pho_sanitize_archive( $value ) {
    if ( ! in_array( $value, array( 'excerpt', 'content' ) ) )
        $value = 'excerpt';
 
    return $value;
}

function pho_customizer_css() {
    ?>
    <style type="text/css">
        .site-branding {
            background: <?php echo get_theme_mod( 'pho_header_color' ); ?>;
        }

        .category-list a:hover,
        .entry-meta a:hover,
        .tag-links a:hover,
        .widget-area a:hover,
        .nav-links a:hover,
        .comment-meta a:hover,
        .continue-reading a,
        .entry-title a:hover,
        .entry-content a,
        .comment-content a {
            color: <?php echo get_theme_mod( 'pho_link_color' ); ?>;
        }

        .border-custom {
            border: <?php echo get_theme_mod( 'pho_link_color' ); ?> solid 1px;
        }

    </style>
    <?php
}
add_action( 'wp_head', 'pho_customizer_css' );
