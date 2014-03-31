<!DOCTYPE html>
<html>
  <head>
    <title> Axaltec </title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link href="<?php bloginfo("template_url"); ?>/assets/css/responsive.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php bloginfo("template_url"); ?>/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php bloginfo("template_url"); ?>/assets/css/bjqs.css" rel="stylesheet" media="screen">
    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,800,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <?php
      $couleur_theme = cagetorie_parent();
    ?>
  </head>
  <body <?php if(!is_home()): ?>id="<?php echo $couleur_theme; ?>" <?php endif; ?> <?php body_class(); ?>>
    
    <!-- header -->
    <div class="container">
      <header>
        <div class="row relatif">
          <div class="col-md-4 col-xs-12">
            <a href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>">
              <img src="<?php bloginfo('template_url');?>/assets/images/logo.png" alt="exaltec" class="img-responsive">
            </a>
          </div>
          <div class="social">
            <a href="<?php echo get_option('linkedin'); ?>" class="ln b_bleu" target="_blank"><img src="<?php bloginfo('template_url');?>/assets/images/icones/petitin.png"></a>
            <a href="<?php echo get_option('viadeo'); ?>" class="viadeo b_bleu" target="_blank"><img src="<?php bloginfo('template_url');?>/assets/images/icones/petitviadeo.png"></a>
          </div>
          <div class="col-md-8 col-xs-12">
            <nav>
               <div class="mobile-menu"><a data-status="plus" href="#"><i class="fa fa-plus"></i>  Menu</a></div>
               <?php wp_nav_menu( array( 'theme_location' => 'Top' ) ); ?>
            </nav>
          </div>
        </div>
      </header>
    </div>