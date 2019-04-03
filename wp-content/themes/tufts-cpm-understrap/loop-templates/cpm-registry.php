<?php
if ($query->have_posts()) {
?>

  <div class="row">
    <div class="col-md-3">
      <h3>Filter By:</h3>
      <div class="filter-type">
        <?php print do_shortcode('[facetwp facet="index_condition"]'); ?>
      </div>
      <div class="filter-type">
        <?php print do_shortcode('[facetwp facet="outcome"]'); ?>
      </div>
      <?php do_shortcode('[facetwp pager="true"]'); ?>
	    <?php do_shortcode('[facetwp counts="true"]'); ?>
    </div>
    <div class="col-md-9">
      <h3>Your search returned <span class="facetwp-counts"></span> results</h3>
      <table class="table facetwp-template table-responsive" id="registry-list">
        <thead>
        <tr>
          <th scope="col">Model ID</th>
          <th scope="col">PubMed ID</th>
          <th scope="col">Year</th>
          <th scope="col">Primary Index Condition</th>
          <th scope="col">Outcome</th>
        </tr>
        </thead>
        <tbody>
      <?php
      while ($query->have_posts()) {
        $query->the_post();
        ?>
          <tr>
            <td><a href="<?php print get_the_permalink(); ?>"><?php print get_field('model_id', get_the_ID()); ?></a></td>
            <td><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=pubmed&dopt=Abstract&list_uids=<?php print get_field('pubmed_id', get_the_ID()); ?>" target="_blank"><?php print get_field('pubmed_id', get_the_ID()); ?></a></td>
            <td><?php print get_field('year', get_the_ID()); ?></td>
            <td><?php print get_field('primary_index_condition', get_the_ID()); ?></td>
            <td><?php print get_field('outcome', get_the_ID()); ?></td>
          </tr>
        <?php
      }
      wp_reset_postdata();
      ?>

      </table>
      <div class="facetwp-pager"></div>
    </div>
  </div>

<?php
}