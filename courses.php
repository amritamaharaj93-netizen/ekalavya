<?php 
include 'includes/header.php'; 

// Fetch filters from URL
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$class = isset($_GET['class']) ? trim($_GET['class']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

// Build dynamic query
$query = "SELECT * FROM courses WHERE title NOT LIKE '%School Excellence Program%'";
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
    $query .= " AND (title LIKE ? OR description LIKE ?)";
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
        $query .= " AND (title LIKE ? OR slug LIKE ? OR category LIKE ? OR title LIKE ?)";
        $params[] = "%$type%";
        $params[] = "%$type%";
        $params[] = "%$type%";
        $params[] = "%$mapped_class%";
    } else {
        $query .= " AND (title LIKE ? OR slug LIKE ? OR category LIKE ?)";
        $params[] = "%$type%";
        $params[] = "%$type%";
        $params[] = "%$type%";
    }
}

$query .= " ORDER BY 
    CASE 
        WHEN title LIKE '%7th%' THEN 1
        WHEN title LIKE '%8th%' THEN 2
        WHEN title LIKE '%9th%' THEN 3
        WHEN title LIKE '%10th%' THEN 4
        WHEN title LIKE '%11th%' THEN 5
        WHEN title LIKE '%12th%' THEN 6
        WHEN title LIKE 'SEED%' THEN 7
        WHEN title LIKE 'ANKUR%' THEN 8
        WHEN title LIKE 'NURTURE%' THEN 9
        WHEN title LIKE 'EMERGE%' THEN 10
        WHEN title LIKE 'IMPULSE%' THEN 11
        ELSE 12
    END ASC, created_at DESC";
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
<section class="page-header" style="background: url('assets/images/TopFront & side .png') center/100% 100% no-repeat; padding: clamp(40px, 8vh, 100px) 0 !important; padding-left: 5px !important;">
    <div class="container text-center text-white">
        <h1 class="fw-black mb-0" style="font-size: clamp(2.2rem, 10vw, 4.5rem); line-height: 1.1;">
            <?php 
                if ($category) {
                    echo htmlspecialchars($category) . " <span class='text-primary d-block d-md-inline'>PROGRAMS</span>";
                } else {
                    echo "OUR <span class='text-primary d-block d-md-inline'>COURSES</span>";
                }
            ?>
        </h1>

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

/* Banner Text Overlay */
.banner-text-overlay {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.95);
    padding: 5px 15px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    z-index: 5;
    border: 2px solid #28a745;
    text-align: center;
}
.banner-text-overlay .main-text {
    display: block;
    font-size: 0.9rem;
    font-weight: 900;
    color: #1a5c2d;
    line-height: 1.2;
    text-transform: uppercase;
}
.banner-text-overlay .sub-text {
    display: block;
    font-size: 0.65rem;
    font-weight: 800;
    color: #475569;
    letter-spacing: 1px;
    margin-top: 2px;
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
                        $banner = "clean_classroom_banner.png"; // Premium Clean Banner
                        $cat_lower = strtolower($item['category']);
                        if (strpos($cat_lower, 'neet') !== false) $banner = "banner1.png";
                        elseif (strpos($cat_lower, 'jee') !== false || strpos($cat_lower, 'iit') !== false) $banner = "banner2.png";
                        
                        // Class extraction
                        $class_display = "7-10";
                        if (stripos($item['title'], 'XI') !== false && stripos($item['title'], 'XII') === false) $class_display = "11";
                        elseif (stripos($item['title'], 'XII') !== false) $class_display = "12";
                        elseif (preg_match('/(\d+)/i', $item['title'], $matches)) $class_display = $matches[0];
                        
                        // Icon selection
                        $title_icon = "fa-book-medical";
                        if (strpos($cat_lower, 'jee') !== false) $title_icon = "fa-atom";
                        elseif (strpos($cat_lower, 'foundation') !== false || strpos($cat_lower, 'school') !== false) $title_icon = "fa-graduation-cap";
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
                        <div class="card-image position-relative">
                            <?php if ($banner == 'clean_classroom_banner.png'): ?>
                                <div class="banner-text-overlay">
                                    <span class="main-text">CLASS <?php echo $class_display; ?></span>
                                </div>
                            <?php endif; ?>
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
