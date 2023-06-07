export default function() {
  var isTablet = $(window).width() <= 1024,
    isMobile = $(window).width() <= 767;
  $(".parallax-anchor").each(function() {
    $(this).find(".parallax").each(function() {
        var e = $(this);
        if (e.hasClass("fade") && e.addClass("in"), isMobile) {
            if (e.hasClass("no-mobile")) return
        } else if (isTablet && e.hasClass("no-tablet")) return;

        function t() {
            if (e.hasClass("down")) {
                var t = e.offset().top - $(window).scrollTop();
                if (t > 0) {
                    var o = .1 * -Math.abs(t) + "px";
                    e.css("top", o)
                } else {
                    var i = .1 * Math.abs(t) + "px";
                    e.css("top", i)
                }
            } else {
                var s = .1 * (e.offset().top - $(window).scrollTop()) + "px";
                e.css("top", s)
            }
        }
        t(), $(window).on("scroll", function() {
            t()
        })
    })
  });
}