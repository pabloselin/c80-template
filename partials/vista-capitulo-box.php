<article class="capitulo-constitucion-box">
	<div class="wrap">
	<header class="header-capitulo">
			<h1><a href="<?php the_permalink();?>" <span class="txt"><span class="titlename"><?php the_title();?></span> <br> <span class="capsubt"><?php echo c80t_captitle($post->ID);?></span> </span></a></h1>
		</header>	
			<?php 
				$args = array(
					'post_type' => 'c80_cpt',
					'numberposts' => 100,
					'posts_per_page' => 100,
					'post_parent' => $post->ID,
					'orderby' => 'menu_order',
					'order' => 'ASC'
					);
				
				
				$articulos = get_posts( $args );
				$count = count($articulos);
				echo $count . ' artículos';

				?>
				
				<p><?php the_tags( 'Temas: ', ', ' );?></p>		
				
		</div>
</article>