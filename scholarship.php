<?php 
include 'includes/header.php'; 
?>

<!-- Premium Institutional Header (WOW Treatment) -->
<section class="page-header wow-container overflow-hidden" style="background: #0a1f44;">
    <div class="wow-blob" style="top: -100px; left: -100px; background: radial-gradient(circle, rgba(247,148,29,0.2) 0%, transparent 70%);"></div>
    <div class="wow-blob" style="bottom: -100px; right: -100px; background: radial-gradient(circle, rgba(247,148,29,0.15) 0%, transparent 70%);"></div>
    
    <div class="container text-center text-white position-relative">
        <h6 class="text-primary fw-black tracking-widest mb-2 animate-up" style="font-size: clamp(0.55rem, 2.5vw, 0.7rem); letter-spacing: clamp(1px, 1vw, 3px); white-space: nowrap;">RECOGNISING TALENT • REWARDING MERIT</h6>
        <h1 class="fw-black mb-0" style="font-size: clamp(2rem, 9vw, 4.5rem); line-height: 1.1;">SCHOLARSHIP <span class="text-primary d-block d-md-inline">PORTAL 2026</span></h1>
    </div>
</section>

<!-- Main Portal Layout -->
<main class="scholarship-portal py-6 bg-white">
    <div class="container">
        
        <!-- Unique Spectrum Pathway Hub (Premium Redesign) -->
        <div class="row g-4 mb-6 justify-content-center">
            <div class="col-lg-10">
                <div class="pathway-hub-grid d-flex flex-wrap justify-content-center gap-4">
                    <!-- ESAT Option -->
                    <div class="pathway-card-wrapper">
                        <button class="pathway-wow-card active" id="btn-esat" onclick="switchPathway('esat')" data-theme="orange">
                            <div class="wow-icon-bg"><i class="fas fa-file-signature"></i></div>
                            <div class="wow-card-info text-center text-lg-start">
                                <h4 class="fw-black mb-0">ESAT</h4>
                                <p class="small opacity-75 mb-0">Scholarship Test</p>
                            </div>
                        </button>
                    </div>
                    <!-- EMRS Option -->
                    <div class="pathway-card-wrapper">
                        <button class="pathway-wow-card" id="btn-emrs" onclick="switchPathway('emrs')" data-theme="blue">
                            <div class="wow-icon-bg"><i class="fas fa-medal"></i></div>
                            <div class="wow-card-info text-center text-lg-start">
                                <h4 class="fw-black mb-0">EMRS</h4>
                                <p class="small opacity-75 mb-0">Merit Based</p>
                            </div>
                        </button>
                    </div>
                    <!-- SCHOOL Option -->
                    <div class="pathway-card-wrapper">
                        <button class="pathway-wow-card" id="btn-school" onclick="switchPathway('school')" data-theme="green">
                            <div class="wow-icon-bg"><i class="fas fa-school"></i></div>
                            <div class="wow-card-info text-center text-lg-start">
                                <h4 class="fw-black mb-0">SCHOOL</h4>
                                <p class="small opacity-75 mb-0">Prep</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Left Side: Detailed Content -->
            <div class="col-lg-8">
                
                <!-- ESAT Section (Visible by default) -->
                <div id="esat-content" class="pathway-content">
                    <div class="section-title mb-5 text-center text-lg-start">
                        <h2 class="fw-black text-dark h1">ESAT <span class="text-primary">2026</span></h2>
                        <p class="text-muted lead px-2 px-lg-0">The Ekalavya Scholarship Admission Test (ESAT) is a standardized evaluation designed to identify and support students with high academic potential.</p>
                    </div>

                    <div class="accordion accordion-wow" id="esatAccordion">
                        <!-- 1. Basic Details -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat1">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-info-circle text-primary"></i></span> 
                                    BASIC DETAILS
                                </button>
                            </h2>
                            <div id="esat1" class="accordion-collapse collapse show" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0 text-muted">
                                    ESAT 2026 is conducted across multiple phases for students moving to Classes VII, VIII, IX, X, XI, and XII. The test assesses fundamental understanding of core subjects and logical reasoning.
                                </div>
                            </div>
                        </div>

                        <!-- 2. Test Details -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat2">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-calendar-alt text-primary"></i></span> 
                                    TEST DETAILS
                                </button>
                            </h2>
                            <div id="esat2" class="accordion-collapse collapse" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0">
                                    <div class="row g-4 text-center">
                                        <div class="col-6 col-md-4">
                                            <div class="p-3 bg-light rounded-4">
                                                <i class="fas fa-clock text-primary mb-2"></i>
                                                <div class="small fw-bold">90 Minutes</div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="p-3 bg-light rounded-4">
                                                <i class="fas fa-list-ol text-primary mb-2"></i>
                                                <div class="small fw-bold">MCQ Format</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="p-3 bg-light rounded-4">
                                                <i class="fas fa-map-marker-alt text-primary mb-2"></i>
                                                <div class="small fw-bold">Offline Mode</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Test Syllabus -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat3">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-book-open text-primary"></i></span> 
                                    TEST SYLLABUS
                                </button>
                            </h2>
                            <div id="esat3" class="accordion-collapse collapse" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0 text-muted">
                                    The syllabus covers Class-appropriate Physics, Chemistry, Mathematics/Biology, and Mental Ability. Detailed topic-wise syllabus will be sent to your registered email after successful registration.
                                </div>
                            </div>
                        </div>

                        <!-- 4. Benefits of ESAT -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat4">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-gift text-primary"></i></span> 
                                    BENEFITS OF ESAT
                                </button>
                            </h2>
                            <div id="esat4" class="accordion-collapse collapse" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0 text-muted">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Up to 100% Scholarship on Tuition Fees.</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> National Benchmarking against thousands of students.</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Detailed Performance Analysis (AI-driven reports).</li>
                                        <li><i class="fas fa-check-circle text-primary me-2"></i> Priority Admission for upcoming 2026-27 Batches.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Test Process -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat5">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-tasks text-primary"></i></span> 
                                    TEST PROCESS
                                </button>
                            </h2>
                            <div id="esat5" class="accordion-collapse collapse" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0 text-muted">
                                    <div class="vstack gap-3 mt-2">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="badge bg-primary rounded-circle p-2" style="width: 30px; height: 30px;">1</div>
                                            <span><strong>Register Online:</strong> Fill the registration form on the right.</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="badge bg-primary rounded-circle p-2" style="width: 30px; height: 30px;">2</div>
                                            <span><strong>Admit Card:</strong> Receive details via Email/WhatsApp.</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="badge bg-primary rounded-circle p-2" style="width: 30px; height: 30px;">3</div>
                                            <span><strong>Exam Day:</strong> Appear at the designated Ekalavya Center.</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="badge bg-primary rounded-circle p-2" style="width: 30px; height: 30px;">4</div>
                                            <span><strong>Results:</strong> Declared within 7 days of the test.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. FAQ -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat6">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-question-circle text-primary"></i></span> 
                                    FAQ
                                </button>
                            </h2>
                            <div id="esat6" class="accordion-collapse collapse" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0">
                                    <div class="mb-4 pt-3 border-top">
                                        <h6 class="fw-black text-dark mb-1">Scholarship through Entrance Test</h6>
                                        <p class="small text-muted mb-3">(Based on performance in Scholarship Test)</p>
                                        <div class="table-responsive rounded-4 border overflow-hidden">
                                            <table class="table table-hover m-0">
                                                <thead class="bg-dark text-white">
                                                    <tr>
                                                        <th class="px-4 py-3 border-0 small text-uppercase">Test Score Range</th>
                                                        <th class="px-4 py-3 border-0 small text-uppercase text-end">Scholarship Benefit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="px-4 py-3 border-bottom-0">90% – 100%</td>
                                                        <td class="px-4 py-3 border-bottom-0 text-end fw-black text-primary">100% SCHOLARSHIP</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 border-bottom-0">80% – 89%</td>
                                                        <td class="px-4 py-3 border-bottom-0 text-end fw-black text-dark">75% SCHOLARSHIP</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 border-bottom-0">70% – 79%</td>
                                                        <td class="px-4 py-3 border-bottom-0 text-end fw-black text-dark">50% SCHOLARSHIP</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 border-bottom-0">60% – 69%</td>
                                                        <td class="px-4 py-3 border-bottom-0 text-end fw-black text-dark">30% SCHOLARSHIP</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 border-bottom-0">50% – 59%</td>
                                                        <td class="px-4 py-3 border-bottom-0 text-end fw-black text-dark">20% SCHOLARSHIP</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="vstack gap-3">
                                        <div>
                                            <p class="fw-bold text-dark mb-1 small">Q: Is the test online or offline?</p>
                                            <p class="small text-muted mb-0">A: ESAT 2026 is conducted in Offline mode at our designated study centers.</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold text-dark mb-1 small">Q: When will the results be announced?</p>
                                            <p class="small text-muted mb-0">A: Results are typically declared within 7 working days after the test date.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Hear from Scholars -->
                        <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#esat7">
                                    <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="fas fa-user-graduate text-primary"></i></span> 
                                    HEAR FROM ESAT SCHOLAR
                                </button>
                            </h2>
                            <div id="esat7" class="accordion-collapse collapse" data-bs-parent="#esatAccordion">
                                <div class="accordion-body px-5 pb-5 pt-0">
                                    <div class="p-4 bg-light rounded-5 border-start border-primary border-4 mt-3">
                                        <i class="fas fa-quote-left text-primary opacity-25 fs-1 mb-2"></i>
                                        <p class="small fst-italic text-muted mb-3">"ESAT was a turning point for me. The test pattern was very similar to competitive exams, and winning a scholarship motivated me to work even harder."</p>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="fw-black text-dark small">Aditya Verma</div>
                                            <div class="badge bg-primary bg-opacity-10 text-primary small">IIT-JEE 2026 Aspirant</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EMRS Section (Hidden by default) -->
                <div id="emrs-content" class="pathway-content d-none">
                    <div class="section-title mb-5">
                        <h2 class="fw-black text-dark h1">EMRS <span class="text-primary">2026</span></h2>
                        <h5 class="text-primary fw-bold mb-4">Ekalavya Merit Reward Scholarship (EMRS)</h5>
                        <p class="text-muted lead">A merit-based scholarship program offering admission and fee benefits to deserving students. <br>
                        Avail Scholarship based on Board Results or Competitive Exam Scores<br>
                        (NEET | JEE | Olympiad | NTSE)<br>
                        ⚡ Limited Seats | Early Registration Recommended</p>
                    </div>

                    <div class="vstack gap-4">
                        <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                            <h6 class="fw-black text-dark mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Board Performance</h6>
                            <p class="small text-muted mb-0">Direct admission and scholarships for top performers in CBSE, ICSE, and State Board Examinations.</p>
                        </div>
                        <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                            <h6 class="fw-black text-dark mb-2"><i class="fas fa-bolt text-primary me-2"></i> Competitive Scores</h6>
                            <p class="small text-muted mb-0">Special waivers for students with qualifying scores in NEET, JEE Main/Advanced, NTSE, or Government Olympiads.</p>
                        </div>
                        <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                            <h6 class="fw-black text-dark mb-2"><i class="fas fa-clock text-primary me-2"></i> Priority Access</h6>
                            <p class="small text-muted mb-0">⚡ Limited Seats | Early Registration is recommended for the 2026-27 Academic Session.</p>
                        </div>
                        <!-- Added ESAT Info Only -->
                        <div class="emrs-feature p-4 rounded-5 bg-light border-start border-primary border-4 mt-2">
                             <h6 class="fw-black text-dark mb-2">Not qualifying via Boards?</h6>
                             <p class="small text-muted mb-3">Appear for **ESAT 2026** (Scholarship Exam) and secure up to 100% scholarship on our premium courses based on your test performance.</p>
                             <a href="javascript:void(0)" onclick="switchPathway('esat')" class="btn btn-sm btn-primary rounded-pill px-4">View Exam Details</a>
                        </div>
                    </div>
                </div>
                <!-- School Scholarship Section (Hidden by default) -->
                <div id="school-content" class="pathway-content d-none">
                    <div class="section-title mb-5">
                        <h2 class="fw-black text-dark h1">SCHOOL <span class="text-primary">SCHOLARSHIP</span></h2>
                        <h5 class="text-primary fw-bold mb-4">Foundation Programs (Class 7-10)</h5>
                        <p class="text-muted lead">Dedicated academic support and financial aids for young achievers looking to build a strong foundation for future competitive exams.</p>
                    </div>

                    <div class="vstack gap-4">
                        <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                            <h6 class="fw-black text-dark mb-2"><i class="fas fa-child text-primary me-2"></i> Early Bird Benefits</h6>
                            <p class="small text-muted mb-0">Secure up to 40% waiver on tuition fees by registering early for the 2026 academic session.</p>
                        </div>
                        <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                            <h6 class="fw-black text-dark mb-2"><i class="fas fa-trophy text-primary me-2"></i> School Rankers Reward</h6>
                            <p class="small text-muted mb-0">Special recognition and scholarships for students ranked in the top 3 of their respective school classes.</p>
                        </div>
                        <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                            <h6 class="fw-black text-dark mb-2"><i class="fas fa-book text-primary me-2"></i> NTSE/Olympiad Prep</h6>
                            <p class="small text-muted mb-0">Integrated preparation modules for NTSE and Science/Math Olympiads included in the scholarship package.</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Side: Sticky Registration Form - WOW Redesign -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 140px; z-index: 5;">
                    <div class="registration-form-card glass-pill-premium p-4 rounded-5 shadow-2xl position-relative overflow-hidden" style="max-width: 380px; margin-left: auto;">
                        <div class="wow-blob" style="top: -50px; right: -50px; width: 200px; height: 200px; opacity: 0.2;"></div>
                        
                        <div class="text-center mb-5 position-relative">
                            <div class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">SESSION 2026-27</div>
                            <h3 class="fw-black mb-1">REGISTRATION <span class="text-primary">PORTAL</span></h3>
                            <p class="very-small text-muted uppercase fw-bold tracking-widest">Scholarship Program Admission</p>
                        </div>
                        
                        <form action="<?php echo BASE_URL; ?>process-scholarship.php" method="POST" class="vstack gap-3 position-relative">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control rounded-4 border-0 bg-light px-4" id="regName" placeholder="Full Name" required>
                                <label for="regName" class="small text-muted px-4">Full Name</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" name="email" class="form-control rounded-4 border-0 bg-light px-4" id="regEmail" placeholder="Email Address" required>
                                <label for="regEmail" class="small text-muted px-4">Email Address</label>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="tel" name="phone" class="form-control rounded-4 border-0 bg-light px-4" id="regPhone" placeholder="Mobile" required>
                                        <label for="regPhone" class="small text-muted px-4">Phone</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="program" class="form-select rounded-4 border-0 bg-light px-4" id="regClass" required>
                                            <option value="IIT-JEE">IIT-JEE</option>
                                            <option value="NEET">NEET</option>
                                            <option value="School Prep (Class 7th)">School Prep (Class 7th)</option>
                                            <option value="School Prep (Class 8th)">School Prep (Class 8th)</option>
                                            <option value="School Prep (Class 9th)">School Prep (Class 9th)</option>
                                            <option value="School Prep (Class 10th)">School Prep (Class 10th)</option>
                                            <option value="School Prep (Class 11th)">School Prep (Class 11th)</option>
                                            <option value="School Prep (Class 12th)">School Prep (Class 12th)</option>
                                        </select>
                                        <label for="regClass" class="small text-muted px-4">Program</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating">
                                <select name="scholarship_type" class="form-select rounded-4 border-0 bg-light px-4" id="regType" required>
                                    <option value="ESAT">Scholarship Test (ESAT)</option>
                                    <option value="EMRS">Merit Based (EMRS)</option>
                                    <option value="EARLY_BIRD">Early Bird Benefits</option>
                                </select>
                                <label for="regType" class="small text-muted px-4">Apply For</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-4 rounded-pill fw-black shadow-lg text-uppercase tracking-wider mt-3" style="font-size: 0.9rem;">
                                REGISTER NOW <i class="fas fa-paper-plane ms-2"></i>
                            </button>

                            <div class="text-center mt-4">
                                <a href="https://wa.me/919934244522" class="text-success small fw-bold text-decoration-none d-flex align-items-center justify-content-center gap-2">
                                    <i class="fab fa-whatsapp fs-5"></i> WHATSAPP ADMISSION HELPLINE
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.pathway-wow-card {
    background: #fff;
    border: 1px solid #eee;
    padding: 25px 35px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    cursor: pointer;
    transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    position: relative;
    overflow: hidden;
    min-width: 280px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.pathway-wow-card .wow-icon-bg {
    width: 60px;
    height: 60px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.4s ease;
    background: #f8f9fa;
}

.pathway-wow-card .wow-card-info {
    text-align: left;
}

.pathway-wow-card.active,
.pathway-wow-card:hover {
    background: #0a1f44;
    color: #fff !important;
    border-color: #0a1f44;
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(10,31,68,0.2);
}

.pathway-wow-card.active h4,
.pathway-wow-card:hover h4 {
    color: #fff !important;
}

/* Icon Themes for Active and Hover */
.pathway-wow-card[data-theme="orange"].active .wow-icon-bg,
.pathway-wow-card[data-theme="orange"]:hover .wow-icon-bg { background: var(--primary-color); color: #fff; box-shadow: 0 10px 20px rgba(247,148,29,0.3); }

.pathway-wow-card[data-theme="blue"].active .wow-icon-bg,
.pathway-wow-card[data-theme="blue"]:hover .wow-icon-bg { background: #007bff; color: #fff; box-shadow: 0 10px 20px rgba(0,123,255,0.3); }

.pathway-wow-card[data-theme="green"].active .wow-icon-bg,
.pathway-wow-card[data-theme="green"]:hover .wow-icon-bg { background: #28a745; color: #fff; box-shadow: 0 10px 20px rgba(40,167,69,0.3); }



.pathway-wow-card:hover .wow-icon-bg {
    transform: scale(1.1) rotate(5deg);
}

/* Accordion Custom Enhancements */
.accordion-wow .accordion-button:focus,
.accordion-wow .accordion-button:not(.collapsed) {
    box-shadow: none !important;
    background-color: transparent !important;
}

.accordion-wow .accordion-body {
    border-top: 1px solid rgba(0, 0, 0, 0.08);
    margin-top: 0.5rem;
    padding-top: 2rem !important;
}
</style>

<script>
function switchPathway(id) {
    // Buttons
    document.querySelectorAll('.pathway-wow-card').forEach(btn => btn.classList.remove('active'));
    
    const targetBtn = document.getElementById('btn-' + id);
    if(targetBtn) targetBtn.classList.add('active');

    // Content
    document.querySelectorAll('.pathway-content').forEach(content => content.classList.add('d-none'));
    const targetContent = document.getElementById(id + '-content');
    if(targetContent) targetContent.classList.remove('d-none');

    // Update Form Type Dropdown
    const regType = document.getElementById('regType');
    if(regType) regType.value = id.toUpperCase();
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const path = urlParams.get('path');
    if (path) {
        switchPathway(path);
    }
}
</script>

<?php include 'includes/footer.php'; ?>
