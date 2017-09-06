<!DOCTYPE html>
<html>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width" />
    <script src="https://use.fontawesome.com/fe86034e68.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700|Lato:400,700,900" rel="stylesheet">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> data-spy="scroll" data-target="#post-nav">
    <div class="site-container">
      <div class="background-video-container">
        <video loop muted autoplay class="top-video">
          <source src="wp-content/themes/clique/img/top-page-background-vid.mp4" type="video/mp4">
        </video>
      </div>
      <header class="site-header">
        <div class="site-header-container">
          <div class="header-logo">
            <a href="<?php echo home_url(); ?>"></a>
          </div>

          <?php
          $args = array(
            'theme_location' => 'header'
          )
          ?>

          <div class="header-nav">
            <?php wp_nav_menu(); ?>
            <span class="underline"></span>
          </div>

          <div class="phone-number" title="Call Us Today">
            <a href="tel:3123799329">312-379-9329</a>
          </div>
        </div>
      </header>
