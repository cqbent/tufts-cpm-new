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
          <div class="row">
            <div class="col-md-6 col-lg-7">
              <table class="registry-table table table-responsive">
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
			            if ($field == 'calibration_reported') {
				            $value = $fieldobj['value'] ? 'Yes': 'No';
			            }
			            else {
				            $value = $fieldobj['value'];
			            }
			            if ($value) {

			            }
			            ?><tr><td><?php print $fieldobj['label']; ?></td><td><?php print $value; ?></td></tr> <?php
		            }
	            }
	            ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 col-lg-5">
	            <?php
	            $validations = cpm_validations(get_field('pubmed_id'), get_field('model_id'));
	            ?>
              <div class="validations">
                <h3>External Validations</h3>
                <?php
                if ($validations['count'] > 0) {
                  ?>
                    <div class="totals">
                      <?php
                      if ($validations['extval'] > 0) {
                        ?>
                        <div>
                          <label>Externally Validated</label><span>Yes</span>
                        </div>
                        <div>
                          <label>Number of External Validations</label><span><?php print $validations['extval']; ?></span>
                        </div>
                        <?php
                      }
                      ?>
                      <div>
                        <label>Median Validation AUROC</label><span><?php print $validations['mauc']; ?></span>
                      </div>
                    </div>
                    <table class="table">
                      <thead>
                      <tr>
                        <th>PMID</th>
                        <th>Sample Size</th>
                        <th>AUC</th>
                        <th>Calibration</th>
                      </tr>
                      </thead>
                      <tbody>
                  <?php
                  foreach ($validations['validations'] as $validation) {
                    ?>
                        <tr>
                          <td><?php print $validation['PMID']; ?></td>
                          <td><?php print $validation['Sample Size']; ?></td>
                          <td><?php print $validation['AUC']; ?></td>
                          <td><?php print $validation['Calibration']; ?></td>
                        </tr>
                    <?php
                  }
                  ?>
                      </tbody>
                    </table>
                  <?php
                }
                else {
                  ?> <label>No Validations</label><?php
                }
                ?>
              </div>
            </div>
          </div>

        <?php endwhile; // end of the loop. ?>

			</main><!-- #main -->


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
