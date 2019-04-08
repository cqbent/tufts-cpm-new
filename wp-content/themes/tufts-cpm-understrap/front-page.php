<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<?php while ( have_posts() ) : the_post(); ?>
  <div class="banner home-header">
    <div class="container">
      <h1 class="title"><?php print the_title(); ?></h1>
      <div class="intro-text"><?php the_content(); ?></div>
      <img class="graph" src="<?php print get_stylesheet_directory_uri(); ?>/images/homepage_hero_graph.svg" alt="tufts pace cpm graph" />
    </div>
  </div>

  <div class="wrapper" id="full-width-page-wrapper">
    <div class="cpm-links">
      <div class="container">
        <div class="row">
          <div class="column registry col-sm-6 col-md-3">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>registry">
              <div>CPM Registry</div>
            </a>

          </div>
          <div class="column dataviz  col-sm-6 col-md-3">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>data-visualization">
              <div>Data Visualization</div>
            </a>
          </div>
          <div class="column publications col-sm-6 col-md-3">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>publications">
              <div>Publications</div>
            </a>
          </div>
          <div class="column resources col-sm-6 col-md-3">
            <a href="/resources">
              <div>Resources</div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="feature-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 feature-publications">
            <h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>publications">Featured Publications <span>go to publications >></span></a></h4>
              <?php publications(2); ?>
          </div>
          <div class="col-md-6 news">
            <h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>news">News</a></h4>
            <ul>
	            <?php print feature_news(); ?>
            </ul>

          </div>
        </div>
      </div>
    </div>


  </div><!-- #full-width-page-wrapper -->
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
