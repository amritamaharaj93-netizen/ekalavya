<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eklavya Academy | Proven Results in IIT-JEE & NEET</title>
    <meta name="description" content="Eklavya Academy is a premier offline coaching institute for IIT-JEE, NEET, and Foundation courses in Patna and Gaya. Achieve your dreams with our expert faculty and result-oriented approach.">
    <meta name="keywords" content="IIT-JEE, NEET, Foundation, Coaching, Patna, Gaya, Eklavya Academy, Offline Coaching">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- Main Header -->
    <header class="main-header sticky-top bg-white">
        <!-- Top Utility Bar (Desktop Only) -->
        <div class="top-utility-bar d-none d-lg-block py-2">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="top-info small text-white">
                    <span class="me-4"><i class="fas fa-phone-alt me-2"></i> 9934244522</span>
                    <span><i class="fas fa-envelope me-2"></i> info.ekalavya@gmail.com</span>
                </div>
                <div class="top-socials small">
                    <a href="https://www.instagram.com/ekalavya.education/" target="_blank" class="text-white mx-3 opacity-75 hover-opacity-100"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white mx-3 opacity-75 hover-opacity-100"><i class="fab fa-facebook-f"></i></a>
                    <span class="ms-4 text-white"><i class="fas fa-map-marker-alt me-2 text-white opacity-75"></i> Patna | Gaya</span>
                </div>
            </div>
        </div>

        <!-- Main Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand py-0" href="./">
    <img src="assets/images/logo.png" alt="Eklavya Academy" height="70">
</a>

<!-- Mobile Toggler -->
<button class="navbar-toggler border-0 shadow-none d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- Desktop Menu -->
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
        <!-- Courses Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link px-3 text-uppercase dropdown-toggle" style="font-size: 0.9rem;" href="courses.php" id="coursesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Courses
            </a>
            <ul class="dropdown-menu border-0 shadow-lg p-3" aria-labelledby="coursesDropdown">
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="courses.php#foundational"><i class="fas fa-layer-group me-2 opacity-50"></i> Foundational (7th-10th)</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="courses.php#iitjee"><i class="fas fa-atom me-2 opacity-50"></i> IIT-JEE (Mains & Adv)</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="courses.php#neetug"><i class="fas fa-user-md me-2 opacity-50"></i> NEET-UG (Medical)</a></li>
            </ul>
        </li>
        
        <!-- Scholarship Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link px-3 text-uppercase dropdown-toggle" style="font-size: 0.9rem;" href="scholarship.php" id="scholarshipDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Scholarship
            </a>
            <ul class="dropdown-menu border-0 shadow-lg p-3" aria-labelledby="scholarshipDropdown">
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="scholarship.php#esat"><i class="fas fa-edit me-2 opacity-50"></i> ESAT Exam</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="scholarship.php#eligibility"><i class="fas fa-info-circle me-2 opacity-50"></i> Eligibility & Benefits</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="scholarship.php#register"><i class="fas fa-user-plus me-2 opacity-50"></i> Register Now</a></li>
            </ul>
        </li>

        <!-- Study Materials Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link px-3 text-uppercase dropdown-toggle" style="font-size: 0.9rem;" href="study-material.php" id="studyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Study Materials
            </a>
            <ul class="dropdown-menu border-0 shadow-lg p-3" aria-labelledby="studyDropdown">
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="study#physics"><i class="fas fa-rocket me-2 opacity-50"></i> Physics Modules</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="study#chemistry"><i class="fas fa-flask me-2 opacity-50"></i> Chemistry Modules</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="study#math"><i class="fas fa-square-root-alt me-2 opacity-50"></i> Math Modules</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="study#biology"><i class="fas fa-dna me-2 opacity-50"></i> Biology Modules</a></li>
            </ul>
        </li>

        <!-- Test Series Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link px-3 text-uppercase dropdown-toggle" style="font-size: 0.9rem;" href="test-series.php" id="testDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Test Series
            </a>
            <ul class="dropdown-menu border-0 shadow-lg p-3" aria-labelledby="testDropdown">
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="tests#aits"><i class="fas fa-vial me-2 opacity-50"></i> All India Test Series</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="tests#mock"><i class="fas fa-laptop-code me-2 opacity-50"></i> Mock Examinations</a></li>
                <li><a class="dropdown-item py-2 px-3 rounded-3" href="tests#prev"><i class="fas fa-history me-2 opacity-50"></i> Previous Year Papers</a></li>
            </ul>
        </li>
    </ul>
                    <div class="nav-cta ms-lg-3 d-flex align-items-center gap-2">
                        <a href="login" class="btn-header-pill btn-header-login">
                            <i class="far fa-clipboard"></i> Student Portal
                        </a>
                        <a href="scholarship" class="btn-header-pill btn-header-scholarship">
                            <i class="fas fa-graduation-cap"></i> Register for Scholarship Exam
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Offcanvas Mobile Menu (Mobile only) -->
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom">
            <a class="navbar-brand py-0" href="index.php">
                <img src="assets/images/logo.png" alt="Logo" height="50">
            </a>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <ul class="navbar-nav flex-grow-1 pe-3">
                <li class="nav-item mb-2">
                    <a class="nav-link" href="courses.php"><i class="fas fa-book me-2 text-primary"></i> Courses</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="scholarship.php"><i class="fas fa-graduation-cap me-2 text-primary"></i> Scholarship</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="study-material.php"><i class="fas fa-file-pdf me-2 text-primary"></i> Study Materials</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="test-series.php"><i class="fas fa-pen-to-square me-2 text-primary"></i> Test Series</a>
                </li>
            </ul>
            
            <div class="mt-auto pt-4 border-top text-center">
                <div class="d-grid gap-3 mb-4">
                     <a href="login.php" class="btn-header-pill btn-header-login justify-content-center py-3">
                         <i class="far fa-clipboard"></i> Student Portal
                     </a>
                     <a href="scholarship.php" class="btn-header-pill btn-header-scholarship justify-content-center py-3">
                         <i class="fas fa-graduation-cap"></i> Register for Scholarship Exam
                     </a>
                     <a href="tel:9934244522" class="btn btn-outline-dark py-3 rounded-pill"><i class="fas fa-phone-alt me-2 text-primary"></i> 9934244522</a>
                </div>
                <div class="social-links">
                    <a href="https://www.instagram.com/ekalavya.education/" target="_blank" class="text-primary mx-2 fs-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-primary mx-2 fs-4"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
    </div>
