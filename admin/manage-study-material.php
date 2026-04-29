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

// ADD STUDY MATERIAL LOGIC
if (isset($_POST['add_material'])) {
    $title = trim($_POST['title']);
    $type = trim($_POST['type']);
    $category = trim($_POST['category']);
    $slug = slugify($title);
    
    $target_dir = "../uploads/materials/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
    
    $file_name = time() . "_" . basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO study_material (title, slug, type, category, file_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $type, $category, $file_name]);
            $success_msg = "Material uploaded!";
        } catch (PDOException $e) { $error_msg = $e->getMessage(); }
    } else { $error_msg = "Upload failed."; }
}

// EDIT LOGIC
if (isset($_POST['edit_material'])) {
    $id = $_POST['material_id'];
    $title = trim($_POST['title']);
    $type = trim($_POST['type']);
    $category = trim($_POST['category']);
    $slug = slugify($title);

    try {
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            // Delete old file
            $stmt = $pdo->prepare("SELECT file_path FROM study_material WHERE id = ?");
            $stmt->execute([$id]);
            $old_file = $stmt->fetchColumn();
            if ($old_file && file_exists("../uploads/materials/" . $old_file)) {
                unlink("../uploads/materials/" . $old_file);
            }
            
            $file_name = time() . "_" . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/materials/" . $file_name);
            
            $stmt = $pdo->prepare("UPDATE study_material SET title=?, slug=?, type=?, category=?, file_path=? WHERE id=?");
            $stmt->execute([$title, $slug, $type, $category, $file_name, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE study_material SET title=?, slug=?, type=?, category=? WHERE id=?");
            $stmt->execute([$title, $slug, $type, $category, $id]);
        }
        $success_msg = "Asset details updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// DELETE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $stmt = $pdo->prepare("SELECT file_path FROM study_material WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $file_path = "../uploads/materials/" . $row['file_path'];
            if(file_exists($file_path)) { unlink($file_path); }
        }
        $pdo->prepare("DELETE FROM study_material WHERE id = ?")->execute([$id]);
        header("Location: manage-study-material.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = "Error deleting."; }
}

$stmt = $pdo->query("SELECT * FROM study_material ORDER BY created_at DESC");
$materials = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Study Assets | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'study_material';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>KNOWLEDGE ASSETS</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                    <i class="fas fa-upload me-2"></i> UPLOAD ASSET
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ?: "Asset removed."; ?>
                    </div>
                <?php endif; ?>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Asset Title</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($materials): ?>
                                <?php foreach($materials as $item): ?>
                                <tr>
                                    <td><span class="text-secondary small">#<?php echo $item['id']; ?></span></td>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($item['title']); ?></b></td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2"><?php echo htmlspecialchars($item['type']); ?></span></td>
                                    <td><span class="text-muted small"><?php echo htmlspecialchars($item['category']); ?></span></td>
                                    <td><a href="../uploads/materials/<?php echo $item['file_path']; ?>" target="_blank" class="btn btn-sm btn-link text-primary text-decoration-none small">View File</a></td>
                                    <td>
                                         <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#editMaterialModal" 
                                                 data-id="<?php echo $item['id']; ?>"
                                                 data-title="<?php echo htmlspecialchars($item['title']); ?>"
                                                 data-type="<?php echo htmlspecialchars($item['type']); ?>"
                                                 data-category="<?php echo htmlspecialchars($item['category']); ?>">
                                             <i class="fas fa-edit"></i>
                                         </button>
                                         <a href="?delete_id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Delete this asset?')"><i class="fas fa-trash"></i></a>
                                     </td>
                                 </tr>
                                 <?php endforeach; ?>
                            <?php else: ?>
                                 <tr><td colspan="6" class="text-center py-5 text-muted">No knowledge assets uploaded yet.</td></tr>
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

    <!-- Add Material Modal -->
    <div class="modal fade" id="addMaterialModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-study-material.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">UPLOAD NEW ASSET</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Asset Title</label>
                            <input type="text" class="form-control premium-input border" name="title" required placeholder="e.g. Physics Formula Sheet">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Type</label>
                                <select class="form-select premium-input border" name="type" required>
                                    <option value="PDF">PDF</option>
                                    <option value="Notes">Notes</option>
                                    <option value="Assignment">Assignment</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <input type="text" class="form-control premium-input border" name="category" placeholder="e.g. Class 12 Phys">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Upload Source</label>
                            <input type="file" class="form-control premium-input border" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="add_material" class="btn btn-premium text-white w-100 py-3">INDEX ASSET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Material Modal -->
    <div class="modal fade" id="editMaterialModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-study-material.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="material_id" id="edit_material_id">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">UPDATE ASSET</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Asset Title</label>
                            <input type="text" class="form-control premium-input border" name="title" id="edit_title" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Type</label>
                                <select class="form-select premium-input border" name="type" id="edit_type" required>
                                    <option value="PDF">PDF</option>
                                    <option value="Notes">Notes</option>
                                    <option value="Assignment">Assignment</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <input type="text" class="form-control premium-input border" name="category" id="edit_category">
                            </div>
                        </div>
                        <div class="mt-3 border-top pt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Replace File (Optional)</label>
                            <input type="file" class="form-control premium-input border" name="file">
                            <small class="text-muted ms-2 mt-1 d-block" style="font-size: 0.75rem;">Leave empty to keep the existing document.</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="edit_material" class="btn btn-premium text-white w-100 py-3">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editMaterialModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_material_id').value = button.getAttribute('data-id');
            document.getElementById('edit_title').value = button.getAttribute('data-title');
            document.getElementById('edit_type').value = button.getAttribute('data-type');
            document.getElementById('edit_category').value = button.getAttribute('data-category');
        });
    </script>
</body>
</html>
