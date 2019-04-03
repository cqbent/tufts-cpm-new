<?php

function cpm_registry_init() {
	register_post_type( 'cpm-registry', array(
		'labels'            => array(
			'name'                => __( 'CPM Registry', 'CPM Registry' ),
			'singular_name'       => __( 'CPM Registry', 'CPM Registry' ),
			'all_items'           => __( 'All CPM Registry items', 'CPM Registry' ),
			'new_item'            => __( 'New CPM Registry item', 'CPM Registry' ),
			'add_new'             => __( 'Add New', 'CPM Registry' ),
			'add_new_item'        => __( 'Add New CPM Registry item', 'CPM Registry' ),
			'edit_item'           => __( 'Edit CPM Registry item', 'CPM Registry' ),
			'view_item'           => __( 'View CPM Registry item', 'CPM Registry' ),
			'search_items'        => __( 'Search CPM Registry', 'CPM Registry' ),
			'not_found'           => __( 'No CPM Registry found', 'CPM Registry' ),
			'not_found_in_trash'  => __( 'No CPM Registry found in trash', 'CPM Registry' ),
			'parent_item_colon'   => __( 'Parent CPM Registry', 'CPM Registry' ),
			'menu_name'           => __( 'CPM Registry', 'CPM Registry' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'custom-fields' ),
		'has_archive'       => false,
		'rewrite'           => array( 'slug' => 'registry', 'with_front' => TRUE ),
		'query_var'         => true,
		'menu_icon'         => 'dashicons-list-view',
		'show_in_rest'      => true,
		'rest_base'         => 'cpm-registry',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'cpm_registry_init' );

function cpm_registry_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['cpm-registry'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Cpm registry updated. <a target="_blank" href="%s">View cpm registry</a>', 'CPM Registry'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'CPM Registry'),
		3 => __('Custom field deleted.', 'CPM Registry'),
		4 => __('Cpm registry updated.', 'CPM Registry'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Cpm registry restored to revision from %s', 'CPM Registry'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Cpm registry published. <a href="%s">View cpm registry</a>', 'CPM Registry'), esc_url( $permalink ) ),
		7 => __('Cpm registry saved.', 'CPM Registry'),
		8 => sprintf( __('Cpm registry submitted. <a target="_blank" href="%s">Preview cpm registry</a>', 'CPM Registry'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Cpm registry scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview cpm registry</a>', 'CPM Registry'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Cpm registry draft updated. <a target="_blank" href="%s">Preview cpm registry</a>', 'CPM Registry'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'cpm_registry_updated_messages' );
