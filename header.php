<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title();?></title>
	<?php wp_head();?>
</head>
<body <?php body_class();?>>

<header id="header-sitio">
    <!-- Navegación principal -->
     <nav class="navegacion-principal">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php bloginfo('title');?></a>
          
          
        
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a class="c80-dropdown" href="#">Constitución política de la República de Chile de 1980 <i class="fa fa-caret-down fa-fw"></i></a>
            </li>  
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <nav class="navegacion-texto">
      <div class="container">
        <div class="c80-nav">
          <div class="separador-tipo-indice">
            <ul>
              <li>
                <a href="#">Índice Visual</a>
              </li>
              <li>
                <a href="#">Índice Temático</a>
              </li>
              <li>
                <a class="active" href="#">Capítulos</a>
              </li>
            </ul>
          </div>
          <div class="visor-textos">
            <!--contenedor para la visualización miniatura de todos los textos-->
          </div>
          <div class="visor-capitulos">
            <!--contenedor para la visualización de los capítulos-->
            <?php get_sidebar('articulos');?>
          </div>
          <div class="visor-temas">
            <!--contenedor para la visualización de los temas-->
          </div>
        </div>
      </div>
    </nav>

    <div class="breadcrumb">
      <!-- contenedor breadcrumb -->
        <div class="container">
          
            <div class="c80-breadcrumb">
              <a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a>
            </div>
            
        </div>
    </div>
</header>