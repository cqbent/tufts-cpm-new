<?php
$field_list = array(
	'Model ID' => 'model_id',
	'Pubmed ID' => 'pubmed_id',
	'Primary Index Condition' => 'primary_index_condition',
	'Outcome' => 'outcome'
);
?>
<table class="table facetwp-template table" id="registry-list">
	<thead>
	<tr>
		<?php
		$qstring = $_SERVER["QUERY_STRING"];
		parse_str($qstring, $qarray);
		if ($qarray['orderby']) {
			$qstring = substr($qstring, 0, strpos($qstring, '&orderby'));

		}
		foreach ($field_list as $field => $value) {
		  $thclass = '';
		  $order = 'ASC';
		  if ($qarray['orderby'] == $value) {
		    $thclass = 'active';
		    if ($qarray['order'] == 'ASC') {
		      $order = 'DESC';
		      $thclass .= ' asc';
        }
        else {
		      $thclass .= ' desc';
        }
      }
			$order = $qarray['orderby'] == $value && $qarray['order'] == 'ASC' ? 'DESC' : 'ASC';
			?><th class="<?php print $thclass; ?>" scope="col"><a href="?<?php print $qstring; ?>&orderby=<?php print $value; ?>&order=<?php print $order; ?>"><?php print $field; ?></a></th><?php
		}
		?>

	</tr>
	</thead>
	<tbody>
	<?php
	while ($query->have_posts()) {
		$query->the_post();
		?><tr><?php
		foreach ($field_list as $field => $value) {
			$link = '';
			$fieldval = get_field($value, get_the_ID());
			if ($value == 'model_id') {
				?><td><a href="<?php print get_the_permalink(); ?>"><?php print $fieldval; ?></a></td><?php
			}
			elseif ($value == 'pubmed_id') {
				?><td><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=pubmed&dopt=Abstract&list_uids=<?php print $fieldval; ?>" target="_blank"><?php print get_field($value, get_the_ID()); ?></a></td><?php
			}
			else {
				?><td><?php print $fieldval; ?></td><?php
			}
		}
		?>
		</tr>
		<?php
	}
	wp_reset_postdata();
	?>

</table>
