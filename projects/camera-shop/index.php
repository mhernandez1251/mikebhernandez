<?php
session_start();
include('inc/header.php');
include('inc/functions.php');
$section = null;
?>
<section>
  <div id="splash-page" class="section-container">
    <h1>THIS IS THE<br />CAMERA SHOP </h1>
  </div>
</section>

<section>
  <div id="main-body" class="section-container">
    <h2>SHOP</h2>
    <!-- CREATE ITEMs LIST FROM INFORMATION ARRAY -->
    <?php
    $random = random_catalog_array();
    foreach ($random as $item) {
      echo displayItemList ($item);
    }
    ?>
    <a id="full-catalog" href="catalog.php?page=1">-FULL CATALOG-</a>
  </div>
</section>
<?php include 'inc/footer.php' ?>
