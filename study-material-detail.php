<?php 
include_once 'config/database.php';

// Fetch study material details
$material = null;
if (isset($_GET['slug'])) {
    $stmt = $pdo->prepare("SELECT * FROM study_material WHERE slug = :slug");
    $stmt->execute(['slug' => $_GET['slug']]);
    $material = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM study_material WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['id']]);
    $material = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Redirect if not found
if (!$material) {
    header('Location: ' . BASE_URL . 'study-material.php');
    exit();
}

include 'includes/header.php';

$cat = strtolower($material['category']);
$icon = 'fa-file-pdf';
if (strpos($cat, 'physic') !== false) { $icon = 'fa-rocket'; }
elseif (strpos($cat, 'chem') !== false) { $icon = 'fa-flask'; }
elseif (strpos($cat, 'math') !== false) { $icon = 'fa-square-root-alt'; }
elseif (strpos($cat, 'biol') !== false) { $icon = 'fa-dna'; }
?>

<!-- Professional Page Header -->
<section class="page-header study-vault-header" style="padding: 40px 0 !important;">
    <div class="container text-center">
        <h1 class="mb-0"><?php echo htmlspecialchars($material['title']); ?></h1>
    </div>
</section>

<!-- Detail Ecosystem -->
<section class="material-detail-body py-6 bg-white">
    <div class="container container-1440">
        <div class="row g-5">
            <!-- Left Column: Knowledge -->
            <div class="col-lg-8">
                <div class="detail-main-content pe-lg-4">
                    
                    <!-- Overview Section -->
                    <div class="overview-section mb-6">
                        <div class="d-flex align-items-center gap-3 mb-4">
                             <div class="icon-portal bg-primary text-white p-3 rounded-4 shadow-lg">
                                 <i class="fas <?php echo $icon; ?> fs-3"></i>
                             </div>
                             <div>
                                 <h2 class="fw-black mb-0">MODULE <span class="text-primary">INSIGHTS</span></h2>
                                 <p class="text-muted small mb-0">Comprehensive coverage of <?php echo htmlspecialchars($material['title']); ?></p>
                             </div>
                        </div>

                        <div class="description-text lead text-muted mb-5">
                            Expertly crafted educational resources designed by senior faculty to bridge the gap between classroom teaching and competitive examination patterns. This module features graded exercises and conceptual theory maps.
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="premium-feature-pill d-flex align-items-center gap-4 p-4 rounded-5 bg-white border border-light shadow-sm transition-all hover-translate-y">
                                    <div class="feature-icon bg-orange-soft text-primary rounded-circle d-flex align-items-center justify-content-center shadow-inner" style="width: 65px; height: 65px; flex-shrink: 0;">
                                        <i class="fas fa-check-double fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-black mb-1">NCERT Aligned</h6>
                                        <p class="very-small text-muted mb-0">Strictly follows the latest NTA/CBSE syllabus benchmarks.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="premium-feature-pill d-flex align-items-center gap-4 p-4 rounded-5 bg-white border border-light shadow-sm transition-all hover-translate-y">
                                    <div class="feature-icon bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center shadow-inner" style="width: 65px; height: 65px; flex-shrink: 0;">
                                        <i class="fas fa-pencil-ruler fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-black mb-1">Solved Examples</h6>
                                        <p class="very-small text-muted mb-0">Step-by-step solutions to past year competitive problems.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Roadmap section -->
                    <div class="roadmap-section mb-6 wow-container">
                        <!-- Decorative Blobs -->
                        <div class="wow-blob" style="top: -50px; left: -100px;"></div>
                        <div class="wow-blob" style="bottom: -50px; right: -100px; background: radial-gradient(circle, rgba(10,31,68, 0.05) 0%, transparent 70%);"></div>

                        <div class="section-title-wrap d-flex align-items-center gap-3 mb-5">
                            <h2 class="fw-black mb-0">ACADEMIC <span class="text-primary">DEPTH</span></h2>
                            <div class="flex-grow-1 border-top opacity-10"></div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="glass-pill-premium h-100 position-relative overflow-hidden text-center">
                                    <div class="wow-icon-wrap mx-auto">
                                        <i class="fas fa-map-marked-alt fs-2 text-primary"></i>
                                    </div>
                                    <div class="mastery-tag-wow">Foundational</div>
                                    <h4 class="fw-black mb-3">Theory Map</h4>
                                    <p class="very-small text-muted mb-0">Visual summary of all core concepts and formulas mapping to JEE/NEET weightage.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="glass-pill-premium h-100 position-relative overflow-hidden text-center">
                                    <div class="wow-icon-wrap mx-auto">
                                        <i class="fas fa-tasks fs-2 text-primary"></i>
                                    </div>
                                    <div class="mastery-tag-wow">Application</div>
                                    <h4 class="fw-black mb-3">Graded MCQ</h4>
                                    <p class="very-small text-muted mb-0">Exercises meticulously categorized from conceptual basics to elite rank-booster levels.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="glass-pill-premium h-100 position-relative overflow-hidden text-center">
                                    <div class="wow-icon-wrap mx-auto">
                                        <i class="fas fa-brain fs-2 text-primary"></i>
                                    </div>
                                    <div class="mastery-tag-wow">Revision</div>
                                    <h4 class="fw-black mb-3">Mind Maps</h4>
                                    <p class="very-small text-muted mb-0">Specialized cognitive flowcharts designed for rapid active recall during exam cycles.</p>
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
                            <span class="badge bg-primary px-3 py-2 rounded-pill"><?php echo strtoupper($material['type'] ?: 'PDF'); ?></span>
                            <span class="text-muted small fw-bold uppercase">Resource Portal</span>
                        </div>
                        
                        <h4 class="fw-black mb-1"><?php echo htmlspecialchars($material['title']); ?></h4>
                        <p class="text-muted small mb-4"><?php echo htmlspecialchars($material['category']); ?></p>
                        
                        <div class="divider mb-4" style="height: 1px; background: #eee;"></div>
                        
                        <div class="vstack gap-3 mb-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Update Date:</span>
                                <span class="fw-bold"><?php echo date('M Y', strtotime($material['created_at'])); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Access:</span>
                                <span class="fw-bold text-success">Institutional</span>
                            </div>
                        </div>

                        <div class="cta-stack vstack gap-3">
                            <button class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg" data-bs-toggle="modal" data-bs-target="#enquiryModal" data-course="Module: <?php echo htmlspecialchars($material['title']); ?>">REQUEST ACCESS <i class="fas fa-unlock-alt ms-2"></i></button>
                            <?php if(!empty($material['file_path'])): ?>
                                <a href="<?php echo SITE_URL; ?>document-viewer?file=<?php echo urlencode($material['file_path']); ?>&title=<?php echo urlencode($material['title']); ?>" target="_blank" class="btn btn-outline-primary w-100 py-3 rounded-pill fw-bold">VIEW DOCUMENT</a>
                            <?php endif; ?>
                            <a href="https://wa.me/919934244522?text=I'd like to access the <?php echo urlencode($material['title']); ?> study module" target="_blank" class="btn btn-outline-success w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="fab fa-whatsapp fs-5"></i> WHATSAPP US
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
