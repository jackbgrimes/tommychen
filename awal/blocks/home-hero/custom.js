jQuery(function(){  
  var splashHero = document.querySelector('.splash-hero-v2')
  var cta = document.querySelector('.js-splash-hero-popup-cta')
  var popupClose = document.querySelector('.js-splash-hero-popup-close')
  var popup = document.querySelector('.splash-hero-v2__popup')
  var popupContent = document.querySelector('.splash-hero-v2__popup-content')

  // If supports ObjectFit, and it's not Edge (because Edge only supports it for images)
  var supportObjectFit = document.body.style.objectFit !== undefined && navigator.userAgent.indexOf('Edge') === -1

  if (!supportObjectFit && splashHero) {
    splashHero.classList.add('no-object-fit')
  }

  var video = document.querySelector('.js-splash-hero-v2-video')
  if (video) {
    var playPromise = video.play()
    
    if (playPromise !== undefined) {
        playPromise.catch(function() {
          splashHero.classList.add('active')
        })
    }
    video.addEventListener('timeupdate', function () {
      splashHero.classList.add('active')
      if (video.currentTime > 0) video.classList.remove('splash-hero-v2__video--hidden')
    })
  } else {
    setTimeout(function () {
      splashHero && splashHero.classList.add('active')
    })
  }

  popupClose && popupClose.addEventListener('click', function () {
    popup.style.display = 'none'
  })

  cta && cta.addEventListener('click', function() {
    popup.style.display = ''
    popup.style.opacity = 0
    popup.style.transition = 'none'
    
    popupContent.style.transition = 'none'
    popupContent.style.transform = 'translate3d(0, 10px, 0) scale(.96)'

    popup.offsetWidth
    
    popup.style.opacity = 1
    popup.style.transition = 'opacity 300ms ease' 
    
    popupContent.style.transform = 'none'
    popupContent.style.transition = 'transform 800ms ease'
  })
});