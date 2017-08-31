<?php
session_start();
include("inc/functions.php");

if (isset($_GET["status"])) {
    if ($_GET["status"] == "logout") {
      session_destroy();
      header("location:account.php?status=login&page=1");
      exit;
    }
    if ($_GET["status"] == "update" && $_SESSION["loggedIn"] == 1) {
      $favorites = $_POST["favorites"];
      $fav_str = implode(",",$favorites);
      updateFavorites($fav_str,$_SESSION["account"]["account_id"]);
    }
};
if (!isset($_GET["status"])) {
  if ($_SESSION["loggedIn"] == 1) {
    header("location:account.php?status=loggedIn&page=1");
    exit;
  } else {
    header("location:account.php?status=login");
    exit;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["full-name"] != "") {
    header("location:account.php?status=signup");
    exit;
  }

  if($_GET["status"] == "login") {
    $email_username = trim(filter_input(INPUT_POST,"email-username",FILTER_SANITIZE_STRING));
    $loginPassword = trim(filter_input(INPUT_POST,"login-password",FILTER_SANITIZE_STRING));

    if ($email_username == "" || $loginPassword == "") {
      $error_message = "Please fill in the following fields: ";
      if ($email_username == "" && $loginPassword == "") {
        $error_message .= "Email and Password.";
      } else if ($email_username == "") {
        $error_message .= "Email.";
      } else if ($loginPassword == "") {
        $error_message .= "Password.";
      }
    }

    if (!isset($error_message)) {
      $account = accountInfo($email_username);
      if (empty($account)) {
        $error_message = "Email/Username could not be found. Please login again.";
      } else if ($account["password"] != (sha1($loginPassword . $account["salt"]))) {
        $error_message = "Email and Password combination does not match. Please login again.";
      } else {
        $_SESSION["account"] = $account;
        $_SESSION["loggedIn"] = 1;
        header("location:account.php?status=loggedIn&page=1");
        exit;
      }
    }

  } else if ($_GET["status"] == "signup") {
    $count = intval(totalAccount());
    if ($count == 0) {
      $account_id = "01";
    } else if ($count < 10) {
      $account_id = "0" . ($count + 1);
    } else {
      $account_id = ($count + 1);
    }
    $first_name = trim(filter_input(INPUT_POST,"first-name",FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST,"last-name",FILTER_SANITIZE_STRING));
    $username = trim(filter_input(INPUT_POST,"signup-username",FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"signup-email",FILTER_SANITIZE_STRING));
    $confirmEmail = trim(filter_input(INPUT_POST,"signup-email-confirm",FILTER_SANITIZE_STRING));
    $signupPassword = trim(filter_input(INPUT_POST,"signup-password",FILTER_SANITIZE_STRING));
    $confirmPassword = trim(filter_input(INPUT_POST,"signup-password-confirm",FILTER_SANITIZE_STRING));
    $salt = saltGenerator();
    $finalPassword = sha1($signupPassword . $salt);

    $existingUsername = accountInfo($username);
    $exisitingEmail = accountInfo($email);

    if ($first_name == "" || $last_name == "" || $username == "" || $email == "" || $signupPassword == "") {
      $error_arr = [];
      if ($first_name == "") {
        $error_arr[] = "First Name";
      }
      if ($last_name == "") {
        $error_arr[] = "Last Name";
      }
      if ($username == "") {
        $error_arr[] = "Username";
      }
      if ($email == "") {
        $error_arr[] = "Email";
      }
      if ($signupPassword == "") {
        $error_arr[] = "Password";
      }
      $error_message = "Please fill in the following fields: ";
      foreach ($error_arr as $key => $error) {
        if ($key == (sizeOf($error_arr) - 1)) {
          $error_message .= $error . ".";
        } else {
          $error_message .= $error . ", ";
        }
      }
    } else if ($email != $confirmEmail) {
      $error_message = "Emails do not match.";
      $email_error = "error";
    } else if ($signupPassword != $confirmPassword) {
      $error_message = "Passwords do not match.";
    } else if (!empty($exisitingEmail)) {
      $error_message = "An account already exists with this email. Try another or <a id='error-message-login' href='account.php?status=login'>Login</a>";
    } else if (!empty($existingUsername)) {
      $error_message = "Username is taken. Please try another or <a id='error-message-login' href='account.php?status=login'>Login</a>";
    } else if (strlen($signupPassword) < 10) {
      $error_message = "Password is too short.";
    }

    if (!isset($error_message)) {
      createAccount($account_id,$first_name,$last_name,$username,$email,$finalPassword,$salt);
      $_SESSION["account"]["account_id"] = $account_id;
      $_SESSION["account"]["first_name"] = $first_name;
      $_SESSION["account"]["last_name"] = $last_name;
      $_SESSION["account"]["usernname"] = $username;
      $_SESSION["account"]["email"] = $email;
      $_SESSION["account"]["password"] = $signupPassword;
      $_SESSION["account"]["salt"] = $salt;
      $_SESSION["account"]["saved_recipes"] = [];
      $_SESSION["loggedIn"] = 1;
      header("location:account.php?status=loggedIn&page=1");
      exit;
    }

  }

}

if ($_SESSION["loggedIn"] == 1) {
  $account = accountInfo($_SESSION["account"]["email"]);
  if (!empty($account["saved_recipes"])) {
    $saved_ids = explode(",",$account["saved_recipes"]);
    $saved_recipes = [];
  } else {
    $saved_ids = [];
  }
}

$recipes_per_page = 15;
$total_recipes = sizeOf($saved_ids);
$total_pages = ceil($total_recipes / $recipes_per_page);
if ($total_pages == 0) {
  $total_pages = 1;
}
if (isset($_GET["page"])) {
  $current_page = $_GET["page"];
} else {
  $current_page = 1;
}

if ($current_page > $total_pages) {
  $location = "location:account.php?";
  if ($_SESSION["loggedIn"] == 1) {
    $location .= "status=loggedIn&";
  }
  $location .= "page=$total_pages";
  header($location);
  exit;
}
$offset = (($current_page - 1) * $recipes_per_page);

if (!empty($saved_ids)) {
  $recipes = full_cookbook();
  $favorite_recipes = [];
  foreach ($saved_ids as $id) {
    $index = intval($id) - 1;
    $favorite_recipes[] = $recipes[$index];
  }
}

$page_title = "Favorites";
if (isset($_GET["status"])) {
  if (strtolower($_GET["status"]) == "login") {
    $page_title = "Login";
  } else if (strtolower($_GET["status"]) == "signup") {
    $page_title = "Signup";
  }
}

if ($_SESSION["loggedIn"] != 1) {
  $banner = "hidden";
}

include("inc/header.php");
?>

<section id="account-page" class="page-body">
  <?php if ($_GET["status"] == "login" || $_GET["status"] == "signup") { ?>
    <form id="account-form" method="post" action="account.php?status=<?php echo $_GET["status"]; ?>">
      <h1 id="account-title" class="title"><?php echo $page_title; ?></h1>
      <?php if (isset($error_message)) { ?>
        <div id="account-error-message">
          <?php echo $error_message; ?>
        </div>
      <?php } ?>
      <span style="display:none">
        <label for="full-name">Name</label>
        <input id="full-name" type="text" name="full-name" />
      </span>
      <?php if ($page_title == "Signup") { ?>
        <span id="signup-form" class="account-form-container">
          <label for="first-name">First Name:</label>
          <input id="first-name" type="text" name="first-name" value="<?php if (isset($first_name)) { echo $first_name; } ?>" />
          <label for="last-name">Last Name:</label>
          <input id="last-name" type="text" name="last-name" value="<?php if (isset($last_name)) { echo $last_name; } ?>"/>
          <label for="signup-username">Username:</label>
          <input id="signup-username" type="text" name="signup-username" value="<?php if (isset($username)) { echo $username; } ?>"/>
          <label for="signup-email">Email:</label>
          <input id="signup-email" type="text" name="signup-email" value="<?php if (isset($email)) { echo $email; } ?>"/>
          <label for="signup-email-confirm"> Confirm Email:</label>
          <input id="signup-email-confirm" type="text" name="signup-email-confirm" value="<?php if (isset($confirmEmail) && $email_error != "error") { echo $confirmEmail; } ?>"/>
          <label for="signup-password">Password:</label>
          <input id="signup-password" type="password" name="signup-password" />
          <label for="signup-password-confirm"> Confirm Password:</label>
          <input id="signup-password-confirm" type="password" name="signup-password-confirm" />
        </span>
      <?php } else if ($page_title == "Login") { ?>
        <span id="login-form" class="account-form-container">
          <label for="email-username">Username/Email:</label>
          <input id="email-username" type="text" name="email-username" value="<?php if (isset($email_username)) { echo $email_username; } ?>"/>
          <label for="login-password">Password:</label>
          <input id="login-password" type="password" name="login-password" />
        </span>
      <?php } ?>
      <button id="account-form-submit" type="submit"><?php echo $page_title; ?></button>
    </form>
  <?php } else if ($_GET["status"] == "loggedIn"){ ?>
    <?php if (!empty($favorite_recipes)) { ?>
      <div id="favorites-list-container">
        <ul id="account-favorite-list1" class="cookbook-list">
          <?php for ($i = $offset; $i < ($offset + $recipes_per_page); $i+=4) {
            if ($i < sizeOf($favorite_recipes)){
              echo display_recipes($favorite_recipes[$i],$saved_ids);
            }
          } ?>
        </ul>
        <ul id="account-favorite-list2" class="cookbook-list">
          <?php for ($i = ($offset + 1); $i < ($offset + $recipes_per_page); $i+=4) {
            if ($i < sizeOf($favorite_recipes)){
              echo display_recipes($favorite_recipes[$i],$saved_ids);
            }
          } ?>
        </ul>
        <ul id="account-favorite-list3" class="cookbook-list">
          <?php for ($i = ($offset + 2); $i < ($offset + $recipes_per_page); $i+=4) {
            if ($i < sizeOf($favorite_recipes)){
              echo display_recipes($favorite_recipes[$i],$saved_ids);
            }
          } ?>
        </ul>
        <ul id="account-favorite-list4" class="cookbook-list">
          <?php for ($i = ($offset + 3); $i < ($offset + $recipes_per_page); $i+=4) {
            if ($i < sizeOf($favorite_recipes)){
              echo display_recipes($favorite_recipes[$i],$saved_ids);
            }
          } ?>
        </ul>
      </div>

      <div id="account-pagination">
        <?php if ($current_page > 1) { ?>
          <a id="account-previous-page" href="account.php?status=loggedIn&amp;page=<?php echo ($current_page - 1); ?>">&lt;</a>
        <?php } ?>
        <span id="account-current-page"><?php echo $current_page ?></span> - <span id="account-total-pages"><?php echo $total_pages; ?></span>
        <?php if ($current_page < $total_pages) { ?>
          <a id="account-next-page" href="account.php?status=loggedIn&amp;page=<?php echo ($current_page + 1); ?>">&gt;</a>
        <?php } ?>
      </div>
    <?php }
  } ?>
</section>
<? include("inc/footer.php") ?>
