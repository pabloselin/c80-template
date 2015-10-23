<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<article class="columna-estandar">
		
			<div class="pad">
				<header>

					<?php echo c80t_avatar(160);?>

					<div class="info-columna">
						<div class="top-meta">
							<?php the_category( ', ' );?> |	<?php the_time( get_option( 'date_format' ) );?>
						</div>
						<h1><?php the_title();?></h1>
						<p class="autor">
							<?php the_author( );?>
						</p>
					</div>
					
				</header>
					
				<div class="contenido">
					
					<div class="excerpt">
						<?php the_excerpt();?>
					</div>	

					<p class="related">
						<?php echo c80t_relink($post->ID);?>
					</p>	
					<p class="temas">
						<?php the_tags( '<span class="nrel"><i class="fa fa-tags"></i> </span>', ' ' );?>
					</p>	

					<?php the_content();?>
						
				</div>
			</div>
		
		</article>
		
			<?php endwhile; ?>

			<?php get_template_part('partials/aside', 'c80rel');?>

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