
jQuery(function() {
  var isTablet = jQuery(window).width() <= 1024, isMobile = jQuery(window).width() <= 767;
  jQuery(".trending-wrap").masonry({
    itemSelector: ".trend-item",
    columnWidth: ".grid-sizer",
    gutter: ".gutter-sizer",
    percentPosition: !0,
    isAnimated: !0
  });

  isMobile && jQuery(".trend-item").length >= 9 ? jQuery(".mason-load-more").show() : !isMobile && jQuery(".trend-item").length >= 20 && jQuery(".mason-load-more").show(), 
  jQuery(".mason-load-more").on("click", function(e) {
    jQuery(e.currentTarget).hide(), jQuery(".trending-wrap").addClass("show-more").masonry("layout")
  });

  jQuery(".trending .trend-item").each(function() {
    jQuery(this).waypoint(function() {
        jQuery(this.element).addClass("visible")
    }, {
        triggerOnce: !0,
        offset: "80%"
    })
  })

  jQuery(".trending .trend-item.video").on("click", function(e) {
    var o = jQuery(e.currentTarget).attr("data-videoId"),
        i = jQuery(".custom-modal .video-frame");
    jQuery(".custom-modal .video-frame").attr("src", "https://www.youtube.com/embed/"), i[0].src += o, jQuery("#video-modal"), i[0].src += "?rel=0&autoplay=1";
    jQuery(".custom-modal").fadeIn()
  })
});