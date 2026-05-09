<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// Delete Logic
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM scholarship_tabs WHERE id = ?")->execute([$id]);
        header("Location: manage-scholarship-tabs.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// Toggle Status
if (isset($_GET['toggle_id'])) {
    $id = intval($_GET['toggle_id']);
    try {
        $pdo->prepare("UPDATE scholarship_tabs SET is_active = NOT is_active WHERE id = ?")->execute([$id]);
        header("Location: manage-scholarship-tabs.php?toggled=1");
        exit();
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// Fetch Tabs
$stmt = $pdo->query("SELECT * FROM scholarship_tabs ORDER BY display_order ASC");
$tabs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Scholarship Tabs | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>
    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'scholarship-tabs';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>SCHOLARSHIP PATHWAYS</h4>
                <a href="edit-scholarship-tab.php" class="btn btn-premium">
                    <i class="fas fa-plus me-2"></i> NEW PATHWAY
                </a>
            </header>
            
            <div class="p-4">
                <?php if(isset($_GET['deleted'])): ?>
                    <div class="alert alert-success rounded-4 border-0 mb-4">Pathway removed successfully.</div>
                <?php endif; ?>
                <?php if(isset($_GET['toggled'])): ?>
                    <div class="alert alert-success rounded-4 border-0 mb-4">Status updated successfully.</div>
                <?php endif; ?>

                <div class="table-container">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Tab Name</th>
                                <th>Theme</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tabs as $t): ?>
                            <tr>
                                <td><?php echo $t['display_order']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-wrap bg-light p-2 rounded-3 text-center" style="width: 40px;">
                                            <i class="<?php echo $t['tab_icon']; ?> text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold"><?php echo htmlspecialchars($t['tab_name']); ?></div>
                                            <small class="text-muted"><?php echo htmlspecialchars($t['tab_label']); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-<?php echo $t['tab_theme'] == 'orange' ? 'warning' : ($t['tab_theme'] == 'blue' ? 'primary' : 'success'); ?>"><?php echo strtoupper($t['tab_theme']); ?></span></td>
                                <td>
                                    <a href="?toggle_id=<?php echo $t['id']; ?>" class="badge <?php echo $t['is_active'] ? 'bg-success' : 'bg-secondary'; ?> text-decoration-none">
                                        <?php echo $t['is_active'] ? 'ACTIVE' : 'INACTIVE'; ?>
                                    </a>
                                </td>
                                <td class="text-end">
                                    <a href="edit-scholarship-tab.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                        <i class="fas fa-edit me-1"></i> EDIT
                                    </a>
                                    <a href="?delete_id=<?php echo $t['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Delete this pathway?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
