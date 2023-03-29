var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    loop: true,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
  });


var swiper = new Swiper(".mySwiper-feedback", {
    breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        767: {
          slidesPerView: 2,
          spaceBetween: 30
        }
    },
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});