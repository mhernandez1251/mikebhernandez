<?php
include("../inc/functions.php");
$page = "Pantree";
$project = portfolio_basic_info($page)[0];
$breakdown = breakdown_info("pantree_breakdown");
$page_title = "Portfolio | " . $page;
include("../../inc/header.php");
?>

<div id="project-page">
  <h1 id="project-title"><?php echo $project["project_name"]; ?></h1>
  <img id="project-img" src="../..<?php echo $project["project_img"];?>" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link link-1" href="../<?php echo $project["project_active_link"]?>" target="_blank">Live Project</a>
      <a class="full-project-link link-2" href="https://github.com/mhernandez1251/mikebhernandez/tree/master/projects/pantree">Full Github Repository</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <p id="objective-text-v1" class="version-1-content">

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
      Much like cooking, web development provides the perfect balance of logic and creativity. This site needed to maintain design through all catalog and recipe pages. To code all of that one page at time would have taken weeks and would have been tedious. PHP and SQL allows for more complex websites to be created efficently and with a eye on cross site consistancy. This was the perfect example of the benefits of learning with real world projects. Uploading an image to a directory sound simple, but it was something I had never coded before this. I was forced to find the solution to this problem on my own and am better for it. The excitement of seeing an uploaded image be created where it was supposed to may sound strange, but it's moments like these that motivate me to seek out new skills and continue my journey with coding.
    </p>
  </div>
</div>

<?php
include("../../inc/footer.php");
?>
