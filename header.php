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
                <img src="<?php bloginfo('template_url');?>/assets/img/logo-c80.png" alt="<?php bloginfo('name');?>" class="logo">
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

        <div class="menu-constitucion">
            <ul>
                <li>
                    <a href="<?php echo get_post_type_archive_link('c80_cpt');?>"><i class="fa fa-book"></i> Constitución 1980</a>
                </li>
            </ul>
        </div>
        
      </div>
    </nav>
    
    <?php if(!is_front_page()):?>
        <?php echo c80t_breadcrumb();?>
    <?php endif;?>
</header>