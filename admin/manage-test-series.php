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

// Add Logic
if (isset($_POST['add_test'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $slug = slugify($title);

    if (!empty($title) && !empty($category)) {
        try {
            // Initialize with default details_json
            $default_details = [
                'offerings' => [
                    "Full syllabus coverage with latest pattern.",
                    "Detailed performance analytics.",
                    "All India Ranking."
                ],
                'about_cards' => [
                    [
                        "title" => "Expert Preparation",
                        "icon" => "fas fa-user-tie",
                        "points" => ["Designed by top faculty", "Exam-oriented approach"]
                    ]
                ],
                'card1' => ['badge' => 'PREMIUM', 'title' => 'Core Assessment', 'sub' => 'Standardized Testing', 'bg' => 'linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%)'],
                'card2' => ['badge' => 'ANALYTICS', 'title' => 'Performance Hub', 'sub' => 'AI-Driven Reports', 'bg' => 'linear-gradient(135deg, #ff8f00 0%, #e65100 100%)'],
                'reward_bg' => 'linear-gradient(135deg, #f7941d 0%, #e65100 100%)',
                'reward_icon' => 'fas fa-trophy',
                'note' => ['title' => 'ACADEMIC NOTE', 'desc' => 'Detailed analysis for every test.']
            ];
            $details_json = json_encode($default_details);

            $stmt = $pdo->prepare("INSERT INTO test_series 
                (title, slug, category, type, price, header_title, header_subtitle, badge_label, lifecycle_title, lifecycle_desc, class_label, duration_label, subjects, reward_title, reward_desc, show_reward_banner, show_stars_banner, details_json) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $title, $slug, $category, $type, $price, 
                $title, "SESSION 2026-27", "NEW PROGRAM", 
                $title, "Comprehensive testing ecosystem.", 
                "All Classes", "1 Year", "Science", 
                "Rewards for Toppers", "Achieve top ranks and win scholarships.", 
                1, 0, $details_json
            ]);
            
            $new_id = $pdo->lastInsertId();
            header("Location: edit-test-series.php?id=$new_id&created=1");
            exit();
        } catch (PDOException $e) { $error_msg = "Error: " . $e->getMessage(); }
    } else { $error_msg = "Title and Category are required."; }
}

// Delete Logic
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    try {
        $pdo->prepare("DELETE FROM test_series WHERE id = ?")->execute([$id]);
        header("Location: manage-test-series.php?deleted=1");
        exit();
    } catch (PDOException $e) { $error_msg = $e->getMessage(); }
}

// Fetch
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
            $current_page = 'test-series';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <h4>TEST SERIES ECOSYSTEM</h4>
                <button class="btn btn-premium" data-bs-toggle="modal" data-bs-target="#addTestModal">
                    <i class="fas fa-plus me-2"></i> NEW TEST SERIES
                </button>
            </header>
            
            <div class="p-4">
                <?php if($success_msg || isset($_GET['deleted'])): ?>
                    <div class="alert alert-success rounded-4 border-0 mb-4"><?php echo $success_msg ?: "Test series removed successfully."; ?></div>
                <?php endif; ?>
                <?php if($error_msg): ?>
                    <div class="alert alert-danger rounded-4 border-0 mb-4"><?php echo $error_msg; ?></div>
                <?php endif; ?>

                <div class="table-container">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tests as $t): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?php echo htmlspecialchars($t['title']); ?></div>
                                    <small class="text-muted"><?php echo $t['slug']; ?></small>
                                </td>
                                <td><span class="badge bg-light text-dark"><?php echo $t['category']; ?></span></td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary"><?php echo $t['type']; ?></span></td>
                                <td>₹<?php echo $t['price']; ?></td>
                                <td class="text-end">
                                    <a href="edit-test-series.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                        <i class="fas fa-edit me-1"></i> EDIT DETAILS
                                    </a>
                                    <a href="?delete_id=<?php echo $t['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Delete this test series?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($tests)): ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">No test series found. Click "New Test Series" to add one.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addTestModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white border-0 rounded-4 shadow-lg overflow-hidden">
                <form action="" method="POST">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fw-bold">CREATE TEST SERIES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Title</label>
                            <input type="text" class="form-control premium-input border" name="title" placeholder="e.g. NEET Enthusiast Test Series" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Category</label>
                                <select class="form-select premium-input border" name="category" required>
                                    <option value="NEET">NEET</option>
                                    <option value="IIT-JEE">IIT-JEE</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Type/Tag</label>
                                <input type="text" class="form-control premium-input border" name="type" placeholder="e.g. Class11, Dropper, Class13" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="small text-muted fw-bold mb-2 ms-2 text-uppercase">Price (₹)</label>
                            <input type="text" class="form-control premium-input border" name="price" placeholder="e.g. 4,999">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="add_test" class="btn btn-premium text-white px-4">CREATE SERIES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
