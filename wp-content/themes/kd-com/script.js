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