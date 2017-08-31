<?php
session_start();
include('inc/functions.php');

if (isset($_GET["id"]) || $_GET["id"] != "") {
  $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
  $item = single_item_array($id);
}
if(empty($item)){
  header("location:catalog.php");
  exit;
}

include ('inc/header.php');
?>
<section class="page-body">
  <div class="item-wrapper">
    <h1 class="page-title"><?php echo "<a class='item-cat' href='catalog.php?search=" . $item["category"] . "&page=1'>". strtoupper($item["category"]) . "</a> | " . $item["h3"]; ?></h1>
    <img src='<?php echo $item["imgSrc"]; ?>' alt='<?php echo $item["alt"]; ?>' />

      <div id="item-page-buy-options">
        <p class='item-buy-price'><?php echo "$" . $item["price"]; ?></p>
        <div class='quantity-container'>
          <p class='quantity-label'>Quantity:</p>
          <select class='item-quantity'>
            <optgroup>
              <option value='1'>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
            </optgroup>
          </select>
        </div>
        <div class='buy-overlay-options'>
          <a id='item-page-buy' href="#">Add To Cart</a>
        </div>
      </div>

    <div class='success-overlay'>
      <p>ADDED TO CART!</p>
    </div>
    <div id="item-description">
      <h2 class="spec-section-title">Specs</h2>
      <ul id="item-specs">
        <?php if (!empty($item["specs"])) {
          echo $item["specs"];
        } ?>
      </ul>
    </div>
  </div>
</section>
<script>
  var $item = <?php echo json_encode($item); ?>;
</script>
<?php include ('inc/footer.php') ?>
