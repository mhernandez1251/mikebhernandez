$(document).ready(function(){
	$(".collapse-logo").on("click",function(){
		$(".collapse-logo").toggleClass("expanded");
		$("#nav-list").toggleClass("hidden-nav");
	})

	$(".search-logo").on("click",function(){
		$("#searchbar").toggleClass("hidden");
	})

	$("#searchbar .close").on("click",function(){
		$("#searchbar").toggleClass("hidden");
		$("#search-field").val("");
	})

	$("#sign-in-buttons button").on("click",function(){
		$("#form-overlay").css("display","flex");
		if($(this).hasClass("signup-button")){
			$("#form-container form").attr("action","user-account.php?status=signup");
			$("#form-title").html("Sign Up Form");
			$("#signup-container").removeClass("hidden");
		}else {
			$("#form-container form").attr("action","user-account.php?status=login");
			$("#form-title").html("Login Form");
			$("#login-container").removeClass("hidden");
		}
	})

	$(".form-close").on("click",function(){
		$("#form-container form").attr("action","");
		$("#form-overlay").css("display","none");
		$("#form-title").html("");
		$("#signup-container, #login-container").addClass("hidden");
	})


	$(window).resize(function(){
		if(parseFloat($("header").css("width")) >= 768){
			$("header .fa, #social-media-list li a .fa").removeClass("fa-3x");
			$("header .fa, #social-media-list li a .fa").addClass("fa-lg");
		}else if(parseFloat($("header").css("width")) >= 1224){
			$("header .fa, #social-media-list li a .fa,#social-media-list li a .fa").addClass("fa-3x");
		}else{
			$("header .fa, #social-media-list li a .fa").removeClass("fa-lg");
			$("header .fa, #social-media-list li a .fa, #social-media-list li a .fa").removeClass("fa-3x");
		}
	})

	function initialIconSize(){
		if(parseFloat($("header").css("width")) >= 768){
			$("header .fa, #social-media-list li a .fa").addClass("fa-lg");
		}else if(parseFloat($("header").css("width")) >= 1224){
			$("header .fa, #social-media-list li a .fa").addClass("fa-3x");
		}else{
			$("header .fa, #social-media-list li a .fa").removeClass("fa-lg");
			$("header .fa, #social-media-list li a .fa").removeClass("fa-3x");
		}
	}

	initialIconSize();

	$(".main-body-section").hover(function(){
		$(this).children(".main-body-section-overlay").toggleClass("hidden");
	})

	$(".hover-buy").on("click",function(){
		var mainOverlay = $(this).parent().parent().parent();
		mainOverlay.children(".item-buy-overlay").css("display","block");
		mainOverlay.children(".initial-overlay").css("display","none");
	})

	$(".cancel-buy").on("click",function(event){
		event.preventDefault();
		var mainOverlay = $(this).parent().parent().parent();
		mainOverlay.children(".item-buy-overlay").css("display","none");
		mainOverlay.children(".initial-overlay").fadeIn("slow");
	})

	if(typeof($cart) === 'undefined' || $cart == null){
		var $cart = [];
	}

	function postCart() {
		$.ajax({
			type: "POST",
			url: "cart.php",
			data: {"cart": $cart},
			error: function(){
				console.log("Failed Post");
			}
		});
	}

	$(".add-cart").on("click",function(event){
		event.preventDefault();
		var mainOverlay = $(this).parent().parent();
		var itemName = mainOverlay.children(".item-buy-label").html();
		var itemPrice = parseFloat(mainOverlay.children(".item-buy-price").children(".price-number").html());
		var itemQuantity = parseInt(mainOverlay.children(".quantity-container").children(".item-quantity").val());
		var finalPrice = (itemPrice * itemQuantity).toFixed(2);
		var order = [];
		order.push(itemName,itemPrice,itemQuantity,finalPrice);
		$cart.push(order);
		postCart();
		mainOverlay.parent().children(".item-buy-overlay").css("display","none");
		mainOverlay.parent().children(".success-overlay").css("display","block");
		mainOverlay.parent().children(".success-overlay").fadeOut(1000);
		setTimeout(function(){
			mainOverlay.parent().children(".initial-overlay").fadeIn("fast");
		},1000)
	})

	$("#clear-cart").on("click",function(){
		$cart = [];
		$.ajax({
			type: "POST",
			url: "cart.php",
			data: {"action":"empty"},
			error: function(){
				console.log("Failed Empty");
			}
		});
	})

	$(".quantity-data .item-quantity").on("change",function(){
		var mainOverlay = $(this).parent().parent();
		var index = parseInt(mainOverlay.attr("class"));
		var newQuantity = parseInt($(this).val());
		$cart[index][2] = newQuantity;
		var newTotal = ($cart[index][1] * newQuantity).toFixed(2);
		$cart[index][3] = newTotal;
		$.ajax({
			type: "POST",
			url: "cart.php",
			data: {"cart": $cart},
			error: function(){
				console.log("Failed Post");
			}
		});
	})

	$(".delete-item").on("click",function(){
		var mainOverlay = $(this).parent().parent().parent();
		var index = parseInt(mainOverlay.attr("class"));
		if (index === 0) {
			$cart.shift();
		}else{
			$cart.splice(index,1);
		}
		$.ajax({
			type: "POST",
			url: "cart.php",
			data: {"action": "delete", "cart" : $cart},
			error: function(){
				console.log("Failed Empty");
			}
		});
	})

	$("#checkout-login").on("click",function(){
		$(this).addClass("checkout-select");
		$("#checkout-signup").removeClass("checkout-select");
		$("#account-login").css("display","flex");
		$("#account-signup").css("display","none");
		$("#form-container form").attr("action","user-account.php?status=login&redirect=checkout");
	})

	$("#checkout-signup").on("click",function(){
		$(this).addClass("checkout-select");
		$("#checkout-login").removeClass("checkout-select");
		$("#account-login").css("display","none");
		$("#account-signup").css("display","block");
		$("#form-container form").attr("action","user-account.php?status=signup&redirect=checkout");
	})


	$("#item-page-buy").on("click",function(event){
		event.preventDefault();
		var mainDiv = $(this).parent().parent();
		var itemName = $item["h3"];
		var itemPrice = parseFloat($item["price"]);
		var quantity = parseInt(mainDiv.children(".quantity-container").children(".item-quantity").val());
		var totalPrice = (itemPrice * quantity).toFixed(2);
		var order = [];
		order.push(itemName,itemPrice,quantity,totalPrice);
		$cart.push(order);
		postCart();
	})

	$("#account-delete").on("click",function(){
		$("#delete-account-container").removeClass("hidden");
	})

	$("#cancel-account-delete").on("click",function(){
		$("#delete-account-container").addClass("hidden");
	})

})
