<!DOCTYPE html>
<html>
<head>
	<?php wp_head();?>
</head>
<body <?php body_class();?> >

<header id="header-sitio">
    <!-- Navegación principal -->
    <div class="container">
        <div class="row">
            <h1>
                <a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/assets/img/logo-c80-3.png" alt="<?php bloginfo('name');?>" class="logo"></a>
            </h1>
            <h2 class="description"><?php bloginfo('description');?></h2>

            <?php
            wp_nav_menu( array(
                'theme_location'    => 'principal',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'main-nav',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
        </div>
    </div>
     <nav class="navegacion-principal">
      <div class="container">

        <div class="menu-secciones">
            <ul>
                <li class="link-constitucion">
                    <a href="<?php echo get_post_type_archive_link('c80_cpt');?>"><i class="fa fa-book"></i> Constitución 1980</a>
                </li>
                <li class="link-opinion">
                    <a href="<?php echo get_post_type_archive_link('columnas');?>">Opinión</a>
                </li>
                <li class="link-noticias">
                    <a href="<?php echo get_bloginfo('url');?>/noticias">Noticias</a>
                </li>

            </ul>
        </div>
        
      </div>
    </nav>
    
    <?php if(!is_front_page()):?>
        <?php echo c80t_breadcrumb();?>
    <?php endif;?>
</header>