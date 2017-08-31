<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Shop</title>
    <script src="https://use.fontawesome.com/fe86034e68.js"></script>
    <link rel="stylesheet" type="text/css" href="camera-shop.css" />
  </head>

  <body>

    <header>
      <div id="nav-container">
        <div id="logo-container" class="nav-column">
          <div id="logo"><a href="/projects/camera-shop">CAMERAS</a></div>
        </div>
        <nav id="main-nav" class="flex-item-1 nav-column">
          <label for="search-field"><i class="fa fa-search search-logo" aria-hidden="true"></i></label>
          <i class="fa fa-bars collapse-logo" aria-hidden="true"></i>
          <ul id="nav-list" class="hidden-nav">
            <li><a class="<?php if($section == 'film'){echo "active";}?>" href="catalog.php?search=film&#38;page=1">FILM</a></li>
            <li><a class="<?php if($section == 'digital'){echo "active";}?>" href="catalog.php?search=digital&#38;page=1">DIGITAL </a></li>
            <li><a class="<?php if($section == 'lenses'){echo "active";}?>" href="catalog.php?search=lenses&#38;page=1">LENSES</a></li>
            <li><a class="<?php if($section == 'accessories'){echo "active";}?>" href="catalog.php?search=accessories&#38;page=1">ACCESSORIES</a></li>
            <li><a class="<?php if($section == 'drones'){echo "active";}?>" href="catalog.php?search=drones&#38;page=1">DRONES</a></li>
            <li><a class="<?php if($section == 'bags'){echo "active";}?>" href="catalog.php?search=bags&#38;page=1">BAGS</a></li>
          </ul>
        </nav>
        <div id="button-container" class="flex-item-1">
          <a id="cart-icon" href="cart.php"><i class="fa fa-shopping-cart account-buttons" aria-hidden="true"></i></a>
          <a id="user-icon" class="<?php if(!isset($_SESSION["login_status"])) { echo "hidden"; } ?>" href="user-account.php?status=success"><i class="fa fa-user" aria-hidden="true"></i></a>
          <div id="sign-in-buttons" class="account-buttons <?php if ($_SESSION["login_status"] == 1 ) { echo "hidden"; } ?>">
            <button class="signup-button" name="Sign Up" <?php if ($_GET["status"] == "signup") { echo "disabled"; } ?>>SIGN UP</button>
            <button class="login-button" name="Login" <?php if ($_GET["status"] == "login") { echo "disabled"; } ?>>LOGIN</button>
          </div><!-- close sign-in-buttons -->
        </div><!-- close button-container -->
        <div id="searchbar" class="hidden">
          <i class="fa fa-times close" aria-hidden="true"></i>
          <form method="post" action="catalog.php?page=1">
            <input id="search-field" type="text" name="search" placeholder="Search..."/>
          </form>
        </div>
      </div>
    </header>

    <div id="form-overlay">
    	<div id="form-container">
    	  <form method="post" action="user-account.php?satus=">
    		<i class="fa fa-times fa-lg form-close" aria-hidden="true"></i>
    		<h3 id="form-title"></h3>
        <div id="signup-container" class="hidden">
      		<div id="name-container">
      			<label for="first-name">First Name</label>
      			<input id="first-name" type="text" name="first-name" />
      			<label for="last-name">Last Name</label>
      			<input id="last-name" type="text" name="last-name" />
      		</div>
          <span style="display:none">
      		<label for="last-last-name">Last Last Name</label>
      		<input id="last-last-name" type="text" name="last-last-name" />
          </span>
          <span>
      		<label for="email">Email</label>
      		<input id="email" type="text" name="email"/>
          </span>
          <span>
      		<label for="username">Username</label>
      		<input id="username" type="text" name="username" />
          </span>
      		<div id="password-container">
				<span>
      			<label for="set-password">Password (at least 8 characters)</label>
      			<input id="set-password" type="password" name="set-password" />
      			</span>
				<span>
				<label for="confirm-password">Confirm Password</label>
      			<input id="confirm-password" type="password" name="confirm-password" />
				</span>
			</div>
        </div>
        <div id="login-container" class="hidden">
      		<label for="login-username">Username</label>
      		<input id="login-username" type="text" name="login-username" />
      		<label for="login-password">Password</label>
      		<input id="login-password" type="password" name="login-password" />
        </div>
    		<div class="form-button-container">
    			<button class="form-reset" type="reset">Reset</button>
    			<button class="form-submit" type="submit">Submit</button>
    		</div>
    	  </form>
      </div><!-- close form-container -->
    </div><!-- close overlay -->
