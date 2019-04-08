<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-header" class="header" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

			<div class="container big">

        <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
          <img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/tufts-cpm-understrap/images/tufts_cpm_logo.svg" class="img-fluid" alt="Tufts PACE CPM Registry" itemprop="logo">
        </a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>

        <div class="toplinks">
          <div class="contact">
            <a class="contact btn" href="<?php echo esc_url( home_url( '/' ) ); ?>contact">Contact Us</a>
          </div>
          <div class="social">
            <a href="#" class="twitter-link" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="tmc-logo">
          <a href="https://www.tuftsmedicalcenter.org" target="_blank"><img src="<?php print get_stylesheet_directory_uri(); ?>/images/logo_header_tufts.svg" alt="tufts medical center" /></a>
        </div>

			</div><!-- .container -->

		</nav><!-- .site-navigation -->

	</header><!-- #wrapper-navbar end x-->
