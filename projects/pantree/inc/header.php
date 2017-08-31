<?php ?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <script src="https://use.fontawesome.com/fe86034e68.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="pantree.css" />
  </head>
  <body>
    <?php if ($page_title != "Pantree | A Personal Cookbook") { ?>
      <header id="header">
        <div id="header-container">
          <div class="fixed-header">
            <i id="header-menu" class="fa fa-bars header-item" aria-hidden="true"></i>
            <a id="header-title" class="header-item title" href="/projects/pantree">Pantree</a>
            <div id="header-menu-dropdown" class="hidden">
              <div id="header-menu-dropdown-point" class="point"></div>
              <ul id="header-menu-list">
                <li><a class="header-list-item" href="cookbook.php?page=1">Full Cookbook</a></li>
                <li><a class="header-list-item" href="cookbook.php?dish_type=breakfast&amp;page=1">Breakfast</a></li>
                <li><a class="header-list-item" href="cookbook.php?dish_type=lunch&amp;page=1">Lunch</a></li>
                <li><a class="header-list-item" href="cookbook.php?dish_type=dinner&amp;page=1">Dinner</a></li>
                <li><a class="header-list-item" href="cookbook.php?dish_type=dessert&amp;page=1">Dessert</a></li>
              </ul>
            </div>
          </div>
          <div id="search-container">
            <form id="searchfield" method="get" action="cookbook.php">
              <input type="text" name="search"/>
              <button type="submit"><i id="header-search-submit" class="fa fa-search fa-lg" aria-hidden="true"></i></button>
            </form>
          </div>
          <div class="fixed-header">
            <?php if ($_SESSION["loggedIn"] == 1) { ?>
            <?php } ?>
            <div id="header-account">
              <i id="account-icon" class="fa fa-user" aria-hidden="true"></i>
              <span id="account-text">Account</span>
            </div>
            <div id="header-account-dropdown" class="hidden">
              <div id="header-account-dropdown-point" class="point"></div>
              <?php if ($_SESSION["loggedIn"] == 1) { ?>
                <a id="header-account-account" class="header-account-signin" href="account.php?status=loggedIn&amp;page=1">Account</a>
                <a id="header-add-recipe" class="header-account-signin" href="new-recipe.php">Add Recipe</a>
                <a id="account-logout" class="header-account-signin" href="account.php?status=logout">Logout</a>
              <?php } else { ?>
                <a id="header-account-login" class="header-account-signin" href="account.php?status=login">Login</a>
                <a id="header-account-signup" class="header-account-signin" href="account.php?status=signup">Signup</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </header>
      <?php if ($banner != "hidden"){ ?>
        <div id="banner">
          <h1 id="banner-title" class="title"><?php echo $page_title; ?></h1>
        </div>
      <?php } ?>
    <?php } ?>
