(function() {
  if (
    // No Reflect, no classes, no need for shim because native custom elements
    // require ES2015 classes or Reflect.
    window.Reflect === undefined ||
    window.customElements === undefined ||
    // The webcomponentsjs custom elements polyfill doesn't require
    // ES2015-compatible construction (`super()` or `Reflect.construct`).
    window.customElements.polyfillWrapFlushCallback
  ) {
    return;
  }
  const BuiltInHTMLElement = HTMLElement;
  /**
   * With jscompiler's RECOMMENDED_FLAGS the function name will be optimized away.
   * However, if we declare the function as a property on an object literal, and
   * use quotes for the property name, then closure will leave that much intact,
   * which is enough for the JS VM to correctly set Function.prototype.name.
   */
  const wrapperForTheName = {
    'HTMLElement': /** @this {!Object} */ function HTMLElement() {
      return Reflect.construct(
          BuiltInHTMLElement, [], /** @type {!Function} */ (this.constructor));
    }
  };
  window.HTMLElement = wrapperForTheName['HTMLElement'];
  HTMLElement.prototype = BuiltInHTMLElement.prototype;
  HTMLElement.prototype.constructor = HTMLElement;
  Object.setPrototypeOf(HTMLElement, BuiltInHTMLElement);
})();

function _inherits(subClass, superClass) { 
  if (typeof superClass !== "function" && superClass !== null) { 
    throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); 
  } 
  subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); 
  if (superClass) 
    Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; 
}
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

jQuery(function(){

  customElements.define('background-component', function (_HTMLElement) {
    _inherits(_class, _HTMLElement);
  
    function _class() {
      _classCallCheck(this, _class);
  
      return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
    }
  
    _createClass(_class, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.backgroundColor = 0x000000;
        this.setSizes();
        this.uTime = {
          value: 0
        };
  
        this.animate = this.animate.bind(this);
        this._isAnimating = false;
  
        this.fragmentShaderContentDark = 'varying vec2 vUv;\n        uniform float numStripes;\n        uniform vec2 resolution;\n        uniform float t;\n        \n        float rand(vec2 co){\n          return fract(sin(dot(co.xy,vec2(2.9898,78.233))) * 43758.5453);\n        }\n\n        void main(){\n\n          float r = rand(vUv * sin(t * 1.1));\n          float g = rand(vUv * cos(t * 1.1)); \n          float b = rand(vUv * tan(t * 1.1));\n          \n          gl_FragColor = vec4(vec3(b),.5);\n        }';
  
        this.vectorShaderContent = 'varying vec2 vUv;\n      uniform float t;\n      uniform vec2 resolution;\n\n      const float Pi = 3.1415926;\n      const float TwoPi = Pi * 3.8;\n\n      void main() {\n        vUv = uv;\n        vec3 pos = position;\n        gl_Position = projectionMatrix * modelViewMatrix * vec4( pos, 1.0 );\n      }';
  
        this.createScene();
        this.createTexture();
        this.createShaderMaterial();
        this.createMesh();
        this.dataset.size = 'fullscreen';
        this.resize();
        this.animate();
        this._resize = this.resize.bind(this);
        window.addEventListener('resize', this._resize);
        this.style.position = this.dataset.position;
        this.resume();
  
        this.renderer.domElement.style.opacity = 0;
        this.renderer.domElement.offsetWidth; // triggers layout step in browser to be able to transition afterwards
        this.renderer.domElement.style.transition = 'opacity 1000ms ease';
        this.renderer.domElement.style.opacity = 1;
      }
    }, {
      key: 'setSizes',
      value: function setSizes() {
        this.textureWidth = 1.0;
        this.textureHeight = 1.0;
        this.innerWidth = window.innerWidth;
        this.innerHeight = window.innerHeight;
        this.cameraZoom = 1;
        this.timing = 0.01;
  
        this.squareSecuence = 14;
      }
    }, {
      key: 'resize',
      value: function resize() {
        this.setSizes();
        this.camera.aspect = this.innerWidth / this.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(this.innerWidth, this.innerHeight);
      }
    }, {
      key: 'createScene',
      value: function createScene() {
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(this.cameraZoom, this.innerWidth / this.innerHeight, 0.1, 600);
        this.camera.position.set(0, 0, 10);
        this.renderer = new THREE.WebGLRenderer({ antialias: true, devicePixelRatio: 1 });
        this.renderer.setSize(this.innerWidth, this.innerHeight);
        this.renderer.setClearColor(this.backgroundColor);
        this.appendChild(this.renderer.domElement);
      }
    }, {
      key: 'createTexture',
      value: function createTexture() {
        this.texture = new THREE.TextureLoader().load('');
        this.texture.wrapS = THREE.RepeatWrapping;
        this.texture.wrapT = THREE.RepeatWrapping;
        this.texture.repeat.set(this.textureWidth, this.textureHeight);
        this.geometry = new THREE.PlaneGeometry(this.textureWidth, this.textureHeight, this.textureWidth, this.textureHeight);
      }
    }, {
      key: 'createShaderMaterial',
      value: function createShaderMaterial() {
        this.shaderMat = new THREE.ShaderMaterial({
          transparent: false,
          depthTest: true,
          vertexShader: this.vectorShaderContent,
          fragmentShader: this.fragmentShaderContentDark,
          uniforms: {
            resolution: { value: this.texture.repeat },
            t: { value: 0.1 },
            numStripes: { value: this.textureHeight * this.squareSecuence }
          }
        });
      }
    }, {
      key: 'createMesh',
      value: function createMesh() {
        this.mesh = new THREE.Mesh(this.geometry, this.shaderMat);
        this.scene.add(this.mesh);
      }
    }, {
      key: 'animate',
      value: function animate() {
        if (this._isAnimating) requestAnimationFrame(this.animate);
        this.uTime.value++;
        this.shaderMat.uniforms.t.value += this.timing;
        this.renderer.render(this.scene, this.camera);
      }
    }, {
      key: 'resume',
      value: function resume() {
        if (this._isAnimating) return;
        this._isAnimating = true;
        this.animate();
      }
    }]);
  
    return _class;
  }(HTMLElement));
  
  var AnimationFrameService = function () {
    var controller = {};
    controller.isAnimating = true;
    controller.animationFrameEvent = new CustomEvent('animationFrameService');
  
    controller.animate = function () {
      if (controller.isAnimating) requestAnimationFrame(controller.animate);
      window.dispatchEvent(controller.animationFrameEvent);
    };
  
    controller.animate();
  
    return controller;
  }();
  'use strict';
  
  var ExampleService = function () {
    var controller = {};
  
    controller.doSomething = function () {
      console.log('Something was done.');
    };
  
    return controller;
  }();
  'use strict';
  
    
    
  var ImageAnimationElement = function () {
    function ImageAnimationElement(canvas, src) {
      _classCallCheck(this, ImageAnimationElement);
  
      this.canvas = canvas;
      this.src = src.frontImage;
      // Resizing
      this.anchorPositionElement = src.imagePosition.anchor;
      this.anchorProportion = src.imagePosition.proportion;
      this.positionY = this.anchorPositionElement.offsetTop * this.anchorProportion;
      this.images = new Array([src.imagePosition.x]);
      this.initialPosResize = { x: src.imagePosition.x, y: this.positionY };
      this.initialPos = { x: src.imagePosition.x, y: this.positionY };
      this.startPos = { x: src.imagePosition.x, y: this.positionY };
      this.initialImageSize = { w: src.imageSize.w, h: src.imageSize.h, proportion: src.imageSize.h / src.imageSize.w };
      this.imageSize = { w: src.imageSize.w, h: src.imageSize.h };
      this.lastY = 0;
      this.maxWindowSize = 1440;
      this.sliderImages = src.sliderImages;
      this.loadedImages = [];
      this.sliderImagesLoaded = false;
      this.currentSlide = 0;
      this.firstLoad = true;
      this.minWindowSize = 600;
      this.maxWindowSize = 1440;
      this.diffRange = this.maxWindowSize - this.minWindowSize;
      this.mainImageLoaded = false;
  
      this.sliderTick = 0;
      this.eraiserTick = 0;
      this.onView = false;
      this.loadMainImage();
      this.loadIconImage();
      this.resize = this.resize.bind(this);
      this.animate = this.animate.bind(this);
    }
  
    _createClass(ImageAnimationElement, [{
      key: 'lerp',
      value: function lerp(minSize, maxSize) {
        var diffSize = maxSize - minSize;
        return Math.round(minSize + diffSize * ((window.innerWidth - this.minWindowSize) / this.diffRange));
      }
    }, {
      key: 'isHovering',
      value: function isHovering(x, y) {
        return this.startPos.x <= x && x <= this.startPos.x + this.imageSize.w && this.startPos.y <= y && y <= this.startPos.y + this.imageSize.h;
      }
    }, {
      key: 'loadMainImage',
      value: function loadMainImage() {
        var _this = this;
  
        this.img = new Image();
        this.img.src = this.src;
        this.img.onload = function () {
          _this.mainImageLoaded = true;
          _this.loadedImages.push(_this.img);
        };
      }
    }, {
      key: 'loadIconImage',
      value: function loadIconImage() {
        this.rewindIcon = new Image();
        this.rewindIcon.src = 'https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/rewindIcon.png';
        this.rewindIcon.onload = function () {};
      }
    }, {
      key: 'loadSliderImages',
      value: function loadSliderImages() {
        var _this2 = this;
  
        this.sliderImages.forEach(function (imageSrc) {
          var loadedImage = new Image();
          loadedImage.src = imageSrc;
          loadedImage.onload = function () {
            _this2.loadedImages.push(loadedImage);
          };
        });
      }
    }, {
      key: 'resize',
      value: function resize() {
        if (window.innerWidth <= this.maxWindowSize) {
          var newImageWidth = this.initialImageSize.w * window.innerWidth / this.maxWindowSize;
          this.imageSize = { w: newImageWidth, h: newImageWidth * this.initialImageSize.proportion };
        }
        this.positionY = this.anchorPositionElement.offsetTop * this.anchorProportion;
        this.initialPos.y = this.positionY;
  
        var newXPosition = this.initialPosResize.x * window.innerWidth / this.maxWindowSize + document.querySelector('.hiw-module-section--wrapper').offsetLeft / 2;
        this.startPos.x = newXPosition;
      }
    }, {
      key: 'imageOnViewDetector',
      value: function imageOnViewDetector() {
        var onView = this.initialPos.y < window.pageYOffset + window.innerHeight && this.initialPos.y + this.imageSize.h > window.pageYOffset;
        if (onView !== this.onView) {
          this.onView = onView;
        }
      }
    }, {
      key: 'detectMouseHover',
      value: function detectMouseHover(x, y) {
        this.activateSlider = this.isHovering(x, y);
        if (this.activateSlider) {
          this.sliderTick += 1;
          this.sliderTick = this.sliderTick >= 30 ? 0 : this.sliderTick;
          if (this.sliderTick == 0) {
            this.currentSlide = this.currentSlide == this.loadedImages.length - 1 ? 0 : this.currentSlide + 1;
          }
        } else {
  
          if (this.currentSlide > 0) {
            this.sliderTick += 1;
            this.sliderTick = this.sliderTick >= 20 ? 0 : this.sliderTick;
            if (this.sliderTick == 0) {
              this.currentSlide -= 1;
            }
          }
        }
      }
    }, {
      key: 'eraiseImages',
      value: function eraiseImages() {
        if (this.images.length > 1) {
          this.eraiserTick += 0.01;
          this.eraiserTick = this.eraiserTick >= 0.012 ? 0 : this.eraiserTick;
          if (this.eraiserTick === 0) {
            this.images.shift();
          }
        }
      }
    }, {
      key: 'paintImages',
      value: function paintImages() {
        if (this.lastY !== this.startPos.y) {
          if (this.images.length <= 1) {
            this.images.push(this.startPos.y);
            // console.log(this.startPos.y.toFixed(2))
          }
        }
  
        // this.images.forEach((image, index) => {
        //   this.canvas.drawImage(this.loadedImages[this.currentSlide], this.startPos.x, image, (this.imageSize.w), (this.imageSize.h))
        //   // this.canvas.drawImage(this.loadedImages[this.currentSlide], this.startPos.x, image, (this.imageSize.w), (this.imageSize.h))
        // })
        this.canvas.drawImage(this.loadedImages[this.currentSlide], this.startPos.x, this.startPos.y, this.imageSize.w, this.imageSize.h);
      }
    }, {
      key: 'animate',
      value: function animate(y) {
        if (this.mainImageLoaded && this.onView && !this.sliderImagesLoaded) {
          this.sliderImagesLoaded = true;
          this.loadSliderImages();
        }
        if (this.loadedImages.length > 0) {
          if (this.firstLoad) {
            this.startPos.y = y + this.initialPos.y;
            this.firstLoad = false;
          } else {
            // this.startPos.y = y + this.initialPos.y
            this.startPos.y += (y + this.initialPos.y - this.startPos.y) * 0.35;
          }
          this.paintImages();
          this.lastY = this.startPos.y;
          this.eraiseImages();
          if (this.activateSlider) {
            this.canvas.drawImage(this.rewindIcon, this.startPos.x + (this.imageSize.w - 60), this.startPos.y + (this.imageSize.h - 50), 74 / 2, 52 / 2);
          }
        }
      }
    }]);
  
    return ImageAnimationElement;
  }();
  'use strict';
  
  // Mobile Detector event
  
  var state = { isMobile: false };
  
  var mobileDetectorService = new CustomEvent('mobileDetectorService', {
      detail: {
          isMobile: state.isMobile
      }
  });
  
  var checkMobile = function checkMobile() {
      var check = false;
      (function (a) {
          if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
      })(navigator.userAgent || navigator.vendor || window.opera);
      return check;
  };
  
  window.addEventListener('load', function () {
      isMobile = checkMobile();
      window.dispatchEvent(mobileDetectorService);
  });
  'use strict';
  
  var ResizeService = function () {
    var controller = {};
    controller.windowResize = new CustomEvent('windowResize', {
      detail: {
        state: state
      }
    });
  
    window.addEventListener('resize', function () {
      controller.resize();
      window.dispatchEvent(controller.windowResize);
    });
  
    controller.resize = function () {
      controller.windowWidth = window.innerWidth;
      controller.windowHeight = 'innerHeight' in window ? window.innerHeight : document.documentElement.offsetHeight;
      controller.isMobile = window.innerWidth < 800 ? true : false;
      controller.containerSize = document.querySelector('#intro-and-graph-module').offsetHeight;
  //     controller.blobSectionSize = document.querySelector('.hiw-background-blob-wrapper').offsetHeight;
    };
  
    controller.resize();
  
    return controller;
  }();
  'use strict';
  
  // Scroll Service event
  //---------------------------//
  
  var scrollServiceState = {
    scroll: 0,
    scrollDirection: 'down'
  };
  
  window.addEventListener('scroll', function () {
    if (window.pageYOffset > scrollServiceState.scroll) {
      scrollServiceState.scrollDirection = 'down';
    } else {
      scrollServiceState.scrollDirection = 'up';
    }
    scrollServiceState.scroll = window.pageYOffset;
  
    var scrollServiceEvent = new CustomEvent('scrollService', {
      detail: {
        state: scrollServiceState
      }
    });
  
    window.dispatchEvent(scrollServiceEvent);
  });
  
  // Section Detector Event
  //---------------------------//
  
  var sectionDetectorState = {
    scrollSectionIndex: 0,
    sectionsMap: [],
    currentSection: {
      index: 0,
      sectionYTop: 0
    },
    sectionChanged: false
  };
  
  function mapSections() {
    var allSections = [].slice.call(document.querySelectorAll('.hiw-module-section'));
    allSections.forEach(function (section, index) {
      var sectionYTop = section.getBoundingClientRect().top + window.pageYOffset;
      var sectionHeight = section.getBoundingClientRect().height;
      sectionDetectorState.sectionsMap[index] = {
        index: index + 1,
        sectionYTop: sectionYTop,
        sectionHeight: sectionHeight
      };
    });
  }
  
  function detectSectionChange() {
    sectionDetectorState.sectionsMap.filter(function (section, index) {
      var bigger = section.sectionYTop < scrollServiceState.scroll + window.innerHeight / 2;
      if (bigger) {
        sectionDetectorState.currentSection = section;
      }
    });
  }
  
  window.addEventListener('scroll', function () {
    mapSections();
    detectSectionChange();
  
    if (sectionDetectorState.currentSection.index !== sectionDetectorState.scrollSectionIndex) {
      sectionDetectorState.sectionChanged = true;
  
      var sectionChangeDetectorEvent = new CustomEvent('sectionChangeDetector', {
        detail: {
          state: sectionDetectorState
        }
      });
  
      window.dispatchEvent(sectionChangeDetectorEvent);
    } else {
      sectionDetectorState.sectionChanged = false;
    }
    sectionDetectorState.scrollSectionIndex = sectionDetectorState.currentSection.index;
  });
  'use strict';
  
    
    
    
  
  var BlockQuoteComponent = function (_HTMLElement) {
    _inherits(BlockQuoteComponent, _HTMLElement);
  
    function BlockQuoteComponent() {
      _classCallCheck(this, BlockQuoteComponent);
  
      return _possibleConstructorReturn(this, (BlockQuoteComponent.__proto__ || Object.getPrototypeOf(BlockQuoteComponent)).apply(this, arguments));
    }
  
    _createClass(BlockQuoteComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.innerHTML = '' + this.innerHTML;
      }
    }]);
  
    return BlockQuoteComponent;
  }(HTMLElement);
  
  customElements.define('block-quote-component', BlockQuoteComponent);
  'use strict';
  
    
    
    
  
  var DefaultButton = function (_HTMLElement) {
    _inherits(DefaultButton, _HTMLElement);
  
    function DefaultButton() {
      _classCallCheck(this, DefaultButton);
  
      return _possibleConstructorReturn(this, (DefaultButton.__proto__ || Object.getPrototypeOf(DefaultButton)).apply(this, arguments));
    }
  
    _createClass(DefaultButton, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.innerHTML = '\n      <button>\n        ' + (this.dataset.icon === 'cross' ? '\n          <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n              <g transform="translate(-114.000000, -10.000000)" fill-rule="nonzero">\n                <g transform="translate(21.000000, 0.000000)">\n                    <g transform="translate(83.250000, 0.000000)">\n                        <g transform="translate(10.000000, 10.000000)">\n                            <g>\n                                <polygon points="6.25 0 6.25 13.75 7.5 13.75 7.5 0"></polygon>\n                                <polygon transform="translate(6.875000, 6.875000) rotate(-270.000000) translate(-6.875000, -6.875000) " points="6.25 0 6.25 13.75 7.5 13.75 7.5 0"></polygon>\n                            </g>\n                        </g>\n                    </g>\n                </g>\n              </g>\n            </g>\n          </svg>\n        ' : this.dataset.icon === 'arrow-down' ? '\n          <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n              <g transform="translate(-114.000000, -10.000000)" fill-rule="nonzero">\n                <g transform="translate(21.000000, 0.000000)">\n                    <g transform="translate(83.250000, 0.000000)">\n                        <g transform="translate(10.000000, 10.000000)">\n                            <g>\n                                <polygon points="6.25 0 6.25 13.75 7.5 13.75 7.5 0"></polygon>\n                                <polygon transform="translate(6.875000, 6.875000) rotate(-270.000000) translate(-6.875000, -6.875000) " points="6.25 0 6.25 13.75 7.5 13.75 7.5 0"></polygon>\n                            </g>\n                        </g>\n                    </g>\n                </g>\n              </g>\n            </g>\n          </svg>\n        ' : '\n          <svg width="10px" height="10px" viewBox="0 0 10 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n              <g transform="translate(-95.000000, -8.000000)" fill-rule="nonzero">\n                <g transform="translate(17.000000, 0.000000)">\n                  <g transform="translate(69.000000, 0.000000)">\n                    <g transform="translate(9.000000, 8.000000)">\n                      <polygon points="9 0 9 7 10 7 10 0"></polygon>\n                      <polygon transform="translate(6.500000, 0.500000) rotate(-270.000000) translate(-6.500000, -0.500000) " points="6 -3 6 4 7 4 7 -3"></polygon>\n                      <polygon points="9.19238816 7.10542736e-15 0 9.19238816 0.707106781 9.89949494 9.89949494 0.707106781"></polygon>\n                    </g>\n                  </g>\n                </g>\n              </g>\n            </g>\n          </svg>\n\n        ') + '\n      ' + (this.dataset.url ? '\n        <a href="' + this.dataset.url + '" target="_blank">\n          ' + this.innerText + '\n        </a>\n      ' : '' + this.innerText) + '\n      </button>\n   ';
      }
    }]);
  
    return DefaultButton;
  }(HTMLElement);
  
  customElements.define('default-button', DefaultButton);
  'use strict';
  
    
    
    
  
  var DefaultTextComponent = function (_HTMLElement) {
    _inherits(DefaultTextComponent, _HTMLElement);
  
    function DefaultTextComponent() {
      _classCallCheck(this, DefaultTextComponent);
  
      return _possibleConstructorReturn(this, (DefaultTextComponent.__proto__ || Object.getPrototypeOf(DefaultTextComponent)).apply(this, arguments));
    }
  
    _createClass(DefaultTextComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.toggleOverlayzIndex = this.toggleOverlayzIndex.bind(this);
        this.overlayComponent = this.querySelector('overlay-component');
        this.overlayToggleButton = this.querySelector('default-button');
        
        this.closeOverlayZone = this.querySelector('.overlay-component-closezone')
  
        this.classList.add('overlay-component-parent');
  
        if (this.overlayToggleButton) {
          this.overlayToggleButton.addEventListener('click', this.toggleOverlayzIndex);
        }
        
        if (this.closeOverlayZone) {
          this.closeOverlayZone.addEventListener('click', this.closeOverlayzIndex);
        }
      }
    }, {
      key: 'toggleOverlayzIndex',
      value: function toggleOverlayzIndex() {
        if (this.overlayComponent) {
          this.overlayComponent.toggleOverlayInOut();
        }
      }
    }, {
      key: 'closeOverlayzIndex',
      value: function closeOverlayzIndex() {
        var thisOverlayComponent = this.parentElement.querySelector('overlay-component')
        if (thisOverlayComponent) {
          thisOverlayComponent.toggleOverlayInOut();
        }
      }
    }]);
  
    return DefaultTextComponent;
  }(HTMLElement);
  
  customElements.define('default-text-component', DefaultTextComponent);
  'use strict';
  
    
    
    
  
  !function () {
    var moveSpeed = 2;
    var moveSize = 1.2;
  
    function handleResize() {
      moveSpeed = Math.min(2, 2 * window.innerWidth / 1200);
      moveSize = Math.min(1.2, 1.2 * window.innerWidth / 1200);
    }
  
    window.addEventListener('resize', handleResize);
    handleResize();
  
    function DynamicGradientComponentColor(el) {
      this.el = el;
      this.pos = {
        x: 0,
        y: 0
      };
      this.opacity = 1;
      this.goOpacity = 1;
    }
    DynamicGradientComponentColor.prototype.update = function () {
      this.el.style.transform = ('\n      translate3d(calc(-50% + ' + this.pos.x + 'px), calc(-50% + ' + this.pos.y + 'px),0)\n    ').trim();
      this.opacity += (this.goOpacity - this.opacity) * .2;
      this.el.style.opacity = this.opacity;
    };
  
    var DynamicGradientComponent = function (_HTMLElement) {
      _inherits(DynamicGradientComponent, _HTMLElement);
  
      function DynamicGradientComponent() {
        _classCallCheck(this, DynamicGradientComponent);
  
        return _possibleConstructorReturn(this, (DynamicGradientComponent.__proto__ || Object.getPrototypeOf(DynamicGradientComponent)).apply(this, arguments));
      }
  
      _createClass(DynamicGradientComponent, [{
        key: 'connectedCallback',
        value: function connectedCallback() {
          this.render();
  
          this.update = this.update.bind(this);
  
          this.colors = [].slice.call(this.querySelectorAll('.dynamic-gradient-component--color')).map(function (el) {
            return new DynamicGradientComponentColor(el);
          });
  
          this.update();
        }
      }, {
        key: 'update',
        value: function update() {
          var _this2 = this;
  
          requestAnimationFrame(this.update);
  
          this.colors.forEach(function (color, i) {
  
            color.pos.x = Math.sin(Date.now() / 1200 * moveSpeed + i * 10) * 100 * moveSize;
            color.pos.y = Math.sin(Date.now() / 1400 * moveSpeed + i * 10) * 120 * moveSize;
  
            if (parseInt(_this2.dataset.activeColor) != i) {
              color.goOpacity = .4;
            } else {
              color.goOpacity = 1;
            }
  
            if (_this2.dataset.activeColor === 'none') {
              color.goOpacity = 1;
            }
  
            color.update();
          });
        }
      }, {
        key: 'render',
        value: function render() {
          this.innerHTML = '\n        <div class="dynamic-gradient-component--wrapper">  \n          <div class="dynamic-gradient-component--colors">\n            <div class="dynamic-gradient-component--color"></div>\n            <div class="dynamic-gradient-component--color"></div>\n            <div class="dynamic-gradient-component--color"></div>\n          </div>\n        </div>\n      ';
        }
      }]);
  
      return DynamicGradientComponent;
    }(HTMLElement);
  
    customElements.define('dynamic-gradient-component', DynamicGradientComponent);
  }();
  'use strict';
  
    
    
    
  
  var FocusSubmitButton = function (_HTMLElement) {
    _inherits(FocusSubmitButton, _HTMLElement);
  
    function FocusSubmitButton() {
      _classCallCheck(this, FocusSubmitButton);
  
      return _possibleConstructorReturn(this, (FocusSubmitButton.__proto__ || Object.getPrototypeOf(FocusSubmitButton)).apply(this, arguments));
    }
  
    _createClass(FocusSubmitButton, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.innerHTML = '\n        <div class="focus-submit-button__wrapper">    \n          ' + this.innerHTML + '\n          <a\n            class="focus-submit-button__cta"\n            href="https://www.awal.com/apply-now?hsCtaTracking=67eda24d-55f8-43eb-9482-32616f562e25%7C654e5ee8-0bb5-430e-a7da-99c0160e5b46">\n            Submit your music\n            <span class="focus-submit-button__icon-arrow"></span>\n          </a>\n        </div>\n     ';
      }
    }]);
  
    return FocusSubmitButton;
  }(HTMLElement);
  
  customElements.define('focus-submit-button', FocusSubmitButton);
  'use strict';
  
    
    
    
  
  customElements.define('image-animation-component', function (_HTMLElement) {
    _inherits(_class, _HTMLElement);
  
    function _class() {
      _classCallCheck(this, _class);
  
      return _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).apply(this, arguments));
    }
  
    _createClass(_class, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        var _this2 = this;
  
        this.render();
        this.animate = this.animate.bind(this);
        this.resize = this.resize.bind(this);
        this.scroll = this.scroll.bind(this);
        this._isAnimating = false;
        this.deletTick = 0;
        this.eraiseRatio = 1;
  
        this.imageElements = [];
        this.mouseX = 0;
        this.mouseY = 0;
  
        // Anchor Positions for Images to look proportional in Y
        this.anchorTopSection = document.querySelector('.hiw-module-section--wrapper');
        this.anchorBlobSection = document.querySelector('.hiw-background-blob-wrapper');
  
        this.imageData = [
        // Top Section
        {
          "imageSize": {
            "w": 320,
            "h": 480
          },
          "imagePosition": {
            "x": 50,
            "proportion": 3.5,
            "anchor": this.anchorTopSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_01.png",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_03.png", "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_04.png"]
        }, {
          "imageSize": {
            "w": 480,
            "h": 320
          },
          "imagePosition": {
            "x": 600,
            "proportion": 4.5,
            "anchor": this.anchorTopSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/little-simz-2%20480x320.jpg",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/LondonInStereo_C_cover_Little-Simz_cMathewParriThomas%20480x320.jpg", "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/little-simz-2%20480x320.jpg"]
        },
        // BLOB SECTION
        {
          "imageSize": {
            "w": 320,
            "h": 480
          },
          "imagePosition": {
            "x": 800,
            "proportion": 1.06,
            "anchor": this.anchorBlobSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_01.png",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_03.png", "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_04.png"]
        }, {
          "imageSize": {
            "w": 480,
            "h": 320
          },
          "imagePosition": {
            "x": 300,
            "proportion": 1.46,
            "anchor": this.anchorBlobSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/little-simz-2%20480x320.jpg",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/LondonInStereo_C_cover_Little-Simz_cMathewParriThomas%20480x320.jpg"]
        }, {
          "imageSize": {
            "w": 480,
            "h": 320
          },
          "imagePosition": {
            "x": 800,
            "proportion": 1.76,
            "anchor": this.anchorBlobSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/little-simz-2%20480x320.jpg",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/LondonInStereo_C_cover_Little-Simz_cMathewParriThomas%20480x320.jpg"]
        }, {
          "imageSize": {
            "w": 480,
            "h": 320
          },
          "imagePosition": {
            "x": -100,
            "proportion": 1.9,
            "anchor": this.anchorBlobSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/little-simz-2%20480x320.jpg",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/LondonInStereo_C_cover_Little-Simz_cMathewParriThomas%20480x320.jpg"]
        }, {
          "imageSize": {
            "w": 320,
            "h": 480
          },
          "imagePosition": {
            "x": 850,
            "proportion": 2.18,
            "anchor": this.anchorBlobSection
          },
          "imageMobilePosition": {
            "x": 600,
            "y": 700
          },
          "frontImage": "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_01.png",
          "sliderImages": ["https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_03.png", "https://cdn2.hubspot.net/hubfs/4045246/How%20It%20Works%20Redesigned/Gus_Dapperton_04.png"]
        }];
  
        this.createCanvas();
        this.createImages();
        this.resume();
        this.scroll();
        this.resize();
        window.addEventListener('scrollService', this.scroll);
        window.addEventListener('resize', this.resize);
  
        window.addEventListener('mousemove', function (e) {
          _this2.mouseX = e.clientX;
          _this2.mouseY = e.clientY;
        });
      }
    }, {
      key: 'resize',
      value: function resize() {
        var _this3 = this;
  
        this.canvas.width = '' + window.innerWidth;
        this.canvas.height = '' + window.innerHeight;
        this.imageData.forEach(function (src, index) {
          _this3.imageElements[index].resize();
        });
      }
    }, {
      key: 'createCanvas',
      value: function createCanvas() {
        this.canvas = this.querySelector('canvas');
        this.ctx = this.canvas.getContext('2d');
      }
    }, {
      key: 'scroll',
      value: function scroll() {
        var _this4 = this;
  
        this.imageData.forEach(function (src, index) {
          _this4.imageElements[index].imageOnViewDetector();
        });
      }
    }, {
      key: 'createImages',
      value: function createImages() {
        var _this5 = this;
  
        this.imageData.forEach(function (src, index) {
          _this5.imageElements.push(new ImageAnimationElement(_this5.ctx, src));
        });
      }
    }, {
      key: 'render',
      value: function render() {
        this.innerHTML = this.template;
      }
    }, {
      key: 'animate',
      value: function animate() {
        var _this6 = this;
  
        if (this._isAnimating) requestAnimationFrame(this.animate);
        this.ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
        this.imageData.forEach(function (src, index) {
          _this6.imageElements[index].animate(-window.pageYOffset);
          _this6.imageElements[index].detectMouseHover(_this6.mouseX, _this6.mouseY);
        });
      }
    }, {
      key: 'resume',
      value: function resume() {
        if (this._isAnimating) return;
        this._isAnimating = true;
        this.animate();
      }
    }, {
      key: 'template',
      get: function get() {
        return '\n      <canvas></canvas>\n    ';
      }
    }]);
  
    return _class;
  }(HTMLElement));
  'use strict';
  
    
    
    
  
  var ImageParallaxComponent = function (_HTMLElement) {
    _inherits(ImageParallaxComponent, _HTMLElement);
  
    function ImageParallaxComponent() {
      _classCallCheck(this, ImageParallaxComponent);
  
      return _possibleConstructorReturn(this, (ImageParallaxComponent.__proto__ || Object.getPrototypeOf(ImageParallaxComponent)).apply(this, arguments));
    }
  
    _createClass(ImageParallaxComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.innerHTML = '' + this.innerHTML;
        this.animate = this.animate.bind(this);
        this.detectIsInView = this.detectIsInView.bind(this);
        this.startSlider = this.startSlider.bind(this);
        this.finishSlider = this.finishSlider.bind(this);
        this.updateAnimationSpecs = this.updateAnimationSpecs.bind(this);
        this.toggleOverlayzIndex = this.toggleOverlayzIndex.bind(this);
  
        this.frontImage = this.querySelector('.image-parallax--frontImage');
        this.sliderImages = [].slice.call(this.querySelectorAll('.image-parallax--sliderImage'));
        this.slider = this.querySelector('.image-parallax--slider');
        this.overlayComponent = this.querySelector('overlay-component');
        this.imageContainer = this.closest('.hiw-module-parallax-container');
        this.overlayToggleButton = this.querySelector('default-button');
        this.imageWrapper = this.querySelector('.image-parallax--wrapper');
  
        // Img Positioning
        this.containerBounds = {};
        this.containerCenterYPos = 0;
        this.offset = 0;
  
        this.hoverSpeed = 50;
        this.idleSpeed = 80 * 2;
        this.isSliderHovered = false;
  
        // Slider Specs
        this.mainImageLoaded = false;
        this.sliderImagesLoaded = false;
        this.isInView = false;
        this.allImages = [].slice.call(this.querySelectorAll('.image-parallax--element'));
        this.sliderTick = 0;
        this.currentSlideNum = 0;
        this.currentSlide = null;
  
        this.newSlide = 0;
        this.random = this.dataset.moveSpeed ? parseInt(this.dataset.moveSpeed) : this.getRandomArbitrary(.08, .01);
        this.extraImages = [];
  
        window.addEventListener('animationFrameService', this.animate);
        window.addEventListener('scrollService', this.detectIsInView);
  
        window.addEventListener('load', this.updateAnimationSpecs);
        window.addEventListener('scrollService', this.updateAnimationSpecs);
        window.addEventListener('resize', this.updateAnimationSpecs);
  
        this.slider.addEventListener('mouseenter', this.startSlider);
        this.slider.addEventListener('mouseleave', this.finishSlider);
        if (this.overlayComponent) {
          this.overlayToggleButton.addEventListener('click', this.toggleOverlayzIndex);
        }
  
        this.loadMainImage();
        this.detectIsInView();
        this.setSliderSlide(0);
      }
    }, {
      key: 'toggleOverlayzIndex',
      value: function toggleOverlayzIndex() {
        if (this.overlayComponent) {
          this.overlayComponent.toggleOverlayInOut();
        }
      }
    }, {
      key: 'getRandomArbitrary',
      value: function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
      }
    }, {
      key: 'startSlider',
      value: function startSlider() {
        if (!this.isSliderHovered) {
          this.isSliderHovered = true;
          this.sliderTick = 0;
          this.updateSliderSlide(1);
        }
      }
    }, {
      key: 'finishSlider',
      value: function finishSlider() {
        if (this.isSliderHovered) {
          this.isSliderHovered = false;
        }
      }
    }, {
      key: 'loadMainImage',
      value: function loadMainImage() {
        var _this2 = this;
  
        this.img = new Image();
        this.img.src = this.frontImage.getAttribute('data-image');
  
        this.img.onload = function () {
          _this2.frontImage.style.backgroundImage = 'url(' + _this2.img.src + ')';
          _this2.mainImageLoaded = true;
          _this2.frontImage.style.zIndex = _this2.sliderImages.length + 1;
          _this2.detectIsInView();
        };
      }
    }, {
      key: 'loadSliderImages',
      value: function loadSliderImages() {
        var _this3 = this;
  
        this.sliderImages.forEach(function (imageSrc, index) {
          var loadedImage = new Image();
          loadedImage.src = imageSrc.getAttribute('data-image');
          loadedImage.onload = function () {
            imageSrc.style.zIndex = _this3.sliderImages.length - index;
            imageSrc.style.backgroundImage = 'url(' + loadedImage.src + ')';
          };
        });
      }
    }, {
      key: 'detectIsInView',
      value: function detectIsInView() {
        var bounds = this.imageWrapper.getBoundingClientRect();
        if (bounds.bottom > 0 && bounds.top < window.innerHeight) {
          if (this.mainImageLoaded) this.style.opacity = 1;
          if (!this.isInView) {
            this.sliderTick = Math.random() * this.idleSpeed;
            this.isInView = true;
          }
        } else {
          this.isInView = false;
          this.style.opacity = 0;
        }
      }
    }, {
      key: 'updateAnimationSpecs',
      value: function updateAnimationSpecs() {
        this.containerBounds = this.imageContainer.getBoundingClientRect();
        this.containerCenterYPos = this.containerBounds.top + this.containerBounds.height / 2 - ResizeService.windowHeight / 2;
      }
    }, {
      key: 'animateSlider',
      value: function animateSlider() {
        this.sliderTick += 1;
  
        if (this.isSliderHovered) {
          if (this.sliderTick > this.hoverSpeed) {
            this.sliderTick = 0;
            this.updateSliderSlide(1);
          }
        } else {
          if (this.sliderTick > this.idleSpeed) {
            this.sliderTick = 0;
            this.updateSliderSlide(1);
          }
        }
      }
    }, {
      key: 'updateSliderSlide',
      value: function updateSliderSlide(direction) {
        this.currentSlideNum += direction;
  
        if (this.currentSlideNum > this.allImages.length - 1) this.currentSlideNum = 0;
        if (this.currentSlideNum < 0) this.currentSlideNum = this.allImages.length - 1;
  
        this.setSliderSlide(this.currentSlideNum);
      }
    }, {
      key: 'setSliderSlide',
      value: function setSliderSlide(num) {
        var nextSlide = this.allImages[num];
  
        if (this.currentSlide) this.currentSlide.style.opacity = 0;
        nextSlide.style.opacity = 1;
  
        this.currentSlide = nextSlide;
      }
  
      // Runs once per frame (60 x a second)
  
    }, {
      key: 'animate',
      value: function animate() {
        if (this.isInView && this.mainImageLoaded && !this.sliderImagesLoaded) {
          this.sliderImagesLoaded = true;
          this.loadSliderImages();
        }
  
        var goToOffset = this.containerCenterYPos * this.random;
        this.offset += (goToOffset - this.offset) * .04;
  
        if (this.offset < 100 || this.offset > -100) {
          var roundedOffset = Math.round(this.offset);
          this.style.transform = 'translateY(' + roundedOffset + 'px)';
        }
  
        this.animateSlider();
      }
    }]);
  
    return ImageParallaxComponent;
  }(HTMLElement);
  
  customElements.define('image-parallax-component', ImageParallaxComponent);
  'use strict';
  
    
    
    
  
  var ImageTextComponent = function (_HTMLElement) {
    _inherits(ImageTextComponent, _HTMLElement);
  
    function ImageTextComponent() {
      _classCallCheck(this, ImageTextComponent);
  
      return _possibleConstructorReturn(this, (ImageTextComponent.__proto__ || Object.getPrototypeOf(ImageTextComponent)).apply(this, arguments));
    }
  
    _createClass(ImageTextComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.innerHTML = '' + this.innerHTML;
      }
    }]);
  
    return ImageTextComponent;
  }(HTMLElement);
  
  customElements.define('image-text-component', ImageTextComponent);
  'use strict';
  
    
    
  
  var IntroTextComponent = function (_HTMLElement) {
    _inherits(IntroTextComponent, _HTMLElement);
  
    function IntroTextComponent() {
      _classCallCheck(this, IntroTextComponent);
  
      return _possibleConstructorReturn(this, (IntroTextComponent.__proto__ || Object.getPrototypeOf(IntroTextComponent)).apply(this, arguments));
    }
  
    return IntroTextComponent;
  }(HTMLElement);
  
  customElements.define('intro-text-component', IntroTextComponent);
  'use strict';
  
    
    
    
  
  var NavigationComponent = function (_HTMLElement) {
    _inherits(NavigationComponent, _HTMLElement);
  
    function NavigationComponent() {
      _classCallCheck(this, NavigationComponent);
  
      return _possibleConstructorReturn(this, (NavigationComponent.__proto__ || Object.getPrototypeOf(NavigationComponent)).apply(this, arguments));
    }
  
    _createClass(NavigationComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        var _this2 = this;
  
        this.render();
        this.checkToggle = this.checkToggle.bind(this);
        this.animateIntroLine = this.animateIntroLine.bind(this);
        this.scrollToSection = this.scrollToSection.bind(this);
  
        this.introLine = this.querySelector('.navigation-component--intro-line');
        this.progressBar = this.querySelector('.navigation-component--progress-bar');
        this.progressBarWrapper = this.querySelector('.navigation-component--progress-bars');
        this.progressSections = [].slice.call(this.querySelectorAll('.navigation-component--progress-bar-line'));
        this.navInfoElements = [].slice.call(this.querySelectorAll('.navigation-component--info-el'));
        this.navInfoElementsTitles = [].slice.call(this.querySelectorAll('.navigation-component--info-title'));
  
        this.nextButton = this.querySelector('#navigation-component--button-next');
        this.prevButton = this.querySelector('#navigation-component--button-prev');
  
        this.hasAnimated = false;
  
        this.staticNavElement = this.navInfoElements[0];
        this.movingNavElement = this.navInfoElements[1];
        this.movingElTitleIndex = 1;
        this.scrollDirection = 'up';
        this.isDisplayed = false;
        this.titleMap = {
          0: [''],
          1: [''],
          2: ['Gaining Momentum'],
          3: ['Breaking Through'],
          4: ['Going Global'],
          5: ['']
        };
        this.currentSection = 0;
  
        this.nextButton.addEventListener('click', function (e) {
          _this2.scrollToSection('next');
        });
        this.prevButton.addEventListener('click', function (e) {
          _this2.scrollToSection('prev');
        });
  
        // Needs timeout for sections to be loaded into document
        setTimeout(function () {
          _this2.momentumSection = document.querySelector('#section-02');
          _this2.catchingFireSection = document.querySelector('#section-03');
          _this2.goingGlobalSection = document.querySelector('#section-04');
  
          window.addEventListener('scrollService', function (e) {
            if (_this2.isDisplayed && !_this2.hasAnimated) {
              _this2.animateIntroLine();
              _this2.hasAnimated = true;
            }
            _this2.updateNavInfo();
            _this2.checkToggle();
          });
        });
      }
    }, {
      key: 'animateIntroLine',
      value: function animateIntroLine() {
        var _this3 = this;
  
        TweenMax.to(this.introLine, 1.4, { ease: Circ.easeOut, width: '100%', onComplete: function onComplete() {
            TweenMax.to(_this3.introLine, 0.3, { opacity: 0 });
            TweenMax.to(_this3.progressBarWrapper, 0.3, { opacity: 1 });
          } });
      }
    }, {
      key: 'animateProgressSections',
      value: function animateProgressSections() {
        // Grabbing three sections that should be tracked
        var momentumBounds = this.momentumSection.getBoundingClientRect();
        var fireBounds = this.catchingFireSection.getBoundingClientRect();
        var globalBounds = this.goingGlobalSection.getBoundingClientRect();
  
        var halfScreenHeight = window.innerHeight / 2;
  
        // Calculating scroll progress per section
        var momentumProgress = (momentumBounds.y - halfScreenHeight) / -momentumBounds.height;
        var fireProgress = (fireBounds.y - halfScreenHeight) / -fireBounds.height;
        var globalProgress = (globalBounds.y - halfScreenHeight) / -globalBounds.height;
  
        // Transform progress line based on scroll progress
        this.progressSections[0].style.transform = 'scaleX(' + Math.max(0, Math.min(1, momentumProgress)) + ')';
        this.progressSections[1].style.transform = 'scaleX(' + Math.max(0, Math.min(1, fireProgress)) + ')';
        this.progressSections[2].style.transform = 'scaleX(' + Math.max(0, Math.min(1, globalProgress)) + ')';
      }
    }, {
      key: 'scrollToSection',
      value: function scrollToSection(dir) {
        var disabledNext = this.currentSection.index > 4 ? true : false;
        var disabledPrev = this.currentSection.index == 0 ? true : false;
        var targetId = false;
  
        if (dir == "prev" && !disabledPrev) {
          targetId = this.currentSection.index - 1;
        } else if (dir == 'next' && !disabledNext) {
          targetId = this.currentSection.index + 1;
        }
  
        var target = document.getElementById('section-0' + targetId);
        var dummy = {
          y: scrollServiceState.scroll
        };
        TweenMax.to(dummy, 1, {
          y: scrollServiceState.scroll + target.getBoundingClientRect().top + 4,
          ease: Quart.easeInOut,
          onUpdate: function onUpdate(event) {
            document.scrollingElement.scrollTop = dummy.y;
          }
        });
      }
    }, {
      key: 'updateNavInfo',
      value: function updateNavInfo() {
        var _this4 = this;
  
        // Updating start position for animation
        var startingPosition = this.scrollDirection == 'up' ? -100 : 100;
        this.currentSection = sectionDetectorState.currentSection;
        // Updating title copy of moving element
        if (this.scrollDirection == 'up') {
          this.movingElTitleIndex = this.currentSection.index;
        } else {
          this.movingElTitleIndex = this.currentSection.index + 1;
        }
  
        if (sectionDetectorState.sectionChanged) {
          // Animating static element out
          TweenMax.to(this.staticNavElement, 0, { y: 100 });
  
          // Updating title for moving element
          var movingNavElTitle = this.movingNavElement.querySelector('.navigation-component--info-title');
          movingNavElTitle.innerText = this.titleMap[this.currentSection.index][0];
  
          // Animating moving element in & swapping elements static/moving
          TweenMax.fromTo(this.movingNavElement, 0.3, { y: startingPosition }, {
            y: 0, onComplete: function onComplete() {
              _this4.staticNavElement = _this4.navInfoElements[0];
              _this4.movingNavElement = _this4.navInfoElements[1];
            }
          });
        }
        this.animateProgressSections();
      }
    }, {
      key: 'checkToggle',
      value: function checkToggle() {
        // Fade In
        if (this.currentSection.index > 1 && this.currentSection.index < 5) {
          this.classList.add('hiw-show');
          this.isDisplayed = true;
        } else {
          this.classList.remove('hiw-show');
          this.isDisplayed = false;
        }
      }
    }, {
      key: 'render',
      value: function render() {
        this.innerHTML = this.template;
      }
    }, {
      key: 'template',
      get: function get() {
        return '\n      <div class=\'navigation-component--wrapper\'>\n        <div class=\'navigation-component--info-container\'>\n          <div class=\'navigation-component--info-el\'>\n            <p class="navigation-component--info-title"></p>\n          </div>\n          <div class=\'navigation-component--info-el\'>\n            <p class="navigation-component--info-title"></p>\n          </div>\n        </div>\n        <div class=\'navigation-component--progress\'>\n        <div class=\'navigation-component--intro-line\'>\n        </div>\n        <div class=\'navigation-component--progress-bars\'>\n          <div class=\'navigation-component--progress-bar\'>\n            <div class=\'navigation-component--progress-bar-line\'>\n            </div>\n          </div>\n          <div class=\'navigation-component--progress-bar\'>\n            <div class=\'navigation-component--progress-bar-line\'>\n            </div>\n          </div>\n          <div class=\'navigation-component--progress-bar\'>\n            <div class=\'navigation-component--progress-bar-line\'>\n            </div>\n          </div>\n        </div>\n        </div>\n        <div class="navigation-component--prev-next">\n          <button class="navigation-component--button" data-dir="prev">Previous</button>\n          <button class="navigation-component--button">Next</button>\n        </div>\n      </div>\n    ';
      }
    }]);
  
    return NavigationComponent;
  }(HTMLElement);
  
  customElements.define('navigation-component', NavigationComponent);
  'use strict';
  
    
    
    
  
  !function () {
    var currentlyOpen = null;
  
    var OverlayComponent = function (_HTMLElement) {
      _inherits(OverlayComponent, _HTMLElement);
  
      function OverlayComponent() {
        _classCallCheck(this, OverlayComponent);
  
        return _possibleConstructorReturn(this, (OverlayComponent.__proto__ || Object.getPrototypeOf(OverlayComponent)).apply(this, arguments));
      }
  
      _createClass(OverlayComponent, [{
        key: 'connectedCallback',
        value: function connectedCallback() {
          var _this2 = this;
  
          this.buttonStyle = this.classList.contains('overlay-component--dark') ? 'default-button--transparent-light' : 'default-button--transparent-dark';
          this.render();
          this.toggleOverlayInOut = this.toggleOverlayInOut.bind(this);
          this.closeButton = this.querySelector('.overlay-component--close');
          this.closeButton.addEventListener('click', this.toggleOverlayInOut);
          this.isVisible = false;
  
          setTimeout(function () {
            _this2.parentContainer = _this2.closest('.overlay-component-parent');
            _this2.closeOverlayZone = _this2.parentContainer.querySelector('.overlay-component-closezone')
          });
        }
      }, {
        key: 'toggleOverlayInOut',
        value: function toggleOverlayInOut() {
          var _this3 = this;
  
          if (!this.isVisible) {
            if (currentlyOpen) currentlyOpen.toggleOverlayInOut();
  
            currentlyOpen = this;
  
            this.style.display = 'inline-block';
            TweenMax.to(this, 0.3, {
              opacity: 1,
              ease: Power1.easeOut,
              pointerEvents: 'all'
            });
            this.isVisible = true;
            if (this.parentContainer) this.parentContainer.style.zIndex = 10;
            _this3.closeOverlayZone.style.pointerEvents = 'initial'
          } else {
            currentlyOpen = null;
            TweenMax.to(this, 0.2, {
              opacity: 0,
              ease: Power1.easeIn,
              display: 'none',
              pointerEvents: 'none',
              onComplete: function onComplete() {
                if (_this3.parentContainer) _this3.parentContainer.style.zIndex = null;
                _this3.closeOverlayZone.style.pointerEvents = 'none'
              }
            });
            this.isVisible = false;
          }
        }
      }, {
        key: 'render',
        value: function render() {
          this.innerHTML = this.template;
        }
      }, {
        key: 'template',
        get: function get() {
          return '\n        <div class="overlay-component--close">\n          <default-button class="' + this.buttonStyle + '" data-icon="cross">Close</default-button>\n        </div>\n        <div class="overlay-component--element">\n          <p>\n            ' + this.innerHTML + '\n          </p>\n        </div>\n      ';
        }
      }]);
  
      return OverlayComponent;
    }(HTMLElement);
  
    customElements.define('overlay-component', OverlayComponent);
  }();
  'use strict';
  
    
    
    
  
  var StagesComponent = function (_HTMLElement) {
    _inherits(StagesComponent, _HTMLElement);
  
    function StagesComponent() {
      _classCallCheck(this, StagesComponent);
  
      return _possibleConstructorReturn(this, (StagesComponent.__proto__ || Object.getPrototypeOf(StagesComponent)).apply(this, arguments));
    }
  
    _createClass(StagesComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        var _this2 = this;
  
        this.imageOnViewDetector = this.imageOnViewDetector.bind(this);
        this.setActiveSection = this.setActiveSection.bind(this);
        this.toggleToolTip = this.toggleToolTip.bind(this);
        this.initialiseGraph = this.initialiseGraph.bind(this);
        this.activateFirstSectionForMobile = this.activateFirstSectionForMobile.bind(this);
  
        this.componentIsActive = false;
        this.inView = false;
        this.activeSection = null;
        this.activeTitle = '';
  
        this.currentMousePos = { x: 0, y: 0 };
  
        this.graphIsinitialised = false;
  
        this.graphIntroLine = this.querySelector('.stages-component-graph-intro-line');
        this.graphWrapper = this.querySelector('.stages-component--graph-wrapper');
        this.graphBarElements = [].slice.call(this.querySelectorAll('.stages-component--graph-wrapper-section-graph-bar'));
        this.graphLabelWrapper = this.querySelector('.stages-component--label-wrapper');
        this.graphLabelElements = [].slice.call(this.querySelectorAll('.stages-component--label'));
        this.mobileIconWrapper = this.querySelector('.stages-component--mobile-icon-wrapper');
        this.mobileIcons = [].slice.call(this.querySelectorAll('.stages-component--mobile-icons'));
        this.graphSections = [].slice.call(this.querySelectorAll('.stages-component--graph-wrapper-section'));
        this.toolTip = this.querySelector('.stages-component--tooltip');
        this.flexContainer = this.querySelector('.stages-component--flex-container');
  
        this.gradientGraphicWrapper = this.querySelector('.stages-component--gradient-wrapper');
        this.gradientGraphics = [].slice.call(this.querySelectorAll('.stages-component--gradient-graphic'));
        this.currentWrapperRotation = 0;
        this.flexContainerOffsetMargin = 0;
  
        window.addEventListener('scrollService', this.imageOnViewDetector);
        window.addEventListener('mousemove', function (e) {
          return _this2.toggleToolTip(e);
        });
        window.addEventListener('load', this.initialiseGraph);
  
        this.graphSections.forEach(function (section) {
          section.addEventListener('mouseover', function () {
            _this2.setActiveSection(section.dataset.section);
          });
          section.addEventListener('mouseout', function () {
            _this2.setActiveSection(null);
          });
        });
  
        // for mobile
        this.graphWrapper.addEventListener('scroll', function () {
          var sections = [].slice.call(_this2.graphWrapper.querySelectorAll('.stages-component--graph-wrapper-section'));
  
          var middle = window.innerWidth / 2;
  
          sections.sort(function (a, b) {
            var aBounds = a.getBoundingClientRect();
            var bBounds = b.getBoundingClientRect();
  
            var aMid = aBounds.left + aBounds.width / 2;
            var bMid = bBounds.left + bBounds.width / 2;
  
            if (Math.abs(aMid - middle) < Math.abs(bMid - middle)) return -1;
            if (Math.abs(aMid - middle) > Math.abs(bMid - middle)) return 1;
            return 0;
          });
  
          _this2.setActiveSection(sections[0].dataset.section);
        });
      }
    }, {
      key: 'activateFirstSectionForMobile',
      value: function activateFirstSectionForMobile() {
        this.graphLabelWrapper.dataset.sectionActive = 0;
        this.mobileIconWrapper.dataset.iconActive = 0;
      }
    }, {
      key: 'getScrollbarWidth',
      value: function getScrollbarWidth() {
        return window.innerWidth - document.documentElement.clientWidth;
      }
    }, {
      key: 'getRandomArbitrary',
      value: function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
      }
    }, {
      key: 'initialiseGraph',
      value: function initialiseGraph() {
        if (this.inView && !this.graphIsinitialised) {
          this.initialiseBars();
        }
        if (ResizeService.isMobile) {
          this.activateFirstSectionForMobile();
        }
      }
    }, {
      key: 'imageOnViewDetector',
      value: function imageOnViewDetector() {
        if (this.getBoundingClientRect().top + (window.pageYOffset - window.innerHeight / 8) < scrollServiceState.scroll) {
          this.inView = true;
          this.initialiseGraph();
          this.graphIsinitialised = true;
        } else {
          this.inView = false;
        }
      }
    }, {
      key: 'setActiveSection',
      value: function setActiveSection(sectionNumber) {
        var numActiveSection = sectionNumber ? parseInt(sectionNumber) : null;
  
        // if (ResizeService.isMobile) numActiveSection = 0
  
        if (numActiveSection == null) {
          this.componentIsActive = false;
  //         this.querySelector('dynamic-gradient-component').dataset.activeColor = 'none';
          this.activeTitle = '';
          this.graphLabelWrapper.dataset.sectionActive = null;
          this.mobileIconWrapper.dataset.iconActive = null;
  
          var currentActiveSection = this.graphWrapper.querySelector('.stages-component--graph-wrapper-section--active');
          var currentActiveMobileIcon = this.mobileIconWrapper.querySelector('.stages-component--mobile-icon-section--active');
  
          if (currentActiveSection) {
            currentActiveSection.classList.remove('stages-component--graph-wrapper-section--active');
            currentActiveMobileIcon.classList.remove('stages-component--mobile-icon-section--active');
          }
        } else {
          this.activeSection = numActiveSection;
          this.componentIsActive = true;
          this.graphLabelWrapper.dataset.sectionActive = numActiveSection;
          this.mobileIconWrapper.dataset.iconActive = numActiveSection;
  //         this.querySelector('dynamic-gradient-component').dataset.activeColor = numActiveSection;
          this.activeTitle = this.graphSections[numActiveSection].querySelector('h4').innerText;
  
          var _currentActiveSection = this.graphWrapper.querySelector('.stages-component--graph-wrapper-section--active');
          var _currentActiveMobileIcon = this.mobileIconWrapper.querySelector('.stages-component--mobile-icon-section--active');
  
          if (_currentActiveSection) {
            _currentActiveSection.classList.remove('stages-component--graph-wrapper-section--active');
            _currentActiveMobileIcon.classList.remove('stages-component--mobile-icon-section--active');
          }
  
          var newCurrentActiveSection = this.graphWrapper.querySelector('[data-section="' + sectionNumber + '"]');
          var newCurrentActiveMobileIcon = this.mobileIconWrapper.querySelector('[data-icon="' + sectionNumber + '"]');
  
          newCurrentActiveSection.classList.add('stages-component--graph-wrapper-section--active');
          newCurrentActiveMobileIcon.classList.add('stages-component--mobile-icon-section--active');
        }
      }
    }, {
      key: 'toggleToolTip',
      value: function toggleToolTip(e) {
        // Hiding tooltip for mobile view < 800px width
        if (this.componentIsActive && this.inView && !ResizeService.isMobile) {
          this.toolTip.style.display = 'block';
          this.toolTip.innerText = '' + this.activeTitle;
          var containerBounds = this.graphWrapper.getBoundingClientRect();
          var localX = e.clientX;
          var localY = e.clientY - containerBounds.top;
          this.toolTip.style.top = localY + 6 + 'px';
          this.toolTip.style.left = localX + 6 + 'px';
        } else if (ResizeService.isMobile || !this.componentIsActive) {
          this.toolTip.style.display = 'none';
        } else {
          this.toolTip.style.display = 'none';
        }
      }
    }, {
      key: 'initialiseBars',
      value: function initialiseBars() {
        var _this3 = this;
  
  //       TweenMax.to(this.graphIntroLine, 0.8, { ease: Expo.easeIn,
  //         width: '100%', onComplete: function onComplete() {
  //           TweenMax.to(_this3.graphIntroLine, 0.4, { opacity: 0 });
  //           _this3.graphBarElements.forEach(function (bar, index) {
  //             TweenMax.to(bar, 1, { opacity: 1 });
  //           });
  //           _this3.graphBarElements.forEach(function (bar, index) {
  //             TweenMax.to(bar, 0, {
  //               opacity: 1, onComplete: function onComplete() {
  //                 var height = '3px';
  //                 if (index != 0) {
  //                   height = index * 10 + '%';
  //                 }
  //                 TweenMax.to(bar, 1.2, { ease: Expo.easeOut, height: height });
  //               }
  //             });
  //           });
  //         }
  //       });
      }
    }]);
  
    return StagesComponent;
  }(HTMLElement);
  
  customElements.define('stages-component', StagesComponent);
  'use strict';
  
    
    
    
  
  var SubHeaderComponent = function (_HTMLElement) {
    _inherits(SubHeaderComponent, _HTMLElement);
  
    function SubHeaderComponent() {
      _classCallCheck(this, SubHeaderComponent);
  
      return _possibleConstructorReturn(this, (SubHeaderComponent.__proto__ || Object.getPrototypeOf(SubHeaderComponent)).apply(this, arguments));
    }
  
    _createClass(SubHeaderComponent, [{
      key: 'connectedCallback',
      value: function connectedCallback() {
        this.overlayComponent = this.querySelector('overlay-component');
        this.overlayToggleButton = this.querySelector('default-button');
        this.classList.add('overlay-component-parent');
        if (this.overlayComponent) this.overlayToggleButton.addEventListener('click', this.overlayComponent.toggleOverlayInOut);
      }
    }]);
  
    return SubHeaderComponent;
  }(HTMLElement);
  
  customElements.define('sub-header-component', SubHeaderComponent);
  'use strict';
  
  //Testing Custom Events
  
  window.addEventListener('scrollService', function (e) {
      // console.log(e.detail.state)
  });
  
  window.addEventListener('mobileDetectorService', function (e) {
      // console.log(e.detail.isMobile)
  });
  
  /* Custom stuff */
  
  !function(){
    var graphicBars = document.querySelectorAll('.stages-component--graph-wrapper-section-graph-bar')
  
    TweenMax.to(graphicBars, 0.8, { ease: Expo.easeIn,
      width: '100%', onComplete: function onComplete() {
        TweenMax.to(graphicBars, 0.4, { opacity: 0 });
        graphicBars.forEach(function (bar, index) {
          TweenMax.to(bar, 1, { opacity: 1 });
        });
        var heights = jQuery('.stages-component--graph-wrapper-section-graph-bar').map(function(){
          return jQuery(this).data('height');
        }).get();
       graphicBars.forEach(function (bar, index) {
          TweenMax.to(bar, 0, {
            opacity: 1, onComplete: function onComplete() {
              TweenMax.to(bar, 1.2, { ease: Expo.easeOut, height: heights[index] });
            }
          });
        });
      }
    });
  }()
})