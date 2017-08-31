<?php

function search_catalog ($search,$limit = null,$offset = 0) {
  include("connection.php");
  $search = "%" . strtolower($search) . "%";

  $results = $con->prepare("SELECT * FROM items WHERE LOWER(h3) LIKE ? OR LOWER(category) LIKE ? LIMIT ? OFFSET ?");
  $results->bindParam(1,$search,PDO::PARAM_STR);
  $results->bindParam(2,$search,PDO::PARAM_STR);
  $results->bindParam(3,$limit,PDO::PARAM_STR);
  $results->bindParam(4,$offset,PDO::PARAM_STR);
  $results->execute();

  $itemArr = $results->fetchAll(PDO::FETCH_ASSOC);
  return $itemArr;
}

function total_item_count ($section = null) {
  include("connection.php");

  $section = "%" . strtolower($section) . "%";
  $sql = "SELECT COUNT(item_id) FROM items";
  if (!empty($section)) {
    $results = $con->prepare($sql . " WHERE LOWER(category) LIKE ? OR LOWER(h3) LIKE ?");
    $results->bindParam(1,$section,PDO::PARAM_STR);
    $results->bindParam(2,$section,PDO::PARAM_STR);
  } else {
    $results = $con->prepare($sql);
  }
  $results->execute();
  $count = $results->fetchColumn(0);

  return $count;
}

function full_catalog_array ($limit = null ,$offset = 0) {
  include("connection.php");

  $sql = "SELECT * FROM items";
  if (is_integer($limit)) {
    $results = $con->prepare($sql . " LIMIT ? OFFSET ?");
    $results->bindParam(1,$limit,PDO::PARAM_INT);
    $results->bindParam(2,$offset,PDO::PARAM_INT);
  } else {
    $results = $con->prepare($sql);
  }
  $results->execute();

  $itemArr = $results->fetchAll(PDO::FETCH_ASSOC);
  return $itemArr;
}

function category_catalog_array ($section, $limit = null, $offset = 0) {
  include("connection.php");
  $search = "%" . strtolower($section) . "%";

  $sql = "SELECT * FROM items WHERE LOWER(h3) LIKE ? OR LOWER(category) LIKE ?";
  if (is_integer($limit)) {
    $results = $con->prepare($sql . " LIMIT ? OFFSET ?");
    $results->bindParam(1,$search,PDO::PARAM_STR);
    $results->bindParam(2,$search,PDO::PARAM_STR);
    $results->bindParam(3,$limit,PDO::PARAM_INT);
    $results->bindParam(4,$offset,PDO::PARAM_INT);
  } else {
    $results = $con->prepare("$sql");
    $results->bindParam(1,$search,PDO::PARAM_STR);
    $results->bindParam(2,$search,PDO::PARAM_STR);
  }
  $results->execute();
  $itemArr = $results->fetchAll(PDO::FETCH_ASSOC);

  return $itemArr;
}

function random_catalog_array () {
  include("connection.php");

  $results = $con->query("SELECT * FROM items ORDER BY RAND() LIMIT 4");
  $itemArr = $results->fetchAll(PDO::FETCH_ASSOC);

  return $itemArr;
}

function single_item_array ($id) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM items WHERE LOWER(items.item_id) = ?");
  $results->bindParam(1,$id,PDO::PARAM_INT);
  $results->execute();
  $item = $results->fetch(PDO::FETCH_ASSOC);

  return $item;
}

function accounts_array () {
  include("connection.php");

  $results = $con->query("SELECT user_id FROM users");
  $accounts = $results->fetchAll();

  return $accounts;
}

function existing_username_array ($username) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM users WHERE users.username = ?");
  $results->bindParam(1,strtolower($username),PDO::PARAM_STR);
  $results->execute();
  $existingUser = $results->fetch(PDO::FETCH_ASSOC);

  return $existingUser;
}

function existing_email_array ($email) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM users WHERE users.email = ?");
  $results->bindParam(1,strtolower($email),PDO::PARAM_STR);
  $results->execute();
  $existingUser = $results->fetch(PDO::FETCH_ASSOC);

  return $existingUser;
}

function random_salt () {
  $chars = "abcdefghijklmnopqrstuvwxyz!?$@&%_-|ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $length = strlen($chars) - 1;
  $salt = "";
  for ($i = 0; $i <=20; $i++) {
    $randChar = $chars[mt_rand(0,$length)];
    $salt .= $randChar;
  }
  return $salt;
}

function create_new_account ($user_id,$firstName,$lastName,$username,$email,$finalPassword,$salt) {
  include("connection.php");

  try {
    $results = $con->prepare("INSERT INTO users (user_id,first_name,last_name,username,email,password,salt)
                                    VALUES (?,?,?,?,?,?,?)");
    $results->bindParam(1,$user_id,PDO::PARAM_STR);
    $results->bindParam(2,$firstName,PDO::PARAM_STR);
    $results->bindParam(3,$lastName,PDO::PARAM_STR);
    $results->bindParam(4,$username,PDO::PARAM_STR);
    $results->bindParam(5,$email,PDO::PARAM_STR);
    $results->bindParam(6,$finalPassword,PDO::PARAM_STR);
    $results->bindParam(7,$salt,PDO::PARAM_STR);
    $results->execute();
  } catch (Exception $e) {
    echo "Unable to add user";
    exit;
  }
}

function delete_account ($user_id) {
  include("connection.php");

  $results = $con->prepare("DELETE FROM users WHERE user_id = ?");
  $results->bindParam(1,$user_id,PDO::PARAM_STR);
  $results->execute();
}

function assign_order_keys ($order) {
  $final_order = [];
  foreach ($order as $item) {
    array_push($final_order, [
      "item-detail" => $item[0],
      "price" => $item[1],
      "quantity" => $item[2],
      "total" => $item[3]
    ]);
  }
  return $final_order;
}

function total_existing_order () {
  include("connection.php");

  $results = $con->query("SELECT order_id FROM orders");
  $accounts = $results->fetchAll(PDO::PARAM_STR);

  return $accounts;
}

function add_order ($order_id,$user_id,$order_details,$order_total,$date) {
  include("connection.php");

  $results = $con->prepare("INSERT INTO orders(order_id,user_id,order_details,order_total,date) VALUES (?,?,?,?,?)");
  $results->bindParam(1,$order_id,PDO::PARAM_STR);
  $results->bindParam(2,$user_id,PDO::PARAM_STR);
  $results->bindParam(3,$order_details,PDO::PARAM_STR);
  $results->bindParam(4,$order_total,PDO::PARAM_STR);
  $results->bindParam(5,$date,PDO::PARAM_STR);
  $results->execute();

}

function order_history_array ($user_id) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM orders WHERE user_id = ?");
  $results->bindParam(1,$user_id,PDO::PARAM_STR);
  $results->execute();
  $order_history = $results->fetchAll(PDO::FETCH_ASSOC);

  return $order_history;
}

function get_order_details ($order_id) {
  include("connection.php");

  $results = $con->prepare("SELECT user_id,order_details FROM orders WHERE order_id = ?");
  $results->bindParam(1,$order_id,PDO::PARAM_STR);
  $results->execute();
  $order_details = $results->fetch(PDO::FETCH_ASSOC);
  
  return $order_details;

}

function displayItemList ($item) {
  $output = "<div id='". $item["lastSize"] . "' class='main-body-section'><img src='" . $item['imgSrc'] . "' alt='" . $item['alt'] . "' / >
                <div class='main-body-section-overlay hidden'>
                  <div class='initial-overlay'>
                    <h3>" . $item['h3'] . "</h3>
                    <div class='price'>$". $item['price'] ."</div>
                    <div class='overlay-option-container'>
                      <a href='" . "item.php?id=". $item["item_id"] . "'>READ MORE</a>
                      <p class='hover-buy'>BUY</p>
                    </div>
                  </div>

                  <div class='item-buy-overlay'>
                    <p class='item-buy-label'>" . $item['h3'] . "</p>
                    <p class='item-buy-price'>$<span class='price-number'>". $item['price'] ."</span></p>
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
                      <a href='#' class='cancel-buy'>Cancel</a>
                      <a href='#' class='add-cart'>Add To Cart</a>
                    </div>
                  </div>

                  <div class='success-overlay'>
                    <p>ADDED TO CART!</p>
                  </div>

                </div>
            </div>";
    return $output;
}

function array_category($itemArr, $section) {
  if($section == null) {
    return array_keys($itemArr);
  }
  $output = [];
  foreach ($itemArr as $id => $item) {
      $output[] = $id;
  }
  return $output;
}

function find_totals ($cart){
    $totalArr = [];
    foreach ($cart as $item) {
      array_push($totalArr,$item[3]);
    };
    function add ($a,$b) {
      return $a+$b;
    }
    $subtotal = array_reduce($totalArr,"add");
    $final_total = ($subtotal +($subtotal * .1));
    $final_total = number_format($final_total,2,'.','');
    $totals = [
      subtotal => $subtotal,
      final_total => $final_total,
    ];
    return $totals;
}
