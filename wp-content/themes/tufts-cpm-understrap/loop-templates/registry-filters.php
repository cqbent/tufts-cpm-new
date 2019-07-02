<?php
$filter_list = array(
	'index_condition',
	'outcome',
	'year',
	'secondary_index_condition',
);
$page_path = $_SERVER['REQUEST_URI'];
?>

<div class="filters">
	<h3>Filter By:</h3>
	<?php
	foreach ($filter_list as $filter) {
		?>
		<div class="filter-type">
			<?php print do_shortcode('[facetwp facet="'.$filter.'" sort="true"]'); ?>
		</div>
		<?php
	}
	?>
  <div class="filter-type">
    <label>Model Sample Size (min/max)</label>
	  <?php print do_shortcode('[facetwp facet="model_sample_size" sort="true"]'); ?>
  </div>
  <div class="filter-type">
    <label>Number of Events (min/max)</label>
	  <?php print do_shortcode('[facetwp facet="number_of_events" sort="true"]'); ?>
  </div>
	<?php do_shortcode('[facetwp pager="true"]'); ?>
	<?php do_shortcode('[facetwp counts="true"]'); ?>
    <?php
    if (strstr($page_path, 'registry/')) {
	    ?><a href="/registry" class="btn btn-primary">Reset</a><?php
    }
    ?>

</div>