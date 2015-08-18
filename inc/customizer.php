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



function pho_register_theme_customizer( $wp_customize ) {

   /**
    * Add site-wide link color
    */
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
    
	/**
	 * Class to create a custom tags control
	 */
	class Tags_Dropdown_Custom_Control extends WP_Customize_Control
	{
	
		public $type = 'select';
		
		private $tags = false;

		public function __construct($manager, $id, $args = array(), $options = array())
		{
			$this->tags = get_tags($options);

			parent::__construct( $manager, $id, $args );
		}

		/**
		* Render the content on the theme customizer page
		*/
		public function render_content()
		{
			if(empty($this->tags))
			{
				return false;
			}
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<span class="description customize-control-description"> <?php echo esc_html( $this->description ); ?></span>
					<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" <?php $this->link(); ?>>
					<?php
						foreach ( $this->tags as $tag )
						{
							printf('<option value="%s" %s>%s</option>',
								$tag->name,
								selected($this->value(), $tag->term_id, false),
								$tag->name);
						}
					?>
					</select>
					
				</label>
			<?php
		}
	}

    
    /* 
     * Additional theme options: 
     * 	- separators/lines between posts	
     *  - archive display with excerpts
     *  - determine tag to identify teaser images
     *
     */
    $wp_customize->add_section(
	'option_section',
	// Arguments array
	array(
            'title' => __( 'Theme Options', 'pho' ),
            'capability' => 'edit_theme_options',
            'description' => __( 'Change the default display options for the theme.', 'pho' )
        )
    );
    
     // Archive content display
    $wp_customize->add_setting(
        'archive_setting',
        array(
            'default' => 'excerpt',
            'type' => 'option',
            'sanitize_callback' => 'pho_sanitize_archive'
        )
    );
    
    $wp_customize->add_control(
	'archive_control',
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

	// Post separators        
    $wp_customize->add_setting(
        'pho_show_post_separators',
        array( 
			'default' => 1 
		)
    );

    $wp_customize->add_control(
        'pho_show_post_separators',
		array(
            'type' => 'checkbox',
            'label' => __( 'Show separators between posts', 'pho' ),
            'description' => __( 'Display separators between posts on blog index and archive pages -- recommended when the background is white', 'pho' ),
            'section' => 'option_section'
        )
    );

    // Tag for posts with teasers        
    $wp_customize->add_setting(
        'pho_featured_post_tag',
        array( 
			'default' => 'featured' 
		)
    );

    $wp_customize->add_control(
		 new Tags_Dropdown_Custom_Control(
            $wp_customize,
            'pho_featured_post_tag',
            array(
                'label'      => __( 'Tag for featured posts', 'pho' ),
                'description' => __( 'Tag to identify featured posts (which are displayed with large teaser images).', 'pho' ),
                'section'    => 'option_section',
                'settings' => 'pho_featured_post_tag'
            )
        )
    );

}
add_action( 'customize_register', 'pho_register_theme_customizer' );

// Sanitize archive display
function pho_sanitize_archive( $value ) {
    if ( ! in_array( $value, array( 'excerpt', 'content' ) ) )
        $value = 'excerpt';
 
    return $value;
}

function pho_customizer_css() {
    ?>
    	<style type="text/css">
 
        .nav-links a,
        .nav-links h1,
        .continue-reading a,
        .entry-content a,
        .edit-link a,
        .comments-link a,
        .comment-content a {
            color: <?php echo get_theme_mod( 'pho_link_color' ); ?>;
        }

        .border-custom {
            border: <?php echo get_theme_mod( 'pho_link_color' ); ?> solid 1px;
        }

    </style>
    
    <?php
    	/*
    	.category-list a,
        .tag-list a,
        .tag-list .fa {
	        color: <?php echo get_theme_mod( 'pho_link_color' ); ?>;
    	    }
 		*/
    
}
add_action( 'wp_head', 'pho_customizer_css' );
