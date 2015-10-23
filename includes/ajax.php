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
	 * Devuelve un listado de los artículos del tipo de post de constitución
	 * TODO: Hacer que tome también los contenidos de tercer nivel
	 */
	
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
			$artitems .= '<li><h4><a href="' . get_permalink($articulos->ID) . '" class="articulo-lista"><i class="fa fa-file-text-o"></i> ' . get_the_title() . '</a></h4><div class="lc">' . $content . '</div></li>';

			/**
			 * Busco elementos de tercer nivel
			 */
			$args = array(
				'post_type' => 'c80_cpt',
				'numberposts' => 100,
				'post_parent' => $articulos->ID,
				'order_by' => 'menu_order',
				'order' => 'ASC'
				);
			$subcap = new WP_Query($args);
			if($subcap->have_posts()):
				while($subcap->have_posts()): $subcap->the_post();
					$subcontent = apply_filters( 'the_content', get_the_content() );
					$subitems .= '<li><h4><a href="' . get_permalink($subcap->ID) . '">' . get_the_title() . '</h4><div class="lc">' . $subcontent . '</div></li>';
				endwhile;
				wp_reset_postdata();
			endif;

		endwhile;
		wp_reset_postdata();

		$items .= '<li>' . $capitems .  '<ul>' . $artitems . $subitems . '</ul></li>';
	
	}

	$link = '<a href="' . get_post_type_archive_link( 'c80_cpt' ) . '"><i class="fa fa-book"></i> ver texto completo</a>';
	$output = '<p>' . $link . '</p><ul>' . $items . '</ul>';

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
	$nrel = c80t_countrels($postid);
	$rels = c80t_rels($postid);
	$relink = '<div class="relbox">';
	$relink .= '<p class="hrel"><span class="nrel"><i class="fa fa-book"></i> ' . $nrel. '</span>';
	foreach($rels as $rel) {
		$title = str_replace('Artículo' , 'Art.', get_the_title($rel) );
		$capinfo = c80t_parentname($rel); 
		$relink .= '<a data-toggle="tooltip" data-placement="bottom" class="relart" title="' . $capinfo . '" href="#art-'. $rel . '" class="inpagelink"><span><i class="fa fa-file-text-o"></i> ' . $title . '</span></a>';
	}
	$relink .= '</p></div>';
	return $relink;
}

function c80t_relfoot($postid) {
	$nlinks = c80t_countrels($postid);
	$relink = '<a class="showC80Rel" href="#" title="' . c80t_countrels($postid) . ' artículos relacionados.">';
	$relink .= '<i class="fa fa-file-text-o"></i> <strong>' . $nlinks . '</strong> Artículos relacionados</a>';
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
			$title = c80t_parentname($archivequery->ID) . ': ' . c80t_captitle($archivequery->ID) . ' <i class="fa fa-caret-right"></i> ' .  get_the_title();
			$artlink = '<p><a href="' . get_permalink($artid) . '">( ir a artículo )</a></p>';
			$artitems .= '<div class="constarticle">';
			$artitems .= '<h4><a href="javascript:void(0);" name="art-'. $artid .'">' . $title . '</a></h4>' . $artlink . '<div class="lc">' . $content . '</div></div>';
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

function c80t_rels($postid) {
	/**
	 * Devuelve IDs de artículos relacionados
	 */
	$rels = rwmb_meta('c80_artrel', 'multiple=true', $postid);

	return $rels;
}

function c80t_list() {
	/**
	 * Devuelve un listado ordenado de todos los contenidos de constitución
	 */
}