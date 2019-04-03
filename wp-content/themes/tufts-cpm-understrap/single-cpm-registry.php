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
            <?php
            $fields = array('model_id', 'pubmed_id', 'author', 'journal', 'year', 'title',
                'primary_index_condition', 'secondary_index_condition', 'outcome', 'model_sample_size',
                'cohort_sample_size', 'number_of_events', 'follow', 'auroc', 'calibration_reported',
                'covariates', 'mesh_terms');
            ?>
          <header class="entry-header">
	          <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
          </header><!-- .entry-header -->
          <table class="table table-responsive">
            <thead>
              <tr>
                <th>Field</th>
                <th>Value</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($fields as $field) {
              if ($field == 'title') {
                ?><tr><td>Title</td><td><?php print get_the_title(); ?></td></tr> <?php
              }
              else {
                $fieldobj = get_field_object($field);
                if ($fieldobj['value']) {
	                ?><tr><td><?php print $fieldobj['label']; ?></td><td><?php print $fieldobj['value']; ?></td></tr> <?php
                }
              }
            }
            ?>
            </tbody>
          </table>
        <?php endwhile; // end of the loop. ?>

			</main><!-- #main -->


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
