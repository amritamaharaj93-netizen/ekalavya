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
    $query .= " AND (title LIKE ? OR category LIKE ? OR type LIKE ? OR description LIKE ?)";
    $params[] = "%$type%";
    $params[] = "%$type%";
    $params[] = "%$type%";
    $params[] = "%$type%";
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$db_tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Dynamic Content Logic ---
$is_detail_view = (!empty($category) || !empty($type));
$display_category = !empty($category) ? $category : "Competitive";

// Try to find a specific test series record that matches the filters
$active_test = null;
if (!empty($db_tests)) {
    if ($category || $type) {
        if ($type) {
            foreach ($db_tests as $t) {
                if (strtolower($t['type']) == strtolower($type) || strpos($t['slug'], strtolower($type)) !== false) {
                    $active_test = $t;
                    break;
                }
            }
        }
        if (!$active_test && $category) {
            foreach ($db_tests as $t) {
                if ($t['category'] == $category) {
                    $active_test = $t;
                    break;
                }
            }
        }
    }
}

// Initialize variables with DB values or defaults
$details = json_decode($active_test['details_json'] ?? '[]', true);

$header_title = !empty($active_test['header_title']) ? $active_test['header_title'] : "Boost your $display_category prep with our <span class='text-primary'>Online Test Series</span>";
$header_subtitle = !empty($active_test['header_subtitle']) ? $active_test['header_subtitle'] : "PHASE 1 STARTS 3RD MAY ✨";

$lifecycle_title = !empty($active_test['lifecycle_title']) ? $active_test['lifecycle_title'] : "THE TESTING <span class='text-primary'>LIFECYCLE</span>";
$lifecycle_desc = !empty($active_test['lifecycle_desc']) ? $active_test['lifecycle_desc'] : "At Ekalavya, testing is an iterative evolution of your examination temperament through AI-driven analytics.";

$badge_label = !empty($active_test['badge_label']) ? $active_test['badge_label'] : "TEST SERIES PROGRAM";
$class_label = $active_test['class_label'] ?? "";
$duration_label = !empty($active_test['duration_label']) ? $active_test['duration_label'] : "1 Year";
$allen_subjects = $active_test['subjects'] ?? "";

$card1_badge = $details['card1']['badge'] ?? "FLAGSHIP";
$card1_title = $details['card1']['title'] ?? "AITS 2026";
$card1_sub = $details['card1']['sub'] ?? "National Rank Forecasting";
$card1_bg = $details['card1']['bg'] ?? "linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%)";

$card2_badge = $details['card2']['badge'] ?? "ADVANCED";
$card2_title = $details['card2']['title'] ?? "AI Benchmarking";
$card2_sub = $details['card2']['sub'] ?? "Concept-wise Heatmaps";
$card2_bg = $details['card2']['bg'] ?? "linear-gradient(135deg, #ff8f00 0%, #e65100 100%)";

$note_title = $details['note']['title'] ?? "Precision Analytics Note";
$note_desc = $details['note']['desc'] ?? "Every assessment report includes an error-mapping matrix classifying mistakes into conceptual, psychological, or calculation errors.";

$allen_offerings = $details['offerings'] ?? [];
$allen_about = $details['about_cards'] ?? [];

$show_reward_banner = (bool)($active_test['show_reward_banner'] ?? false);
$show_stars_banner = (bool)($active_test['show_stars_banner'] ?? false);
$reward_title = $active_test['reward_title'] ?? "";
$reward_desc = $active_test['reward_desc'] ?? "";

$reward_bg = $details['reward_bg'] ?? 'linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%)';
$reward_icon = $details['reward_icon'] ?? 'fas fa-coins';

$show_allen_layout = $is_detail_view;
?>

<?php if ($is_detail_view): ?>
<!-- Premium Green Grid Header (Detail View) -->
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
<?php else: ?>
<!-- Standard Institutional Header (List View) -->
<section class="page-header" style="background: url('assets/images/TopFront & side .png') center/cover no-repeat; padding: clamp(40px, 8vh, 100px) 0 !important; padding-left: 5px !important;">
    <div class="container text-center text-white">
        <h6 class="text-primary fw-black tracking-widest mb-2 text-uppercase">Academic Year 2026-27</h6>
        <h1 class="fw-black mb-0" style="font-size: clamp(2.2rem, 10vw, 4.5rem); line-height: 1.1;">
            ALL INDIA <span class="text-primary">TEST SERIES (AITS)</span>
        </h1>
    </div>
</section>
<?php endif; ?>

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

<?php if ($is_detail_view): ?>
<!-- Testing Ecosystem (Detail View Only) -->
<main class="testing-portal bg-white py-6">
    <div class="container container-1440">
        
        <!-- Section 1: Top Engagement Split (Core Testing vs Enrollment) -->
        <div class="row g-5 mb-6">
            <!-- Left Side: Assessment Roadmap -->
            <div class="col-lg-8">
                <div class="pe-lg-5">
                    <?php if (isset($show_allen_layout) && $show_allen_layout): ?>
                        <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3 fw-black text-uppercase shadow-sm" style="font-size: 0.7rem; letter-spacing: 0.5px;"><?php echo $badge_label; ?></div>
                        <h2 class="fw-black mb-1 h1" style="font-size: clamp(1.1rem, 6.2vw, 2.8rem); letter-spacing: -0.8px;"><?php echo $lifecycle_title; ?></h2>
                        <p class="text-muted fw-bold mb-5"><?php echo $class_label; ?> <span class="mx-2 opacity-50">•</span> <?php echo $duration_label; ?></p>
                    <?php else: ?>
                        <h2 class="fw-black mb-4 h1" style="font-size: clamp(1.1rem, 6.2vw, 2.8rem); white-space: nowrap; letter-spacing: -0.8px;"><?php echo $lifecycle_title; ?></h2>
                        <p class="text-muted lead mb-5"><?php echo $lifecycle_desc; ?></p>
                    <?php endif; ?>

                    <?php if (isset($show_allen_layout) && $show_allen_layout): ?>
                        <!-- Allen Inspired Extended Layout -->
                        <div class="allen-extended-content mb-5">
                            <div class="subjects-box p-4 rounded-4 bg-light d-flex align-items-center gap-3 mb-5 border border-primary border-opacity-10 shadow-sm">
                                <div class="bg-white p-3 rounded-3 shadow-sm text-primary">
                                    <i class="fas fa-microscope fs-4"></i>
                                </div>
                                <div>
                                    <div class="small text-muted fw-bold text-uppercase">Subjects</div>
                                    <div class="fw-black text-dark"><?php echo $allen_subjects; ?></div>
                                </div>
                            </div>

                            <div class="course-offerings mb-5">
                                <h4 class="fw-black text-dark mb-4 border-bottom pb-2">Course Offerings</h4>
                                <ul class="list-unstyled vstack gap-3">
                                    <?php foreach($allen_offerings as $offering): ?>
                                    <li class="d-flex align-items-start gap-3">
                                        <i class="fas fa-circle text-primary mt-1" style="font-size: 0.5rem;"></i>
                                        <span class="text-muted fw-semibold"><?php echo $offering; ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="about-course mb-5">
                                <h4 class="fw-black text-dark mb-4 border-bottom pb-2">About the Course</h4>
                                <div class="vstack gap-4">
                                    <?php foreach($allen_about as $about): ?>
                                    <div class="about-card p-4 rounded-5 bg-white border shadow-sm transition-all hover-lift">
                                        <div class="d-flex align-items-start gap-4">
                                            <div class="icon-wrap bg-primary bg-opacity-10 text-primary p-3 rounded-4" style="width: 60px; height: 60px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                                <i class="<?php echo $about['icon']; ?> fs-3"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-black text-dark mb-3"><?php echo $about['title']; ?></h5>
                                                <ul class="list-unstyled vstack gap-2 mb-0">
                                                    <?php foreach($about['points'] as $point): ?>
                                                    <li class="d-flex align-items-start gap-3 small text-muted">
                                                        <i class="fas fa-check text-success mt-1"></i>
                                                        <span><?php echo $point; ?></span>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>



                            <!-- Reward Banner -->
                            <?php if (isset($show_reward_banner) && $show_reward_banner): ?>
                            <div class="reward-banner p-4 p-md-5 rounded-5 shadow-lg position-relative overflow-hidden text-white mb-5 text-start" style="background: <?php echo $reward_bg; ?>;">
                                <div class="position-relative z-index-10 text-start">
                                    <h3 class="fw-black mb-2 text-start"><?php echo $reward_title; ?></h3>
                                    <div class="mb-4 fw-bold text-start opacity-90"><?php echo $reward_desc; ?></div>
                                    <div class="text-start">
                                        <a href="#" class="text-white text-decoration-none fw-black text-uppercase small d-inline-flex align-items-center transition-all hover-translate-x" style="letter-spacing: 1px;">
                                            Learn More <i class="fas fa-arrow-right ms-3 bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.7rem;"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="decor position-absolute opacity-25" style="bottom: -20px; right: -20px;">
                                    <i class="<?php echo $reward_icon; ?>" style="font-size: 8rem; transform: rotate(-15deg);"></i>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Stars Banner (Dropper Special) -->
                            <?php if (isset($show_stars_banner) && $show_stars_banner): ?>
                            <div class="stars-banner p-4 p-md-5 rounded-5 shadow-lg position-relative overflow-hidden text-white" style="background: #004aad;">
                                <div class="position-relative z-index-10 text-center">
                                    <h2 class="fw-black mb-1 h1">Meet the stars</h2>
                                    <p class="small fw-bold opacity-75 mb-4 text-uppercase tracking-widest">NEET-UG '25 | Online Test Series</p>
                                    
                                    <div class="row g-3 justify-content-center">
                                        <!-- Topper 1 -->
                                        <div class="col-6 col-md-3">
                                            <div class="topper-card bg-white rounded-4 p-3 text-dark shadow-sm">
                                                <div class="badge bg-warning text-dark fw-black mb-2" style="font-size: 0.65rem;">AIR 16</div>
                                                <div class="small fw-black">Rachit Sinha</div>
                                            </div>
                                        </div>
                                        <!-- Topper 2 -->
                                        <div class="col-6 col-md-3">
                                            <div class="topper-card bg-white rounded-4 p-3 text-dark shadow-sm">
                                                <div class="badge bg-warning text-dark fw-black mb-2" style="font-size: 0.65rem;">AIR 36</div>
                                                <div class="small fw-black">Muktesh T.</div>
                                            </div>
                                        </div>
                                        <!-- Topper 3 -->
                                        <div class="col-6 col-md-3">
                                            <div class="topper-card bg-white rounded-4 p-3 text-dark shadow-sm">
                                                <div class="badge bg-warning text-dark fw-black mb-2" style="font-size: 0.65rem;">AIR 40</div>
                                                <div class="small fw-black">Tanishq R.</div>
                                            </div>
                                        </div>
                                        <!-- Topper 4 -->
                                        <div class="col-6 col-md-3">
                                            <div class="topper-card bg-white rounded-4 p-3 text-dark shadow-sm">
                                                <div class="badge bg-warning text-dark fw-black mb-2" style="font-size: 0.65rem;">AIR 111</div>
                                                <div class="small fw-black">Suhani Mittal</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 small opacity-50 fw-bold">And Many More...</div>
                                </div>
                                <div class="decor position-absolute opacity-10" style="top: -20px; right: -20px;">
                                    <i class="fas fa-star" style="font-size: 10rem;"></i>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
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
                    <div class="enroll-card compact-form-container shadow-2xl bg-white border border-light p-4 rounded-5 mx-auto ms-lg-auto" style="max-width: 360px;">
                        <div class="mb-4">
                            <h4 class="fw-black text-dark mb-1" style="font-size: 1.2rem; line-height: 1.2;"><?php echo htmlspecialchars($active_test['title'] ?? 'Test Series'); ?></h4>
                            <p class="very-small text-muted text-uppercase fw-bold tracking-widest mb-3"><?php echo htmlspecialchars($badge_label); ?></p>
                            <hr class="opacity-10 my-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-muted fw-bold">Course Price:</span>
                                <span class="text-orange fw-black h5 mb-0">₹<?php echo $active_test['price'] ?? '4,999'; ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="small text-muted fw-bold">Category:</span>
                                <span class="text-dark fw-black small"><?php echo htmlspecialchars($active_test['category'] ?? 'NEET'); ?></span>
                            </div>
                        </div>

                        <div class="vstack gap-2">
                            <button type="button" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg d-flex align-items-center justify-content-center gap-2 transition-all" 
                                    style="background: linear-gradient(135deg, #ff8f00 0%, #ff6f00 100%); border: none;"
                                    data-bs-toggle="modal" data-bs-target="#enquiryModal" 
                                    data-course="<?php echo htmlspecialchars($active_test['title'] ?? ''); ?>">
                                ENROLL NOW <i class="fas fa-paper-plane ms-1"></i>
                            </button>
                            
                            <a href="<?php echo BASE_URL; ?>student-login.php" class="btn btn-warning w-100 py-3 rounded-pill fw-black shadow-lg text-white" 
                               style="background: #ffa726; border: none; opacity: 0.9;">
                                PORTAL ACCESS
                            </a>

                            <a href="https://wa.me/919934244522" class="btn btn-outline-success w-100 py-3 rounded-pill fw-black d-flex align-items-center justify-content-center gap-2" 
                               style="border-width: 2px;">
                                <i class="fab fa-whatsapp fs-5"></i> WHATSAPP
                            </a>
                        </div>

                        <p class="text-center very-small text-muted mt-4 mb-0 fw-bold opacity-50 uppercase tracking-widest">Session 2026-27 Enrollment</p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-6 opacity-10">
<?php else: ?>
<!-- Testing Ecosystem (List View) -->
<main class="testing-portal bg-white py-6">
    <div class="container container-1440">
<?php endif; ?>

        <!-- Section 2: Active Test Catalog -->
        <div class="testing-catalog">
             <div class="section-title mb-5">
                <h2 class="fw-black h1">ACTIVE <span class="text-primary">ASSESSMENTS</span></h2>
                <p class="text-muted">Targeted benchmarking series mapped to the latest competitive examination patterns.</p>
            </div>

            <div class="row g-4">
                <?php 
                // Dynamically build the display tests from DB
                $display_tests = [];
                if (!empty($db_tests)) {
                    foreach ($db_tests as $t) {
                        // If no filter, show all. If category filter, match category.
                        if (empty($category) || $t['category'] == $category) {
                            // If type filter, match type
                            if (empty($type) || $t['type'] == $type) {
                                $display_tests[] = [
                                    'id' => $t['type'], // use type as ID for filtering
                                    'category' => $t['category'],
                                    'price' => $t['price'],
                                    'title' => $t['title'],
                                    'slug' => $t['slug']
                                ];
                            }
                        }
                    }
                }
                ?>
                <?php if (count($display_tests) > 0): ?>
                    <?php foreach($display_tests as $item): ?>
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
                                <a href="<?php echo BASE_URL; ?>test-series.php?category=<?php echo urlencode($item['category']); ?>&type=<?php echo isset($item['id']) ? urlencode($item['id']) : ''; ?>" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg d-flex align-items-center justify-content-center gap-2 transition-all" style="background: linear-gradient(135deg, #ff8f00 0%, #ff6f00 100%); border: none;">
                                    ENROLL SERIES <i class="fas fa-chevron-right small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php if ($category == 'NEET' || empty($category)): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="prism-test-card p-4 p-md-5 rounded-5 border bg-white shadow-sm h-100 transition-all hover-lift position-relative overflow-hidden">
                            <!-- Geometric Background Decor -->
                            <div class="prism-decor position-absolute" style="top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255, 143, 0, 0.05); border-radius: 40px; transform: rotate(15deg);"></div>
                            
                            <div class="d-flex justify-content-between align-items-start mb-4 position-relative">
                                <div class="prism-badge px-3 py-1 rounded-pill bg-light text-primary very-small fw-black border border-primary border-opacity-10">
                                    NEET
                                </div>
                                <div class="prism-price text-dark fw-black h4 mb-0">
                                    <span class="small opacity-50 fw-normal">₹</span>4,999
                                </div>
                            </div>
                            
                            <h4 class="fw-black text-dark mb-4" style="line-height: 1.3; font-size: 1.25rem;">
                                <?php echo ($type == 'Class12') ? 'Class-12th' : 'Class-11th'; ?>
                            </h4>
                            
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
                                <a href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=<?php echo ($type == 'Class12') ? 'Class12' : 'Class11'; ?>" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg d-flex align-items-center justify-content-center gap-2 transition-all" style="background: linear-gradient(135deg, #ff8f00 0%, #ff6f00 100%); border: none;">
                                    ENROLL SERIES <i class="fas fa-chevron-right small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($category == 'IIT-JEE' || empty($category)): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="prism-test-card p-4 p-md-5 rounded-5 border bg-white shadow-sm h-100 transition-all hover-lift position-relative overflow-hidden">
                            <!-- Geometric Background Decor -->
                            <div class="prism-decor position-absolute" style="top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255, 143, 0, 0.05); border-radius: 40px; transform: rotate(15deg);"></div>
                            
                            <div class="d-flex justify-content-between align-items-start mb-4 position-relative">
                                <div class="prism-badge px-3 py-1 rounded-pill bg-light text-primary very-small fw-black border border-primary border-opacity-10">
                                    IIT-JEE
                                </div>
                                <div class="prism-price text-dark fw-black h4 mb-0">
                                    <span class="small opacity-50 fw-normal">₹</span>5,999
                                </div>
                            </div>
                            
                            <h4 class="fw-black text-dark mb-4" style="line-height: 1.3; font-size: 1.25rem;">
                                <?php echo ($type == 'Class12') ? 'Class-12th' : 'Class-11th'; ?>
                            </h4>
                            
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
                                <a href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=<?php echo ($type == 'Class12') ? 'Class12' : 'Class11'; ?>" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg d-flex align-items-center justify-content-center gap-2 transition-all" style="background: linear-gradient(135deg, #ff8f00 0%, #ff6f00 100%); border: none;">
                                    ENROLL SERIES <i class="fas fa-chevron-right small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($category) && $category != 'NEET' && $category != 'IIT-JEE'): ?>
                        <div class="col-12"><div class="p-5 bg-light rounded-4 text-center"><p class="text-muted mb-0">Testing calendar is being updated by the examination cell.</p></div></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const enrollForm = document.getElementById('enrollSeriesForm');
    if(enrollForm) {
        enrollForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> ENROLLING...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    const cardContainer = this.closest('.enroll-card');
                    cardContainer.innerHTML = `
                        <div class="text-center p-4 animate__animated animate__zoomIn">
                            <div class="success-pulse mb-4">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg" style="width: 70px; height: 70px;">
                                    <i class="fas fa-check-double fs-2"></i>
                                </div>
                            </div>
                            <h4 class="fw-black text-dark mb-2 text-uppercase">Enrollment <span class="text-success">Successful</span></h4>
                            <p class="text-muted small mb-4">${data.message}</p>
                            <div class="divider mb-4" style="height: 1px; background: #eee;"></div>
                            <a href="student-login.php" class="btn btn-dark w-100 py-2 rounded-pill fw-bold small">Go to Portal</a>
                        </div>
                    `;
                } else {
                    alert(data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnContent;
            });
        });
    }
});
</script>
