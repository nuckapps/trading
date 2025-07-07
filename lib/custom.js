$(document).ready(function () {

	//--------------------------------- Tabs section setup  --------------------------------//

	$('#wrapper').easytabs({
		animate: true,
		updateHash: false,
		transitionIn: 'slideDown',
		transitionOut: 'slideUp',
		animationSpeed: 800,
		tabActiveClass: 'active',
		tabs: ' #innerNav > ul > li',
		transitionInEasing: 'easeOutExpo',
		transitionOutEasing: 'easeInOutExpo'

	});

	//--------------------------------- End tabs section setup --------------------------------//


	//-----------------------------------Social and staff hover animation--------------------------------//

	$('#socials li').hover(function () {
		$(this).stop().animate({ "opacity": .85 }, 250);
	}, function () {
		$(this).stop().animate({ "opacity": 1 }, 250);
	});


	$('#staff li ul li').hover(function () {
		$(this).stop().animate({ marginLeft: "7px" }, 200);
	}, function () {
		$(this).stop().animate({ marginLeft: "0px" }, 200);
	});

	//--------------------------------------End social and staff hover animation---------------------//


	//--------------------------------- Setting up the slides animation ofor the testimonials --------------------------------//


	// $('#testimonials').slides({
	// 	preload: false,
	// 	generateNextPrev: false,
	// 	play: 4500,
	// 	container: 'testimoniaContainer'
	// });

	//--------------------------------- End setting up the slides animation for the testimonials --------------------------------//



	//-------------------------------------- Client and technologies hover animation---------------------//

	$("#client li, #technologiesUsed li").css({ opacity: 0.2 });
	$('#client li, #technologiesUsed li').hover(function () {
		$(this).stop().animate({ "opacity": 1 }, 400);
	}, function () {
		$(this).stop().animate({ "opacity": .2 }, 400);
	});

	// $('.client').poshytip({
	// 	className: 'tooltip',
	// 	showTimeout: 1,
	// 	alignTo: 'target',
	// 	alignX: 'center',
	// 	offsetY: 45,
	// 	allowTipHover: false
	// });

	// $('.technologie').poshytip({
	// 	className: 'tooltip',
	// 	showTimeout: 1,
	// 	alignTo: 'target',
	// 	alignX: 'center',
	// 	offsetY: 38,
	// 	allowTipHover: false
	// });


	//--------------------------------------End client and technologies hover animation---------------------//


	//--------------------------- Fancybox for single service----------------------------//

	// $('.btnHolder a').fancybox({
	// 	'overlayShow': true,
	// 	'opacity': true,
	// 	'transitionIn': 'elastic',
	// 	'transitionOut': 'none',
	// 	'overlayOpacity': 0.8
	// });
	//--------------------------- End fancybox for single service ----------------------------//


	//--------------------------------- Hover animation for the elements of the portfolio --------------------------------//

	$("div.plus").css({ opacity: 0 });
	$('.portfolio li').hover(function () {
		//$(this).children('img').animate({ opacity: 0.1 }, 'slow');
		$(this).children('div.bgorRpeat').animate({ opacity: 0 }, 'slow');
		$(this).children('div.plus').animate({ opacity: 1 }, 'slow');
		$(this).children('div.plus_1').animate({ opacity: 1 }, 'slow');
	}, function () {
		//$(this).children('img').animate({ opacity: 1 }, 'slow');
		$(this).children('div.bgorRpeat').animate({ opacity: 1 }, 'slow');
		$(this).children('div.plus').animate({ opacity: 0 }, 'slow');
		$(this).children('div.plus_1').animate({ opacity: 0 }, 'slow');
	});
	$('#plus_1').mousedown(function () {
		$('#folio_1').click();
	});
	$('#plus_2').mousedown(function () {
		$('#folio_2').click();
	});
	$('#plus_3').mousedown(function () {
		$('#folio_3').click();
	});

	//--------------------------------- End hover animation for the elements of the portfolio --------------------------------//


	//--------------------------------- Initilaizing fancybox for the clicked elements of the portfolio --------------------------------//

	// $('.portfolio a.folio').fancybox({
	// 	'overlayShow': true,
	// 	'opacity': true,
	// 	'transitionIn': 'elastic',
	// 	'transitionOut': 'none',
	// 	'overlayOpacity': 0.8,
	// 	'width' : 580,
	// 	'height' : 300
	// });

	//--------------------------------- End initilaizing fancybox for the clicked elements of the portfolio  --------------------------------//


	//--------------------------------- Sorting portfolio elements with quicksand plugin  --------------------------------//
	var $portfolioClone = $('.portfolio').clone();

	$('.filter a').click(function (e) {
		$('.filter li').removeClass('current');
		var $filterClass = $(this).parent().attr('class');
		if ($filterClass == 'all') {
			var $filteredPortfolio = $portfolioClone.find('li');
		} else {
			var $filteredPortfolio = $portfolioClone.find('li[data-type~=' + $filterClass + ']');
		}
		$('.portfolio').quicksand($filteredPortfolio, {
			duration: 800,
			easing: 'easeInOutQuad'
		}, function () {
			$('.portfolio li').hover(function () {
				//$(this).children('img').animate({ opacity: 0.1 }, 'fast');
				$(this).children('div.bgorRpeat').animate({ opacity: 0 }, 'slow');
				$(this).children('div.plus').animate({ opacity: 1 }, 'slow');
				$(this).children('div.plus_1').animate({ opacity: 1 }, 'slow');
			}, function () {
				//$(this).children('img').animate({ opacity: 1 }, 'slow');
				$(this).children('div.bgorRpeat').animate({ opacity: 1 }, 'slow');
				$(this).children('div.plus').animate({ opacity: 0 }, 'slow');
				$(this).children('div.plus_1').animate({ opacity: 0 }, 'slow');
			});

			//--------------------------------- Reinitilaizing fancybox for the new cloned elements of the portfolio --------------------------------//

			$('.portfolio a.folio').fancybox({
				'overlayShow': true,
				'opacity': true,
				'transitionIn': 'elastic',
				'transitionOut': 'none',
				'overlayOpacity': 0.8,
				'width' : 580,
				'height' : 300
			});

			//--------------------------------- End reinitilaizing fancybox for the new cloned elements of the portfolio ----------------------------//

		});


		$(this).parent().addClass('current');
		e.preventDefault();
	});

	//--------------------------------- End sorting portfolio elements with quicksand plugin--------------------------------//


	//---------------------------------- Google map customization & location -----------------------------------------//


	//----------------------------------dsiplaying the regular map without any canges of the appearance of the map ---------------//

	// $location = "Avenue de France, Agdal, Rabat, Rabat-Salé-Zemmour-Zaër, Maroc";
	// $contactTabClass = ('tab-contact')
	// $('#wrapper').bind('easytabs:after', function(evt, tab, panel, data) {
	// 	if ( tab.hasClass($contactTabClass) ) {
	// 		$('#map').gMap({ 
	// 		address:$location,
	// 		zoom:18,
	// 		markers: [{ address: $location }]
	//  });
	// 		}
	// });


	$contactTabClass = ('tab-contact');
	$('#wrapper').bind('easytabs:after', function (evt, tab, panel, data) {
		// if (tab.hasClass($contactTabClass)) {
		// 	/*setting up the coordinate for the gmap*/
		// 	var myLatlng = new google.maps.LatLng(33.99335, -6.848501, true);
		// 	/*setting up the map options*/
		// 	var myOptions = {
		// 		zoom: 3,
		// 		streetViewControl: false,
		// 		disableDefaultUI: true,
		// 		zoomControl: true,
		// 		center: myLatlng,
		// 		mapTypeId: google.maps.MapTypeId.ROADMAP,

		// 	};

		// 	/*styling the gmap by changing the color of the map options*/
		// 	var styles = [{
		// 		featureType: "transit", elementType: "all", stylers: [{ visibility: "simplified" }, { color: "#444444" }]
		// 	},
		// 	{ featureType: "water", elementType: "all", stylers: [{ visibility: "simplified" }, { color: "#6d6e71" }] }, {
		// 		featureType: "road", elementType: "all", stylers: [{ visibility: "simplified" }, { color: "#444444" }]
		// 	}, {
		// 		featureType: "landscape", elementType: "all", stylers: [{ visibility: "simplified" }, { color: "#444444" }]
		// 	}, {
		// 		featureType: "poi", elementType: "all", stylers: [{ visibility: "simplified" }, { color: "#6d6e71" }]
		// 	}, {
		// 		featureType: "all", elementType: "all", stylers: [{ visibility: "simplified" }, { "weight": 1 }]
		// 	}];

		// 	/*populating the gmap in the html*/
		// 	var map = new google.maps.Map(document.getElementById('map'), myOptions);
		// 	map.setOptions({ styles: styles });

		// }

		/*setting up the pointer shape of the map in this case a circle*/
		// var pointer = {
		// 	path: google.maps.SymbolPath.CIRCLE,
		// 	fillOpacity: 1,
		// 	fillColor: '#ff6E22',
		// 	strokeOpacity: 0,
		// 	scale: 8
		// };


		/*setting up the marker of the map*/
		// var myLatLng = new google.maps.LatLng(33.829053, -6.811523);
		// var marker = new google.maps.Marker({
		// 	position: myLatLng,
		// 	map: map,
		// 	icon: pointer
		// });

		// Despues de deplegar la lista, da foco al input Lotaje
		document.getElementById("lotaje").focus();
	});

	/*waiting for the dom to load then displaying the map*/
	// google.maps.event.addDomListener(window, 'load');




	//---------------------------------- End google map customization & location -----------------------------------------//

	//---------------------------------- Forms validation -----------------------------------------//

	/*click handler on the submit button*/
	$('#submit').click(function () {
		$('.error').fadeOut('slow');

		var error = false;
		var name = $('input#name').val();
		if (name == "" || name == " ") {
			$('#err-name').fadeIn('slow');
			error = true;
		}

		var email_compare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/;
		var email = $('input#email').val();
		if (email == "" || email == " ") {
			$('#err-email').fadeIn('slow');
			error = true;
		} else if (!email_compare.test(email)) {
			$('#err-emailvld').fadeIn('slow');
			error = true;
		}

		if (error == true) {
			return false;
		}

		var data_string = $('.contactForm').serialize();


		$.ajax({
			type: "POST",
			url: $('.contactForm').attr('action'),
			data: data_string,
			timeout: 6000,
			error: function (request, error) {
				if (error == "timeout") {
					$('#err-timedout').fadeIn('slow');
				}
				else {
					$('#err-state').fadeIn('slow');
					$("#err-state").html('An error occurred: ' + error + '');
				}
			},
			success: function () {
				$('#success').fadeIn('slow');
			}
		});

		return false;
	});
	//---------------------------------- End forms validation -----------------------------------------//


	//---------------------------------------Tweets --------------------------------------------------//

	// getTwitters('feed', {
	// 	id: 'BenaissaGhrib', //change the id with your twitter id to display your twitter feed 
	// 	count: 1,
	// 	enableLinks: true,
	// 	ignoreReplies: true,
	// 	clearContents: true,
	// 	template: '<b>%user_name%@ %user_screen_name%</b> "%text%" <a href="http://twitter.com/user_name%/%user_screen_name%/statuses/%id_str%/"></a>'
	// });

	//---------------------------------------End tweets --------------------------------------------------//


	//-------------------------------------------------Flex slider --------------------------------------------------//
	$('.flexslider').flexslider({
		animation: "fade"
	});
	//------------------------------------------------- End flex slider --------------------------------------------------//

});
