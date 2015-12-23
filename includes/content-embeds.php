<?php
/**
 * Funciones para los embeds en sitios externos
 */





/**
 * Estilos y acciones para cabecera de los embeds
 */

add_action( 'embed_head', 'c80t_embedstyles');

function c80t_embedstyles() {

	wp_dequeue_style( 'open-sans' );

	?>
	<style>
		<?php include(TEMPLATEPATH . '/assets/css/c80-embeds.css');?>
	</style>	
	<?php
}


/**
 * Título para el Footer del Embed
 */

add_filter('embed_site_title_html', 'c80t_sitetitle');

function c80t_sitetitle($site_title) {
	global $post;
	$site_title = '<a class="embed-footer-title" href="'.get_bloginfo('url') .'">';
	$site_title .= '<img src="' . get_site_icon_url(64) . '" alt="' . get_bloginfo('name') . '">';
	$site_title .= get_bloginfo('name') . ' - ' . get_bloginfo('description');
	$site_title .= '</a>';
	$site_title .= '<p class="c80-embedcap">' . c80t_parentname($post->ID) . '</p>';
	return $site_title;
}

/**
 * Reemplazar ícono para compartir
 * Sacar acción por defecto primero
 */

remove_action( 'embed_content_meta', 'print_embed_sharing_button' );

add_action( 'embed_content_meta', 'c80t_print_embed_sharing_button' );

function c80t_print_embed_sharing_button() {
	if ( is_404() ) {
		return;
	}
	?>
	<div class="wp-embed-share">
		<button type="button" class="wp-embed-share-dialog-open" aria-label="<?php esc_attr_e( 'Open sharing dialog' ); ?>">
			<i class="fa fa-share"></i>	<?php esc_attr_e( 'Compartir / Insertar ');?>
		</button>
	</div>
	<?php
}

/**
 * Añadir relacionados después del excerpt
 */
function c80t_afterexcerpt($excerpt) {
	global $post;
	if(get_post_type() != 'c80_cpt') {
		$relinks = c80t_relink($post->ID);	
		echo $relinks;
	}
}

add_action('embed_content', 'c80t_afterexcerpt');

/**
 * Filtrar excerpt de artículos de la constitución
 */

add_filter('the_excerpt_embed', 'c80t_artexcerpt');

function c80t_artexcerpt($excerpt) {
	global $post;
	if(get_post_type($post) == 'c80_cpt') {
		$output = '<div class="embed-c80">' . apply_filters('the_content', get_the_content()) . '</div>';
	} else {
		$output = get_the_excerpt();
	}

	return $output;
}