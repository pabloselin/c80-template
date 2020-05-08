<?php 
// Timeline related functions
// Custom ajax calls

function c80_get_main_timeline_events( WP_REST_Request $request ) {
	$json = [];
	$json['events'] = [];
	
		$args = array(
			'post_type' 	=> 'hitos',
			'numberposts' 	=> -1
		);

	$hitos = array();
	
	$options = get_option('c80_timeline_options');

	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');

	foreach($fases as $fase) {
		$hito_start = $options['hito_inicial_' . $fase];
		$hito_end = $options['hito_final_' . $fase];

		$fecha_start = get_post_meta($hito_start, 'c80_lt_start_date', true);
		$fecha_end = get_post_meta($hito_end, 'c80_lt_start_date', true);
		
		$range = array(
			'post_type' => 'hitos',
			'numberposts' => -1,
			'meta_query' => array(
				array(
					'key' 		=> 'c80_lt_start_date',
					'value' 	=> array($fecha_start, $fecha_end),
					'compare' 	=> 'BETWEEN'
				),
			)
		);

		$hitos_posts = get_posts($range);

		if($hitos_posts) {
			foreach($hitos_posts as $hito_post) {
				$hitos[$fase]['events'][] = c80_prepare_hito($hito_post->ID, $hito_post->post_title, $hito_post->post_content);
			}
		}
	}

	return $hitos;
}

function c80_prepare_hito( $hitoid, $hitotitle, $hitocontent ) {

			$start_date_field 	= get_post_meta( $hitoid, 'c80_lt_start_date', true );
			$end_date_field 	= get_post_meta( $hitoid, 'c80_lt_end_date', true );
			$media_field		= get_the_post_thumbnail_url( $hitoid, 'medium' );

			$start_date 		= parse_field_date_for_json( $start_date_field );
			$grupo 				= get_the_terms( $hitoid, 'tipo_hito' );

			if($grupo) {
				$grupoid = $grupo[0]->slug;
			}
			
			if($end_date_field):
				$end_date 			= parse_field_date_for_json( $end_date_field );
			endif;

			$mediatype = get_post_meta($hitoid, 'c80_lt_media_type', true);

			if($mediatype == 'doc' || $mediatype == 'html') {
				$hitocontent .= '<p><a target="_blank" href="' . get_post_meta($hitoid, 'c80_lt_media', true) .'">[+]</a></p>';
			}

			$event = array(
				'text' => array(
							'headline' 	=> $hitotitle,
							'text'		=> apply_filters( 'post_content', $hitocontent ),
							),
				'start_date' => $start_date,
				'group'		=> $grupo[0]->name,
				'evclass'	=> $grupoid
			);
			//Main fields
			

			//Optional fields

			if($end_date_field):
				$event['end_date'] = $end_date;
			endif;
			

			if($mediatype == 'jpg') {
				if(has_post_thumbnail( $hitoid)):
					$event['media']['url'] = get_the_post_thumbnail_url( $hitoid, 'medium' );
					$event['media']['caption'] = get_post_meta($hitoid, 'c80_lt_media_caption', true);
					$event['media']['credit'] = get_post_meta($hitoid, 'c80_lt_media_credit', true);
				endif;	
			} elseif($mediatype == 'video') {
					$event['media']['url'] = get_post_meta($hitoid, 'c80_lt_media', true);
					$event['media']['caption'] = get_post_meta($hitoid, 'c80_lt_media_caption', true);
					$event['media']['credit'] = get_post_meta($hitoid, 'c80_lt_media_credit', true);
			}

			


			return $event;
}

function parse_field_date_for_json( $datestring, $yearonly = false ) {
	$date_processed = date_create_from_format("Y-m-d", $datestring);
	
	if($date_processed !== false) {
	
		$date_sorted 	= array(
								'year' 	=> $date_processed->format('Y'),
								'month'	=> $date_processed->format('m'),
								'day'	=> $date_processed->format('d')
							);

		return $date_sorted;
	}
}

add_action( 'rest_api_init', 'c80_timeline_endpoint');

function c80_timeline_endpoint() {
	register_rest_route('constitucion1980/v1/', '/linea-de-tiempo/', array(
			'methods' => 'GET',
			'callback' => 'c80_get_main_timeline_events'
			)
		);
}

add_filter( 'query_vars', 'c80_timeline_queryvars' );

function c80_timeline_queryvars($vars) {
	$vars[] = 'fase';
	$vars[] = 'timeline';
	$vars[] = 'started';
	return $vars;
}

/**
 * Hook in and register a submenu options page for the Page post-type menu.
 */
function c80_register_options_submenu_for_page_post_type() {

	/**
	 * Registers options page menu item and form.
	 */
	$cmb = new_cmb2_box( array(
		'id'           => 'c80_options_submenu_page',
		'title'        => esc_html__( 'Opciones línea de tiempo', 'cmb2' ),
		'object_types' => array( 'options-page' ),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'c80_timeline_options', // The option key and admin menu page slug.
		// 'icon_url'        => '', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		'parent_slug'     => 'edit.php?post_type=hitos', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'      => 'c80_options_page_message_callback',
	) );

	$args = array(
		'post_type' => 'hitos',
		'numberposts' => -1
	);

	$hitos = get_posts($args);
	$hitos_options = array();
	
	foreach($hitos as $hito) {
		$fecha = get_post_meta($hito->ID, 'c80_lt_start_date', true);
		$hitos_options[$hito->ID] = '[' . $fecha . '] ' . $hito->post_title;
	}

	$fases = array(
		'fase_1' => 'Fase 1',
		'fase_2' => 'Fase 2',
		'fase_3' => 'Fase 3',
		'fase_4' => 'Fase 4',
		'fase_5' => 'Fase 5'
	);

	foreach($fases as $key=>$fase) {
		$cmb->add_field( array(
		'name' => __( 'Título ' . $fase, 'c80' ),
		'id' => 'titulo_' . $key,
		'type' => 'text'
		) );

		$cmb->add_field( array(
			'name' => __( 'Texto introducción ' . $fase , 'c80' ),
			'id' => 'intro_' . $key,
			'type' => 'textarea'
		) );

		$cmb->add_field( array(
			'name' => __( 'Imagen ' . $fase, 'c80' ),
			'id' => 'imagen_' . $key,
			'type' => 'file'
		) );

		$cmb->add_field( array(
			'name' => __( 'Hito inicial ' . $fase, 'c80' ),
			'id' => 'hito_inicial_' . $key,
			'type' => 'select',
			'options' => $hitos_options,
		) );

		$cmb->add_field( array(
			'name' => __( 'Hito final ' . $fase, 'c80' ),
			'id' => 'hito_final_' . $key,
			'type' => 'select',
			'options' => $hitos_options,
		) );
	}

}


add_action( 'cmb2_admin_init', 'c80_register_options_submenu_for_page_post_type' );

/**
 * Hook in and register a submenu options page for the Appearance menu.
 */
function c80_register_options_submenu_appearance_menu() {

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'           => 'c80_options_submenu_appearance_menu',
		'title'        => esc_html__( 'Appearance Options', 'cmb2' ),
		'object_types' => array( 'options-page' ),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'c80_theme_appearance_options', // The option key and admin menu page slug.
		// 'icon_url'        => '', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'      => 'c80_options_page_message_callback',
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}
add_action( 'cmb2_admin_init', 'c80_register_options_submenu_appearance_menu' );


function c80_presentacion_fase($fase) {
	global $post;
	$fasestart = parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $fase], 'c80_lt_start_date', true));
	$faseend = parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $fase], 'c80_lt_start_date', true));
	$timeline_options = get_option('c80_timeline_options');

	?>
	
	<section id="<?php echo $fase;?>" class="presentacion-fase" style="background-image: url(<?php echo $timeline_options['imagen_' . $fase];?>);">
	<div class="content-wrap">
		<div class="text-content">
			<h2><?php echo $timeline_options['titulo_' . $fase];?></h2>
			<h3><?php echo $fasestart['year'] . '-' . $faseend['year'];?></h3>
			<div class="fase-intro">
				<?php echo apply_filters( 'the_content', $timeline_options['intro_' . $fase] );?>
			</div>
			<p><a href="<?php echo add_query_arg( array('fase' => $fase, 'started' => true ), get_permalink($post->ID) );?>" class="btn btn-enter-timeline" data-fase="<?php echo $fase;?>">Entrar</a></p>
		</div>
	</div>
	</section>

	<?php
}