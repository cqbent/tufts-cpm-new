<?php
/**
 * Custom CPM functions
 */

/*
 * add page/post slug to body class
 */
add_filter( 'body_class', function ( array $classes ) {
	/** Add page slug if it doesn't exist */
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes ) ) {
			$classes[] = basename( get_permalink() );
		}
	}
	return array_filter( $classes );
} );

/*
 * landing page parent block: get page parent via page id > parent item or page path > parent path
 */
function landing_page_header($id) {
	/*
	 * get post data from id
	 * if post is landing then get title and image
	 * else if post has parent then get parent data and load title and image from parent
	 * else get page path, strip out parent path and load parent data from parent path
	 *
	 */
	$post = get_post($id);
	$landing_page_id = '';
	if (!$post->post_parent && strpos(get_page_template_slug($id), 'landing-page')) {
		$landing_page_id = $id;
	}
	elseif ($post->post_parent) {
		$landing_page_id = $post->post_parent;
	}
	else {
		$post_path = explode('/', $_SERVER['REQUEST_URI']);
		//var_dump($_SERVER['REQUEST_URI']);
		$page_by_path = get_page_by_path($post_path[1]);
		if ($page_by_path) {
		  $landing_page_id = $page_by_path->ID;
    }
	}
	return $landing_page_id;
}


/*
 * data visualization list
 */
function data_visualization() {
	$args = array(
		'post_type' => 'dataviz',
		'posts_per_page' => 50,
	);
	$query = new \WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			include(locate_template('loop-templates/content-dataviz.php', false, FALSE));
		}
	}

}

/*
 * publications list
 */
function publications($posts = 50) {
	$args = array(
		'post_type' => 'publication',
		'posts_per_page' => $posts,
		'meta_key' => 'publication_date',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	);
	$query = new \WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			include(locate_template('loop-templates/content-publication.php', false, FALSE));
		}
	}
}

function feature_publications() {
	$args = array(
		'post_type' => 'publication',
		'posts_per_page' => 2,
		'meta_key' => 'publication_date',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	);
	$query = new \WP_Query($args);
	if ($query->have_posts()) {
		$result = array();
		while ($query->have_posts()) {
			$query->the_post();
			$result[] = array();
		}
	}
}

function feature_news() {
	$result = '';
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
	);
	$query = new \WP_Query($args);
	if ($query->have_posts()) {

		while ($query->have_posts()) {
			$query->the_post();
			$result .= '<li>' . get_the_content() . '</li>';
		}
	}
	return $result;
}

function cpm_registry_list() {
	$field_list = array(
		'Model ID' => 'model_id',
		'Pubmed ID' => 'pubmed_id',
		'Primary Index Condition' => 'primary_index_condition',
		'Outcome' => 'outcome'
	);
}

/*
 * CPM Registry functions
 */

/*
 * add FacetWP as main query when 'facetwp' is in querystring
 */
add_filter( 'facetwp_is_main_query', function( $bool, $query ) {
	return ( true === $query->get( 'facetwp' ) ) ? true : $bool;
}, 10, 2 );

/*
 * alter Facetwp results count text
 */
add_filter( 'facetwp_result_count', function( $output, $params ) {
	$output = $params['total'];
	//$output = $params['lower'] . '-' . $params['upper'] . ' of ' . $params['total'] . ' results';
	return $output;
}, 10, 2 );

function cpm_registry($type = 'basic') {
	if ($type == 'advanced') {
		cpm_advanced_search();
	}
	else {
		cpm_registry_basic();
	}
}

/*
 * query and display cpm registry list along with facets
 */
function cpm_registry_basic() {
	// build query
	$ordertype = 'meta_value_num';
	parse_str($_SERVER["QUERY_STRING"], $query_array);
	$args = array(
		'post_type' => 'cpm-registry',
		'posts_per_page' => -1,
		'facetwp' => true, // we added this
	);
	if ($orderby = $query_array['orderby']) {
		if ($orderby == 'primary_index_condition' || $orderby == 'outcome') {
			$ordertype = 'meta_value';
		}
		$args['meta_key'] = $orderby;
		$args['orderby'] = $ordertype;
		$args['order'] = $query_array['order'];
	}
	$query = new \WP_Query($args);
	// display in table format
	include(locate_template('loop-templates/cpm-registry.php', false, FALSE));

}



function cpm_advanced_search() {
	$type = 'Advanced';
	// build query
	$query = '';
	$filter_rows = array();
	parse_str($_SERVER["QUERY_STRING"], $query_array);
	$meta_query = array();
	$search_query = '';
	$error_msg = '';
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$ordertype = 'meta_value_num';
	/*
	 * for each row set each field
	 */
	if ($query_array) {
		for ($x = 0; $x < 4; $x++) {
			// get filter values
			$compare_filter = $query_array['compare_filter_'.$x];
			$text_filter = $query_array['text_filter_'.$x];
			$field_filter = $query_array['field_filter_'.$x];
			//var_dump($field_filter);
			if ($text_filter && $field_filter) {
				if ($field_filter == 'keyword') {
					$search_query .= '+'.$text_filter;
				}
				else {
					$compare = 'LIKE';
					if ($compare_filter) {
						if ($compare_filter == 'NOT') {
							$compare = 'NOT LIKE';
						}
						else {
							//$meta_query[] = '"relation" =>' .$compare_filter;
							$meta_query['relation'] = $compare_filter;
						}
					}
					$meta_query[] = array(
						"key" => $field_filter,
						"compare" => $compare,
						"type" => "CHAR",
						"value" => $text_filter,
					);
				}

			}
		}

		if ($search_query || $meta_query) {
			$args = array(
				'post_type' => 'cpm-registry',
				"post_status" => [
					"publish"
				],
				's' => $search_query,
				"meta_query" => $meta_query,
				"posts_per_page" => "-1",
				"paged" => $paged
			);
			if ($orderby = $query_array['orderby']) {
				if ($orderby == 'primary_index_condition' || $orderby == 'outcome') {
					$ordertype = 'meta_value';
				}
				$args['meta_key'] = $orderby;
				$args['orderby'] = $ordertype;
				$args['order'] = $query_array['order'];

			}
			if ($search_query) {
				//$args[] = array('s' => $search_query);
				$query = new \WP_Query($args);
				relevanssi_do_query($query);
			}
			else {
				$query = new \WP_Query($args);
			}
		}
		else {
			$error_msg = 'Search was not run. Make sure to enter a keyword and filter for each row.';
		}
		//var_dump($args);
	}
	include(locate_template('loop-templates/cpm-advanced-search.php', false, FALSE));
}
/*
 * Validation data for individual cpm registry page
 */
function cpm_validations($id1, $id2) {
	// query all validations per model id; count # validations; calculate median auc; list validations in tabular format
	$args = array(
		'post_type' => 'cpm-validations',
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'de_novo_pmid',
				'value' => $id1,
				'compare' => '='
			),
			array (
				'key' => 'model_id',
				'value' => $id2,
				'compare' => '='
			),
		),
	);
	$query = new \WP_Query($args);
	$validations = array();
	$count = 0;
	$mauc = 0;
	$extval = 0;
	if ($query->have_posts()) {
		$count = $query->post_count;
		while ($query->have_posts()) {
			$query->the_post();
			$extval = $extval + get_field('external_validations', get_the_ID());
			$validations[] = array(
				'PMID' => get_field('validation_pmid', get_the_ID()),
				'Sample Size' => get_field('validation_sample_size', get_the_ID()),
				'AUC' => get_field('validation_auc', get_the_ID()),
				'Calibration' => get_field('calibration_reported', get_the_ID()),
				'External Validations' => get_field('external_validations', get_the_ID()),
				'Relatedness' => get_field('relatedness', get_the_ID()),
			);
		}
		wp_reset_postdata();
		$mvid = round(($count + 1) / 2);
		$mauc = $validations[$mvid - 1]['AUC'];
		if ($count % 2 == 0) {
			$mauc = ($mauc + $validations[$mvid - 2]['AUC']) / 2;
		}
	}
	return array(
		'validations' => $validations,
		'count' => $count,
		'mauc' => $mauc,
		'extval' => $extval
	);

}

