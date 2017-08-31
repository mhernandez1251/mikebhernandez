<?php
session_start();
include("inc/functions.php");

$order= get_order_details($_GET["order"]);
if ($order["user_id"] != $_SESSION["user_id"]) {
  header("location:catalog.php?page=1");
  exit;
}
$order_details = unserialize($order["order_details"]);
$totalArr = [];
foreach ($order_details as $item) {
  array_push($totalArr,$item["total"]);
};
function add ($a,$b) {
  return $a+$b;
}
$subtotal = array_reduce($totalArr,"add");
$final_total = ($subtotal +($subtotal * .1));
$final_total = number_format($final_total,2,'.','');

include("inc/header.php");
?>
<section class="page-body">
  <section id="checkout-page" class="page-body">
    <h1 class="page-title">ORDER HISTORY</h1>
        <div id="cart-body">
          <table id="cart-table">
            <tr>
              <th class="item-details">ITEM DETAILS</th>
              <th class="item-price">PRICE</th>
              <th class="item-quantity">QUANTITY</th>
              <th class="item-total">TOTAL</th>
            </tr>
            <?php foreach ($order_details as $item) { ?>
            <tr>
              <td><?php echo $item["item-detail"]; ?></td>
              <td>$<?php echo $item["price"]; ?></td>
              <td><?php echo $item["quantity"]; ?></td>
              <td>$<?php echo $item["total"]; ?></td>
            </tr>
            <?php } ?>
          </table>
             <div id="totals">
               <span>Subtotal: $<?php echo $subtotal; ?></span><br />
               <span>Tax: 10%</span><br />
               <span>Total: $<?php echo $final_total; ?> </span><br />
             </div>
        </div>
  </section>
</section>
<?php include("inc/footer.php") ?>
