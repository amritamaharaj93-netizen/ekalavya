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
$note_desc = "Every assessment report includes an error-mapping matrix classifying mistakes into conceptual, psychological, or calculation errors.";if (($category == 'NEET' || $category == 'IIT-JEE') && ($type == 'Class11' || $type == 'Class12' || $type == 'Dropper')) {
    $show_allen_layout = true;
    $show_stars_banner = ($type == 'Dropper' && $category == 'NEET');
    $show_reward_banner = !$show_stars_banner;
    $duration_label = "1 Year";
    $badge_label = "TEST SERIES PROGRAM";
    $reward_title = "NEET 2027 just got more rewarding.";
    $reward_desc = "Achieve an <span class='text-dark bg-white px-2 rounded'>AIR under 5,000</span> and claim up to <span class='fw-black text-primary'>100% refund</span> on your course fees.";
    
    if ($category == 'IIT-JEE' && $type == 'Class11') {
        $header_title = "JEE Main – Nurture Computer-Based Test Series: Target 2028";
        $header_subtitle = "NURTURE BATCH STARTS 20 MAY ✨";
        $lifecycle_title = "JEE Main – Nurture Computer-Based Test Series: Target 2028";
        $class_label = "Class 11";
        $duration_label = "2 Years";
        $badge_label = "CBT PACKAGE PROGRAM";
        $allen_subjects = "Chemistry, Maths, Physics";
        $allen_offerings = [
            "15+ computer-based tests as per the latest syllabus.",
            "100+ mock tests for additional practice.",
            "Attempt any missed test on Ekalavya App in online mode.",
            "Improvement Book, Flashcards, and more via our App."
        ];
    } elseif ($category == 'IIT-JEE' && $type == 'Class12') {
        $header_title = "JEE Main – Enthusiast Computer-Based Test Series: Target 2027";
        $header_subtitle = "ENTHUSIAST BATCH STARTS 10 MAY ✨";
        $lifecycle_title = "JEE Main – Enthusiast Computer-Based Test Series: Target 2027";
        $class_label = "Class 12";
        $badge_label = "CBT PACKAGE PROGRAM";
        $allen_subjects = "Chemistry, Maths, Physics";
        $allen_offerings = [
            "9 computer-based tests as per the latest syllabus.",
            "CBT available at designated centers in 250+ cities.",
            "100+ mock tests for additional practice.",
            "Attempt any missed test on Ekalavya App in online mode.",
            "Improvement Book, Flashcards, and more via our App."
        ];
        $reward_title = "100% Cashback Promise!";
        $reward_desc = "Score <span class='text-dark bg-white px-2 rounded'>99%ile+</span> in JEE Main 2027 and get <span class='fw-black text-primary'>100% of your course fee back.</span>";
    } elseif ($type == 'Dropper') {
        $allen_subjects = ($category == 'IIT-JEE') ? "Chemistry, Maths, Physics" : "Botany, Chemistry, Physics, Zoology";
        $header_title = ($category == 'IIT-JEE' ? "JEE Main Leader" : "NEET Leader") . " Pen & Paper Test Series: Target 2027";
        $header_subtitle = "LEADER BATCH STARTS 15 MAY ✨";
        $lifecycle_title = ($category == 'IIT-JEE' ? "JEE Main Leader" : "NEET Leader") . " Pen & Paper Test Series: Target 2027";
        $class_label = "Class 12 Plus";
        $allen_offerings = [
            "25+ Pen & Paper tests at designated centers in 250+ cities.",
            "Attempt any missed test on Ekalavya App in online mode.",
            "40 mock tests for additional practice.",
            "Improvement Book, Flashcards, and more via our App."
        ];
    } else {
        $allen_subjects = ($category == 'IIT-JEE') ? "Chemistry, Maths, Physics" : "Botany, Chemistry, Physics, Zoology";
        $target_year = ($type == 'Class11') ? "2027" : "2026";
        $class_label = ($type == 'Class11') ? "Class 11" : "Class 12";
        $header_title = ($category == 'IIT-JEE' ? "JEE Main" : "NEET Enthusiast") . " Combo Test Series: Target $target_year";
        $header_subtitle = "TEST SERIES KICKS OFF 10 MAY ✨";
        $lifecycle_title = ($category == 'IIT-JEE' ? "JEE Main" : "NEET Enthusiast") . " Combo Test Series: Target $target_year";
        $allen_offerings = [
            "51 tests (25 online and 26 pen & paper) as per the latest syllabus.",
            "Pen & Paper tests are available at centers in 250+ cities.",
            "Attempt any missed test on Ekalavya App in online mode.",
            "40 mock tests for additional practice.",
            "Improvement Book, Flashcards, and more via our App."
        ];
    }
    
    $lifecycle_desc = "";
    
    $card1_badge = "OFFERING";
    $card1_title = "Real Exam Style";
    if ($category == 'IIT-JEE' && $type == 'Class11') {
        $card1_sub = "15+ Computer-Based Tests";
    } elseif ($category == 'IIT-JEE' && $type == 'Class12') {
        $card1_sub = "9 Computer-Based Tests";
    } elseif ($type == 'Dropper') {
        $card1_sub = "25+ Pen & Paper Tests";
    } else {
        $card1_sub = "26 Pen & Paper + 25 Online Tests";
    }
    
    $card2_badge = "PRACTICE";
    if ($category == 'IIT-JEE' && $type == 'Class11') {
        $card2_title = "85,000+ Questions";
    } elseif ($category == 'IIT-JEE' && $type == 'Class12') {
        $card2_title = "51,000+ Questions";
    } else {
        $card2_title = "1 Lakh+ Questions";
    }
    $card2_sub = "Teacher-recommended question bank";
    
    $note_title = "SMART REVISION TOOLS";
    $note_desc = "Revise with 24/7 AI-powered doubt support, Flashcards, Improvement Book & more to boost memory retention.";
    
    $allen_about = [
        [
            "title" => "Real exam-style practice tests",
            "icon" => "fas fa-file-invoice",
            "points" => [
                (($category == 'IIT-JEE' && $type == 'Class11') ? "15+ Computer-Based" : (($category == 'IIT-JEE' && $type == 'Class12') ? "9 Computer-Based" : ($type == 'Dropper' ? "25+" : "26") . " Pen & Paper")) . " tests by top faculty",
                "Keep your preparation progress on track",
                "Missed tests available for re-attempt in online mode"
            ]
        ],
        [
            "title" => "Access Question Bank",
            "icon" => "fas fa-book-reader",
            "points" => [
                "Practice with " . (($category == 'IIT-JEE' && $type == 'Class11') ? "85,000+" : (($category == 'IIT-JEE' && $type == 'Class12') ? "51,000+" : "1 lakh+")) . " teacher-recommended questions",
                "Create personalized quizzes with Custom Practice tool"
            ]
        ],
        [
            "title" => "Smart Revision Tools",
            "icon" => "fas fa-robot",
            "points" => [
                "24/7 AI-powered doubt support",
                "Revision notes to boost your memory retention",
                "Revise with Flashcards, Improvement Book & more"
            ]
        ],
        [
            "title" => "All India Ranks",
            "icon" => "fas fa-medal",
            "points" => [
                "Get national level ranking among students across India",
                "Know where you stand among peers"
            ]
        ]
    ];
} elseif ($type == 'FullLength') {
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
                            <div class="reward-banner p-4 p-md-5 rounded-5 shadow-lg position-relative overflow-hidden text-white mb-5" style="background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%);">
                                <div class="position-relative z-index-10">
                                    <h3 class="fw-black mb-3"><?php echo $reward_title; ?></h3>
                                    <p class="mb-4 fw-bold"><?php echo $reward_desc; ?></p>
                                    <a href="#" class="btn btn-white rounded-pill px-4 fw-black text-uppercase small">Learn More</a>
                                </div>
                                <div class="decor position-absolute opacity-25" style="bottom: -20px; right: -20px;">
                                    <i class="fas fa-coins" style="font-size: 8rem; transform: rotate(-15deg);"></i>
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
                    <div class="enroll-card compact-form-container shadow-2xl bg-white border border-light p-4 rounded-5" style="max-width: 340px; margin-left: auto;">
                        <div class="text-center mb-5">
                            <h3 class="fw-black mb-1 text-uppercase">Enroll <span class="text-orange">Series</span></h3>
                            <p class="very-small text-muted uppercase fw-bold">Testing Portal <?php echo date('Y'); ?>-<?php echo date('y') + 1; ?></p>
                        </div>
                        <form id="enrollSeriesForm" action="<?php echo BASE_URL; ?>process-enquiry.php" method="POST" class="vstack gap-3">
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
                                            <option value="IIT-JEE">IIT-JEE</option>
                                            <option value="NEET">NEET</option>
                                            <option value="School-Prep-7">School Prep (Class 7th)</option>
                                            <option value="School-Prep-8">School Prep (Class 8th)</option>
                                            <option value="School-Prep-9">School Prep (Class 9th)</option>
                                            <option value="School-Prep-10">School Prep (Class 10th)</option>
                                            <option value="School-Prep-11">School Prep (Class 11th)</option>
                                            <option value="School-Prep-12">School Prep (Class 12th)</option>
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
                <?php 
                $display_tests = $db_tests;
                if (empty($category) && empty($type)) {
                    $display_tests = [
                        ['id' => 'Class11', 'category' => 'NEET', 'price' => '4,999', 'title' => 'NEET Class 11th (Enthusiast DLP)', 'slug' => 'neet-class-11'],
                        ['id' => 'Class12', 'category' => 'NEET', 'price' => '4,999', 'title' => 'NEET Class 12th (Enthusiast DLP)', 'slug' => 'neet-class-12'],
                        ['id' => 'Dropper', 'category' => 'NEET', 'price' => '4,999', 'title' => 'NEET 12th Pass / Dropper (Leader DLP)', 'slug' => 'neet-dropper'],
                        ['id' => 'Class11', 'category' => 'IIT-JEE', 'price' => '5,999', 'title' => 'JEE Class 11th (Nurture DLP)', 'slug' => 'jee-class-11'],
                        ['id' => 'Class12', 'category' => 'IIT-JEE', 'price' => '5,999', 'title' => 'JEE Class 12th (Enthusiast DLP)', 'slug' => 'jee-class-12']
                    ];
                } elseif ($category == 'NEET') {
                    $all_neet = [
                        ['id' => 'Class11', 'category' => 'NEET', 'price' => '4,999', 'title' => 'NEET Class 11th (Enthusiast DLP)', 'slug' => 'neet-class-11'],
                        ['id' => 'Class12', 'category' => 'NEET', 'price' => '4,999', 'title' => 'NEET Class 12th (Enthusiast DLP)', 'slug' => 'neet-class-12'],
                        ['id' => 'Dropper', 'category' => 'NEET', 'price' => '4,999', 'title' => 'NEET 12th Pass / Dropper (Leader DLP)', 'slug' => 'neet-dropper']
                    ];
                    $display_tests = array_filter($all_neet, function($t) use ($type) {
                        return empty($type) || $t['id'] == $type;
                    });
                } elseif ($category == 'IIT-JEE') {
                    $all_jee = [
                        ['id' => 'Class11', 'category' => 'IIT-JEE', 'price' => '5,999', 'title' => 'JEE Class 11th (Nurture DLP)', 'slug' => 'jee-class-11'],
                        ['id' => 'Class12', 'category' => 'IIT-JEE', 'price' => '5,999', 'title' => 'JEE Class 12th (Enthusiast DLP)', 'slug' => 'jee-class-12']
                    ];
                    $display_tests = array_filter($all_jee, function($t) use ($type) {
                        return empty($type) || $t['id'] == $type;
                    });
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
                    <div class="col-12"><div class="p-5 bg-light rounded-4 text-center"><p class="text-muted mb-0">Testing calendar is being updated by the examination cell.</p></div></div>
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
