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
 * query and display cpm registry list along with facets
 */
function cpm_registry() {
	// build query
	$args = array(
		'post_type' => 'cpm-registry',
		'posts_per_page' => 50,
		'facetwp' => true, // we added this
	);
	$query = new \WP_Query($args);
	// display in table format
  include(locate_template('loop-templates/cpm-registry.php', false, FALSE));

}

add_filter( 'facetwp_is_main_query', function( $bool, $query ) {
	return ( true === $query->get( 'facetwp' ) ) ? true : $bool;
}, 10, 2 );

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