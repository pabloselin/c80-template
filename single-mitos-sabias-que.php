<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article <?php post_class('mitos-sabias-que');?> >
			
			<div class="pad">
				<header>
					
					<div class="img">

					<?php if(has_post_thumbnail()):?>	
						<div class="imgobj" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<?php the_post_thumbnail( 'large' );?>
						</div>
					<?php endif;?>

						<div class="in-img-meta">
							<p class="related">
								<?php echo c80t_relink($post->ID);?>
							</p>
												
							<p class="temas temas-escritorio">
								<?php echo c80_tags();?>
							</p>
						</div>
					
					</div>
					
					<?php get_template_part('partials/sharer');?>
						
				</header>
					
				<div class="contenido">
				
				<h1 itemprop="headline"><?php the_title();?></h1>
					
				<?php if(has_excerpt()):?>
					<div class="excerpt">

						<?php the_excerpt();?>	

					</div>	
				<?php endif;?>

					<div class="the-content" itemprop="articleBody">
						<?php the_content();?>
					</div>

					<p class="temas temas-movil">
								<?php c80_tags( );?>
					</p>
				</div>

				
			</div>
		
		</article>
		
			<?php endwhile; ?>

			<!-- comments -->
				<?php comments_template();?>

				<div class="container inline-newsletter">
					<div class="row">
						<div class="col-md-8">
							<?php get_template_part('partials/inline-newsletter');?>
						</div>
					</div>
				</div>
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