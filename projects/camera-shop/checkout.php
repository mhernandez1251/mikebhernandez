<?php
session_start();
include("inc/functions.php");
$orders_num = total_existing_order();
$order_complete = false;
if(empty($orders_num)){
  $new_order_id = 1;
} else {
  $new_order_id = count($orders_num) + 1;
}
if ($new_order_id < 10) {
  $new_order_id = "0" . $new_order_id;
}
$final_order = assign_order_keys($_SESSION["cart"]);
$totals = find_totals($_SESSION["cart"]);
$date = date("m-d-Y");
if ($_GET["status"] == "completed" && !empty($final_order)) {
  $cardholder_name = filter_input(INPUT_POST,"cardholder_name",FILTER_SANITIZE_STRING);
  $cardnumber = filter_input(INPUT_POST,"card_number",FILTER_SANITIZE_STRING);
  $expiration_year = filter_input(INPUT_POST,"expiration_year",FILTER_SANITIZE_STRING);
  $expiration_month = filter_input(INPUT_POST,"expiration_month",FILTER_SANITIZE_STRING);
  $ccv = filter_input(INPUT_POST,"ccv",FILTER_SANITIZE_NUMBER_INT);
  if ($cardholder_name == "" || $cardnumber == "" || $expiration_month == "Month" || $expiration_year == "Year" || $ccv == "") {
    $payment_error = "Please fill in all fields";
  } else {
    $expiration_date = $expiration_month . "/" . $expiration_year;
    $order_complete = true;
    add_order($new_order_id,$_SESSION["account"]["user_id"],serialize($final_order),$totals["final_total"],$date);
    $_SESSION["cart"] = array();
  }
}
include("inc/header.php");
?>
<section id="checkout-page" class="page-body">
  <h1 class="page-title">CHECKOUT</h1>
  <?php
    if ($order_complete == true) { ?>
      <p id="successful-order-message">SUCCESS!!! YOUR ORDER WAS PLACED!!!</p>
    <?php } elseif (empty($_SESSION["account"])) { ?>
      <h2><span id="checkout-login" class="checkout-select checkout-option">LOGIN</span> / <span id="checkout-signup" class="checkout-option">SIGN UP</span></h2>
      <div id='form-container'>
        <form method="post" action="user-account.php?status=login&amp;redirect=checkout">
          <span style='display:none'>
            <label for='last-last-name'>Last Last Name</label>
            <input id='last-last-name' type='text' name='last-last-name' />
          </span>
            <div id='account-signup' class="checkout-signup">
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
            <div id='account-login' class="checkout-signin">
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
    <?php } else { ?>
      <div id="cart-body">
        <table id="cart-table">
          <tr>
            <th class="item-details">ITEM DETAILS</th>
            <th class="item-price">PRICE</th>
            <th class="item-quantity">QUANTITY</th>
            <th class="item-total">TOTAL</th>
          </tr>
          <?php
            if (!empty($_SESSION["cart"])) {
              foreach ($_SESSION["cart"] as $key => $order) { ?>
                <tr class="<?php echo $key; ?>">
                  <td><?php echo $order[0]; ?></td>
                  <td>$<?php echo $order[1]; ?></td>
                  <td><?php echo $order[2]; ?></td>
                  <td>$<?php echo $order[3]; ?></td>
                </tr>
            <?php } } ?>
        </table>
        <?php
        if (empty($_SESSION["cart"])) {
          echo "<div class='empty-cart'>Cart is Empty</div>";
        }
         if (!empty($_SESSION["cart"])){ ?>
           <form id="payment-information" method="post" action="checkout.php?status=completed">
             <h4>Payment Information</h4>
             <?php
             if (isset($payment_error)) { ?>
               <p id="payment-error-message">
                 <?php echo $payment_error; ?>
               </p>
             <?php } ?>
             <span>
             <label for="cardholder-name">Cardholder's Name:</label>
             <input id="cardholder-name" type="text" name="cardholder_name" />
             </span>
             <span>
             <label for="card-name">Card Number:</label>
             <input id="card-number" type="text" name="card_number" />
           </span>
           <span>
             <label>Expiration Date:</label>
             <div id="expiration-date-container">
               <select id="expiration-month" name="expiration_month">
                 <option>Month</option>
                 <option value="01">Jan(01)</option>
                 <option value="02">Fed(02)</option>
                 <option value="03">Mar(03)</option>
                 <option value="04">Apr(04)</option>
                 <option value="05">May(05)</option>
                 <option value="06">June(06)</option>
                 <option value="07">July(07)</option>
                 <option value="08">Aug(08)</option>
                 <option value="09">Sep(09)</option>
                 <option value="10">Oct(10)</option>
                 <option value="11">Nov(11)</option>
                 <option value="12">Dec(12)</option>
               </select>
               <select id="expiration-year" name="expiration_year">
                 <option>Year</option>
                 <?php
                 $current_year = intval(date("Y"));
                 for ($i = 0; $i < 11; $i++) {?>
                   <option value="<?php echo $current_year?>"><?php echo $current_year; ?></option>
                 <?php
                 $current_year++;
                 }?>
               </select>
             </div>
           </span>
           <span>
             <label for="ccv">Card CCV:</label>
             <input id="ccv" type="text" name="ccv" />
           </span>
           <div id="totals">
             <span>Subtotal: $<?php echo $totals["subtotal"]; ?></span>
             <span>Tax: 10%</span>
             <span>Total: $<?php echo $totals["final_total"]; ?> </span>
             <hr />
             <button id="complete-order">COMPLETE ORDER</button>
           </div>
           </form>
         <?php } ?>
      </div>
      <?php } ?>
</section>
<?php include("inc/footer.php"); ?>
