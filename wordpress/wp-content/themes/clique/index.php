<?php

get_header();

?>

<section id="top-section" class="section">
  <?php
  $top_query = new WP_Query(array('category_name' => 'homepage-top'));
  if ($top_query->have_posts()):
    while($top_query->have_posts()) : $top_query->the_post();
    the_content();

    endwhile;
  else:
    echo "Could not retrieve homepage top";
  endif;
  ?>
</section>

<div class="posts-container">
  <div id="post-nav">
    <div class="post-nav-container">
      <div class="post-nav-line"></div>
      <ul class="nav flex-column">
        <?php
        $post_query = new WP_Query(array('category_name' => 'post-section'));
        if ($post_query->have_posts()):
          $index = 1;
          $zdex = 20;
        while ($post_query->have_posts()) : $post_query->the_post();
        if ($index < 10) :
          $index = "0" . $index;
        endif;
        ?>

        <li class="nav-item post-nav-item">
          <a class="nav-link active" href="#<?php echo the_title(); ?>"><?php echo $index; ?></a>
        </li>

        <?php
        $index = intVal($index);
        $index++;
        endwhile;?>
    </ul>
    </div>
</div>
      <?php
      wp_reset_postdata();
      $index = 0;
      $post_query = new WP_Query(array('category_name' => 'post-section'));
      while ($post_query->have_posts()) : $post_query->the_post();
      ?>

        <article id="<?php the_title(); ?>" class="section post-section <?php echo $index ?>" style="z-index: <?php echo $zdex; ?>;">
          <div class="post-section-overflay">
          </div>
          <?php wp_count_posts(); ?>
          <?php the_content(); ?>
        </article>

      <?php
      $index++;
      $zdex--;
    endwhile;
      wp_reset_postdata();
      else:
        echo "Could not create nav";
      endif;
      ?>
</div>

<?php

get_footer();

?>
