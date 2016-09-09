<?php
/**
 * Template for displaying flickr images on archive pages.
 *
 * @package pho
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="index-box clear">

        <?php

            echo '<div class="thumbnail-box clear side-teaser">';
            printf('%1$s', wp_get_attachment_image( get_the_ID(), 'post-thumbnail' ));
            echo '</div>';

        ?>

        <div class ="entry-box side-teaser">
            <header class="entry-header clear">

                <h1 class="entry-title"><?php the_title(); ?></h1>

            </header><!-- .entry-header -->

                <div class="entry-content">

                    <?php
                        the_excerpt();
                    ?>

                </div> <!-- .entry-content -->

                <footer class="entry-footer">
                    <?php if ( 'post' == get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php pho_posted_on(); ?>
                            <?php
                            if ( ! post_password_required() && ( comments_open() && '0' != get_comments_number() ) ) {
                                echo '<span class="comments-link">';
                                comments_popup_link( __( 'Leave a comment', 'pho' ), __( '1 Comment', 'pho' ), __( '% Comments', 'pho' ) );
                                echo '</span>';
                            }
                            ?>
                            <?php edit_post_link( sprintf( ' | %s', __( 'Edit', 'pho' ) ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>

                </footer><!-- .entry-footer -->

        </div> <!-- entry-box -->

    </div> <!-- index-box -->

    <?php if (get_theme_mod( 'pho_show_post_separators' ) == 1 ) { ?>
        <div class="separator">
        </div>
    <?php } ?>

</article><!-- #post-## -->
