    <footer>
      <div id="site-info" class="section-container">
        <ul id="shop-options" class="footer-item">
          <h5>SHOP</h5>
          <li><a href="catalog.php?search=film">FILM</a></li>
          <li><a href="catalog.php?search=digital">DIGITAL</a></li>
          <li><a href="catalog.php?search=lenses">LENSES</a></li>
          <li><a href="catalog.php?search=accessories">ACCESSORIES</a></li>
          <li><a href="catalog.php?search=drones">DRONES</a></li>
          <li><a href="catalog.php?search=bags">BAGS</a></li>
        </ul>
        <ul id="account-options" class="footer-item">
          <h5>ACCOUNT</h5>
          <li><a href="user-account.php?status=login">LOGIN</a></li>
          <li><a href="user-account.php?status=signup">SIGN UP</a></li>
          <li><a href="site-info.php?page=track">TRACK ORDER</a></li>
          <li><a href="site-info.php?page=gift">GIFT CARDS</a></li>
          <li><a href="cart.php">CART</a></li>
        </ul>
        <ul id="support-options" class="footer-item">
          <h5>SUPPORT</h5>
          <li><a href="site-info.php?page=help">HELP</a></li>
          <li><a href="site-info.php?page=shipping">SHIPPING</a></li>
          <li><a href="site-info.php?page=returns">RETURNS</a></li>
          <li><a href="site-info.php?page=coupons">COUPONS</a></li>
          <li><a href="site-info.php?page=contact">CONTACT US</a></li>
        </ul>
        <ul id="company-options" class="footer-item">
          <h5>COMPANY INFO</h5>
          <li><a href="site-info.php?page=about">ABOUT US</a></li>
          <li><a href="site-info.php?page=team">TEAM</a></li>
          <li><a href="site-info.php?page=careers">CAREERS</a></li>
          <li><a href="site-info.php?page=stores">STORES</a></li>
          <li><a href="site-info.php?page=privacy">PRIVACT POLICY</a></li>
          <li><a href="site-info.php?page=sitemap">SITE MAP</a></li>
        </ul>
      </div><!-- close site-info -->
      <div id="contact-options">
        <a href="/projects/camera-shop"><h6 id="footer-logo">CAMERAS</h6></a>
        <h6 id="contact-us">CONTACT US</h6>
        <p class="phoneNumber">(123) 345-6789</p>
        <ul id="social-media-list">
          <li><a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <li><a href="https://www.tumblr.com" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
          <li><a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul>
        <p class="copyight"><?php echo date("Y"); ?> | CREATED BY MICHAEL B HERNANDEZ JR</p>
      </div>
    </footer>
    <script>
      var $cart = <?php echo json_encode($_SESSION["cart"]); ?>;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="camera-shop.js"></script>
  </body>

</html>
