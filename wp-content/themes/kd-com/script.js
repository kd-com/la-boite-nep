		// preloader
    jQuery(window).load(function () {
        "use strict";
        // will first fade out the loading animation
		if(  jQuery( '.et-bfb' ).length <= 0 && jQuery( '.et-fb' ).length <= 0  ){ 
			jQuery(".status").fadeOut();
			// will fade out the whole DIV that covers the website.
			jQuery(".preloader").delay(1000).fadeOut("slow");
		}else{
			jQuery(".preloader").css('display','none');
		}

    }); 


 // woo commerce quantité
    function PbStyleQuantite(a) {
    var b, c = !1;
    a || (a = ".qty"),
    b = jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find(a),
    b.length && (jQuery.each(b, function(a, b) {
        "date" !== jQuery(b).prop("type") && "hidden" !== jQuery(b).prop("type") && (jQuery(b).parent().hasClass("buttons_added") || (jQuery(b).parent().addClass("buttons_added").prepend('<input type="button" value="-" class="minus" />'),
        jQuery(b).addClass("input-text").after('<input type="button" value="+" class="plus" />'),
        c = !0))
    }),
    c && (jQuery("input" + a + ":not(.product-quantity input" + a + ")").each(function() {
        var a = parseFloat(jQuery(this).attr("min"));
        a && a > 0 && parseFloat(jQuery(this).val()) < a && jQuery(this).val(a)
    }),
    jQuery(".plus, .minus").unbind("click"),
    jQuery(".plus, .minus").on("click", function() {
        var b = jQuery(this).parent().find(a)
          , c = parseFloat(b.val())
          , d = parseFloat(b.attr("max"))
          , e = parseFloat(b.attr("min"))
          , f = b.attr("step");
        c && "" !== c && "NaN" !== c || (c = 0),
        "" !== d && "NaN" !== d || (d = ""),
        "" !== e && "NaN" !== e || (e = 0),
        "any" !== f && "" !== f && void 0 !== f && "NaN" !== parseFloat(f) || (f = 1),
        jQuery(this).is(".plus") ? d && (d == c || c > d) ? b.val(d) : b.val(c + parseFloat(f)) : e && (e == c || c < e) ? b.val(e) : c > 0 && b.val(c - parseFloat(f)),
        b.trigger("change")
    })))
}
jQuery(window).on("load", function() {
    PbStyleQuantite()
}),
jQuery(document).ajaxComplete(function() {
    PbStyleQuantite()
});


// affichage blog
(function ($) {
    $(document).ready(function () {
        //Wrap first grid elements in containers
        $(".ds-grid-blog-1 .et_pb_post").each(function () {
            $(this).find(".entry-featured-image-url").wrapAll('<div class="ds-grid-blog-image"></div>');
            $(this).find(".entry-title, .post-meta, .post-content").wrapAll('<div class="ds-grid-blog-content"></div>');
        });
    });
})(jQuery);
(function ($) {
    $(document).ready(function () {
        $(document).bind('ready ajaxComplete', function () {
            //Wrap second grid elements in containers
            $(".ds-grid-blog-2 .et_pb_post").each(function () {
                $(this).find(".entry-featured-image-url").wrapAll('<div class="ds-grid-blog-image"></div>');
                $(this).find(".entry-title, .post-meta, .post-content").wrapAll('<div class="ds-grid-blog-content"></div>');
            });
            //Move elements around
            $(".et_pb_post").each(function () {
                $(".post-meta", this).insertBefore($(".entry-title", this));
            });
            //Add button class to read more link
            $(".et_pb_post a.more-link").addClass("et_pb_button");
            //Replace pipes and remove commas from the meta
            $(".et_pb_post").html(function () {
                return $(this).html().replace(/\|/g, '/').replace(/,/g, '');
            });
        });
    });
})(jQuery);

// slider hero
// HERO SLIDER


if($(".swiper-slide.hero").length == 1) {
    $('.swiper-wrapper.hero').addClass( "disabled" );
    $('.swiper-pagination.hero').addClass( "disabled" );
    $('.upk-salf-nav-pag-wrap.hero').addClass("disabled");
    $('.swiper-button-next.hero').addClass('disabled');
    $('.swiper-button-prev.hero').addClass('disabled');
    $('.container.hero').addClass('disabled');
}
if($(".swiper-slide.hero.video").length == 1) {
    $('.swiper-wrapper.hero').addClass( "disabled" );
    $('.swiper-pagination.hero').addClass( "disabled" );
    $('.upk-salf-nav-pag-wrap.hero').addClass("disabled");
    $('.swiper-button-next.hero').addClass('disabled');
    $('.swiper-button-prev.hero').addClass('disabled');
    $('.container.hero').addClass('disabled');
}
    var menu = [];
    jQuery('.swiper-slide.hero').each( function(index){
        menu.push( jQuery(this).find('.slide-inner').attr("data-text") );
    });
    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 1000,
        parallax: true,
        autoplay: {
            delay: 6500,
            disableOnInteraction: false,
        },
        watchSlidesProgress: true,
        pagination: {
         el: '.swiper-pagination',
         clickable: true,
         renderBullet: function(index, className) {
             return '<span class="' + className + ' swiper-pagination-bullet--svg-animation"><svg width="28" height="28" viewBox="0 0 28 28"><circle class="svg__circle" cx="14" cy="14" r="10" fill="none" stroke-width="2"></circle><circle class="svg__circle-inner" cx="14" cy="14" r="2" stroke-width="3"></circle></svg></span>';
         },
     },

        navigation: {
            nextEl: '.upk-button-next',
            prevEl: '.upk-button-prev',
        },

        on: {
            progress: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                    "translate3d(" + innerTranslate + "px, 0, 0)";
                }      
            },

            touchStart: function() {
              var swiper = this;
              for (var i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = "";
              }
            },

            setTransition: function(speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                    speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);

    // DATA BACKGROUND IMAGE
    var sliderBgSetting = $(".slide-bg-image");
    sliderBgSetting.each(function(indx){
        if ($(this).attr("data-background")){
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });