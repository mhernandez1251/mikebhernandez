<?php
include("../inc/functions.php");
$page = "Camera Shop";
$project = portfolio_basic_info($page)[0];
$breakdown = breakdown_info("camera_shop_breakdown");
$page_title = "Portfolio | " . $page;
include("../../inc/header.php");
?>

<div id="project-page">
  <h1 id="project-title"><?php echo $project["project_name"]; ?></h1>
  <img id="project-img" src="../..<?php echo $project["project_img"];?>" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link link-1" href="../<?php echo $project["project_active_link"]?>" target="_blank">Live Project</a>
      <a class="full-project-link link-2" href="https://github.com/mhernandez1251/mikebhernandez/tree/master/projects/camera-shop">Full Github Repository</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <p id="objective-text-v1" class="version-1-content">
      With a firm grasp of the fundamentals, it is time to begin applying what I have learn to real world projects. This Camera Shop is one of my first attempts at creating a fully functional website. This e-commerce site should allow the user to browse through a catalog of cameras and related equipment. The user should be to hover over the image of the item and be given two options. One will take the user to the full item page with additional details, or they simply add the item to the cart. In the cart, the user will be able to adjust the quantity of the item being purchased, or remove the item from the cart all together. A sign up/login section will allow the user to create or enter their account and see previous purchases. During the checkout stage, the user will be required to be signed in to an account. If the payment information is provided, the purchase will be made.
    </p>
  </div>
  <div id="languages-container" class="project-section">
    <h2 id="languages-title">Languages Used</h2>
    <ul id="languages-list">
      <li class="language">HTML</li>
      <li class="language">CSS</li>
      <li class="language">JavaScript</li>
      <li class="language">JQUERY</li>
      <li class="language">PHP</li>
      <li class="language">SQL</li>
    </ul>
  </div>
  <div id="breakdown-container" class="project-section">
    <h2 id="breakdown-title">Breakdown</h2>
    <div id="breakdown-text-v1" class="version-1-content">
      <ul class="breakdown-list">
        <?php
        foreach ($breakdown as $section) {
          echo display_breakdown($section);
        }
        ?>
      </ul>
    </div>
  </div>
  <div id="conclusion-container" class="project-section">
    <h2 id="conclusion-title">Conclusion:</h2>
    <p>
      This project was a step up from the type of projects that I did while learning to code. A multi-paged website like this would have been daunting to build if I had coded every page from scratch. PHP oftered the perfect mix of performance and simplicity to turn this into an efficient and relatively quick exercise. By finding areas where code is repeated and instead using functions or the include() method, I was able to maintain a clean structured website consistantly throughout every page. Storing information in a database also helped in limitting the actual hard code that I had to write. HTML, CSS, and JavaScript are powerful tools for creating simple web apps, but introducing PHP and SQL into by arsenal elevates my potential to a whole new level.
    </p>
  </div>
</div>

<?php
include("../../inc/footer.php");
?>
