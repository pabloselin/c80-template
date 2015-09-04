<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title();?></title>
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
    <!-- Fixed navbar -->
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
                
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<header id="header-sitio">
    <h1><?php bloginfo('name');?></h1>
</header>