<?php
/**
 * Funciones de Ajax y contenido cargado en paralelo.
 */

function c80t_footerconst() {
	/**
	 * Carga un footer especial para llamar a cualquier contenido de la constitución
	 */
	$html = '<div class="cargador-articulos enabled"></div>';
	echo $html;
}

//add_action('wp_footer', 'c80t_footerconst');

function c80t_constquery() {
	/**
	 * Query para todos los artículos de la constitución, por capítulo y ordenados
	 */
	//Devuelve un listado de los artículos del tipo de post de constitución
	
	//Primer nivel
	$args = array(
		'post_type' => 'c80_cpt',
		'numberposts' => 100,
		'post_parent' => 0,
		'order_by' => 'menu_order',
		'order' => 'ASC'
		);

	$capitulos = get_posts($args);
	
	$items = '';
	

	foreach($capitulos as $capitulo) {
		$capitems = '';
		$capsub = get_post_meta($capitulo->ID, 'c80_subtartcap', true);		
		$capitems .= '<h3>' . $capitulo->post_title .': ' . $capsub . '</h3>';

		//Segundo nivel
		$args = array(
			'post_type' => 'c80_cpt',
			'numberposts' => 100,
			'post_parent' => $capitulo->ID,
			'order_by' => 'menu_order',
			'order' => 'ASC'
			);
		
		$articulos = new WP_Query($args);
		
		$artitems = '';
		while($articulos->have_posts()): $articulos->the_post();
			$content = apply_filters( 'the_content', get_the_content() );
			$artitems .= '<li><h4><a href="' . get_permalink($articulos->ID) . '" class="articulo-lista">' . get_the_title() . '</a></h4><div class="lc">' . $content . '</div></li>';
		endwhile;
		wp_reset_postdata();

		$items .= '<li>' . $capitems .  '<ul>' . $artitems . '</ul></li>';
	
	}

	$output = '<ul>' . $items . '</ul>';

	return $output;
}


function c80t_capquery($capid) {
	/**
	 * Query para cargar un solo capítulo
	 */
	$args = array(
			'post__in' => $capid,
			'order_by' => 'menu_order',
			'order' => 'ASC'
			);
		$archivequery = new WP_Query($args);
		return $archivequery;
}

function c80t_relink($postid) {
	$relink = '<a data-toggle="tooltip" data-placement="left" class="showC80Rel" href="#" title="' . c80t_countrels($postid) . ' artículos relacionados.">';
	$relink .= '<i class="fa fa-file-text-o"></i></a>';
	return $relink;
}

function c80t_artquery($artid) {
		$args = array(
			'p' => $artid,
			'post_type' => 'c80_cpt'
			);
		$archivequery = new WP_Query($args);
		//var_dump($archivequery);
		$artitems = '';
		while( $archivequery->have_posts() ): $archivequery->the_post();
			$content = apply_filters( 'the_content', get_the_content() );
			$title = c80t_parentname($archivequery->ID) . get_the_title();
			$artitems .= '<div class="constarticle">';
			$artitems .= '<h4>' . $title . '</h4><div class="lc">' . $content . '</div></div>';
		endwhile;	
		wp_reset_postdata();
		return $artitems;
}

function c80t_countrels($postid) {
	/**
	 * Devuelve el número de artículos relacionados
	 */
	$rels = rwmb_meta('c80_artrel', 'multiple=true', $postid);

	return( count($rels) );
}