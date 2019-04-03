<?php
/**
 * Template Name: Landing Page
 *
 * Template for section landing pages.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

get_template_part( 'loop-templates/parent', 'header' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="container" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

          <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="entry-content">

	            <?php the_content(); ?>

              <div class="content-list">
	              <?php
	              global $post;
	              if ($post->post_name == 'registry') {
		              cpm_registry();
	              }
                  elseif ($post->post_name == 'data-visualization') {
		              data_visualization();
	              }
                  elseif ($post->post_name == 'publications') {
		              publications();
	              }
	              ?>
              </div>


            </div><!-- .entry-content -->
          </div>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php get_footer(); ?>
