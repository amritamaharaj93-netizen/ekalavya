<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// slugify function
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}

// Course Addition Logic
if (isset($_POST['add_course'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $duration = trim($_POST['duration']);
    $description = trim($_POST['description']);
    $target_year = trim($_POST['target_year'] ?? '');
    $fees = !empty($_POST['fees']) ? floatval($_POST['fees']) : null;
    $slug = slugify($title);

    if (!empty($title) && !empty($category) && !empty($duration) && !empty($description)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO courses (title, slug, category, duration, description, admission_eligibility, fee_includes, target_year, fees) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $category, $duration, $description, $_POST['admission_eligibility'], $_POST['fee_includes'], $target_year, $fees]);
            $success_msg = "Course published successfully!";
        } catch (PDOException $e) { $error_msg = "Error: " . $e->getMessage(); }
    } else { $error_msg = "All required fields must be filled."; }
}

// UPDATE COURSE LOGIC
if (isset($_POST['edit_course'])) {
    $id = $_POST['course_id'];
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $duration = trim($_POST['duration']);
    $description = trim($_POST['description']);
    $target_year = trim($_POST['target_year'] ?? '');
    $fees = !empty($_POST['fees']) ? floatval($_POST['fees']) : null;
    $slug = slugify($title);

    try {
        $stmt = $pdo->prepare("UPDATE courses SET title=?, slug=?, category=?, duration=?, description=?, admission_eligibility=?, fee_includes=?, target_year=?, fees=? WHERE id=?");
        $stmt->execute([$title, $slug, $category, $duration, $description, $_POST['admission_eligibility'], $_POST['fee_includes'], $target_year, $fees, $id]);
        $success_msg = "Course updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// DELETE COURSE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM courses WHERE id = ?")->execute([$id]);
        header("Location: manage-courses.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// FETCH COURSES
$stmt = $pdo->query("SELECT * FROM courses ORDER BY created_at DESC");
$courses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Courses | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'courses';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>COURSE ECOSYSTEM</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    <i class="fas fa-plus me-2"></i> NEW COURSE
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ? $success_msg : "Course deleted successfully!"; ?>
                    </div>
                <?php endif; ?>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course Title</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($courses): ?>
                                <?php foreach($courses as $course): ?>
                                <tr>
                                    <td><span class="text-secondary small">#<?php echo $course['id']; ?></span></td>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($course['title']); ?></b></td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2"><?php echo htmlspecialchars($course['category']); ?></span></td>
                                    <td><i class="far fa-clock me-2 text-muted"></i> <?php echo htmlspecialchars($course['duration']); ?></td>
                                    <td>
                                         <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#editCourseModal" 
                                         data-id="<?php echo $course['id']; ?>"
                                         data-title="<?php echo htmlspecialchars($course['title']); ?>"
                                         data-category="<?php echo htmlspecialchars($course['category']); ?>"
                                         data-duration="<?php echo htmlspecialchars($course['duration']); ?>"
                                         data-description="<?php echo htmlspecialchars($course['description']); ?>"
                                         data-target_year="<?php echo htmlspecialchars($course['target_year'] ?? ''); ?>"
                                         data-fees="<?php echo htmlspecialchars($course['fees'] ?? ''); ?>"
                                         data-admission_eligibility="<?php echo htmlspecialchars($course['admission_eligibility'] ?? ''); ?>"
                                         data-fee_includes="<?php echo htmlspecialchars($course['fee_includes'] ?? ''); ?>">
                                     <i class="fas fa-edit"></i>
                                 </button>
                                         <a href="edit-course-detail.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-info border-0 rounded-circle me-2" title="Design Course Detail">
                                             <i class="fas fa-paint-brush"></i>
                                         </a>
                                         <a href="?delete_id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Delete this course?')"><i class="fas fa-trash"></i></a>
                                     </td>
                                 </tr>
                                 <?php endforeach; ?>
                            <?php else: ?>
                                 <tr><td colspan="5" class="text-center py-5 text-muted">No courses found in the ecosystem.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-courses.php" method="POST">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">CREATE NEW COURSE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Course Title</label>
                            <input type="text" class="form-control premium-input border" name="title" required placeholder="e.g. IIT-JEE Advance Program">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <select class="form-select premium-input border" name="category" required>
                                    <option value="NEET">NEET (Medical)</option>
                                    <option value="IIT-JEE">IIT-JEE (Engineering)</option>
                                    <option value="School Prep (Class 7th-12th)">School Prep (Class 7th-12th) (Class 7-10)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Duration</label>
                                <input type="text" class="form-control premium-input border" name="duration" required placeholder="e.g. 1 Year">
                            </div>
                        </div>
                        <div class="row g-3 mt-0">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Target Year</label>
                                <input type="text" class="form-control premium-input border" name="target_year" placeholder="e.g. 2027">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Fees (&#x20B9;)</label>
                                <input type="number" step="0.01" class="form-control premium-input border" name="fees" placeholder="e.g. 85000">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Bio / Description</label>
                            <textarea class="form-control premium-input border" name="description" rows="2" required placeholder="Enter course details..."></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Admission Eligibility</label>
                            <input type="text" class="form-control premium-input border" name="admission_eligibility" placeholder="e.g. Through Admission Test">
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Fee Includes</label>
                            <textarea class="form-control premium-input border" name="fee_includes" rows="2" placeholder="e.g. Study Material, Uniform"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="add_course" class="btn btn-premium text-white px-4">PUBLISH COURSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-courses.php" method="POST">
                    <input type="hidden" name="course_id" id="edit_course_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPDATE COURSE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Course Title</label>
                            <input type="text" class="form-control premium-input border" name="title" id="edit_title" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <select class="form-select premium-input border" name="category" id="edit_category" required>
                                    <option value="NEET">NEET (Medical)</option>
                                    <option value="IIT-JEE">IIT-JEE (Engineering)</option>
                                    <option value="School Prep (Class 7th-12th)">School Prep (Class 7th-12th) (Class 7-10)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Duration</label>
                                <input type="text" class="form-control premium-input border" name="duration" id="edit_duration" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-0">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Target Year</label>
                                <input type="text" class="form-control premium-input border" name="target_year" id="edit_target_year" placeholder="e.g. 2027">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Fees (&#x20B9;)</label>
                                <input type="number" step="0.01" class="form-control premium-input border" name="fees" id="edit_fees" placeholder="e.g. 85000">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Bio / Description</label>
                            <textarea class="form-control premium-input border" name="description" id="edit_description" rows="2" required></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Admission Eligibility</label>
                            <input type="text" class="form-control premium-input border" name="admission_eligibility" id="edit_admission_eligibility">
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Fee Includes</label>
                            <textarea class="form-control premium-input border" name="fee_includes" id="edit_fee_includes" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="edit_course" class="btn btn-premium text-white px-4">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editCourseModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_course_id').value = button.getAttribute('data-id');
            document.getElementById('edit_title').value = button.getAttribute('data-title');
            document.getElementById('edit_category').value = button.getAttribute('data-category');
            document.getElementById('edit_duration').value = button.getAttribute('data-duration');
            document.getElementById('edit_description').value = button.getAttribute('data-description');
            document.getElementById('edit_target_year').value = button.getAttribute('data-target_year') || '';
            document.getElementById('edit_fees').value = button.getAttribute('data-fees') || '';
            document.getElementById('edit_admission_eligibility').value = button.getAttribute('data-admission_eligibility') || '';
            document.getElementById('edit_fee_includes').value = button.getAttribute('data-fee_includes') || '';
        });
    </script>
</body>
</html>
