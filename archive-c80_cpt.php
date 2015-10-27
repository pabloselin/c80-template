<?php 
//standard archive para constitución
	get_header();
?>

<div id="main" class="container">
	
	<div class="row-constitucion">
		<div class="navegador-c80" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
			<?php echo c80t_articulos();?>	
		</div>
		
		<section class="contenedor-constitucion">
		
			<?php 
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'c80_cpt',
				'post_parent' => 0,
				'orderby' => 'menu_order',
				'order' => 'ASC'
				);
			$archivequery = new WP_Query($args);
			while($archivequery->have_posts()): $archivequery->the_post();
		
				get_template_part( 'partials/vista', 'capitulo' );
				
			?>
		
			<?php endwhile;?>
		
		</section>
	</div>
</div>

<?php
	get_footer();
?>