<?php
include("../inc/functions.php");
$page = "Tic Tac Toe";
$breakdown_v1 = breakdown_info("ttt_v1_breakdown");
$breakdown_v2 = breakdown_info("ttt_v2_breakdown");
$page_title = "Portfolio | " . $page;
include("../../inc/header.php");
?>
<div id="project-page">
  <h1 id="project-title">Tic Tac Toe</h1>
  <img id="project-img" src="../../img/homepage/tic-tac-toe.jpg" />
  <div id="objective-container" class="project-container">
    <div id="links-container">
      <a class="full-project-link link-1" href="https://codepen.io/mhernandez1251/pen/XROOGo" target="_blank">Full Project (v1)</a>
      <a class="full-project-link link-2" href="https://codepen.io/mhernandez1251/pen/GNWvPx" target="_blank">Full Project (v2)</a>
    </div>
    <h2 id="objective-title">Objective</h2>
    <div id="version-selection-container">
      <span id="version-1" class="version-selection">Version 1</span>
      <span id="version-2" class="version-selection version-selected">Version 2</span>
    </div>
    <p id="objective-text-v1" class="version-1-content hidden">
      Build a CodePen.io Tic-Tac-Toe app where the user plays against the computer. Allow the user to play as X or O and reset when game is over to allow the user to play again.
    </p>
    <p id="objective-text-v2" class="version-2-content">
      After completing version 1 of this Tic-Tac-Toe game, I saw a number of ways to simplify and improve my code. With more experience and knowledge under my belt, this should be a much more refined version of the same classic game.
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
    <div id="breakdown-text-v1" class="version-1-content hidden">
      <ul class="breakdown-list">
        <?php
        foreach($breakdown_v1 as $breakdown) {
          echo display_breakdown($breakdown);
        }
        ?>
      </ul>
    </div>
    <div id="breakdown-text-v2" class="version-2-content">
      <ul class="breakdown-list">
        <?php
        foreach($breakdown_v2 as $breakdown) {
          echo display_breakdown($breakdown);
        }
        ?>
      </ul>
    </div>
  </div>
  <div id="conclusion-container" class="project-section">
    <h2 id="conclusion-title">Conclusion:</h2>
    <div id="conclusion-v1" class="version-1-content hidden">
      This simple game was more complex than it seems. It was a great JavaScript exercise requiring multiple variables and functions working alongside one another. This creates room for several possible errors for occurring and requires simple, understandable code. I know that my first go, though successful, is not the most refined. I can see multiple places where my code can be simplified and intend on addressing this with next attempt. I believe that is a great sign. Normally I would accept my first attempt as a win and move on, but my growing passion for web development and design only pushes me to improve. As someone who is just getting started on my coding journey, this project was a great way to solidify the fundamentals in a fun yet challenging way.
    </div>
    <div id ="conclusion-v2" class="version-2-content">
      By using arrays and the <code class="code-text">forEach</code> method, I was able to cut the amount of code I wrote for my first version in half. I used new CSS properties to simplify my design. This version is much more logical and easier for others to follow. I was able to achieve all this while at the same time maintaining stability. This was a great way to judge how much progress I have made since first starting to code. It is great to be able to apply the information I have gained and produce better, more efficient code. I look forward to seeing how much better I will become with more experience and a greater handle on the fundamentals.
    </div>
  </div>
</div>
<?php
include("../../inc/footer.php");
?>
