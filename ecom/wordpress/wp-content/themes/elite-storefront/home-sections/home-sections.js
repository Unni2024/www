window.addEventListener('load', function() {
  if (typeof Swiper !== 'undefined') {
    if (document.querySelector('.elite-storefront-hero-slider')) {
      new Swiper('.elite-storefront-hero-slider', {
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        autoplay: {
          delay: 5000,
        },
      });
    }

    const prodSlider = document.querySelector('.elite-storefront-product-slider');
    if (prodSlider) {
      let perRow = parseInt(prodSlider.getAttribute('data-per-row')) || 5;
      new Swiper('.elite-storefront-product-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: false,
        speed: 500,

        navigation: {
          nextEl: '.swiper-button-next-product',
          prevEl: '.swiper-button-prev-product',
        },
        breakpoints: {
          640: { slidesPerView: 2 },
          768: { slidesPerView: 3 },
          1024: { slidesPerView: perRow },
        }
      });
    }

    const prodSlider2 = document.querySelector('.elite-storefront-product-slider-2');
    if (prodSlider2) {
      let perRow2 = parseInt(prodSlider2.getAttribute('data-per-row')) || 5;
      new Swiper('.elite-storefront-product-slider-2', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: false,
        speed: 500,

        navigation: {
          nextEl: '.swiper-button-next-product-2',
          prevEl: '.swiper-button-prev-product-2',
        },
        breakpoints: {
          640: { slidesPerView: 2 },
          768: { slidesPerView: 3 },
          1024: { slidesPerView: perRow2 },
        }
      });
    }

    const catSlider = document.querySelector('.elite-storefront-product-cat-slider');
    if (catSlider) {
      let catPerRow = parseInt(catSlider.getAttribute('data-per-row')) || 5;
      new Swiper('.elite-storefront-product-cat-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: false,
        speed: 500,

        navigation: {
          nextEl: '.swiper-button-next-cat',
          prevEl: '.swiper-button-prev-cat',
        },
        breakpoints: {
          640: { slidesPerView: 2 },
          768: { slidesPerView: 3 },
          1024: { slidesPerView: catPerRow },
        }
      });
    }

    const postSlider = document.querySelector('.elite-storefront-post-slider');
    if (postSlider) {
      new Swiper('.elite-storefront-post-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: false,
        speed: 500,
        navigation: {
          nextEl: '.swiper-button-next-post',
          prevEl: '.swiper-button-prev-post',
        }
      });
    }
  }
});
