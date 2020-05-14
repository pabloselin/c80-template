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

<div class="fixedtoplogo <?php echo(empty($fase) ? 'timeline-home' : 'timeline-inside');?> <?php echo(empty($started) ? 'not-started' : 'started');?>">
	<a title="<?php bloginfo('name');?>" href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/assets/img/c80_logo_blanco.svg" alt="<?php bloginfo('name');?>"></a>
</div>

<?php if(!$fase):?>

	<div id="main-timeline" class="container-fluid" style="background-image: url(<?php echo $image[0];?>);">
		<section class="timeline-presentation">
			<div class="content-wrap">
				<div class="text-content">
					<h1><?php the_title();?></h1>
					<div class="content">
						<?php the_content();?>
					</div>
					<div class="scrollind">
						Haz scroll para explorar cronológicamente
					</div>
				</div>

			</div>





		</section>
		<div class="fases-presentadas">
			<?php foreach($fases as $curfase) {
				c80_presentacion_fase($curfase);
			}?>
		</div>
	</div>

	<?php get_template_part('partials/timeline-nav');?>

	<?php else: ?>

		<?php get_template_part('partials/timeline-fase');?>

	<?php endif;?>

	<?php
	get_footer('timeline');
	?>