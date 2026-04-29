<?php 
require_once 'config/database.php';
include 'includes/header.php'; 
?>


    <!-- New Premium Hero Slider -->
    <section class="premium-hero">
        <div class="swiper mainHeroSwiper">
            <div class="swiper-wrapper">
                
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="hero-image" style="background-image: url('<?php echo BASE_URL; ?>assets/images/eklavya-hero-new.png');"></div>
                    <div class="hero-overlay"></div>
                    <div class="container hero-container">
                        <div class="hero-content">
                            <span class="hero-badge animate__animated animate__fadeInDown">Empowering Future Leaders</span>
                            <h1 class="hero-title animate__animated animate__fadeInLeft">EKALAVYA</h1>
                            <p class="hero-subtitle animate__animated animate__fadeInUp">Architecting India's future IITians and Doctors through world-class precision mentoring.</p>
                            <div class="hero-actions animate__animated animate__fadeInUp">
                                <a href="courses.php" class="btn btn-primary btn-lg rounded-pill shadow-lg">Our Programs</a>
                                <a href="scholarship.php" class="btn btn-outline-light btn-lg rounded-pill ms-md-3">Scholarship 2026</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="hero-image" style="background-image: url('<?php echo BASE_URL; ?>assets/images/neet-hero.png');"></div>
                    <div class="hero-overlay"></div>
                    <div class="container hero-container">
                        <div class="hero-content">
                            <span class="hero-badge animate__animated animate__fadeInDown">Medical Excellence</span>
                            <h1 class="hero-title animate__animated animate__fadeInLeft">NEET <br><span class="text-primary">DOMINANCE</span></h1>
                            <p class="hero-subtitle animate__animated animate__fadeInUp">Specialized biological analysis and chemical conceptualization for top-tier medical ranks.</p>
                            <div class="hero-actions animate__animated animate__fadeInUp">
                                <a href="courses.php" class="btn btn-primary btn-lg rounded-pill shadow-lg">NEET Programs</a>
                                <a href="contact.php" class="btn btn-outline-light btn-lg rounded-pill ms-md-3">Book Counseling</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="hero-image" style="background-image: url('<?php echo BASE_URL; ?>assets/images/jee-hero.png');"></div>
                    <div class="hero-overlay"></div>
                    <div class="container hero-container">
                        <div class="hero-content">
                            <span class="hero-badge animate__animated animate__fadeInDown">Engineering Mastery</span>
                            <h1 class="hero-title animate__animated animate__fadeInLeft">IIT-JEE <br><span class="text-primary">MASTERY</span></h1>
                            <p class="hero-subtitle animate__animated animate__fadeInUp">Advanced physics derivation and mathematical logic from India's finest IITian faculty.</p>
                            <div class="hero-actions animate__animated animate__fadeInUp">
                                <a href="courses.php" class="btn btn-primary btn-lg rounded-pill shadow-lg">JEE Programs</a>
                                <a href="test-series.php" class="btn btn-outline-light btn-lg rounded-pill ms-md-3">Explore AITS</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next d-none d-md-flex"></div>
            <div class="swiper-button-prev d-none d-md-flex"></div>
        </div>
    </section>



    <!-- Section 2: Premier Academic Verticals -->
    <section class="aurous-courses section-padding position-relative overflow-hidden" style="background-color: #F0F5FF;">
        <div class="blob-decorator" style="top: 20%; right: -10%; width: 400px; height: 400px;"></div>
        <div class="container">
            <div class="section-title text-center mb-5 pb-4">
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Academic Excellence</h6>
                <h2 class="fw-black" style="font-size: 1.6rem;">THE <span class="text-primary">Ekalavya</span> CURRICULUM</h2>
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
                                
                                <!-- Slide 1: JEE Advanced Result -->
                                <div class="swiper-slide p-4 p-lg-5 bg-white">
                                    <div class="row g-4 align-items-center h-100">
                                        <div class="col-md-5 text-center text-md-start">
                                            <div class="result-badge bg-primary-yellow text-dark d-inline-block px-3 py-1 rounded-pill fw-black mb-3 small">JEE ADVANCED 2026</div>
                                            <h2 class="display-3 fw-black text-secondary position-relative z-index-2 mb-0">SELECTIONS</h2>
                                            <h2 class="display-4 fw-black text-primary mb-3">CROSS 100</h2>
                                            <div class="featured-student-img">
                                                <img src="<?php echo BASE_URL; ?>assets/images/topper_arjun.jpg" alt="Topper" class="img-fluid rounded-4 shadow-lg" style="max-height: 180px;">
                                                <div class="mt-2">
                                                    <h6 class="mb-0 fw-bold">ARJUN MEHTA</h6>
                                                    <p class="text-primary mb-0 extra-small fw-bold">AIR 842 - IIT BOMBAY</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="toppers-wall-premium bg-aurous-gradient rounded-4 p-3 shadow-inner">
                                                <div class="row g-2">
                                                    <?php for($i=1; $i<=24; $i++): ?>
                                                    <div class="col-2">
                                                        <div class="bg-white rounded-1 p-1 text-center shadow-sm">
                                                            <div class="avatar-mini bg-light rounded-1 mb-1" style="height: 20px; overflow: hidden;"><i class="fas fa-user text-muted opacity-50" style="font-size: 0.6rem;"></i></div>
                                                            <div class="fw-black" style="font-size: 0.45rem;">AIR <?php echo rand(100, 5000); ?></div>
                                                        </div>
                                                    </div>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 2: JEE Dropper Batch -->
                                <div class="swiper-slide p-4 p-lg-5" style="background: #be1e2d;">
                                    <div class="row h-100 align-items-center">
                                        <div class="col-md-8 text-white">
                                            <h6 class="text-warning fw-bold mb-1">ONE YEAR. ONE COMEBACK.</h6>
                                            <h2 class="display-4 fw-black text-warning mb-0">JEE DROPPER</h2>
                                            <h2 class="display-3 fw-black text-white mb-3">BATCH 2026</h2>
                                            <div class="row g-2 mb-4">
                                                <div class="col-6"><div class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-warning small"></i> <span class="small fw-bold">Experienced Faculty</span></div></div>
                                                <div class="col-6"><div class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-warning small"></i> <span class="small fw-bold">Personal Attention</span></div></div>
                                                <div class="col-6"><div class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-warning small"></i> <span class="small fw-bold">Expert Interaction</span></div></div>
                                                <div class="col-6"><div class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-warning small"></i> <span class="small fw-bold">Doubt Solving Room</span></div></div>
                                            </div>
                                            <div class="bg-dark p-2 px-3 rounded-3 d-inline-block shadow-lg">
                                                <h6 class="mb-0 fw-black text-warning">BATCH STARTING: <span class="text-white">16th APRIL 2026</span></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-none d-md-block text-end">
                                            <img src="<?php echo BASE_URL; ?>assets/images/banner2.png" alt="Dropper Batch" class="img-fluid rounded-4 shadow-2xl" style="max-height: 250px;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 3: NEET Success -->
                                <div class="swiper-slide p-4 p-lg-5" style="background: #7a111b;">
                                    <div class="row h-100 align-items-center">
                                        <div class="col-md-7 text-white">
                                            <h4 class="fw-black mb-1">CRACK <span class="text-warning">NEET</span>, CONQUER <span class="text-warning">IIT-JEE</span></h4>
                                            <h2 class="display-2 fw-black text-white mb-0" style="line-height: 0.8;">NEET</h2>
                                            <h2 class="display-4 fw-black text-warning mb-4">के सिकंदर</h2>
                                            <div class="scholarship-tag bg-white text-dark p-2 px-4 rounded-pill d-inline-flex align-items-center gap-3 shadow-lg">
                                                <span class="fw-black text-danger small">APRE 2026</span>
                                                <div class="vr"></div>
                                                <span class="extra-small fw-bold">UP TO 100% SCHOLARSHIP</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <img src="<?php echo BASE_URL; ?>assets/images/banner1.png" alt="NEET Success" class="img-fluid rounded-4 shadow-lg" style="max-height: 250px;">
                                        </div>
                                    </div>
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
                <h2 class="display-3 fw-black">MEET OUR <span class="text-primary">STAR</span></h2>
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
