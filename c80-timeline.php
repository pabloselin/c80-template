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

<div class="fixedtoplogo hidden-xs">
	<a title="<?php bloginfo('name');?>" href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/assets/img/c80_logo_blanco.svg" alt="<?php bloginfo('name');?>"></a>
</div>

	<div id="main-timeline" class="container-fluid">
		
		<section class="timeline-presentation" id="inicio" style="background-image: url(<?php echo $image[0];?>);">
			<div class="content-wrap">
				<div class="intro-stuff">
					<div class="text-header">
						<h1><?php the_title();?></h1>
					</div>
					<div class="text-content">
						<div class="content">
							<?php the_content();?>
						</div>
						
					</div>
				</div>

			</div>
			
			<div class="intro-indicator">
				
				<a href="#<?php echo c80_faselink($fases[0], false);?>" class="intro-arrow" title="Comenzar">
					
					<i class="fa fa-angle-down"></i>
					<p>comenzar</p>
				</a>
			</div>
	



		</section>
		
		<?php foreach($fases as $key=>$curfase) {
			$next = (isset($fases[$key+1]))? $fases[$key+1] : false;
			c80_presentacion_fase($curfase, $next);
		}?>
		
	</div>

	<div id="timeline-active">
	
	<!-- <span class="closetimeline visible-xs">
		<i class="fa fa-times"></i>
	</span> -->

	<div id="timeline-js-container">
		<!-- here goes the timeline lol -->
	</div>
	
	<?php 
	$id = 'inside-timeline-nav';
	include( locate_template( 'partials/timeline-nav.php', false, false ) );
	?>

	</div>
	
	<?php 
	$id = 'timeline-nav';
	include( locate_template( 'partials/timeline-nav.php', false, false ) );
	?>

	<?php
	get_footer('timeline');
	?>