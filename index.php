<?php 
require_once 'config/database.php';
include 'includes/header.php'; 
?>


    <!-- Section 1: Home Banner Slider -->
    <section class="home-banner-slider">
        <div class="swiper mainHomeSwiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <a href="<?php echo BASE_URL; ?>scholarship">
                        <img src="<?php echo BASE_URL; ?>assets/images/home banner1.png" alt="Ekalavya Home Banner 1" class="banner-img">
                    </a>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <a href="<?php echo BASE_URL; ?>course-detail.php?slug=nurture-jee-11">
                        <img src="<?php echo BASE_URL; ?>assets/images/home banner4.png" alt="Ekalavya Home Banner 2" class="banner-img">
                    </a>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <a href="<?php echo BASE_URL; ?>course-detail.php?slug=seed-jee-9">
                        <img src="<?php echo BASE_URL; ?>assets/images/home banner3.png" alt="Ekalavya Home Banner 3" class="banner-img">
                    </a>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>




    <!-- Section 2: Premier Academic Verticals -->
    <section class="aurous-courses section-padding position-relative overflow-hidden" style="background-color: #F0F5FF;">
        <div class="blob-decorator" style="top: 20%; right: -10%; width: 400px; height: 400px;"></div>
        <div class="container">
            <div class="section-title text-center mb-5 pb-4">
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Academic Excellence</h6>
                <h2 class="fw-black" style="font-size: clamp(1.3rem, 4vw, 2.5rem); letter-spacing: -0.5px;">THE <span class="text-primary">Ekalavya</span> CURRICULUM</h2>
                <div class="title-accent mx-auto mt-4" style="width: 100px; height: 6px; background: var(--primary-yellow); border-radius: 10px;"></div>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- IIT-JEE Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="aurous-course-card h-100 d-flex flex-column text-center">
                        <div class="course-icon-aurous mb-4 position-relative mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <div class="icon-blob position-absolute top-50 start-50 translate-middle" style="background: rgba(108, 92, 231, 0.1); width: 100px; height: 100px; border-radius: 50%;"></div>
                            <i class="fas fa-atom fa-4x text-purple position-relative"></i>
                        </div>
                        <h3 class="fw-black mb-2 fs-2 course-title">IIT-JEE <small class="d-block text-muted mt-1 fw-normal" style="font-size: 1rem;">Elite Engineering Program</small></h3>
                        <p class="text-muted mb-4 fs-5 course-desc">Strategic physics-mathematics fusion designed for the toughest entrance exam on the planet.</p>
                        <div class="class-buttons d-flex flex-wrap gap-2 mb-4 mt-auto justify-content-center">
                            <span class="badge badge-premium">Class 11</span>
                            <span class="badge badge-premium">Class 12</span>
                            <span class="badge badge-premium">Repeaters</span>
                        </div>
                        <a href="courses.php?category=IIT-JEE" class="btn btn-aurous-gradient w-100 rounded-pill py-3 fw-bold fs-5">VIEW COURSE <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>

                <!-- NEET-UG Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="aurous-course-card h-100 d-flex flex-column text-center">
                        <div class="course-icon-aurous mb-4 position-relative mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <div class="icon-blob position-absolute top-50 start-50 translate-middle" style="background: rgba(253, 121, 168, 0.1); width: 100px; height: 100px; border-radius: 50%;"></div>
                            <i class="fas fa-dna fa-4x text-pink position-relative"></i>
                        </div>
                        <h3 class="fw-black mb-2 fs-2 course-title">NEET-UG <small class="d-block text-muted mt-1 fw-normal" style="font-size: 1rem;">Premier Medical Program</small></h3>
                        <p class="text-muted mb-4 fs-5 course-desc">Visual conceptual biology and reactive chemistry modules for top-tier medical college placements.</p>
                        <div class="class-buttons d-flex flex-wrap gap-2 mb-4 mt-auto justify-content-center">
                            <span class="badge badge-premium">Class 11</span>
                            <span class="badge badge-premium">Class 12</span>
                            <span class="badge badge-premium">Dropper</span>
                        </div>
                        <a href="courses.php?category=NEET" class="btn btn-aurous-gradient w-100 rounded-pill py-3 fw-bold fs-5">VIEW COURSE <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>

                <!-- School Prep Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="aurous-course-card h-100 d-flex flex-column text-center">
                        <div class="course-icon-aurous mb-4 position-relative mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <div class="icon-blob position-absolute top-50 start-50 translate-middle" style="background: rgba(0, 206, 201, 0.1); width: 100px; height: 100px; border-radius: 50%;"></div>
                            <i class="fas fa-vial fa-4x text-cyan position-relative"></i>
                        </div>
                        <h3 class="fw-black mb-2 fs-2 course-title">SCHOOL PREP <small class="d-block text-muted mt-1 fw-normal" style="font-size: 1rem;">Junior Scholars Program</small></h3>
                        <p class="text-muted mb-4 fs-5 course-desc">Nurturing curiosity into competency for NTSE, Olympiads, and early competitive edge.</p>
                        <div class="class-buttons d-flex flex-wrap gap-2 mb-4 mt-auto justify-content-center">
                            <span class="badge badge-premium">Class 7</span>
                            <span class="badge badge-premium">Class 8</span>
                            <span class="badge badge-premium">Class 9</span>
                            <span class="badge badge-premium">Class 10</span>
                        </div>
                        <a href="courses.php?category=School Prep (Class 7th-12th)" class="btn btn-aurous-gradient w-100 rounded-pill py-3 fw-bold fs-5">VIEW COURSE <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Success & Enquiry Banner Section (Optimized Landscape Dimensions) -->
    <section class="success-enquiry-banner py-5 my-4 bg-white overflow-hidden">
        <div class="container">
            <div class="banner-glass-wrapper rounded-5 shadow-heavy border border-light p-0 overflow-hidden bg-white" style="min-height: 500px;">
                <div class="row g-0 align-items-stretch h-100">
                    
                    <!-- Left: Dynamic Slider (col-lg-8) -->
                    <div class="col-lg-8 position-relative border-end border-light d-flex flex-column">
                        <div class="swiper enquirySlider w-100 flex-grow-1">
                            <div class="swiper-wrapper">
                                
                                <!-- Slide 1 -->
                                <div class="swiper-slide">
                                    <img src="<?php echo BASE_URL; ?>assets/images/form image1.png" alt="Ekalavya Form 1" class="w-100">
                                </div>

                                <!-- Slide 2 -->
                                <div class="swiper-slide">
                                    <img src="<?php echo BASE_URL; ?>assets/images/form image2.png" alt="Ekalavya Form 2" class="w-100">
                                </div>

                                <!-- Slide 3 -->
                                <div class="swiper-slide">
                                    <img src="<?php echo BASE_URL; ?>assets/images/form image3.png" alt="Ekalavya Form 3" class="w-100">
                                </div>


                            </div>
                            <div class="swiper-pagination enquiry-pagination"></div>
                        </div>
                    </div>

                    <!-- Right: Static Compact Form (col-lg-4) -->
                    <div class="col-lg-4 col-md-12 bg-white p-4 p-lg-5 d-flex align-items-center">
                        <div class="booking-form-wrap w-100">
                            <h4 class="fw-black text-secondary mb-1">Book Your <span class="text-primary">Free Session</span></h4>
                            <p class="text-muted small mb-3">Get a callback from our mentors.</p>
                            
                            <form action="<?php echo BASE_URL; ?>process-contact.php" method="POST" class="vstack gap-2">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control-minimal p-2 px-3 rounded-2 w-100 border bg-light shadow-sm small" placeholder="Student Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control-minimal p-2 px-3 rounded-2 w-100 border bg-light shadow-sm small" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-control-minimal p-2 px-3 rounded-2 w-100 border bg-light shadow-sm small" placeholder="Mobile Number" required>
                                </div>

                                <div class="form-group">
                                    <select name="subject" class="form-select-minimal p-2 px-3 rounded-2 w-100 border bg-light shadow-sm text-muted small" required>
                                        <option value="" disabled selected>Select Course</option>
                                        <option value="IIT-JEE">IIT-JEE (Mains & Advanced)</option>
                                        <option value="NEET">NEET-UG Medical</option>
                                        <option value="School Prep (Class 7th)">School Prep (Class 7th)</option>
                                        <option value="School Prep (Class 8th)">School Prep (Class 8th)</option>
                                        <option value="School Prep (Class 9th)">School Prep (Class 9th)</option>
                                        <option value="School Prep (Class 10th)">School Prep (Class 10th)</option>
                                        <option value="School Prep (Class 11th)">School Prep (Class 11th)</option>
                                        <option value="School Prep (Class 12th)">School Prep (Class 12th)</option>
                                        <option value="Other">Other Query</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" class="form-control-minimal p-2 px-3 rounded-2 w-100 border bg-light shadow-sm small" rows="2" placeholder="Questions? (Optional)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-aurous-gradient w-100 py-2 rounded-pill fw-bold text-uppercase letter-spacing-1 shadow-lg scale-hover mt-1 small">GET STARTED <i class="fas fa-arrow-right ms-2"></i></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Section: Scholarship Promotional Impact (Inspired by Mockup) -->
    <section class="scholarship-promo-section py-6 position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);">
        <div class="blob-decorator" style="top: 0; left: 0; width: 600px; height: 600px; opacity: 0.15; background: radial-gradient(circle, var(--primary-orange) 0%, transparent 70%);"></div>
        <div class="container position-relative z-1">
            <div class="row align-items-center">
                <!-- Left Column: Text and Card -->
                <div class="col-lg-6 text-center text-lg-start order-1">
                    <h2 class="text-white fw-black mb-3" style="font-size: clamp(1.8rem, 4vw, 3rem); line-height: 1.1;">
                        Ekalavya's <br>Story Began with a <span class="text-primary-glow">Bold Vision</span>
                    </h2>
                    
                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-2 gap-md-3 mb-4">
                        <span class="badge-glass"><i class="fas fa-graduation-cap me-2 text-primary-yellow"></i> Merit-Based Scholarships</span>
                        <span class="badge-glass"><i class="fas fa-sack-dollar me-2 text-primary-yellow"></i> Up to 100% Off</span>
                    </div>

                    <div class="scholarship-hero-card rounded-5 shadow-2xl overflow-hidden mb-4 ms-lg-0 mx-auto" style="max-width: 650px;">
                        <div class="row g-0 align-items-stretch">
                            <!-- Left: ESAT Branding -->
                            <div class="col-md-6 p-4 bg-white border-end d-flex flex-column justify-content-center">
                                <div class="esat-branding mb-3">
                                    <h2 class="fw-black text-danger mb-0">ESAT 2026</h2>
                                    <div class="fw-bold small text-dark tracking-tighter">EKALAVYA SCHOLARSHIP TEST</div>
                                </div>
                                <div class="promo-ribbon-red py-2 px-2 text-white fw-bold text-center" style="font-size: 0.65rem; line-height: 1.2;">
                                    CENTRAL INDIA'S MOST AWAITED SCHOLARSHIP PROGRAM
                                </div>
                            </div>
                            <!-- Right: Scholarship Amount -->
                            <div class="col-md-6 p-4 bg-gradient-light d-flex flex-column justify-content-center">
                                <h6 class="small fw-bold text-muted mb-2">Grab A Chance To Win</h6>
                                <div class="scholarship-amount-pill mb-3">
                                    <span class="display-5 fw-black text-danger">100%</span>
                                    <span class="d-block fw-black text-dark fs-6">SCHOLARSHIP</span>
                                </div>
                                <div class="class-eligibility-box py-1 px-3 bg-orange text-white fw-bold rounded-1 d-inline-block small">
                                    FOR CLASS 7<sup>th</sup> TO 12<sup>th</sup>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cta-area">
                        <a href="<?php echo BASE_URL; ?>scholarship.php" class="btn btn-register-scholarship rounded-pill px-4 py-3 fw-bold shadow-glow scale-hover">
                            🚀 Register & Claim Scholarship
                        </a>
                    </div>
                </div>

                <!-- Right Column: Video Slider -->
                <div class="col-lg-6 mb-5 mb-lg-0 order-2 mt-5 mt-lg-0">
                    <div class="swiper scholarshipVideoSwiper rounded-5 overflow-hidden shadow-heavy">
                        <div class="swiper-wrapper">
                            <!-- Video 1 -->
                            <div class="swiper-slide">
                                <div class="ratio ratio-16x9">
                                    <video controls class="rounded-5 w-100 h-100" style="object-fit: cover; background: #000;">
                                        <source src="<?php echo BASE_URL; ?>assets/images/SAGAR KUMAR (1).mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <!-- Video 2 -->
                            <div class="swiper-slide">
                                <div class="ratio ratio-16x9">
                                    <video controls class="rounded-5 w-100 h-100" style="object-fit: cover; background: #000;">
                                        <source src="<?php echo BASE_URL; ?>assets/images/Your paragraph text (2).mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination video-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Why Ekalavya (Immersive Dark Experience) -->
    <section class="section-padding position-relative" id="why-choose" style="background: #0D122B; color: white;">
        <div class="blob-decorator" style="top: -20%; left: 0%; opacity: 0.1;"></div>
        <div class="container">
            <div class="row align-items-end mb-5 pb-4">
                <div class="col-lg-7">
                    <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Institutional Pillars</h6>
                    <h2 class="display-3 fw-black text-white">THE ACADEMIC <br><span class="text-primary">DIFFERENCE</span></h2>
                </div>
                <div class="col-lg-5">
                    <p class="opacity-50 fs-5 mb-3">We've dismantled the traditional coaching factory model to build a precision mentoring ecosystem that delivers results, not just modules.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <?php 
                $features = [
                    ['icon' => 'user-tie', 'title' => 'IITian Core Faculty', 'desc' => 'Directed by Amit Ranjan (IIT Roorkee), our core team consists of national-level subject matter authorities.'],
                    ['icon' => 'microchip', 'title' => 'Visual Learning Ecosystem', 'desc' => 'High-retention 3D visual modules that make abstract concepts in Physics and Organic Chemistry intuitive.'],
                    ['icon' => 'satellite-dish', 'title' => 'Digital Backbone', 'desc' => 'Real-time performance analytics and live recorded backups for every single classroom interaction.'],
                    ['icon' => 'shield-check', 'title' => 'Rigorous Testing', 'desc' => 'Our AITS (All India Test Series) simulates the actual national exam environment with surgical precision.'],
                    ['icon' => 'brain', 'title' => 'Psychological Mentoring', 'desc' => 'Stress management and motivation sessions to keep students peaks when it matters most.'],
                    ['icon' => 'history', 'title' => 'Proven Success Track', 'desc' => 'A decade of consistent national ranks across IIT-JEE (Advanced) and NEET (UG) examinations.']
                ];
                foreach($features as $f): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card border-white border-opacity-10" style="background: rgba(255,255,255,0.03);">
                        <div class="choose-icon-refined bg-primary-yellow text-dark"><i class="fas fa-<?php echo $f['icon']; ?>"></i></div>
                        <h4 class="fw-bold mb-3 text-white"><?php echo $f['title']; ?></h4>
                        <p class="opacity-50 small mb-0"><?php echo $f['desc']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    




    <!-- Section: Campus Gallery Marquee (Dynamic Showcase) -->
    <section class="gallery-marquee-section py-6 overflow-hidden" style="background: #f8faff;">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-2">Life at Ekalavya</h6>
                <h2 class="fw-black" style="font-size: clamp(1.5rem, 5vw, 3rem);">CAMPUS <span class="text-primary">GALLERY</span></h2>
                <div class="title-accent mx-auto mt-3" style="width: 80px; height: 5px; background: var(--primary-yellow); border-radius: 10px;"></div>
            </div>
        </div>
        
        <div class="marquee-outer position-relative">
            <!-- Gradient Overlays for smooth edges -->
            <div class="marquee-overlay left"></div>
            <div class="marquee-overlay right"></div>

            <div class="marquee-track">
                <div class="marquee-scroll-container">
                    <?php 
                    $gallery_images = ['img.png', 'img1.jpg', 'img3.png', 'bench1.jpeg', 'bench2.jpeg', 'bench3.jpeg'];
                    // Loop twice for seamless transition
                    for($i=0; $i<2; $i++):
                        foreach($gallery_images as $img): ?>
                        <div class="gallery-card">
                            <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $img; ?>" alt="Ekalavya Gallery">
                        </div>
                    <?php endforeach; endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <style>
    .marquee-outer {
        padding: 20px 0;
        width: 100%;
    }
    .marquee-track {
        display: flex;
        overflow: hidden;
        user-select: none;
    }
    .marquee-scroll-container {
        flex-shrink: 0;
        display: flex;
        gap: 25px;
        counter-reset: item;
        justify-content: space-around;
        min-width: 100%;
        animation: scrollRightToLeft 40s linear infinite;
    }
    .gallery-card {
        flex: 0 0 auto;
        width: 380px;
        height: 520px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(10, 31, 68, 0.15);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #fff;
        position: relative;
    }
    .gallery-card img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .gallery-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(10, 31, 68, 0.2);
        border-color: var(--primary-color);
    }
    .marquee-overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 150px;
        z-index: 2;
        pointer-events: none;
    }
    .marquee-overlay.left {
        left: 0;
        background: linear-gradient(to right, #f8faff, transparent);
    }
    .marquee-overlay.right {
        right: 0;
        background: linear-gradient(to left, #f8faff, transparent);
    }

    @keyframes scrollRightToLeft {
        from { transform: translateX(0); }
        to { transform: translateX(calc(-50% - 12.5px)); } /* Adjusted for gap */
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .gallery-card {
            width: 300px;
            height: 420px;
            border-radius: 15px;
        }
    }
    </style>

    <!-- Section: CTA (Unconventional Impact) -->
    <section class="section-padding">
        <div class="container">
            <div class="cta-banner-premium rounded-5 overflow-hidden p-5 text-center position-relative shadow-heavy" style="background: var(--navy-gradient); min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="blob-decorator" style="top: -20%; right: -20%; filter: blur(100px); background: radial-gradient(circle, rgba(255, 203, 5, 0.2) 0%, transparent 70%);"></div>
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Gateway to Success 2026</h6>
                <h2 class="display-3 fw-black text-white mb-4">READY TO TRANSFORM <br>YOUR <span class="text-primary">TRAJECTORY?</span></h2>
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <a href="contact.php" class="btn btn-aurous-gradient btn-lg rounded-pill px-5 py-3 fw-bold shadow-glow">BOOK FREE COUNSELING</a>
                    <a href="tel:9934244522" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold"><i class="fas fa-phone-alt fa-flip-horizontal me-2"></i> CALL ADMISSIONS</a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
