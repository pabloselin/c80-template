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

					<div class="info-columna">
						<div class="top-meta">
							<?php the_category( ', ' );?> |	<?php the_time( get_option( 'date_format' ) );?>
						</div>
						<h1><?php the_title();?></h1>
						<div class="autor-card">
							<?php echo c80t_avatar(70);?>
							<p class="autor">
								<?php the_author( );?>
							</p>
							<p class="autormeta">
								<?php the_author_meta( 'description' );?>
							</p>
							<p>

							<?php if(get_the_author_meta('author_orgurl')):?>
							<a href="<?php the_author_meta('author_orgurl');?>" target="_blank" title="<?php the_author_meta('author_org');?>">
								<i class="fa fa-external-link"></i>	<?php the_author_meta('author_org');?>
							</a>
							<?php else:?>
								<?php the_author_meta('author_org');?>								
							<?php endif;?>

							</p>
						</div>
					</div>

					<?php if(has_post_thumbnail( )):?>
							<div class="img">
								<?php the_post_thumbnail( 'main' );?>
							</div>
					<?php endif;?>
					
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

					<div class="the-content">
						<?php the_content();?>
					</div>
						
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