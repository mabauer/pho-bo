<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package pho
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
            <?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
			<?php do_action( 'pho_credits' ); ?>
			<?php
			printf(
				/* translators: %s = text link: WordPress, URL: http://wordpress.org/ */
				__( 'Proudly powered by %s', 'pho' ),
				'<a href="http://wordpress.org/" rel="generator">' . esc_attr__( 'WordPress', 'pho' ) . '</a>'
				); ?>
			<span class="sep"> | </span>
			<?php
			printf(
				/* translators: %1$s = text link: pho, URL: http://wordpress.org/themes/pho/, %2$s = text link: mor10.com, URL: http://mor10.com/ */
				__( 'Theme: %1$s by %2$s', 'pho' ),
                                '<a href="http://wordpress.org/themes/pho/" rel="nofollow">' . esc_attr( 'pho', 'pho' ) . '</a>',
				'<a href="http://mor10.com/" rel="designer nofollow">' . esc_attr__( 'mor10.com', 'pho' ) . '</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>