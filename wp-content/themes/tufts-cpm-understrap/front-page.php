<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
  <div class="banner home-header">
    <div class="container">
      <div class="intro-text"><?php the_content(); ?></div>
      <img class="graph" src="<?php print get_stylesheet_directory_uri(); ?>/images/homepage_hero_graph.svg" alt="tufts pace cpm graph" />
    </div>
  </div>

  <div class="wrapper" id="full-width-page-wrapper">
    <div class="cpm-links">
      <div class="container">
        <div class="row">
          <div class="column col-sm-6 col-md-3">
            <a href="/registry">
              <img src="<?php print get_stylesheet_directory_uri(); ?>/images/icon_cpm_registry.svg" alt="cpm registry" />
              <div>CPM Registry</div>
            </a>

          </div>
          <div class="column col-sm-6 col-md-3">
            <a href="/data-visualization">
              <img src="<?php print get_stylesheet_directory_uri(); ?>/images/icon_dataviz.svg" alt="data visualization" />
              <div>Data Visualization</div>
            </a>
          </div>
          <div class="column col-sm-6 col-md-3">
            <a href="/publications">
              <img src="<?php print get_stylesheet_directory_uri(); ?>/images/icon_publications.svg" alt="publications" />
              <div>Publications</div>
            </a>
          </div>
          <div class="column col-sm-6 col-md-3">
            <a href="/resources">
              <img src="<?php print get_stylesheet_directory_uri(); ?>/images/icon_resources.svg" alt="resources" />
              <div>Resources</div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="feature-content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 feature-publications">
            <h4>Featured Publications <a href="/publications">go to publications ></a></h4>
            <div class="row">
              <?php publications(2); ?>
            </div>
          </div>
          <div class="col-md-4">
            <h4>Updates</h4>
            <div>
              Lorem ipsum dolor sit amet Consectetuer adipielit, sed diam non ummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
            </div>
          </div>
        </div>
      </div>
    </div>


  </div><!-- #full-width-page-wrapper -->
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
