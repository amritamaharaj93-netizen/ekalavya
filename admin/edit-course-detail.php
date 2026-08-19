<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$id]);
$course = $stmt->fetch();

if (!$course) {
    die("Course not found.");
}

$success_msg = "";
$error_msg = "";

if (isset($_POST['update_course'])) {
    $hero_banner = $course['hero_banner']; // Default to current
    $card_image = $course['card_image'] ?? ''; // Default to current
    
    // Handle File Upload for Hero Banner
    if (isset($_FILES['hero_banner_upload']) && $_FILES['hero_banner_upload']['error'] === 0) {
        $upload_dir = "../assets/images/";
        $file_ext = strtolower(pathinfo($_FILES['hero_banner_upload']['name'], PATHINFO_EXTENSION));
        $new_filename = "banner_" . time() . "_" . uniqid() . "." . $file_ext;
        
        if (move_uploaded_file($_FILES['hero_banner_upload']['tmp_name'], $upload_dir . $new_filename)) {
            $hero_banner = $new_filename;
        }
    } elseif (!empty($_POST['hero_banner_text'])) {
        $hero_banner = $_POST['hero_banner_text'];
    }

    // Handle File Upload for Card Image
    if (isset($_FILES['card_image_upload']) && $_FILES['card_image_upload']['error'] === 0) {
        $upload_dir = "../assets/images/";
        $file_ext = strtolower(pathinfo($_FILES['card_image_upload']['name'], PATHINFO_EXTENSION));
        $new_filename = "card_" . time() . "_" . uniqid() . "." . $file_ext;
        
        if (move_uploaded_file($_FILES['card_image_upload']['tmp_name'], $upload_dir . $new_filename)) {
            $card_image = $new_filename;
        }
    } elseif (!empty($_POST['card_image_text'])) {
        $card_image = $_POST['card_image_text'];
    }

    $title = trim($_POST['title']);
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $card_features = trim($_POST['card_features'] ?? '');
    $target_year = $_POST['target_year'];
    $fees = !empty($_POST['fees']) ? floatval($_POST['fees']) : 0;
    $description = $_POST['description'];
    $admission_eligibility = $_POST['admission_eligibility'];
    $medium = $_POST['medium'];
    $academic_session = $_POST['academic_session'];
    $scholarship_note = $_POST['scholarship_note'];
    $inst_1_pct = intval($_POST['inst_1_pct']);
    $inst_2_pct = intval($_POST['inst_2_pct']);
    $inst_3_pct = intval($_POST['inst_3_pct']);
    $fee_includes = $_POST['fee_includes'];
    
    // JSON fields
    $experience_json = $_POST['experience_json'];
    $roadmap_json = $_POST['roadmap_json'];
    $curriculum_json = $_POST['curriculum_json'];

    try {
        $stmt = $pdo->prepare("UPDATE courses SET 
            title = ?,
            category = ?,
            duration = ?,
            card_features = ?,
            target_year = ?,
            fees = ?,
            description = ?,
            admission_eligibility = ?,
            hero_banner = ?, 
            card_image = ?,
            medium = ?, 
            academic_session = ?, 
            scholarship_note = ?, 
            inst_1_pct = ?, 
            inst_2_pct = ?, 
            inst_3_pct = ?, 
            fee_includes = ?,
            experience_json = ?, 
            roadmap_json = ?, 
            curriculum_json = ? 
            WHERE id = ?");
        $stmt->execute([$title, $category, $duration, $card_features, $target_year, $fees, $description, $admission_eligibility, $hero_banner, $card_image, $medium, $academic_session, $scholarship_note, $inst_1_pct, $inst_2_pct, $inst_3_pct, $fee_includes, $experience_json, $roadmap_json, $curriculum_json, $id]);
        $success_msg = "All course details updated successfully!";
        // Refresh course data
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        $course = $stmt->fetch();
    } catch (PDOException $e) {
        $error_msg = "Error: " . $e->getMessage();
    }
}

// Default values for JSON if empty
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

$roadmap = json_decode($course['roadmap_json'] ?? '[]', true);
if (empty($roadmap)) {
    $roadmap = [
        ['title' => 'Concept Building', 'desc' => 'Initiating with basic fundamentals to bridge any academic gaps.'],
        ['title' => 'Exhaustive Module Coverage', 'desc' => 'Deep dive into physics, chemistry, and biology/maths modules.'],
        ['title' => 'Periodic Benchmarking', 'desc' => 'Bi-weekly tests and monthly rank-analysis exams.'],
        ['title' => 'Doubt & Revision Sprints', 'desc' => 'Intensive doubt-clearing sessions and formula-recall workshops.'],
        ['title' => 'All India Mock Tests', 'desc' => 'Final touch-ups with national-level benchmarking and predicted AIR analysis.']
    ];
}

$curriculum = json_decode($course['curriculum_json'] ?? '[]', true);
if (empty($curriculum)) {
    $curriculum = [
        ['title' => 'Phase 1: Comprehensive Fundamentals', 'badge' => 'FOUNDATION', 'desc' => 'Initiation into core concepts with focus on higher-level problem solving.', 'topics' => 'Unit & Dimensions, Atomic Structure, Maths for Science', 'outcome_icon' => 'fas fa-bullseye', 'outcome_text' => 'Concept Clarity'],
        ['title' => 'Phase 2: Intermediate Application', 'badge' => 'PRACTICE', 'desc' => 'Applying fundamental concepts to Level 1 and Level 2 problems.', 'topics' => 'Kinematics, Thermodynamics, Periodic Table', 'outcome_icon' => 'fas fa-bolt', 'outcome_text' => 'Problem Solving'],
        ['title' => 'Phase 3: Rank Booster Mastery', 'badge' => 'RANKING', 'desc' => 'Mastering previous year questions and Level 3 problems.', 'topics' => 'Organic Chemistry, Calculus, Optics', 'outcome_icon' => 'fas fa-trophy', 'outcome_text' => 'Exam Readiness']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course Detail | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <style>
        .json-editor-card { background: #f8f9fa; border-radius: 15px; padding: 20px; margin-bottom: 20px; border: 1px solid #dee2e6; }
        .repeater-item { background: white; border-radius: 10px; padding: 15px; margin-bottom: 10px; border: 1px solid #eee; position: relative; }
        .remove-btn { position: absolute; top: 10px; right: 10px; color: #dc3545; cursor: pointer; }
        .text-institutional-orange { color: #f7941d !important; }
        /* Hide TinyMCE API Key Warning */
        .tox-notifications-container { display: none !important; }
    </style>
    <link rel="icon" type="image/png" href="../assets/images/favicon_new.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'courses';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>DESIGN: <?php echo htmlspecialchars($course['title']); ?></h4>
                <a href="manage-courses.php" class="btn btn-outline-secondary rounded-pill">
                    <i class="fas fa-arrow-left me-2"></i> BACK TO LIST
                </a>
            </header>
            
            <div class="p-4">
                <?php if($success_msg): ?>
                    <div class="alert alert-success rounded-4 border-0 mb-4"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                <?php if($error_msg): ?>
                    <div class="alert alert-danger rounded-4 border-0 mb-4"><?php echo $error_msg; ?></div>
                <?php endif; ?>

                <form method="POST" id="courseDetailForm" enctype="multipart/form-data">
                    <!-- HIDDEN JSON FIELDS -->
                    <input type="hidden" name="experience_json" id="experience_json">
                    <input type="hidden" name="roadmap_json" id="roadmap_json">
                    <input type="hidden" name="curriculum_json" id="curriculum_json">

                    <div class="row g-4">
                        <!-- LEFT COLUMN: SETTINGS -->
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Core Information</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Course Title</label>
                                    <input type="text" class="form-control premium-input border" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Category</label>
                                        <select class="form-select premium-input border" name="category" required>
                                            <option value="NEET" <?php echo $course['category'] == 'NEET' ? 'selected' : ''; ?>>NEET (Medical)</option>
                                            <option value="IIT-JEE" <?php echo $course['category'] == 'IIT-JEE' ? 'selected' : ''; ?>>IIT-JEE (Engineering)</option>
                                            <option value="School Prep (Class 7th-12th)" <?php echo $course['category'] == 'School Prep (Class 7th-12th)' ? 'selected' : ''; ?>>School Prep (Class 7-10)</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Duration</label>
                                        <input type="text" class="form-control premium-input border" name="duration" value="<?php echo htmlspecialchars($course['duration']); ?>" required>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Fees (&#x20B9;)</label>
                                         <?php 
                                         $display_fees = $course['fees'];
                                         if (!empty($display_fees)) {
                                             $display_fees = round($display_fees);
                                         }
                                         if (empty($display_fees)) {
                                             $title_upper = strtoupper($course['title']);
                                             if (strpos($title_upper, 'EMERGE') !== false || strpos($title_upper, 'XII') !== false || strpos($title_upper, '12TH') !== false) $display_fees = 54000;
                                             elseif (strpos($title_upper, 'NURTURE') !== false || strpos($title_upper, 'XI') !== false || strpos($title_upper, '11TH') !== false) $display_fees = 82000;
                                             elseif (strpos($title_upper, 'IMPULSE') !== false || strpos($title_upper, 'DROPPER') !== false) $display_fees = 54000;
                                             elseif (strpos($title_upper, 'SEED') !== false || strpos($title_upper, 'IX') !== false || strpos($title_upper, '9TH') !== false) $display_fees = 42000;
                                         }
                                     ?>
                                     <input type="number" step="0.01" class="form-control premium-input border" name="fees" value="<?php echo htmlspecialchars($display_fees ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Short Description</label>
                                    <textarea class="form-control premium-input border" name="description" rows="3" required><?php echo htmlspecialchars($course['description']); ?></textarea>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Hero & Layout</h5>
                                <div class="mb-4">
                                    <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Hero Banner Image</label>
                                    <div class="p-3 bg-light rounded-3 border mb-2">
                                        <small class="text-muted d-block mb-2">Current Image: <b><?php echo htmlspecialchars($course['hero_banner']); ?></b></small>
                                        <input type="file" class="form-control form-control-sm border-0 bg-white" name="hero_banner_upload">
                                    </div>
                                    <input type="text" class="form-control form-control-sm premium-input border mt-2" name="hero_banner_text" placeholder="Or enter filename manually" value="<?php echo htmlspecialchars($course['hero_banner'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Medium</label>
                                    <input type="text" class="form-control premium-input border" name="medium" value="<?php echo htmlspecialchars($course['medium'] ?? 'English / Hindi'); ?>">
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Course Card Settings</h5>
                                <div class="mb-4">
                                    <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Card Image</label>
                                    <div class="p-3 bg-light rounded-3 border mb-2">
                                        <small class="text-muted d-block mb-2">Current Image: <b><?php echo htmlspecialchars($course['card_image'] ?? 'None (Will use default fallback)'); ?></b></small>
                                        <input type="file" class="form-control form-control-sm border-0 bg-white" name="card_image_upload">
                                    </div>
                                    <input type="text" class="form-control form-control-sm premium-input border mt-2" name="card_image_text" placeholder="Or enter filename manually" value="<?php echo htmlspecialchars($course['card_image'] ?? ''); ?>">
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Target Year</label>
                                        <input type="text" class="form-control premium-input border" name="target_year" value="<?php echo htmlspecialchars($course['target_year'] ?? ''); ?>">
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Admission Eligibility</label>
                                        <input type="text" class="form-control premium-input border" name="admission_eligibility" value="<?php echo htmlspecialchars($course['admission_eligibility'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Card Bullet Points (One per line)</label>
                                    <textarea class="form-control premium-input border" name="card_features" rows="4" placeholder="e.g. Classroom learning with highly qualified faculty.&#10;Printed study material..."><?php echo htmlspecialchars($course['card_features'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <h5 class="fw-bold mb-4">Enrollment Details</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Academic Session</label>
                                    <input type="text" class="form-control premium-input border" name="academic_session" value="<?php echo htmlspecialchars($course['academic_session'] ?? '2026-2027'); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">Scholarship Note</label>
                                    <input type="text" class="form-control premium-input border" name="scholarship_note" value="<?php echo htmlspecialchars($course['scholarship_note'] ?? 'Up to 100%'); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-muted text-uppercase mb-2">THINGS INCLUDED IN FEE (ONE PER LINE)</label>
                                    <?php 
                                        $fee_val = $course['fee_includes'] ?? '';
                                        // Auto-convert commas to newlines if it's a single-line comma-separated string
                                        if (strpos($fee_val, ',') !== false && strpos($fee_val, "\n") === false) {
                                            $fee_val = implode("\n", array_map('trim', explode(',', $fee_val)));
                                        }
                                    ?>
                                    <textarea class="form-control premium-input border" name="fee_includes" rows="5" placeholder="e.g. Uniform&#10;Study Material&#10;Bag"><?php echo htmlspecialchars($fee_val); ?></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-4">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Inst. 1 (%)</label>
                                        <input type="number" class="form-control premium-input border" name="inst_1_pct" value="<?php echo intval($course['inst_1_pct'] ?? 60); ?>">
                                    </div>
                                    <div class="col-4">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Inst. 2 (%)</label>
                                        <input type="number" class="form-control premium-input border" name="inst_2_pct" value="<?php echo intval($course['inst_2_pct'] ?? 50); ?>">
                                    </div>
                                    <div class="col-4">
                                        <label class="small fw-bold text-muted text-uppercase mb-2">Inst. 3 (%)</label>
                                        <input type="number" class="form-control premium-input border" name="inst_3_pct" value="<?php echo intval($course['inst_3_pct'] ?? 0); ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="update_course" class="btn btn-premium w-100 py-3 rounded-4 shadow-lg">
                                <i class="fas fa-save me-2"></i> SAVE ALL CHANGES
                            </button>
                        </div>

                        <!-- RIGHT COLUMN: CONTENT BLOCKS -->
                        <div class="col-lg-8">
                            <!-- EXPERIENCE REPEATER -->
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">The Ekalavya Experience</h5>
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="addExperience()">+ ADD FEATURE</button>
                                </div>
                                <div id="experience_container"></div>
                            </div>

                            <!-- ROADMAP REPEATER -->
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">Academic Roadmap (Steps)</h5>
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="addRoadmap()">+ ADD STEP</button>
                                </div>
                                <div id="roadmap_container"></div>
                            </div>

                            <!-- CURRICULUM REPEATER -->
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">Detailed Curriculum (Phases)</h5>
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="addCurriculum()">+ ADD PHASE</button>
                                </div>
                                <div id="curriculum_container"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Data from PHP
        let experienceData = <?php echo json_encode($experience); ?>;
        let roadmapData = <?php echo json_encode($roadmap); ?>;
        let curriculumData = <?php echo json_encode($curriculum); ?>;

        function renderExperience() {
            if (typeof tinymce !== 'undefined') {
                tinymce.remove('.rich-editor-experience');
            }
            const container = document.getElementById('experience_container');
            container.innerHTML = '';
            experienceData.forEach((item, index) => {
                container.innerHTML += `
                    <div class="repeater-item shadow-sm">
                        <span class="remove-btn" onclick="removeItem('experience', ${index})"><i class="fas fa-times"></i></span>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light text-institutional-orange"><i class="${item.icon || 'fas fa-star'}"></i></span>
                                    <select class="form-select border-0 bg-light small" onchange="updateItem('experience', ${index}, 'icon', this.value)">
                                        <option value="fas fa-star" ${item.icon == 'fas fa-star' ? 'selected' : ''}>Default</option>
                                        <option value="fas fa-chalkboard-teacher" ${item.icon == 'fas fa-chalkboard-teacher' ? 'selected' : ''}>Teacher</option>
                                        <option value="fas fa-book" ${item.icon == 'fas fa-book' ? 'selected' : ''}>Books</option>
                                        <option value="fas fa-chart-line" ${item.icon == 'fas fa-chart-line' ? 'selected' : ''}>Results</option>
                                        <option value="fas fa-user-graduate" ${item.icon == 'fas fa-user-graduate' ? 'selected' : ''}>Graduate</option>
                                        <option value="fas fa-comments" ${item.icon == 'fas fa-comments' ? 'selected' : ''}>PTM/Interaction</option>
                                        <option value="fas fa-brain" ${item.icon == 'fas fa-brain' ? 'selected' : ''}>Concepts</option>
                                        <option value="fas fa-copy" ${item.icon == 'fas fa-copy' ? 'selected' : ''}>Modules</option>
                                        <option value="fas fa-hand-holding-heart" ${item.icon == 'fas fa-hand-holding-heart' ? 'selected' : ''}>Mentorship</option>
                                        <option value="fas fa-bullseye" ${item.icon == 'fas fa-bullseye' ? 'selected' : ''}>Outcome</option>
                                        <option value="fas fa-trophy" ${item.icon == 'fas fa-trophy' ? 'selected' : ''}>Ranking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control border-0 bg-light fw-bold" placeholder="Feature Title" value="${item.title}" onchange="handleTitleChange('experience', ${index}, this.value)">
                            </div>
                            <div class="col-12">
                                <textarea id="exp_desc_${index}" class="form-control border-0 bg-light small rich-editor-experience" rows="2" placeholder="Description / Points">${item.desc}</textarea>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: '.rich-editor-experience',
                    menubar: true,
                    plugins: 'lists link image media table code charmap',
                    toolbar: 'code | bold italic underline strikethrough | bullist numlist | alignleft aligncenter alignright alignjustify | forecolor backcolor | link image media table charmap | removeformat',
                    forced_root_block: false,
                    setup: function (editor) {
                        editor.on('change', function () {
                            const index = editor.id.split('_')[2];
                            updateItem('experience', parseInt(index), 'desc', editor.getContent());
                        });
                        editor.on('keyup', function () {
                            const index = editor.id.split('_')[2];
                            updateItem('experience', parseInt(index), 'desc', editor.getContent());
                        });
                    }
                });
            }
        }

        function renderRoadmap() {
            const container = document.getElementById('roadmap_container');
            container.innerHTML = '';
            roadmapData.forEach((item, index) => {
                container.innerHTML += `
                    <div class="repeater-item shadow-sm">
                        <span class="remove-btn" onclick="removeItem('roadmap', ${index})"><i class="fas fa-times"></i></span>
                        <input type="text" class="form-control border-0 bg-light fw-bold mb-2" placeholder="Step Title" value="${item.title}" onchange="updateItem('roadmap', ${index}, 'title', this.value)">
                        <textarea class="form-control border-0 bg-light small" rows="4" placeholder="Step Description" onchange="updateItem('roadmap', ${index}, 'desc', this.value)">${item.desc}</textarea>
                    </div>
                `;
            });
        }

        function renderCurriculum() {
            const container = document.getElementById('curriculum_container');
            container.innerHTML = '';
            curriculumData.forEach((item, index) => {
                container.innerHTML += `
                    <div class="repeater-item shadow-sm">
                        <span class="remove-btn" onclick="removeItem('curriculum', ${index})"><i class="fas fa-times"></i></span>
                        <div class="row g-2 mb-2">
                            <div class="col-md-8">
                                <input type="text" class="form-control border-0 bg-light fw-bold" placeholder="Phase Title (e.g. Phase 1)" value="${item.title}" onchange="updateItem('curriculum', ${index}, 'title', this.value)">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 bg-light small" placeholder="Badge (e.g. FOUNDATION)" value="${item.badge}" onchange="updateItem('curriculum', ${index}, 'badge', this.value)">
                            </div>
                        </div>
                        <textarea class="form-control border-0 bg-light small mb-2" rows="3" placeholder="Phase Description" onchange="updateItem('curriculum', ${index}, 'desc', this.value)">${item.desc}</textarea>
                        <input type="text" class="form-control border-0 bg-light small mb-2" placeholder="Topics (comma separated)" value="${item.topics}" onchange="updateItem('curriculum', ${index}, 'topics', this.value)">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light text-institutional-orange"><i class="${item.outcome_icon || 'fas fa-star'}"></i></span>
                                    <select class="form-select border-0 bg-light small" onchange="updateItem('curriculum', ${index}, 'outcome_icon', this.value)">
                                        <option value="fas fa-star" ${item.outcome_icon == 'fas fa-star' ? 'selected' : ''}>Default</option>
                                        <option value="fas fa-bullseye" ${item.outcome_icon == 'fas fa-bullseye' ? 'selected' : ''}>Goal</option>
                                        <option value="fas fa-bolt" ${item.outcome_icon == 'fas fa-bolt' ? 'selected' : ''}>Problem Solving</option>
                                        <option value="fas fa-trophy" ${item.outcome_icon == 'fas fa-trophy' ? 'selected' : ''}>Ranking</option>
                                        <option value="fas fa-brain" ${item.outcome_icon == 'fas fa-brain' ? 'selected' : ''}>Concepts</option>
                                        <option value="fas fa-book-reader" ${item.outcome_icon == 'fas fa-book-reader' ? 'selected' : ''}>Study</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control border-0 bg-light small" placeholder="Outcome Text" value="${item.outcome_text || ''}" onchange="updateItem('curriculum', ${index}, 'outcome_text', this.value)">
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function updateItem(type, index, field, value) {
            if (type === 'experience') experienceData[index][field] = value;
            if (type === 'roadmap') roadmapData[index][field] = value;
            if (type === 'curriculum') curriculumData[index][field] = value;
            if (field === 'icon' || field === 'outcome_icon') renderAll();
        }

        function handleTitleChange(type, index, value) {
            updateItem(type, index, 'title', value);
            
            // Auto-generate Icon based on title keywords
            const val = value.toLowerCase();
            let suggestedIcon = "";
            
            if (val.includes('learn') || val.includes('concept') || val.includes('study')) suggestedIcon = "fas fa-book-reader";
            else if (val.includes('test') || val.includes('result') || val.includes('analysis') || val.includes('rank')) suggestedIcon = "fas fa-chart-line";
            else if (val.includes('doubt') || val.includes('support') || val.includes('help') || val.includes('question')) suggestedIcon = "fas fa-question-circle";
            else if (val.includes('mentor') || val.includes('expert') || val.includes('guide') || val.includes('teach')) suggestedIcon = "fas fa-user-tie";
            else if (val.includes('success') || val.includes('goal') || val.includes('trophy') || val.includes('win')) suggestedIcon = "fas fa-trophy";
            else if (val.includes('parent') || val.includes('ptm') || val.includes('interaction') || val.includes('comment')) suggestedIcon = "fas fa-comments";
            else if (val.includes('roadmap') || val.includes('phase') || val.includes('step')) suggestedIcon = "fas fa-route";
            
            if (suggestedIcon) {
                if (type === 'experience' && !experienceData[index].icon) {
                    experienceData[index].icon = suggestedIcon;
                    renderExperience();
                }
                if (type === 'curriculum' && !curriculumData[index].outcome_icon) {
                    curriculumData[index].outcome_icon = suggestedIcon;
                    renderCurriculum();
                }
            }
        }

        function removeItem(type, index) {
            if (type === 'experience') experienceData.splice(index, 1);
            if (type === 'roadmap') roadmapData.splice(index, 1);
            if (type === 'curriculum') curriculumData.splice(index, 1);
            renderAll();
        }

        function addExperience() { experienceData.push({icon: '', title: '', desc: ''}); renderExperience(); }
        function addRoadmap() { roadmapData.push({title: '', desc: ''}); renderRoadmap(); }
        function addCurriculum() { curriculumData.push({title: '', badge: '', desc: '', topics: '', outcome_icon: 'fas fa-bullseye', outcome_text: ''}); renderCurriculum(); }

        function renderAll() {
            renderExperience();
            renderRoadmap();
            renderCurriculum();
        }

        document.getElementById('courseDetailForm').addEventListener('submit', function(e) {
            document.getElementById('experience_json').value = JSON.stringify(experienceData);
            document.getElementById('roadmap_json').value = JSON.stringify(roadmapData);
            document.getElementById('curriculum_json').value = JSON.stringify(curriculumData);
        });

        renderAll();
    </script>
</body>
</html>
