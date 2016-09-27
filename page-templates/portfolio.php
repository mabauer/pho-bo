<?php
/**
  * Template Name: Portfolio
  * Displays all posts with a specific tag as a portfolio (using a fancy grid layout)
  * The default tag is 'portfolio'. This can however be overwritten by setting the
  * custom field 'portfolio_tag' for the corresponding page.
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'intro' ); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
				<?php	if ( '' != get_the_content() ); ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; ?>

			<?php /* ?>
			<div class="portfolio-filter">
				 <ul>
					 <li id="filter--all" class="filter active" data-filter="*"><?php _e( 'Alle', 'pho' ) ?></li>
					 <?php
						 // list terms in a given taxonomy
						 $taxonomy = 'jetpack-portfolio-tag';
						 $tax_terms = get_terms( $taxonomy );

						 foreach ( $tax_terms as $tax_term ) {
						 echo '<li class="filter" data-filter=".'. $tax_term->slug.'">' . $tax_term->slug .'</li>';
						 }
					 ?>
				 </ul>
			 </div>
			 <php */ ?>

			<div id="portfolio" class="portfolio-grid">

				<?php
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = -1;
				endif;

				$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', '-1' );

				$args = array(
					'post_type'      => 'jetpack-portfolio',
					'paged'          => $paged,
					'posts_per_page' => $posts_per_page,
				);

				$portfolio_query = new WP_Query ( $args );

				if ( post_type_exists( 'jetpack-portfolio' ) && $portfolio_query -> have_posts() ) :
					while ( $portfolio_query -> have_posts() ) : $portfolio_query -> the_post();

						get_template_part( 'content', 'portfolio' );

					endwhile;

					// wds_portfolio_paging_nav( $project_query->max_num_pages );

					wp_reset_postdata();
				endif;
				?>

			</div> <!-- portfolio -->

		</main><!-- end main -->
	</div><!-- end #content-area -->

<?php get_footer(); ?>
