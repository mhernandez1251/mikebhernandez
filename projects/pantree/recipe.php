<?php
session_start();
include("inc/functions.php");
$banner = "hidden";
$linebreak = "&#13;&#10;";
$recipe = single_recipe($_GET["id"]);
if (!empty($recipe)) {
  $page_title = $recipe["title"] ." | Pantree";
  $page_header = $recipe["title"];
} else {
  $page_title = "Recipe Not Found";
  $page_header = "Recipe Not Found";
}
$ingredients = $recipe["ingredients"];
$ingredients = str_replace("&#9;"," ",$ingredients);
$ingredients = explode("$linebreak",$ingredients);
$directions = explode("&#13;&#10;",$recipe["directions"]);

include("inc/header.php");
?>

<section id="recipe-page" class="page-body">
  <h1 id="recipe-title" class="title"><?php echo $page_header; ?></h1>
  <?php if (!empty($recipe)) { ?>
    <div id="recipe-attribution">
      <span id="recipe-author"><?php echo $recipe["author"] ?></span> | <span id="recipe-date"><?php echo $recipe["date_added"] ?></span>
    </div>
    <img id="recipe-img" src="<?php echo $recipe["img_src"]; ?>" />
    <div id="recipe-origin">
      Original Recipe: <a id="original-link" href="<?php echo $recipe["original_link"] ?>"><?php echo $recipe["original_website"] ?></a>
    </div>
    <div id="recipe-stats">
      <span id="recipe-yield">Yield: <?php echo $recipe["yield"]; ?></span> <span id="recipe-times"> Prep Time: <?php echo $recipe["time_prep"]; ?> | Cook Time: <?php echo $recipe["time_cook"]; ?></span>
    </div>
    <div id="recipe-lists-container">
      <div id="recipe-ingredients">
        <h6 id="ingredients-title" class="section-title">Ingredients: </h6>
        <ul id="ingredients-list" class="recipe-list">
          <?php foreach ($ingredients as $ingredient) { ?>
            <li class="recipe-list-item"><span><?php echo $ingredient; ?></span></li>
          <?php } ?>
        </ul>
      </div>
      <div id="recipe-directions">
        <h6 id="directions-title" class="section-title">Directions:</h6>
        <ol id="directions-list" class="recipe-list">
          <?php foreach ($directions as $direction) { ?>
            <li class="recipe-list-item"><span><?php echo $direction; ?></span></li>
          <?php } ?>
        </ol>
      </div>
    </div>
  <?php } ?>

</section>

<?php include("inc/footer.php"); ?>
