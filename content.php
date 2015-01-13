<?php
/**
 * @package pho
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">
	<header class="entry-header clear">
            <?php

                // Display a thumb tack in the top right hand corner if this post is sticky
                if (is_sticky()) {
                    echo '<i class="fa fa-thumb-tack sticky-post"></i>';
                }

                /* translators: used between list items, there is a space after the comma */
                $category_list = get_the_category_list( __( ', ', 'pho' ) );

                if ( pho_categorized_blog() ) {
                    echo '<div class="category-list">' . $category_list . '</div>';
                }
            ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php pho_posted_on(); ?>
                        <?php
                        if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
                            echo '<span class="comments-link">';
                            comments_popup_link( __( 'Leave a comment', 'pho' ), __( '1 Comment', 'pho' ), __( '% Comments', 'pho' ) );
                            echo '</span>';
                        }
                        ?>
                        <?php edit_post_link( sprintf( ' | %s', __( 'Edit', 'pho' ) ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		
		<?php
			if (has_post_thumbnail()) {
				echo '<div class="thumbnail-box clear">';
				echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'pho') . get_the_title() . '" rel="bookmark">';
				pho_the_responsive_thumbnail( get_the_ID() );
				echo '</a>';
				echo '</div>';
			}
		?>

	</header><!-- .entry-header -->

        <?php
        if( $wp_query->current_post == 0 && !is_paged() && is_front_page() ) {
            echo '<div class="entry-content">';
            the_content( __( '', 'pho' ) );
            echo '</div>';
            echo '<footer class="entry-footer continue-reading">';
            echo '<a href="' . get_permalink() . '" title="' . _x('Read ', 'First part of "Read *article title* in title tag of Read more link', 'pho') . get_the_title() . '" rel="bookmark">' . __('Read <span aria-hidden="true">the article</span>', 'pho') . '<i class="fa fa-arrow-circle-o-right"></i><span class="screen-reader-text"> ' . get_the_title() . '</span></a>';
            echo '</footer><!-- .entry-footer -->';
        } else { ?>
            <div class="entry-content">
                
                <?php 
                $pho_archive_content = get_option( 'archive_setting' );
                if ( $pho_archive_content == 'content' ) {
                    the_content( __( '', 'pho' ) );
                } else {
                    the_excerpt(); 
                }
                ?>
            </div><!-- .entry-content -->
            <footer class="entry-footer continue-reading">
		<?php 
                if ( $pho_archive_content == 'content' ) {
                    echo '<a href="' . get_permalink() . '" title="' . _x('Read ', 'First part of "Read *article title* in title tag of Read more link', 'pho') . get_the_title() . '" rel="bookmark">' . __('Read <span aria-hidden="true">the article</span>', 'pho') . '<i class="fa fa-arrow-circle-o-right"></i><span class="screen-reader-text"> ' . get_the_title() . '</span></a>';
                } else {
                    echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'pho') . get_the_title() . '" rel="bookmark">' . __('Continue Reading', 'pho') . '<i class="fa fa-arrow-circle-o-right"></i><span class="screen-reader-text"> ' . get_the_title() . '</span></a>'; 
                }
                ?>
            </footer><!-- .entry-footer -->
        <?php } ?>

    </div>
</article><!-- #post-## -->
