<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// ADD RESULT LOGIC (With Image Upload)
if (isset($_POST['add_result'])) {
    $name = trim($_POST['name']);
    $percentile = trim($_POST['percentile']);
    $course = trim($_POST['course']);
    
    // File upload
    $target_dir = "../uploads/results/";
    $image_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error_msg = "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO results (name, image, percentile, course) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $image_name, $percentile, $course]);
                $success_msg = "Result added successfully!";
            } catch (PDOException $e) {
                $error_msg = "Database error: " . $e->getMessage();
            }
        } else {
            $error_msg = "Sorry, there was an error uploading your file.";
        }
    }
}

// DELETE RESULT LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        // Fetch image path to delete it from storage
        $stmt = $pdo->prepare("SELECT image FROM results WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $img_path = "../uploads/results/" . $row['image'];
            if(file_exists($img_path)) {
                unlink($img_path);
            }
        }
        
        $stmt = $pdo->prepare("DELETE FROM results WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: manage-results.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        $error_msg = "Error deleting result: " . $e->getMessage();
    }
}

// FETCH RESULTS
$stmt = $pdo->query("SELECT * FROM results ORDER BY created_at DESC");
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Results | Eklavya Admin</title>
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
                    <a class="nav-link active" href="manage-results.php"><i class="fas fa-trophy me-2"></i> Manage Results</a>
                    <a class="nav-link" href="view-leads.php"><i class="fas fa-envelope-open-text me-2"></i> Contact Leads</a>
                    <a class="nav-link" href="view-scholarships.php"><i class="fas fa-graduation-cap me-2"></i> Scholarships</a>
                    <a class="nav-link mt-5" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-0 content">
                <header class="bg-white p-3 shadow-sm d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Results</h4>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addResultModal"><i class="fas fa-plus me-2"></i> Add Student Result</button>
                </header>
                
                <div class="p-4">
                    <?php if($success_msg || isset($_GET['deleted'])): ?>
                        <div class="alert alert-success"><?php echo $success_msg ? $success_msg : "Result deleted successfully!"; ?></div>
                    <?php endif; ?>
                    <?php if($error_msg): ?>
                        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                    <?php endif; ?>
                    
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php if($results): ?>
                            <?php foreach($results as $res): ?>
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm text-center p-3">
                                    <img src="../uploads/results/<?php echo $res['image']; ?>" class="rounded mx-auto mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                                    <h6><?php echo htmlspecialchars($res['name']); ?></h6>
                                    <p class="text-primary fw-bold small mb-1"><?php echo htmlspecialchars($res['percentile']); ?></p>
                                    <p class="text-muted small mb-3"><?php echo htmlspecialchars($res['course']); ?></p>
                                    <a href="?delete_id=<?php echo $res['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this result?')"><i class="fas fa-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12"><div class="alert alert-info">No student results added yet.</div></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Result Modal -->
    <div class="modal fade" id="addResultModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage-results.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Student Result</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="Full Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Percentile / Score</label>
                            <input type="text" class="form-control" name="percentile" required placeholder="e.g. 99.5 Percentile or 700/720">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course / Field</label>
                            <input type="text" class="form-control" name="course" required placeholder="e.g. IIT-JEE (Advanced)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Student Image</label>
                            <input type="file" class="form-control" name="image" required accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_result" class="btn btn-primary">Save Result</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
