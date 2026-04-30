<?php include 'includes/header.php'; ?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('assets/images/about_header.png') center/cover no-repeat; padding: clamp(40px, 8vh, 100px) 0 !important;">
    <div class="container text-center text-white">
        <h1 class="fw-black mb-0" style="font-size: clamp(2.2rem, 10vw, 4.5rem); line-height: 1.1;">OUR <span class="text-primary d-block d-md-inline">LEGACY</span></h1>
        <div class="breadcrumb-wrap justify-content-center mt-3">
            <a href="<?php echo BASE_URL; ?>" class="text-white text-decoration-none opacity-75">Home</a>
            <span class="breadcrumb-separator px-2 opacity-50">/</span>
            <span class="opacity-75">Institutional Profile</span>
        </div>
    </div>
</section>

<!-- Impact Stats Bar -->
<section class="stats-premium">
    <div class="container">
        <div class="stats-glass-container rounded-5 p-4 p-lg-5 d-flex flex-wrap justify-content-around gap-4">
            <div class="stat-glass-card text-center px-4 py-3">
                <h2 class="fw-black mb-1 text-white">18+</h2>
                <p class="text-white-50 mb-0 small fw-bold text-uppercase">Years Experience</p>
            </div>
            <div class="stat-glass-card text-center px-4 py-3">
                <h2 class="fw-black mb-1 text-white">500+</h2>
                <p class="text-white-50 mb-0 small fw-bold text-uppercase">IITians & Doctors</p>
            </div>
            <div class="stat-glass-card text-center px-4 py-3">
                <h2 class="fw-black mb-1 text-white">5000+</h2>
                <p class="text-white-50 mb-0 small fw-bold text-uppercase">Students Mentored</p>
            </div>
            <div class="stat-glass-card text-center px-4 py-3">
                <h2 class="fw-black mb-1 text-white">2</h2>
                <p class="text-white-50 mb-0 small fw-bold text-uppercase">Campus Locations</p>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission (High-Fidelity Glass Cards) -->
<section class="vision-mission py-6 bg-white" id="vision">
    <div class="container container-1440">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="vision-card p-5 rounded-5 shadow-2xl bg-orange-soft border-0 h-100 position-relative overflow-hidden transition-all hover-scale-102">
                    <i class="fas fa-eye position-absolute top-0 end-0 opacity-10 m-4" style="font-size: 150px;"></i>
                    <h3 class="fw-black text-primary mb-4">MISSION</h3>
                    <p class="text-dark opacity-75 lead">To democratize high-end competitive education by bridging the gap between talent and opportunity through scientific pedagogy and unshakeable mentorship.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="vision-card p-5 rounded-5 shadow-2xl bg-secondary border-0 h-100 position-relative overflow-hidden transition-all hover-scale-102 text-white">
                    <i class="fas fa-bullseye position-absolute top-0 end-0 opacity-10 m-4" style="font-size: 150px;"></i>
                    <h3 class="fw-black text-white mb-4">VISION</h3>
                    <p class="text-white opacity-75 lead">To become the national benchmark in result-oriented education, where every student's potential is mathematically mapped to their maximum rank achievable.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Director's Profile (High-Impact Editorial Layout) -->
<section class="director-profile py-6 bg-light" id="director">
    <div class="container container-1440">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="director-visual position-relative">
                    <img src="assets/images/amit-sir.png" alt="Director Amit Kumar" class="img-fluid rounded-5 shadow-2xl border border-white border-5 transform-hover scale-105">
                    <div class="director-badge position-absolute bottom-0 end-0 bg-primary text-white p-4 rounded-4 shadow-lg translate-middle-y">
                        <h5 class="fw-black mb-0 text-white">AMIT KUMAR</h5>
                        <p class="small mb-0 text-white opacity-75">Physics Expert | B.Tech NITK</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <h2 class="display-5 fw-black mb-4">The Architect's <span class="text-primary">Vision</span></h2>
                <p class="lead text-muted mb-4 italic">"True coaching is not about dumping information into student's minds; it's about lighting the fire of curiosity and discipline. At Ekalavya, we build character first, and the results follow naturally."</p>
                <div class="director-meta mb-5">
                    <div class="row g-3">
                        <div class="col-md-6 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-2"></i> 18+ Years Pedagogy Experience</div>
                        <div class="col-md-6 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-2"></i> Produced 500+ IITians & Doctors</div>
                        <div class="col-md-6 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-2"></i> Expert in Micro-Mechanics</div>
                        <div class="col-md-6 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-2"></i> Motivational Mentor</div>
                    </div>
                </div>
                <a href="contact" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow-lg">Work With Amit Sir</a>
            </div>
        </div>
    </div>
</section>

<!-- Core Faculty Section (Dynamic Slider) -->
<section class="faculty-section py-6 bg-white" id="faculty">
    <div class="container-fluid px-lg-5">
        <div class="section-title text-center mb-6">
            <h2 class="fw-black">CHAMPION <span class="text-primary">MENTORS</span></h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">A handpicked team of senior IITians and medical scholars dedicated to engineering your academic success.</p>
            <div class="title-accent mx-auto mt-3"></div>
        </div>
        
        <div class="swiper facultySwiper pb-5">
            <div class="swiper-wrapper">
                <!-- Faculty 1 -->
                <div class="swiper-slide h-auto">
                    <div class="faculty-card p-5 bg-light rounded-5 text-center border-0 transition-all hover-translate-y h-100 shadow-sm">
                        <div class="faculty-avatar mb-4 mx-auto shadow-lg border border-white border-4 rounded-circle overflow-hidden" style="width:140px; height:140px;">
                            <img src="assets/images/logo.png" class="img-fluid grayscale opacity-25 h-100 w-100 object-fit-cover" alt="Faculty">
                        </div>
                        <h5 class="fw-black mb-1">M.K. SHARMA</h5>
                        <p class="text-primary small fw-bold text-uppercase mb-3 tracking-wider">Mathematics | IIT Delhi</p>
                        <hr class="my-3 opacity-10 mx-auto w-25">
                        <p class="text-muted small mb-0 px-2">Specialist in Calculus and Coordinate Geometry with 12+ years of expertise in ranking students.</p>
                    </div>
                </div>

                <!-- Faculty 2 -->
                <div class="swiper-slide h-auto">
                    <div class="faculty-card p-5 bg-light rounded-5 text-center border-0 transition-all hover-translate-y h-100 shadow-sm">
                        <div class="faculty-avatar mb-4 mx-auto shadow-lg border border-white border-4 rounded-circle overflow-hidden" style="width:140px; height:140px;">
                            <img src="assets/images/logo.png" class="img-fluid grayscale opacity-25 h-100 w-100 object-fit-cover" alt="Faculty">
                        </div>
                        <h5 class="fw-black mb-1">DR. SARITA RAI</h5>
                        <p class="text-primary small fw-bold text-uppercase mb-3 tracking-wider">Biology | AIIMS Delhi</p>
                        <hr class="my-3 opacity-10 mx-auto w-25">
                        <p class="text-muted small mb-0 px-2">Renowned expert in Human Physiology and Genetic analysis with a record of medical toppers.</p>
                    </div>
                </div>

                <!-- Faculty 3 -->
                <div class="swiper-slide h-auto">
                    <div class="faculty-card p-5 bg-light rounded-5 text-center border-0 transition-all hover-translate-y h-100 shadow-sm">
                        <div class="faculty-avatar mb-4 mx-auto shadow-lg border border-white border-4 rounded-circle overflow-hidden" style="width:140px; height:140px;">
                            <img src="assets/images/logo.png" class="img-fluid grayscale opacity-25 h-100 w-100 object-fit-cover" alt="Faculty">
                        </div>
                        <h5 class="fw-black mb-1">S. CHOUDHARY</h5>
                        <p class="text-primary small fw-bold text-uppercase mb-3 tracking-wider">Chemistry | IIT Kanpur</p>
                        <hr class="my-3 opacity-10 mx-auto w-25">
                        <p class="text-muted small mb-0 px-2">Expert in Organic synthesis and Periodic analysis. Making Chemistry intuitive for over a decade.</p>
                    </div>
                </div>

                <!-- Faculty 4 -->
                <div class="swiper-slide h-auto">
                    <div class="faculty-card p-5 bg-light rounded-5 text-center border-0 transition-all hover-translate-y h-100 shadow-sm">
                        <div class="faculty-avatar mb-4 mx-auto shadow-lg border border-white border-4 rounded-circle overflow-hidden" style="width:140px; height:140px;">
                            <img src="assets/images/logo.png" class="img-fluid grayscale opacity-25 h-100 w-100 object-fit-cover" alt="Faculty">
                        </div>
                        <h5 class="fw-black mb-1">R.K. SINGH</h5>
                        <p class="text-primary small fw-bold text-uppercase mb-3 tracking-wider">Physics | ISM Dhanbad</p>
                        <hr class="my-3 opacity-10 mx-auto w-25">
                        <p class="text-muted small mb-0 px-2">Master of Mechanics and Electrodynamics. Simplifies complex laws through visual analysis.</p>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding" style="background: #fff;">
    <div class="container">
        <div class="cta-banner-premium rounded-5 overflow-hidden p-5 text-center position-relative shadow-heavy" style="background: var(--navy-gradient); min-height: 350px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Join the Ekalavya Family</h6>
            <h2 class="display-4 fw-black text-white mb-4">READY TO START YOUR<br>ACADEMIC <span class="text-primary">JOURNEY?</span></h2>
            <div class="d-flex flex-wrap justify-content-center gap-4">
                <a href="contact.php" class="btn btn-aurous-gradient btn-lg rounded-pill px-5 py-3 fw-bold shadow-glow">BOOK FREE COUNSELING</a>
                <a href="tel:9934244522" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold"><i class="fas fa-phone-alt me-2"></i> CALL ADMISSIONS</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
