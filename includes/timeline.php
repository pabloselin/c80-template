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

	$hitos = get_posts($args);

	if($hitos):
		foreach($hitos as $hito):

			$start_date_field 	= get_post_meta( $hito->ID, 'c80_tl_start_date', true );
			$end_date_field 	= get_post_meta( $hito->ID, 'c80_tl_end_date', true );
			$media_field		= get_the_post_thumbnail_url( $hito->ID, 'medium' );

			$start_date 		= parse_field_date_for_json( $start_date_field, $yearonly );
			
			if($end_date_field):
				$end_date 			= parse_field_date_for_json( $end_date_field, $yearonly );
			endif;

			$event = array(
				'text' => array(
							'headline' 	=> $hito->post_title,
							'text'		=> apply_filters( 'post_content', $hito->post_content )
							),
				'start_date' => $start_date
			);
			//Main fields
			

			//Optional fields

			if($end_date_field):
				$event['end_date'] = $end_date;
			endif;


			if($media_field):
				$event['media']['url'] = $media_field;
			endif;	

			array_push($json['events'], $event);			
			
		endforeach;
	endif;

	return $json;
}

function parse_field_date_for_json( $datestring, $yearonly = false ) {
	$date_processed = date_create_from_format("d/m/Y", $datestring);
	
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