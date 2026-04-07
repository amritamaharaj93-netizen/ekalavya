/* assets/js/script.js */
(function() {
    console.log('Eklavya Academy JS Initializing...');

    function initScripts() {
        // Initialize Hero Carousel
        var heroCarouselEl = document.getElementById('heroCarousel');
        if (heroCarouselEl && typeof bootstrap !== 'undefined') {
            try {
                // Ensure we don't double-initialize
                var existingCarousel = bootstrap.Carousel.getInstance(heroCarouselEl);
                if (!existingCarousel) {
                    var heroCarousel = new bootstrap.Carousel(heroCarouselEl, {
                        interval: 5000,
                        ride: 'carousel',
                        pause: false
                    });

                    // Reactivate CSS animations on slide transition
                    heroCarouselEl.addEventListener('slide.bs.carousel', function (e) {
                        var nextSlide = e.relatedTarget;
                        if (!nextSlide) return;
                        var animatedElements = nextSlide.querySelectorAll('.rev-anim-left');
                        
                        animatedElements.forEach(function(el) {
                            var originalAnimation = window.getComputedStyle(el).animation;
                            el.style.animation = 'none';
                            void el.offsetWidth; // Trigger reflow
                            el.style.animation = null;
                        });
                    });

                    heroCarousel.cycle();
                }
            } catch(e) {
                console.error("Hero Carousel Init Error: ", e);
            }
        }

        // Initialize Wall of Fame (Toppers) Slider
        if (document.querySelector('.toppersSwiper') && typeof Swiper !== 'undefined') {
            try {
                if (!document.querySelector('.toppersSwiper').swiper) {
                    new Swiper('.toppersSwiper', {
                        slidesPerView: 1,
                        spaceBetween: 25,
                        loop: true,
                        autoplay: { delay: 3500, disableOnInteraction: false },
                        pagination: { el: '.toppersSwiper .swiper-pagination', clickable: true },
                        breakpoints: {
                            576: { slidesPerView: 2 },
                            992: { slidesPerView: 3 },
                            1200: { slidesPerView: 4 }
                        }
                    });
                }
            } catch(e) { console.error("Toppers Swiper Error: ", e); }
        }

        // Initialize Testimonial Slider
        if (document.querySelector('.testimonialSwiper') && typeof Swiper !== 'undefined') {
            try {
                if (!document.querySelector('.testimonialSwiper').swiper) {
                    new Swiper('.testimonialSwiper', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        autoplay: { delay: 5000 },
                        navigation: {
                            nextEl: '.swiper-button-next-test',
                            prevEl: '.swiper-button-prev-test',
                        },
                        breakpoints: {
                            768: { slidesPerView: 2 }
                        }
                    });
                }
            } catch(e) { console.error("Testimonial Swiper Error: ", e); }
        }
    }

    // Robust Initialization: fire immediately if DOM is ready, otherwise listen for events.
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(initScripts, 1);
    } else {
        document.addEventListener('DOMContentLoaded', initScripts);
        window.addEventListener('load', initScripts);
    }
})();