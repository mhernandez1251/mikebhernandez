<?php

/* this function is a way of importing css and other needed resources to the index.php file */
function example_theme_resources() {

  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_script('functionality', get_template_directory_uri());

}

add_action('wp_enqueue_scripts', 'example_theme_resources');


// Navigation Menus
// This gets Wordpress to recognize the menu locations
// the keys are the value of the argument passed to the wp_nav_menu($arg) function
register_nav_menus(array(
  'primary' => __( 'Primary Menu'),
  'footer' => __( 'Footer Menu'),
));


// Get top ancestor
function get_top_ancestor_id() {

  global $post;

  if ($post->post_parent) {
    $ancestors = array_reverse(get_post_ancestors($post->ID));
    return $ancestors[0];
  }

  return $post->ID;

}
