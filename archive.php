<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pho
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if (have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					if (is_category()) :
					 /* translators: %s = single category title */
						printf( __( 'Posts in the %s category:', 'pho' ), '<em>' . single_cat_title( '', false ) . '</em>' );
					elseif (is_tag()) :
							 /* translators: %s = single tag title */
						printf( __( 'Posts with the %s tag', 'pho' ), '<em>' . single_tag_title( '', false ) . '</em>' );
					elseif (is_author()) :
						printf( __( 'Author: %s', 'pho' ), '<span class="vcard">' . get_the_author() . '</span>' );

						/* Prepending string for day, month and year needs context in order to be individually translatable. */
					elseif (is_day()) :
						printf( _x( 'Posts from %s', 'archive for a day', 'pho' ), '<span>' . get_the_date( _x( 'F j, Y', 'Daily archives date format', 'pho')) . '</span>' );
					elseif (is_month()) :
						printf( _x( 'Posts from %s', 'archive for a month', 'pho' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'pho' ) ) . '</span>' );
					elseif (is_year()) :
						printf( _x( 'Posts from %s', 'archive for a year', 'pho' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'pho' ) ) . '</span>' );
					else :
						_e( 'Archives', 'pho' );
					endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
				if (! empty( $term_description )) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
				?>
			</header><!-- .page-header -->

				<?php
				if (is_author() && get_the_author_meta( 'description' )) {
					echo '<div class="author-index shorter">';
					get_template_part('inc/author', 'box');
					echo '</div>';
				}
				?>

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) :
				the_post(); ?>

				<?php
					/* Include a Post Type or Post Format specific template for the content.
					   If you want to override this in a child theme, then
					   include a file called content-___.php (where ___ is the
					   name of the Post Type or Post Format) and that will be
					   used instead.
					 */
					$post_type = get_post_type();
				if (! empty($post_type)) {
					get_template_part( 'content', $post_type );
				} else {
					get_template_part( 'content', get_post_format() );
				}
				?>

			<?php endwhile; ?>

			<?php pho_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
