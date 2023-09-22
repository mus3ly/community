$(document).ready(function () {
  const toggleBtn = $('#header-toggle-btn');

  function toggleHeader() {
    $('.hidden-header').slideToggle('slow');
    $('.directory-main').toggleClass('header-hidden');

    const icon = toggleBtn.find('i');
    if (icon.hasClass('fa-caret-down')) {
      icon.removeClass('fa-caret-down').addClass('fa-caret-up');
    } else {
      icon.removeClass('fa-caret-up').addClass('fa-caret-down');
    }
  }
  
  	function search_location()
{
    alert('search_location');
    console.log("Here");

    var str = $('#right_box').val();
    //
    console.log();
    if(str.length >= 2 )
    {
        $('#map_search #loader').show();
        $('#map_search #result').hide();
        $.ajax({
        url: "<?= base_url('home/srch_loc'); ?>?str="+str,
        type: 'GET',
        // dataType: 'json', // added data type
        success: function(res) {
            $('#map_search #loader').hide();
            $('#map_search #result').show();
            $('#map_search #result').html(res);
            // alert(res);
        }
    });

    }
    else
    {
        $('#map_search #result').hide();
    }
}
function select_place(place,txt)
{
    $('#right_box').val(txt);
    $('#place_id').val(place);
    $('#map_search #result').hide();
    if(directory)
    {
        submit_dform();
    }

}

  toggleBtn.click(function () {
    toggleHeader();
  });

  setTimeout(function () {
    toggleBtn.show();
  }, 10000);
});


(function($) {
	AOS.init({
    once: true
  });

	/*---Owl-carousel----*/

	// ___Owl-carousel-icons
	var owl = $('.owl-carousel-icons');
	owl.owlCarousel({
		loop: true,
		rewind: false,
		margin: 0,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: false,
		autoplayTimeout: 5000, 
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 4,
				nav: false
			},
			600: {
				items: 6,
				nav: true
			},
			1250: {
				items: 6,
				nav: true,
        margin: 5
			}
		}
	})
 // ___Owl-carousel-icons

})(jQuery);


	//Range Slider
  if ($('.area-range-slider').length) {
    $(".area-range-slider").each(function (index, element) {
        var slider = $(element);
        var input = slider.closest(".range-slider-one").find("input.property-amount");
        var v= $(this).attr()

        slider.slider({
            range: true,
            min: 0,
            max: max_price,
            values: [0, max_price],
            slide: function (event, ui) {
                $('#sale_price').val(ui.values[1]);
                input.val(ui.values[0] + " - " + ui.values[1]);
            }
        });

        input.val(slider.slider("values", 0) + " - " + slider.slider("values", 1));
    });
}



	$(document).ready(function() {
		$('#list').click(function(event){
			event.preventDefault();
			$('#list-grid .change-item').addClass('col-lg-12 col-md-12 list-style');
			$('#list-grid .change-item').removeClass('col-lg-6 col-md-6 grid-style');
			$('#grid').removeClass('active');
			$('#list').addClass('active');
		});
	
		$('#grid').click(function(event){
			event.preventDefault();
			$('#list-grid .change-item').removeClass('col-lg-12 col-md-12 list-style');
			$('#list-grid .change-item').addClass('col-lg-6 col-md-6 grid-style');
			$('#list').removeClass('active');
			$('#grid').addClass('active');
		});
	
		$('#map').click(function(event){
			event.preventDefault();
			$('#list-grid .map-wrapper').slideToggle("slow");
      $(this).toggleClass('active');
		});
	});
	
  $(".copy-btn").click(function() {
    var section = $(this).closest(".table_type"); // Find the closest parent section
    var inputElement = section.find(".copy-class"); // Find the input within that section
    inputElement.select();
    document.execCommand("copy");
    $(this).html('<i class="bi bi-clipboard-check"></i>');
  });

	jQuery(document).ready(function() {
    var sync1 = jQuery("#sync1");
    var sync2 = jQuery("#sync2");
    var slidesPerPage = 6; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1
      .owlCarousel({
      items: 1,
      slideSpeed: 3000,
      slideSpeed: 1000,
      nav: true,

      //   animateOut: 'fadeOut',
      animateIn: "animate__fadeIn",
      autoplayHoverPause: true,
      autoplaySpeed: 1400,
      dots: false,
      loop: true,
      responsiveClass: true,
      responsive: {
        0: {
          item: 1,
          autoplay: false
        },
        600: {
          items: 1,
          autoplay: true
        }
      },
      responsiveRefreshRate: 200,
      navText: [
        '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' 
      ]
    })
      .on("changed.owl.carousel", syncPosition);

    sync2
      .on("initialized.owl.carousel", function() {
      sync2
        .find(".owl-item")
        .eq(0)
        .addClass("current");
    })
      .owlCarousel({
      items: 8,
      dots: false,
      //   nav: true,
      smartSpeed: 1000,
      slideSpeed: 1000,
      center: false,
      margin: 5,
      responsive: {
        300: {
          items: 3,
          autoplay: false
        },
        420: {
          items: 4,
          autoplay: false
        },
        600: {
          items: 8,
          autoplay: false,
          margin: 0
        },
      },
      slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
      responsiveRefreshRate: 100
    })
      .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
      //if you set loop to false, you have to restore this next line
      //var current = el.item.index;

      //if you disable loop you have to comment this block
      var count = el.item.count - 1;
      var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

      if (current < 0) {
        current = count;
      }
      if (current > count) {
        current = 0;
      }

      //end block

      sync2
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
      var onscreen = sync2.find(".owl-item.active").length - 1;
      var start = sync2
      .find(".owl-item.active")
      .first()
      .index();
      var end = sync2
      .find(".owl-item.active")
      .last()
      .index();

      if (current > end) {
        sync2.data("owl.carousel").to(current, 100, true);
      }
      if (current < start) {
        sync2.data("owl.carousel").to(current - onscreen, 100, true);
      }
    }

    function syncPosition2(el) {
      if (syncedSecondary) {
        var number = el.item.index;
        sync1.data("owl.carousel").to(number, 100, true);
      }
    }

    sync2.on("click", ".owl-item", function(e) {
      e.preventDefault();
      var number = jQuery(this).index();
      sync1.data("owl.carousel").to(number, 300, true);
    });
  });


	$(document).ready(function(){
  
		/* 1. Visualizing things on Hover - See next part for action on click */
		$('#stars li').on('mouseover', function(){
			var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
		 
			// Now highlight all the stars that's not after the current hovered star
			$(this).parent().children('li.star').each(function(e){
				if (e < onStar) {
					$(this).addClass('hover');
				}
				else {
					$(this).removeClass('hover');
				}
			});
			
		}).on('mouseout', function(){
			$(this).parent().children('li.star').each(function(e){
				$(this).removeClass('hover');
			});
		});
		
		
		/* 2. Action to perform on click */
		$('#stars li').on('click', function(){
			var onStar = parseInt($(this).data('value'), 10); // The star currently selected
			var stars = $(this).parent().children('li.star');
			
			for (i = 0; i < stars.length; i++) {
				$(stars[i]).removeClass('selected');
			}
			
			for (i = 0; i < onStar; i++) {
				$(stars[i]).addClass('selected');
			}
		});
		
		
	});

	
  	//LightBox / Fancybox
// 		if($('.lightbox-image').length) {
// 			$('.lightbox-image').fancybox({
// 				openEffect  : 'fade',
// 				closeEffect : 'fade',
// 				helpers : {
// 					media : {}
// 				}
// 			});
// 		}
	

const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);


let $filterBtns = $('.filter-btns button');
$filterBtns.click(function(e){
   $('.filter-btns button').removeClass('active');
   e.target.classList.add('active');

   let selector = $(e.target).attr('data-filter');
   $('#list-grid .filter-list').isotope({
      filter: selector
   });
   return false;
});



