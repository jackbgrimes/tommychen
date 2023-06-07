jQuery(function(){
  jQuery(".video-poster").on("click", function() {  
    jQuery(this).fadeOut();
    jQuery(".video-module, .spotlight-item.featured, .image-video").addClass("video-visible"), jQuery("#video")[0].src += "?rel=0&autoplay=1";
  });

  const spotlightItemLimit = jQuery(window).width() <= 767 ? 3 : 6;
  if (jQuery(".spotlight-list-lower .spotlight-item").length > spotlightItemLimit) {
    jQuery(".spotlight-list .btn-container").show();
    jQuery(".spotlight-list .show-more").on("click", function(e) {
      var t = jQuery(e.currentTarget);
      if (t.hasClass("more")) {
        t.removeClass("more"); 
        t.html("Show More");
        if (jQuery(window).width() <= 767) {
          jQuery(".spotlight-list .spotlight-list-lower .spotlight-item:nth-child(1n+3)").slideUp();
        } else {
          jQuery(".spotlight-list .spotlight-list-lower .spotlight-item:nth-child(1n+7)").slideUp();
        }
      } else {
        t.addClass("more"); 
        t.html("Show Fewer");
        if (jQuery(window).width() <= 767) { 
          jQuery(".spotlight-list .spotlight-list-lower .spotlight-item:nth-child(1n+3)").slideDown();
         } else {
          jQuery(".spotlight-list .spotlight-list-lower .spotlight-item:nth-child(1n+7)").slideDown();
         }
      }
    });
  } 
});
