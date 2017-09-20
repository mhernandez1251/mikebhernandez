<!DOCTYPE html>
<?php
	if ($page == "homepage") {
		$main_stylesheet = "css/main.css";
		$responsive_stylesheet = "css/responsive.css";
		$javascript_file = "src/main.min.js";
	} else if ($page == "Portfolio") {
		$main_stylesheet = "../css/main.css";
		$secondary_stylesheet = "portfolio.css";
		$responsive_stylesheet = "../css/responsive.css";
		$javascript_file = "../src/main.min.js";
	} else if ($page == "About") {
		$main_stylesheet = "../css/main.css";
		$secondary_stylesheet = "about.css";
		$responsive_stylesheet = "../../css/responsive.css";
		$javascript_file = "../../src/main.min.js";
	} else {
		$main_stylesheet = "../../css/main.css";
		$secondary_stylesheet = "../portfolio.css";
		$responsive_stylesheet = "../../css/responsive.css";
		$javascript_file = "../../src/main.min.js";
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="Michael, Hernandez, Michael Hernandez, web developer, web design, portfolio">
		<title><?php echo $page_title; ?></title>
		<script src="https://use.fontawesome.com/fe86034e68.js"></script>
		<link rel="stylesheet" href=<?php echo $main_stylesheet; ?>>
		<?php if ($page !== "homepage") { ?>
		<link rel="stylesheet" href=<?php echo $secondary_stylesheet; ?>>
		<?php } ?>
		<link rel="stylesheet" href=<?php echo $responsive_stylesheet; ?>>
	</head>

	<body>
		<?php
		if ($page != "homepage") { ?>
			<header>
				<div id="header-nav-links-container" class="hidden">
				<a id="header-home" class="header-nav-link" href="../../">Home</a>
				<i id="header-menu-close" class="fa fa-bars header-menu-button" aria-hidden="true"></i>
				<a id="header-portfolio" class="header-nav-link <?php if ($page == "Portfolio") { echo "hidden"; } ?>" href="../../portfolio">Portfolio</a>
				<a id="header-about" class="header-nav-link <?php if ($page !== "Portfolio") { echo "hidden"; } ?>" href="../../about">About</a>
				</div>
				<i id="header-menu-open" class="fa fa-bars header-menu-button" aria-hidden="true"></i>
			</header>
		<?php } ?>
