<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

$target_dir = "../assets/images/";

// ADD CAMPUS IMAGE LOGIC
if (isset($_POST['add_campus_image'])) {
    $alt_text = trim($_POST['alt_text']);
    if (empty($alt_text)) $alt_text = "Campus Gallery Showcase";
    $sort_order = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
    $image_name = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = basename($_FILES['image']['name']);
        $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
        $target_file = $target_dir . $safe_file_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_name = $safe_file_name;
        } else {
            $error_msg = "Failed to upload file asset. Check write permissions.";
        }
    } else {
        $error_msg = "Please select a valid image file to upload.";
    }

    if (empty($error_msg) && !empty($image_name)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO campus_images (image, alt_text, sort_order, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$image_name, $alt_text, $sort_order, $status]);
            $success_msg = "Campus marquee image published successfully!";
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    }
}

// EDIT CAMPUS IMAGE LOGIC
if (isset($_POST['edit_campus_image'])) {
    $id = intval($_POST['image_id']);
    $alt_text = trim($_POST['alt_text']);
    if (empty($alt_text)) $alt_text = "Campus Gallery Showcase";
    $sort_order = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

    $image_update_sql = "";
    $params = [$alt_text, $sort_order, $status];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = basename($_FILES['image']['name']);
        $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
        $target_file = $target_dir . $safe_file_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_update_sql = ", image=?";
            $params[] = $safe_file_name;
        } else {
            $error_msg = "Failed to upload new replacement image file.";
        }
    }

    if (empty($error_msg)) {
        $params[] = $id;
        try {
            $stmt = $pdo->prepare("UPDATE campus_images SET alt_text=?, sort_order=?, status=? {$image_update_sql} WHERE id=?");
            $stmt->execute($params);
            $success_msg = "Campus marquee asset updated successfully!";
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    }
}

// DELETE CAMPUS IMAGE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM campus_images WHERE id = ?")->execute([$id]);
        header("Location: manage-campus-images.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        $error_msg = "Database Error: " . $e->getMessage();
    }
}

// FETCH CAMPUS IMAGES
$stmt = $pdo->query("SELECT * FROM campus_images ORDER BY sort_order ASC, created_at DESC");
$campus_images = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Campus Marquee Images | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'campus_images';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <div>
                    <h4>CAMPUS GALLERY MARQUEE</h4>
                    <small class="text-muted">Manage the continuous looping carousel on the main landing page</small>
                </div>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addCampusImageModal">
                    <i class="fas fa-plus me-2"></i> UPLOAD CAMPUS ASSET
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ? $success_msg : "Asset removed from continuous scrolling track successfully!"; ?>
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
                                <th style="width: 90px;">Portrait Preview</th>
                                <th>File Asset String</th>
                                <th>Alt Caption Text</th>
                                <th>Loop Sort Order</th>
                                <th>Visibility Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($campus_images): ?>
                                <?php foreach($campus_images as $img): ?>
                                <tr>
                                    <td>
                                        <div class="rounded-3 overflow-hidden border shadow-sm d-flex align-items-center justify-content-center bg-light" style="width: 50px; height: 70px;">
                                            <img src="../assets/images/<?php echo htmlspecialchars($img['image']); ?>" class="img-fluid w-100 h-100 object-fit-cover" alt="Preview" onerror="this.src='../assets/images/logo.png'">
                                        </div>
                                    </td>
                                    <td>
                                        <b class="text-dark d-block"><?php echo htmlspecialchars($img['image']); ?></b>
                                        <span class="text-secondary small">ID: #<?php echo $img['id']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-secondary"><?php echo htmlspecialchars($img['alt_text']); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-1"><?php echo intval($img['sort_order']); ?></span>
                                    </td>
                                    <td>
                                        <?php if($img['status'] == 1): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">Active Loop</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1">Disabled</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editCampusImageModal" 
                                            data-id="<?php echo $img['id']; ?>"
                                            data-image="<?php echo htmlspecialchars($img['image']); ?>"
                                            data-alt="<?php echo htmlspecialchars($img['alt_text']); ?>"
                                            data-sort="<?php echo htmlspecialchars($img['sort_order']); ?>"
                                            data-status="<?php echo htmlspecialchars($img['status']); ?>"
                                            title="Edit Loop Asset">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete_id=<?php echo $img['id']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Remove this specific asset from the continuous campus carousel?')" title="Delete Asset">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No images currently designated for the campus marquee slider. Upload assets to start scrolling display.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <!-- Add Campus Image Modal -->
    <div class="modal fade" id="addCampusImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-campus-images.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPLOAD CAMPUS MARQUEE ASSET</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Select File Asset</label>
                            <input type="file" class="form-control premium-input border p-2" name="image" accept="image/*" required>
                            <small class="text-muted d-block mt-1 ms-2" style="font-size: 0.7rem;">Portrait layout aspect ratio highly recommended for vertical alignment consistency.</small>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Alt Caption Text</label>
                            <input type="text" class="form-control premium-input border" name="alt_text" placeholder="e.g. Life at Ekalavya Campus">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Loop Priority</label>
                                <input type="number" class="form-control premium-input border" name="sort_order" value="10" placeholder="e.g. 10">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Looping Status</label>
                                <select class="form-select premium-input border" name="status">
                                    <option value="1">Active in Marquee</option>
                                    <option value="0">Hidden / Excluded</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="add_campus_image" class="btn btn-premium text-white px-4">PUBLISH ASSET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Campus Image Modal -->
    <div class="modal fade" id="editCampusImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-campus-images.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="image_id" id="edit_campus_image_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPDATE CAMPUS MARQUEE ASSET</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Replace File Asset (Optional)</label>
                            <input type="file" class="form-control premium-input border p-2" name="image" accept="image/*">
                            <small class="text-muted d-block mt-1 ms-2" style="font-size: 0.7rem;">Active file string: <b id="current_campus_img_ref" class="text-primary"></b></small>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Alt Caption Text</label>
                            <input type="text" class="form-control premium-input border" name="alt_text" id="edit_alt_text">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Loop Priority</label>
                                <input type="number" class="form-control premium-input border" name="sort_order" id="edit_sort_order">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Looping Status</label>
                                <select class="form-select premium-input border" name="status" id="edit_status">
                                    <option value="1">Active in Marquee</option>
                                    <option value="0">Hidden / Excluded</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="edit_campus_image" class="btn btn-premium text-white px-4">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editCampusImageModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_campus_image_id').value = button.getAttribute('data-id');
            document.getElementById('edit_alt_text').value = button.getAttribute('data-alt');
            document.getElementById('edit_sort_order').value = button.getAttribute('data-sort');
            document.getElementById('edit_status').value = button.getAttribute('data-status');
            document.getElementById('current_campus_img_ref').innerText = button.getAttribute('data-image');
        });
    </script>
</body>
</html>
