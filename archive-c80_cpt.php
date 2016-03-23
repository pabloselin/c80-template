<?php 
//standard archive para constitución
	get_header();
?>

<div id="main" class="container">
	
	<div class="row-constitucion">
		
		<section class="contenedor-constitucion-box">
		<h1 class="mainc80title"><i class="fa fa-book"></i> Constitución Política de la República de Chile (1980)</h1>
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
		
				get_template_part( 'partials/vista', 'capitulo-box' );
				
			?>
		
			<?php endwhile;?>
		</section>
	</div>
	<?php get_template_part( 'partials/fuente' );?>
</div>

<?php
	get_footer();
?>