<?php

function publication_init() {
	register_post_type( 'publication', array(
		'labels'            => array(
			'name'                => __( 'Publications', 'tufts-cpm' ),
			'singular_name'       => __( 'Publication', 'tufts-cpm' ),
			'all_items'           => __( 'All Publications', 'tufts-cpm' ),
			'new_item'            => __( 'New publication', 'tufts-cpm' ),
			'add_new'             => __( 'Add New', 'tufts-cpm' ),
			'add_new_item'        => __( 'Add New publication', 'tufts-cpm' ),
			'edit_item'           => __( 'Edit publication', 'tufts-cpm' ),
			'view_item'           => __( 'View publication', 'tufts-cpm' ),
			'search_items'        => __( 'Search publications', 'tufts-cpm' ),
			'not_found'           => __( 'No publications found', 'tufts-cpm' ),
			'not_found_in_trash'  => __( 'No publications found in trash', 'tufts-cpm' ),
			'parent_item_colon'   => __( 'Parent publication', 'tufts-cpm' ),
			'menu_name'           => __( 'Publications', 'tufts-cpm' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'custom-fields' ),
		'has_archive'       => false,
		'rewrite'           => array( 'slug' => 'publications', 'with_front' => TRUE ),
		'query_var'         => true,
		'menu_icon'         => 'dashicons-book',
		'show_in_rest'      => true,
		'rest_base'         => 'publication',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'publication_init' );

function publication_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['publication'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Publication updated. <a target="_blank" href="%s">View publication</a>', 'tufts-cpm'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'tufts-cpm'),
		3 => __('Custom field deleted.', 'tufts-cpm'),
		4 => __('Publication updated.', 'tufts-cpm'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Publication restored to revision from %s', 'tufts-cpm'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Publication published. <a href="%s">View publication</a>', 'tufts-cpm'), esc_url( $permalink ) ),
		7 => __('Publication saved.', 'tufts-cpm'),
		8 => sprintf( __('Publication submitted. <a target="_blank" href="%s">Preview publication</a>', 'tufts-cpm'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Publication scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview publication</a>', 'tufts-cpm'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Publication draft updated. <a target="_blank" href="%s">Preview publication</a>', 'tufts-cpm'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'publication_updated_messages' );
