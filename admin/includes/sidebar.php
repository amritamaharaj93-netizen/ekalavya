<div class="sidebar">
    <div class="sidebar-brand">
        <img src="../assets/images/logo.png" alt="Eklavya">
    </div>
    
    <div class="nav-wrapper">
        <a class="nav-link <?php echo $current_page == 'dashboard' ? 'active' : ''; ?>" href="dashboard.php">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a class="nav-link <?php echo $current_page == 'courses' ? 'active' : ''; ?>" href="manage-courses.php">
            <i class="fas fa-book-open"></i> Courses
        </a>
        <a class="nav-link <?php echo $current_page == 'test_series' ? 'active' : ''; ?>" href="manage-test-series.php">
            <i class="fas fa-clipboard-list"></i> Test Series
        </a>
        <?php /*
        <a class="nav-link <?php echo $current_page == 'scholarship-tabs' ? 'active' : ''; ?>" href="manage-scholarship-tabs.php">
            <i class="fas fa-layer-group"></i> Scholarship Page
        </a>
        */ ?>
        <a class="nav-link <?php echo $current_page == 'career_path' ? 'active' : ''; ?>" href="manage-career-path.php">
            <i class="fas fa-route"></i> Career Path
        </a>
        <a class="nav-link <?php echo $current_page == 'study_material' ? 'active' : ''; ?>" href="manage-study-material.php">
            <i class="fas fa-file-alt"></i> Study Material
        </a>
        <?php /*
        <a class="nav-link <?php echo $current_page == 'scholarship_programs' ? 'active' : ''; ?>" href="manage-scholarships.php">
            <i class="fas fa-award"></i> Scholarships
        </a>
        */ ?>
        <a class="nav-link <?php echo $current_page == 'study_centers' ? 'active' : ''; ?>" href="manage-study-centers.php">
            <i class="fas fa-map-marker-alt"></i> Study Centers
        </a>
        
        <div class="mt-4 px-3 mb-2">
            <small class="text-uppercase text-white opacity-25 fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Interactions</small>
        </div>
        
        <?php /*
        <a class="nav-link <?php echo $current_page == 'scholarships' ? 'active' : ''; ?>" href="view-scholarships.php">
            <i class="fas fa-id-card"></i> Scholarship Apps
        </a>
        */ ?>
        <a class="nav-link <?php echo $current_page == 'leads' ? 'active' : ''; ?>" href="view-enquiries.php">
            <i class="fas fa-inbox"></i> Request Access
        </a>
        <a class="nav-link <?php echo $current_page == 'students' ? 'active' : ''; ?>" href="manage-students.php">
            <i class="fas fa-users"></i> Manage Students
        </a>
    </div>
    
    <div class="sidebar-footer">
        <a class="nav-link logout-link" href="logout.php">
            <i class="fas fa-power-off"></i> Logout
        </a>
    </div>
</div>
