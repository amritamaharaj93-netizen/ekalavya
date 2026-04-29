<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// FETCH SCHOLARSHIP APPLICATIONS (Using correct schema column names)
$stmt = $pdo->query("SELECT * FROM scholarship_forms ORDER BY created_at DESC");
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scholarship Applications | Eklavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'scholarships';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>SCHOLARSHIP APPLICATIONS</h4>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-warning text-dark rounded-pill px-3"><?php echo count($applications); ?> SUBMISSIONS</span>
                </div>
            </header>
            
            <div class="p-2">
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Contact Number</th>
                                <th>Submission Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($applications): ?>
                                <?php foreach($applications as $app): ?>
                                <tr>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($app['name']); ?></b></td>
                                    <td><span class="badge bg-light text-dark border px-3 py-1"><?php echo htmlspecialchars($app['class']); ?></span></td>
                                    <td><i class="fas fa-phone small me-2 text-muted"></i> <?php echo htmlspecialchars($app['phone']); ?></td>
                                    <td><span class="text-secondary small"><?php echo date('M d, Y', strtotime($app['created_at'])); ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center py-5 text-muted">No applications received yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 EKLAVYA ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
