<?php 
//standard archive para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<h1 class="archive-title"><?php echo c80t_archivetitle();?></h1>

		<div class="archive-items">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php 
				$ptype = get_post_type( );
				$ptypeobj = get_post_type_object( $ptype );
				$ptypename = $ptypeobj->labels->name;
			?>
        <article class="articulo-archivo <?php echo $ptype;?>">
				<div class="img-in-archive hidden-xs">	
				<?php if(has_post_thumbnail( ) && $ptype == 'post'):?>
					<?php the_post_thumbnail( 'alt-thumbnail' );?>
				<?php else:?>
					<?php echo c80t_avatar(150);?>
				<?php endif;?>
				</div>
<?php if(has_post_thumbnail( ) && $ptype == 'post'):?>
      <div class="mobile-img-archive visible-xs">
									<?php the_post_thumbnail( 'single' );?>
			</div>
	<?php elseif($ptype == 'columnas'):?>
  <div class="mobile-avatar-archive visible-xs">
  <?php echo c80t_avatar(80);?>
        </div>
				<?php endif;?>


				<div class="text-in-archive">	
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
		</div>	
			</article>
			
				<?php endwhile; ?>
				<!-- post navigation -->
				<?php c80_paginator();?>

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
