<?php
session_start();
include("inc/functions.php");

$page_title = "Full Cookbook";
$recipes_per_page = 15;
if (isset($_GET["dish_type"])) {
  $dish_type = filter_input(INPUT_GET,"dish_type",FILTER_SANITIZE_STRING);
  switch ($dish_type) {
    case "breakfast":
      $page_title = "Breakfast";
      break;
    case "lunch":
      $page_title = "Lunch";
      break;
    case "dinner":
      $page_title = "Dinner";
      break;
    case "dessert":
      $page_title = "Dessert";
      break;
    case "vegetarian":
      $page_title = "Vegetarian";
      break;
    case "vegan":
      $page_title = "Vegan";
      break;
    default:
      $page_title = $dish_type;
      break;
  }
}

if (isset($_GET["search"])) {
  $search = filter_input(INPUT_GET,"search",FILTER_SANITIZE_STRING);
  $page_title = $search;
} else {
  $search = $page_title;
}

if (isset($_GET["page"])) {
  $current_page = filter_input(INPUT_GET,"page",FILTER_SANITIZE_STRING);
} else {
  $current_page = 1;
}

$offset = ($current_page - 1) * $recipes_per_page;

if ($page_title == "Full Cookbook") {
  $recipes = full_cookbook($recipes_per_page,$offset);
} else {
  $recipes = search_cookbook($search,$recipes_per_page,$offset);
}

if ($search == "Full Cookbook") {
  $total_recipes = total_recipes();
} else {
  $total_recipes = total_recipes($search);
}

$total_pages = ceil($total_recipes / $recipes_per_page);
if ($total_pages == 0) {
  $total_pages = 1;
}

if ($current_page > $total_pages) {
  $location = "location:cookbook.php?";
  if ($page_title != "Full Cookbook") {
    $dt = strtolower($page_title);
    $location .= "dish_type=$dt&";
  }
  $location .= "page=$total_pages";
  header($location);
  exit;
}

if ($_SESSION["loggedIn"] == 1) {
  $account = accountInfo($_SESSION["account"]["email"]);
  if (!empty($account["saved_recipes"])) {
    $saved_ids = explode(",",$account["saved_recipes"]);
  } else {
    $saved_ids = [];
  }
}

include("inc/header.php");
?>

<section id="cookbook-page" class="page-body">
  <?php if (!empty($recipes)) { ?>
    <div id="cookbook-list-container">
      <ul id="cookbook-list1" class="cookbook-list">
        <?php for ($i = 0; $i < sizeOf($recipes); $i += 4) {
          echo display_recipes ($recipes[$i],$saved_ids);
        } ?>
      </ul>
      <ul id="cookbook-list2" class="cookbook-list">
        <?php for ($i = 1; $i < sizeOf($recipes); $i += 4) {
          echo display_recipes ($recipes[$i],$saved_ids);
        } ?>
      </ul>
      <ul id="cookbook-list3" class="cookbook-list">
        <?php for ($i = 2; $i < sizeOf($recipes); $i += 4) {
          echo display_recipes ($recipes[$i],$saved_ids);
        } ?>
      </ul>
      <ul id="cookbook-list4" class="cookbook-list">
        <?php for ($i = 3; $i < sizeOf($recipes); $i += 4) {
          echo display_recipes ($recipes[$i],$saved_ids);
        } ?>
      </ul>
    </div>
  <?php } ?>
  <div id="pagination">
    <?php if ($current_page > 1) { ?>
      <span class="previous-page">
        <a href="cookbook.php?page=<?php echo ($current_page - 1); ?><?php if (isset($_GET["dish_type"])) { echo "&dish_type=" . $dish_type; } ?><?php if (isset($_GET["search"])) { echo "&search=" . $search; } ?>">&lt;</a>
      </span>
    <?php } ?>
    <span class="pagination-current"><?php echo $current_page; ?></span> - <span class="pagination-total"><?php echo $total_pages; ?></span>
    <?php if ($current_page < $total_pages) { ?>
      <span class="next-page">
        <a href="cookbook.php?page=<?php echo ($current_page + 1); ?><?php if (isset($_GET["dish_type"])) { echo "&dish_type=" . $dish_type; } ?><?php if (isset($_GET["search"])) { echo "&search=" . $search; } ?>">&gt;</a>
      </span>
    <?php } ?>
  </div>
</section>


<?php include("inc/footer.php"); ?>
