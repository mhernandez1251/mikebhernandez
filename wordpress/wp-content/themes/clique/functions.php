<?php

function get_clique_resources() {

  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css');

  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.min.js');

}

add_action('wp_enqueue_scripts', 'get_clique_resources');

register_nav_menus(array(
  'header' => __('Header Navigation')
));

function wp_get_posts_count() {
    global $wp_query;
    return $wp_query->post_count;
}
