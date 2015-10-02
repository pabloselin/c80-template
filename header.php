<!DOCTYPE html>
<html>
<head>
	<?php wp_head();?>
</head>
<body <?php body_class();?> >

<header id="header-sitio">
    <!-- Navegación principal -->
     <nav class="navegacion-principal">
      <div class="container-fluid">
        
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'principal',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
        
      </div>
    </nav>

    <div class="breadcrumb">
      <!-- contenedor breadcrumb -->
        <div class="container-fluid">
          
            <div class="c80-breadcrumb">
              <a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a>
            </div>
            
        </div>
    </div>
</header>