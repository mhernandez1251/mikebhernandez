<?php
include("../inc/functions.php");
$page = "Simon Game";
$project = portfolio_basic_info($page)[0];
$breakdown = breakdown_info("simon_breakdown");
$page_title = "Portfolio | " . $page;

include("../../inc/header.php");
?>

<div id="project-page">
  <h1 id="project-title"><?php echo $project["project_name"]; ?></h1>
  <img id="project-img" src="../..<?php echo $project["project_img"];?>" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link" href="<?php echo $project["project_active_link"] ?>" target="_blank">Full Project</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <p id="objective-text-v1" class="version-1-content">
      Build a CodePen.io Simon game app. The user will be presented with a random series of button presses. After each successful repatiion, the series repeats with a new step. A sound will play for each button press and if the user presses a wrong button, the game will end and they will be informed.
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
      The biggest challenge in this project was maintaining the same sequence of button presses through out the game. This demonstrated the importance of global variables. This project was also a great example of the importance and power of functions. I was able to limit the amount of repetition by creating variables with changing parameters. This allowed the project to be easy to follow and work just as well. This is a lesson that will carry over throughout my career in coding.
    </p>
  </div>
</div>

<?php
include("../../inc/footer.php");
?>
