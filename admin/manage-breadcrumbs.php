<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// ADD BREADCRUMB LOGIC
if (isset($_POST['add_breadcrumb'])) {
    $page_identifier = trim($_POST['page_identifier']);
    $label = trim($_POST['label']);
    $url = trim($_POST['url']);
    $sort_order = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;

    if (!empty($page_identifier) && !empty($label)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO breadcrumbs (page_identifier, label, url, sort_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([$page_identifier, $label, $url, $sort_order]);
            $success_msg = "Breadcrumb navigation item added successfully!";
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    } else {
        $error_msg = "Page Identifier and Label are required fields.";
    }
}

// EDIT BREADCRUMB LOGIC
if (isset($_POST['edit_breadcrumb'])) {
    $id = intval($_POST['breadcrumb_id']);
    $page_identifier = trim($_POST['page_identifier']);
    $label = trim($_POST['label']);
    $url = trim($_POST['url']);
    $sort_order = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;

    if (!empty($page_identifier) && !empty($label)) {
        try {
            $stmt = $pdo->prepare("UPDATE breadcrumbs SET page_identifier=?, label=?, url=?, sort_order=? WHERE id=?");
            $stmt->execute([$page_identifier, $label, $url, $sort_order, $id]);
            $success_msg = "Breadcrumb updated successfully!";
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    } else {
        $error_msg = "Page Identifier and Label are required fields.";
    }
}

// DELETE BREADCRUMB LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM breadcrumbs WHERE id = ?")->execute([$id]);
        header("Location: manage-breadcrumbs.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        $error_msg = "Database Error: " . $e->getMessage();
    }
}

// FETCH BREADCRUMBS
$stmt = $pdo->query("SELECT * FROM breadcrumbs ORDER BY page_identifier ASC, sort_order ASC");
$breadcrumbs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Breadcrumbs | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'breadcrumbs';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>BREADCRUMB PATHS ECOSYSTEM</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addBreadcrumbModal">
                    <i class="fas fa-plus me-2"></i> ADD BREADCRUMB
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ? $success_msg : "Breadcrumb record removed successfully!"; ?>
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
                                <th>Section / Page ID</th>
                                <th>Display Label</th>
                                <th>Target Route Link</th>
                                <th>Sort Priority</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($breadcrumbs): ?>
                                <?php foreach($breadcrumbs as $bc): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 text-uppercase">
                                            <?php echo htmlspecialchars($bc['page_identifier']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <b class="text-dark"><?php echo htmlspecialchars($bc['label']); ?></b>
                                        <span class="text-secondary small d-block">ID: #<?php echo $bc['id']; ?></span>
                                    </td>
                                    <td>
                                        <?php if(empty($bc['url'])): ?>
                                            <span class="text-muted small"><i>Root / Base URL</i></span>
                                        <?php else: ?>
                                            <code class="text-info"><?php echo htmlspecialchars($bc['url']); ?></code>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-3 py-1"><?php echo intval($bc['sort_order']); ?></span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary border-0 rounded-circle me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editBreadcrumbModal" 
                                            data-id="<?php echo $bc['id']; ?>"
                                            data-page="<?php echo htmlspecialchars($bc['page_identifier']); ?>"
                                            data-label="<?php echo htmlspecialchars($bc['label']); ?>"
                                            data-url="<?php echo htmlspecialchars($bc['url']); ?>"
                                            data-sort="<?php echo htmlspecialchars($bc['sort_order']); ?>"
                                            title="Edit Item">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete_id=<?php echo $bc['id']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Permanently delete this breadcrumb path?')" title="Delete Item">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-5 text-muted">No custom breadcrumb configurations defined. Click add above to start.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <!-- Add Breadcrumb Modal -->
    <div class="modal fade" id="addBreadcrumbModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-breadcrumbs.php" method="POST">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">ADD BREADCRUMB ITEM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Page / Identifier Hub</label>
                            <input type="text" class="form-control premium-input border" name="page_identifier" required placeholder="e.g. courses">
                            <small class="text-muted d-block mt-1 ms-2" style="font-size: 0.7rem;">Grouping ID for dynamic section resolution.</small>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Display Label</label>
                            <input type="text" class="form-control premium-input border" name="label" required placeholder="e.g. Classroom Courses">
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Target Route / URL (Leave blank for Home)</label>
                            <input type="text" class="form-control premium-input border" name="url" placeholder="e.g. courses.php">
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Sort Order Priority</label>
                            <input type="number" class="form-control premium-input border" name="sort_order" value="10" placeholder="e.g. 10">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="add_breadcrumb" class="btn btn-premium text-white px-4">PUBLISH BREADCRUMB</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Breadcrumb Modal -->
    <div class="modal fade" id="editBreadcrumbModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-breadcrumbs.php" method="POST">
                    <input type="hidden" name="breadcrumb_id" id="edit_breadcrumb_id">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">UPDATE BREADCRUMB ITEM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Page / Identifier Hub</label>
                            <input type="text" class="form-control premium-input border" name="page_identifier" id="edit_page_identifier" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Display Label</label>
                            <input type="text" class="form-control premium-input border" name="label" id="edit_label" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Target Route / URL</label>
                            <input type="text" class="form-control premium-input border" name="url" id="edit_url">
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Sort Order Priority</label>
                            <input type="number" class="form-control premium-input border" name="sort_order" id="edit_sort_order">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="edit_breadcrumb" class="btn btn-premium text-white px-4">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editBreadcrumbModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_breadcrumb_id').value = button.getAttribute('data-id');
            document.getElementById('edit_page_identifier').value = button.getAttribute('data-page');
            document.getElementById('edit_label').value = button.getAttribute('data-label');
            document.getElementById('edit_url').value = button.getAttribute('data-url');
            document.getElementById('edit_sort_order').value = button.getAttribute('data-sort');
        });
    </script>
</body>
</html>
