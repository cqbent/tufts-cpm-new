<?php
  $field_filters = array(
      'Outcome' => 'outcome',
      'Index Condition' => 'primary_index_condition',
      'Secondary Condition' => 'secondary_index_condition',
      'Keyword' => 'keyword'
  );
  $compare_filters = array('AND','OR','NOT');
?>

  <div class="row">
    <?php
    if ($query) {
      ?>
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
      <?php
    }
    ?>
    <div class="col-md-9">
      <form method="get" class="advanced-search">
	      <?php
	      for ($x = 0; $x < 4; $x++) {
		      ?>
          <div class="row fieldset_<?php print $x;?>">
            <div class="col-2 compare-filter">
	            <?php if ($x > 0) {
		            ?>
                  <select name="compare_filter_<?php print $x; ?>">
		              <?php
		              $compare_val = $query_array['compare_filter_'.$x];
		              foreach ($compare_filters as $compare) {
			              $compare_selected = $compare_val == $compare ? ' selected' : '';
			              print '<option value="'.$compare.'" '.$compare_selected.'>'.$compare.'</option>';
		              }
		              ?>
                  </select>
		            <?php
	            }
	            ?>
            </div>
            <div class="col-6 text-filter">
              <input type="text" value="<?php print $query_array['text_filter_'.$x]; ?>" placeholder="Enter text" name="text_filter_<?php print $x; ?>" />
            </div>
            <div class="col-4 field-filter">
              <select name="field_filter_<?php print $x; ?>">
                <option value="">Select Filter</option>
	              <?php
	              $field_val = $query_array['field_filter_'.$x];
	              foreach($field_filters as $key => $value) {
		              $field_selected = $field_val == $value ? ' selected' : '';
		              print '<option value="'.$value.'" '.$field_selected.'>'.$key.'</option>';
	              }
	              ?>
              </select>
            </div>
          </div>
		      <?php
	      }
	      ?>
        <input type="submit" name="submit" value="Search" class="btn btn-primary" />
        <a href="/registry-advanced" class="btn btn-primary">Reset</a>
      </form>
      <?php
        if ($query) {
          ?>
            <div>Found <span class="facetwp-counts"></span> posts based on your search.</div>
          <table class="table facetwp-template table" id="registry-list">
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
          <div class="pager">
              <?php //echo paginate_links( array('total' => $query->max_num_pages) ); ?>
          </div>

	        <?php

        }
        else {
            print $error_msg;
        }
      ?>

      <div class="facetwp-pager"></div>
    </div>
  </div>

