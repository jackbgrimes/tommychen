jQuery(function(){
  if (jQuery(window).width() <= 767) {
    jQuery(".artist-thumb.fade").each(function() {
      jQuery(this).waypoint(function() {
          jQuery(this.element).addClass("visible")
      }, {
          triggerOnce: !0,
          offset: "80%"
      })
    })
  } else {
    jQuery(".artist-row").each(function() {
      var timelineMax = new TimelineMax({
          paused: !0
      });
      timelineMax.staggerTo(jQuery(this).find(".artist-thumb"), .5, {
          top: 0,
          autoAlpha: 1
      }, .1);
      jQuery(this).waypoint(function() {
        timelineMax.play()
      }, {
          triggerOnce: !0,
          offset: "80%"
      })
    })
  }
  if (jQuery(".artist-list .artist-row").length > 3) {
    jQuery(".artist-list .btn-container").show();
    jQuery(".artist-list .show-more").on("click", function(e) {
      var t = jQuery(e.currentTarget);
      t.hasClass("more") ? (t.removeClass("more"), t.html("Show More"), jQuery(".artist-row:nth-child(1n+4)").slideUp()) : (t.addClass("more"), t.html("Show Fewer"), jQuery(".artist-row:nth-child(1n+4)").slideDown())
    });
    jQuery(".artist-row .artist-thumb").hover(function() {
      jQuery(this).addClass("show"), jQuery(this).find(".url").stop(!0, !0).slideDown(250)
    }, function() {
      jQuery(this).removeClass("show"), jQuery(this).find(".url").stop(!0, !0).slideUp(250)
    })
  }
});