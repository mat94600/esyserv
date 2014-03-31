$(function(){

    /*================ DETECT IPAD */
   /* var isiPad = navigator.userAgent.match(/iPad/i) != null;

    if(isiPad){
        $("body").addClass("ipad");
    }*/

	$(".mobile-menu a").click(function() {
		      $("nav ul#menu-menu-haut").slideToggle();
		      var status = $(this).attr('data-status');

		      if (status=='plus') {
			        $(this).attr('data-status', 'minus');
			        $(this).html('<i class="fa fa-minus"></i> Menu');
		      } else if (status == 'minus') {
			        $(this).attr('data-status', 'plus');
			        $(this).html('<i class="fa fa-plus"></i> Menu');
		      } else {
			        $(this).html("Erreur lors du chargement du menu ...");
			                                                  
			                                                  
		      }
	    });

	/* SliderC */

	sliderC = $(".sliderC .solutions a");

	/*sliderC.hover(function(){
		/*$(this).toggleClass('item--blur');*/
		/*$(this).stop().animate({'opacity':0.8},500)
	})*/

    sliderC.hover(function() { 
    	$(this).stop().animate({"opacity": 0.5},500); 
    },function() { 
    	$(this).stop().animate({"opacity": 1},500); 
    });

    /* Slider Temoignages */
    var currentPosition	 = 0;
    var btnsTemoignages  = $("#control a");
    var totalSlides      = $(".overflowTemoignages > .col-md-6").length;
    var slideWidth       = $(".overflowTemoignages > .col-md-6").outerWidth();
    var slidesTotal      = totalSlides * slideWidth;
    var containerWidth   = $(".overflowTemoignages").outerWidth(slidesTotal);

	/*var IntID = setTimer();
	function setTimer(){
		j = true;
     	i = setInterval(slide_temoignages, 200);
     	return i;
	}
	function stopSlider() {
    	clearInterval(IntID);
    }*/
    $("#Prev").before('<div class="start_slide"></div>');
    btnsTemoignages.bind("click", slide_temoignages)

    function slide_temoignages(){

    	thisID	=	$(this).attr("id");
    	currentPosition = (thisID == "Next")? currentPosition+1:currentPosition-1;
    	if(currentPosition < 0){ currentPosition = 0; }

    	deplacement = slideWidth*(-currentPosition);

    	if( navigator.userAgent.match(/Android/i)|| navigator.userAgent.match(/webOS/i)
    		|| navigator.userAgent.match(/iPhone/i)|| navigator.userAgent.match(/iPod/i)|| navigator.userAgent.match(/BlackBerry/i)
    		|| navigator.userAgent.match(/Windows Phone/i))
    	{
    		nbr_deplacement = 1;
    	}else{
    		nbr_deplacement = 2
    	}

    	if(currentPosition >= 0){
    		$(".overflowTemoignages").animate({
    			"margin-left": deplacement*nbr_deplacement 
    		});
    		$(".start_slide").css({'display':'none'});
    	}

    	if(currentPosition == 0){
    		$(".start_slide").css({'display':'block'});
    	}

    	if(deplacement*-nbr_deplacement == (totalSlides/nbr_deplacement)*slideWidth){
    		$("#Next").before("<div class='end_slide'></div>")
    	}else{
    		$(".end_slide").css({'z-index':'0'});
    	}

    	return false;
    }

    /* Home slider */
    $('#banner-fade').bjqs({
    	'height' : 378,
    	'width' : 340,
    	'animtype' : 'slide',
    	'responsive' : true
    });

    $('.bjqs-markers').prependTo('.sliderBtn');
    $('.sliderBtn').addClass('hidden-xs');
    var dataImage = $(".sliderBtn .col-md-4 ").data("img");
    var menuC     = $(".sliderBtn .col-md-9 div");
    var sliderC   = $(".sliderC .col-md-5 img");
    var firstImg  = $(".sliderBtn .col-md-4:nth-child(1)").data("img");

    sliderC.attr("src", firstImg);

    $(".bjqs-markers li:first-child a").text("Un réseau structuré");
    $(".bjqs-markers li:nth-child(2) a").text("Des experts réconnus");
    $(".bjqs-markers li:last-child a").text("Des défis stimulants");
    $(".bjqs-markers li:last-child").css({"border-right":"none"});

    /* Nos References sur la home page */
    var divs_6 = $(".nos-refs > .col-md-2");
    var divs_4 = $(".nos-clients > .col-md-3");

    for(var i = 0; i < divs_6.length; i+=6) {
    	divs_6.slice(i, i+6).wrapAll("<div class='row grid'></div>");
    };

    for(var i = 0; i < divs_4.length; i+=4) {
    	divs_4.slice(i, i+4).wrapAll("<div class='row grid'><div class='col-md-11 center-block'></div></div>");
    };

    /* Supprimer les paragraphes vides */


    $('.row > p').filter(function() {
    	return $.trim($(this).text()) === '' && $(this).children().length == 0
    })
    .remove()

})	
