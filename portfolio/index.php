<?php
$page = "Portfolio";
include("../inc/functions.php");
$learning_projects = portfolio_basic_info("learning",$page);
$personal_projects = portfolio_basic_info("personal",$page);
include("../inc/header.php");
?>
<div id="portfolio-page-container">
  <h1 id="portfolio-title" class="content-title title">Portfolio</h1>
  <div id="learning-projects-container" class="portfolio-project-section project-container">
    <h2 id="learning-title" class="portfolio-section-title">Learning</h2>
    <p id="learning-description" class="portfolio-section-description">
      These are projects I completed while learning to code. From HTML to CSS to JAVASCRIPT, these projects demonstrate growth along my journey.
    </p>
    <?php
    foreach($learning_projects as $project) {
      echo display_projects($project);
    }
    ?>
  </div>

  <div id="personal-projects-container" class="portfolio-project-section project-container">
    <h2 id="personal-title" class="portfolio-section-title">Personal</h2>
    <p id="personal-description" class="portfolio-section-description">
      These projects exemplify my abilty to take the skills that I have learned and apply them to real world examples.
    </p>
    <?php
    foreach($personal_projects as $project) {
      echo display_projects($project);
    }
    ?>
  </div>
</div>
<?php include("../inc/footer.php") ?>
