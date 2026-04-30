<?php 
include 'includes/header.php'; 

// Fetch filters from URL
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

// Build dynamic query
$query = "SELECT * FROM test_series WHERE 1=1";
$params = [];

if ($category) {
    $query .= " AND (category LIKE ? OR title LIKE ?)";
    $params[] = "%$category%";
    $params[] = "%$category%";
}

if ($type) {
    $query .= " AND (title LIKE ? OR category LIKE ? OR description LIKE ?)";
    $params[] = "%$type%";
    $params[] = "%$type%";
    $params[] = "%$type%";
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$db_tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Dynamic Content Logic ---
$display_category = !empty($category) ? $category : "Competitive";
$header_title = "Boost your $display_category prep with our <span class='text-primary'>Online Test Series</span>";
$header_subtitle = "PHASE 1 STARTS 3RD MAY ✨";

$lifecycle_title = "THE TESTING <span class='text-primary'>LIFECYCLE</span>";
$lifecycle_desc = "At Ekalavya, testing is an iterative evolution of your examination temperament through AI-driven analytics.";
$card1_badge = "FLAGSHIP";
$card1_title = "AITS 2026";
$card1_sub = "National Rank Forecasting";
$card1_bg = "linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%)";

$card2_badge = "ADVANCED";
$card2_title = "AI Benchmarking";
$card2_sub = "Concept-wise Heatmaps";
$card2_bg = "linear-gradient(135deg, #ff8f00 0%, #e65100 100%)";

$note_title = "Precision Analytics Note";
$note_desc = "Every assessment report includes an error-mapping matrix classifying mistakes into conceptual, psychological, or calculation errors.";

if ($type == 'FullLength') {
    $lifecycle_title = "THE PERFORMANCE <span class='text-primary'>BENCHMARK</span>";
    $lifecycle_desc = "Full-length simulations designed to replicate the actual exam environment, building the endurance and temperament needed for the big day.";
} elseif ($type == 'Chapterwise') {
    $lifecycle_title = "THE MASTERY <span class='text-primary'>ROADMAP</span>";
    $lifecycle_desc = "Strengthen your foundations with micro-level testing. Identify and bridge conceptual gaps chapter by chapter before moving to the next level.";
    $card1_badge = "FOCUSED";
    $card1_title = "Topic Drills";
    $card1_sub = "Chapter-wise Proficiency";
    $card2_badge = "REMEDIATION";
    $card2_title = "Error Analysis";
    $card2_sub = "Targeted Improvement";
    $note_title = "Concept Clarity Note";
    $note_desc = "These tests focus on granular understanding and immediate feedback to ensure no topic is left behind in your preparation journey.";
}
?>

<!-- Premium Green Grid Header (Allen Inspired) -->
<section class="page-header-green" style="background: #009E60; position: relative; overflow: hidden; padding: 25px 0 !important; border-bottom: 3px solid #FF8F00;">
    <div class="header-grid-pattern"></div>
    <div class="container position-relative z-index-10">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2 gap-md-4 text-white text-center">
            <div class="d-flex align-items-center gap-2 text-warning fw-black text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                <i class="fas fa-bullhorn animate__animated animate__pulse animate__infinite"></i>
                <span><?php echo $header_subtitle; ?></span>
            </div>
            <div class="vr d-none d-md-block bg-white opacity-25" style="height: 20px;"></div>
            <div class="fw-bold d-flex align-items-center gap-2" style="font-size: 0.95rem;">
                <span><?php echo $header_title; ?></span>
                <i class="fas fa-chevron-right small opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<style>
.header-grid-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
    background-size: 25px 25px;
    z-index: 1;
}
</style>

<!-- Testing Ecosystem -->
<main class="testing-portal bg-white py-6">
    <div class="container container-1440">
        
        <!-- Section 1: Top Engagement Split (Core Testing vs Enrollment) -->
        <div class="row g-5 mb-6">
            <!-- Left Side: Assessment Roadmap -->
            <div class="col-lg-8">
                <div class="pe-lg-5">
                    <h2 class="fw-black mb-4 h1" style="font-size: clamp(1.1rem, 6.2vw, 2.8rem); white-space: nowrap; letter-spacing: -0.8px;"><?php echo $lifecycle_title; ?></h2>
                    <p class="text-muted lead mb-5"><?php echo $lifecycle_desc; ?></p>
                    
                    <div class="feature-ecosystem row g-3 mt-2">
                        <!-- Card 1 -->
                        <div class="col-md-6">
                            <div class="spectrum-card p-4 rounded-4 position-relative overflow-hidden shadow-sm h-100 transition-all hover-lift" style="background: <?php echo $card1_bg; ?>; min-height: 130px;">
                                <div class="card-content position-relative z-index-10">
                                    <span class="badge bg-white rounded-pill px-2 py-1 mb-2 fw-black" style="font-size: 0.6rem; letter-spacing: 0.5px; color: #0d47a1;"><?php echo $card1_badge; ?></span>
                                    <h5 class="text-white fw-black mb-1"><?php echo $card1_title; ?></h5>
                                    <p class="text-white very-small mb-0"><?php echo $card1_sub; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-6">
                            <div class="spectrum-card p-4 rounded-4 position-relative overflow-hidden shadow-sm h-100 transition-all hover-lift" style="background: <?php echo $card2_bg; ?>; min-height: 130px;">
                                <div class="card-content position-relative z-index-10">
                                    <span class="badge bg-white rounded-pill px-2 py-1 mb-2 fw-black" style="font-size: 0.6rem; letter-spacing: 0.5px; color: #e65100;"><?php echo $card2_badge; ?></span>
                                    <h5 class="text-white fw-black mb-1"><?php echo $card2_title; ?></h5>
                                    <p class="text-white very-small mb-0"><?php echo $card2_sub; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="analytics-note-minimal mt-5 d-flex align-items-center gap-4 p-4 rounded-4 bg-light border-start border-primary border-4">
                        <div class="note-icon text-primary bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; flex-shrink: 0;">
                            <i class="fas fa-info-circle fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-black text-dark mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;"><?php echo $note_title; ?></h6>
                            <p class="small text-muted mb-0"><?php echo $note_desc; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Fast Portal (Sticky) - Thinner Profile -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 140px; z-index: 5;">
                    <div class="enroll-card compact-form-container shadow-2xl bg-white border border-light p-4 rounded-5" style="max-width: 340px; margin-left: auto;">
                        <div class="text-center mb-5">
                            <h3 class="fw-black mb-1 text-uppercase">Enroll <span class="text-orange">Series</span></h3>
                            <p class="very-small text-muted uppercase fw-bold">Testing Portal <?php echo date('Y'); ?>-<?php echo date('y') + 1; ?></p>
                        </div>
                        <form action="<?php echo BASE_URL; ?>process-enquiry.php" method="POST" class="vstack gap-3">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control bg-light border-0 rounded-3" id="floatingName" placeholder="Full Name" required>
                                <label for="floatingName" class="text-muted small">Full Name</label>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="tel" name="phone" class="form-control bg-light border-0 rounded-3" id="floatingPhone" placeholder="Mobile" required>
                                        <label for="floatingPhone" class="text-muted small">Mobile</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="course" class="form-select bg-light border-0 rounded-3" id="floatingSelect" style="font-size: 0.8rem;" required>
                                            <option value="AITS-JEE">JEE AITS</option>
                                            <option value="NEET-Mock">NEET Mocks</option>
                                            <option value="Found-Test">Foundation</option>
                                        </select>
                                        <label for="floatingSelect" class="text-muted small">Program</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control bg-light border-0 rounded-3" id="floatingEmail" placeholder="Email Address" required>
                                <label for="floatingEmail" class="text-muted small">Email Address</label>
                            </div>
                            
                            <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-black shadow-lg text-white" style="background: #ff8f00; border: none;">ENROLL NOW <i class="fas fa-arrow-right ms-2"></i></button>
                            
                            <div class="text-center mt-3">
                                <a href="https://wa.me/919934244522" class="text-success small fw-bold text-decoration-none">
                                    <i class="fab fa-whatsapp me-2"></i> WHATSAPP HELPLINE
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-6 opacity-10">

        <!-- Section 2: Active Test Catalog -->
        <div class="testing-catalog">
             <div class="section-title mb-5">
                <h2 class="fw-black h1">ACTIVE <span class="text-primary">ASSESSMENTS</span></h2>
                <p class="text-muted">Targeted benchmarking series mapped to the latest competitive examination patterns.</p>
            </div>

            <div class="row g-4">
                <?php if (count($db_tests) > 0): ?>
                    <?php foreach($db_tests as $item): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="prism-test-card p-4 p-md-5 rounded-5 border bg-white shadow-sm h-100 transition-all hover-lift position-relative overflow-hidden">
                            <!-- Geometric Background Decor -->
                            <div class="prism-decor position-absolute" style="top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255, 143, 0, 0.05); border-radius: 40px; transform: rotate(15deg);"></div>
                            
                            <div class="d-flex justify-content-between align-items-start mb-4 position-relative">
                                <div class="prism-badge px-3 py-1 rounded-pill bg-light text-primary very-small fw-black border border-primary border-opacity-10">
                                    <?php echo htmlspecialchars($item['category']); ?>
                                </div>
                                <div class="prism-price text-dark fw-black h4 mb-0">
                                    <span class="small opacity-50 fw-normal">₹</span><?php echo $item['price']; ?>
                                </div>
                            </div>
                            
                            <h4 class="fw-black text-dark mb-4" style="line-height: 1.3; font-size: 1.25rem;"><?php echo htmlspecialchars($item['title']); ?></h4>
                            
                            <div class="prism-features vstack gap-2 mb-5">
                                <div class="d-flex align-items-center gap-2 small text-muted">
                                    <i class="fas fa-check-circle text-orange opacity-50"></i>
                                    <span>Full Syllabus Coverage</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small text-muted">
                                    <i class="fas fa-check-circle text-orange opacity-50"></i>
                                    <span>National Level Ranking</span>
                                </div>
                            </div>
                            
                            <div class="prism-cta mt-auto position-relative">
                                <a href="<?php echo BASE_URL; ?>test-series-detail.php?slug=<?php echo $item['slug']; ?>" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg d-flex align-items-center justify-content-center gap-2 transition-all" style="background: linear-gradient(135deg, #ff8f00 0%, #ff6f00 100%); border: none;">
                                    ENROLL SERIES <i class="fas fa-chevron-right small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><div class="p-5 bg-light rounded-4 text-center"><p class="text-muted mb-0">Testing calendar is being updated by the examination cell.</p></div></div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>
