<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package pho
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

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div class="header-area">
	<header id="masthead" class="site-header" role="banner">
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'pho' ); ?></a>

		
			<div id="site-header">
				<?php if ( get_header_image() ) : ?>
					<div id="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
						</a>
					</div><!-- end #site-logo -->
				
				<?php else : ?>
					<div class="title-box">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php if ( '' != get_bloginfo('description') ) : ?>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>
					</div><!-- end #titlebox -->
			
				<?php endif; ?>
				
				</div><!-- end #site-header -->
			<nav id="site-navigation" class="main-navigation clear" role="navigation">
		
				<div class="search-toggle">
					<i class="fa fa-search"></i>
					<a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'pho' ); ?></a>
				</div>
				
				<?php pho_social_menu(); ?>
				
				<h1 class="menu-toggle"><a href="#"><?php _e( 'Menu', 'pho' ); ?></a></h1>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
								
			</nav><!-- #site-navigation -->

			<div id="header-search-container" class="search-box-wrapper clear hide">
				<div class="search-box clear">
					<?php get_search_form(); ?>
				</div>
			</div>
		
		
	</header><!-- #masthead -->
	</div> <!-- #header-area -->
	<div id="content" class="site-content">
