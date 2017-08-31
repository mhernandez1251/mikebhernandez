function menuTransform (homeFont,contentName,degreeRotate,transformAxis,alignItem,leftPosition,rightPostition,bcLeft,bcRight,buttonContainer,buttonSpanMargin) {
  $("#return-home").css("font-family",homeFont);
  $(".homepage-button").css("margin","0");
  $(contentName).fadeIn("slow");
  $("#button-container").css({
    width: "100vh",
    flexDirection: "row",
    justifyContent: "center",
    margin: 0,
    position: "fixed",
    transform: degreeRotate,
    transformOrigin: transformAxis,
    alignSelf: alignItem,
    left: leftPosition,
    right: rightPostition,
    backgroundColor: "rgba(0,0,0,0)"
  });
  $(".button-span").css({
    width: "initial",
    margin: "0",
    marginRight: "15px",
    marginTop: buttonSpanMargin,
    marginBottom: buttonSpanMargin
  });
  $(buttonContainer).css("width","100%");
}

function expandClick (buttonName,aboutWidth,time,expandedSection,imageFadeIn) {
  $(buttonName).on("click",function(){
    if (buttonName == "#return-home" && $("#about-background-container").width() == (screen.width/2)) {
      return;
    } else if (buttonName == "#expand-about" && $("#about-background-container").hasClass("expanded")) {
      return;
    } else if (buttonName == "#expand-portfolio" && $("#portfolio-background-container").hasClass("expanded")) {
      return;
    } else {
      $("#button-container,#title-container,.content-section").fadeOut("slow");
      $("#about-background-container").animate({
        width: aboutWidth
      },time);
      $(".background").removeClass("expanded");
      if (aboutWidth != "50%") {
        $(expandedSection).addClass("expanded");
      }
      setTimeout(function(){
        if (screen.width >= 768) {
          var menuSidePosition = "15px";
          var buttonSpanMargin = "40px";
          var buttonContainerWidth = "45px"
        } else  {
          var menuSidePosition = "5px";
          var buttonSpanMargin = "25px";
          var buttonContainerWidth = "29px"
        }
        $(".button-span").removeClass("hidden");
        $(buttonName).addClass("hidden");
        $("#button-container").fadeIn("slow");
        if (buttonName == "#home-button-container") {
          $("#title-container").fadeIn("slow");
          $(".button-span, #button-container, #portfolio-button-container, #about-button-container, .homepage-button").removeAttr("style");
          $(".homepage-button").removeClass("about-button-color portfolio-button-color");
          $("#expand-about").addClass("about-button-color");
          $("#expand-portfoli").addClass("portfolio-button-color");
        }
        if (buttonName == "#about-button-container") {
          menuTransform("Work Font","#about-content","rotate(90deg)","0 0","flex-end","inherit","-100vh","#portfolio-button-container",buttonSpanMargin);
          $(".homepage-button").addClass("about-button-color");
          $(".homepage-button").removeClass("portfolio-button-color");
        } else if (buttonName == "#portfolio-button-container") {
          menuTransform("About Font, cursive","#portfolio-content","rotate(-90deg)","100% 0","flex-start","-99vh","inherit","#about-button-container",buttonSpanMargin);
          $("#about-button-container").css("order","1");
          $(".homepage-button").removeClass("about-button-color");
          $(".homepage-button").addClass("portfolio-button-color");
        }
      },time);
    }
  });
}

expandClick("#about-button-container","100%",3000,"#about-background-container","#about-background");
expandClick("#portfolio-button-container","0",3000,"#portfolio-background-container","#portfolio-background");
expandClick("#home-button-container","50%",2500,"none",".background-img");

function setAboutWidth (aboutWidth) {
  $("#about-background-container").css("width",aboutWidth);
}

$(window).on("orientationchange",function(){
  var orientation = screen.orientation.type;
  var screenWidth = screen.width;
  var screenHeight = screen.height;
  var abc = $("#about-background-container");
  var pbc = $("#portfolio-background-container");
  if (abc.hasClass("expanded")) {
    setAboutWidth("100%");
  } else if (pbc.hasClass("expanded")) {
    setAboutWidth("0");
  } else {
    setAboutWidth("50%");
  }
})

$(".project").hover(function(){
  $(this).children(".project-overlay").toggleClass("hidden");
})

$(".version-selection").on("click",function(){
  $(".version-1-content, .version-2-content").toggleClass("hidden");
  $("#version-1, #version-2").toggleClass("version-selected");
})

$(".header-menu-button").on("click",function(){
  if ($(this).is("#header-menu-open")) {
    $(this).toggleClass("hidden");
    $("#header-nav-links-container").toggleClass("hidden");
  } else {
    $("#header-nav-links-container, #header-menu-open").toggleClass("hidden");
  }
})
