<?php 
require_once 'config/database.php';
include 'includes/header.php'; 
?>

    <!-- Hero Section -->
    <section id="hero" class="p-0 overflow-hidden position-relative">
        <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <div class="hero-bg" style="background-image: url('assets/images/hero-bg.jpg');"></div>
                    <div class="hero-overlay d-flex align-items-center justify-content-center text-center">
                        <div class="container">
                            <div class="d-flex flex-column align-items-center">
                                 <h1 class="rev-title rev-anim-left" title="Proven Results in IIT-JEE & NEET">
                                     Proven Results in<br><span class="text-primary">IIT-JEE & NEET</span>
                                 </h1>
                                 <a href="scholarship" class="btn btn-lg btn-primary mt-4 rev-anim-left delay-740 shadow px-5 py-3 fw-medium">
                                    Apply Scholarship
                                 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="hero-bg" style="background-image: url('assets/images/jee_course.jpg');"></div>
                     <div class="hero-overlay d-flex align-items-center justify-content-center text-center">
                        <div class="container">
                            <div class="d-flex flex-column align-items-center">
                                <h2 class="rev-title rev-anim-left" title="Disciplined Offline Coaching">
                                     Integrated Classroom<br>Programs (Offline)
                                </h2>
                                <a href="courses" class="btn btn-lg btn-outline-light mt-4 rev-anim-left delay-740 shadow px-5 py-3 fw-medium">
                                    View Courses
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="hero-bg" style="background-image: url('assets/images/neet_course.jpg');"></div>
                     <div class="hero-overlay d-flex align-items-center justify-content-center text-center">
                        <div class="container">
                            <div class="d-flex flex-column align-items-center">
                                <h2 class="rev-title rev-anim-left" title="Expert Faculty & Support">
                                     Empowering Dreams With<br>Expert Mentorship
                                </h2>
                                 <a href="about" class="btn btn-lg btn-primary mt-4 rev-anim-left delay-740 shadow px-5 py-3 fw-medium">
                                    About Eklavya Academy
                                 </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev d-none d-md-block" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><i class="fas fa-chevron-left fa-lg filter-drop-shadow"></i></button>
        <button class="carousel-control-next d-none d-md-block" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><i class="fas fa-chevron-right fa-lg filter-drop-shadow"></i></button>
    </section>
    
    <!-- Section 2: Entrance Categories (Ultra-Premium) -->
    <section class="entrance-section section-standard" style="padding-bottom: 120px !important;">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold">OUR COURSES</h2>
                <div class="title-accent mx-auto mb-3"></div>
                <p class="text-muted max-width-700 mx-auto">Being true Mentors, our objective is to guide the students on the track of their academic growth by bringing out their latent potential.</p>
            </div>
            <div class="row g-4">
                <!-- IIT-JEE Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="entrance-card-premium">
                        <div class="entrance-watermark">IIT</div>
                        <div class="entrance-icon-refined">
                            <i class="fas fa-atom"></i>
                        </div>
                        <h3 class="entrance-title-modern">IIT-JEE (Mains & Adv)</h3>
                        <div class="entrance-badges-wrap">
                            <span class="entrance-badge-modern">Class 11</span>
                            <span class="entrance-badge-modern">Class 12</span>
                            <span class="entrance-badge-modern">Target/Dropper</span>
                        </div>
                        <p class="text-muted small mb-4">Master physics and math with visionary IITian faculty and structured analytical learning.</p>
                        <div class="cta-pair-modern">
                            <button class="enquire-btn-hub" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire <i class="fas fa-paper-plane ms-1"></i></button>
                            <a href="https://wa.me/919934244522" target="_blank" class="whatsapp-circle-btn"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- NEET-UG Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="entrance-card-premium">
                        <div class="entrance-watermark">NEET</div>
                        <div class="entrance-icon-refined">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 class="entrance-title-modern">NEET (Medical)</h3>
                        <div class="entrance-badges-wrap">
                            <span class="entrance-badge-modern">Class 9 & 10</span>
                            <span class="entrance-badge-modern">Class 11 & 12</span>
                            <span class="entrance-badge-modern">Target</span>
                        </div>
                        <p class="text-muted small mb-4">The ultimate path to AIIMS and top medical colleges with expert biology and chemistry mentors.</p>
                        <div class="cta-pair-modern">
                            <button class="enquire-btn-hub" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire <i class="fas fa-paper-plane ms-1"></i></button>
                            <a href="https://wa.me/919934244522" target="_blank" class="whatsapp-circle-btn"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Foundation Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="entrance-card-premium">
                        <div class="entrance-watermark">PRE</div>
                        <div class="entrance-icon-refined">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3 class="entrance-title-modern">Pre-Foundation</h3>
                        <div class="entrance-badges-wrap">
                            <span class="entrance-badge-modern">Class 7-10</span>
                            <span class="entrance-badge-modern">Olympiad</span>
                            <span class="entrance-badge-modern">Basics</span>
                        </div>
                        <p class="text-muted small mb-4">Cultivating analytical thinking and strong basics for future global competitions from an early age.</p>
                        <div class="cta-pair-modern">
                            <button class="enquire-btn-hub" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire <i class="fas fa-paper-plane ms-1"></i></button>
                            <a href="https://wa.me/919934244522" target="_blank" class="whatsapp-circle-btn"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Academy in Numbers (Floating Premium Stats) -->
    <section class="stats-premium bg-light overflow-hidden">
        <div class="container overflow-visible">
            <div class="stats-glass-container d-flex flex-wrap justify-content-center gap-4 py-5 shadow-lg rounded-5 bg-dark">
                <div class="stat-glass-card text-center p-4">
                    <div class="stat-icon mb-2 text-primary fs-2"><i class="fas fa-history"></i></div>
                    <h2 class="display-6 fw-black text-white mb-0">10+</h2>
                    <p class="small text-uppercase tracking-wider text-secondary mb-0">Years of Success</p>
                </div>
                <div class="stat-glass-card text-center p-4">
                    <div class="stat-icon mb-2 text-primary fs-2"><i class="fas fa-trophy"></i></div>
                    <h2 class="display-6 fw-black text-white mb-0">270+</h2>
                    <p class="small text-uppercase tracking-wider text-secondary mb-0">JEE Rankers '24</p>
                </div>
                <div class="stat-glass-card text-center p-4">
                    <div class="stat-icon mb-2 text-primary fs-2"><i class="fas fa-user-graduate"></i></div>
                    <h2 class="display-6 fw-black text-white mb-0">5k+</h2>
                    <p class="small text-uppercase tracking-wider text-secondary mb-0">Students Mentored</p>
                </div>
                <div class="stat-glass-card text-center p-4">
                    <div class="stat-icon mb-2 text-primary fs-2"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h2 class="display-6 fw-black text-white mb-0">15+</h2>
                    <p class="small text-uppercase tracking-wider text-secondary mb-0">IITian Mentors</p>
                </div>
            </div>
        </div>
    </section>



    <section class="section-standard bg-white" id="why-choose">
        <div class="container container-1480">
            <div class="section-title text-center mb-5">
                <h2 class="fw-black">WHY <span class="text-primary">EKLAVYA ACADEMY?</span></h2>
                <div class="title-accent mx-auto"></div>
            </div>
            
            <div class="row g-4">
                <!-- Point 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card">
                        <div class="number-bg">01</div>
                        <div class="choose-icon-refined"><i class="fas fa-user-tie"></i></div>
                        <h5 class="fw-bold mb-3">Expert IITian Faculty</h5>
                        <p class="text-muted small mb-0">Learn from mentors who have conquered the exams themselves. Our faculty comprises senior IITians and medical experts.</p>
                    </div>
                </div>
                <!-- Point 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card">
                        <div class="number-bg">02</div>
                        <div class="choose-icon-refined"><i class="fas fa-book-open"></i></div>
                        <h5 class="fw-bold mb-3">Visual Study Material</h5>
                        <p class="text-muted small mb-0">Meticulously designed colored modules with 2D/3D visuals for intuitive understanding of complex concepts.</p>
                    </div>
                </div>
                <!-- Point 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card">
                        <div class="number-bg">03</div>
                        <div class="choose-icon-refined"><i class="fas fa-video"></i></div>
                        <h5 class="fw-bold mb-3">Live Backup Support</h5>
                        <p class="text-muted small mb-0">Never miss a concept. Get instant access to recorded classroom lectures for revision and missed class backups.</p>
                    </div>
                </div>
                <!-- Point 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card">
                        <div class="number-bg">04</div>
                        <div class="choose-icon-refined"><i class="fas fa-chart-pie"></i></div>
                        <h5 class="fw-bold mb-3">Micro-Analysis Reports</h5>
                        <p class="text-muted small mb-0">Real-time performance evaluation with concept-wise error analysis through our advanced testing platform.</p>
                    </div>
                </div>
                <!-- Point 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card">
                        <div class="number-bg">05</div>
                        <div class="choose-icon-refined"><i class="fas fa-comments"></i></div>
                        <h5 class="fw-bold mb-3">24/7 Doubt Resolution</h5>
                        <p class="text-muted small mb-0">Direct access to classroom faculties for doubt clearing, ensuring no student is left behind in the journey.</p>
                    </div>
                </div>
                <!-- Point 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="choose-modern-card">
                        <div class="number-bg">06</div>
                        <div class="choose-icon-refined"><i class="fas fa-heart"></i></div>
                        <h5 class="fw-bold mb-3">Focused Mentorship</h5>
                        <p class="text-muted small mb-0">Personalized counseling and motivation sessions to keep students mentally strong and focused on their goals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section: Director's Vision (Modern Studio Design) -->
    <section class="director-modern section-standard bg-white">
        <div class="container">
            <div class="row g-0 rounded-5 overflow-hidden shadow-xl border border-light">
                <div class="col-lg-4 p-4 p-md-5 d-flex align-items-center justify-content-center bg-light bg-opacity-10">
                    <div class="director-portrait-modern position-relative">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600" alt="Director" class="img-fluid rounded-4 shadow-lg border border-white border-4">
                        <div class="portrait-label-small px-3 py-2 bg-primary text-white position-absolute bottom-0 start-50 translate-middle-x w-75 rounded-pill mb-n3 text-center shadow-sm">
                             <h6 class="mb-0 fw-bold">Amit Ranjan</h6>
                             <p class="very-small mb-0 opacity-75" style="font-size: 0.65rem;">B.Tech, IIT Roorkee</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 p-4 p-md-5 d-flex align-items-center bg-white position-relative">
                    <div class="director-quote-bg"><i class="fas fa-quote-right"></i></div>
                    <div class="director-content-modern z-1">
                        <div class="accent-line mb-4"></div>
                        <h2 class="fw-black mb-4">A Vision for <span class="text-primary">Excellence</span></h2>
                        <p class="lead text-dark fw-medium mb-4">"We don't just teach modules; we sculpt minds to think critically and act decisively."</p>
                        <p class="text-muted">At Eklavya Academy, our mission transcends traditional coaching. We’ve built a rigorous ecosystem where IITian mentors collaborate with aspiring minds to bridge the gap between hard work and top-tier results. My personal commitment is to ensure that every student who walks through our doors leaves with a structured, analytical approach to solving life's biggest challenges.</p>
                        <div class="mt-5 d-flex align-items-center gap-4">
                             <div class="director-sig">
                                 <h4 class="font-signature text-primary mb-0" style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Amit Ranjan</h4>
                                 <p class="small text-muted mt-n1">Director & HOD Physics</p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Teaching Philosophy (Masterpiece Roadmap Facelift) -->
    <section class="philosophy-roadmap-premium section-standard bg-white">
        <div class="container overflow-visible">
            <div class="section-title text-center mb-5">
                <h2 class="fw-black">OUR TEACHING <span class="text-primary">PHILOSOPHY</span></h2>
                <div class="title-accent mx-auto"></div>
            </div>

            <div class="roadmap-container">
                <!-- SVG Path with Animation -->
                <svg class="roadmap-svg-path" viewBox="0 0 1000 400" preserveAspectRatio="none">
                    <path d="M 50 200 C 150 200 150 350 250 350 C 350 350 350 100 450 100 C 550 100 550 300 650 300 C 750 300 750 150 850 150 C 950 150 950 200 1000 200" />
                    <path class="path-moving" d="M 50 200 C 150 200 150 350 250 350 C 350 350 350 100 450 100 C 550 100 550 300 650 300 C 750 300 750 150 850 150 C 950 150 950 200 1000 200" />
                </svg>

                <!-- Process Nodes -->
                <div class="roadmap-node" style="left: 10%; top: 50%;">
                    <div class="node-orb"><i class="fas fa-lightbulb"></i></div>
                    <h6>Latent Potential</h6>
                </div>

                <div class="roadmap-node" style="left: 30%; top: 88%;">
                    <div class="node-orb"><i class="fas fa-users"></i></div>
                    <h6>Expert Mentors</h6>
                </div>

                <div class="roadmap-node" style="left: 50%; top: 25%;">
                    <div class="node-orb"><i class="fas fa-brain"></i></div>
                    <h6>Critical Thinking</h6>
                </div>

                <div class="roadmap-node" style="left: 70%; top: 75%;">
                    <div class="node-orb"><i class="fas fa-chart-line"></i></div>
                    <h6>Rigorous Evaluation</h6>
                </div>

                <div class="roadmap-node" style="left: 90%; top: 38%;">
                    <div class="node-orb"><i class="fas fa-bullseye"></i></div>
                    <h6>National Success</h6>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Section: Testimonials (High-Fidelity 3-Column Grid) -->
    <section class="testimonials-modern section-standard bg-light" id="testimonials">
        <div class="container container-1400 overflow-visible">
            <div class="section-title text-center mb-5">
                <h2 class="fw-black">VOICES OF <span class="text-primary">SUCCESS</span></h2>
                <div class="title-accent mx-auto mb-3"></div>
            </div>
            
            <div class="row g-4 justify-content-center">
                <!-- Testimonial 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="modern-testimonial-card h-100">
                        <div class="quote-mark">“</div>
                        <i class="fas fa-quote-left"></i>
                        <p class="testimonial-text">"The competitive environment and micro-analysis of every test helped me bridge my weak areas effectively. Amit Sir's Physics classes are legendary."</p>
                        <div class="testimonial-author">
                            <div class="avatar-circle me-3 bg-orange-soft text-primary fw-bold d-flex align-items-center justify-content-center rounded-circle" style="width:50px; height:50px; border: 1px solid var(--orange-soft);">RV</div>
                            <div>
                                <h6 class="mb-0 fw-bold">Rahul Verma</h6>
                                <p class="small text-muted mb-0">JEE Advanced AIR 240</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="modern-testimonial-card h-100">
                        <div class="quote-mark">“</div>
                        <i class="fas fa-quote-left"></i>
                        <p class="testimonial-text">"Joining Eklavya was the best decision for my NEET prep. The personal attention and doubt-clearing sessions are truly exceptional. I felt supported every step of the way."</p>
                        <div class="testimonial-author">
                            <div class="avatar-circle me-3 bg-orange-soft text-primary fw-bold d-flex align-items-center justify-content-center rounded-circle" style="width:50px; height:50px; border: 1px solid var(--orange-soft);">PS</div>
                            <div>
                                <h6 class="mb-0 fw-bold">Priya Singh</h6>
                                <p class="small text-muted mb-0">NEET Score 685/720</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="modern-testimonial-card h-100">
                        <div class="quote-mark">“</div>
                        <i class="fas fa-quote-left"></i>
                        <p class="testimonial-text">"The study material is so intuitive and structured. It made complex concepts easy to grasp. The faculty doesn't just teach; they mentor you for life success."</p>
                        <div class="testimonial-author">
                            <div class="avatar-circle me-3 bg-orange-soft text-primary fw-bold d-flex align-items-center justify-content-center rounded-circle" style="width:50px; height:50px; border: 1px solid var(--orange-soft);">AK</div>
                            <div>
                                <h6 class="mb-0 fw-bold">Ankit Kumar</h6>
                                <p class="small text-muted mb-0">IIT Bombay (CSE)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: FAQs (Minimalist Flow) -->
    <section class="faq-modern section-standard bg-white">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-black">COMMON <span class="text-primary">ENQUIRIES</span></h2>
                <div class="title-accent mx-auto"></div>
            </div>
            <div class="row g-5 align-items-center">
                <!-- FAQ Visual (Now on Left) -->
                <div class="col-lg-6">
                    <div class="faq-visual-wrapper pe-lg-5">
                         <img src="assets/images/faq-student.png" alt="Student Studying" class="img-fluid rounded-5 shadow-2xl border border-white border-5 transform-hover scale-105">
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="accordion accordion-flush" id="faqModernAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fm1">
                                    Do you provide scholarship for meritorious students?
                                </button>
                            </h2>
                            <div id="fm1" class="accordion-collapse collapse" data-bs-parent="#faqModernAccordion">
                                <div class="accordion-body">
                                    Yes, we conduct the EST (Eklavya Scholarship Test) periodically. Based on the performance, students can avail up to 100% scholarship on tuition fees.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fm2">
                                    Are classes available in both Patna and Gaya?
                                </button>
                            </h2>
                            <div id="fm2" class="accordion-collapse collapse" data-bs-parent="#faqModernAccordion">
                                <div class="accordion-body">
                                    Yes, we have full-fledged offline classroom centers in both Patna (Boring Road) and Gaya (Bisar Talab). Both centers maintain identical faculty and quality standards.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fm3">
                                    How experienced are the faculty members?
                                </button>
                            </h2>
                            <div id="fm3" class="accordion-collapse collapse" data-bs-parent="#faqModernAccordion">
                                <div class="accordion-body">
                                    Our core team comprises senior IITians and subject experts with over 15 years of experience in producing national-level ranks in JEE and NEET.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Our Network (Patna & Gaya) -->
    <section class="centers-section section-standard bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="fw-black">OUR <span class="text-primary">CENTERS</span></h2>
                <div class="title-accent mx-auto mb-3"></div>
                <p class="text-muted">Visit our world-class learning centers in Bihar's educational hubs.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="center-card p-4 rounded-5 bg-white shadow-sm border border-light h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="center-icon me-3 bg-orange-soft p-3 rounded-4"><i class="fas fa-landmark text-primary fs-3"></i></div>
                            <div>
                                <h4 class="fw-bold mb-0">Patna Center</h4>
                                <p class="small text-muted mb-0">Elite Classroom Program</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-map-marker-alt text-primary me-2"></i> 3rd Floor, Shivam Complex, Boring Canal Road, Patna - 800001</p>
                        <div class="d-flex gap-3 mt-auto">
                            <a href="tel:9934244522" class="btn btn-outline-primary btn-sm rounded-pill px-4">Call Now</a>
                            <a href="https://maps.app.goo.gl/..." target="_blank" class="btn btn-link text-dark text-decoration-none small">Get Directions <i class="fas fa-external-link-alt ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="center-card p-4 rounded-5 bg-white shadow-sm border border-light h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="center-icon me-3 bg-orange-soft p-3 rounded-4"><i class="fas fa-building text-primary fs-3"></i></div>
                            <div>
                                <h4 class="fw-bold mb-0">Gaya Center</h4>
                                <p class="small text-muted mb-0">Premium Classroom Program</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-map-marker-alt text-primary me-2"></i> Gaya Center, Bisar Talab, Near Gaya Station, Gaya - 823001</p>
                        <div class="d-flex gap-3 mt-auto">
                            <a href="tel:9934244522" class="btn btn-outline-primary btn-sm rounded-pill px-4">Call Now</a>
                            <a href="https://maps.app.goo.gl/..." target="_blank" class="btn btn-link text-dark text-decoration-none small">Get Directions <i class="fas fa-external-link-alt ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Masterpiece Section: Booking & Results (Highest Converting Layout) -->
    <section class="counseling-masterpiece section-standard bg-white py-5" id="admission">
        <div class="container container-1480">
            <div class="row g-5 align-items-center">
                <!-- Left Content: The Result Story -->
                <div class="col-lg-7">
                    <div class="result-master-content pe-lg-5">
                        <span class="badge bg-primary px-3 py-2 mb-3 rounded-pill">ADMISSIONS OPEN 2025-26</span>
                        <h2 class="display-5 fw-black mb-4">Start Your Journey to an <span class="text-primary">IIT or AIIMS</span></h2>
                        <p class="lead text-muted mb-5">Don't just take our word for it. Join the ranks of thousands who achieved their dreams through our disciplined environment and expert IITian mentorship.</p>
                        
                        <div class="result-stats-grid row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="rs-item d-flex align-items-center p-4 rounded-4 bg-orange-soft">
                                    <div class="h1 fw-black text-primary mb-0 me-3">270+</div>
                                    <div class="small fw-bold text-dark text-uppercase lh-1">JEE MAIN<br>SELECTIONS '25</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="rs-item d-flex align-items-center p-4 rounded-4 border border-light">
                                    <div class="h1 fw-black text-dark mb-0 me-3">99.98</div>
                                    <div class="small fw-bold text-muted text-uppercase lh-1">HIGHEST<br>PERCENTILE</div>
                                </div>
                            </div>
                        </div>

                        <div class="trusted-avatars d-flex align-items-center gap-2">
                            <div class="avatar-group d-flex me-3">
                                <img src="assets/images/topper_rohit_kumar.jpg" class="rounded-circle border border-white border-2 shadow-sm" width="50" height="50">
                                <img src="assets/images/topper_priya_verma.jpg" class="rounded-circle border border-white border-2 shadow-sm ms-n2" width="50" height="50">
                                <img src="assets/images/topper_arjun_sharma.jpg" class="rounded-circle border border-white border-2 shadow-sm ms-n2" width="50" height="50">
                            </div>
                            <p class="small text-muted mb-0 fw-medium">Join 5,000+ ambitious students across Bihar.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content: The Perfect Form -->
                <div class="col-lg-5">
                    <div class="counseling-form-card p-4 p-md-5 rounded-5 bg-white shadow-2xl border border-light">
                        <h3 class="fw-bold text-dark mb-4">Book Free Session</h3>
                        <form action="process-inquiry" method="POST" class="master-form">
                            <div class="mb-4">
                                <label class="small fw-bold text-muted mb-2">FULL NAME</label>
                                <input type="text" name="name" class="form-control premium-input" placeholder="e.g. Rahul Kumar" required>
                            </div>
                            <div class="mb-4">
                                <label class="small fw-bold text-muted mb-2">MOBILE NUMBER</label>
                                <input type="tel" name="phone" class="form-control premium-input" placeholder="+91 00000 00000" required>
                            </div>
                            <div class="mb-4">
                                <label class="small fw-bold text-muted mb-2">COURSE INTEREST</label>
                                <select name="course" class="form-select premium-input" required>
                                    <option value="" selected disabled>Choose your path</option>
                                    <option value="Foundation">Foundation (Class 7-10)</option>
                                    <option value="JEE">IIT-JEE (Class 11, 12, Target)</option>
                                    <option value="NEET">NEET-UG (Class 11, 12, Target)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary-action w-100 py-3 rounded-pill fw-bold text-uppercase shadow-lg">
                                Submit Request <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </form>
                        <p class="text-center small text-muted mt-4">Safe & Secure | No Spam Policy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
