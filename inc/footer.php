<?php
if ($page != "homepage") { ?>
  <footer>
    <div class="footer-container">
      <span class="footer-name">Michael Hernandez | <?php echo date("Y") ?></span>
      <ul class="footer-contact-list">
        <li class="footer-contact-item"><a href="tel:1-630-383-9030"><i class="fa fa-phone-square" aria-hidden="true"></i></a></li>
        <li class="footer-contact-item"><a href="mailto:mbhcoding@gmail.com" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
        <li class="footer-contact-item"><a href="https://twitter.com/messages/compose?recipient_id=mikebhernandez" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li class="footer-contact-item"><a href="https://www.linkedin.com/in/michael-hernandez-52783b121/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </footer>
<?php } ?>
<script type="text/javascript" src="<?php echo $javascript_file; ?>"></script>
</body>
</html>
