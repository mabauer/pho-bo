<?php
/**
  * Template Name: Portfolio
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
		
		<div id="portfolio" class="portfolio-grid">
		
			<?php $options = get_option('baylys_theme_options');
				if( $options['portfolio-cat'] != '' ) : ?>
					<?php $portfolio = new WP_Query( 'category_name='.$options['portfolio-cat'].'&nopaging=true' ); 	?>
				<?php else : ?>
					<?php $portfolio = new WP_Query( 'category_name=portfolio&nopaging=true' ); ?>
				<?php endif  ?>

				<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
					<?php get_template_part( 'content', 'portfolio' ); ?>
				<?php endwhile; // end of the loop. ?>
				
		</div>

		<?php wp_reset_postdata(); // reset the query ?>

		</div><!-- end main -->
	</div><!-- end #content-area -->

<?php get_footer(); ?>