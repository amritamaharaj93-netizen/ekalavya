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
    if (empty($text)) return 'n-a';
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}

// ADD PROGRAM LOGIC
if (isset($_POST['add_program'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $eligibility = trim($_POST['eligibility']);
    $deadline = trim($_POST['deadline']);
    $slug = slugify($title);

    if (!empty($title)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO scholarship_programs (title, slug, description, eligibility, deadline) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $description, $eligibility, $deadline]);
            $success_msg = "Program added successfully!";
        } catch (PDOException $e) { $error_msg = $e->getMessage(); }
    } else { $error_msg = "Title is required."; }
}

// EDIT PROGRAM LOGIC
if (isset($_POST['edit_program'])) {
    $id = $_POST['program_id'];
    $title = trim($_POST['title']);
    $slug = slugify($title);
    $description = trim($_POST['description']);
    $eligibility = trim($_POST['eligibility']);
    $deadline = trim($_POST['deadline']);

    try {
        $stmt = $pdo->prepare("UPDATE scholarship_programs SET title=?, slug=?, description=?, eligibility=?, deadline=? WHERE id=?");
        $stmt->execute([$title, $slug, $description, $eligibility, $deadline, $id]);
        $success_msg = "Program updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// DELETE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM scholarship_programs WHERE id = ?")->execute([$id]);
        header("Location: manage-scholarships.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = "Error deleting."; }
}

$stmt = $pdo->query("SELECT * FROM scholarship_programs ORDER BY created_at DESC");
$programs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Scholarships | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'scholarship_programs';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>SCHOLARSHIP ECOSYSTEM</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addProgramModal">
                    <i class="fas fa-award me-2"></i> NEW PROGRAM
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ?: "Program removed."; ?>
                    </div>
                <?php endif; ?>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Program Title</th>
                                <th>Eligibility</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($programs): ?>
                                <?php foreach($programs as $prog): ?>
                                <tr>
                                    <td><span class="text-secondary small">#<?php echo $prog['id']; ?></span></td>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($prog['title']); ?></b></td>
                                    <td><span class="text-muted small"><?php echo htmlspecialchars($prog['eligibility']); ?></span></td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2"><?php echo htmlspecialchars($prog['deadline']); ?></span></td>
                                    <td>
                                         <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#editProgramModal" 
                                                 data-id="<?php echo $prog['id']; ?>"
                                                 data-title="<?php echo htmlspecialchars($prog['title']); ?>"
                                                 data-eligibility="<?php echo htmlspecialchars($prog['eligibility']); ?>"
                                                 data-deadline="<?php echo htmlspecialchars($prog['deadline']); ?>"
                                                 data-description="<?php echo htmlspecialchars($prog['description']); ?>">
                                             <i class="fas fa-edit"></i>
                                         </button>
                                         <a href="?delete_id=<?php echo $prog['id']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Delete this program?')"><i class="fas fa-trash"></i></a>
                                     </td>
                                 </tr>
                                 <?php endforeach; ?>
                            <?php else: ?>
                                 <tr><td colspan="5" class="text-center py-5 text-muted">No active programs found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="mt-5 pt-4 text-center text-muted small">
                &copy; <?php echo date('Y'); ?> Ekalavya ACADEMY.
            </footer>
        </div>
    </div>

    <!-- Add Program Modal -->
    <div class="modal fade" id="addProgramModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-scholarships.php" method="POST">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">CREATE SCHOLARSHIP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Program Title</label>
                            <input type="text" class="form-control premium-input border" name="title" required placeholder="e.g. Merit-cum-Means '25">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Eligibility</label>
                                <input type="text" class="form-control premium-input border" name="eligibility" placeholder="e.g. 90%+ in 10th">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Deadline</label>
                                <input type="text" class="form-control premium-input border" name="deadline" placeholder="e.g. Oct 2024">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Program Description</label>
                            <textarea class="form-control premium-input border" name="description" rows="3" placeholder="Details about the scholarship..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="add_program" class="btn btn-premium text-white w-100 py-3">PUBLISH PROGRAM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Program Modal -->
    <div class="modal fade" id="editProgramModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-scholarships.php" method="POST">
                    <input type="hidden" name="program_id" id="edit_program_id">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">UPDATE SCHOLARSHIP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Program Title</label>
                            <input type="text" class="form-control premium-input border" name="title" id="edit_title" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Eligibility</label>
                                <input type="text" class="form-control premium-input border" name="eligibility" id="edit_eligibility">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Deadline</label>
                                <input type="text" class="form-control premium-input border" name="deadline" id="edit_deadline">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Program Description</label>
                            <textarea class="form-control premium-input border" name="description" id="edit_description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="edit_program" class="btn btn-premium text-white w-100 py-3">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editProgramModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_program_id').value = button.getAttribute('data-id');
            document.getElementById('edit_title').value = button.getAttribute('data-title');
            document.getElementById('edit_eligibility').value = button.getAttribute('data-eligibility');
            document.getElementById('edit_deadline').value = button.getAttribute('data-deadline');
            document.getElementById('edit_description').value = button.getAttribute('data-description');
        });
    </script>
</body>
</html>
