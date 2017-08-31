<?php if ($page_title != "Pantree | A Personal Cookbook") { ?>
  <footer>
    <div id="footer-container">
      <div id="footer-title" class="footer-group"><a class="title footer-item" href="/projects/pantree">Pantree</a></div>
      <div id="footer-created" class="footer-group footer-item">
        <?php echo date("Y"); ?> | Created By: Michael Hernandez
      </div>
      <div id="footer-social" class="footer-group">
        <span><a class="footer-item" href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
        <span><a class="footer-item" href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
        <span><a class="footer-item" href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
        <span><a class="footer-item" href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></span>
      </div>
    </div>
  </footer>
<?php }?>
  <script>
  var existingBanner = document.getElementById("banner");
  var color = "";
  if(existingBanner != null){
    var dishType = "<?php echo $page_title; ?>";
    dishType = dishType.toLowerCase();

  }
  var $saved_ids = <?php echo json_encode($saved_ids); ?>;
  <?php if ($_SESSION["loggedIn"] == 1) { ?>
  var loggedIn = 1;
  <?php }
  if (!empty($recipes)) { ?>
    var $recipes = <?php echo json_encode($recipes); ?>;
  <?php } else { ?>
    var $recipes = "empty";
  <?php }
  if ($_GET["status"] == "login") { ?>
    var status = "login"
  <?php } else { ?>
    var status = "";
  <?php }
  if (isset($banner)) { ?>
    var banner = 0;
  <?php } else { ?>
    var banner = 1;
  <?php }
  if (isset($page_body)) { ?>
    var pageBody = 0;
  <?php } else { ?>
    var pageBody = 1;
  <?php }  ?>
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="pantree.js"></script>
</body>
</html>
