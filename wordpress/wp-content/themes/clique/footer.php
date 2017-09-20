    <footer class="site-footer">
      <section id="bottom-section" class="section">
        <?php
        $top_query = new WP_Query(array('category_name' => 'homepage-bottom'));
        if ($top_query->have_posts()):
          while($top_query->have_posts()) : $top_query->the_post();
          the_content();

          endwhile;
        else:
          echo "Could not retrieve homepage top";
        endif;
        ?>
        <div class="footer-contacts">
          <span class="clique-info">© 2017 CLIQUE STUDIOS, LLC.  312-379-9329 410 S. MICHIGAN AVE., SUITE 801 CHICAGO, IL 60605</span>
          <div class="social-media">
            <ul>
              <li class="facebook-link social">
                <a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <span class="bg-color"></span>
              </li>
              <li class="instagram-link social">
                <a class="instagram" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <span class="bg-color"></span>
              </li>
              <li class="youtube-link social">
                <a class="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                <span class="bg-color"></span>
              </li>
              <li class="flickr-link social">
                <a class="flickr" href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a>
                <span class="bg-color"></span>
              </li>
              <li class="twitter-link social">
                <a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <span class="bg-color"></span>
              </li>
              <li class="linkedin-link social">
                <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <span class="bg-color"></span>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <div class="talk-to">
        <h1 class="talk-to-text">Talk to a real person</h1>
        <div class="talk-to-button-container">
          <div class="talk-to talk-to-phone-buttons">
            <a class="talk-to-phone1" href="#">312-379-9329</a>
            <a class="talk-to-down" href="#">312-379-9329</a>
          </div>
          <div class="talk-to talk-to-message-buttons">
            <a class="talk-to-message1" href="#">MESSAGE US</a>
            <a class="talk-to-down" href="#">MESSAGE US</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <?php wp_footer(); ?>
  </body>
</html>
