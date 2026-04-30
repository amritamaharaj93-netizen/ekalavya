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
                    <a href="<?php echo BASE_URL; ?>scholarship.php">
                        <img src="<?php echo BASE_URL; ?>assets/images/home banner1.png" alt="Ekalavya Home Banner 1" class="banner-img">
                    </a>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <a href="<?php echo BASE_URL; ?>course-detail.php?slug=nurture-neet-11">
                        <img src="<?php echo BASE_URL; ?>assets/images/home banner4.png" alt="Ekalavya Home Banner 4" class="banner-img">
                    </a>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <a href="<?php echo BASE_URL; ?>course-detail.php?slug=nurture-jee-11">
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
                    <div class="aurous-course-card h-100 d-flex flex-column">
                        <div class="course-icon-aurous mb-4 position-relative">
                            <div class="icon-blob" style="background: rgba(108, 92, 231, 0.1);"></div>
                            <i class="fas fa-atom fa-4x text-purple rev-anim-float position-relative"></i>
                        </div>
                        <h3 class="fw-black mb-2 fs-2 course-title">IIT-JEE <small class="d-block text-muted mt-1 fw-normal" style="font-size: 1rem;">Elite Engineering Program</small></h3>
                        <p class="text-muted mb-4 fs-5 course-desc">Strategic physics-mathematics fusion designed for the toughest entrance exam on the planet.</p>
                        <div class="class-buttons d-flex flex-wrap gap-2 mb-4 mt-auto">
                            <span class="badge badge-premium">Class 11</span>
                            <span class="badge badge-premium">Class 12</span>
                            <span class="badge badge-premium">Repeaters</span>
                        </div>
                        <a href="courses.php?category=IIT-JEE" class="btn btn-aurous-gradient w-100 rounded-pill py-3 fw-bold fs-5">VIEW COURSE <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>

                <!-- NEET-UG Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="aurous-course-card h-100 d-flex flex-column">
                        <div class="course-icon-aurous mb-4 position-relative">
                            <div class="icon-blob" style="background: rgba(253, 121, 168, 0.1);"></div>
                            <i class="fas fa-dna fa-4x text-pink rev-anim-float position-relative" style="animation-delay: 1s;"></i>
                        </div>
                        <h3 class="fw-black mb-2 fs-2 course-title">NEET-UG <small class="d-block text-muted mt-1 fw-normal" style="font-size: 1rem;">Premier Medical Program</small></h3>
                        <p class="text-muted mb-4 fs-5 course-desc">Visual conceptual biology and reactive chemistry modules for top-tier medical college placements.</p>
                        <div class="class-buttons d-flex flex-wrap gap-2 mb-4 mt-auto">
                            <span class="badge badge-premium">Class 11</span>
                            <span class="badge badge-premium">Class 12</span>
                            <span class="badge badge-premium">Dropper</span>
                        </div>
                        <a href="courses.php?category=NEET" class="btn btn-aurous-gradient w-100 rounded-pill py-3 fw-bold fs-5">VIEW COURSE <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>

                <!-- School Prep Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="aurous-course-card h-100 d-flex flex-column">
                        <div class="course-icon-aurous mb-4 position-relative">
                            <div class="icon-blob" style="background: rgba(0, 206, 201, 0.1);"></div>
                            <i class="fas fa-vial fa-4x text-cyan rev-anim-float position-relative" style="animation-delay: 2s;"></i>
                        </div>
                        <h3 class="fw-black mb-2 fs-2 course-title">SCHOOL PREP <small class="d-block text-muted mt-1 fw-normal" style="font-size: 1rem;">Junior Scholars Program</small></h3>
                        <p class="text-muted mb-4 fs-5 course-desc">Nurturing curiosity into competency for NTSE, Olympiads, and early competitive edge.</p>
                        <div class="class-buttons d-flex flex-wrap gap-2 mb-4 mt-auto">
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
                                    <img src="<?php echo BASE_URL; ?>assets/images/form image1.png" alt="Ekalavya Form 1" class="w-100 h-100" style="object-fit: cover;">
                                </div>

                                <!-- Slide 2 -->
                                <div class="swiper-slide">
                                    <img src="<?php echo BASE_URL; ?>assets/images/form image2.png" alt="Ekalavya Form 2" class="w-100 h-100" style="object-fit: cover;">
                                </div>

                                <!-- Slide 3 -->
                                <div class="swiper-slide">
                                    <img src="<?php echo BASE_URL; ?>assets/images/form image3.png" alt="Ekalavya Form 3" class="w-100 h-100" style="object-fit: cover;">
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
                                        <option value="Foundation">Foundation (7th-10th)</option>
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
    


    <!-- Section: Testimonials (Success Stories Carousel Look) -->
    <section class="section-padding bg-light position-relative">
        <div class="container">
            <div class="section-title text-center mb-5 pb-4">
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Wall of Champions</h6>
                <h2 class="fw-black" style="font-size: clamp(1.5rem, 6vw, 4.5rem); letter-spacing: -1.5px;">MEET OUR <span class="text-primary">STAR</span></h2>
            </div>
            
            <div class="row g-4 justify-content-center">
                <?php 
                $testimonials = [
                    ['name' => 'Rahul Verma', 'rank' => 'JEE Advanced AIR 240', 'initials' => 'RV', 'text' => 'The competitive environment and micro-analysis of every test helped me bridge my weak areas effectively. Amit Sir\'s Physics classes are legendary.'],
                    ['name' => 'Priya Singh', 'rank' => 'NEET Score 685/720', 'initials' => 'PS', 'text' => 'Joining Ekalavya was the best decision for my NEET prep. The personal attention and doubt-clearing sessions are truly exceptional.'],
                    ['name' => 'Ankit Kumar', 'rank' => 'IIT Bombay (CSE)', 'initials' => 'AK', 'text' => 'The study material is so intuitive and structured. It made complex concepts easy to grasp. The faculty doesn\'t just teach; they mentor you.'],
                    ['name' => 'Sneha Kapoor', 'rank' => 'NEET Score 690/720', 'initials' => 'SK', 'text' => 'The AITS test series at Ekalavya is the most accurate simulation of the actual NEET exam. It built my confidence and timing perfectly.']
                ];
                foreach($testimonials as $t): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="modern-testimonial-card h-100 bg-white">
                        <div class="testimonial-rating mb-4 text-primary"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="testimonial-text mb-4">"<?php echo $t['text']; ?>"</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="avatar-circle me-3 bg-dark-navy text-primary fw-bold d-flex align-items-center justify-content-center rounded-circle" style="width:55px; height:55px; border: 2px solid var(--primary-orange); font-size: 1.2rem;"><?php echo $t['initials']; ?></div>
                            <div class="author-info">
                                <h5 class="mb-0 fw-bold testimonial-author-name"><?php echo $t['name']; ?></h5>
                                <p class="mb-0 fw-bold testimonial-author-rank"><?php echo $t['rank']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Section: CTA (Unconventional Impact) -->
    <section class="section-padding">
        <div class="container">
            <div class="cta-banner-premium rounded-5 overflow-hidden p-5 text-center position-relative shadow-heavy" style="background: var(--navy-gradient); min-height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="blob-decorator" style="top: -20%; right: -20%; filter: blur(100px); background: radial-gradient(circle, rgba(255, 203, 5, 0.2) 0%, transparent 70%);"></div>
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Gateway to Success 2026</h6>
                <h2 class="display-3 fw-black text-white mb-4">READY TO TRANSFORM <br>YOUR <span class="text-primary">TRAJECTORY?</span></h2>
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <a href="contact.php" class="btn btn-aurous-gradient btn-lg rounded-pill px-5 py-3 fw-bold shadow-glow">BOOK FREE COUNSELING</a>
                    <a href="tel:9934244522" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold"><i class="fas fa-phone-alt me-2"></i> CALL ADMISSIONS</a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
