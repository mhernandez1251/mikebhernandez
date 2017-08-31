<?php
session_start();
include("inc/functions.php");
if ($_GET["action"] == "delete") {
  delete_account($_SESSION["user_id"]);
  session_destroy();
  session_start();
  header("location:user-account.php?status=login");
} else if ($_GET["action"] == "logout") {
  session_destroy();
  session_start();
  header("location:user-account.php?status=login");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_GET["status"] == "signup") {
    $firstName = trim(filter_input(INPUT_POST,"first-name",FILTER_SANITIZE_STRING));
    $lastName = trim(filter_input(INPUT_POST,"last-name",FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
    $username = trim(filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS));
    $setPassword = $_POST["set-password"];
    $confirmPassword = $_POST["confirm-password"];
    $salt = random_salt();
    $finalPassword = sha1($setPassword . $salt);
	  $status = "signup";
    $accounts = accounts_array();
    if (empty($accounts)) {
      $user_id = "01";
    } else {
      if (count($accounts) < 10) {
        $user_id = "0" . (count($accounts) + 1);
      } else {
        $user_id = (count($accounts) + 1);
      }
    }
	  $existingUser = existing_username_array($username);
    $existingEmail = existing_email_array($email);
    if ($firstName == "" || $lastName == "" || $email == "" || $username == "" || $setPassword == "" || $confirmPassword == "") {
      $errorList = [];
      if ($firstName == "") {
        $errorList[] = "First Name";
      }
      if ($lastName == "") {
        $errorList[] = "Last Name";
      }
      if ($email == "") {
        $errorList[] = "Email";
      }
      if ($username == "") {
        $errorList[] = "Username";
      }
      if ($setPassword == "") {
        $errorList[] = "Password";
      }
      if ($confirmPassword == "") {
        $errorList[] = "Confirm Password";
      }
      $error_message = "Please fill in the required fields: ";
      foreach ($errorList as $key => $missingItem) {
        $error_message .= $missingItem;
        if((count($errorList) - 1) == $key) {
          $error_message .= ".";
        }else {
          $error_message .= ", ";
        }
      }
    } elseif ($setPassword != $confirmPassword) {
      $error_message =  "PASSWORDS DO NOT MATCH!";
    } elseif (strlen($setPassword) < 8 ) {
	    $error_message = "PASSWORDS IS TOO SHORT!";
    } elseif(!empty($existingUser)) {
		  $error_message = "Username already taken, please choose another.";
    } elseif (!empty($existingEmail)) {
      $error_message = "An account already exists for this email. Choose another or <a class='error-login' href='user.account.php?status=login'>LOGIN</a>";
    } else {
		  $status = "success";
      $_SESSION["login_status"] = 1;
      create_new_account($user_id,$firstName,$lastName,$username,$email,$finalPassword,$salt);
      $_SESSION["firstName"] = $firstName;
      $_SESSION["lastName"] = $lastName;
      $_SESSION["username"] = $username;
      $_SESSION["email"] = $email;
	  }
    $_SESSION["account"] = existing_username_array($username);
  } elseif ($_GET["status"] == "login") {
      if (isset($_SESSION["login_status"])) {
        session_destroy();
        session_start();
        $status= "login";
      } else {
        $loginUsername = trim(filter_input(INPUT_POST,"login-username",FILTER_SANITIZE_SPECIAL_CHARS));
        $loginPassword = $_POST["login-password"];
    	  $status = "login";
  	    $existingUser = existing_username_array($loginUsername);
        $password = sha1($loginPassword . $existingUser["salt"]);
        $_SESSION["firstName"] = $existingUser["first_name"];
        $_SESSION["lastName"] = $existingUser["last_name"];
        $_SESSION["username"] = $existingUser["username"];
        $_SESSION["email"] = $existingUser["email"];
        if ($loginUsername == "" || $loginPassword == "") {
        $errorList = [];
        if ($loginUsername == "") {
          $errorList[] = "Username";
        }
        if ($loginPassword == "") {
          $errorList[] = "Password";
        }
        $error_message = "Please fill in the required fields: ";
        foreach ($errorList as $key => $missingItem) {
          $error_message .= $missingItem;
          if((count($errorList) - 1) == $key) {
            $error_message .= ".";
          }else {
            $error_message .= ", ";
          }
        }
      } elseif (empty($existingUser)) {
  		$error_message = "User does not exist, please enter valid username";
    	} elseif ($existingUser["password"] != $password) {
        $error_message = "Invalid Username/Password combination. Please try logging in again.";
      } else {
          $status = "success";
          $_SESSION["login_status"] = 1;
          $_SESSION["account"] = $existingUser;
      }
    }
  }
  if (!isset($error_message) && $_POST["last-last-name"] != "") {
    $error_message = "ERROR!!! BAD FORM ENTRY!!!";
  }
  if(empty($error_message)){
    if($_GET["redirect"] == "checkout"){
      header("location:checkout.php");
      exit;
    } else {
      header("location:user-account.php?status=$status");
      exit;
    }
  }
}
if(isset($_SESSION["account"]) && !empty($_SESSION["account"])){
  $_SESSION["firstName"] = $_SESSION["account"]["first_name"];
  $_SESSION["lastName"] = $_SESSION["account"]["last_name"];
  $_SESSION["username"] = $_SESSION["account"]["username"];
  $_SESSION["email"] = $_SESSION["account"]["email"];
  $_SESSION["user_id"] = $_SESSION["account"]["user_id"];
}

$order_history = order_history_array($_SESSION["user_id"]);

$pageTitle = "Thank you";
$section = null;

include("inc/header.php");
?>
<div id="user-section">
  <h1 class="page-title"><?php if (isset($_GET["status"])) {
    if($_GET["status"] == "success"){
      echo "Welcome " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "!";
    }elseif($_GET["status"] == "signup"){
      echo "SIGN UP";
    }elseif($_GET["status"] == "login"){
      echo "LOGIN FORM";
    }
  } ?></h1>
  <?php if ($_GET["status"] == "login" || $_GET["status"] == "signup"){ ?>
	<?php if(isset($error_message)){ echo "<p id='signup-error-message'>" . $error_message . "</p>"; } ?>
  <div id='form-container'>
    <form method="post" action="user-account.php?status=<?php echo $_GET["status"]; ?>">
      <span style='display:none'>
        <label for='last-last-name'>Last Last Name</label>
        <input id='last-last-name' type='text' name='last-last-name' />
      </span>
        <div id='account-signup' class='<?php if($_GET["status"] == "login") {echo "hidden";} ?>'>
          <div id='name-container'>
            <label for='first-name'>First Name</label>
            <input id='first-name' type='text' name='first-name' value="<?php if(isset($firstName)){echo htmlspecialchars($_POST["first-name"]);} ?>"/>
            <label for='last-name'>Last Name</label>
            <input id='last-name' type='text' name='last-name' value="<?php if(isset($lastName)){echo htmlspecialchars($_POST["last-name"]);} ?>"/>
          </div>
          <span>
            <label for='email'>Email</label>
            <input id='email' type='text' name='email' value="<?php if(isset($email)){echo htmlspecialchars($_POST["email"]);} ?>" />
          </span>
          <span>
            <label for='username'>Username</label>
            <input id='username' type='text' name='username' value="<?php if(isset($username)){echo htmlspecialchars($_POST["username"]);} ?>"/>
          </span>
          <div id='password-container'>
      		<span>
              <label for='set-password'>Password (at least 8 characters)</label>
              <input id='set-password' type='password' name='set-password' />
      		</span>
      		<span>
              <label for='confirm-password'>Confirm Password</label>
              <input id='confirm-password' type='password' name='confirm-password' />
      		</span>
          </div>
        </div>
        <div id='account-login'class='<?php if($_GET["status"] == "signup") {echo "hidden";} ?>'>
          <label for='login-username'>Username</label>
          <input id='login-username' type='text' name='login-username' value="<?php if(isset($loginUsername)){echo htmlspecialchars($_POST["login-username"]);} ?>"/>
          <label for='login-password'>Password</label>
          <input id='login-password' type='password' name='login-password' value="<?php if(isset($loginPassword)){echo htmlspecialchars($_POST["login-password"]);} ?>"/>
        </div>
        <div class='form-button-container'>
          <button class='form-reset' type='reset'>Reset</button>
          <button class='form-submit' type='submit'>Submit</button>
        </div>
      </form>
    </div>
    <?php }
    if($_GET["status"] == "success") { ?>
    <div id="success-container">
      <div id="success-container-lists">
        <p>ORDER HISTORY</p>
        <ul id="account-order-history">
          <?php foreach ($order_history as $item) { ?>
            <li>Order Num: <a class="order-number" href="order.php?order=<?php echo $item["order_id"]; ?>"><?php echo $item["order_id"] ?></a> <br /> Date: <?php echo $item["date"]; ?> <br /> Total: <?php echo "$" . $item["order_total"]; ?></li>
          <?php } ?>
        </ul>
      </div>
      <div id="account-action-buttons">
        <a id="account-logout" href="user-account.php?action=logout">LOG OUT</a>
        <button id="account-delete">DELETE ACCOUNT</button>
      </div>
    </div>
    <?php } ?>
</div>
<div id="delete-account-container" class="hidden">
  <div id="delete-account-message">
    <p>Are you sure you want to delete your account?</p>
    <div id="delete-account-buttons-container">
      <a id="confirm-account-delete" class="delete-account-button" href="user-account.php?action=delete">DELETE</a>
      <button id="cancel-account-delete" class="delete-account-button">CANCEL</button>
    </div>
  </div>
</div>
<?php
include("inc/footer.php");
 ?>
