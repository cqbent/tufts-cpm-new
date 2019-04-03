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

          <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="entry-content">

	            <?php the_content(); ?>

            </div><!-- .entry-content -->
          </article>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php get_footer(); ?>
