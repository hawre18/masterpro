$(document).ready(function () {
  $("#owl-demo").owlCarousel({
    navigation: true, // Show next and prev buttons

    slideSpeed: 300,
    paginationSpeed: 400,
    items: 1,
    itemsDesktop: false,
    itemsDesktopSmall: false,
    itemsTablet: false,
    itemsMobile: false,
    nav:true,
    navText: ["<span class='fa fa-angle-left'></span>","<span class='fa fa-angle-right'></span>"],
  });
});

// const owlPrev = document.querySelector(".section-4 .owl-prev span")
// const owlNext = document.querySelector(".section-4 .owl-next span")

// console.log(owlNext)