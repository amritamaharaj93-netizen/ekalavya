<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// Set absolute/relative upload target directory
$target_dir = "../assets/images/";

// ADD IMAGE LOGIC
if (isset($_POST['add_image'])) {
    $title = trim($_POST['title']);
    $sort_order = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
    $image_name = "";

    if (!empty($title)) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_name = basename($_FILES['image']['name']);
            // Sanitize file name
            $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
            $target_file = $target_dir . $safe_file_name;
            
            // Allow overwriting or just moving
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_name = $safe_file_name;
            } else {
                $error_msg = "Failed to upload image file. Check directory write permissions.";
            }
        } else {
            // Fallback placeholder if no file uploaded but record requested
            $image_name = "scholar image1.png";
        }

        if (empty($error_msg)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO gallery_images (title, image, sort_order, status) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $image_name, $sort_order, $status]);
                $success_msg = "Gallery image published successfully!";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    } else {
        $error_msg = "Image title is required.";
    }
}

// EDIT IMAGE LOGIC
if (isset($_POST['edit_image'])) {
    $id = intval($_POST['image_id']);
    $title = trim($_POST['title']);
    $sort_order = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

    if (!empty($title)) {
        // Check if a new file is uploaded to overwrite
        $image_update_sql = "";
        $params = [$title, $sort_order, $status];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_name = basename($_FILES['image']['name']);
            $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
            $target_file = $target_dir . $safe_file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_update_sql = ", image=?";
                $params[] = $safe_file_name;
            } else {
                $error_msg = "Failed to upload new image file.";
            }
        }

        if (empty($error_msg)) {
            $params[] = $id;
            try {
                $stmt = $pdo->prepare("UPDATE gallery_images SET title=?, sort_order=?, status=? {$image_update_sql} WHERE id=?");
                $stmt->execute($params);
                $success_msg = "Gallery image updated successfully!";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    } else {
        $error_msg = "Image title is required.";
    }
}

// DELETE IMAGE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM gallery_images WHERE id = ?")->execute([$id]);
        header("Location: manage-gallery.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        $error_msg = "Database Error: " . $e->getMessage();
    }
}

// FETCH GALLERY IMAGES
$stmt = $pdo->query("SELECT * FROM gallery_images ORDER BY sort_order ASC, created_at DESC");
$images = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Gallery Images | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'gallery';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>GALLERY VISUALS</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addImageModal">
                    <i class="fas fa-plus me-2"></i> UPLOAD IMAGE
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ? $success_msg : "Image entry removed successfully!"; ?>
                    </div>
                <?php endif; ?>

                <?php if($error_msg): ?>
                    <div class="alert alert-danger bg-danger bg-opacity-10 border-0 text-danger rounded-4 mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i> <?php echo htmlspecialchars($error_msg); ?>
                    </div>
                <?php endif; ?>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Preview</th>
                                <th>Title / Visual Asset</th>
                                <th>File Reference</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($images): ?>
                                <?php foreach($images as $img): ?>
                                <tr>
                                    <td>
                                        <div class="rounded-3 overflow-hidden border border-light shadow-sm d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px;">
                                            <img src="../assets/images/<?php echo htmlspecialchars($img['image']); ?>" class="img-fluid w-100 h-100 object-fit-cover" alt="Thumbnail" onerror="this.src='../assets/images/logo.png'">
                                        </div>
                                    </td>
                                    <td>
                                        <b class="text-dark d-block"><?php echo htmlspecialchars($img['title']); ?></b>
                                        <span class="text-secondary small">ID: #<?php echo $img['id']; ?></span>
                                    </td>
                                    <td>
                                        <code class="text-primary bg-primary bg-opacity-10 px-2 py-1 rounded"><?php echo htmlspecialchars($img['image']); ?></code>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-1"><?php echo intval($img['sort_order']); ?></span>
                                    </td>
                                    <td>
                                        <?php if($img['status'] == 1): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">Visible</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1">Hidden</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editImageModal" 
                                            data-id="<?php echo $img['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($img['title']); ?>"
                                            data-image="<?php echo htmlspecialchars($img['image']); ?>"
                                            data-sort="<?php echo htmlspecialchars($img['sort_order']); ?>"
                                            data-status="<?php echo htmlspecialchars($img['status']); ?>"
                                            title="Edit Visual Asset">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete_id=<?php echo $img['id']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Permanently delete this visual record?')" title="Delete Image">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No images found in the gallery section. Use the upload button above to insert high-quality imagery.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <!-- Add Image Modal -->
    <div class="modal fade" id="addImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-gallery.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPLOAD GALLERY IMAGE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Visual Title / Caption</label>
                            <input type="text" class="form-control premium-input border" name="title" required placeholder="e.g. Annual Academic Excellence Day">
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Select Image Asset</label>
                            <input type="file" class="form-control premium-input border p-2" name="image" accept="image/*" required>
                            <small class="text-muted d-block mt-1 ms-2" style="font-size: 0.7rem;">Supported formats: JPG, PNG, WEBP, GIF. Standard hero or wide profile recommended.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Display Priority</label>
                                <input type="number" class="form-control premium-input border" name="sort_order" value="10" placeholder="e.g. 10">
                                <small class="text-muted d-block mt-1 ms-2" style="font-size: 0.7rem;">Lower values appear first.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Visibility Status</label>
                                <select class="form-select premium-input border" name="status">
                                    <option value="1">Active / Visible</option>
                                    <option value="0">Hidden / Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="add_image" class="btn btn-premium text-white px-4">PUBLISH ASSET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Image Modal -->
    <div class="modal fade" id="editImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-gallery.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="image_id" id="edit_image_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPDATE GALLERY ASSET</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Visual Title / Caption</label>
                            <input type="text" class="form-control premium-input border" name="title" id="edit_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Replace File Asset (Optional)</label>
                            <input type="file" class="form-control premium-input border p-2" name="image" accept="image/*">
                            <small class="text-muted d-block mt-1 ms-2" style="font-size: 0.7rem;">Current reference: <b id="current_image_ref" class="text-primary"></b>. Leave blank to keep existing image.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Display Priority</label>
                                <input type="number" class="form-control premium-input border" name="sort_order" id="edit_sort_order">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Visibility Status</label>
                                <select class="form-select premium-input border" name="status" id="edit_status">
                                    <option value="1">Active / Visible</option>
                                    <option value="0">Hidden / Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="edit_image" class="btn btn-premium text-white px-4">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editImageModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_image_id').value = button.getAttribute('data-id');
            document.getElementById('edit_title').value = button.getAttribute('data-title');
            document.getElementById('edit_sort_order').value = button.getAttribute('data-sort');
            document.getElementById('edit_status').value = button.getAttribute('data-status');
            document.getElementById('current_image_ref').innerText = button.getAttribute('data-image');
        });
    </script>
</body>
</html>
