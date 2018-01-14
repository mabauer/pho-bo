<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pho
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php 
				/* Special treatment for featured or sticky posts:
				 * If possible, these are placed into two "feature slots" per page and 
				 * displayed with a large teaser image 
				 */

				$use_feature_slots = ('move_up_featured_posts' == get_theme_mod( 'feature_slots'));
				$default_posts_per_page = get_option( 'posts_per_page', 8 );
				/* Positions for the feature slots */
				$upper_slot_position = 0;
				$lower_slot_position = floor($default_posts_per_page /2); 

				$upper_slot_id = 0;
				$upper_slot_code = "";
				$lower_slot_id = 0;
				$lower_slot_code = "";
			?>

			<?php 
				if ($use_feature_slots) : 

					/* First loop: determine posts for the two feature slots */		
					while ( have_posts() ) : the_post(); 
						/* Fill upper slot first... */
						if (pho_is_featured_post() || is_sticky()) :
							if (empty($upper_slot_id)):
								$upper_slot_id = get_the_ID();
								ob_start();
								echo "<!-- Upper slot -->";
								get_template_part( 'featured-content', get_post_format() );
								$upper_slot_code = ob_get_clean();
							else:
								/* ...then fill lower slot */
								if (empty($lower_slot_id) && ($wp_query->current_post >= $lower_slot_position)) :
									$lower_slot_id = get_the_ID();
									ob_start();
									echo "<!-- Lower slot -->";
									get_template_part( 'featured-content', get_post_format() );
									$lower_slot_code = ob_get_clean();
								endif;
							endif;
						endif;				
					endwhile;

					rewind_posts(); 
				endif; 				
			?>

			<?php 
				/* Second loop: show all posts plus the feature slots determined before */
				$index = 0;
				while ( have_posts() ) : the_post(); ?>
				
				<?php
					/* Insert posts for featured slots */
					if (($index == $upper_slot_position) && !empty($upper_slot_id)) :
						echo $upper_slot_code;
						$index++;
					endif;
					if  (($index == $lower_slot_position) && !empty($lower_slot_id)) :
						echo $lower_slot_code;
						$index++;
					endif;

					/* 
					 * Insert normal posts. Skip posts already placed int the feature slots.
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if ((get_the_ID() != $upper_slot_id) && (get_the_ID() != $lower_slot_id)) :
						if ($index == $upper_slot_position || $index == $lower_slot_position) 
							get_template_part( 'featured-content', get_post_format() );
						else
							get_template_part( 'content', get_post_format() );
						$index++;
					endif;
					
				?>

			<?php endwhile; ?>

			<?php pho_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
