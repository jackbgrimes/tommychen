jQuery(function(){
  var slider = jQuery(".hiw-milestones__slider");
  slider.on("init", (function(t, i, e, s) {
      jQuery(t.target).siblings().find(jQuery(".hiw-navigation__progress__item:nth-of-type(1)")).addClass("is-playing")
  }));
  slider.slick();
  slider.on("beforeChange", (function(t, i, e, s) {
      var n = jQuery(t.target);
      n.siblings().find(jQuery(".nav-number")).text(s + 1), n.siblings().find(jQuery(".hiw-navigation__progress__item.is-playing")).removeClass("is-playing"), n.siblings().find(jQuery(`.hiw-navigation__progress__item:nth-of-type(${s+1})`)).addClass("is-playing")
  }));
  jQuery(".hiw-navigation__progress__item").on("click", (function(t) {
      var i = this.getAttribute("data-index"),
          e = this.getAttribute("data-target");
      jQuery(`#hiw-milestones__slider--${e}`).slick("goTo", i, !1)
  }));
  jQuery(".hiw-milestones__touchzone--prev").on("click", (function(t) {
      var i = this.getAttribute("data-target");
      jQuery(`#hiw-milestones__slider--${i}`).slick("slickPrev")
  }));
  jQuery(".hiw-milestones__touchzones").on("mousemove", (function(t) {
      var i = this.getAttribute("data-target"),
          e = t.target.classList.contains("hiw-milestones__touchzone--next"),
          s = jQuery(`.touchzone__tooltip--${i}`),
          n = e ? t.target.offsetWidth : 0,
          o = t.offsetX + n + 16,
          a = t.offsetY + 16;
      s.css("transform", "translate3d(" + o + "px, " + a + "px, 0)"), s.text(e ? "Next" : "Previous")
  }));
  jQuery(".hiw-milestones__touchzones").on("mouseenter", (function(t) {
      var i = this.getAttribute("data-target");
      jQuery(`.touchzone__tooltip--${i}`).addClass("is-visible")
  }));
  jQuery(".hiw-milestones__touchzones").on("mouseleave", (function(t) {
      var i = this.getAttribute("data-target");
      jQuery(`.touchzone__tooltip--${i}`).removeClass("is-visible")
  }));
  jQuery(".hiw-milestones__touchzone--next").on("click", (function(t) {
      var i = this.getAttribute("data-target");
      jQuery(`#hiw-milestones__slider--${i}`).slick("slickNext")
  }))
})