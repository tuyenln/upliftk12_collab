"use strict";
$(document).ready(function () {
   /*----------------|Counter|---------- */
   var isScrolledIntoView = function(elem) {
      var $elem = $(elem);
      var $window = $(window);
      var docViewTop = $window.scrollTop();
      var docViewBottom = docViewTop + $window.height();
      var elemTop = $elem.offset().top;
      var elemBottom = elemTop + $elem.height();
      return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
   }
   var startCounter = function() {  
      if($('.number-count').length > 0){
         if(isScrolledIntoView('.number-count:eq(0)') == true){
            $(window).off("scroll", startCounter);
            $('.number-count').each(function () {
               var $this = $(this);
               $({ Counter: 0 }).animate({ Counter: $this.data('count') }, {
                 duration: 2000,
                 easing: 'swing',
                 step: function () {
                   $this.text(Math.ceil(this.Counter));
                }
             });
            });
         }
      }
   };
   $(window).scroll(startCounter);  
   /*---------------|page loader|-----------------*/ 
   $(".page-loader-wrap").fadeOut("slow"); 
   /*---------------|Sliders|-----------------*/ 
   $('.make-testimonial-slick').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: true,
      dots: true,
      cssEase: 'linear',
      prevArrow: '<a class="slick-prev"><i class="fa fa-arrow-left"></i></a>',
      nextArrow: '<a class="slick-next"><i class="fa fa-arrow-right"></i></a>',
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               arrows: false,
            }
         }
      ]
   });
   $('.make-banner-slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: true,
      dots: true,
      cssEase: 'linear',
      arrows:false,
      prevArrow: '<a class="slick-prev"><i class="fa fa-arrow-left"></i></a>',
      nextArrow: '<a class="slick-next"><i class="fa fa-arrow-right"></i></a>',
   });
   $('.make-logo-slider').slick({
      infinite: true,
      slidesToShow: 8,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      prevArrow: '<a class="slick-prev"><i class="fa fa-arrow-left"></i></a>',
      nextArrow: '<a class="slick-next"><i class="fa fa-arrow-right"></i></a>',
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 6,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 4
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 2
            }
         }, {
            breakpoint: 421,
            settings: {
               slidesToShow: 1
            }
         }
      ]
   });
   $('.make-team-slider').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      prevArrow: '<a class="slick-prev"><i class="fa fa-arrow-left"></i></a>',
      nextArrow: '<a class="slick-next"><i class="fa fa-arrow-right"></i></a>',
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 3,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 1,
            }
         }
      ]
   });
   $('.make-blog-slider').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      prevArrow: '<a class="slick-prev"><i class="fa fa-arrow-left"></i></a>',
      nextArrow: '<a class="slick-next"><i class="fa fa-arrow-right"></i></a>',
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 3,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 1,
            }
         }
      ]
   });
   $('.explore-skills-slider').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      responsive: [
         {
            breakpoint: 1400,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 3,
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 2,
            }
         }, {
            breakpoint: 567,
            settings: {
               slidesToShow: 1,
            }
         }
      ]
   });
   $('.client-image-slider').slick({
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 3,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 3
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 3
            }
         }, {
            breakpoint: 421,
            settings: {
               slidesToShow: 2
            }
         }
      ]
   });
   $('.service-info-slider').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      responsive: [
         {
            breakpoint: 1280,
            settings: {
               slidesToShow: 3,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 2,
            }
         },
         {
            breakpoint: 600,
            settings: {
               slidesToShow: 1
            }
         }
      ]
   });
   $('.portfolio-client-slider').slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 5,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 5
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 3
            }
         }, {
            breakpoint: 421,
            settings: {
               slidesToShow: 2
            }
         }
      ]
   });
   $('.portofolio-2-slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      speed: 500,
      fade: false,
      dots: false,
      cssEase: 'linear',
      arrows: false,
      responsive: [
         {
            breakpoint: 1200,
            settings: {
               slidesToShow: 1,
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 1
            }
         },
         {
            breakpoint: 768,
            settings: {
               slidesToShow: 1
            }
         }, {
            breakpoint: 421,
            settings: {
               slidesToShow: 1
            }
         }
      ]
   });
   /*---------------|Header Logo change|-----------------*/ 
   $(".header-transparent .navbar-brand img").each(function () {
      $(this).attr('src', 'assets/images/logo-white.png');
   });
   /*---------------|Portfolio Grid|-----------------*/ 
   $(".portfolio-load-more .load-more-btn .btn").on('click',function(){
      $('.portfolio-load-more').toggleClass('load-more-content');
      if($(".portfolio-load-more").hasClass("load-more-content")) {
         $('.portfolio-load-more .load-more-btn .btn').text("Show Less");
      } else {
            $('.portfolio-load-more .load-more-btn .btn').text("Show More");
      }
   });
   /*---------------|Header Sticky|-----------------*/ 
   $(window).scroll(function(){
      if ($(window).scrollTop() >=300) {
         $('#header-sec .sticky-header').addClass('visible');
      }
      else {
         $('#header-sec .sticky-header').removeClass('visible');
      }
   });


   /*---------------|Header Responsive|-----------------*/ 
   $(".header-v1 .header-wrap .menu-item-has-child").on('click',function (e) {
      e.stopPropagation();
      var $submenu = $(this);
      $submenu.find('.menu-item-has-child').removeClass('opened-submenu');
      $submenu.toggleClass('opened-submenu');
   });
   $(".navbar-toggler").on('click', function () {
      $('body').toggleClass('resp-menu-opened');
   });

   /*---------------|Magnific Popup|-----------------*/ 
   $('.image-link').magnificPopup({
      type: 'image',
      mainClass: 'mfp-with-zoom',
   });
   $('.video-popup').magnificPopup({
      type: 'iframe',
      iframe: {
         patterns: {
            youtube: {
               index: 'youtube.com/',
               id: function (url) {
                  var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                  if (!m || !m[1]) return null;
                  return m[1];
               },
               src: 'https://www.youtube.com/embed/rbTVvpHF4cU'
            }
         }
      }
   });
   $('.comingsoonvideo-popup').magnificPopup({
      type: 'iframe',
      iframe: {
         patterns: {
            youtube: {
               index: 'youtube.com/',
               id: function (url) {
                  var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                  if (!m || !m[1]) return null;
                  return m[1];
               },
               src: 'https://www.youtube.com/embed/rbTVvpHF4cU'
            }
         }
      }
   });
})