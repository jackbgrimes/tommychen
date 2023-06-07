jQuery(function(){
  jQuery(".slider-image").slick({
    dots: !1,
    slidesToShow: 3.3,
    slidesToScroll: 1,
    touchThreshold: 20,
    infinite: !1,
    responsive: [{
        breakpoint: 768,
        settings: {
            slidesToShow: 1.5
        }
    }, {
        breakpoint: 450,
        settings: {
            slidesToShow: 1.1
        }
    }]
  })
})