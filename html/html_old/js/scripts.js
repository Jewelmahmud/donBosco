
var homeBannerSlider = new Swiper(".home-banner-slider", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  pagination: false,
  loop: true,
  navigation: {
    nextEl: ".activity-slider-next",
    prevEl: ".activity-slider-prev",
  },
});


var fourColCarousel = new Swiper(".four-col-carousel", {
  slidesPerView: 1,
  spaceBetween: 1,
  loop: true,
  navigation: {
    nextEl: ".swiper-next",
    prevEl: ".swiper-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 2,

    },
    768: {
      slidesPerView: 3,

    },
    1024: {
      slidesPerView: 4,

    },
  },
});

var fourColCarousel_2 = new Swiper(".four-col-carousel-2", {
  slidesPerView: 1,
  spaceBetween: 1,
  loop: true,
  navigation: {
    nextEl: ".swiper-next",
    prevEl: ".swiper-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 2.3,

    },
    768: {
      slidesPerView: 3.3,

    },
    1024: {
      slidesPerView: 3.3,

    },
  },
});

var partnersCarosuel = new Swiper(".partners-carosuel", {
  slidesPerView: 3,
  spaceBetween: 30,

  grabCursor: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  loop: true,
  breakpoints: {
    640: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 5,

    },
    1200: {
      slidesPerView: 6,

    },
    
  },
});

var newsCarousel = new Swiper(".news-carousel", {
  slidesPerView: 1,
  loop: true,
  spaceBetween: 25,
  
  breakpoints: {
    768: {
      slidesPerView: 2,

    },
    992: {
      slidesPerView: 3,

    },

  },
  navigation: {
    nextEl: ".swiper-next",
    prevEl: ".swiper-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

var instaCarousel = new Swiper(".insta-carousel", {
  slidesPerView: 2,
  
  spaceBetween: 11,

  loop: true,

  slidesPerGroup: 3,
  grabCursor: true,
  
  navigation: {
    nextEl: ".swiper-next",
    prevEl: ".swiper-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    640: {
      slidesPerView: 2.3,
      pagination: false,
    },
    768: {
      slidesPerView: 4.3,

    },

  },
});

var slideTabsSwiper = new Swiper(".slide-tabs", {
  slidesPerView: 2,
  spaceBetween: 15,
  loop: true,
  navigation: {
    nextEl: ".swiper-next",
    prevEl: ".swiper-prev",
  },

  breakpoints: {
    768: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 4,
    },
    1200: {
      slidesPerView: 6,
    },
  },
});


// Handle Collapse Divs
var collapseDivs = document.querySelectorAll(".collapse-div");
collapseDivs.forEach(function (div) {
  div.style.display = "none";
});

var h5Elements = document.querySelectorAll("footer h5");
h5Elements.forEach(function (h5) {
  h5.addEventListener("click", function () {
    this.classList.toggle("toggle");
    var collapseDiv = this.nextElementSibling;
    collapseDiv.style.display =
      window.getComputedStyle(collapseDiv).display === "none"
        ? "block"
        : "none";
  });
});


(function ($) {
	'use strict';

  $(document).ready(function() {
    $('.openVideo').magnificPopup({

      type: 'iframe',
      mainClass: 'mfp-with-zoom',
      removalDelay: 200,
    });
  });

  // Isotope Filtering
var faqIso = $(".all-faqs").isotope({
  itemSelector: ".faq-item",
  layoutMode: "fitRows",
});

$("a.faqselector").on("click", function (e) {
  e.preventDefault();
  var value = $(this).attr("data-name");
  $("a.faqselector").removeClass("active");
  $(this).addClass("active");
  faqIso.isotope({
    filter: value,
  });
});

})(jQuery);


var inputs = document.querySelectorAll('.file-input')

  for (var i = 0, len = inputs.length; i < len; i++) {
    customInput(inputs[i])
  }
  
  function customInput (el) {
    const fileInput = el.querySelector('[type="file"]')
    const label = el.querySelector('[data-js-label]')
    
    fileInput.onchange =
    fileInput.onmouseout = function () {
      if (!fileInput.value) return
      
      var value = fileInput.value.replace(/^.*[\\\/]/, '')
      el.className += ' -chosen'
      label.innerText = value
    }
  };



  $(document).ready(function () {
    var mySwiper = new Swiper(".swiper-container--timeline", {
      

      autoHeight: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      speed: 500,
      direction: "horizontal",
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      pagination: {
        el: ".swiper-pagination",
        type: "progressbar"
      },
      loop: false,
      effect: "slide",

      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        992: {
          slidesPerView: 1.3,
        },

      },
      on: {
        init: function () {
          $(".swiper-pagination-custom .swiper-pagination-switch").removeClass("active");
          $(".swiper-pagination-custom .swiper-pagination-switch").eq(0).addClass("active");
        },
        slideChangeTransitionStart: function () {
          $(".swiper-pagination-custom .swiper-pagination-switch").removeClass("active");
          $(".swiper-pagination-custom .swiper-pagination-switch").eq(mySwiper.realIndex).addClass("active");
        }
      }
    });
    $(".swiper-pagination-custom .swiper-pagination-switch").click(function () {
      mySwiper.slideTo($(this).index());
      $(".swiper-pagination-custom .swiper-pagination-switch").removeClass("active");
      $(this).addClass("active");
    });
  });