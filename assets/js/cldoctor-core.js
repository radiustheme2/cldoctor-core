(function($) {
  "use strict";

  /* Main Functions */
  var CldoctorCore = {
      init: function() {
          this.Basic.init();
      },
      Basic: {
          init: function() {
              this.HeadroomStickyHeader();
              this.CldoctorCoreCategoriesSlider();
              this.MouseParallax();
              this.SwiperThumbSlider();
              this.ElementsCarousel();
              this.TestimonialSlider3();
              this.IsotopeActivator();
              this.AdvancedSearch();
              this.MagnificPopup();
              this.CldoctorCoreOthers();
          },
          HeadroomStickyHeader: function(){
            var header = document.querySelector(".headroom-sticky-header");
            var headroom = new Headroom(header, {
              tolerance: {
                down: 10,
                up: 20
              },
              offset: 15
            });
            headroom.init();

            var mobile_header = document.querySelector(".headroom-mobile-sticky-header");
            var mobile_headroom = new Headroom(mobile_header, {
              tolerance: {
                down: 10,
                up: 20
              },
              offset: 15
            });
            mobile_headroom.init();
          },
          CldoctorCoreCategoriesSlider: function(){         
            $('.cldoctor-core-categories-slider').each(function() {
              var $this = $(this);
              $this.fadeIn();
              var settings = $this.data('slider-options');
              var autoplayconditon = settings['auto'];
              var $pagination = $this.find('.swiper-pagination')[0];
              var $next = $this.find('.swiper-button-next')[0];
              var $prev = $this.find('.swiper-button-prev')[0];
              new Swiper( $this[0], {
                speed: settings['speed'],
                slidesPerGroup: settings['slidesPerGroup'] ? settings['slidesPerGroup']:1,
                autoplay: autoplayconditon ? {delay:settings['autoplay']['delay']}:false,
                pagination: {
                  el: $pagination,
                  clickable: true,
                  type: 'bullets',
                },
                navigation: {
                  nextEl: $next,
                  prevEl: $prev,
                },
                breakpoints: {
                  0: {
                    slidesPerView: settings['breakpoints']['0']['slidesPerView'],
                  },
                  576: {
                    slidesPerView: settings['breakpoints']['575']['slidesPerView'],
                  },
                  768: {
                    slidesPerView: settings['breakpoints']['768']['slidesPerView'],
                  },
                  992: {
                    slidesPerView: settings['breakpoints']['992']['slidesPerView'],
                  },
                  1200: {
                    slidesPerView: settings['breakpoints']['1200']['slidesPerView'],
                  },
                },
              });
      
            });
          },
          MouseParallax: function () {
            var parallaxInstances = [];
            $('.rt-mouse-parallax').each(function(index, element) {
                var $this = $(this);
                $this.attr('id', "rt-parallax-instance-" + index);
                parallaxInstances[index] = new Parallax($("#rt-parallax-instance-" + index).get(0), {
                    // hoverOnly: true,
                    // relativeInput: true,
                });
            })
          },
          SwiperThumbSlider: function () {
            $('.testimonial-style-1').each(function() {
              var $this = $(this);
              var settings = $this.data('slider-options');
              var autoplayconditon = settings['auto'];
              var $pagination = $this.find('.swiper-pagination')[0];
              var $next = $this.find('.swiper-button-next')[0];
              var $prev = $this.find('.swiper-button-prev')[0];

              var swiper = new Swiper(".SwiperThumb", {
                spaceBetween:  settings['spaceBetween'],
                slidesPerView: settings['sliderPerView'],
                freeMode: true,
                watchSlidesProgress: true,
                direction: 'vertical',
                autoplay:autoplayconditon ? { delay:settings['autoplay']['delay']} : false,
              });
              var swiper2 = new Swiper(".SwiperContent", {
                spaceBetween:  settings['spaceBetween'],
                direction: 'vertical',
                autoplay:autoplayconditon ? { delay:settings['autoplay']['delay']} : false,
                navigation: {
                  nextEl: $next,
                  prevEl: $prev,
                },
                thumbs: {
                    swiper: swiper,
                },
                pagination: {
                  el: $pagination,
                  clickable: true,
                  type: 'bullets',
                },
              });
            });
          },
          ElementsCarousel: function () {
            $.fn.elExists = function () {
              return this.length > 0;
            };
            var $elCarousel = $(".cldoctor-carouser-slider");
            if ($elCarousel.elExists()) {
                $elCarousel.each(function (index, element) {
                    var $this = $(this);
                    var settings = $this.data('slider-options');
                    var slider_views = settings['sliderPerView'] ? settings['sliderPerView'] : 4;
                    var xl_devices = settings['breakpoints']['1200']['slidesPerView'];
                    var lg_devices = settings['breakpoints']['992']['slidesPerView'];
                    var md_devices = settings['breakpoints']['768']['slidesPerView'];
                    var sm_devices = settings['breakpoints']['480']['slidesPerView'];
                    var xs_devices = settings['breakpoints']['0']['slidesPerView'];
                    var autoplayconditon = settings['auto'];
                    // Fetching from data attributes
                    var visibleSlides = slider_views;
                    var visibleSlides_xl = xl_devices ? xl_devices : 4;
                    var visibleSlides_lg = lg_devices ? lg_devices : 3;
                    var visibleSlides_md = md_devices ? md_devices : 2;
                    var visibleSlides_sm = sm_devices ? sm_devices : 1;
                    var visibleSlides_xs = xs_devices ? xs_devices : 1;
                    var slideSpeed = settings['speed'] ? settings['speed'] : 1000;
                    var slideLoop = settings['loop'];
                    var slideSpace = settings['spaceBetween'] ? settings['spaceBetween'] : 30;
                    var $pagination = $this.find('.swiper-pagination')[0];
                    var $next = $this.find('.swiper-button-next')[0];
                    var $prev = $this.find('.swiper-button-prev')[0];

                    var rtSlider = new Swiper(".element-carousel", {
                        slidesPerView: visibleSlides,
                        spaceBetween: slideSpace,
                        speed: slideSpeed,
                        loop: slideLoop,
                        observer: true,
                        observeParents: true,
                        watchSlidesProgress: true,
                        watchSlidesVisibility: true,
                        loopAdditionalSlides: 10,
                        autoplay: autoplayconditon ? { delay:settings['autoplay']['delay']} : false,
                        navigation: {
                          nextEl: $next,
                          prevEl: $prev,
                        },
                        pagination: {
                          el: $pagination,
                          clickable: true,
                          type: 'bullets',
                        },

                        // Responsive breakpoints
                        breakpoints: {
                          0: {
                            slidesPerView: visibleSlides_xs,
                          },
                          576: {
                            slidesPerView: visibleSlides_sm,
                            spaceBetween: 30,
                          },
                          768: {
                            slidesPerView: visibleSlides_md,
                            spaceBetween: 30,
                          },
                          992: {
                            slidesPerView: visibleSlides_lg,
                            spaceBetween: 30,
                          },
                          1200: {
                            slidesPerView: visibleSlides_xl,
                            spaceBetween: 30,
                          }
                        },
                        on: {
                            afterInit: function (slider) {
                                $(slider.$wrapperEl).find('.swiper-slide').removeClass('visible-first visible-last');
                                $(slider.$wrapperEl).find('.swiper-slide.swiper-slide-visible').first().addClass('visible-first');
                                $(slider.$wrapperEl).find('.swiper-slide.swiper-slide-visible').last().addClass('visible-last');
                            },
                            slideChange: function (slider) {
                                $(slider.$wrapperEl).find('.swiper-slide').removeClass('visible-first visible-last');
                                $(slider.$wrapperEl).find('.swiper-slide.swiper-slide-visible').first().addClass('visible-first');
                                $(slider.$wrapperEl).find('.swiper-slide.swiper-slide-visible').last().addClass('visible-last');
                            },
                            sliderMove: function (slider) {
                                $(slider.$wrapperEl).find('.swiper-slide').removeClass('visible-first visible-last');
                                $(slider.$wrapperEl).find('.swiper-slide.swiper-slide-visible').first().addClass('visible-first');
                                $(slider.$wrapperEl).find('.swiper-slide.swiper-slide-visible').last().addClass('visible-last');
                            },
                        }
                    });
                });
            }
          },
          TestimonialSlider3: function(){
            var swiper = new Swiper(".mySwiperx", {
              effect: "cards",
              grabCursor: true,

            });
            var swiper5 = new Swiper(".mySwiper5", {
                spaceBetween: 10,
                direction: 'vertical',
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
            var galleryThumbs = new Swiper('.swiper-container.gallery-thumbs', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                hashNavigation: {
                    watchState: true,
                },
                
                coverflowEffect: {
                    rotate: 0,
                    stretch: 0,
                    depth: 100,
                    modifier: 12,
                    slideShadows : false,
                  }, 
            });
                
                
            var galleryTop = new Swiper('.swiper-container.testimonial', {
              speed: 400,
              spaceBetween: 50,
              direction: 'vertical',
              pagination: {
                clickable: true,
                el: '.swiper-pagination',
                type: 'bullets',
              },
              thumbs: {
                swiper: galleryThumbs
              }
            });

          },
          IsotopeActivator: function () {
            var $container = $(".isotope-items");
            if ($container.length > 0) {
                var $isotope;
                $(".featuredContainer", $container).imagesLoaded(function () {
                    var selectero = $container.find('.isotope-classes-tab .nav-item:first-child').data('filter') || '*';

                    $isotope = $(".featuredContainer", $container).isotope({
                        filter: selectero,
                        transitionDuration: "0.7s",
                        itemSelector: '.listing-item',
                        layoutMode: 'fitRows',
                        hiddenStyle: {
                            opacity: 0,
                            transform: "scale(0.001)"
                        },
                        visibleStyle: {
                            transform: "scale(1)",
                            opacity: 1
                        },
                        fitRows: {
                          equalheight: true,
                          gutter: 0
                        },
                    });
                });
                $container.find(".isotope-classes-tab").on("click", "a", function () {
                    var $this = $(this);
                    $this
                        .parent(".isotope-classes-tab")
                        .find("a")
                        .removeClass("current");
                    $this.addClass("current");
                    var selector = $this.attr("data-filter");
                    $isotope.isotope({
                        filter: selector
                    });
                    return false;
                });
            }
          },
          AdvancedSearch: function(){
            
            $('.search-radio-check ul li:first-child label').addClass('active');
            
              var $rtSearchRadioButtons = $('.search-radio-check input[type="radio"]');
              $rtSearchRadioButtons.each(function () {
                $(this).on('click',function () {
                $('.ad-type-label').removeClass('active');
                $(this).parent().addClass('active', this.checked);
              });

            });

            // $('.search-radio-check li').click(function() {
            //   $('.search-radio-check li label').removeClass('active');
            //   $(this).find('input')
            //   $(this).addClass('active');
            // });

          },
          MagnificPopup: function (){
              var yPopup = $(".popup-youtube");
              if (yPopup.length) {
                  yPopup.magnificPopup({
                      disableOn: 700,
                      type: 'iframe',
                      mainClass: 'mfp-fade',
                      removalDelay: 160,
                      preloader: false,
                      fixedContentPos: false
                  });
              }
          },
          CldoctorCoreOthers: function(){
            $(window).on("scroll", function () {
              if ($(window).scrollTop() >= $("body").offset().top + 50) {
                $("body").addClass("mn-top");
              } else {
                $("body").removeClass("mn-top");
              }
            })
          }
      }
  }

  // Window Load+Resize
  $(window).on('load resize', function (){
      // Elementor Frontend Load
      $(window).on('elementor/frontend/init', function () {
          if (elementorFrontend.isEditMode()) {
              elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
                CldoctorCore.init();
              });
          }
      });
  });

  //Advanced Search
  function rtclCategoryAjax() {
    var searchForm = $('.advance-search-form');
    if (searchForm.length < 1) {
      return
    }
    //Custom category button on click
    $('body').on('click', '.rtcl-category-ajax .ad-type-label', function (e) {
      var targetEl = $(this);
      var ad_type = targetEl.find('input[type=radio]').val();
      rtcl_cf_by_category(ad_type, targetEl)
    });
  }

  function rtcl_cf_by_category(ad_type, targetEl) {
    var parentElementor = targetEl.parents('.advance-search-form');
    var container = parentElementor.find('#cldoctor-rtcl-category');
    var style = container.data('style');
    $.ajax({
      type: "post",
      url: CldoctorObj.ajaxUrl,
      data: {
        action: "rtcl_advanced_search_by_type",
        ad_type: ad_type ?? 'all',
        style: style,
      },
      beforeSend: function () {
        container.addClass('is-loading')
      },
      success: function (data) {
        container.html(data);
        window.Cldoctor.Basic.Select2Run();
        container.removeClass('is-loading')
      }
    })
  }

  $( document ).ready( function () {
    CldoctorCore.init();
    rtclCategoryAjax();
  });

})(jQuery);