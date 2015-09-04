<?php 
//standard index para vista de artículos y capitulos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php get_sidebar('articulos');?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
			if($post->post_parent == 0) {
				//es capitulo
				get_template_part( 'partials/vista', 'capitulo' );
			} else {
				//es articulo
				echo c80t_template_loader( 'partials/vista-articulo', array('en_capitulo' => false) );
			}?>
		
			<?php endwhile; ?>
			<!-- post navigation -->

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
			
			</div>
		
		<?php endif; ?>

	</section>
</div>

<?php
	get_footer();
?>