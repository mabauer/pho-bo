<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pho
 */

if ( ! function_exists( 'pho_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function pho_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 2,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'pho' ),
		'next_text' => __( 'Next &rarr;', 'pho' ),
                'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'pho' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'pho_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function pho_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
            <div class="post-nav-box clear">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'pho' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . __( 'Previous Post:', 'pho' ) . '</div><h1>%link</h1></div>', '%title' );
				next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . __( 'Next Post:', 'pho' ) . '</div><h1>%link</h1></div>', '%title' );
			?>
		</div><!-- .nav-links -->
            </div><!-- .post-nav-box -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pho_attachment_nav' ) ) :
/**
 * Display navigation to next/previous image in attachment pages.
 */
function pho_attachment_nav() {

	?>
	<nav class="navigation post-navigation" role="navigation">
            <div class="post-nav-box clear">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'pho' ); ?></h1>
		<div class="nav-links">
                    <?php
                        previous_image_link( false, '<div class="nav-previous"><h1>' . __( 'Previous Image', 'pho' ) . '</h1></div>' ); 
                        next_image_link( false, '<div class="nav-next"><h1>' . __( 'Next Image', 'pho' ) . '</h1></div>' );
                    ?>
		</div><!-- .nav-links -->
            </div><!-- .post-nav-box -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pho_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pho_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( _x('F jS, Y', 'Public posted on date', 'pho') ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date( _x('F jS, Y', 'Public modified on date', 'pho') ) )
	);
        // Translators: Text wrapped in mobile-hide class is hidden on wider screens.
	printf( _x( '<span class="byline">by %1$s</span><span class="mobile-hide"> on </span><span class="posted-on">%2$s</span><span class="mobile-hide">.</span>', 'mobile-hide class is used to hide connecting elements like "on" and "." on wider screens.', 'pho' ),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		),
                sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function pho_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pho_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pho_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pho_categorized_blog.
 */
function pho_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'pho_category_transient_flusher' );
add_action( 'save_post',     'pho_category_transient_flusher' );


/**
 * Capture the custom background color and pass it to the background of featured images on single pages
 */

function pho_background_style() {
    if ( is_single() && has_post_thumbnail() ) {
        $background_color = get_background_color();
        
        echo '<style type="text/css">';
        echo '.single-post-thumbnail { background-color: #' . $background_color . '; }';
        echo '</style>';
        
    }
}
add_action('wp_head', 'pho_background_style');

if ( ! function_exists( 'pho_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * Appropriated from Twenty Fourteen 1.0
 */
function pho_the_attached_image() {
	$post = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 */
	$attachment_size = apply_filters( 'pho_attachment_size', array( 880, 9999 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;


/**
 * Function for responsive featured images.
 * Creates a <picture> tag and populate it with appropriate image sizes for different screen widths.
 * Works in place of the_post_thumbnail();
 */
function pho_the_responsive_thumbnail($post_id) {
    
    // Check to see if there is a transient available. If there is, use it.
    // if ( false === ( $thumb_data = get_transient( 'featured_image_' . $post_id ) ) ) {
        pho_set_image_transient($post_id);  
        $thumb_data = get_transient( 'featured_image_' . $post_id );
    // }
    
    echo '<picture>';
    echo '<!--[if IE 9]><video style="display: none;"><![endif]-->';
    // Large thumb not needed right now.
    // echo '<source media="(min-width: 880px)" srcset="' . $thumb_data['thumb_large'][0] . ' ' . $thumb_data['thumb_large'][1] . 'w" >';
    echo '<source media="(min-width: 440px)" srcset="' . $thumb_data['thumb_medium'][0] . ' ' . $thumb_data['thumb_medium'][1] . 'w, '
    		. $thumb_data['thumb_original'][0] . ' 2x " >'; 
    echo '<source srcset="' . $thumb_data['thumb_small'][0]  . ' ' . $thumb_data['thumb_small'][1] . 'w ,' 
    		. $thumb_data['thumb_medium'][0] . ' ' . $thumb_data['thumb_medium'][1] . 'w 2x " >'; 
    echo '<!--[if IE 9]></video><![endif]-->';
    echo '<img src="' . $thumb_data['thumb_medium'][0] . '" width="' . $thumb_data['thumb_medium'][1] . '" height="' . $thumb_data['thumb_medium'][2] . ' alt="' . $thumb_data['thumb_alt'] . '">';
    echo '</picture>';
}

/**
 * Create image transient to avoid looping through multiple image queries every time a post loads
 * Called any time a post is saved or updated right after existing transient is flushed.
 * Called by pho_the_responsive_thumbnail when no transient is set.
 * 
 * - Get the featured image ID
 * - Get the alt text (if no alt text is defined, set the alt text to the post title)
 * - Build an array with each of the available image sizes + the alt text
 * - Set a transient with the label "featured_image_[post_id] that expires in 12 months
 */
function pho_set_image_transient($post_id) {
    $attachment_id = get_post_thumbnail_id($post_id);
    $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    if ( !$alt_text ) { $alt_text = esc_html( get_the_title($post_id) ); }

    $thumb_original = wp_get_attachment_image_src($attachment_id, 'full');
    // $thumb_large    = wp_get_attachment_image_src($attachment_id, 'large-thumb');
    $thumb_medium   = wp_get_attachment_image_src($attachment_id, 'medium-thumb');
    $thumb_small    = wp_get_attachment_image_src($attachment_id, 'small-thumb');
        
    $thumb_data = array(
        'thumb_original' => $thumb_original,
        // 'thumb_large'    => $thumb_large,
        'thumb_medium'   => $thumb_medium,
        'thumb_small'    => $thumb_small,
        'thumb_alt'      => $alt_text
    );

    set_transient( 'featured_image_' . $post_id, $thumb_data, 52 * WEEK_IN_SECONDS );
}

/**
 * Reset featured image transient when the post is updated
 */
add_action('save_post', 'pho_reset_thumb_data_transient');

function pho_reset_thumb_data_transient( $post_id ) {
    delete_transient( 'featured_image_' . $post_id );
    if ( has_post_thumbnail($post_id) ) {
        pho_set_image_transient($post_id);
    }
}