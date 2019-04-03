<?php

function dataviz_init() {
	register_post_type( 'dataviz', array(
		'labels'            => array(
			'name'                => __( 'Data Visualizations', 'tufts-cpm' ),
			'singular_name'       => __( 'Data Visualization', 'tufts-cpm' ),
			'all_items'           => __( 'All Data Visualizations', 'tufts-cpm' ),
			'new_item'            => __( 'New Data Visualization', 'tufts-cpm' ),
			'add_new'             => __( 'Add New', 'tufts-cpm' ),
			'add_new_item'        => __( 'Add New Data Visualization', 'tufts-cpm' ),
			'edit_item'           => __( 'Edit Data Visualization', 'tufts-cpm' ),
			'view_item'           => __( 'View Data Visualization', 'tufts-cpm' ),
			'search_items'        => __( 'Search Data Visualization', 'tufts-cpm' ),
			'not_found'           => __( 'No Data Visualizations found', 'tufts-cpm' ),
			'not_found_in_trash'  => __( 'No Data Visualizations found in trash', 'tufts-cpm' ),
			'parent_item_colon'   => __( 'Parent Data Visualization', 'tufts-cpm' ),
			'menu_name'           => __( 'Data Visualization', 'tufts-cpm' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
		'has_archive'       => false,
		'rewrite'           => array( 'slug' => 'data-visualization', 'with_front' => TRUE ),
		'query_var'         => true,
		'menu_icon'         => 'dashicons-chart-bar',
		'show_in_rest'      => true,
		'rest_base'         => 'Data Visualization',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'dataviz_init' );

function dataviz_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['Data Visualization'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Data Visualization updated. <a target="_blank" href="%s">View Data Visualization</a>', 'tufts-cpm'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'tufts-cpm'),
		3 => __('Custom field deleted.', 'tufts-cpm'),
		4 => __('Data Visualization updated.', 'tufts-cpm'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Data Visualization restored to revision from %s', 'tufts-cpm'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Data Visualization published. <a href="%s">View Data Visualization</a>', 'tufts-cpm'), esc_url( $permalink ) ),
		7 => __('Data Visualization saved.', 'tufts-cpm'),
		8 => sprintf( __('Data Visualization submitted. <a target="_blank" href="%s">Preview Data Visualization</a>', 'tufts-cpm'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Data Visualization scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Data Visualization</a>', 'tufts-cpm'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Data Visualization draft updated. <a target="_blank" href="%s">Preview Data Visualization</a>', 'tufts-cpm'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dataviz_updated_messages' );
