<?php
//content stuff

function c80t_articulos() {
	//Devuelve un listado de los artículos del tipo de post de constitución
	
	//Primer nivel
	$args = array(
		'post_type' => 'c80_cpt',
		'numberposts' => 100,
		'post_parent' => 0
		);

	$capitulos = get_posts($args);
	
	$items = '';
	$capitems = '';	

	foreach($capitulos as $capitulo) {

		$capitems .= '<a class="capitulo-lista" href="'.get_permalink($capitulo->ID).'">'.$capitulo->post_title.'</a>';

		//Segundo nivel
		$args = array(
			'post_type' => 'c80_cpt',
			'numberposts' => 100,
			'post_parent' => $capitulo->ID,
			'order_by' => 'menu_order',
			'order' => 'ASC'
			);
		
		$articulos = get_posts($args);
		
		$artitems = '';
		
		foreach($articulos as $articulo) {
			$artitems .= '<li><a href="' . get_permalink($articulo->ID) . '" class="articulo-lista">' . $articulo->post_title . '</a></li>';
		}

		$items .= '<li>' . $capitems .  '<ul>' . $artitems . '</ul></li>';
	
	}

	$output = '<ul>' . $items . '</ul>';

	return $output;
}

function c80t_capitulos() {

}

function c80t_parentname($postid, $en_capitulo = false) {
	$ancestors = get_post_ancestors( $postid );
	if($ancestors && !$en_capitulo) {
		$name = get_the_title($ancestors[0]) . ' <i class="fa fa-caret-right"></i> ';
		return $name;	
	}	
}

function c80t_template_loader($template, $data) {
	/**
	 * Cargador de plantillas incluyendo variables
	 */

	ob_start();
	
	extract($data);
	
	include( locate_template( sprintf('%s.php', $template) ) );

	return ob_get_clean();

}

function c80t_run_frontpage() {
	/**
	 * Crea un loop para los menús
	 */
	$items = c80t_getmenus('portada');
	//si tengo items creo un arreglo con los ids
	if($items) {
		foreach($items as $item) {
			$ids[] = $item->object_id;
		}
	
	$args = array(
		'post__in' => $ids
		);
	$query = new WP_Query($args);
	return $query;
	}
}

function c80t_getmenus($menu) {
	/**
	 * Obtiene items de un objeto de menú
	 */
		$menuobject = c80t_getmenuobject($menu);
		if($menuobject) {
		//Si tengo un objeto menú me devuelve el objeto y empiezo a recolectar items
			$items = wp_get_nav_menu_items( $menuobject->term_id );
			return $items;
		} else {
			//Si no hay hago un llamado independiente por sección
			return false;
		}
}

function c80t_getmenuobject($location) {
	/**
	 * Obtiene el menú desde una ubicación escogida
	 */
	if( ( $locations = get_nav_menu_locations() ) && isset($locations[$location]) ){
		$menu = wp_get_nav_menu_object( $locations[$location] );
		return $menu;
	} else {
		return false;
	}
}