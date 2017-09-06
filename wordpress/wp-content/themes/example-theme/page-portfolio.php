<?php

get_header();

if (have_posts()) :

  while (have_posts()) : the_post(); ?>
  <article class="post page">
    <!-- column-container -->
    <div class="column-container clearfix">
      <!-- title-column -->
      <div class="title-column">
        <h2><?php the_title(); ?></h2>
      </div>

      <!-- text-column -->
      <div class="text-column">
        <?php the_content(); ?>
      </div>
    </div>

    <nav class="site-nav children-links clearfix">
      <span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></span>

      <ul>
        <?php

        $args = array(
          'child_of' => get_top_ancestor_id(),
          'title_li' => ""
        )
        ?>

        <?php wp_list_pages($args); ?>
      </ul>
    </nav>

  </article>

  <?php endwhile;

  else :
    echo '<p>No content found</p>';

  endif;

get_footer();

?>
