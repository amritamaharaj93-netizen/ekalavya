<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// DELETE SCHOLARSHIP LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $stmt = $pdo->prepare("DELETE FROM scholarship_forms WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: view-scholarships.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        $error_msg = "Error deleting record: " . $e->getMessage();
    }
}

// FETCH SCHOLARSHIPS
$stmt = $pdo->query("SELECT * FROM scholarship_forms ORDER BY created_at DESC");
$scholarships = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Scholarships | Eklavya Admin</title>
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
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="manage-courses.php"><i class="fas fa-book me-2"></i> Manage Courses</a>
                    <a class="nav-link" href="manage-results.php"><i class="fas fa-trophy me-2"></i> Manage Results</a>
                    <a class="nav-link" href="view-leads.php"><i class="fas fa-envelope-open-text me-2"></i> Contact Leads</a>
                    <a class="nav-link active" href="view-scholarships.php"><i class="fas fa-graduation-cap me-2"></i> Scholarships</a>
                    <a class="nav-link mt-5" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-0 content">
                <header class="bg-white p-3 shadow-sm">
                    <h4 class="mb-0">Scholarship Registrations</h4>
                </header>
                
                <div class="p-4">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Phone</th>
                                    <th>Class / Target</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($scholarships): ?>
                                    <?php foreach($scholarships as $form): ?>
                                    <tr>
                                        <td><?php echo $form['id']; ?></td>
                                        <td><?php echo htmlspecialchars($form['name']); ?></td>
                                        <td><?php echo htmlspecialchars($form['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($form['class']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($form['created_at'])); ?></td>
                                        <td>
                                            <a href="?delete_id=<?php echo $form['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center py-4">No scholarship entries found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
