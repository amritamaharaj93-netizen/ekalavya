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

// ADD TEST SERIES LOGIC
if (isset($_POST['add_test'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description'] ?? '');
    $link = trim($_POST['link']);
    $slug = slugify($title);

    if (!empty($title)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO test_series (title, slug, category, price, description, features, link) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $category, $price, $description, $_POST['features'] ?? '', $link]);
            $success_msg = "Test series added successfully!";
        } catch (PDOException $e) { $error_msg = "Error: " . $e->getMessage(); }
    } else { $error_msg = "Title is required."; }
}

// EDIT TEST SERIES LOGIC
if (isset($_POST['edit_test'])) {
    $id = $_POST['test_id'];
    $title = trim($_POST['title']);
    $slug = slugify($title);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $link = trim($_POST['link']);

    try {
        $stmt = $pdo->prepare("UPDATE test_series SET title=?, slug=?, category=?, price=?, description=?, features=?, link=? WHERE id=?");
        $stmt->execute([$title, $slug, $category, $price, $_POST['description'], $_POST['features'], $link, $id]);
        $success_msg = "Test series updated successfully!";
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// DELETE LOGIC
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM test_series WHERE id = ?")->execute([$id]);
        header("Location: manage-test-series.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = "Error deleting."; }
}

$stmt = $pdo->query("SELECT * FROM test_series ORDER BY created_at DESC");
$tests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Test Series | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'test_series';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>TEST ECOSYSTEM</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addTestModal">
                    <i class="fas fa-plus me-2"></i> DEPLOY TEST
                </button>
            </header>
            
            <div class="p-2">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg ?: "Test series removed."; ?>
                    </div>
                <?php endif; ?>
                
                <div class="table-container">
                    <table class="table table-premium table-hover m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Series Title</th>
                                <th>Category</th>
                                <th>Price/Status</th>
                                <th>Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($tests): ?>
                                <?php foreach($tests as $test): ?>
                                <tr>
                                    <td><span class="text-secondary small">#<?php echo $test['id']; ?></span></td>
                                    <td><b class="text-dark"><?php echo htmlspecialchars($test['title']); ?></b></td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2"><?php echo htmlspecialchars($test['category']); ?></span></td>
                                    <td><span class="text-success fw-bold small"><?php echo htmlspecialchars($test['price'] ?: 'Active'); ?></span></td>
                                    <td><a href="<?php echo htmlspecialchars($test['link']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Open Portal</a></td>
                                    <td>
                                         <button class="btn btn-sm btn-outline-primary border-0" 
                                                 onclick='openEditModal(<?php echo json_encode($test); ?>)'>
                                             <i class="fas fa-edit"></i>
                                         </button>
                                         <a href="?delete_id=<?php echo $test['id']; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Delete this test?')"><i class="fas fa-trash"></i></a>
                                     </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No active test series deployed.</td></tr>
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

    <!-- Add Test Modal -->
    <div class="modal fade" id="addTestModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-test-series.php" method="POST">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">DEPLOY NEW SERIES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Series Title</label>
                            <input type="text" class="form-control premium-input border" name="title" required placeholder="e.g. Mock Test 2026">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <input type="text" class="form-control premium-input border" name="category" placeholder="e.g. NEET-UG">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Price / Tag</label>
                                <input type="text" class="form-control premium-input border" name="price" placeholder="e.g. Free">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Description</label>
                            <textarea class="form-control premium-input border" name="description" rows="2"></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Features (One per line)</label>
                            <textarea class="form-control premium-input border" name="features" rows="3" placeholder="e.g. Unit Tests&#10;Full Syllabus"></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Portal URL</label>
                            <input type="url" class="form-control premium-input border" name="link" placeholder="https://portal.exam.com">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="add_test" class="btn btn-premium text-white px-5">DEPLOY SERIES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Test Modal -->
    <div class="modal fade" id="editTestModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="manage-test-series.php" method="POST">
                    <input type="hidden" name="test_id" id="edit_test_id">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">UPDATE TEST SERIES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Series Title</label>
                            <input type="text" class="form-control premium-input border" name="title" id="edit_title" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <input type="text" class="form-control premium-input border" name="category" id="edit_category">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Price / Tag</label>
                                <input type="text" class="form-control premium-input border" name="price" id="edit_price">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Description</label>
                            <textarea class="form-control premium-input border" name="description" id="edit_description" rows="2"></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Features (One per line)</label>
                            <textarea class="form-control premium-input border" name="features" id="edit_features" rows="3"></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Portal URL</label>
                            <input type="url" class="form-control premium-input border" name="link" id="edit_link">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" name="edit_test" class="btn btn-premium text-white px-5">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(test) {
            document.getElementById('edit_test_id').value = test.id;
            document.getElementById('edit_title').value = test.title;
            document.getElementById('edit_category').value = test.category;
            document.getElementById('edit_price').value = test.price;
            document.getElementById('edit_description').value = test.description || '';
            document.getElementById('edit_features').value = test.features || '';
            document.getElementById('edit_link').value = test.link;
            
            var editModal = new bootstrap.Modal(document.getElementById('editTestModal'));
            editModal.show();
        }
    </script>
</body>
</html>
