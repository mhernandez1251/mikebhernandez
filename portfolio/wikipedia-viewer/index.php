<?php

include("../inc/functions.php");
$page = "Wikipedia Viewer";
$project = portfolio_basic_info($page)[0];
$breakdown = breakdown_info("wiki_breakdown");
$page_title = "Portfolio | " . $page;
include("../../inc/header.php");
?>
<div id="project-page">
  <h1 id="project-title"><?php echo $project["project_name"]; ?></h1>
  <img id="project-img" src="../..<?php echo $project["project_img"];?>" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link" href="<?php echo $project["project_active_link"]?>" target="_blank">Full Project Link</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <p id="objective-text">
      Build a CodePen.io app that utilizes the Wikipedia API to allow users to search Wikipedia entries in a search box and see the resulting Wikipedia entries. Also include a button that, when clicked, will send the user to a random Wikipedia article.
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
    <div class="breakdown-text">
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
      With that, this Wikipedia Viewer is up and running. On its face, this is a simple site that uses Wikipedia's API to allow the user to search for specific or random articles. But when you look a little deeper, it is clear this was more than that. This project demonstrates the power a few lines of code can have. There are a thousands of APIs that provide a vast array of information. From weather forecasts to translating foreign languages, the real world applicability of APIs are enormous and I am excited to use the skills I have gained from this project to test those limits.
    </p>
  </div>
</div>
<?php
include("../../inc/footer.php");
?>
