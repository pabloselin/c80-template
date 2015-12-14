<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<article itemscope itemtype="http://schema.org/Article" class="columna-estandar">
			<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url');?>"/>
			<div class="pad">
				<header>

					<div class="info-columna">
						<div class="top-meta">
							<?php the_category( ', ' );?> |	<span itemprop="datePublished" content="<?php the_date('c'); ?>" pubdate><?php the_time( get_option( 'date_format' ) );?></span>
							<meta itemprop="dateModified" content="<?php echo get_the_modified_date( 'c' );?>">
						</div>
						<h1 itemprop="headline"><?php the_title();?></h1>
						<div class="autor-card">
							<?php echo c80t_avatar(70);?>
							<p class="autor" itemprop="author">
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

						<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<meta itemprop="name" content="<?php bloginfo('name');?>">
							 <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							    <meta itemprop="url" content="<?php bloginfo('template_url');?>/assets/img/logo-c80-str.png">
							    <meta itemprop="width" content="183">
							    <meta itemprop="height" content="60">
							 </div>
						</div>

					</div>

					<?php if(has_post_thumbnail()):
						
						$imgid = get_post_thumbnail_id( $post->ID );
						$pthsrc = wp_get_attachment_image_src( $imgid, 'main' );


						?>	
						<div class="imgobj" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<?php the_post_thumbnail( 'main' );?>
							<meta itemprop="url" content="<?php echo $pthsrc[0];?>">
    						<meta itemprop="width" content="<?php echo $pthsrc[1];?>">
    						<meta itemprop="height" content="<?php echo $pthsrc[2];?>">
						</div>
					<?php else:?>
						<div class="imgobj hidden" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<img src="<?php echo get_bloginfo('template_url');?>/assets/img/placeholder-main.png">
							<meta itemprop="url" content="<?php echo get_bloginfo('template_url');?>/assets/img/placeholder-main.png">
    						<meta itemprop="width" content="754>">
    						<meta itemprop="height" content="405">
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

					<?php get_template_part('partials/sharer');?>
					
					<div class="the-content" itemprop="articleBody">
						<?php the_content();?>
						<?php get_template_part('partials/inline-newsletter');?>
					</div>
						
				</div>
			</div>
			
			<?php get_template_part('partials/colabora');?>
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