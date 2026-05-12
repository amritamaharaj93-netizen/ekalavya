<?php
include_once 'config/database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// SEO Logic
$current_page = basename($_SERVER['PHP_SELF'], ".php");
$seo_title = "Ekalavya | Proven Results in IIT-JEE & NEET";
$seo_desc = "Ekalavya is a premier offline coaching institute for IIT-JEE, NEET, and School Prep in Patna and Gaya. Achieve your dreams with our expert faculty and result-oriented approach.";

if ($current_page == 'courses' || $current_page == 'classroom-courses') {
    $seo_title = "Classroom Courses & Programs | Ekalavya NEET & IIT-JEE";
    $seo_desc = "Browse our premium classroom programs for IIT-JEE, NEET, and School Prep. Result-oriented offline coaching available in Patna and Gaya.";
} elseif ($current_page == 'scholarship') {
    $seo_title = "Ekalavya Scholarship Program 2026 | Up to 100% Scholarship";
    $seo_desc = "Register for the Ekalavya Scholarship Admission Test (ESAT) 2026. Avail up to 100% scholarship for NEET, IIT-JEE and School Prep (Class 7th-12th) classroom programs.";
} elseif ($current_page == 'test-series') {
    $seo_title = "AITS Test Series & Mock Exams | Ekalavya";
    $seo_desc = "Enroll in our All India Test Series (AITS) and mock examinations designed for precise national-level benchmarking for NEET and IIT-JEE.";
} elseif ($current_page == 'study-material') {
    $seo_title = "Knowledge Assets & Study Material | Ekalavya";
    $seo_desc = "Download exclusive study modules, notes, and revision practice sheets for physics, chemistry, biology, and mathematics.";
} elseif ($current_page == 'about') {
    $seo_title = "About Ekalavya | India's Leading Institute";
    $seo_desc = "Learn about Ekalavya's proven academic methodologies, expert faculty, and mission to deliver exceptional results in medical and engineering exams.";
} elseif ($current_page == 'contact') {
    $seo_title = "Contact Us | Ekalavya Admission Enquiry";
    $seo_desc = "Get in touch with Ekalavya. Find our head office locations in Patna and Gaya, WhatsApp helpline, and admission details.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_desc; ?>">
    <meta name="keywords"
        content="IIT-JEE, NEET, School Prep (Class 7th-12th), Coaching, Patna, Gaya, Ekalavya, Offline Coaching">
    <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>assets/images/favicon_new.png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Custom Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/premium.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- Main Header -->
    <header class="main-header sticky-top bg-white">
        <!-- Top Utility Bar (Desktop Only) -->
        <div class="top-utility-bar d-none d-lg-block py-1">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="top-info small text-white">
                    <span class="me-4"><i class="fas fa-phone-alt fa-flip-horizontal me-2"></i> 9934244522</span>
                    <span><i class="fas fa-envelope me-2"></i> info.ekalavyaeducation@gmail.com</span>
                </div>
                <div class="top-socials small">
                    <a href="https://www.instagram.com/ekalavya.education/" target="_blank"
                        class="text-white mx-3 opacity-75 hover-opacity-100"><i class="fab fa-instagram"></i></a>
                    <span class="ms-4 text-white"><i class="fas fa-map-marker-alt me-2 text-white opacity-75"></i> Patna
                        | Gaya</span>
                </div>
            </div>
        </div>

        <?php
        // Intelligent Menu Aggregation Logic
        $nav_scholarships = [];
        $nav_courses = [];
        $nav_study = [];
        $nav_tests = [];
        try {
            // Fetch individual courses for the dynamic menu
            $menu_neet = $pdo->query("SELECT title, slug FROM courses WHERE category = 'NEET' 
        AND (title LIKE 'NURTURE%' OR title LIKE 'EMERGE%' OR title LIKE 'IMPULSE%' OR title LIKE 'Arti%')
        ORDER BY 
        CASE 
            WHEN title LIKE 'NURTURE%' THEN 1 
            WHEN title LIKE 'EMERGE%' THEN 2 
            WHEN title LIKE 'IMPULSE%' THEN 3 
            ELSE 4 
        END, title ASC")->fetchAll();
            $menu_jee = $pdo->query("SELECT title, slug FROM courses WHERE category = 'IIT-JEE' ORDER BY 
        CASE 
            WHEN title LIKE 'SEED%' THEN 1 
            WHEN title LIKE 'NURTURE%' THEN 2 
            WHEN title LIKE 'EMERGE%' THEN 3 
            WHEN title LIKE 'IMPULSE%' THEN 4 
            ELSE 5 
        END, title ASC")->fetchAll();
            $menu_school = $pdo->query("SELECT title, slug FROM courses WHERE category = 'School Prep (Class 7th-12th)' ORDER BY 
        CASE 
            WHEN title LIKE '%7th%' THEN 1 
            WHEN title LIKE '%8th%' THEN 2 
            WHEN title LIKE '%9th%' THEN 3 
            WHEN title LIKE '%10th%' THEN 4 
            WHEN title LIKE '%11th%' THEN 5 
            WHEN title LIKE '%12th%' THEN 6 
            ELSE 7 
        END, title ASC")->fetchAll();

            $nav_scholarships = $pdo->query("SELECT tab_name, tab_slug, tab_icon FROM scholarship_tabs WHERE is_active = 1 ORDER BY display_order ASC")->fetchAll();
            $nav_study = $pdo->query("SELECT id, title, slug FROM study_material ORDER BY created_at DESC LIMIT 5")->fetchAll();

            // Fetch test series for the dynamic menu
            $nav_test_neet = $pdo->query("SELECT title, category, type FROM test_series WHERE category = 'NEET' ORDER BY 
                CASE 
                    WHEN title LIKE '%11%' THEN 1 
                    WHEN title LIKE '%12%' AND title NOT LIKE '%PASS%' AND title NOT LIKE '%DROPPER%' THEN 2 
                    WHEN title LIKE '%PASS%' OR title LIKE '%DROPPER%' THEN 3 
                    ELSE 4 
                END, title ASC")->fetchAll();
            $nav_test_jee = $pdo->query("SELECT title, category, type FROM test_series WHERE category = 'IIT-JEE' ORDER BY 
                CASE 
                    WHEN title LIKE '%11%' THEN 1 
                    WHEN title LIKE '%12%' AND title NOT LIKE '%PASS%' AND title NOT LIKE '%DROPPER%' THEN 2 
                    WHEN title LIKE '%PASS%' OR title LIKE '%DROPPER%' THEN 3 
                    ELSE 4 
                END, title ASC")->fetchAll();
        } catch (PDOException $e) {
            /* Critical fallback suppressed */
            $nav_test_neet = [];
            $nav_test_jee = [];
        }
        ?>

        <!-- Main Navigation Bar -->
        <nav class="navbar navbar-expand-xl navbar-light bg-white py-1 shadow-sm">
            <div class="container-fluid px-3 px-xxl-5">
                <!-- Logo -->
                <a class="navbar-brand py-0 me-xl-1 me-xxl-3" href="<?php echo BASE_URL; ?>">
                    <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="Ekalavya" class="logo-main">
                </a>

                <!-- Mobile Scholarship Button (Center) -->
                <a href="<?php echo BASE_URL; ?>scholarship.php"
                    class="btn-header-pill btn-header-scholarship d-xl-none mx-auto px-2 py-1 shadow-sm">
                    <i class="fas fa-graduation-cap me-1"></i> Scholarship
                </a>

                <!-- Mobile Toggler -->
                <button class="navbar-toggler border-0 shadow-none d-xl-none ms-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Desktop Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto gap-xl-0 gap-xxl-3">
                        <!-- Classroom Courses Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link px-xl-1 px-xxl-3 text-capitalize d-flex align-items-center text-nowrap"
                                href="<?php echo BASE_URL; ?>classroom-courses">
                                Classroom Courses <i class="fas fa-chevron-down ms-1 ms-xxl-2 small opacity-50"></i>
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg p-3">
                                <li class="dropdown-item py-2 px-3 rounded-3 d-flex justify-content-between align-items-center p-0">
                                    <a href="<?php echo BASE_URL; ?>courses.php?category=NEET" class="w-100 d-flex justify-content-between align-items-center text-decoration-none text-dark py-2 px-3">
                                        <span><i class="fas fa-certificate me-2 opacity-50"></i> NEET (Medical)</span>
                                        <i class="fas fa-chevron-right small opacity-50"></i>
                                    </a>
                                    <ul class="dropdown-submenu list-unstyled m-0">
                                        <?php if (!empty($menu_neet)): ?>
                                            <?php foreach ($menu_neet as $item): ?>
                                                <li><a class="dropdown-item py-2"
                                                        href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=<?php echo urlencode(explode(' ', trim($item['title']))[0]); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=NURTURE">NURTURE
                                                    (Class XI)</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=EMERGE">EMERGE
                                                    (Class XII)</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=IMPULSE">IMPULSE
                                                    (Dropper)</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li class="dropdown-item py-2 px-3 rounded-3 d-flex justify-content-between align-items-center p-0">
                                    <a href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE" class="w-100 d-flex justify-content-between align-items-center text-decoration-none text-dark py-2 px-3">
                                        <span><i class="fas fa-gear me-2 opacity-50"></i> IIT-JEE (Engg.)</span>
                                        <i class="fas fa-chevron-right small opacity-50"></i>
                                    </a>
                                    <ul class="dropdown-submenu list-unstyled m-0">
                                        <?php if (!empty($menu_jee)): ?>
                                            <?php foreach ($menu_jee as $item): ?>
                                                <li><a class="dropdown-item py-2"
                                                        href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE&type=<?php echo urlencode(explode(' ', trim($item['title']))[0]); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE&type=SEED">SEED
                                                    (Class IX)</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE&type=NURTURE">NURTURE
                                                    (Class XI)</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li class="dropdown-item py-2 px-3 rounded-3 d-flex justify-content-between align-items-center p-0">
                                    <a href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)" class="w-100 d-flex justify-content-between align-items-center text-decoration-none text-dark py-2 px-3">
                                        <span><i class="fas fa-school me-2 opacity-50"></i> School Prep (Class 7th-12th)</span>
                                        <i class="fas fa-chevron-right small opacity-50"></i>
                                    </a>
                                    <ul class="dropdown-submenu list-unstyled m-0">
                                        <?php if (!empty($menu_school)): ?>
                                            <?php foreach ($menu_school as $item): ?>
                                                <li><a class="dropdown-item py-2"
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&type=<?php echo urlencode($item['title']); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=7">Class
                                                    7th Standard</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=8">Class
                                                    8th Standard</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=9">Class
                                                    9th Standard</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=10">Class
                                                    10th Standard</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=11">Class
                                                    11th Standard</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=12">Class
                                                    12th Standard</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li>
                                    <hr class="dropdown-divider opacity-10">
                                </li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3 fw-bold text-primary"
                                        href="<?php echo BASE_URL; ?>classroom-courses.php"><i
                                            class="fas fa-chalkboard-teacher me-2"></i> Classroom Programs</a></li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3 fw-bold text-primary"
                                        href="<?php echo BASE_URL; ?>courses.php">Browse All Courses</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link px-xl-1 px-xxl-3 text-capitalize d-flex align-items-center text-nowrap"
                                href="<?php echo BASE_URL; ?>test-series.php">
                                Test Series <i class="fas fa-chevron-down ms-1 ms-xxl-2 small opacity-50"></i>
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg p-3">
                                <li
                                    class="dropdown-item py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-vial me-2 opacity-50"></i> AITS (NEET)</span>
                                    <i class="fas fa-chevron-right small opacity-50"></i>
                                    <ul class="dropdown-submenu list-unstyled m-0">
                                        <?php if (!empty($nav_test_neet)): ?>
                                            <?php foreach ($nav_test_neet as $item): ?>
                                                <li><a class="dropdown-item py-2 text-uppercase"
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=<?php echo urlencode($item['type']); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=Class11">CLASS-
                                                    11TH</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=Class12">CLASS
                                                    12TH</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=Dropper">NEET:
                                                    12TH PASS /DROPPER</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li
                                    class="dropdown-item py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-vial me-2 opacity-50"></i> AITS (IIT-JEE)</span>
                                    <i class="fas fa-chevron-right small opacity-50"></i>
                                    <ul class="dropdown-submenu list-unstyled m-0">
                                        <?php if (!empty($nav_test_jee)): ?>
                                            <?php foreach ($nav_test_jee as $item): ?>
                                                <li><a class="dropdown-item py-2 text-uppercase"
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=<?php echo urlencode($item['type']); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=Class11">CLASS-
                                                    11TH</a></li>
                                            <li><a class="dropdown-item py-2"
                                                    href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=Class12">CLASS
                                                    12TH</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li>
                                    <hr class="dropdown-divider opacity-10">
                                </li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3 fw-bold text-primary"
                                        href="<?php echo BASE_URL; ?>test-series">All Test Series</a></li>
                            </ul>
                        </li>

                        <!-- Scholarship Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link px-xl-1 px-xxl-3 text-capitalize d-flex align-items-center text-nowrap"
                                href="<?php echo BASE_URL; ?>scholarship.php">
                                Scholarship <i class="fas fa-chevron-down ms-1 ms-xxl-2 small opacity-50"></i>
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg p-3" style="min-width: 250px;">
                                <!-- <li><a class="dropdown-item py-2 px-3 rounded-3"
                                        href="<?php echo BASE_URL; ?>scholarship.php"><i
                                            class="fas fa-graduation-cap me-2 opacity-50"></i> Scholarship Program</a>
                                </li> -->
                                <?php foreach ($nav_scholarships as $nav_s): ?>
                                    <?php if ($nav_s['tab_slug'] === 'early-bird')
                                        continue; ?>
                                    <li><a class="dropdown-item py-2 px-3 rounded-3"
                                            href="<?php echo BASE_URL; ?>scholarship.php?path=<?php echo $nav_s['tab_slug']; ?>"><i
                                                class="<?php echo $nav_s['tab_icon']; ?> me-2 opacity-50"></i>
                                            <?php echo htmlspecialchars($nav_s['tab_name']); ?></a></li>
                                <?php endforeach; ?>
                                <li>
                                    <hr class="dropdown-divider opacity-10">
                                </li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3 fw-bold text-primary"
                                        href="<?php echo BASE_URL; ?>scholarship.php"><i class="fas fa-edit me-2"></i>
                                        Register for 2026-27</a></li>
                            </ul>
                        </li>

                        <!-- CareerPath -->
                        <li class="nav-item">
                            <a class="nav-link px-xl-1 px-xxl-3 text-capitalize fw-bold text-primary d-flex align-items-center text-nowrap"
                                href="<?php echo BASE_URL; ?>careerpath.php">
                                CareerPath <span class="badge bg-danger ms-1" style="font-size: 0.6rem;">NEW</span>
                            </a>
                        </li>

                        <!-- Study Material Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link px-xl-1 px-xxl-3 text-capitalize d-flex align-items-center text-nowrap"
                                href="<?php echo BASE_URL; ?>study-material.php">
                                Study Material <i class="fas fa-chevron-down ms-1 ms-xxl-2 small opacity-50"></i>
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg p-3">
                                <li><a class="dropdown-item py-2 px-3 rounded-3"
                                        href="<?php echo BASE_URL; ?>study-material.php?category=JEE"><i
                                            class="fas fa-atom me-2 opacity-50"></i> Jee Mains</a></li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3"
                                        href="<?php echo BASE_URL; ?>study-material.php?category=NEET"><i
                                            class="fas fa-user-md me-2 opacity-50"></i> NEET</a></li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3"
                                        href="<?php echo BASE_URL; ?>study-material.php?category=NCERT"><i
                                            class="fas fa-book me-2 opacity-50"></i> NCERT</a></li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3"
                                        href="<?php echo BASE_URL; ?>study-material.php?category=HC-Verma"><i
                                            class="fas fa-square-root-alt me-2 opacity-50"></i> Physics/HC VERMA
                                         Solution</a></li>
                                <li>
                                    <hr class="dropdown-divider opacity-10">
                                </li>
                                <li><a class="dropdown-item py-2 px-3 rounded-3 fw-bold text-primary"
                                        href="<?php echo BASE_URL; ?>study-material.php">Browse All Vault</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="nav-cta ms-xl-1 ms-xxl-2 d-flex align-items-center gap-1 gap-xxl-2">
                        <?php if (isset($_SESSION['student_id'])): ?>
                            <a href="<?php echo BASE_URL; ?>student-dashboard.php" class="btn-header-pill btn-header-login">
                                <i class="fas fa-columns"></i> Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL; ?>student-login.php" class="btn-header-pill btn-header-login">
                                <i class="far fa-clipboard"></i> Student Portal
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo BASE_URL; ?>scholarship.php"
                            class="btn-header-pill btn-header-scholarship ms-1 ms-xxl-2">
                            <i class="fas fa-graduation-cap"></i> Scholarship 2026
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Offcanvas Mobile Menu (Mobile only) -->
    <div class="offcanvas offcanvas-start d-xl-none" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <a class="navbar-brand py-0" href="<?php echo BASE_URL; ?>">
                <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="Logo" height="50">
            </a>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="mobile-nav-wrapper flex-grow-1">
                <ul class="nav flex-column mobile-main-nav">
                    <!-- Classroom Courses -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center justify-content-between collapsed"
                            data-bs-toggle="collapse" href="#mobileCourses" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-chalkboard-teacher menu-icon"></i>
                                <span class="menu-text">Classroom Courses</span>
                            </div>
                            <i class="fas fa-chevron-down arrow-icon"></i>
                        </a>
                        <div class="collapse" id="mobileCourses">
                            <ul class="nav flex-column mobile-sub-nav">
                                <!-- NEET Nested -->
                                <li class="pe-3">
                                    <a href="<?php echo BASE_URL; ?>courses.php?category=NEET" 
                                        class="d-flex align-items-center justify-content-between py-2 text-decoration-none">
                                        <span class="text-dark"><i class="fas fa-certificate me-2 opacity-50"></i> NEET
                                            (Medical)</span>
                                        <div data-bs-toggle="collapse" data-bs-target="#mobileNeetSub" class="p-2"><i class="fas fa-chevron-right small opacity-50"></i></div>
                                    </a>
                                    <div class="collapse" id="mobileNeetSub">
                                        <ul class="nav flex-column mobile-inner-nav">
                                            <?php if (!empty($menu_neet)): ?>
                                                <?php foreach ($menu_neet as $item): ?>
                                                    <li><a
                                                            href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=<?php echo urlencode(explode(' ', trim($item['title']))[0]); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><a href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=NURTURE">NURTURE
                                                        (Class XI)</a></li>
                                                <li><a href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=EMERGE">EMERGE
                                                        (Class XII)</a></li>
                                                <li><a href="<?php echo BASE_URL; ?>courses.php?category=NEET&type=IMPULSE">IMPULSE
                                                        (Dropper)</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <!-- IIT-JEE Nested -->
                                <li class="pe-3">
                                    <a href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE" 
                                        class="d-flex align-items-center justify-content-between py-2 text-decoration-none">
                                        <span class="text-dark"><i class="fas fa-gear me-2 opacity-50"></i> IIT-JEE
                                            (Engg.)</span>
                                        <div data-bs-toggle="collapse" data-bs-target="#mobileJeeSub" class="p-2"><i class="fas fa-chevron-right small opacity-50"></i></div>
                                    </a>
                                    <div class="collapse" id="mobileJeeSub">
                                        <ul class="nav flex-column mobile-inner-nav">
                                            <?php if (!empty($menu_jee)): ?>
                                                <?php foreach ($menu_jee as $item): ?>
                                                    <li><a
                                                            href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE&type=<?php echo urlencode(explode(' ', trim($item['title']))[0]); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><a href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE&type=SEED">SEED
                                                        (Class IX)</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=IIT-JEE&type=NURTURE">NURTURE
                                                        (Class XI)</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <!-- School Prep Nested -->
                                <li class="pe-3">
                                    <a href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)" 
                                        class="d-flex align-items-center justify-content-between py-2 text-decoration-none">
                                        <span class="text-dark"><i class="fas fa-school me-2 opacity-50"></i> School
                                            Prep</span>
                                        <div data-bs-toggle="collapse" data-bs-target="#mobileSchoolSub" class="p-2"><i class="fas fa-chevron-right small opacity-50"></i></div>
                                    </a>
                                    <div class="collapse" id="mobileSchoolSub">
                                        <ul class="nav flex-column mobile-inner-nav">
                                            <?php if (!empty($menu_school)): ?>
                                                <?php foreach ($menu_school as $item): ?>
                                                    <li><a
                                                            href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&type=<?php echo urlencode($item['title']); ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=7">Class
                                                        7th Standard</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=8">Class
                                                        8th Standard</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=9">Class
                                                        9th Standard</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=10">Class
                                                        10th Standard</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=11">Class
                                                        11th Standard</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>courses.php?category=School Prep (Class 7th-12th)&class=12">Class
                                                        12th Standard</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="<?php echo BASE_URL; ?>classroom-courses.php"
                                        class="fw-bold text-primary">All Classroom Programs</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Test Series -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center justify-content-between collapsed"
                            data-bs-toggle="collapse" href="#mobileTestSeries" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-edit menu-icon"></i>
                                <span class="menu-text">Test Series</span>
                            </div>
                            <i class="fas fa-chevron-down arrow-icon"></i>
                        </a>
                        <div class="collapse" id="mobileTestSeries">
                            <ul class="nav flex-column mobile-sub-nav">
                                <!-- AITS NEET -->
                                <li class="pe-3">
                                    <a href="#mobileAitsNeet" data-bs-toggle="collapse"
                                        class="d-flex align-items-center justify-content-between collapsed py-2 text-decoration-none">
                                        <span class="text-dark"><i class="fas fa-vial me-2 opacity-50"></i> AITS
                                            (NEET)</span>
                                        <i class="fas fa-chevron-right small opacity-50"></i>
                                    </a>
                                    <div class="collapse" id="mobileAitsNeet">
                                        <ul class="nav flex-column mobile-inner-nav">
                                            <?php if (!empty($nav_test_neet)): ?>
                                                <?php foreach ($nav_test_neet as $item): ?>
                                                    <li><a href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=<?php echo urlencode($item['type']); ?>"
                                                            class="text-uppercase"><?php echo htmlspecialchars($item['title']); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=Class11">CLASS-
                                                        11TH</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=Class12">CLASS
                                                        12TH</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=NEET&type=Dropper">NEET:
                                                        12TH PASS /DROPPER</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <!-- AITS JEE -->
                                <li class="pe-3">
                                    <a href="#mobileAitsJee" data-bs-toggle="collapse"
                                        class="d-flex align-items-center justify-content-between collapsed py-2 text-decoration-none">
                                        <span class="text-dark"><i class="fas fa-vial me-2 opacity-50"></i> AITS
                                            (IIT-JEE)</span>
                                        <i class="fas fa-chevron-right small opacity-50"></i>
                                    </a>
                                    <div class="collapse" id="mobileAitsJee">
                                        <ul class="nav flex-column mobile-inner-nav">
                                            <?php if (!empty($nav_test_jee)): ?>
                                                <?php foreach ($nav_test_jee as $item): ?>
                                                    <li><a href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=<?php echo urlencode($item['type']); ?>"
                                                            class="text-uppercase"><?php echo htmlspecialchars($item['title']); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=Class11">CLASS-
                                                        11TH</a></li>
                                                <li><a
                                                        href="<?php echo BASE_URL; ?>test-series.php?category=IIT-JEE&type=Class12">CLASS
                                                        12TH</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="<?php echo BASE_URL; ?>test-series.php" class="fw-bold text-primary">All
                                        Test Series</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Scholarship -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center justify-content-between collapsed"
                            data-bs-toggle="collapse" href="#mobileScholarship" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-graduation-cap menu-icon"></i>
                                <span class="menu-text">Scholarship</span>
                            </div>
                            <i class="fas fa-chevron-down arrow-icon"></i>
                        </a>
                        <div class="collapse" id="mobileScholarship">
                            <ul class="nav flex-column mobile-sub-nav">
                                <li><a href="<?php echo BASE_URL; ?>scholarship.php">Scholarship Program</a></li>
                                <?php foreach ($nav_scholarships as $nav_s): ?>
                                    <?php if ($nav_s['tab_slug'] === 'early-bird')
                                        continue; ?>
                                    <li><a
                                            href="<?php echo BASE_URL; ?>scholarship.php?path=<?php echo $nav_s['tab_slug']; ?>"><?php echo htmlspecialchars($nav_s['tab_name']); ?></a>
                                    </li>
                                <?php endforeach; ?>
                                <li><a href="<?php echo BASE_URL; ?>scholarship.php" class="fw-bold text-primary"><i
                                            class="fas fa-edit me-2"></i> Register for 2026-27</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- CareerPath -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="<?php echo BASE_URL; ?>careerpath.php">
                            <i class="fas fa-route menu-icon"></i>
                            <span class="menu-text">CareerPath</span>
                        </a>
                    </li>

                    <!-- Study Material -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center justify-content-between collapsed"
                            data-bs-toggle="collapse" href="#mobileStudy" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf menu-icon"></i>
                                <span class="menu-text">Study Material</span>
                            </div>
                            <i class="fas fa-chevron-down arrow-icon"></i>
                        </a>
                        <div class="collapse" id="mobileStudy">
                            <ul class="nav flex-column mobile-sub-nav">
                                <li><a href="<?php echo BASE_URL; ?>study-material.php?category=JEE"><i
                                            class="fas fa-atom me-2 opacity-50"></i> JEE Mains</a></li>
                                <li><a href="<?php echo BASE_URL; ?>study-material.php?category=NEET"><i
                                            class="fas fa-user-md me-2 opacity-50"></i> NEET</a></li>
                                <li><a href="<?php echo BASE_URL; ?>study-material.php?category=NCERT"><i
                                            class="fas fa-book me-2 opacity-50"></i> NCERT</a></li>
                                <li><a href="<?php echo BASE_URL; ?>study-material.php?category=HC-Verma"><i
                                            class="fas fa-square-root-alt me-2 opacity-50"></i> Physics/HC VERMA</a>
                                </li>
                                <li><a href="<?php echo BASE_URL; ?>study-material.php"
                                        class="fw-bold text-primary mt-2">Browse All Vault</a></li>
                            </ul>
                        </div>
                    </li>
                    <div class="d-grid gap-3 px-4">
                        <?php if (isset($_SESSION['student_id'])): ?>
                            <a href="<?php echo BASE_URL; ?>student-dashboard.php"
                                class="btn btn-portal-mobile py-3 rounded-pill">
                                <i class="fas fa-columns me-2"></i> Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL; ?>student-login.php"
                                class="btn btn-portal-mobile py-2 rounded-pill">
                                <i class="far fa-clipboard me-2"></i> Student Portal
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo BASE_URL; ?>scholarship.php"
                            class="btn btn-header-pill btn-scholarship-mobile d-flex align-items-center justify-content-center py-2">
                            <i class="fas fa-graduation-cap me-2"></i> <span class="fw-bold">Scholarship Exam
                                2026</span>
                        </a>
                    </div>
                    <div class="mobile-contact-info d-grid gap-2 mt-3 px-4">
                        <a href="tel:9934244522"
                            class="btn btn-outline-dark rounded-pill d-flex align-items-center fw-bold shadow-sm py-2"
                            style="font-size: 0.9rem;">
                            <i class="fas fa-phone-alt fa-flip-horizontal me-3 text-orange"></i> 9934244522
                        </a>
                        <a href="mailto:info.ekalavyaeducation@gmail.com"
                            class="btn btn-outline-dark rounded-pill d-flex align-items-center fw-bold shadow-sm py-2"
                            style="font-size: 0.85rem;">
                            <i class="fas fa-envelope me-3 text-orange"></i> info.ekalavyaeducation@gmail.com
                        </a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-4 px-4">
                        <div class="small text-muted fw-bold">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i> PATNA | GAYA
                        </div>
                        <div class="social-links">
                            <a href="https://www.instagram.com/ekalavya.education/" target="_blank"
                                class="text-primary fs-4"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>