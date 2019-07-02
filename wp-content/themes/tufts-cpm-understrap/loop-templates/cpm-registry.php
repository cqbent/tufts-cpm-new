<?php
if ($query->have_posts()) {
?>

  <div class="row">
    <div class="col-md-3">
      <h3>Basic Search</h3>
      <p>Search all fields of the CPM Registry</p>
      <div class="filter-search">
	      <?php print do_shortcode('[facetwp facet="basic_search"]'); ?>
      </div>
	    <?php
	    include(locate_template('loop-templates/registry-filters.php', false, FALSE));
	    ?>
    </div>
    <div class="col-md-9">
      <h3>You have <span class="facetwp-counts"></span> individual de novo models that have been returned based on your search parameters</h3>
        <?php
        include(locate_template('loop-templates/registry-table.php', false, FALSE));
        ?>
      <div class="facetwp-pager"></div>
    </div>
  </div>

<?php
}