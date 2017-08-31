<?php
session_start();
if (!empty($_POST["cart"])) {
  $_SESSION["cart"] = $_POST["cart"];
}
if ($_POST["action"] == "empty") {
  $_SESSION["cart"] = array();
  header("location:cart.php");
}
if ($_POST["action"] == "delete" && $_POST["cart"] == null) {
  $_SESSION["cart"] = array();
  header("location:cart.php");
}
include("inc/functions.php");
include("inc/header.php");
if (!empty($_SESSION["cart"])) {
  $totals = find_totals($_SESSION["cart"]);
}
 ?>
<section id="cart-page" class="page-body">
  <h1 class="page-title">CART</h1>
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
              <td><?php echo $order[0] ?></td>
              <td><?php echo "$" . $order[1] ?></td>
              <td class="quantity-data">
                <select class='item-quantity'>
                  <option value="1"<?php if ($order[2] == 1){ echo "selected=selected";}?>>1</option>
                  <option value="2"<?php if ($order[2] == 2){ echo "selected=selected";}?>>2</option>
                  <option value="3"<?php if ($order[2] == 3){ echo "selected=selected";}?>>3</option>
                  <option value="4"<?php if ($order[2] == 4){ echo "selected=selected";}?>>4</option>
                  <option value="5"<?php if ($order[2] == 5){ echo "selected=selected";}?>>5</option>
                </select>
                <a class="delete-item" href="cart.php">DELETE</a>
              </td>
              <td><?php echo "$" . $order[3]?></td>
            </tr>
        <?php } } ?>
    </table>
    <?php
    if (empty($_SESSION["cart"])) {
      echo "<div class='empty-cart'>Cart is Empty</div>";
    }
     if (!empty($_SESSION["cart"])){ ?>
       <div id="totals">
         <span>Subtotal: $<?php echo $totals["subtotal"]; ?></span>
         <span>Tax: 10%</span>
         <span>Total: $<?php echo $totals["final_total"]; ?> </span>
         <div id="checkout-info">
           <a id='update-quantity' href='cart.php'>UPDATE</a>
           <a id="clear-cart" href="cart.php">CLEAR CART</a>
           <a id="checkout" href="checkout.php">CHECKOUT</a>
         </div>
       </div>

     <?php } ?>
  </div>
</section>
 <?php
 include("inc/footer.php");
 ?>
