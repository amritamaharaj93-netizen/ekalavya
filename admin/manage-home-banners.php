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

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        // fetch image to delete file if it's not used by others
        $stmt = $pdo->prepare("SELECT image FROM home_banners WHERE id=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $stmt = $pdo->prepare("DELETE FROM home_banners WHERE id=?");
            $stmt->execute([$id]);
            $success_msg = "Banner deleted successfully!";
        }
    } catch (PDOException $e) {
        $error_msg = "Error deleting: " . $e->getMessage();
    }
}

// Handle Add/Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = $_POST['section'];
    $link = $_POST['link'] ?? '';
    $display_order = $_POST['display_order'] ?? 0;
    $status = $_POST['status'] ?? 0;

    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_name = basename($_FILES['image']['name']);
            $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
            $target_file = $target_dir . $safe_file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO home_banners (section, image, link, display_order, status) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$section, $safe_file_name, $link, $display_order, $status]);
                    $success_msg = "Banner added successfully!";
                } catch (PDOException $e) {
                    $error_msg = "Database Error: " . $e->getMessage();
                }
            } else {
                $error_msg = "Failed to upload image.";
            }
        } else {
            $error_msg = "Please select an image.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
        $id = $_POST['id'];
        $image_query = "";
        $params = [$link, $display_order, $status];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_name = basename($_FILES['image']['name']);
            $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
            $target_file = $target_dir . $safe_file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_query = ", image=?";
                $params[] = $safe_file_name;
            } else {
                $error_msg = "Failed to upload image.";
            }
        }
        
        if (empty($error_msg)) {
            $params[] = $id;
            try {
                $stmt = $pdo->prepare("UPDATE home_banners SET link=?, display_order=?, status=? $image_query WHERE id=?");
                $stmt->execute($params);
                $success_msg = "Banner updated successfully!";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    }
}

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
if (isset($_GET['delete_campus_id'])) {
    $id = intval($_GET['delete_campus_id']);
    try {
        $pdo->prepare("DELETE FROM campus_images WHERE id = ?")->execute([$id]);
        $success_msg = "Asset removed from continuous scrolling track successfully!";
    } catch (PDOException $e) {
        $error_msg = "Database Error: " . $e->getMessage();
    }
}

// Fetch Banners
$hero_banners = $pdo->query("SELECT * FROM home_banners WHERE section='hero' ORDER BY display_order ASC")->fetchAll();
$form_banners = $pdo->query("SELECT * FROM home_banners WHERE section='form' ORDER BY display_order ASC")->fetchAll();
$campus_images = $pdo->query("SELECT * FROM campus_images ORDER BY sort_order ASC, created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Home Settings | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon_new.png">
</head>
<body>
    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'home_settings';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>HOME SETTINGS MODULE</h4>
                    <small class="text-muted">Manage homepage Hero Sliders and Form Sliders dynamically.</small>
                </div>
            </header>
            
            <div class="p-4">
                <?php if($success_msg): ?>
                    <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i> <?php echo $success_msg; ?></div>
                <?php endif; ?>
                <?php if($error_msg): ?>
                    <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i> <?php echo htmlspecialchars($error_msg); ?></div>
                <?php endif; ?>

                <!-- HERO SLIDERS CARD -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold m-0 text-primary">Hero Banners</h5>
                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal" onclick="document.getElementById('section_type').value='hero'"><i class="fas fa-plus"></i> Add Hero Image</button>
                        </div>
                        <div class="table-responsive border rounded-3">
                            <table class="table table-hover bg-white m-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($hero_banners as $b): ?>
                                    <tr>
                                        <td><img src="../assets/images/<?php echo htmlspecialchars($b['image']); ?>" height="50" style="object-fit:cover; border-radius:4px;"></td>
                                        <td><?php echo htmlspecialchars($b['link']); ?></td>
                                        <td><?php echo $b['display_order']; ?></td>
                                        <td>
                                            <?php if($b['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                            onclick="fillEditModal(<?php echo $b['id']; ?>, '<?php echo $b['link']; ?>', <?php echo $b['display_order']; ?>, <?php echo $b['status']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="manage-home-banners.php?delete=<?php echo $b['id']; ?>" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Delete this banner?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- FORM SLIDERS CARD -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold m-0 text-primary">Book Free Session Banners</h5>
                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal" onclick="document.getElementById('section_type').value='form'"><i class="fas fa-plus"></i> Add Form Image</button>
                        </div>
                        <div class="table-responsive border rounded-3">
                            <table class="table table-hover bg-white m-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($form_banners as $b): ?>
                                    <tr>
                                        <td><img src="../assets/images/<?php echo htmlspecialchars($b['image']); ?>" height="50" style="object-fit:cover; border-radius:4px;"></td>
                                        <td><?php echo $b['display_order']; ?></td>
                                        <td>
                                            <?php if($b['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                            onclick="fillEditModal(<?php echo $b['id']; ?>, '', <?php echo $b['display_order']; ?>, <?php echo $b['status']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="manage-home-banners.php?delete=<?php echo $b['id']; ?>" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Delete this banner?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- CAMPUS GALLERY MARQUEE CARD -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold m-0 text-primary">CAMPUS GALLERY MARQUEE</h5>
                                <small class="text-muted">Manage the continuous looping carousel on the main landing page</small>
                            </div>
                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCampusImageModal"><i class="fas fa-plus"></i> UPLOAD CAMPUS ASSET</button>
                        </div>
                        <div class="table-responsive border rounded-3">
                            <table class="table table-hover bg-white m-0">
                                <thead class="table-light">
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
                                                <button class="btn btn-sm btn-info text-white shadow-sm" 
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
                                                <a href="manage-home-banners.php?delete_campus_id=<?php echo $img['id']; ?>" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Remove this specific asset from the continuous campus carousel?')" title="Delete Asset">
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
                </div>

            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="manage-home-banners.php" method="POST" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="section" id="section_type" value="hero">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Upload Banner Image *</label>
                        <input type="file" class="form-control p-2 bg-light border text-muted" name="image" required accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">URL Link (Optional, mostly for Hero)</label>
                        <input type="text" class="form-control" name="link" placeholder="e.g. scholarship">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Display Order</label>
                            <input type="number" class="form-control" name="display_order" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Banner</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="manage-home-banners.php" method="POST" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Replace Banner Image (Optional)</label>
                        <input type="file" class="form-control p-2 bg-light border text-muted" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">URL Link</label>
                        <input type="text" class="form-control" name="link" id="edit_link">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Display Order</label>
                            <input type="number" class="form-control" name="display_order" id="edit_order">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select class="form-select" name="status" id="edit_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Banner</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fillEditModal(id, link, order, status) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_link').value = link;
            document.getElementById('edit_order').value = order;
            document.getElementById('edit_status').value = status;
        }

        const editCampusModal = document.getElementById('editCampusImageModal');
        if(editCampusModal) {
            editCampusModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                document.getElementById('edit_campus_image_id').value = button.getAttribute('data-id');
                document.getElementById('edit_camp_alt_text').value = button.getAttribute('data-alt');
                document.getElementById('edit_camp_sort_order').value = button.getAttribute('data-sort');
                document.getElementById('edit_camp_status').value = button.getAttribute('data-status');
                
                const imageName = button.getAttribute('data-image');
                document.getElementById('current_campus_img_ref_input').value = '/assets/images/' + imageName;
                document.getElementById('edit_campus_img_preview').src = '../assets/images/' + imageName;
            });
        }
    </script>

    <!-- Add Campus Image Modal -->
    <div class="modal fade" id="addCampusImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-home-banners.php" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" name="add_campus_image" class="btn btn-primary px-4">PUBLISH ASSET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Campus Image Modal -->
    <div class="modal fade" id="editCampusImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-home-banners.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="image_id" id="edit_campus_image_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPDATE CAMPUS MARQUEE ASSET</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Current Image & Replace (Optional)</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light border rounded-3 d-flex align-items-center justify-content-center p-1" style="width: 80px; height: 80px; flex-shrink: 0;">
                                    <img id="edit_campus_img_preview" src="" alt="Preview" class="img-fluid rounded-2" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" class="form-control premium-input border p-2" name="image" accept="image/*">
                                    <input type="text" class="form-control bg-light border mt-2 text-muted" id="current_campus_img_ref_input" readonly style="font-size: 0.85rem;" placeholder="Active file string">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Alt Caption Text</label>
                            <input type="text" class="form-control premium-input border" name="alt_text" id="edit_camp_alt_text">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Loop Priority</label>
                                <input type="number" class="form-control premium-input border" name="sort_order" id="edit_camp_sort_order">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Looping Status</label>
                                <select class="form-select premium-input border" name="status" id="edit_camp_status">
                                    <option value="1">Active in Marquee</option>
                                    <option value="0">Hidden / Excluded</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="edit_campus_image" class="btn btn-primary px-4">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
