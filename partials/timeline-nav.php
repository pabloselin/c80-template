<?php 
	$timeline = get_query_var('timeline');
	$fase = get_query_var('fase');
	$imageid = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $imageid, 'full', false );
	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');
	$fasedata = array();
	$timeline_options = get_option('c80_timeline_options');
?>

	<div class="fases-nav-home <?php echo (!empty($fase)? 'in-timeline' : 'in-home');?>">
		<div class="fases-main">
			<?php 
			foreach($fases as $faseitem) {
				$link = (!empty($fase) ? add_query_arg( array('fase' => $faseitem ), get_permalink($post->ID)) : '#' . $faseitem );
				$fasedata[$faseitem] = array(
					'title' => $timeline_options['titulo_' . $faseitem],
					'start' => parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $faseitem], 'c80_lt_start_date', true)),
					'end'	=> parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $faseitem], 'c80_lt_start_date', true)),
				);


				?>

				<div class="fase-arrow" id="fase-nav-id<?php echo $fase;?>">
					<a href="<?php echo $link;?>">
					<h1><?php echo $fasedata[$faseitem]['start']['year'];?> <span class="hyphen">-</span> <?php echo $fasedata[$faseitem]['end']['year'];?></h1>
					<h2><?php echo $fasedata[$faseitem]['title'];?></h2>
						<?php if(!empty($fase)):?>
							<img src="<?php bloginfo('template_url');?>/assets/img/tl/arrow_down_black.svg" alt="">
						<?php else:?>
							<img src="<?php bloginfo('template_url');?>/assets/img/tl/arrow_down.svg" alt="">
						<?php endif;?>
					</a>
				</div>

				<?php

			}



			?>
		</div>
	</div>