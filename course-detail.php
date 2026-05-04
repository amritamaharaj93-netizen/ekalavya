<?php 
include_once 'config/database.php'; 

// Fetch course details
$course = null;
if (isset($_GET['slug'])) {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE slug = :slug");
    $stmt->execute(['slug' => $_GET['slug']]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['id']]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$course) {
    header("Location: " . BASE_URL . "courses.php");
    exit();
}

// Determine dynamic study material text based on course title
$study_material_text = "Class-12th study material"; // Default
if ($course) {
    $title_upper = strtoupper($course['title']);
    $scholarship_text = $course['scholarship_note'] ?: "Up to 100%"; 
    
    // Legacy hardcoded overrides (keep as fallbacks for now, but prioritize DB fees if they are set)
    if (empty($course['fees'])) {
        if (strpos($title_upper, 'EMERGE') !== false || strpos($title_upper, 'XII') !== false) {
            $study_material_text = "Class-12th study material";
            $course['fees'] = 54000;
        } elseif (strpos($title_upper, 'NURTURE') !== false || strpos($title_upper, 'XI') !== false || strpos($title_upper, '11TH') !== false) {
            $study_material_text = "Class-11th study material";
            $course['fees'] = 82000;
        } elseif (strpos($title_upper, 'IMPULSE') !== false || strpos($title_upper, 'DROPPER') !== false) {
            $study_material_text = "Dropper study material";
            $course['fees'] = 54000;
            $scholarship_text = "50% SCHOLARSHIP";
        } elseif (strpos($title_upper, 'SEED') !== false || (strpos($title_upper, 'IX') !== false && strpos($title_upper, 'XI') === false)) {
            $study_material_text = "Class-9 study material";
            $course['fees'] = 42000;
        }
    } else {
        // If fees are set in DB, use them but still try to guess study material text
        if (strpos($title_upper, 'EMERGE') !== false || strpos($title_upper, 'XII') !== false || strpos($title_upper, '12TH') !== false) $study_material_text = "Class-12th study material";
        elseif (strpos($title_upper, 'NURTURE') !== false || strpos($title_upper, 'XI') !== false || strpos($title_upper, '11TH') !== false) $study_material_text = "Class-11th study material";
        elseif (strpos($title_upper, '7TH') !== false) $study_material_text = "Class-7th study material";
        elseif (strpos($title_upper, '8TH') !== false) $study_material_text = "Class-8th study material";
        elseif (strpos($title_upper, '10TH') !== false) $study_material_text = "Class-10th study material";
        elseif (strpos($title_upper, 'IMPULSE') !== false || strpos($title_upper, 'DROPPER') !== false) $study_material_text = "Dropper study material";
        elseif (strpos($title_upper, 'SEED') !== false || strpos($title_upper, 'IX') !== false || strpos($title_upper, '9TH') !== false) $study_material_text = "Class-9th study material";
    }

    // Parse JSON fields
    $experience = json_decode($course['experience_json'] ?? '', true);
    if (empty($experience)) {
        $experience = [
            ['icon' => 'fas fa-chalkboard-teacher', 'title' => 'Concept Learning', 'desc' => '<b>Expert Faculty Guidance:</b> Classes conducted by experienced and dedicated teachers with a strong focus on concept clarity and exam-oriented preparation.<br><b>Advanced Classroom Environment:</b> Well-equipped, comfortable classrooms designed to create a focused and effective learning atmosphere.'],
            ['icon' => 'fas fa-copy', 'title' => 'Well-Designed Study Material', 'desc' => '<b>Concept Practice Sheets:</b> Specially designed worksheets to strengthen concepts and improve problem-solving speed and accuracy.<br><b>Topic-Based Modules:</b> Structured study modules containing Level wise exercises, Important questions, and previous year questions for deeper understanding.<br><b>Revision Practice Material:</b> Revision Practice sheets post-course completion.'],
            ['icon' => 'fas fa-chart-line', 'title' => 'Systematic Test', 'desc' => '<b>Regular Tests:</b> Regular Test based on recently completed chapters to monitor progress. Full-length tests designed to strengthen preparation and build confidence for competitive exams.<br><b>Performance Analysis:</b> Detailed feedback and analysis to help students identify strengths and improve weak areas.'],
            ['icon' => 'fas fa-user-graduate', 'title' => 'Additional Academic Support', 'desc' => '<b>Doubt-Solving Sessions:</b> Special sessions to clarify concepts and ensure complete understanding.<br><b>Personalized Mentorship:</b> Regular guidance from mentors to support academic growth and keep students motivated.'],
            ['icon' => 'fas fa-comments', 'title' => 'Student & Parent Interaction', 'desc' => '<b>Career Guidance Programs:</b> Expert sessions providing information about competitive exams, career options, and future opportunities.<br><b>Regular PTM:</b> Frequent interaction between parents and teachers keeps one informed about the child\'s academic progress and ensures academic success.']
        ];
    }

    $roadmap = json_decode($course['roadmap_json'] ?? '[]', true) ?: [
        ['title' => 'Concept Building', 'desc' => 'Initiating with basic fundamentals to bridge any academic gaps.'],
        ['title' => 'Exhaustive Module Coverage', 'desc' => 'Deep dive into physics, chemistry, and biology/maths modules.'],
        ['title' => 'Periodic Benchmarking', 'desc' => 'Bi-weekly tests and monthly rank-analysis exams.'],
        ['title' => 'Doubt & Revision Sprints', 'desc' => 'Intensive doubt-clearing sessions and formula-recall workshops.'],
        ['title' => 'All India Mock Tests', 'desc' => 'Final touch-ups with national-level benchmarking and predicted AIR analysis.']
    ];

    $curriculum = json_decode($course['curriculum_json'] ?? '[]', true) ?: [
        ['title' => 'Phase 1: Comprehensive Fundamentals', 'badge' => 'FOUNDATION', 'desc' => 'Initiation into core concepts with focus on higher-level problem solving.', 'topics' => 'Unit & Dimensions, Atomic Structure, Maths for Science', 'outcome_icon' => 'fas fa-bullseye', 'outcome_text' => 'Concept Clarity'],
        ['title' => 'Phase 2: Intermediate Application', 'badge' => 'PRACTICE', 'desc' => 'Applying fundamental concepts to Level 1 and Level 2 problems.', 'topics' => 'Kinematics, Thermodynamics, Periodic Table', 'outcome_icon' => 'fas fa-bolt', 'outcome_text' => 'Problem Solving'],
        ['title' => 'Phase 3: Rank Booster Mastery', 'badge' => 'RANKING', 'desc' => 'Mastering previous year questions and Level 3 problems.', 'topics' => 'Organic Chemistry, Calculus, Optics', 'outcome_icon' => 'fas fa-trophy', 'outcome_text' => 'Exam Readiness']
    ];
    // Parse scholarship percentage and calculate discounted fee
    preg_match('/(\d+)%/', $scholarship_text, $matches);
    $scholarship_pct = isset($matches[1]) ? intval($matches[1]) : 0;
    $discounted_fee = $course['fees'] * (1 - ($scholarship_pct / 100));
    // Parse scholarship percentage and calculate discounted fee
    preg_match('/(\d+)%/', $scholarship_text, $matches);
    $scholarship_pct = isset($matches[1]) ? intval($matches[1]) : 0;
    $discounted_fee = $course['fees'] * (1 - ($scholarship_pct / 100));
}

include 'includes/header.php'; 
?>

<!-- Allen-Inspired Hero Section -->
<section class="course-hero-v2 py-6 bg-white position-relative overflow-hidden border-bottom">
    <div class="container container-1400">
        <!-- Premium ESAT Scholarship Banner (Dynamic Content) -->
        <!-- Scholarship Banner Image (Full Size) -->
        <div class="scholarship-dynamic-banner rounded-5 mb-5 position-relative overflow-hidden shadow-heavy border">
            <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $course['hero_banner'] ?: 'scholar image.png'; ?>" class="img-fluid w-100" alt="Scholarship Program">
        </div>

        <div class="row align-items-start g-5">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-5">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>" class="text-secondary text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>courses" class="text-secondary text-decoration-none">Classroom Courses</a></li>
                        <li class="breadcrumb-item active fw-bold text-dark" aria-current="page"><?php echo htmlspecialchars($course['title']); ?></li>
                    </ol>
                </nav>

                <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                    <span class="badge bg-dark px-3 py-2 rounded-1 fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Regular Course</span>
                    <span class="badge bg-primary px-3 py-2 rounded-1 fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Classroom Program</span>
                </div>

                <h1 class="display-4 fw-black mb-4 text-dark" style="letter-spacing: -1.5px;">
                    <?php echo htmlspecialchars($course['title']); ?> 
                    <span class="text-primary d-block mt-1">BATCH <?php echo $course['target_year'] ?: '2026'; ?></span>
                </h1>
                
                <p class="lead text-muted mb-5 pe-lg-5" style="line-height: 1.6;"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
                
                <?php if ($course['admission_eligibility']): ?>
                <div class="modern-hub-header mb-5">
                    <div class="eligibility-ribbon d-inline-flex align-items-center gap-3 p-2 pe-4 rounded-pill bg-white shadow-sm border border-primary border-opacity-25 mb-4">
                        <div class="pulse-icon bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-check text-white small"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-black d-block" style="font-size: 0.6rem; letter-spacing: 1px;">Admission Status</small>
                            <span class="fw-black text-dark" style="font-size: 0.9rem;"><?php echo htmlspecialchars($course['admission_eligibility']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="course-info-hub p-4 p-md-5 rounded-5 border border-white mb-5 position-relative overflow-hidden shadow-2xl" style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px);">
                    <div class="row g-5 align-items-center">
                        <div class="col-md-4">
                            <div class="hub-item d-flex align-items-center gap-4">
                                <div class="hub-orb" style="background: linear-gradient(45deg, #1a73e8, #64b5f6); box-shadow: 0 10px 20px rgba(26, 115, 232, 0.3);">
                                    <i class="fas fa-clock text-white fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-uppercase fw-black text-muted d-block mb-1" style="font-size: 0.65rem; letter-spacing: 1.5px;">Duration</small>
                                    <h5 class="fw-black text-dark mb-0"><?php echo htmlspecialchars($course['duration']); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="hub-item d-flex align-items-center gap-4 border-start border-light ps-md-4">
                                <div class="hub-orb" style="background: linear-gradient(45deg, #34a853, #81c784); box-shadow: 0 10px 20px rgba(52, 168, 83, 0.3);">
                                    <i class="fas fa-graduation-cap text-white fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-uppercase fw-black text-muted d-block mb-1" style="font-size: 0.65rem; letter-spacing: 1.5px;">Stream</small>
                                    <h5 class="fw-black text-dark mb-0"><?php echo htmlspecialchars($course['category']); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="hub-item d-flex align-items-center gap-4 border-start border-light ps-md-4">
                                <div class="hub-orb" style="background: linear-gradient(45deg, #fbbc04, #ffd54f); box-shadow: 0 10px 20px rgba(251, 188, 4, 0.3);">
                                    <i class="fas fa-globe text-white fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-uppercase fw-black text-muted d-block mb-1" style="font-size: 0.65rem; letter-spacing: 1.5px;">Medium</small>
                                    <h5 class="fw-black text-dark mb-0"><?php echo htmlspecialchars($course['medium'] ?: 'English / Hindi'); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Background Orbs -->
                    <div class="position-absolute bg-primary bg-opacity-5 rounded-circle" style="width: 200px; height: 200px; top: -100px; right: -50px; filter: blur(50px);"></div>
                </div>
            </div>
            
            <!-- Side Sticky Card (Floating Position) - Thinner Profile -->
            <div class="col-lg-4">
                 <div class="enrollment-preferences-box compact-form-container sticky-top shadow-2xl bg-white border border-light p-4 px-xl-4 py-xl-5" style="top: 140px; z-index: 20; border-radius: 25px; max-width: 380px; margin-left: auto;">
                    <h4 class="fw-black mb-5 text-dark text-uppercase" style="font-size: 1.3rem; letter-spacing: 0.5px;">Enrollment Details</h4>
                    
                    <div class="mb-5">
                        <label class="form-label very-small fw-black text-muted text-uppercase tracking-wider mb-3">Academic Session</label>
                        <div class="d-flex gap-2">
                             <div class="w-100 p-3 rounded-3 bg-light border text-center fw-bold text-dark"><?php echo htmlspecialchars($course['academic_session'] ?: '2026-2027'); ?></div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label very-small fw-black text-muted text-uppercase tracking-wider mb-3">Select Study Center</label>
                         <select class="form-select border-0 bg-light p-3 rounded-3 fw-bold shadow-none">
                            <option>Patna Head Office (Boring Road)</option>
                            <option>Gaya Campus (Civil Lines)</option>
                            <option>Online Live Platform</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label very-small fw-black text-muted text-uppercase tracking-wider mb-3">Fee Summary</label>
                        <div class="p-4 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-10">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary small">Course Fee</span>
                                <span class="text-muted small">₹<?php echo number_format($course['fees'], 0); ?></span>
                            </div>

                            <div class="fee-includes-list mt-3 mb-3 pt-3 border-top border-primary border-opacity-10">
                                <h6 class="very-small fw-black text-dark text-uppercase mb-2" style="font-size: 0.6rem; letter-spacing: 0.5px;">Things Included in fee</h6>
                                <ul class="list-unstyled mb-0">
                                    <?php 
                                    if (!empty($course['fee_includes'])) {
                                        $items = explode("\n", $course['fee_includes']);
                                        foreach ($items as $item) {
                                            if (trim($item)) {
                                                echo '<li class="very-small text-muted d-flex align-items-start gap-2 mb-1" style="font-size: 0.7rem;">';
                                                echo '<i class="fas fa-check-circle text-primary mt-1" style="font-size: 0.6rem;"></i>';
                                                echo '<span>' . htmlspecialchars(trim($item)) . '</span>';
                                                echo '</li>';
                                            }
                                        }
                                    } else {
                                        // Fallback if empty
                                        ?>
                                        <li class="very-small text-muted d-flex align-items-start gap-2 mb-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-check-circle text-primary mt-1" style="font-size: 0.6rem;"></i> 
                                            <span><?php echo $study_material_text; ?></span>
                                        </li>
                                        <li class="very-small text-muted d-flex align-items-start gap-2 mb-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-check-circle text-primary mt-1" style="font-size: 0.6rem;"></i> 
                                            <span>Uniform for classroom</span>
                                        </li>
                                        <li class="very-small text-muted d-flex align-items-start gap-2 mb-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-check-circle text-primary mt-1" style="font-size: 0.6rem;"></i> 
                                            <span>Necessary Stationary</span>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="fw-bold text-dark small"><i class="fas fa-graduation-cap me-1 text-primary"></i> Avail scholarship <?php echo $scholarship_text; ?></span>
                                <span class="fw-black text-primary fs-3">₹<?php echo number_format($discounted_fee, 0); ?></span>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 py-3 rounded-3 fw-black shadow-lg mb-4" data-bs-toggle="modal" data-bs-target="#enquiryModal" data-course="<?php echo htmlspecialchars($course['title']); ?>" style="font-size: 1.1rem; height: 60px; display: flex; align-items: center; justify-content: center;">ENROLL NOW <i class="fas fa-arrow-right-long ms-2"></i></button>
                    <p class="text-center small text-muted mb-0">Admission via <a href="<?php echo BASE_URL; ?>scholarship" class="text-primary fw-bold text-decoration-none border-bottom border-primary border-2 pb-1">ESAT Scholarship Test</a></p>
                 </div>
            </div>
        </div>
    </div>
</section>

<!-- Features / what you get Section -->
<section class="what-you-get py-6 bg-white">
    <div class="container">
        <div class="section-title text-center mb-5">
             <h2 class="fw-black">The Ekalavya <span class="text-primary">Experience</span></h2>
             <p class="text-muted max-width-700 mx-auto">Our classroom programs are designed to provide a 360-degree learning experience that goes beyond lectures.</p>
        </div>
        
        <div class="experience-stack vstack gap-0">
            <?php foreach($experience as $index => $item): ?>
            <div class="exp-item d-flex align-items-center justify-content-between p-4 p-md-5 rounded-4 border-bottom hover-bg-light transition-all">
                <div class="exp-content pe-lg-5">
                    <h4 class="fw-bold mb-3"><i class="<?php echo $item['icon'] ?: 'fas fa-check'; ?> text-primary me-2 opacity-50"></i> <?php echo htmlspecialchars($item['title']); ?></h4>
                    <div class="text-muted mb-0 experience-points">
                        <?php 
                        $points = explode('<br>', $item['desc']);
                        foreach($points as $point): 
                            if(trim($point)):
                        ?>
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <i class="fas fa-circle text-dark" style="font-size: 8px; margin-top: 8px;"></i>
                                <span class="lh-base"><?php echo $point; ?></span>
                            </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
                <div class="exp-icon bg-<?php echo ($index % 2 == 0) ? 'orange' : 'blue'; ?>-soft p-4 rounded-circle d-none d-md-block">
                    <i class="<?php echo $item['icon'] ?: 'fas fa-star'; ?> fs-1 text-primary"></i>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Academic Journey Section -->
<section class="academic-journey py-6 bg-light">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="sticky-top" style="top: 140px;">
                    <h6 class="text-primary fw-bold tracking-widest uppercase mb-3">Academic Roadmap</h6>
                    <h2 class="fw-black h1 mb-4">How You Will <br>Master Your <span class="text-primary">Goals</span></h2>
                    <p class="text-muted mb-5">At Ekalavya, we follow a scientifically structured student journey that ensures consistent growth from day one to the final examination.</p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-4 bg-white rounded-4 border border-light h-100">
                                <h4 class="fw-black text-primary mb-1">98%</h4>
                                <p class="small text-muted mb-0">Student Satisfaction</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 bg-white rounded-4 border border-light h-100">
                                <h4 class="fw-black text-primary mb-1">150+</h4>
                                <p class="small text-muted mb-0">Tests Yearly</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="journey-timeline">
                    <?php foreach($roadmap as $index => $step): ?>
                    <div class="journey-step <?php echo ($index == count($roadmap) - 1) ? 'mb-0' : ''; ?>">
                        <h4 class="fw-bold text-dark"><?php echo htmlspecialchars($step['title']); ?></h4>
                        <p class="text-muted"><?php echo htmlspecialchars($step['desc']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Curriculum Detail Accordion -->
<section class="curriculum-detail py-6 bg-white">
    <div class="container">
        <div class="section-title text-center mb-6">
            <h2 class="fw-black mb-3" style="font-size: clamp(1.4rem, 5vw, 3rem); letter-spacing: -1px;">Detailed <span class="text-primary">Curriculum</span></h2>
            <p class="text-muted">Explore the modular breakdown of the academic session.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="learning-path-timeline position-relative">
                    <?php 
                    $phase_colors = ['primary', 'success', 'dark', 'info', 'warning'];
                    foreach($curriculum as $index => $module): 
                        $color = $phase_colors[$index % count($phase_colors)];
                    ?>
                    <div class="learning-module-card mb-5 position-relative">
                        <div class="module-number-pill position-absolute d-none d-xl-flex"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></div>
                        <div class="card border-0 shadow-2xl rounded-5 overflow-hidden transition-all hover-lift">
                            <div class="card-header bg-<?php echo $color; ?> p-4 border-0 d-flex justify-content-between align-items-center">
                                <h4 class="text-white fw-black mb-0"><?php echo htmlspecialchars($module['title']); ?></h4>
                                <span class="badge bg-white rounded-pill px-3 py-2 fw-bold text-<?php echo $color; ?>" style="font-size: 0.7rem;"><?php echo htmlspecialchars($module['badge'] ?: 'ACADEMIC'); ?></span>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <p class="lead text-dark fw-bold mb-4"><?php echo htmlspecialchars($module['desc']); ?></p>
                                        <div class="row g-3">
                                            <?php 
                                            $topics = explode(',', $module['topics']);
                                            foreach($topics as $topic): ?>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <div class="dot bg-<?php echo $color; ?>"></div>
                                                    <span class="small fw-bold text-muted"><?php echo trim(htmlspecialchars($topic)); ?></span>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-center text-md-end mt-4 mt-md-0">
                                        <div class="outcome-box d-inline-block p-4 rounded-4 bg-light border border-white">
                                            <i class="<?php echo $module['outcome_icon'] ?: 'fas fa-bullseye'; ?> text-<?php echo $color; ?> fs-3 mb-2"></i>
                                            <small class="d-block text-dark opacity-50 text-uppercase fw-black" style="font-size: 0.6rem;">Key Outcome</small>
                                            <span class="fw-black text-dark"><?php echo htmlspecialchars($module['outcome_text'] ?: 'Success'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fee Structure Section -->
<section class="fee-structure py-6 bg-light">
    <div class="container">
        <div class="section-title text-center mb-6">
            <h2 class="fw-black mb-3 text-dark">FEE <span class="text-primary">STRUCTURE</span></h2>
            <p class="text-muted">Simplified investment plan for your academic success.</p>
        </div>

        <div class="fee-structure-v2 shadow-2xl bg-white rounded-5 border border-light overflow-hidden">
            <div class="table-responsive">
                <table class="table fee-table-premium mb-0">
                    <thead>
                        <tr>
                            <th class="ps-5">FEE COMPONENT</th>
                            <th class="text-center">LUMP SUM (ONE TIME)</th>
                            <th class="text-center pe-5">INSTALLMENT PLAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-5 py-5">
                                <b class="text-dark fs-5">Academic Tuition Fee</b><br>
                                <small class="text-muted d-block mt-1">Includes Concept Modules, Practice Sheets (CPPs), and full access to the Assessment Vault.</small>
                            </td>
                            <td class="text-center py-5 bg-primary bg-opacity-10">
                                <h2 class="fw-black text-primary mb-0">₹<?php echo number_format($course['fees'], 0); ?></h2>
                                <span class="badge bg-success px-2 py-1 rounded-pill very-small uppercase mt-2"><i class="fas fa-graduation-cap me-1"></i> Avail scholarship <?php echo $scholarship_text; ?></span>
                            </td>
                            <td class="py-5 pe-5">
                                <div class="vstack gap-3 border-start ps-4">
                                    <?php if ($course['fee_includes']): ?>
                                    <div class="mb-2">
                                        <span class="text-secondary very-small fw-bold uppercase tracking-wider">What's Included</span>
                                        <p class="small text-muted mb-0 mt-1"><?php echo nl2br(htmlspecialchars($course['fee_includes'])); ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-secondary small fw-bold">1st Installment (At Admission)</span>
                                        <span class="fw-black text-dark">₹<?php echo number_format($course['fees'] * (($course['inst_1_pct'] ?: 60) / 100), 0); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-secondary small fw-bold">2nd Installment (After 45 Days)</span>
                                        <span class="fw-black text-dark">₹<?php echo number_format($course['fees'] * (($course['inst_2_pct'] ?: 50) / 100), 0); ?></span>
                                    </div>
                                    <div class="alert bg-light border ps-3 py-2 rounded-3 mb-0 very-small text-muted italic mt-2">
                                        * Installment plan includes administrative processing surcharge.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-dark p-4 px-md-5 d-flex flex-column flex-md-row justify-content-between align-items-center text-white text-center text-md-start gap-4">
                <div class="d-flex align-items-center gap-3">
                    <i class="fas fa-graduation-cap fs-4 text-primary"></i>
                    <div>
                        <h6 class="mb-0 fw-bold text-white">ESAT Scholarship Potential</h6>
                        <p class="very-small text-white-50 mb-0">Save up to 90% based on scholarship test performance.</p>
                    </div>
                </div>
                <a href="<?php echo BASE_URL; ?>scholarship" class="btn btn-outline-primary rounded-pill px-5 py-2 fw-bold text-nowrap">Register for ESAT</a>
            </div>
        </div>
    </div>
</section>

<!-- Refund Policy Visualization -->
<section class="refund-policy py-6 bg-white border-top">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-4">
                <h6 class="text-primary fw-bold tracking-widest uppercase mb-3">Institutional Policy</h6>
                <h2 class="fw-black h1 mb-4">TRANSPARENT <br><span class="text-primary">REFUNDS</span></h2>
                <p class="text-muted mb-0">Our refund policy is designed to be fair and transparent, linked directly to the academic commencement date of each batch.</p>
            </div>
            <div class="col-lg-8">
                <div class="row g-3">
                    <div class="col-sm-6 col-xl-3">
                        <div class="refund-box-premium p-4 rounded-4 border border-light shadow-sm text-center transition-all h-100" style="border-top: 4px solid #28a745 !important;">
                            <span class="very-small fw-black text-success text-uppercase tracking-widest mb-2 d-block">Phase 1</span>
                            <h3 class="fw-black mb-1 text-dark">90%</h3>
                            <p class="small fw-bold text-muted mb-0">BEFORE<br>CLASSES</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="refund-box-premium p-4 rounded-4 border border-light shadow-sm text-center transition-all h-100" style="border-top: 4px solid #007bff !important;">
                            <span class="very-small fw-black text-primary text-uppercase tracking-widest mb-2 d-block">Phase 2</span>
                            <h3 class="fw-black mb-1 text-dark">75%</h3>
                            <p class="small fw-bold text-muted mb-0">WITHIN<br>15 DAYS</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="refund-box-premium p-4 rounded-4 border border-light shadow-sm text-center transition-all h-100" style="border-top: 4px solid #ffc107 !important;">
                            <span class="very-small fw-black text-warning text-uppercase tracking-widest mb-2 d-block">Phase 3</span>
                            <h3 class="fw-black mb-1 text-dark">50%</h3>
                            <p class="small fw-bold text-muted mb-0">WITHIN<br>30 DAYS</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="refund-box-premium p-4 rounded-4 border border-light shadow-sm text-center transition-all h-100" style="border-top: 4px solid #dc3545 !important;">
                            <span class="very-small fw-black text-danger text-uppercase tracking-widest mb-2 d-block">Phase 4</span>
                            <h3 class="fw-black mb-1 text-dark">0%</h3>
                            <p class="small fw-bold text-muted mb-0">AFTER<br>30 DAYS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
