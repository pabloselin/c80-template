<?php
// Register Custom Post Type
function c80t_columnas() {

	$labels = array(
		'name'                => _x( 'Columnas', 'Post Type General Name', 'c80t' ),
		'singular_name'       => _x( 'Columna', 'Post Type Singular Name', 'c80t' ),
		'menu_name'           => __( 'Columnas', 'c80t' ),
		'name_admin_bar'      => __( 'Columnas', 'c80t' ),
		'parent_item_colon'   => __( 'Columna superior', 'c80t' ),
		'all_items'           => __( 'Todas las columnas', 'c80t' ),
		'add_new_item'        => __( 'Añadir nueva columna', 'c80t' ),
		'add_new'             => __( 'Añadir nueva', 'c80t' ),
		'new_item'            => __( 'Nueva columna', 'c80t' ),
		'edit_item'           => __( 'Editar columna', 'c80t' ),
		'update_item'         => __( 'Actualizar columna', 'c80t' ),
		'view_item'           => __( 'Ver columna', 'c80t' ),
		'search_items'        => __( 'Buscar columna', 'c80t' ),
		'not_found'           => __( 'No encontrado', 'c80t' ),
		'not_found_in_trash'  => __( 'No encontrado en papelera', 'c80t' ),
	);
	$args = array(
		'label'               => __( 'Columna', 'c80t' ),
		'description'         => __( 'Columnas', 'c80t' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'columnas', $args );

}
add_action( 'init', 'c80t_columnas', 0 );

// Register Custom Post Type
function c80t_mitos_sabias_que() {

	$labels = array(
		'name'                => _x( 'Mitos / Sabías que', 'Post Type General Name', 'c80t' ),
		'singular_name'       => _x( 'Mito / Sabías que', 'Post Type Singular Name', 'c80t' ),
		'menu_name'           => __( 'Mitos / Sabías que', 'c80t' ),
		'name_admin_bar'      => __( 'Mitos / Sabías que', 'c80t' ),
		'parent_item_colon'   => __( 'Mito / Sabías que superior', 'c80t' ),
		'all_items'           => __( 'Todos los mitos / sabías que', 'c80t' ),
		'add_new_item'        => __( 'Añadir nuevo mito / sabías que', 'c80t' ),
		'add_new'             => __( 'Añadir nueva', 'c80t' ),
		'new_item'            => __( 'Nuevo mito / sabías que', 'c80t' ),
		'edit_item'           => __( 'Editar mito / sabías que', 'c80t' ),
		'update_item'         => __( 'Actualizar mito / sabías que', 'c80t' ),
		'view_item'           => __( 'Ver mito / sabías que', 'c80t' ),
		'search_items'        => __( 'Buscar mito / sabías que', 'c80t' ),
		'not_found'           => __( 'No encontrado', 'c80t' ),
		'not_found_in_trash'  => __( 'No encontrado en papelera', 'c80t' ),
	);
	$args = array(
		'label'               => __( 'mito-sabias-que', 'c80t' ),
		'description'         => __( 'mitos-sabias-que', 'c80t' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'			  => array('slug' => 'sabias-que')
	);
	register_post_type( 'mitos-sabias-que', $args );

}
add_action( 'init', 'c80t_mitos_sabias_que', 0 );

// Register Custom Post Type
function c80t_hitos() {

	$labels = array(
		'name'                => _x( 'Hitos', 'Post Type General Name', 'c80t' ),
		'singular_name'       => _x( 'Hito', 'Post Type Singular Name', 'c80t' ),
		'menu_name'           => __( 'Hitos', 'c80t' ),
		'name_admin_bar'      => __( 'Hitos', 'c80t' ),
		'parent_item_colon'   => __( 'Hito superior', 'c80t' ),
		'all_items'           => __( 'Todos los hitos', 'c80t' ),
		'add_new_item'        => __( 'Añadir nuevo hito', 'c80t' ),
		'add_new'             => __( 'Añadir nueva', 'c80t' ),
		'new_item'            => __( 'Nuevo hito', 'c80t' ),
		'edit_item'           => __( 'Editar hito', 'c80t' ),
		'update_item'         => __( 'Actualizar hito', 'c80t' ),
		'view_item'           => __( 'Ver hito', 'c80t' ),
		'search_items'        => __( 'Buscar hito', 'c80t' ),
		'not_found'           => __( 'No encontrado', 'c80t' ),
		'not_found_in_trash'  => __( 'No encontrado en papelera', 'c80t' ),
	);
	$args = array(
		'label'               => __( 'hito', 'c80t' ),
		'description'         => __( 'hitos', 'c80t' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'			  => array('slug' => 'sabias-que')
	);
	register_post_type( 'hitos', $args );

}
add_action( 'init', 'c80t_hitos', 0 );