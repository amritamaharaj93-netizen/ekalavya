<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// Course Addition Logic
if (isset($_POST['add_course'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $duration = trim($_POST['duration']);
    $description = trim($_POST['description']);

    if (!empty($title) && !empty($category) && !empty($duration) && !empty($description)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO courses (title, category, duration, description) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $category, $duration, $description]);
            $success_msg = "Course added successfully!";
        } catch (PDOException $e) {
            $error_msg = "Error adding course: " . $e->getMessage();
        }
    } else {
        $error_msg = "All fields are required.";
    }
}

// DELETE COURSE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: manage-courses.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        $error_msg = "Error deleting course: " . $e->getMessage();
    }
}

// FETCH COURSES
$stmt = $pdo->query("SELECT * FROM courses ORDER BY created_at DESC");
$courses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Courses | Eklavya Admin</title>
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
                    <a class="nav-link active" href="manage-courses.php"><i class="fas fa-book me-2"></i> Manage Courses</a>
                    <a class="nav-link" href="manage-results.php"><i class="fas fa-trophy me-2"></i> Manage Results</a>
                    <a class="nav-link" href="view-leads.php"><i class="fas fa-envelope-open-text me-2"></i> Contact Leads</a>
                    <a class="nav-link" href="view-scholarships.php"><i class="fas fa-graduation-cap me-2"></i> Scholarships</a>
                    <a class="nav-link mt-5" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-0 content">
                <header class="bg-white p-3 shadow-sm d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Courses</h4>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal"><i class="fas fa-plus me-2"></i> Add New Course</button>
                </header>
                
                <div class="p-4">
                    <?php if($success_msg || isset($_GET['deleted'])): ?>
                        <div class="alert alert-success"><?php echo $success_msg ? $success_msg : "Course deleted successfully!"; ?></div>
                    <?php endif; ?>
                    
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($courses): ?>
                                    <?php foreach($courses as $course): ?>
                                    <tr>
                                        <td><?php echo $course['id']; ?></td>
                                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                                        <td><?php echo htmlspecialchars($course['category']); ?></td>
                                        <td><?php echo htmlspecialchars($course['duration']); ?></td>
                                        <td>
                                            <a href="?delete_id=<?php echo $course['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-4">No courses found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage-courses.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Course Title</label>
                            <input type="text" class="form-control" name="title" required placeholder="e.g. IIT-JEE Advance Program">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="Medical">Medical</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Foundation">Foundation</option>
                                <option value="Boards">Boards</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" class="form-control" name="duration" required placeholder="e.g. 1 Year / 2 Years">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4" required placeholder="Enter course details..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
