<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="footer" id="wrapper-footer">

	<div class="container big">

		<div class="row">
      <div class="column col-sm-4 col-md-3">
        <a href="#"><img src="<?php print get_stylesheet_directory_uri(); ?>/images/logo_footer_tufts.svg" alt="tufts medical center" class="tufts-logo" /></a>
      </div>
      <div class="column col-sm-4 col-md-3">
        <a href="#"><img src="<?php print get_stylesheet_directory_uri(); ?>/images/pace_logo.svg" alt="Tufts PACE" class="pace-logo" /></a>
      </div>
      <div class="column col-sm-4 col-md-6 footer-links">
        <div class="contact">
          <a class="contact btn" href="/contact">Contact Us</a>
        </div>
        <div class="social">
          <a href="#" class="twitter-link" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </div>
      </div>
		</div><!-- row end -->
    <div class="copyright">
      © Tufts PACE Registry. All rights reserved.
    </div>

	</div><!-- container end -->

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

