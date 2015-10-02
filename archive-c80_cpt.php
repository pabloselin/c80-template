<?php 
//standard archive para constitución
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		<?php 
		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'c80_cpt',
			'post_parent' => 0,
			'order_by' => 'menu_order',
			'order' => 'ASC'
			);
		$archivequery = new WP_Query($args);
		while($archivequery->have_posts()): $archivequery->the_post();

			get_template_part( 'partials/vista', 'capitulo' );
			
		?>

		<?php endwhile;?>

	</section>
</div>

<?php
	get_footer();
?>