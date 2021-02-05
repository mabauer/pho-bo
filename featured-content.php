<?php
/**
 * Template for regular posts to be used on index and archive pages.
 *
 * @package pho
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	// Setup teaser image for the post
	$teaser = 'no-teaser';
	if (has_post_thumbnail()) {
		$teaser = 'large-teaser';
	}
	?>

	<div class="index-box clear">

		<?php
			// Featured image
			if (has_post_thumbnail()) {
				echo '<div class="thumbnail-box clear '.$teaser.'">';
				echo '<a href="'.get_permalink().'" title="'.__('Read ', 'pho').get_the_title().'" rel="bookmark">';

				the_post_thumbnail('featured-image');

				echo '</a>';
				echo '</div>';
			}
		?>

		<div class ="entry-box <?php echo $teaser ?>">
			<header class="entry-header clear">
				<?php

				// Display a marker in the top right hand corner if this post is sticky
				if (is_sticky()) {
					echo '<i class="fa fa-chevron-circle-up sticky-post"></i>';
				}

				/* Translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list(__(', ', 'pho'));

				if (pho_categorized_blog()) {
					echo '<div class="category-list">'.$category_list.'</div>';
				}
				?>

				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			</header><!-- .entry-header -->

			<?php

				echo '<div class="entry-content">';

				$pho_archive_content = get_option('archive_setting');
				if ($pho_archive_content == 'content') {
					the_content(__('', 'pho'));
				} else {
					the_excerpt();
				}

				echo '<div class="continue-reading">';
				if ($pho_archive_content == 'content') {
					echo '<a href="'.get_permalink().'" title="'._x('Read ', 'First part of "Read *article title* in title tag of Read more link', 'pho').get_the_title().'" rel="bookmark">'
					.__('Read <span aria-hidden="true">the article</span>', 'pho').'<i class="fa fa-chevron-circle-right"></i><span class="screen-reader-text"> '.get_the_title().'</span></a>';
				} else {
					echo '<a href="'.get_permalink().'" title="'.__('Continue Reading ', 'pho').get_the_title().'" rel="bookmark">'
					.__('More', 'pho').'<i class="fa fa-chevron-circle-right"></i><span class="screen-reader-text"> '.get_the_title().'</span></a>';
				}
				echo '</div> <!-- .continue-reading -->';

				echo '</div> <!-- .entry-content -->';
			?>

				<footer class="entry-footer">
					<?php if ('post' == get_post_type()) : ?>
						<div class="entry-meta">
							<?php pho_posted_on();
							?>
							<?php
							if (!post_password_required() && (comments_open() && '0' != get_comments_number())) {
								echo '<span class="comments-link">';
								comments_popup_link(__('Leave a comment', 'pho'), __('1 Comment', 'pho'), __('% Comments', 'pho'));
								echo '</span>';
							}
							?>
							<?php edit_post_link(sprintf(' | %s', __('Edit', 'pho')), '<span class="edit-link">', '</span>');
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</footer><!-- .entry-footer -->

		</div> <!-- entry-box -->

	</div> <!-- index-box -->

	<?php if (get_theme_mod('show_post_separators') == 1) : ?>
		<div class="separator">
		</div>
	<?php endif; ?>

</article><!-- #post-## -->
