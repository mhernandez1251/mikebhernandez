$("#img_src").on("change",function(){
  var reader = new FileReader();

  reader.onload = function (e) {
  $("#preview-img").removeClass("hidden");
  $("#preview-img").attr("src",e.target.result);
  $("#preview-img").css("width","200px");
  };

  reader.readAsDataURL(this.files[0]);
})

if (status == "login") {
  $("footer").css("bottom","0");
}

function switchChanges(imgUrl,border,color){
  $("#banner").css({
    "background" : imgUrl,
    "background-size" : "cover"
  });
  $("#banner-title, #header-account-dropdown, #header-search-submit").css("color",color);
  $("#searchfield").css("border",border);
  $(".header-account-signin, .header-list-item, #searchfield button, #pagination, #account-pagination, #account-pagination a, .previous-page a, .next-page a").css("color",color);
  $("#footer-social span").css("border","1px solid #fff");
  $("footer").css("background-color",color);
}
if (dishType != undefined) {
  switch(dishType){
    case "breakfast":
      switchChanges("url(../../img/pantree/breakfast-bg.jpg) no-repeat center","2px solid #D3B043","rgba(177,124,24,.9)");
      color = "rgba(177,124,24,.9)";
      break;
    case "lunch":
      switchChanges("url(../../img/pantree/lunch-background.jpg) no-repeat center","2px solid #2874A6","rgba(40, 116, 166, .9)");
      color = "rgba(40, 116, 166, .9)";
      break;
    case "dinner":
      switchChanges("url(../../img/pantree/dinner-bg.jpg) no-repeat center","2px solid #B84848","rgba(184,72,72,.9)");
      color = "rgba(184,72,72,.9)";
      break;
    case "dessert":
      switchChanges("url(../../img/pantree/dessert-bg.jpg) no-repeat center","2px solid #D05506","rgba(208,85,6,.9)");
      color = "rgba(208,85,6,.9)";
      break;
    default:
      switchChanges("url(../../img/pantree/full-bg.jpg) no-repeat center","2px solid #28B444","rgba(40,180,68,.8)");
      color = "rgba(40,180,68,.9)";
    break;
  }
} else {
  $(".header-account-signin,.header-list-item,.header-item,.footer-item,#searchfield button,#header-account-dropdown,#header-search-submit").css("color","#000");
  $("#account-text, #account-icon").css("color","#000");
  $("header, footer").css("background-color","rgba(255,255,255,.7)");
  $("#footer-social span").css("border","1px solid #000");
  $("#searchfield").css({
    "border" : "2px solid rgba(0,0,0,0.1)",
    "border-radius" : "0"
  });
  $("footer").css("border-top","2px solid rgba(0,0,0,.2)");
}


function toggleElementClass(elementName,toggleElementName,className) {
  $(elementName).on("click",function(){
    $(toggleElementName).toggleClass(className);
  })
}

toggleElementClass("#header-menu","#header-menu-dropdown","hidden");
toggleElementClass("#homepage-account-button","#homepage-account-dropdown","hidden");
toggleElementClass("#small-screen-search-icon","#searchfield","small-screen-hidden");
toggleElementClass("#account-options-button","#account-options-dropdown","hidden");
toggleElementClass("#header-account","#header-account-dropdown","hidden");

function positionChanges(screenPosition,bannerHeight,absoluteWidth,absoluteTop,absoluteLeft,scrollPosition,scrollWidth,scrollTop,scrollLeft,searchfieldTop,color){
  if (screenPosition < bannerHeight) {
    $("header").css("position","absolute");
    $("#search-container").css({
      "position": "absolute",
      "width" : absoluteWidth,
      "top" : absoluteTop,
      "left" : absoluteLeft
    });
    $("#searchfield").css("top","0");
    if (dishType != undefined){
      $("#header-container").css("background-color","inherit");
      $(".footer-item").css("color","#fff");
      $(".header-item, #account-icon, #account-text").css("color",color);
      $("#header-account").css("background-color","rgba(255,255,255,.5)");
    }
  } else {
    $("header").css("position","fixed");
    $("#search-container").css({
      "position" : scrollPosition,
      "width" : scrollWidth,
      "top" : scrollTop,
      "left" : scrollLeft
    });
    $("#searchfield").css("top",searchfieldTop);
    if (dishType != undefined) {
      $("#header-container").css("background-color",color);
      $(".footer-item").css("color","#fff");
      $(".header-item, #account-icon, #account-text").css("color","#fff");
      $("#header-account").css("background-color","rgba(0,0,0,0)");
    }
  }

}

function responsiveChanges () {
  var screenWidth = screen.width;
  var screenHeight = screen.height;
  var bannerHeight = parseFloat($("#banner").css("height"));
  var scrollPosition = $("body").scrollTop();
    if (screenWidth < 481) {
      positionChanges(scrollPosition,bannerHeight,"80vw","21vh","10vw","absolute","100vw","30px","0","0",color);
    } else if (screenWidth < 768) {
      positionChanges(scrollPosition,bannerHeight,"64vw","42vh","18vw","static","64vw","0","0","3px",color);
    } else if (screenWidth < 1024) {
      positionChanges(scrollPosition,bannerHeight,"58vw","26vh","21vw","static","58vw","0","0","3px",color);
    } else {
      positionChanges(scrollPosition,bannerHeight,"50vw","30vh","25vw","static","58vw","0","0","3px",color);
    }
}

function setPageHeight () {
  var footerHeight = $("footer").height();
  var footerBottom = "-" + footerHeight + "px";
  var pageBodyHeight = $(".page-body").height();
  if (pageBody){
    if (banner) {
      var bannerHeight = $("#banner").height();
      var minPageHeight = screen.height - bannerHeight - footerHeight;
      if (pageBodyHeight < minPageHeight) {
        $("footer").css("bottom","0");
      } else {
        $("footer").css("bottom",footerBottom);
      }
    } else {
      var minPageHeight = screen.height - footerHeight;
      if (pageBodyHeight < minPageHeight) {
        $("footer").css("bottom","0");
      } else {
        $("footer").css("bottom","inherit");
      }
    }
  }
}

$(document).on("scroll",function(){
  responsiveChanges();
})

$(window).on("orientationchange",function(){
  responsiveChanges();
  setPageHeight();
})


$(window).on("load",function(){
  responsiveChanges();
  setPageHeight();
})

if($(".favorite").hasClass("saved")){
  var saved = $(".cookbook-text-container saved");
  saved.css("background-color","#fff");
  saved.children(".star").removeClass("fa-star-o");
  saved.children(".star").addClass("fa-star gold");
};

$(".favorite").hover(function(){
  if(!$(this).hasClass("saved")){
    $(this).children(".star").removeClass("fa-star-o");
    $(this).children(".star").addClass("fa-star gold");
  }
},function(){
  if(!$(this).hasClass("saved")){
    $(this).children(".star").removeClass("fa-star gold");
    $(this).children(".star").addClass("fa-star-o");
  }
})

$(".favorite").on("click",function(){
  var id = $(this).parent().attr("id");
  if($(this).hasClass("saved")){
    $(this).removeClass("saved");
    $(this).css("background-color","inherit");
    $(this).children(".favorite-star-container").children(".star").addClass("fa-star-o");
    $(this).children(".favorite-star-container").children(".star").removeClass("fa-star gold");
    var index = $saved_ids.indexOf(id);
    $saved_ids.splice(index,1);
  } else {
    $(this).addClass("saved");
    $(this).css("background-color","rgba(255,255,255,.2)");
    $(this).children(".favorite-star-container").children(".star").removeClass("fa-star-o");
    $(this).children(".favorite-star-container").children(".star").addClass("fa-star gold");
    $saved_ids.push(id);
  }
  $.ajax({
		type: "POST",
		url: "account.php?status=update",
		data: {"favorites": $saved_ids},
		error: function(){
			console.log("Failed saved update");
		}
	});
})
