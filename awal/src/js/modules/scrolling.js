export default function() {
  const toggleHeaderClass = function (offset) {
		var top = $(window).scrollTop(),
				header = $("header");
	  top >= offset ? header.addClass("scrolling") : header.removeClass("scrolling")
	}

  if ($(".hero").length || $(".splash-hero").length) {
    if ($(".hero").hasClass("x-small")) {
      $(window).on("scroll", function() {
        toggleHeaderClass(100);
        $(".hero.small .small-image-container").each(function() {
          var e = "50% " + .15 * $(window).scrollTop() + "px";
          $(this).css("backgroundPosition", e)
        })
      }) 
    } else {
      $(window).on("scroll", function() {
        toggleHeaderClass(250); 
        $(".hero.small .small-image-container").each(function() {
            var e = "50% " + .15 * $(window).scrollTop() + "px";
            $(this).css("backgroundPosition", e)
        })
	    }) 
    } 
  } else {
    $(".blog-landing, .blog-post").length ? $("header").addClass("white") : $("header").addClass("scrolling");
  }
	
}
