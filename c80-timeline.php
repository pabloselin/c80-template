<?php 
/*
Template Name: Linea de tiempo
*/
?>

<?php 
	get_header('timeline');
	$timeline = get_query_var('timeline');
	$fase = get_query_var('fase');
	$imageid = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $imageid, 'full', false );
	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');
	$fasedata = array();
	$timeline_options = get_option('c80_timeline_options');
	
	
	
?>

<?php if(!$fase):?>

<div id="main-timeline" class="container-fluid" style="background-image: url(<?php echo $image[0];?>);">
	<section class="timeline-presentation">
		<div class="content-wrap">
			<div class="text-content">
				<h1><?php the_title();?></h1>
				<div class="content">
					<?php the_content();?>
				</div>
				<p class="aligncenter">
					<a href="<?php the_permalink();?>?fase=1" class="btn btn-enter-timeline">Entrar</a>
				</p>
			</div>

		</div>


	
		<div class="fases">
			<div class="fases-main">
				<?php 
					foreach($fases as $fase) {
					
						$fasedata[$fase] = array(
							'title' => $timeline_options['titulo_' . $fase],
							'start' => parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $fase], 'c80_lt_start_date', true)),
							'end'	=> parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $fase], 'c80_lt_start_date', true)),
							);


						?>

						<div class="fase-arrow <?php echo $fase;?>">
							<h1><?php echo $fasedata[$fase]['start']['year'];?> - <?php echo $fasedata[$fase]['end']['year'];?></h1>
							<h2><?php echo $fasedata[$fase]['title'];?></h2>
							<a href="<?php echo add_query_arg( array('fase' => $fase ), get_permalink($post->ID) );?>">
								<img src="<?php bloginfo('template_url');?>/assets/img/tl/arrow_down.svg" alt="">
							</a>
						</div>

						<?php

					 	}



				?>
			</div>
		</div>
		
	</section>
</div>

<?php else: ?>

	<?php get_template_part('partials/timeline-fase');?>

<?php endif;?>

<?php
	get_footer('timeline');
?>