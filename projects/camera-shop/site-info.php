<?php
session_start();
include("inc/functions.php");
include("inc/header.php");
$section = "SITE INFO";
if(isset($_GET["page"])){
  switch ($_GET["page"]) {
    case "track":
      $section = "TRACK ORDER";
      break;
      case "gift":
        $section = "GIFT CARD";
        break;
    case "contact":
      $section = "CONTACT US";
      break;
    case "about":
      $section = "ABOUT US";
      break;
    case "privacy":
      $section = "PRIVACY POLICY";
      break;
    case "sitemap":
      $section = "SITE MAP";
      break;
    default:
      $section = strtoupper($_GET["page"]);
      break;
  }
}
?>

<section id="site-info-page" class="page-body">
  <h1 class="page-title"><?php echo $section; ?></h1>
  <?php if ($section == "SITE MAP") { ?>
    <ul>
      <li><a href="catalog.php?page=1">Catalog</a></li>
      <li class="sitemap-margin"><a href="catalog.php?search=accessories&amp;page=1">Accessories</a></li>
      <li class="sitemap-margin"><a href="catalog.php?search=bags&amp;page=1">Bag</a></li>
      <li class="sitemap-margin"><a href="catalog.php?search=digital&amp;page=1">Digital</a></li>
      <li class="sitemap-margin"><a href="catalog.php?search=drones&amp;page=1">Drones</a></li>
      <li class="sitemap-margin"><a href="catalog.php?search=film&amp;page=1">Film</a></li>
      <li class="sitemap-margin"><a href="catalog.php?search=lenses&amp;page=1">Lenses</a></li>
      <li><a href="site-info.php?page=account">Account</a></li>
      <li class="sitemap-margin"><a href="user-account.php?status=login">Login</a></li>
      <li class="sitemap-margin"><a href="user-account.php?status=signup">Sign Up</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=track">Track Order</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=gift">Gift Card</a></li>
      <li class="sitemap-margin"><a href="cart.php">Cart</a></li>
      <li><a href="site-info.php?page=support">Support</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=help">Help</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=shipping">Shipping</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=returns">Returns</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=coupons">Coupons</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=contact">Contact Us</a></li>
      <li><a href="site-info.php?page=company">Company Info</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=about">About Us</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=team">Team</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=careers">Careers</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=stores">Stores</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=privacy">Privacy Policy</a></li>
      <li class="sitemap-margin"><a href="site-info.php?page=sitemap">Site Map</a></li>
    </ul>
  <?php } ?>
</section>

<?php include("inc/footer.php") ?>
