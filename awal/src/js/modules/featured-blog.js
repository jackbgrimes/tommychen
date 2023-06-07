export default function () {
  jQuery(".featured-blog").each(function() {
    var s = new TimelineMax;
    jQuery(this).waypoint(function() {
        s.staggerTo(jQuery(".featured-blog ul li"), .5, {
            autoAlpha: 1,
            top: 0,
            ease: Power1.easeOut
        }, .2)
    }, {
        triggerOnce: !0,
        offset: "45%"
    })
  });
}