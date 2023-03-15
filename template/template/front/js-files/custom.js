
$(document).ready(function(){
	
	$('ul.tabs__ li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs__ li').removeClass('current__');
		$('.tab-content__').removeClass('current__');

		$(this).addClass('current__');
		$("#"+tab_id).addClass('current__');
	});

});



$(document).ready(function(){
	
	$('ul.tabs__box li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs__box li').removeClass('current');
		$('.tab-content__box').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});

});




    $("#cart_modelbox .btn-theme-transparent").click(function(){
    $(".cart_totaloverlay,.model___cart").fadeIn();
});
$(".closebtn,.cart_totaloverlay").click(function(){
    $(".cart_totaloverlay,.model___cart").fadeOut();
});



$("[id^=carousel-thumbs]").carousel({
	interval: false
});

/** Pause/Play Button **/
$(".carousel-pause").click(function () {
	var id = $(this).attr("href");
	if ($(this).hasClass("pause")) {
		$(this).removeClass("pause").toggleClass("play");
		$(this).children(".sr-only").text("Play");
		$(id).carousel("pause");
	} else {
		$(this).removeClass("play").toggleClass("pause");
		$(this).children(".sr-only").text("Pause");
		$(id).carousel("cycle");
	}
	$(id).carousel;
});

/** Fullscreen Buttun **/
$(".carousel-fullscreen").click(function () {
	var id = $(this).attr("href");
	$(id).find(".active").ekkoLightbox({
		type: "image"
	});
});

if ($("[id^=carousel-thumbs] .carousel-item").length < 2) {
	$("#carousel-thumbs [class^=carousel-control-]").remove();
	$("#carousel-thumbs").css("padding", "0 5px");
}

$("#carousel").on("slide.bs.carousel", function (e) {
	var id = parseInt($(e.relatedTarget).attr("data-slide-number"));
	var thumbNum = parseInt(
		$("[id=carousel-selector-" + id + "]")
			.parent()
			.parent()
			.attr("data-slide-number")
	);
	$("[id^=carousel-selector-]").removeClass("selected");
	$("[id=carousel-selector-" + id + "]").addClass("selected");
	$("#carousel-thumbs").carousel(thumbNum);
});
