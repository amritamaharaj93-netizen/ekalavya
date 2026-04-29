<?php 
include 'includes/header.php'; 
?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('assets/images/classroom_courses_hero.png') center/cover no-repeat;">
    <div class="container text-center">
        <h1 class="fw-black text-white mb-0">CLASSROOM <span class="text-primary">PROGRAMS</span></h1>
    </div>
</section>

<!-- Program Selection Interface -->
<section class="py-section bg-white" id="programs">
    <div class="container">
        <div class="row justify-content-center mb-6">
            <div class="col-lg-8 text-center text-uppercase">
                <h6 class="text-primary fw-bold tracking-wider mb-3">Academic Excellence</h6>
                <h2 class="fw-black h1 mb-4">Strategic <span class="text-primary">Learning</span> Pathways</h2>
                <div class="title-accent mx-auto"></div>
            </div>
        </div>

        <!-- Professional Tab Selection (Premium Pill UI) -->
        <div class="program-nav-wrapper mb-6">
            <ul class="nav nav-tabs border-0 justify-content-center gap-3 gap-md-4" id="programTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active program-tab-btn-new" id="neet-tab" data-bs-toggle="tab" data-bs-target="#neet-content" type="button" role="tab">
                        <div class="tab-icon-box">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="tab-text-box text-start">
                            <span class="tab-title">NEET</span>
                            <span class="tab-subtitle">(UG)</span>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link program-tab-btn-new" id="jee-tab" data-bs-toggle="tab" data-bs-target="#jee-content" type="button" role="tab">
                        <div class="tab-icon-box">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="tab-text-box text-start">
                            <span class="tab-title">JEE</span>
                            <span class="tab-subtitle">(MAIN & ADV)</span>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link program-tab-btn-new" id="foundation-tab" data-bs-toggle="tab" data-bs-target="#foundation-content" type="button" role="tab">
                        <div class="tab-icon-box">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="tab-text-box text-start">
                            <span class="tab-title">ACADEMIC</span>
                            <span class="tab-subtitle">FOUNDATION</span>
                        </div>
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="programTabContent">
            <!-- NEET Content -->
            <div class="tab-pane fade show active" id="neet-content" role="tabpanel">
                <div class="row g-4">
                    <?php renderProgramCard('SEED', 'Target 2030', 'Class VIII to IX Moving', 'neet-seed'); ?>
                    <?php renderProgramCard('ANKUR', 'Target 2029', 'Class IX to X Moving', 'neet-ankur'); ?>
                    <?php renderProgramCard('NURTURE', 'Target 2028', 'Class X to XI Moving', 'neet-nurture'); ?>
                    <?php renderProgramCard('EMERGE', 'Target 2029', 'Class XI to XII Moving', 'neet-emerge'); ?>
                    <?php renderProgramCard('IMPULSE', 'Target 2029', 'Class XII Pass (Droppers)', 'neet-impulse'); ?>
                </div>
            </div>

            <!-- JEE Content -->
            <div class="tab-pane fade" id="jee-content" role="tabpanel">
                <div class="row g-4">
                    <?php renderProgramCard('SEED', 'Target 2030', 'Class VIII to IX Moving', 'jee-seed'); ?>
                    <?php renderProgramCard('NURTURE', 'Target 2028', 'Class X to XI Moving', 'jee-nurture'); ?>
                </div>
            </div>

            <!-- Foundation Content -->
            <div class="tab-pane fade" id="foundation-content" role="tabpanel">
                <div class="row g-4">
                    <div class="col-12 text-center py-5">
                       <h4 class="fw-black text-muted opacity-50">FOUNDATION PROGRAMS</h4>
                       <p class="text-secondary small">Comprehensive foundational preparation for Junior Scientific Olympiads & School Excellence.</p>
                       <div class="row g-4 mt-4 text-start">
                           <?php renderProgramCard('SEED', 'Target 2030', 'Class VIII to IX Moving', 'found-seed'); ?>
                           <?php renderProgramCard('ANKUR', 'Target 2029', 'Class IX to X Moving', 'found-ankur'); ?>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Spotlight (Static Info) -->
<section class="py-6 bg-light border-top border-bottom">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-12">
                <div class="feature-item-pro">
                    <div class="feature-icon-minimal text-primary mb-0 flex-shrink-0">
                        <i class="fas fa-microchip fa-2x"></i>
                    </div>
                    <div class="feature-text">
                        <h4 class="fw-bold mb-2">Adaptive Methodology</h4>
                        <p class="text-muted small mb-0">Scientific curriculum designed to evolve with changing exam patterns.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="feature-item-pro">
                    <div class="feature-icon-minimal text-primary mb-0 flex-shrink-0">
                        <i class="fas fa-users-viewfinder fa-2x"></i>
                    </div>
                    <div class="feature-text">
                        <h4 class="fw-bold mb-2">Expert Mentorship</h4>
                        <p class="text-muted small mb-0">Faculty consists of industry veterans and academic experts.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="feature-item-pro">
                    <div class="feature-icon-minimal text-primary mb-0 flex-shrink-0">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <div class="feature-text">
                        <h4 class="fw-bold mb-2">Rigorous Assessment</h4>
                        <p class="text-muted small mb-0">Continuous periodic evaluations and detailed performance analytics.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
/**
 * Helper: Render Program Card
 */
function renderProgramCard($title, $target, $eligibility, $modal_id) {
?>
<div class="col-lg-4 col-md-6">
    <div class="program-card-pro h-100">
        <div class="pc-head">
            <div class="pc-marker"><?php echo $target; ?></div>
            <h3 class="pc-title"><?php echo $title; ?></h3>
        </div>
        <div class="pc-body">
            <p class="pc-eligibility"><?php echo $eligibility; ?></p>
            <ul class="pc-list">
                <li><i class="fas fa-circle-check"></i> Standardized Study Modules</li>
                <li><i class="fas fa-circle-check"></i> Diagnostic Test Series</li>
                <li><i class="fas fa-circle-check"></i> Structured Doubt Forums</li>
            </ul>
        </div>
        <div class="pc-foot">
            <button class="btn-pro-outline w-100" data-bs-toggle="modal" data-bs-target="#mod-<?php echo $modal_id; ?>">
                PROGRAM SPECIFICATIONS <i class="fas fa-arrow-right-long ms-2"></i>
            </button>
        </div>
    </div>
</div>
<?php
}

/**
 * Helper: Render Program Modal
 */
function renderProgramModal($id, $title, $batch, $reg_start, $reg_end, $start_date, $adm_elig, $about = "", $target_year = "2026") {
?>
<div class="modal fade" id="mod-<?php echo $id; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered shadow-2xl">
        <div class="modal-content border-0 rounded-0 overflow-hidden">
            <div class="row g-0">
                <!-- Sidebar Info (Institutional Datasheet) -->
                <div class="col-lg-4 bg-dark text-white p-5 d-flex flex-column">
                    <div class="mb-auto">
                        <img src="assets/images/logo.png" alt="Logo" height="60" class="mb-5">
                        <h6 class="text-primary fw-bold tracking-wider mb-2">TECHNICAL DATASHEET</h6>
                        <h2 class="fw-black h3 mb-4 text-white"><?php echo $title; ?> <span class="opacity-50 fs-6 d-block mt-1"><?php echo $batch; ?></span></h2>
                    </div>
                    
                    <div class="spec-table mt-4 mb-5">
                        <div class="spec-row">
                            <span class="label">TARGET YEAR</span>
                            <span class="value"><?php echo $target_year; ?></span>
                        </div>
                        <div class="spec-row">
                            <span class="label">REGISTRATION WINDOW</span>
                            <span class="value"><?php echo $reg_start; ?> — <?php echo $reg_end; ?></span>
                        </div>
                        <div class="spec-row">
                            <span class="label">ACADEMIC SESSION COMMENCEMENT</span>
                            <span class="value text-primary"><?php echo $start_date; ?></span>
                        </div>
                        <div class="spec-row border-0">
                            <span class="label">ADMISSION ELIGIBILITY</span>
                            <span class="value"><?php echo $adm_elig; ?></span>
                        </div>
                    </div>

                    <div class="mt-auto action-stack">
                        <a href="<?php echo BASE_URL; ?>scholarship" class="btn btn-primary w-100 rounded-0 py-3 fw-bold mb-3">REGISTER FOR ESAT</a>
                        <a href="https://wa.me/919934244522?text=I'm interested in <?php echo urlencode($title . ' ' . $batch); ?>" class="btn btn-outline-success w-100 rounded-0 py-3 fw-bold mb-3 border-secondary text-white"><i class="fab fa-whatsapp me-2"></i> WHATSAPP ENQUIRY</a>
                        <a href="<?php echo BASE_URL; ?>contact" class="btn btn-outline-light w-100 rounded-0 py-3 fw-bold opacity-75">FILL ENQUIRY FORM</a>
                    </div>
                </div>

                <!-- Main Content (Academic Architecture) -->
                <div class="col-lg-8 bg-white p-5 p-md-6 position-relative scroll-vertical" style="max-height: 90vh; overflow-y: auto;">
                    <button type="button" class="btn-close shadow-none position-absolute top-0 end-0 m-4" data-bs-dismiss="modal"></button>
                    
                    <div class="modal-body-pro">
                        <section class="mb-5">
                            <h5 class="fw-black mb-3 border-bottom pb-2 tracking-tighter">ABOUT THE COURSE</h5>
                            <p class="text-secondary leading-relaxed lh-base"><?php echo $about ? $about : "Comprehensive classroom learning with highly qualified faculty, printed study material, and a motivated peer environment."; ?></p>
                        </section>

                        <!-- Academic Pillars -->
                        <div class="row g-5">
                            <!-- Column 1 -->
                            <div class="col-md-6">
                                <div class="academic-block mb-5">
                                    <h6 class="fw-black text-dark mb-3 text-uppercase small tracking-wider"><i class="fas fa-microscope text-primary me-2"></i> Concept Learning</h6>
                                    <div class="ps-4 border-start border-primary border-2">
                                        <div class="mb-3">
                                            <p class="fw-bold mb-1 small">Expert Faculty Guidance</p>
                                            <p class="very-small text-muted mb-0">Classes by dedicated teachers with a strong focus on concept clarity and exam-oriented preparation.</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 small">Advanced Environment</p>
                                            <p class="very-small text-muted mb-0">Well-equipped, comfortable classrooms designed for a focused learning atmosphere.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="academic-block mb-5">
                                    <h6 class="fw-black text-dark mb-3 text-uppercase small tracking-wider"><i class="fas fa-book-open text-primary me-2"></i> Designed Study Material</h6>
                                    <div class="ps-4 border-start border-primary border-2">
                                        <div class="mb-3">
                                            <p class="fw-bold mb-1 small">Concept Practice Sheets</p>
                                            <p class="very-small text-muted mb-0">Specially designed worksheets to strengthen concepts and improve problem-solving speed.</p>
                                        </div>
                                        <div class="mb-3">
                                            <p class="fw-bold mb-1 small">Topic-Based Modules</p>
                                            <p class="very-small text-muted mb-0">Level-wise exercises, Important questions, and PYQs for deeper understanding.</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 small">Revision Material</p>
                                            <p class="very-small text-muted mb-0">Revision Practice sheets post-course completion for final consolidation.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="col-md-6">
                                <div class="academic-block mb-5">
                                    <h6 class="fw-black text-dark mb-3 text-uppercase small tracking-wider"><i class="fas fa-chart-line text-primary me-2"></i> Systematic Test</h6>
                                    <div class="ps-4 border-start border-primary border-2">
                                        <div class="mb-3">
                                            <p class="fw-bold mb-1 small">Regular & Full-Length Tests</p>
                                            <p class="very-small text-muted mb-0">Chapter-wise tests to monitor progress and Mock Exams to build competitive confidence.</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 small">Performance Analysis</p>
                                            <p class="very-small text-muted mb-0">Detailed feedback to identify strengths and improve weak areas systematically.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="academic-block mb-5">
                                    <h6 class="fw-black text-dark mb-3 text-uppercase small tracking-wider"><i class="fas fa-hand-holding-heart text-primary me-2"></i> Additional Support</h6>
                                    <div class="ps-4 border-start border-primary border-2">
                                        <div class="mb-3">
                                            <p class="fw-bold mb-1 small">Doubt-Solving Sessions</p>
                                            <p class="very-small text-muted mb-0">Special sessions to clarify complex concepts and ensure complete understanding.</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 small">Personalized Mentorship</p>
                                            <p class="very-small text-muted mb-0">Regular guidance to support academic growth and keep students motivated.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Full Width Interaction Section -->
                        <div class="bg-light p-4 border mb-4 mt-2">
                            <h6 class="fw-black text-dark mb-3 text-uppercase small tracking-wider">Student & Parent Interaction</h6>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <p class="fw-bold mb-1 small">Career Guidance Programs</p>
                                    <p class="very-small text-muted mb-0">Expert sessions on competitive exams, career options, and future opportunities.</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold mb-1 small">Regular PTM</p>
                                    <p class="very-small text-muted mb-0">Frequent interactions to keep parents informed and ensure student success.</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <p class="small text-muted mb-3">Interested in assessing your potential? Get the ESAT Sample Paper now.</p>
                            <a href="<?php echo BASE_URL; ?>study-material" class="btn btn-outline-dark rounded-0 px-4 py-2 fw-bold text-uppercase small">Get ESAT Sample Paper <i class="fas fa-download ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

// Batch Details Content
$neet_desc = "This classroom program builds strong concepts for success in school exams while rigorously preparing students for NEET and other medical competitive exams.";
$jee_desc = "Focused engineering entrance preparation designed to bridge the gap between school curriculum and the level required for JEE Main & Advanced.";

// Generate NEET Modals
renderProgramModal('neet-seed', 'SEED (NEET)', 'Class IX', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Direct Admission', 'Classroom learning with highly qualified faculty, printed study material, DPPs, and test series in a healthy environment.', '2030');
renderProgramModal('neet-ankur', 'ANKUR (NEET)', 'Class X', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Through Ekalavya Scholarship Admission Test', $neet_desc, '2029');
renderProgramModal('neet-nurture', 'NURTURE (NEET)', 'Class XI', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Through Ekalavya Scholarship Admission Test', $neet_desc, '2028');
renderProgramModal('neet-emerge', 'EMERGE (NEET)', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Class XII', 'Through Ekalavya Scholarship Admission Test', $neet_desc, '2027');
renderProgramModal('neet-impulse', 'IMPULSE (NEET)', 'Class XII Pass', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Through Ekalavya Scholarship Admission Test', $neet_desc, '2026');

// Generate JEE Modals
renderProgramModal('jee-seed', 'SEED (JEE)', 'Class IX', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Direct Admission', 'Concept learning and expert faculty guidance for early engineering aspirants.', '2030');
renderProgramModal('jee-nurture', 'NURTURE (JEE)', 'Class XI', '01 Feb 2025', '30 Apr 2025', '15 Apr 2025', 'Through Ekalavya Scholarship Admission Test', $jee_desc, '2028');

// Generate Foundation Modals
renderProgramModal('found-seed', 'SEED (FOUNDATION)', 'Class IX', '01 Apr 2026', '30 Apr 2026', '16 Apr 2026', 'Direct Admission', 'Building strong fundamentals for school excellence and competitive readiness.', '2030');
renderProgramModal('found-ankur', 'ANKUR (FOUNDATION)', 'Class X', '25 Mar 2026', '25 Apr 2026', '16 Apr 2026', 'Direct Admission', 'Comprehensive foundation program for Class X Board exams and future competitive pathways.', '2029');
?>

<style>
/* --- Professional UI Overrides --- */
/* Premium Pill Tab UI */
.program-tab-btn-new {
    border: 1px solid #f1f5f9 !important;
    border-radius: 24px !important;
    padding: 10px 30px 10px 10px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #ffffff;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    text-decoration: none;
}
.program-tab-btn-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
}
.program-tab-btn-new .tab-icon-box {
    width: 50px;
    height: 50px;
    border-radius: 16px;
    background: #f8fafc;
    color: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    transition: all 0.3s ease;
}
.program-tab-btn-new .tab-title {
    display: block;
    font-size: 1.1rem;
    font-weight: 900;
    color: #0f172a;
    line-height: 1.2;
    transition: all 0.3s ease;
    text-transform: uppercase;
}
.program-tab-btn-new .tab-subtitle {
    display: block;
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 600;
    transition: all 0.3s ease;
}

/* Active State */
.program-tab-btn-new.active {
    background: #0f172a !important;
    border-color: #0f172a !important;
    box-shadow: 0 10px 25px rgba(15,23,42,0.2);
}
.program-tab-btn-new.active .tab-icon-box {
    background: #f97316;
    color: #ffffff;
    box-shadow: 0 5px 15px rgba(249,115,22,0.4);
}
.program-tab-btn-new.active .tab-title {
    color: #ffffff;
}
.program-tab-btn-new.active .tab-subtitle {
    color: #94a3b8;
}

/* Program Card Pro Styling */
.program-card-pro {
    background: #1D2435;
    border: none;
    border-radius: 24px;
    padding: 40px;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
.program-card-pro::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-color);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}
.program-card-pro:hover::before {
    transform: scaleX(1);
}
.program-card-pro:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(249,115,22,0.1);
}
.pc-marker {
    display: inline-block;
    background: rgba(249,115,22,0.15);
    color: #f97316;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 20px;
}
.pc-title {
    font-size: 2rem;
    font-weight: 900;
    margin-bottom: 20px;
    color: #ffffff;
}
.pc-eligibility {
    background: rgba(255,255,255,0.05);
    color: #cbd5e1;
    padding: 12px 18px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 25px;
    border-left: 3px solid #f97316;
    min-height: 48px;
    display: flex;
    align-items: center;
}
.pc-list {
    list-style: none;
    padding: 0;
    margin-bottom: 35px;
}
.pc-list li {
    font-size: 0.9rem;
    color: #cbd5e1;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    font-weight: 500;
}
.pc-list li i {
    color: #f97316;
    background: rgba(249,115,22,0.15);
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 0.8rem;
}
.btn-pro-outline {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    color: #ffffff;
    padding: 16px 20px;
    font-weight: 800;
    font-size: 0.8rem;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.btn-pro-outline:hover {
    background: #f97316;
    border-color: #f97316;
    color: #fff;
    box-shadow: 0 10px 20px rgba(249,115,22,0.2);
}

/* Feature Spotlight Pro Styling (Light Blue Pill Layout) */
.feature-item-pro {
    background: #F0F5FF;
    border-radius: 20px;
    padding: 30px 25px;
    display: flex;
    align-items: center;
    text-align: left;
    box-shadow: 0 10px 25px rgba(0,0,0,0.02);
    transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    height: 100%;
    border: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
}
.feature-item-pro:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.06);
}
.feature-item-pro h4 {
    color: #0f172a !important;
    font-size: 1.25rem;
    font-weight: 900;
    margin-bottom: 6px !important;
    letter-spacing: -0.5px;
}
.feature-item-pro p.text-muted {
    color: #475569 !important;
    font-size: 0.85rem;
    line-height: 1.4;
}
.feature-icon-minimal {
    width: 65px;
    height: 65px;
    background: #ffffff;
    color: #f97316 !important;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 1.6rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.feature-item-pro:hover .feature-icon-minimal {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(135deg, #f97316, #ea580c);
    color: #ffffff !important;
    box-shadow: 0 15px 35px rgba(249,115,22,0.3);
}

/* Modal Pro Layout */
.spec-table {
    display: flex;
    flex-direction: column;
}
.spec-row {
    padding: 20px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.spec-row .label {
    display: block;
    font-size: 0.65rem;
    font-weight: 700;
    color: white;
    opacity: 0.4;
    margin-bottom: 8px;
    letter-spacing: 1px;
}
.spec-row .value {
    display: block;
    font-size: 0.95rem;
    font-weight: 600;
    color: white;
}
.brightness-200 { filter: brightness(2); }
.academic-feature {
    border-left: 3px solid #eee;
    padding-left: 20px;
    transition: all 0.3s ease;
}
.academic-feature:hover {
    border-color: var(--primary-color);
}
</style>

<?php include 'includes/footer.php'; ?>
