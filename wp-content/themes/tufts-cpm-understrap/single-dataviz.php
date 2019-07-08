<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
get_template_part( 'loop-templates/parent', 'header' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </header>
          <div class="entry-content">

			      <?php the_content(); ?>

            <?php print get_field('tableau_embed'); ?>

            <?php
            $embeds = get_field('tableau_embeds');
            if ($embeds) {
	            $links = '';
	            $row = 0;
	            ?>
              <div class="multiple-embed-list">
                <h3>Additional Visualizations</h3>
              <?php
              foreach ($embeds as $embed) {
                $row++;
	              $title = $embed['tableau_embed_title'];
	              $embed_field = $embed['tableau_embed_field'];
	              ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#embed<?php print $row; ?>">
                  <?php print $title; ?></button>

                <div class="modal fade" id="embed<?php print $row; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel"><?php print $title; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
			                  <?php print $embed_field; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
              }
              ?></div><?php
            }
            ?>

          </div><!-- .entry-content -->

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
