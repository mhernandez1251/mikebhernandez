<?php

get_header();/* similar to include(header_file), will take default file or can create a header.php file in same directory as index.php*/
/* : is an alternative to curley braces, need to remember the end(method) when done*/
if (have_posts()) :
  /* the_post() iterates through all existing posts and allos you to use the_title(), the_content() functions for that post  */
  while (have_posts()) : the_post(); ?>
  <article class="post">
    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <?php the_content(); ?>
  </article>

  <?php endwhile;

  else :
    echo '<p>No content found</p>';

  endif;

get_footer();/* similar to include(footerr_file), will take default file or can create a footer.php file in same directory as index.php*/

?>
