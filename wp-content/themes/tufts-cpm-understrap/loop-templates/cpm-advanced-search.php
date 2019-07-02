<?php
  $field_filters = array(
	    'Keyword' => 'keyword',
      'Model ID' => 'model_id',
      'Outcome' => 'outcome',
      'Index Condition' => 'primary_index_condition',
      'Secondary Condition' => 'secondary_index_condition',
      'Author' => 'author',
      'Journal' => 'journal',
      'Covariates' => 'covariates'
  );
  $compare_filters = array('AND','OR','NOT');
?>

  <div class="row">
    <?php
    if ($query) {
      ?>
      <div class="col-md-3">
	      <?php
	      include(locate_template('loop-templates/registry-filters.php', false, FALSE));
	      ?>
      </div>
      <?php
    }
    ?>
    <div class="col-md-9">
      <form method="get" class="advanced-search">
	      <?php
	      for ($x = 0; $x < count($field_filters); $x++) {
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
	        <?php
	        include(locate_template('loop-templates/registry-table.php', false, FALSE));
	        ?>
	        <?php

        }
        else {
            print $error_msg;
        }
      ?>

      <div class="facetwp-pager"></div>
    </div>
  </div>

