<?php
function full_cookbook ($limit = null, $offset = 0) {
  include("connection.php");

  $sql = "SELECT * FROM recipes INNER JOIN images ON recipes.recipe_id = images.recipe_id INNER JOIN times ON recipes.recipe_id = times.recipe_id";
  if (is_integer($limit)) {
    $results = $con->prepare($sql . " LIMIT ? OFFSET ?");
    $results->bindParam(1,$limit,PDO::PARAM_INT);
    $results->bindParam(2,$offset,PDO::PARAM_INT);
  } else {
    $results = $con->prepare($sql);
  }
  $results->execute();
  $recipes = $results->fetchAll(PDO::FETCH_ASSOC);

  return $recipes;
}

function favorite_cookbook ($favorites = null) {
  include("connection.php");

  $sql = "SELECT * FROM recipes INNER JOIN images ON recipes.recipe_id = images.recipe_id INNER JOIN times ON recipes.recipe_id = times.recipe_id";
  if (!empty($favorites)) {

    $results = $con->prepare($sql . " WHERE recipes.recipe_id = ?");
    foreach($favorites as $key => &$favorite){
      $results->bindParam(1,$favorite,PDO::PARAM_STR);
    }
    } else {
      $results = $con->prepare($sql);
    }
  $results->execute();
  $recipes = $results->fetchAll(PDO::FETCH_ASSOC);

  return $recipes;
}

function search_cookbook ($search, $limit = null, $offset) {
  include("connection.php");

  $search = "%". strtolower($search) . "%";

  $sql = "SELECT * FROM recipes INNER JOIN images ON recipes.recipe_id = images.recipe_id INNER JOIN times ON recipes.recipe_id = times.recipe_id WHERE recipes.dish_type LIKE ? OR recipes.ingredients LIKE ? OR recipes.title LIKE ? OR recipes.keywords LIKE ? OR recipes.special_attr LIKE ?";
  if (is_integer($limit)) {
    $results = $con->prepare($sql . " LIMIT ? OFFSET ?");
    $results->bindParam(1,$search,PDO::PARAM_INT);
    $results->bindParam(2,$search,PDO::PARAM_INT);
    $results->bindParam(3,$search,PDO::PARAM_INT);
    $results->bindParam(4,$search,PDO::PARAM_INT);
    $results->bindParam(5,$search,PDO::PARAM_INT);
    $results->bindParam(6,$limit,PDO::PARAM_INT);
    $results->bindParam(7,$offset,PDO::PARAM_INT);
  } else {
    $results = $con->prepare($sql);
    $results->bindParam(1,$search,PDO::PARAM_INT);
    $results->bindParam(2,$search,PDO::PARAM_INT);
    $results->bindParam(3,$search,PDO::PARAM_INT);
    $results->bindParam(4,$search,PDO::PARAM_INT);
    $results->bindParam(5,$search,PDO::PARAM_INT);
  }
  $results->execute();
  $recipes = $results->fetchAll(PDO::FETCH_ASSOC);

  return $recipes;
}

function search_recipe($search) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM recipes WHERE LOWER(title) LIKE ?");
  $results->bindParam(1,strtolower($search),PDO::PARAM_STR);
  $results->execute();
  $recipe = $results->fetchAll();

  return $recipe;
}

function single_recipe ($id = null) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM recipes INNER JOIN images ON recipes.recipe_id = images.recipe_id INNER JOIN times ON recipes.recipe_id = times.recipe_id WHERE recipes.recipe_id = ?");
  $results->bindParam(1,$id,PDO::PARAM_STR);
  $results->execute();
  $recipe = $results->fetch(PDO::FETCH_ASSOC);
  return $recipe;
}

function total_recipes ($search = null) {
  include("connection.php");

  $sql = "SELECT COUNT(recipe_id) FROM recipes";
  if (!empty($search)) {
    $search = "%" . strtolower($search) . "%";
    $results = $con->prepare($sql . " WHERE title LIKE ? OR ingredients LIKE ? OR dish_type LIKE ? OR keywords LIKE ?");
    $results->bindParam(1,$search,PDO::PARAM_STR);
    $results->bindParam(2,$search,PDO::PARAM_STR);
    $results->bindParam(3,$search,PDO::PARAM_STR);
    $results->bindParam(4,$search,PDO::PARAM_STR);
  } else {
    $results = $con->prepare($sql);
  }
  $results->execute();
  $count = $results->fetchColumn(0);

  return $count;
}

function add_recipe ($recipe_id, $title, $author, $date_added, $keywords, $original_link, $original_website, $yield, $dish_type, $ingredients, $directions, $special_attr) {
  include("connection.php");

  $sql = "INSERT INTO recipes
  (recipe_id, title, author, date_added, keywords, original_link, original_website, yield, dish_type, ingredients, directions, special_attr)
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
  $results = $con->prepare($sql);
  $results->bindParam(1,$recipe_id,PDO::PARAM_STR);
  $results->bindParam(2,$title,PDO::PARAM_STR);
  $results->bindParam(3,$author,PDO::PARAM_STR);
  $results->bindParam(4,$date_added,PDO::PARAM_STR);
  $results->bindParam(5,$keywords,PDO::PARAM_STR);
  $results->bindParam(6,$original_link,PDO::PARAM_STR);
  $results->bindParam(7,$original_website,PDO::PARAM_STR);
  $results->bindParam(8,$yield,PDO::PARAM_STR);
  $results->bindParam(9,$dish_type,PDO::PARAM_STR);
  $results->bindParam(10,$ingredients,PDO::PARAM_STR);
  $results->bindParam(11,$directions,PDO::PARAM_STR);
  $results->bindParam(12,$special_attr,PDO::PARAM_STR);
  $results->execute();
  return false;
}

function add_img ($recipe_id, $image) {
  include("connection.php");

  $results = $con->prepare("INSERT INTO images (recipe_id, img_src) VALUES (?,?)");
  $results->bindParam(1,$recipe_id,PDO::PARAM_STR);
  $results->bindParam(2,$image,PDO::PARAM_STR);
  $results->execute();
}

function add_times ($recipe_id, $time_prep, $time_cook) {
  include("connection.php");

  $results = $con->prepare("INSERT INTO times (recipe_id, time_prep, time_cook) VALUES (?,?,?)");
  $results->bindParam(1,$recipe_id,PDO::PARAM_STR);
  $results->bindParam(2,$time_prep,PDO::PARAM_STR);
  $results->bindParam(3,$time_cook,PDO::PARAM_STR);
  $results->execute();
}

function saltGenerator () {
  $chars = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&+";
  $salt = "";
  for ($i = 0 ; $i < 15; $i++) {
    $rand_index = rand(0,68);
    $salt .= $chars[$rand_index];
  }
  return $salt;
}

function totalAccount () {
  include("connection.php");

  $results = $con->query("SELECT COUNT(account_id) FROM accounts");
  $account = $results->fetchColumn(0);

  return $account;
}

function createAccount ($account_id,$first_name,$last_name,$username,$email,$password,$salt) {
  include("connection.php");

  $results = $con->prepare("INSERT INTO accounts (account_id, first_name, last_name, username, email ,password, salt) VALUES (?,?,?,?,?,?,?)");
  $results->bindParam(1,$account_id,PDO::PARAM_STR);
  $results->bindParam(2,$first_name,PDO::PARAM_STR);
  $results->bindParam(3,$last_name,PDO::PARAM_STR);
  $results->bindParam(4,$username,PDO::PARAM_STR);
  $results->bindParam(5,$email,PDO::PARAM_STR);
  $results->bindParam(6,$password,PDO::PARAM_STR);
  $results->bindParam(7,$salt,PDO::PARAM_STR);
  $results->execute();
}

function accountInfo($email_username) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM accounts WHERE LOWER(username) = ? OR LOWER(email) = ?");
  $results->bindParam(1,strtolower($email_username),PDO::PARAM_STR);
  $results->bindParam(2,strtolower($email_username),PDO::PARAM_STR);
  $results->execute();
  $account = $results->fetch(PDO::FETCH_ASSOC);

  return $account;
}

function updateFavorites($saved,$account_id) {
  include("connection.php");

  $results = $con->prepare("UPDATE accounts SET saved_recipes = ? WHERE account_id = ?");
  $results->bindParam(1,$saved,PDO::PARAM_STR);
  $results->bindParam(2,$account_id,PDO::PARAM_STR);
  $results->execute();
}

function display_recipes ($recipe,$saved_ids = null) {
  if (!empty($saved_ids)) {
    foreach ($saved_ids as $id) {
      if ($id == $recipe["recipe_id"]) {
        $favorite = 1;
      }
    }
  };

  $output = "<li id='". $recipe["recipe_id"] . "' class='cookbook-recipe-container'>
    <a href='recipe.php?id=" . $recipe["recipe_id"] . "'>
      <img class='cookbook-recipe-img' src='" . $recipe["img_src"] . "' /><br />
      <div class='cookbook-text-container'>
      <p class='cookbook-recipe-text'>" . $recipe["title"] . "</p>
      <p class='cookbook-recipe-subtext'> Recipe By: " . $recipe["author"] . "</p>
      </div>
    </a>";
    if ($_SESSION["loggedIn"] == 1) {
      $output .= "<div class='favorite";
      if ($favorite == 1) {
        $output .= " saved";
      }
      $output .= "'><div class='favorite-star-container'><i class='";
      if ($favorite == 1) {
        $output .= "fa fa-star gold star";
      } else {
        $output .= "fa fa-star-o star";
      }
      $output .= "' aria-hidden='true'></i></div></div>";
    }
  $output .= "</li>";

  return $output;
}
