<?php
session_start();
include("inc/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $count = total_recipes();
  if ($count == 0) {
    $recipe_id = "01";
  } elseif (($count + 1) < 10) {
    $recipe_id = "0" . ($count + 1);
  } else {
    $recipe_id = $count + 1;
  }
  $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_STRING);
  $author = filter_input(INPUT_POST,"author",FILTER_SANITIZE_STRING);
  $date_added = date("F d, Y");
  $keywords = filter_input(INPUT_POST,"keywords",FILTER_SANITIZE_STRING);
  $original_link = filter_input(INPUT_POST,"original_link",FILTER_SANITIZE_STRING);
  $original_website = filter_input(INPUT_POST,"original_website",FILTER_SANITIZE_STRING);
  $yield = filter_input(INPUT_POST,"yield",FILTER_SANITIZE_STRING);
  $dish_type = $_POST["dish_type"];
  $ingredients = filter_input(INPUT_POST,"ingredients",FILTER_SANITIZE_SPECIAL_CHARS);
  $directions = filter_input(INPUT_POST,"directions",FILTER_SANITIZE_SPECIAL_CHARS);
  if (!empty($_POST["special_attr"])) {
    $special_attr = implode(",",$_POST["special_attr"]);
  } else {
    $special_attr = "none";
  }
  $time_prep = filter_input(INPUT_POST,"time_prep",FILTER_SANITIZE_STRING);
  $time_cook = filter_input(INPUT_POST,"time_cook",FILTER_SANITIZE_STRING);
  $img_src = $_FILES["img_src"];

  if ($_SESSION["loggedIn"] != 1) {
    $error_message = "You must be logged in before adding a new recipe";
  } else if ($title == "" || $author == "" || $keywords == "" || $yield == "" || $ingredients == "" || $directions == "" || $img_src == "" || $time_prep == "" || $time_cook == "") {
    $error_arr = [];
    if ($title == "") {
      $error_arr[] = "Title";
    }
    if ($author == "") {
      $error_arr[] = "Author";
    }
    if ($keywords == "") {
      $error_arr[] = "Keywords";
    }
    if ($yield == "") {
      $error_arr[] = "Yield";
    }
    if ($ingredients == "") {
      $error_arr[] = "Ingredients";
    }
    if ($directions == "") {
      $error_arr[] = "Directions";
    }
    if ($img_src == "") {
      $error_arr[] = "Image";
    }
    if ($time_prep == "") {
      $error_arr[] = "Prep Time";
    }
    if ($time_cook == "") {
      $error_arr[] = "Cook Time";
    }

    if (!empty($error_arr)) {
      $error_message = "Please fill in the following fields: ";
      foreach ($error_arr as $key => $error) {
        if ($key == 0) {
          $error_message .= $error;
        } else {
          $error_message .= ", " . $error;
        }
      }
    }
  } else {
    $check = search_recipe($title);
    if (!empty($check)) {
      $error_message = "Recipe already exits!!!";
    }
  }

  if (!isset($error_message)) {
    $target_dir = "../../img/pantree/" . $dish_type . "/";
    $target_file = $target_dir . basename($_FILES["img_src"]["name"]);
    $file_ext = pathinfo($target_file)["extension"];
    if (file_exists($target_file)) {
      $error_message = "The image already exists";
    } else if ($file_ext != "jpg" && $file_ext != "jpeg" && $file_ext != "png" && $file_ext != "JPG" && $file_ext != "PNG" && $file_ext != "JPEG") {
      $error_message = "Invalid image format. Images Must be JPG, JPEG, or PNG";
    } else if ($_FILES["img_src"]["size"] > 500000) {
      $error_message = "Image is too big";
    } else {
      if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $target_file)) {
        $image = $target_file;
      } else  {
        $error_message = "Unable to add recipe at this time";
      }
    }
  }

  if (empty($error_message)) {
    add_recipe ($recipe_id, $title, $author, $date_added, $keywords, $original_link, $original_website, $yield, $dish_type, $ingredients, $directions, $special_attr);
    add_img ($recipe_id, $image);
    add_times ($recipe_id, $time_prep, $time_cook);
    header("location:new-recipe.php?status=success");
    exit;
  }
}

$page_title = "Add New Recipe";
$banner = "hidden";

include("inc/header.php");
?>

<section id="new-recipe-page" class="page-body">
  <h1 id="new-recipe-title" class="title">Add New Recipe</h1>
  <?php if (isset($error_message)) { ?>
    <div id="new-recipe-error-message"><?php echo $error_message; ?></div>
  <?php } elseif ($_GET["status"] == "success") { ?>
    <div id="success-message"> Success!!! Your recipe was added!!!</div>
  <?php } ?>
  <div id="error_message"></div>
  <form id="new-recipe-form" method="post" action="new-recipe.php" enctype="multipart/form-data">
    <div id="inner-form-container">
      <label for="title">Title</label>
      <input id="title" type="text" name="title" value="<?php if(isset($_POST["title"])){ echo $_POST["title"]; }?>" />
      <label for="author">Author</label>
      <input id="author" type="text" name="author" value="<?php if(isset($_POST["author"])){ echo $_POST["author"]; }?>"/>
      <label for="img_src">Image</label>
      <input id="img_src" type="file" name="img_src"/>
      <img id="preview-img" src="#" class="hidden"/>
      <label for="original_link">Original Link</label>
      <input id="original_link" type="text" name="original_link" value="<?php if(isset($_POST["original_link"])){ echo $_POST["original_link"]; }?>"/>
      <label for="original_website">Original Website</label>
      <input id="original_website" type="text" name="original_website" value="<?php if(isset($_POST["original_website"])){ echo $_POST["original_website"]; }?>"/>
      <label for="keywords">Keywords</label>
      <input id="keywords" type="text" name="keywords" value="<?php if(isset($_POST["keywords"])){ echo $_POST["keywords"]; }?>"/>
      <label for="yield">Yield</label>
      <input id="yield" type="text" name="yield" value="<?php if(isset($_POST["yield"])){ echo $_POST["yield"]; }?>"/>
    </div>
    <div id="time-form-container">
      <span id="prep-time">
        <label for="time_prep">Prep Time</label>
        <input id="time_prep" type="text" name="time_prep" value="<?php if(isset($_POST["time_prep"])){ echo $_POST["time_prep"]; }?>"/>
      </span>
      <span id="cook-time">
        <label for="time_cook">Cook Time</label>
        <input id="time_cook" type="text" name="time_cook" value="<?php if(isset($_POST["time_cook"])){ echo $_POST["time_cook"]; }?>"/>
      </span>
    </div>
    <label for="dish_type">Dish Type</label>
    <select id="dish_type" name="dish_type">
      <option value="breakfast">Breakfast</option>
      <option value="lunch">Lunch</option>
      <option value="dinner">Dinner</option>
      <option value="dessert">Dessert</option>
    </select>
    <div id="special-attribute-container">
      <label>Special Attribute: </label>
      <span class="attribute"><input type="checkbox" name="special_attr[]" value="vegetarian" />Vegetarian</span>
      <span class="attribute"><input type="checkbox" name="special_attr[]" value="vegan" />Vegan</span>
      <span class="attribute"><input type="checkbox" name="special_attr[]" value="kosher" />Kosher</span>
      <span class="attribute"><input type="checkbox" name="special_attr[]" value="gluten-free" />Gluten-Free</span>
    </div>
    <label for="ingredients">Ingredients</label>
    <textarea id="ingredients" name="ingredients"></textarea>
    <label for="directions">Directions</label>
    <textarea id="directions" name="directions"></textarea>
    <button id="add-recipe-button" type="submit">Add Recipe</button>
  </form>
</section>

<?php include("inc/footer.php"); ?>
