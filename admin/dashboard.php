<?php
session_start();
require_once '../config/database.php';

// Check if logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Counts for dashboard
$stmt_courses = $pdo->query("SELECT COUNT(*) FROM courses");
$courses_count = $stmt_courses->fetchColumn();

$stmt_results = $pdo->query("SELECT COUNT(*) FROM results");
$results_count = $stmt_results->fetchColumn();

$stmt_leads = $pdo->query("SELECT COUNT(*) FROM contact_leads");
$leads_count = $stmt_leads->fetchColumn();

$stmt_scholarships = $pdo->query("SELECT COUNT(*) FROM scholarship_forms");
$scholarships_count = $stmt_scholarships->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Eklavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .sidebar { min-height: 100vh; background: #212121; padding-top: 2rem; }
        .sidebar .nav-link { color: #888; padding: 1rem 1.5rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.05); border-left: 3px solid var(--primary-color); }
        .content { background: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <div class="text-white text-center mb-5">
                    <h5 class="fw-bold">Eklavya Admin</h5>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="manage-courses.php"><i class="fas fa-book me-2"></i> Manage Courses</a>
                    <a class="nav-link" href="manage-results.php"><i class="fas fa-trophy me-2"></i> Manage Results</a>
                    <a class="nav-link" href="view-leads.php"><i class="fas fa-envelope-open-text me-2"></i> Contact Leads</a>
                    <a class="nav-link" href="view-scholarships.php"><i class="fas fa-graduation-cap me-2"></i> Scholarships</a>
                    <a class="nav-link mt-5" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-0 content">
                <header class="bg-white p-3 shadow-sm d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Dashboard Overview</h4>
                    <span class="text-secondary small"><i class="fas fa-user-circle me-1"></i> Hello, <?php echo $_SESSION['admin_username']; ?></span>
                </header>
                
                <div class="p-4">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <h2 class="mb-1 fw-bold text-primary"><?php echo $courses_count; ?></h2>
                                <p class="text-muted small mb-0">Courses Listed</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <h2 class="mb-1 fw-bold text-success"><?php echo $results_count; ?></h2>
                                <p class="text-muted small mb-0">Total Results</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <h2 class="mb-1 fw-bold text-info"><?php echo $leads_count; ?></h2>
                                <p class="text-muted small mb-0">Contact Leads</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <h2 class="mb-1 fw-bold text-warning"><?php echo $scholarships_count; ?></h2>
                                <p class="text-muted small mb-0">Scholarship Entries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
