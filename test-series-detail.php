<?php 
include 'config/database.php';

// Fetch test series details
$test = null;
if (isset($_GET['slug'])) {
    $stmt = $pdo->prepare("SELECT * FROM test_series WHERE slug = :slug");
    $stmt->execute(['slug' => $_GET['slug']]);
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM test_series WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['id']]);
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Redirect if not found
if (!$test) {
    header('Location: ' . BASE_URL . 'test-series.php');
    exit();
}

include 'includes/header.php'; 
?>

<!-- Professional Page Header -->
<section class="page-header test-series-header" style="padding: clamp(30px, 6vh, 60px) 0 !important;">
        <h1 style="font-size: clamp(1.8rem, 8vw, 3.5rem); line-height: 1.1;"><?php echo htmlspecialchars($test['title']); ?></h1>
        <p class="mb-0 small opacity-75"><?php echo htmlspecialchars($test['category'] ?: 'National Level Testing'); ?> • Academic Excellence</p>
    </div>
</section>

<!-- Detail Ecosystem -->
<section class="test-detail-body py-6 bg-white">
    <div class="container container-1440">
        <div class="row g-5">
            <!-- Left Column: Knowledge -->
            <div class="col-lg-8">
                <div class="detail-main-content pe-lg-4">
                    
                    <!-- Overview Card -->
                    <div class="overview-section mb-6">
                        <h2 class="fw-black mb-4">PROGRAM <span class="text-primary">ARCHITECTURE</span></h2>
                        <div class="description-text lead text-muted mb-5">
                            <?php echo nl2br(htmlspecialchars($test['description'])); ?>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="highlight-item d-flex align-items-start gap-3 p-4 bg-light rounded-4">
                                    <div class="icon-wrap bg-white text-primary p-3 rounded-circle shadow-sm">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Rank Analytics</h6>
                                        <p class="small text-muted mb-0">AI-driven predictive rank reporting based on national data.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="highlight-item d-flex align-items-start gap-3 p-4 bg-light rounded-4">
                                    <div class="icon-wrap bg-white text-primary p-3 rounded-circle shadow-sm">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Adaptive Testing</h6>
                                        <p class="small text-muted mb-0">Question difficulty maps to your past performance profile.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Curriculum Map -->
                    <div class="curriculum-section mb-6">
                        <h2 class="fw-black mb-4">PACKAGE <span class="text-primary">HIGHLIGHTS</span></h2>
                        <div class="row g-4">
                            <?php 
                                $features = explode("\n", $test['features'] ?? '');
                                foreach($features as $feat): 
                                    if(empty(trim($feat))) continue;
                            ?>
                            <div class="col-md-6">
                                <div class="feature-bullet d-flex align-items-center gap-3">
                                    <div class="bullet-check bg-primary bg-opacity-10 text-primary rounded-circle p-1" style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem;">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="text-muted small fw-bold"><?php echo htmlspecialchars(trim($feat)); ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Roadmap Map -->
                    <div class="curriculum-section mb-6">
                        <h2 class="fw-black mb-4">TESTING <span class="text-primary">ROADMAP</span></h2>
                        <div class="accordion studio-accordion" id="testAccordion">
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#phase1">
                                        Phase 1: Unit & Part Tests
                                    </button>
                                </h2>
                                <div id="phase1" class="accordion-collapse collapse show" data-bs-parent="#testAccordion">
                                    <div class="accordion-body text-muted">
                                        Focused assessments covering specific chapters to ensure conceptual clarity and building base speed.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#phase2">
                                        Phase 2: Combined Syllabus Tests
                                    </button>
                                </h2>
                                <div id="phase2" class="accordion-collapse collapse" data-bs-parent="#testAccordion">
                                    <div class="accordion-body text-muted">
                                        Integrating multiple units to test retention and cross-functional problem solving.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#phase3">
                                        Phase 3: National Mock Marathons
                                    </button>
                                </h2>
                                <div id="phase3" class="accordion-collapse collapse" data-bs-parent="#testAccordion">
                                    <div class="accordion-body text-muted">
                                        Full syllabus replica tests of JEE/NEET with real-time analytics and All India Ranking.
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
                    <div class="course-summary-card p-4 rounded-4 bg-white border border-light shadow-2xl" style="max-width: 400px; margin-left: auto;">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="badge bg-primary px-2 py-1 rounded-pill very-small">LIVE</span>
                            <span class="text-muted very-small fw-bold uppercase">Enrollment Open</span>
                        </div>
                        
                        <h5 class="fw-black mb-1"><?php echo htmlspecialchars($test['title']); ?></h5>
                        <p class="text-muted very-small mb-4 uppercase tracking-widest">Precision Testing Program</p>
                        
                        <div class="divider mb-3" style="height: 1px; background: #eee;"></div>
                        
                        <div class="vstack gap-2 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted very-small fw-bold">Course Price:</span>
                                <span class="fw-bold text-primary small"><?php echo !empty($test['price']) ? htmlspecialchars($test['price']) : 'FREE'; ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted very-small fw-bold">Category:</span>
                                <span class="fw-bold small"><?php echo htmlspecialchars($test['category'] ?: 'General'); ?></span>
                            </div>
                        </div>

                        <div class="cta-stack vstack gap-2">
                            <button class="btn btn-primary w-100 py-2 rounded-2 fw-black shadow-lg small" data-bs-toggle="modal" data-bs-target="#enquiryModal" data-course="Test Series: <?php echo htmlspecialchars($test['title']); ?>">ENROLL NOW <i class="fas fa-paper-plane ms-2"></i></button>
                            <?php if(!empty($test['link'])): ?>
                                <a href="#" class="btn btn-warning w-100 py-2 rounded-2 fw-black small text-white">PORTAL ACCESS</a>
                            <?php endif; ?>
                            <a href="https://wa.me/919934244522?text=I'm interested in the <?php echo urlencode($test['title']); ?> test series" target="_blank" class="btn btn-outline-success w-100 py-2 rounded-2 fw-bold d-flex align-items-center justify-content-center gap-2 small">
                                <i class="fab fa-whatsapp"></i> WHATSAPP
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
