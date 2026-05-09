<?php 
include 'includes/header.php'; 

// Fetch scholarship details
$scholarship = null;
if (isset($_GET['slug'])) {
    $stmt = $pdo->prepare("SELECT * FROM scholarship_programs WHERE slug = :slug");
    $stmt->execute(['slug' => $_GET['slug']]);
    $scholarship = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM scholarship_programs WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['id']]);
    $scholarship = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$scholarship) {
    header("Location: " . BASE_URL . "scholarship.php");
    exit();
}
?>

<!-- Professional Page Header -->
<section class="page-header">
    <div class="container text-center">
        <h1><?php echo htmlspecialchars($scholarship['title']); ?></h1>
        <p>Merit Recognition Program • Deadline: <?php echo htmlspecialchars($scholarship['deadline']); ?></p>
        <div class="breadcrumb-wrap">
            <a href="<?php echo BASE_URL; ?>">Home</a>
            <span class="breadcrumb-separator">></span>
            <a href="<?php echo BASE_URL; ?>scholarship">Scholarship</a>
            <span class="breadcrumb-separator">></span>
            <span><?php echo htmlspecialchars($scholarship['title']); ?></span>
        </div>
    </div>
</section>

<!-- Detail Ecosystem -->
<section class="scholarship-detail-body py-6 bg-white">
    <div class="container container-1440">
        <div class="row g-5">
            <!-- Left Column: Knowledge -->
            <div class="col-lg-8">
                <div class="detail-main-content pe-lg-4">
                    
                    <!-- Overview Card -->
                    <div class="overview-section mb-6">
                        <h2 class="fw-black mb-4">REWARD <span class="text-primary">OVERVIEW</span></h2>
                        <div class="description-text lead text-muted mb-5">
                            <?php echo nl2br(htmlspecialchars($scholarship['description'])); ?>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="highlight-item d-flex align-items-start gap-3 p-4 bg-light rounded-4">
                                    <div class="icon-wrap bg-white text-primary p-3 rounded-circle shadow-sm">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Eligibility Criteria</h6>
                                        <p class="small text-muted mb-0"><?php echo htmlspecialchars($scholarship['eligibility']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="highlight-item d-flex align-items-start gap-3 p-4 bg-light rounded-4">
                                    <div class="icon-wrap bg-white text-primary p-3 rounded-circle shadow-sm">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Registration Deadline</h6>
                                        <p class="small text-muted mb-0"><?php echo htmlspecialchars($scholarship['deadline']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Process Section -->
                    <div class="process-section mb-6">
                        <h2 class="fw-black mb-4">SELECTION <span class="text-primary">PROCESS</span></h2>
                        <div class="accordion studio-accordion" id="processAccordion">
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step1">
                                        Step 1: Online Registration
                                    </button>
                                </h2>
                                <div id="step1" class="accordion-collapse collapse show" data-bs-parent="#processAccordion">
                                    <div class="accordion-body text-muted">
                                        Fill the digital application form with your academic details and upload the required documents for verification.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step2">
                                        Step 2: Institutional Assessment
                                    </button>
                                </h2>
                                <div id="step2" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                                    <div class="accordion-body text-muted">
                                        Appear for the ESAT assessment (Offline/Online) or submit your board percentile for direct merit slab mapping.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step3">
                                        Step 3: Counseling & Award
                                    </button>
                                </h2>
                                <div id="step3" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                                    <div class="accordion-body text-muted">
                                        Successful candidates will be invited for a one-on-one session with the Director and issued the scholarship certificate.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 140px; z-index: 5;">
                    <div class="course-summary-card p-5 rounded-5 bg-white border border-light shadow-2xl">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="badge bg-primary px-3 py-2 rounded-pill">OPEN</span>
                            <span class="text-muted small fw-bold uppercase">Reward Program</span>
                        </div>
                        
                        <h4 class="fw-black mb-1"><?php echo htmlspecialchars($scholarship['title']); ?></h4>
                        <p class="text-muted small mb-4">Merit-Based Scholarship</p>
                        
                        <div class="divider mb-4" style="height: 1px; background: #eee;"></div>
                        
                        <div class="vstack gap-3 mb-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Target:</span>
                                <span class="fw-bold">Elite Students</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Type:</span>
                                <span class="fw-bold">Tuition Waiver</span>
                            </div>
                        </div>

                        <div class="cta-stack vstack gap-3">
                            <button class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg" data-bs-toggle="modal" data-bs-target="#enquiryModal" data-course="Scholarship: <?php echo htmlspecialchars($scholarship['title']); ?>">APPLY NOW <i class="fas fa-paper-plane ms-2"></i></button>
                            <a href="https://wa.me/919934244522?text=I'm interested in the <?php echo urlencode($scholarship['title']); ?> scholarship" target="_blank" class="btn btn-outline-success w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="fab fa-whatsapp fs-5"></i> WHATSAPP US
                            </a>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="<?php echo BASE_URL; ?>scholarship#programs" class="text-decoration-none text-muted small fw-bold uppercase hover-primary">
                            <i class="fas fa-chevron-left me-2"></i> All Programs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
