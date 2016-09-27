<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pho
 */

if (! function_exists( 'pho_paging_nav' ) ) :
/**
 * Determines if a post is featured and gets its thumbnail displayed as a large teaser
 */
function pho_is_featured_post() {
	$featured_tag = get_theme_mod('pho_featured_post_tag');
	if ('' == $featured_tag) {
		$featured_tag = 'featured';
	}
	return (has_tag($featured_tag));
}

endif;

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
	 * Filter the default attachment size.
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


if ( ! function_exists( 'pho_generate_calltrace' ) ) :
/**
 * Returns a nicely formatted stacktrace for debugging purposes
 */
function pho_generate_calltrace()
{
   $e = new \Exception();
   $trace = explode("\n", $e->getTraceAsString());
   // reverse array to make steps line up chronologically
   $trace = array_reverse($trace);
   array_shift($trace); // remove {main}
   array_pop($trace); // remove call to this method
   $length = count($trace);
   $result = array();

   for ($i = 0; $i < $length; $i++)
   {
	   $result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
   }

   return "\t" . implode("\n\t", $result);
}
endif;
