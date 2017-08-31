<?php
include("../inc/functions.php");
$page = "Basic Calculator";
$project = portfolio_basic_info($page)[0];
$breakdown = breakdown_info("calculator_breakdown");
$page_title = "Portfolio | " . $page;
include("../../inc/header.php");
?>
<div id="project-page">
  <h1 id="project-title"><?php echo $project["project_name"]; ?></h1>
  <img id="project-img" src="../..<?php echo $project["project_img"];?>" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link" href="<?php echo $project["project_active_link"]?>" target="_blank">Full Project</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <p id="objective-text-v1" class="version-1-content">
      Build a CodePen.io JavaScript calulator app. Allow the user to add, subtract, multiply and divide numbers. Allow the user to chain together multiple mathematical operations until she/he presses the equals button. When the equals button is pressed, display the final solution to the equation.
    </p>
  </div>
  <div id="languages-container" class="project-section">
    <h2 id="languages-title">Languages Used</h2>
    <ul id="languages-list">
      <li class="language">HTML</li>
      <li class="language">CSS</li>
      <li class="language">JQUERY</li>
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
      This project was a great exploration into the power of JavaScript. It required multiple different button functionality and variables that worked together to produce a simple calculator. The more complex these projects get, the more important it is to have clear, efficient code.
    </p>
  </div>
</div>

<?php
include("../../inc/footer.php");
?>
