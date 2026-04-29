<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// FETCH ENQUIRIES
$stmt = $pdo->query("SELECT * FROM contact_leads ORDER BY created_at DESC");
$enquiries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enquiries Library | Eklavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'leads';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>STUDENT ENQUIRIES</h4>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary rounded-pill px-3"><?php echo count($enquiries); ?> TOTAL</span>
                </div>
            </header>
            
            <div class="p-2">
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Contact Number</th>
                                <th>Message / Requirement</th>
                                <th>Date Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($enquiries): ?>
                                <?php foreach($enquiries as $enq): ?>
                                <tr>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($enq['name']); ?></b></td>
                                    <td><i class="fas fa-phone small me-2 text-muted"></i> <?php echo htmlspecialchars($enq['phone']); ?></td>
                                    <td><div class="small text-muted" style="max-width: 300px;"><?php echo htmlspecialchars($enq['message']); ?></div></td>
                                    <td><span class="text-secondary small"><?php echo date('M d, Y', strtotime($enq['created_at'])); ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center py-5 text-muted">No student enquiries found.</td></tr>
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
