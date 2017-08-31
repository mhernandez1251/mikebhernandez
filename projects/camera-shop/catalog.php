<?php
session_start();
include ('inc/functions.php');

$catalogTitle = 'CATALOG';
$section = null;
$items_per_page = 4;

if(isset($_GET["search"])){
  switch ($_GET["search"]) {
  case "film":
    $catalogTitle = 'FILM CAMERAS';
    $section = 'film';
    break;
  case "digital":
    $catalogTitle = 'DIGITAL CAMERAS';
    $section = 'digital';
    break;
  case "lenses":
    $catalogTitle = 'LENSES';
    $section = 'lenses';
    break;
  case "accessories":
    $catalogTitle = 'ACCESSORIES';
    $section = 'accessories';
    break;
  case "drones":
    $catalogTitle = 'DRONES';
    $section = 'drones';
    break;
  case "bags":
    $catalogTitle = 'BAGS';
    $section = 'bags';
    break;
  default:
    $catalogTitle = 'CATALOG';
    $section = $_GET["search"];
    break;
  }
}
if (isset($_POST["search"])) {
  $section = $_POST["search"];
}

if (isset($_GET["page"])) {
  $current_page = filter_input(INPUT_GET,"page",FILTER_SANITIZE_NUMBER_INT);
}

if (empty($current_page) || $current_page == 0 ) {
  $current_page = 1;
}

$total_items = total_item_count($section);
$total_pages = ceil($total_items / $items_per_page);
if ($total_pages == 0) {
  $total_pages = 1;
}

$limit_results = "";
if (!empty($section)) {
  $limit_results = "cat=" . $section . "&";
}

if ($current_page > $total_pages) {
  header("location:catalog.php?". $limit_results . "page=" . $total_pages);
}

if ($current_page < 1) {
  header("location:catalog.php?page=1");
}

//$offset is the number of items before that page, if number of items per page is 8 and you are on page 3, you are two pages past the first item or 16 items past the start
$offset = ($current_page -1) * $items_per_page;

if (empty($section)) {
  $itemArr = full_catalog_array($items_per_page,$offset);
} else {
  $itemArr = category_catalog_array($section,$items_per_page,$offset);
}
include ('inc/header.php');
 ?>
<section id="catalog-section" class="page-body">
  <h1 class="page-title"><?php if ($catalogTitle != "CATALOG") { echo "<a href='catalog.php?page=1'>CATALOG</a> | " . $catalogTitle; } else { echo $catalogTitle; } ?></h1>
  <div class="catalog-wrapper">
    <?php
    $categories = array_category($itemArr,$section);
    asort($categories);
        foreach ($categories as $items) {
          echo displayItemList ($itemArr[$items]);
        }
   if(empty($itemArr)){
     echo "<p id='no-items-message'>NO ITEMS FOUND</p>";
   }
       ?>
  </div>
  <div id="pagination">
    <?php if ($current_page > 1) { ?>
      <a href="catalog.php?<?php if (!empty($section)){ echo "search=" . $section . "&amp;"; }?><?php echo "page=" . ($current_page - 1); ?>">&lt;</a>
    <?php } ?>
    <p><?php echo $current_page . " - " . $total_pages; ?></p>
    <?php if ($current_page < $total_pages) { ?>
      <a href="catalog.php?<?php if (!empty($section)){ echo "search=" . $section . "&amp;"; }?><?php echo "page=" . ($current_page + 1); ?>">&gt;</a>
    <?php } ?>
  </div>
</section>
<?php include ('inc/footer.php') ?>
