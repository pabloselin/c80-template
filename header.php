<!DOCTYPE html>
<html>
<head>
	<?php wp_head();?>
</head>
<body <?php body_class();?> >

<header id="header-sitio">
    <span class="beta">BETA</span>
    <!-- Navegación principal -->
    <div class="container">
        <div class="row">
            <h1>
                <a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/assets/img/c80_logo_v_01.svg" alt="<?php bloginfo('name');?>" class="logo"></a>
            </h1>
            <h2 class="description"><?php bloginfo('description');?></h2>
            
            <a href="#" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-movil" aria-expanded="false">
                <span class="sr-only">Activar navegación</span>
                <i class="fa fa-navicon"></i>
            </a>

            <div id="main-nav">
                <ul class="nav navbar-nav hidden-sm hidden-xs">
                    <li>
                        <a href="<?php echo get_permalink(68);?>">Somos</a>
                    </li>
                    <li>
                        <a href="<?php echo get_permalink(516);?>">¿Cómo colaborar?</a>
                    </li>
                    <li>
                        <a href="<?php echo get_permalink(70);?>">Contacto</a>
                    </li>
                    <li class="socials">
                        <a href="<?php echo c80t_twitter();?>" target="_blank"><i class="fa fa-twitter"></i> </a>
                    </li>
                    <li class="socials">
                        <a href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-facebook-square"></i> </a>
                    </li>
                </ul>
            </div>

            

        </div>
    </div>
     <nav class="navegacion-principal hidden-sm hidden-xs">
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

    <!--Navegación móvil-->
    <nav id="nav-mobile">
        <div class="collapse navbar-collapse" id="menu-movil">
            <ul class="nav navbar-nav">
                <li class="link-noticias">
                    <a href="<?php echo get_bloginfo('url');?>/noticias">Noticias</a>
                </li>
                <li class="link-opinion">
                    <a href="<?php echo get_post_type_archive_link('columnas');?>">Opinión</a>
                </li>
                 <li class="link-constitucion">
                    <a href="<?php echo get_post_type_archive_link('c80_cpt');?>"><i class="fa fa-book"></i> Constitución 1980</a>
                </li>
                <li class="separator">
                    <span></span>
                </li>
                <li>
                    <a href="<?php echo get_permalink(68);?>">Somos</a>
                </li>
                <li>
                    <a href="<?php echo get_permalink(516);?>">¿Cómo colaborar?</a>
                </li>
                <li>
                    <a href="<?php echo get_permalink(70);?>">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php if(!is_front_page()):?>
        <?php echo c80t_breadcrumb();?>
    <?php else:?>
        <?php echo c80t_temas();?>
    <?php endif;?>
</header>