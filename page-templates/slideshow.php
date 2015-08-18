<?php
/**
  * Template Name: Slideshow
  * Displays all posts with a specific tag as a slideshow (using the supersized library)
  * The default tag is 'featured'. This can however be overwritten by setting the 
  * custom field 'slideshow_tag' for the corresponding page.
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

					<?php 
						if ( get_option( 'show_on_front' ) == 'page' ) :
							$blog_page = get_permalink( get_option('page_for_posts' ));
						else :
							$blog_page = bloginfo('url');
						endif
					?>

<body <?php body_class(); ?>>

<div id="page" class="slideshow site">

	<div class="header-bar">
		<header id="masthead" class="site-header" role="banner">
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'pho' ); ?></a>

		
			<div id="site-header">
				<?php if ( get_header_image() ) : ?>
					<div id="site-logo" class="logo-box">
						<a href="<?php echo $blog_page ; ?>" rel="home">
							<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
						</a>
					</div><!-- end #site-logo -->			
				<?php endif; ?>
				
				<?php if ( !get_header_image() || get_custom_header()->width <= 64 ) : ?>
					<div class="title-box">
					<h1 class="site-title"><a href="<?php echo $blog_page ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php if ( '' != get_bloginfo('description') ) : ?>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>
				</div><!-- end #titlebox -->
				<?php endif; ?>
								
			</div><!-- end #site-header -->
			
			<nav id="slideshow-navigation" class="slideshow-navigation clear" role="navigation">
	
				<div id="enter_button" class="goto_button slideshow-navbutton">
					<i class="fa fa-times"></i>
					<a href="<?php echo $blog_page ?>" class="screen-reader-text"><?php _e( 'Enter', 'pho' ); ?></a>
				</div>	
				
				<!-- <div id="about_button" class="goto_button slideshow-navbutton">
					<i class="fa fa-info-circle"></i>
					<a href="http://local.wordpress.dev/about" class="screen-reader-text"><?php _e( 'About', 'pho' ); ?></a>
				</div>
				-->
				
				<div id="next_button" class="slideshow-navbutton">
					<i class="fa fa-arrow-circle-o-right"></i>
					<a href="#" class="screen-reader-text"><?php _e( 'Next', 'pho' ); ?></a>
				</div>
	
				<div id="prev_button" class="slideshow-navbutton">
					<i class="fa fa-arrow-circle-o-left"></i>
					<a href="#" class="screen-reader-text"><?php _e( 'Previous', 'pho' ); ?></a>
				</div>	
								
			</nav><!-- #site-navigation -->

		</header><!-- #masthead -->
	</div> <!-- #header-bar -->
	
	<!-- Clickable areas on the slides for some basic navigation -->
	<div id="clickable_area" class="clickable_area_wrapper">
		<div id="clickable_area_prev" class="clickable_area">
		</div>
		<div id="clickable_area_current" class="clickable_area">
		</div>
		<div id="clickable_area_next" class="clickable_area">
		</div>
	</div>

</div><!-- #page -->

	<?php 
		$slide_tag = get_post_meta($post->ID, 'slide_tag', true); 
		if ('' == $slide_tag) 
			$slide_tag = 'slideshow';	
	?>	
	<?php global $data; ?>
	<?php $data = array(); ?>
	<?php $slides = new WP_Query( 'tag=' . $slide_tag . '&nopaging=true' ); ?>
	<?php while ( $slides->have_posts() ) : $slides->the_post(); ?>
		<?php 
			if ( has_post_thumbnail() ) :
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$data[] = array(
  	            	"image" => $thumb[0],
    	        	"title" => 'Test',
                	"url" => get_permalink()
        			);
			endif; 
		?>
	<?php endwhile; // end of the loop. ?>

	<?php wp_reset_postdata(); // reset the query ?>

		
	<script type="text/javascript"> 
    	jQuery(document).ready(function($) {
    		$.supersized({
    				// Functionality
    				slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					slide_interval          :   10000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	700,		// Speed of transition
					new_window				:	0,			// Image links open in new window/tab
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   0,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components
					slide_links				: 'blank',
					slides 					:  	<?=json_encode($data); ?>
			});
			
			// Clickable areas on current slide leads to corresponding post...
			$('#clickable_area_current').on('click', function() {
				target = api.getField('url');
				if (typeof(target) != 'undefined') {
   					window.location.href = target;
   				}
			}); 
			
			// ... to the previous slide...
			$('#clickable_area_prev').on('click', function() {
				api.playToggle();
				api.prevSlide();
   			}); 
   			
   			// ... or the the next one
   			$('#clickable_area_next').on('click', function() {
				api.playToggle();
				api.nextSlide();
   			}); 
			
			// Buttons in navigation menue
			$('#prev_button').on('click', function() {
				api.playToggle();
				api.prevSlide();
   			}); 
   			
   			$('#next_button').on('click', function() {
				api.playToggle();
				api.nextSlide();
   			}); 
   			
   			// Info and sign-in buttons
			$('.goto_button').on('click', function() {
				target = $(this).find('a').attr('href')
   				if (typeof(target) != 'undefined') {
   					window.location.href = target;
   				}
   			}); 
   			
		});
	</script>
	
</body>
<?php wp_footer(); ?>