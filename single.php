<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article class="articulo-estandar">
		
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
									<a href="#">
										<i class="fa fa-file-text-o"></i>
									</a>
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
			<!-- post navigation -->

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
			
			</div>
		
		<?php endif; ?>
		
		<?php get_sidebar('relacionados');?>

	</section>
</div>

<?php
	get_footer();
?>