<?php
function portfolio_basic_info ($project_type,$page) {
  include("connection.php");

  $results = $con->prepare("SELECT * FROM portfolio_display WHERE project_type = ? OR project_name = ?");
  $results->bindParam(1,$project_type,PDO::PARAM_STR);
  $results->bindParam(2,$project_type,PDO::PARAM_STR);
  $results->execute();
  $projects = $results->FetchAll(PDO::FETCH_ASSOC);
  return $projects;
}

function display_projects ($project) {
  $display = "<div class='project'>
    <img class='project-img' src='". $project["project_img"] . "' />
    <div class='project-overlay hidden'>
      <h4 class='project-title'>". $project["project_name"] . "</h4>
      <div class='project-button-container'>
        <a class='project-button project-details' href='". $project["project_details_link"] . "' target='_blank'>View Details</a>
        <a class='project-button project-link' href='". $project["project_active_link"] . "' target='_blank'>View Project</a>
      </div>
    </div>
  </div>";

  return $display;
}

function breakdown_info ($database_name) {
  include("connection.php");

  try {
    $results = $con->prepare("SELECT * FROM " . $database_name);
    $results->execute();
  } catch (Exception $e) {
    echo "could not retrieve breakdown";
  }

  $breakdown = $results->FetchAll(PDO::FETCH_ASSOC);
  return $breakdown;
}
