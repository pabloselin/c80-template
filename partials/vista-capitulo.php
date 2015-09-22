<article class="capitulo-constitucion">
	<header>
		<h1><i class="fa fa-book"></i> <?php the_title();?></h1>
	</header>	
		<?php 
			$args = array(
				'post_type' => 'c80_cpt',
				'numberposts' => 100,
				'posts_per_page' => 100,
				'post_parent' => $post->ID,
				'order_by' => 'menu_order',
				'order' => 'ASC'
				);
			
			
			$articulos = new WP_Query( $args );

			if ( $articulos->have_posts() ) : ?>
				<div class="articulos-capitulo">
				<?php while ( $articulos->have_posts() ) : $articulos->the_post();

						echo c80t_template_loader( 'partials/vista-articulo', array('en_capitulo' => true) );
						//get_template_part('partials/vista', 'articulo');
						?>

				<!-- post -->
				<?php endwhile; ?>
				<!-- post navigation -->
				</div><!--fin #articulos-capitulo-->
				<?php else: ?>
				<!-- no posts found -->
				<p>No se encontraron contenidos.</p>
				<?php endif;
					wp_reset_postdata();
			 		?>
	
</article>