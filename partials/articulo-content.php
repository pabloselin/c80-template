<?php
global $post;
$checkmod = c80_Public::c80_checkmod($post->ID);
$checknew = c80_Public::c80_checknew($post->ID);
?>

<article id="cpt-id-<?php echo $post->ID;?>" class="articulo-constitucion <?php if($checkmod): echo 'modarticle mod-' . $checkmod; endif;?> <?php if($checknew): echo 'newarticle'; endif;?>">

    <div class="row">
			
		<div class="col-md-12">
					<header>
						
						<h1 class="article-title">
                            <?php if($en_capitulo):?>
                                <a href="<?php echo get_permalink($post->ID);?>"><i class="fa fa-file-text-o"></i> <span class="chaptername"><?php echo c80t_parentname($post->ID, $en_capitulo);?></span> <span class="articlenumber"><?php the_title();?></span></a>
                            <?php else:?>
                                <i class="fa fa-file-text-o"></i> <span class="chaptername"><?php echo c80t_parentname($post->ID, $en_capitulo);?></span> <span class="articlenumber"><?php the_title();?></span>
                            <?php endif;?>
                        </h1>

						<?php if($checknew):
								echo '<span class="modinfo"><i class="fa fa-info-circle"></i> Añadido el ' . get_the_time( 'd/m/Y', $post->ID ). '</span>';
							endif;?>

						<?php if($checkmod):
								echo '<span class="modinfo"><i class="fa fa-info-circle"></i> Modificado el ' . get_the_time( 'd/m/Y', $checkmod) .'</span>';
							endif;?>
						
							<p class="temas">
								<?php c80_tags();?>
							</p>
							
							<?php if( c80_Public::c80_hascontent($post->ID)): get_template_part('partials/modal-c80embed'); endif;?>
						
					</header>

        </div>

    </div>

    <div class="row">
        <div class="col-md-9">
                        <?php if( c80_Public::c80_hascontent($post->ID)) {?>
                        <div class="main-content article-info-holder" data-chaptername="<?php echo c80t_parentname($post->ID, false);?>" data-articlenumber="<?php the_title();?>">
                            <?php the_content();?>
                        </div>
                        <?php }?>								
        </div>
        <div class="col-md-3">
            <?php include( TEMPLATEPATH . '/sidebar-modificaciones.php');?>
            <?php include( TEMPLATEPATH . '/sidebar-relacionados.php');?>
        </div>
    </div>

</article>