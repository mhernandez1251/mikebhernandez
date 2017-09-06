  <footer class="site-footer">

    <?php

    $args = array(
      'theme_location' => 'footer'
    )

    ?>

    <nav class="site-nav">
      <?php wp_nav_menu( $args ); ?><!-- wp_nav_menu() creates an unordered list of every existing page from wordpress -->
    </nav>

    <p><?php bloginfo('name'); ?> - &copy; <?php echo date("Y"); ?></p>

  </footer>

</div>

<?php wp_footer(); ?>
</body>
</html>
