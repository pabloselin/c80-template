<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article class="page">
		
			<div class="pad">
				<header>
					
					<h1><?php the_title();?></h1>
						
				</header>
						
				<div class="contenido">
						
					<?php the_content();?>
						
				</div>
			</div>
		
		</article>
		
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