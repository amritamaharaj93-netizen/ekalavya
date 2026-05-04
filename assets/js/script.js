/* assets/js/script.js */
(function() {
    console.log('Eklavya Academy JS Initializing...');

    function initScripts() {

        // Initialize Home Banner Slider (Index Page)
        if (document.querySelector('.mainHomeSwiper') && typeof Swiper !== 'undefined') {
            try {
                if (!document.querySelector('.mainHomeSwiper').swiper) {
                    new Swiper('.mainHomeSwiper', {
                        loop: true,
                        speed: 1000,
                        effect: 'slide',
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.mainHomeSwiper .swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.mainHomeSwiper .swiper-button-next',
                            prevEl: '.mainHomeSwiper .swiper-button-prev',
                        },
                    });
                }
            } catch(e) { console.error("Home Slider Error: ", e); }
        }


        // Initialize Enquiry Promo Slider
        if (document.querySelector('.enquirySlider') && typeof Swiper !== 'undefined') {
            try {
                if (!document.querySelector('.enquirySlider').swiper) {
                    new Swiper('.enquirySlider', {
                        loop: true,
                        speed: 1000,
                        effect: 'fade',
                        fadeEffect: { crossFade: true },
                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.enquiry-pagination',
                            clickable: true,
                        },
                    });
                }
            } catch(e) { console.error("Enquiry Swiper Error: ", e); }
        }
        // Initialize Scholarship Video Slider
        if (document.querySelector('.scholarshipVideoSwiper') && typeof Swiper !== 'undefined') {
            try {
                if (!document.querySelector('.scholarshipVideoSwiper').swiper) {
                    const videoSwiper = new Swiper('.scholarshipVideoSwiper', {
                        loop: true,
                        speed: 1000,
                        autoplay: {
                            delay: 8000,
                            disableOnInteraction: true,
                        },
                        pagination: {
                            el: '.video-pagination',
                            clickable: true,
                        },
                    });

                    // Fix: Stop autoplay when video starts playing
                    const videos = document.querySelectorAll('.scholarshipVideoSwiper video');
                    videos.forEach(video => {
                        video.addEventListener('play', () => {
                            videoSwiper.autoplay.stop();
                        });
                        video.addEventListener('pause', () => {
                            videoSwiper.autoplay.start();
                        });
                        video.addEventListener('ended', () => {
                            videoSwiper.autoplay.start();
                        });
                    });
                }
            } catch(e) { console.error("Scholarship Swiper Error: ", e); }
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

        // Initialize Faculty Slider (About Page)
        if (document.querySelector('.facultySwiper') && typeof Swiper !== 'undefined') {
            try {
                if (!document.querySelector('.facultySwiper').swiper) {
                    new Swiper('.facultySwiper', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        autoplay: { delay: 4000, disableOnInteraction: false },
                        pagination: { el: '.facultySwiper .swiper-pagination', clickable: true },
                        breakpoints: {
                            576: { slidesPerView: 2 },
                            992: { slidesPerView: 3 },
                            1200: { slidesPerView: 4 }
                        }
                    });
                }
            } catch(e) { console.error("Faculty Swiper Error: ", e); }
        }

        // Auto-show Registration Modal after 5 seconds
        setTimeout(function() {
            var registrationModal = document.getElementById('registrationPopupModal');
            if (registrationModal && !sessionStorage.getItem('registrationModalShown')) {
                // Ensure bootstrap is available
                if (typeof bootstrap !== 'undefined') {
                    var modalInstance = new bootstrap.Modal(registrationModal);
                    modalInstance.show();
                    sessionStorage.setItem('registrationModalShown', 'true');
                }
            }
        }, 5000);
    }

    // Robust Initialization: fire immediately if DOM is ready, otherwise listen for events.
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(initScripts, 1);
    } else {
        document.addEventListener('DOMContentLoaded', initScripts);
        window.addEventListener('load', initScripts);
    }
})();