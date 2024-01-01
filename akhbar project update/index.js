var swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 8,
    freeMode: true,
    watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".mySwiper2", {
    loop: true,
    spaceBetween: 5,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
  });



//   $('.owl-carousel').owlCarousel({
//     loop:true,
//     margin:5,
//     nav:false,
//     responsive:{
//         0:{
//             items:1
//         },
//         767:{
//             items:2
//         },
//         1000:{
//             items:3
//         }
//     }
// })



const suggestedSwiper = new Swiper('.newspaperSwipper', {
	speed: 600,
	loop: true,
	autoplay: {
		delay: 3000,
		disableOnInteraction: false
	},
	slidesPerView: 3,
	breakpoints: {
		320: { slidesPerView: 1, spaceBetween: 10 },
		768: { slidesPerView: 2, spaceBetween:10 },
		992: { slidesPerView: 3, spaceBetween: 10},
		1920: { slidesPerView: 3, spaceBetween: 10}
	},
	pagination: {
	  el: '.swiper-pagination',
	  type: 'bullets',
	  clickable: true
	},
	navigation: {
	  nextEl: ".swiper-button-next",
	  prevEl: ".swiper-button-prev",
	},
  });