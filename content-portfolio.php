<?php
/**
 * The template for displaying content of the portfolio category
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-element'); ?>>
		
		<?php if ( has_post_thumbnail() ): ?>
			<a href="<?php the_permalink(); ?>" class="portfolio-thumb"><?php the_post_thumbnail('index-thumb'); ?></a>
		<?php endif; ?>

	<header class="entry-header clearfix">
		
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pho' ), 
			the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<div class="entry-meta">
			<?php pho_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header>
	<div class="entry-content clearfix">	
	</div><!-- end .entry-content -->

</article><!-- end post -<?php the_ID(); ?> -->