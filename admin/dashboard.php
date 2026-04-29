<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Counts for dashboard
$stmt_courses = $pdo->query("SELECT COUNT(*) FROM courses");
$courses_count = $stmt_courses->fetchColumn();

$stmt_leads = $pdo->query("SELECT COUNT(*) FROM contact_leads");
$enquiries_count = $stmt_leads->fetchColumn();

$stmt_scholarships = $pdo->query("SELECT COUNT(*) FROM scholarship_forms");
$scholarships_count = $stmt_scholarships->fetchColumn();

$stmt_tests = $pdo->query("SELECT COUNT(*) FROM test_series");
$tests_count = $stmt_tests->fetchColumn();

$stmt_materials = $pdo->query("SELECT COUNT(*) FROM study_material");
$materials_count = $stmt_materials->fetchColumn();

$stmt_students = $pdo->query("SELECT COUNT(*) FROM scholarship_forms");
$students_count = $stmt_scholarships->fetchColumn();

// Fetch Recent Enquiries for the table
$stmt_recent = $pdo->query("SELECT * FROM contact_leads ORDER BY created_at DESC LIMIT 8");
$recent_enquiries = $stmt_recent->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'dashboard';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>DASHBOARD OVERVIEW</h4>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small fw-medium">SESSION : <b class="text-dark">ADMIN SECURE</b></span>
                    <div class="bg-success rounded-circle shadow-sm" style="width: 10px; height: 10px;"></div>
                </div>
            </header>
            
            <div class="row g-4 mb-5">
                <div class="col-xl-4 col-md-6">
                    <a href="view-enquiries.php" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="label text-primary">Total Enquiries</div>
                        <h2><?php echo $enquiries_count; ?></h2>
                        <div class="mt-2 small text-muted">ACTIVE STUDENT LEADS</div>
                    </div></a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="manage-courses.php" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="label text-success">Active Courses</div>
                        <h2><?php echo $courses_count; ?></h2>
                        <div class="mt-2 small text-muted">CURRICULUM MODULES</div>
                    </div></a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="view-scholarships.php" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="label text-warning">Scholarship Apps</div>
                        <h2><?php echo $scholarships_count; ?></h2>
                        <div class="mt-2 small text-muted">ESAT REGISTRATIONS</div>
                    </div></a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="manage-test-series.php" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="label text-info">Test Series</div>
                        <h2><?php echo $tests_count; ?></h2>
                        <div class="mt-2 small text-muted">DEPLOYED EXAM SETS</div>
                    </div></a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="manage-study-material.php" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="label text-secondary">Study Assets</div>
                        <h2><?php echo $materials_count; ?></h2>
                        <div class="mt-2 small text-muted">UPLOADED RESOURCES</div>
                    </div></a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="manage-scholarships.php" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="label text-danger">Scholarship Programs</div>
                        <h2><?php echo $scholarships_count; ?></h2>
                        <div class="mt-2 small text-muted">ACTIVE PROGRAMS</div>
                    </div></a>
                </div>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0"><i class="fas fa-history me-2 text-primary"></i> Recent Enquiries</h5>
                    <a href="view-enquiries.php" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All Enquiries</a>
                </div>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Contact Info</th>
                                <th>Inquiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($recent_enquiries): ?>
                                <?php foreach($recent_enquiries as $enq): ?>
                                <tr>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($enq['name']); ?></b></td>
                                    <td>
                                        <div class="small"><i class="fas fa-phone small me-1"></i> <?php echo htmlspecialchars($enq['phone']); ?></div>
                                        <div class="small text-muted truncated" style="max-width: 200px;"><?php echo htmlspecialchars($enq['message']); ?></div>
                                    </td>
                                    <td><span class="text-muted small"><?php echo date('M d, Y', strtotime($enq['created_at'])); ?></span></td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary border-primary border-opacity-25 border px-2 py-1">New</span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center py-5 text-muted font-monospace">No enquiries received yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
