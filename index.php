<?php
include("inc/functions.php");
$page = "homepage";
$learning_projects = portfolio_basic_info("learning",$page);
$personal_projects = portfolio_basic_info("personal",$page);
$page_title = "Michael Hernandez | Web Developer";

include("inc/header.php");
?>
		<div id="homepage-container">

      <div id="background-container">
        <div id="about-background-container" class="background">
  				<div id="about-background" class="background-img"></div>
  			</div>
  			<div id="portfolio-background-container" class="background">
  				<div id="portfolio-background" class="background-img"></div>
  			</div>
      </div>

			<div id="title-container">
				<h1 id="homepage-title" class="title">Michael <br /> Hernandez</h1>
				<h2 id="homepage-subtitle" class="title">Web<span class="portrait-hidden"><br /></span> Developer</h2>
			</div>

			<div id="button-container">
				<span id="about-button-container" class="button-span"><button id="expand-about" class="homepage-button about-button-color">About</button></span>
				<span id="portfolio-button-container" class="button-span"><button id="expand-portfolio" class="homepage-button">Portfolio</button></span>
				<span id="home-button-container" class="button-span hidden"><button id="return-home" class="homepage-button">Home</button></span>
			</div>

			<section id="about-content" class="content-section">
				<div class="content-section-container">
				  <h1 id="about-title" class="content-title title">About</h1>
				  <div id="about-text">My name is Michael Hernandez and I'm a web developer from the Chicagoland area. It took me awhile to feel confident in saying that, but I AM a web developer.
				  My hesitation in owning that title comes from the fact that I am self taught. Now I understand that this may scare you. It may send you running. It may cause you to disregard anything I have to say
				  or show you. DO. NOT. MAKE. THAT. MISTAKE. Though unconventional, learning on my own has provided me with tools beyond coding and the ability to build websites (though I do have those tools too).
				  Independant learning requires a true passion for the material. The added challenges of this lonely journey are too great for simply a passing interest. I am driven by an insatiable hunger and curiousity for all things coding and web development. I do not view problems as pitfalls to waste away in. I am not deterred by what I don't know. Being wrong
				  does not frustrate me. It excites me. Problems are inevidable, but I have the skillset to find a solution. I may not have a piece of paper stating that I am ready, but I do have projects that
				  demonstrate my understanding. The world of programming and web development is constantly changing and evolving, and I have to tools to adapt along side it.  <br />Self Taught, Self Motivated, Self Made</div>
				  <div id="skillset-container">
				    <h2 id="skillset-title" class="about-list-title">Skillset</h2>
				    <ul id="skillset-list" class="about-list">
				      <li class="about-list-item">HTML</li>
				      <li class="about-list-item">CSS</li>
				      <li class="about-list-item">JAVASCRIPT</li>
				      <li class="about-list-item">JQUERY</li>
				      <li class="about-list-item">PHP</li>
							<li class="about-list-item">SQL</li>
				    </ul>
				  </div>
				  <div id="contact-container">
				    <h2 id="contact-title" class="about-list-title">Contacts/Links</h2>
				    <ul id="skillset-list" class="about-list">
				      <li class="contact about-list-item"><a href="tel:1-630-383-9030"><i class="fa fa-phone-square" aria-hidden="true"></i>(630)383-9030</a></li>
				      <li class="contact about-list-item"><a href="mailto:michernandez.1191@gmail.com" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i>michernandez.1191@gmail.com</a></li>
				      <li class="contact about-list-item"><a href="https://twitter.com/messages/compose?recipient_id=mikebhernandez" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
							<li class="contact about-list-item"><a href="https://www.linkedin.com/in/michael-hernandez-52783b121/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i>LinkedIn</a></li>
				      <li class="contact about-list-item"><a href="http://www.codepen.io/mhernandez1251" target="_blank"><i class="fa fa-codepen" aria-hidden="true"></i>Codepen</a></li>
				      <li class="contact about-list-item"><a href="https://teamtreehouse.com/michaelhernandez8" target="_blank">Treehouse Learning</a></li>
							<li class="contact about-list-item"><a href="https://www.freecodecamp.com/mhernandez1251" target = "_blank">Freecodecamp</a></li>
				    </ul>
				  </div>
				</div>
			</section>

			<section id="portfolio-content" class="content-section">
				<div class="content-section-container">
				  <h1 id="portfolio-title" class="content-title title">Portfolio</h1>
				  <div id="learning-projects-container" class="project-container">
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

				  <div id="personal-projects-container" class="project-container">
				    <h2 id="personal-title" class="portfolio-section-title">Personal</h2>
				    <p id="personal-description" class="portfolio-section-description">
				      These projects exemplify my abilty to take the skills that I have learned and use them in real world applications.
				    </p>
						<?php
						foreach($personal_projects as $project) {
							echo display_projects($project);
						}
						?>
				  </div>
				</div>
			</section>


		</div>
<?php include("inc/footer.php"); ?>
