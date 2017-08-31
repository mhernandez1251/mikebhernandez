<?php
session_start();
include("inc/functions.php");
$page_title = "Pantree | A Personal Cookbook";
$page_body = "none";
include("inc/header.php");
?>
<section id="homepage">
  <div id="homepage-account">
    <div id="homepage-account-button">
      <i class="fa fa-user" aria-hidden="true"></i>
      <span>Account</span>
    </div>
    <div id="homepage-account-dropdown" class="hidden">
      <div id="homepage-dropdown-point"></div>
      <?php if ($_SESSION["loggedIn"] == 1 ) { ?>
        <a id="homepage-account-link" class="homepage-signin" href="account.php?status=loggedIn">Account</a>
        <a id="homepage-add-recipe" class="homepage-signin" href="new-recipe.php">New Recipe</a>
      <?php } else { ?>
        <a id="homepage-login-button" class="homepage-signin" href="account.php?status=login">Login</a>
        <a id="homepage-signup-button" class="homepage-signin" href="account.php?status=signup">Signup</a>
      <?php } ?>
    </div>
  </div>
  <div id="homepage-container">
    <h1 id="homepage-title" class="main-title title">Pantree.</h1>
    <h3 id="homepage-subtitle" class="main-title title">a cookbook</h3>
    <div id="homepage-links-container">
      <div id="homepage-links-title">Dish Type:</div>
      <ul id="homepage-links">
        <li><a href="cookbook.php?dish_type=Breakfast&amp;page=1">Breakfast</a></li>
        <li><a href="cookbook.php?dish_type=Lunch&amp;page=1">Lunch</a></li>
        <li><a href="cookbook.php?dish_type=Dinner&amp;page=1">Dinner</a></li>
        <li><a href="cookbook.php?dish_type=Dessert&amp;page=1">Dessert</a></li>
      </ul>
    </div>
    <form id="homepage-search" method="get" action="cookbook.php">
      <input type="text" name="search"/>
      <button type="submit"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button>
    </form>
    <a id="homepage-full-link" href="cookbook.php?page=1">- Full Cookbook -</a>
  </div>
</section>
<?php
include("inc/footer.php");
?>
