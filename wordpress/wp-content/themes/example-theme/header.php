<!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width" />
    <title><?php bloginfo('name'); ?></title> <!-- bloginfo('attribute') will take output that attribute taken from your wordpress file -->
    <?php wp_head(); ?><!-- wp_head() allows wordpress to add necessary info at the end -->
  </head>

  <body <?php body_class();/* this function gives the body a group of default wordpress classes */ ?>>

    <div class="container">

    <!-- site-header -->
    <header class="site-header">
      <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      <h5><?php bloginfo('description'); ?><?php if (is_page('portfolio')) { ?>
        - Thank you for viewing our work
      <?php } ?></h5>

      <nav class="site-nav">

        <?php

        $args = array(
          'theme_location' => 'primary'
        )

        ?>
        <?php wp_nav_menu( $args );
        // wp_nav_menu() by itself will produce an unordered list of all existing pages with links to those pages
        // passing the and argument that is an array with the key value pairing of 'theme_location' and a basic name of the location allows you to go into the wordpress dashboard and edit what is included in the Menu
        // you must make sure to register the menu in the functions.php file ?>
      </nav>

    </header>
