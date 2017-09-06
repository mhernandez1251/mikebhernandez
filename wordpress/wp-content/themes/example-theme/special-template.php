<?php

/*
Template Name: Special Layout
*/
/* This tells Wordpress that a special layout exists and you can select it in the page edit mode under template */
get_header();

if (have_posts()) :

  while (have_posts()) : the_post(); ?>
  <article class="post page">
    <h2><?php the_title(); ?></h2>

    <!-- info-box -->
    <div class="info-box">
      <h4>Disclaimer Title</h4>
      <p>
        Nullam at vehicula neque, ac mattis urna. Suspendisse nec arcu porta, fermentum libero non, hendrerit ante. Morbi dictum eros nisi, vel aliquam ipsum rhoncus a. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam sollicitudin felis et consequat rutrum. Pellentesque placerat hendrerit metus, sit amet consectetur lectus egestas non. Nam dictum orci quam, at varius est cursus non. Duis tincidunt eu justo sed lacinia</p>
    </div>

    <?php the_content(); ?>
  </article>

  <?php endwhile;

  else :
    echo '<p>No content found</p>';

  endif;

get_footer();

?>
