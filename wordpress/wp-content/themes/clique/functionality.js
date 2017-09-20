// FUNCTIONS

// scrollspy offsetIndex
$(document).ready(function(){
    $('body').scrollspy({target: "#post-nav", offset: 200});
    hover_effect();
});

// fix post-container-nav when scrolling
function hide_on_top_bottom(scrollPosition, screenHeight){
  if (scrollPosition >= screenHeight && scrollPosition < ($("#top-section").height() + $(".posts-container").height())) {
    $("#post-nav").css({
      position: 'fixed',
      top: "7px"
    })
  } else {
    $("#post-nav").removeAttr("style");
  }
}
// position post-nav-line
function position_nav_line(){
  if($(".post-nav-item").children(".nav-link").hasClass("active")){
    var navTop = $(".active").parent().position().top;
    $(".post-nav-line").css("top",navTop);
  }
}

// hide fixed content on top and footer sections
function hide_last_fixed(scrollPosition) {
  if (scrollPosition > ($("#top-section").height() + $(".posts-container").height()) || scrollPosition < $("#top-section").height()) {
    $(".post-fixed").css("display","none");
  } else {
    $(".post-fixed").css("display","block");
  }
}

// animate post images
function post_img_transition() {
  var notActiveSections =$(".post-section").not(".active-section").children(".post-image-section").children(".post-image-container");
  var notActiveImg = notActiveSections.children(".post-img");
  notActiveSections.removeAttr("style");
  notActiveImg.removeAttr("style");
  if ($(".post-section").hasClass("active-section")){
    var imageContainer = $(".active-section").children(".post-image-section").children(".post-image-container");
    imageContainer.css({
      opacity: "1",
      msTransform: "translate(0)",
      webkitransform: "translate(0)",
      transform: "translate(0)",
      transition: "all 1s ease-in-out"
    });
    imageContainer.children(".post-img").css({
      msTransform: "translate(0)",
      webkitransform: "translate(0)",
      transform: "translate(0)",
      transition: "all .75s ease-in-out .75s"
    })
    if (imageContainer.children(".post-img").hasClass("mp-img")) {
      imageContainer.children(".mp-img").css("transition-delay", ".25s");
    }
    if (imageContainer.children(".post-img").hasClass("kc-img")) {
      imageContainer.children(".kc-img-1").css({
        msTransform: "translate(0) rotate(15deg)",
        webkitransform: "translate(0) rotate(15deg)",
        transform: "translate(0) rotate(15deg)"
      });
      $(".kc-img-2").css({
        msTransform: "translate(0) rotate(-15deg)",
        webkitransform: "translate(0) rotate(-15deg)",
        transform: "translate(0) rotate(-15deg)"
      })
    }
    if (imageContainer.children(".post-img").hasClass("afy-img") || imageContainer.children(".post-img").hasClass("ln-img")) {
      imageContainer.children(".lap-top-screen").css({
        msTransform: "rotateX(0deg)",
        webkitTransform: "rotateX(0deg)",
        transform: "rotateX(0deg)",
        transition: "transform .5s ease-in-out 1s"
      });
    }
  }
}


// SCROLLING EFFECTS


// slide header nav menu off/on screen
var currentScroll = 0;
$(document).on("scroll",function(){
  var scrollPosition = $(window).scrollTop();
  var screenHeight = $(window).height();
  if (scrollPosition > 10) {
    $(".header-nav").css("margin-left", "-100%");
  } else {
    $(".header-nav").css("margin-left", "45px");
  }

  // hide post-fixed content on top page
  if (scrollPosition < screenHeight) {
    $(".post-fixed").css("display","none");
  }

  // post scrollspy hide fixed
  if (scrollPosition >= screenHeight) {
    if($(".nav-link").hasClass("active")) {
      var currentId = $(".active").attr("href");
      $(".post-section").removeClass("active-section");
      $(currentId).addClass("active-section");
      var next = $(currentId).next();
      var offsetIndex = $(currentId).attr("class");
      var re = /\D+/;
      offsetIndex = offsetIndex.replace(re,"");
      offsetIndex = parseInt(offsetIndex);
      var sectionHeight = $(".post-section").height();
      var currentFixed = $(currentId).children(".post-fixed");
      var totalOffset = Math.floor(sectionHeight * offsetIndex);
      var heightDiff = (scrollPosition + (screenHeight * .2)) - sectionHeight;
      var newHeight = sectionHeight - heightDiff + totalOffset + "px";
      currentFixed.height(newHeight);
      if (currentScroll < scrollPosition) {
        var prevLeftover = $(".active-section").prev().children(".post-fixed").height();
        var prevFinishHeight = prevLeftover - 20;
        prevFinishHeight += "px";
        $(".active-section").prev().children(".post-fixed").css("height",prevFinishHeight);
      }
    }
    currentScroll = scrollPosition;
  }

  // see function at top of file
  hide_last_fixed(scrollPosition);
  post_img_transition();
  position_nav_line();
  hide_on_top_bottom(scrollPosition, screenHeight);
});

// HOVER EFFECTS
function hover_effect(){
  $(".post-nav-item").hover(function(){
    var navPosition = $(this).position().top;
    $(".post-nav-line").css("top",navPosition);
  });
  // slide down footer talk-to button
  $(".talk-to").hover(function(){
    $(this).children(".talk-to-down").css("top","0");
  }, function(){
    $(this).children(".talk-to-down").css("top","-100%")
  });

  // all user to view header nav when not on top page
  // prevent header nav from hiding when on top page
  $(".site-header-container").hover(function(){
    $(".header-nav").css("margin-left", "45px");
  }, function(){
    var scrollPosition = $(window).scrollTop();
    if (scrollPosition > 10) {
      $(".header-nav").css("margin-left", "-100%");
    }
  });

  // footer social media link background/border effect
  $(".social").hover(function(){
    var hoverBorderClass = $(this).children("a").attr("class") + "hover";
    $(this).children(".bg-color").toggleClass(hoverBorderClass);
  });

  //footer square works links image hover effect
  $(".ad-img-container").hover(function(){
    $(this).children(".ad-img").css({
      webkitFilter: 'grayscale(0)',
      filter: 'grayscale(0)'
    });
    $(this).children(".ad-overlay").css("background", "rgba(255,255,255,0)");
    $(this).children(".ad-overlay").children(".ad-overlay-link").css("bottom","0");
  },function(){
    $(this).children(".ad-img").css({
      webkitFilter: 'grayscale(100%)',
      filter: 'grayscale(100%)'
    });
    $(this).children(".ad-overlay").css("background", "rgba(255,255,255,.4)");
    $(this).children(".ad-overlay").children(".ad-overlay-link").css("bottom", "-50px");
  });

  // header nav menu underline functionality
  // will match length and position of hovered menu link
  $(".menu-item a").hover(function(){
    var width = $(this).width();
    var position = $(this).position().left;
    $(".underline").removeClass(".not-hovering");
    $(".underline").css({
      'width': width,
      'left': position
    });
    $(".underline").css("transition-delay", "0s");
  }, function(){
    $(".underline").css({
      'width': "41.5px",
      'left': "0"
    });
    $(".underline").css("transition-delay", ".75s");
  });

  $(".post-button-container").hover(function(){
    $(".post-button-down").slideDown("fast");
  }, function(){
    $(".post-button-down").slideUp("fast");
  })

  $(".nav-link").on("click",function(){
    var currentId = $(".active").attr("href");
    $(".post-section").removeClass("active-section");
    $(currentId).addClass("active-section");
    post_img_transition();
  });

}

// LOADING EFFECTS


$(window).on("load",function(){
  var scrollPosition = $(document).scrollTop();
  var screenHeight = $(window).height();
  // hide header-nav
  if (scrollPosition > 10) {
    $(".header-nav").css("margin-left", "-100%");
  };

  // fix post-nav
  if (scrollPosition >= screenHeight) {
    $("#post-nav").css({
      position: 'fixed',
      top: "7px"
    })
  };

  // load animation on top page
  $(".see-work-message").css("top", "100%");
  $(".bottom-triangle").css("bottom", "-72px");
  $(".header-nav").css("margin-left", "45px");
  // top section title fadein and letter-spacing
  $(".build-text").fadeIn();
  $(".build-text").addClass("normal-letter-spacing");
  setTimeout(function(){
    $(".something-text").fadeIn();
    $(".something-text").addClass("normal-letter-spacing");
  },1500);

  // on load, hide all previous post fixed content
  if ($(".nav-link").hasClass("active")) {
    var activeSection = $(".active").attr("href");
    $(activeSection).prevAll().children(".post-fixed").css("height","0");
  };

  // see function at top of file
  post_img_transition();
  hide_last_fixed(scrollPosition);
  position_nav_line();
  hide_on_top_bottom(scrollPosition, screenHeight);
  hover_effect();
});
