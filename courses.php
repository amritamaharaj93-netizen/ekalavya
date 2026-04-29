<?php 
include 'includes/header.php'; 

// Fetch filters from URL
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$class = isset($_GET['class']) ? trim($_GET['class']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

// Build dynamic query
$query = "SELECT * FROM courses WHERE 1=1";
$params = [];

if ($category) {
    if ($category === 'Foundation') {
        $query .= " AND (category = 'Foundation' OR category = 'Junior Foundation')";
    } else {
        $query .= " AND category = ?";
        $params[] = $category;
    }
}

if ($class) {
    $query .= " AND (title LIKE ? OR description LIKE ? OR target_year LIKE ?)";
    $params[] = "%$class%";
    $params[] = "%$class%";
    $params[] = "%$class%";
}

if ($type) {
    // Intelligent Fallback Mapping
    $mapping = [
        'SEED' => '9',
        'ANKUR' => '10',
        'NURTURE' => '11',
        'EMERGE' => '12',
        'IMPULSE' => '12'
    ];
    
    $mapped_class = isset($mapping[strtoupper($type)]) ? $mapping[strtoupper($type)] : '';
    
    if ($mapped_class) {
        $query .= " AND (title LIKE ? OR slug LIKE ? OR category LIKE ? OR title LIKE ? OR description LIKE ?)";
        $params[] = "%$type%";
        $params[] = "%$type%";
        $params[] = "%$type%";
        $params[] = "%$mapped_class%";
        $params[] = "%$mapped_class%";
    } else {
        $query .= " AND (title LIKE ? OR slug LIKE ? OR category LIKE ?)";
        $params[] = "%$type%";
        $params[] = "%$type%";
        $params[] = "%$type%";
    }
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$db_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Header dynamic text
$header_title = "OUR <span class='text-primary'>COURSES</span>";
if ($category) {
    $header_title = htmlspecialchars($category) . " <span class='text-primary'>PROGRAMS</span>";
}
if ($class) {
    $header_title .= " <small class='fs-4 d-block mt-2 opacity-75'>FOR CLASS " . htmlspecialchars($class) . "</small>";
}
?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.82), rgba(0,0,0,0.6)), url('assets/images/classroom_courses_hero.png') center/cover no-repeat; padding: 50px 0 !important;">
    <div class="container text-center text-white">
        <h1 class="display-3 fw-black mb-3"><?php echo $header_title; ?></h1>
    </div>
</section>

<style>
.course-feature-list {
    font-size: 0.85rem;
    color: #475569;
}
.course-feature-list i {
    color: var(--primary-color);
    opacity: 0.9;
    width: 20px;
    text-align: center;
}
.btn-pro-outline {
    background: transparent;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    color: #0f172a;
    padding: 12px 15px;
    font-weight: 800;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-pro-outline:hover {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: #fff;
    box-shadow: 0 5px 15px rgba(249,115,22,0.3);
}
</style>

<!-- Course Browser (Dynamic Premium Grid) -->
<section class="course-browser py-6 bg-white" id="courses">
    <div class="container">
        <div class="section-title text-center mb-6">
            <h2 class="fw-black">CHOOSE YOUR <span class="text-primary">PATHWAY</span></h2>
            <div class="title-accent mx-auto"></div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php if (count($db_courses) > 0): ?>
                <?php foreach($db_courses as $item): 
                    // Dynamic styling logic
                    $cat = strtolower($item['category']);
                    $icon = "fas fa-layer-group";
                    $mark = "PRE";
                    
                    if (strpos($cat, 'jee') !== false || strpos($cat, 'iit') !== false) {
                        $icon = "fas fa-atom";
                        $mark = "IIT";
                    } elseif (strpos($cat, 'neet') !== false || strpos($cat, 'medical') !== false) {
                        $icon = "fas fa-user-md";
                        $mark = "NEET";
                    }
                ?>
                <div class="col-lg-4 col-md-6">
                    <?php 
                        // Dynamic banner selection
                        $banner = "banner3.png"; // Default / Foundation
                        $cat_lower = strtolower($item['category']);
                        if (strpos($cat_lower, 'neet') !== false) $banner = "banner1.png";
                        elseif (strpos($cat_lower, 'jee') !== false || strpos($cat_lower, 'iit') !== false) $banner = "banner2.png";
                        
                        // Class extraction
                        $class_display = "7th-10th";
                        if (stripos($item['title'], 'XI') !== false && stripos($item['title'], 'XII') === false) $class_display = "11th";
                        elseif (stripos($item['title'], 'XII') !== false) $class_display = "12th";
                        elseif (preg_match('/(\d+)th/i', $item['title'], $matches)) $class_display = $matches[0];
                        
                        // Icon selection
                        $title_icon = "fa-book-medical";
                        if (strpos($cat_lower, 'jee') !== false) $title_icon = "fa-atom";
                        elseif (strpos($cat_lower, 'foundation') !== false) $title_icon = "fa-graduation-cap";
                    ?>
                    <?php 
                        // Badge text and card class
                        $badge_text = "PRE-FOUNDATION";
                        $category_class = "course-foundation";
                        if (strpos($cat_lower, 'neet') !== false) {
                            $badge_text = "NEET (MEDICAL)";
                            $category_class = "course-neet";
                        } elseif (strpos($cat_lower, 'jee') !== false || strpos($cat_lower, 'iit') !== false) {
                            $badge_text = "IIT-JEE (ENGG.)";
                            $category_class = "course-jee";
                        }
                        
                        // Dynamic Subtitle Mapping
                        $prog_name = strtoupper(explode(' ', trim($item['title']))[0]);
                        $target_year = $item['target_year'] ?: '2026';
                        $eligibility_text = "For Class " . $class_display . " Students.";
                        
                        if (stripos($item['title'], 'SEED') !== false) {
                            $prog_name = "SEED"; $target_year = "2030"; $eligibility_text = "Class VIII to IX Moving Students.";
                        } elseif (stripos($item['title'], 'ANKUR') !== false) {
                            $prog_name = "ANKUR"; $target_year = "2029"; $eligibility_text = "Class IX to X Moving Students.";
                        } elseif (stripos($item['title'], 'NURTURE') !== false) {
                            $prog_name = "NURTURE"; $target_year = "2028"; $eligibility_text = "Class X TO XI Moving Students.";
                        } elseif (stripos($item['title'], 'EMERGE') !== false) {
                            $prog_name = "EMERGE"; $target_year = "2029"; $eligibility_text = "Class XI to XII Moving Students.";
                        } elseif (stripos($item['title'], 'IMPULSE') !== false) {
                            $prog_name = "IMPULSE"; $target_year = "2029"; $eligibility_text = "DROPPER";
                        }
                    ?>
                    <div class="course-card-v3 <?php echo $category_class; ?>">
                        <div class="card-image">
                            <div class="course-badge"><?php echo $badge_text; ?></div>
                            <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $banner; ?>" alt="Course Banner">
                        </div>
                        <div class="card-body">
                            <div class="card-title-wrap mb-3">
                                <div class="title-icon"><i class="fas <?php echo $title_icon; ?>"></i></div>
                                <h3 class="card-title mb-0"><?php echo htmlspecialchars($item['title']); ?></h3>
                            </div>
                            
                            <div class="course-subtitle-box mb-2 px-1">
                                <div class="fw-black text-dark fs-6"><?php echo $prog_name; ?> - Target <?php echo $target_year; ?></div>
                                <div class="text-muted small fw-bold mt-1"><?php echo $eligibility_text; ?></div>
                            </div>
                            
                            <ul class="course-feature-list list-unstyled mt-2 mb-3">
                                <li class="mb-2 d-flex"><i class="fas fa-circle-check mt-1 me-2"></i> <span>Classroom learning with highly qualified faculty.</span></li>
                                <li class="mb-2 d-flex"><i class="fas fa-circle-check mt-1 me-2"></i> <span>Printed study material, DPPs, and test series.</span></li>
                                <li class="mb-2 d-flex"><i class="fas fa-circle-check mt-1 me-2"></i> <span>Personalized mentoring.</span></li>
                                <li class="mb-2 d-flex"><i class="fas fa-circle-check mt-1 me-2"></i> <span>Healthy academic environment with motivated peers.</span></li>
                            </ul>
                            
                            <div class="mt-auto">
                                <a href="<?php echo BASE_URL; ?>course-detail.php?slug=<?php echo $item['slug']; ?>" class="btn-pro-outline w-100 text-center d-block text-decoration-none">
                                    Check Course Details <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted italic">Courses are being updated. Please check back soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
