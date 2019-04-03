<?php

function mesh_terms_init() {
	register_taxonomy( 'mesh-terms', array( 'cpm-registry' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Mesh terms', 'tufts-cpm' ),
			'singular_name'              => _x( 'Mesh terms', 'taxonomy general name', 'tufts-cpm' ),
			'search_items'               => __( 'Search mesh terms', 'tufts-cpm' ),
			'popular_items'              => __( 'Popular mesh terms', 'tufts-cpm' ),
			'all_items'                  => __( 'All mesh terms', 'tufts-cpm' ),
			'parent_item'                => __( 'Parent mesh terms', 'tufts-cpm' ),
			'parent_item_colon'          => __( 'Parent mesh terms:', 'tufts-cpm' ),
			'edit_item'                  => __( 'Edit mesh terms', 'tufts-cpm' ),
			'update_item'                => __( 'Update mesh terms', 'tufts-cpm' ),
			'add_new_item'               => __( 'New mesh terms', 'tufts-cpm' ),
			'new_item_name'              => __( 'New mesh terms', 'tufts-cpm' ),
			'separate_items_with_commas' => __( 'Mesh terms separated by comma', 'tufts-cpm' ),
			'add_or_remove_items'        => __( 'Add or remove mesh terms', 'tufts-cpm' ),
			'choose_from_most_used'      => __( 'Choose from the most used mesh terms', 'tufts-cpm' ),
			'not_found'                  => __( 'No mesh terms found.', 'tufts-cpm' ),
			'menu_name'                  => __( 'Mesh terms', 'tufts-cpm' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'mesh-terms',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'mesh_terms_init' );
