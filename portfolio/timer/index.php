<?php
include("../inc/functions.php");
$page = "Timer";
$project = portfolio_basic_info($page)[0];
$breakdown = breakdown_info("timer_breakdown");
$page_title = "Portfolio | " . $page;
include("../../inc/header.php");
?>

<div id="project-page">
  <h1 id="project-title"><?php echo $project["project_name"]; ?></h1>
  <img id="project-img" src="../..<?php echo $project["project_img"];?>" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link link-1" href="https://codepen.io/mhernandez1251/pen/Pzyxbv" target="_blank">Full Project (v1)</a>
      <a class="full-project-link link-2" href="https://codepen.io/mhernandez1251/pen/MmOWGy" target="_blank">Full Project (v2)</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <p id="objective-text-v1" class="version-1-content">
      Build a CodePen.io pomodoro timer that starts by default at 25 minutes and goes off when that time has ellapsed. Allow the user to reset the clock and adjust the duration of the work and break time intervals.
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
      The breakdown above is my second attempt at this project. Though functional, the code for my first attempt was repetative and difficult to follow. Even I have a hard time examining it and figuring out which functions work with which. I completed that initial version with only a couple of months of coding experience and have since built a stronger grasp on the fundamentals of JavaScript. I have included a link to that first project, and I believe you will see how much progress I have made by comparing the two. Version 2 is a third of the code but just as effective. It is streamlined and efficient, and a sign of how far I have come I my journey through coding.
    </p>
  </div>
</div>

<?php
include("../../inc/footer.php");
?>
