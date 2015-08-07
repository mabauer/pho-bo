<?php
/**
 * Outputs the single post content. Displayed by single.php.
 * 
 * @package pho
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    

	<header class="entry-header clear">
	
		<?php 
			if (has_post_thumbnail()) {
				echo '<div class="thumbnail-box clear">';
				pho_the_responsive_thumbnail( get_the_ID() );
				echo '</div>';
			}
		?>
            
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'pho' ) );

			if ( pho_categorized_blog() ) {
				echo '<div class="category-list">' . $category_list . '</div>';
			}
		?>
		
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
                    <?php pho_posted_on(); ?>
                    <?php 
                    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                        echo '<span class="comments-link">';
                        comments_popup_link( __( 'Leave a comment', 'pho' ), __( '1 Comment', 'pho' ), __( '% Comments', 'pho' ) );
                        echo '</span>';
                    }
                    ?>
                    <?php edit_post_link( sprintf('| %s', __( 'Edit', 'pho' )), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pho' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			echo get_the_tag_list( '<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
