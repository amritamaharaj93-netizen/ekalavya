<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// ADD CENTER LOGIC
if (isset($_POST['add_center'])) {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $map_link = ""; 
    $is_head_office = isset($_POST['is_head_office']) ? 1 : 0;
    $open_time = ""; 

    if (!empty($name) && !empty($address)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO study_centers (name, address, phone, email, map_link, is_head_office, open_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $address, $phone, $email, $map_link, $is_head_office, $open_time]);
            $success_msg = "Study center added successfully!";
        } catch (PDOException $e) { $error_msg = "Error: " . $e->getMessage(); }
    } else { $error_msg = "Name and Address are required."; }
}

// UPDATE CENTER LOGIC
if (isset($_POST['edit_center'])) {
    $id = $_POST['center_id'];
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $map_link = ""; 
    $is_head_office = isset($_POST['is_head_office']) ? 1 : 0;
    $open_time = ""; 

    try {
        $stmt = $pdo->prepare("UPDATE study_centers SET name=?, address=?, phone=?, email=?, map_link=?, is_head_office=?, open_time=? WHERE id=?");
        $stmt->execute([$name, $address, $phone, $email, $map_link, $is_head_office, $open_time, $id]);
        $success_msg = "Study center updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// DELETE CENTER LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM study_centers WHERE id = ?")->execute([$id]);
        header("Location: manage-study-centers.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// FETCH CENTERS
$stmt = $pdo->query("SELECT * FROM study_centers ORDER BY created_at DESC");
$centers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Study Centers | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'study_centers';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>STUDY CENTERS</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addCenterModal">
                    <i class="fas fa-plus me-2"></i> NEW CENTER
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ? $success_msg : "Center deleted successfully!"; ?>
                    </div>
                <?php endif; ?>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Center Name</th>
                                <th>Location</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($centers): ?>
                                <?php foreach($centers as $center): ?>
                                <tr>
                                    <td><span class="text-secondary small">#<?php echo $center['id']; ?></span></td>
                                    <td>
                                        <b class="text-dark"><?php echo htmlspecialchars($center['name']); ?></b>
                                        <?php if($center['is_head_office']): ?>
                                            <span class="badge bg-warning text-dark ms-2">Head Office</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><small class="text-muted"><?php echo htmlspecialchars(substr($center['address'], 0, 50)) . '...'; ?></small></td>
                                    <td><i class="fas fa-phone-alt me-2 text-muted"></i> <?php echo htmlspecialchars($center['phone']); ?></td>
                                    <td>
                                         <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#editCenterModal" 
                                         data-id="<?php echo $center['id']; ?>"
                                         data-name="<?php echo htmlspecialchars($center['name']); ?>"
                                         data-address="<?php echo htmlspecialchars($center['address']); ?>"
                                         data-phone="<?php echo htmlspecialchars($center['phone']); ?>"
                                         data-email="<?php echo htmlspecialchars($center['email']); ?>"
                                         data-map_link="<?php echo htmlspecialchars($center['map_link']); ?>"
                                         data-is_head_office="<?php echo $center['is_head_office']; ?>"
                                         data-open_time="<?php echo htmlspecialchars($center['open_time']); ?>">
                                     <i class="fas fa-edit"></i>
                                 </button>
                                         <a href="?delete_id=<?php echo $center['id']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Delete this center?')"><i class="fas fa-trash"></i></a>
                                     </td>
                                 </tr>
                                 <?php endforeach; ?>
                            <?php else: ?>
                                 <tr><td colspan="5" class="text-center py-5 text-muted">No study centers found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <!-- Add Center Modal -->
    <div class="modal fade" id="addCenterModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-study-centers.php" method="POST">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">ADD NEW CENTER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Center Name</label>
                            <input type="text" class="form-control premium-input border" name="name" required placeholder="e.g. GAYA CENTER">
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Address</label>
                            <textarea class="form-control premium-input border" name="address" rows="3" required placeholder="Enter full address..."></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Phone (10 Digits)</label>
                                <div class="input-group">
                                    <span class="input-group-text premium-input border-end-0 bg-light opacity-75">+91</span>
                                    <input type="text" class="form-control premium-input border border-start-0" name="phone" placeholder="9934244522" maxlength="10" pattern="\d{10}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Email</label>
                                <input type="email" class="form-control premium-input border" name="email" placeholder="e.g. info@eklavya.com">
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_head_office" id="add_is_head_office">
                                <label class="form-check-label small fw-bold text-muted" for="add_is_head_office">MARK AS HEAD OFFICE?</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="add_center" class="btn btn-premium text-white px-4">SAVE CENTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Center Modal -->
    <div class="modal fade" id="editCenterModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-study-centers.php" method="POST">
                    <input type="hidden" name="center_id" id="edit_center_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPDATE CENTER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Center Name</label>
                            <input type="text" class="form-control premium-input border" name="name" id="edit_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Address</label>
                            <textarea class="form-control premium-input border" name="address" id="edit_address" rows="3" required></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Phone (10 Digits)</label>
                                <div class="input-group">
                                    <span class="input-group-text premium-input border-end-0 bg-light opacity-75">+91</span>
                                    <input type="text" class="form-control premium-input border border-start-0" name="phone" id="edit_phone" maxlength="10" pattern="\d{10}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Email</label>
                                <input type="email" class="form-control premium-input border" name="email" id="edit_email">
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_head_office" id="edit_is_head_office">
                                <label class="form-check-label small fw-bold text-muted" for="edit_is_head_office">MARK AS HEAD OFFICE?</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="edit_center" class="btn btn-premium text-white px-4">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editCenterModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_center_id').value = button.getAttribute('data-id');
            document.getElementById('edit_name').value = button.getAttribute('data-name');
            document.getElementById('edit_address').value = button.getAttribute('data-address');
            document.getElementById('edit_phone').value = button.getAttribute('data-phone');
            document.getElementById('edit_email').value = button.getAttribute('data-email');
            document.getElementById('edit_map_link').value = button.getAttribute('data-map_link');
            document.getElementById('edit_is_head_office').checked = button.getAttribute('data-is_head_office') == '1';
            document.getElementById('edit_open_time').value = button.getAttribute('data-open_time');
        });
    </script>
</body>
</html>
