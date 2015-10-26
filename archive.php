<?php 
//standard archive para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<h1>Archivo</h1>

		<div class="archive-items">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php 
				$ptype = get_post_type( );
				$ptypeobj = get_post_type_object( $ptype );
				$ptypename = $ptypeobj->labels->name;
			?>
			<article class="articulo-archivo">
			
				<?php if(has_post_thumbnail( )):?>
					<?php the_post_thumbnail( 'thumbnail' );?>
				<?php endif;?>
			
				<p class="top-meta">
					<?php echo $ptypename;?> | <?php the_time(get_option('date_format'));?>
				</p>

				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				
				<p class="autor">
					<?php the_author();?>
				</p>
			
				<p class="related">
					<?php echo c80t_relink($post->ID);?>
				</p>	
				
				<p class="temas">
					<?php the_tags( '<span class="nrel"><i class="fa fa-tags"></i> </span>', ' ' );?>
				</p>
			
			</article>
			
				<?php endwhile; ?>
				<!-- post navigation -->
			
				<?php else: ?>
			
				<div class="error404">
				
					<p>No se encontró contenido</p>
				
				</div>
			
			<?php endif; ?>
		</div>

	</section>
</div>

<?php
	get_footer();
?>