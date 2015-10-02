<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('partials/aside', 'c80rel');?>
		<article class="columna-estandar deslizable">
		
			<div class="pad">
				<header>
					<div class="top-meta">
						
						<p class="categoria">
							<?php the_category(', ');?>
						</p>
						
						<p class="fecha">
							<?php the_time(get_option('date_format'));?>
						</p>
						
						<p class="related">
							<?php echo c80t_relink($post->ID);?>
						</p>	
					</div>

					<?php if(has_post_thumbnail( )):?>
						<?php the_post_thumbnail( 'main' );?>
					<?php endif;?>	
					<h1><?php the_title();?></h1>
						
				</header>
					
				<div class="contenido">
					
					<p class="autor">
						Por: <?php the_author( );?>
					</p>

					<div class="excerpt">
						<?php the_excerpt();?>
					</div>	

					<?php the_content();?>
						
				</div>
			</div>
		
		</article>
		
			<?php endwhile; ?>

			<?php get_sidebar('relacionados');?>

			<!-- comments -->
				<?php comments_template();?>

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