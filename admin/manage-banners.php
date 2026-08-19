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

// UPDATE GLOBAL COURSE BANNER LOGIC
if (isset($_POST['update_global_banner'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = basename($_FILES['image']['name']);
        $safe_file_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $file_name);
        $target_file = $target_dir . $safe_file_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            try {
                // Update ALL courses to use this banner
                $stmt = $pdo->prepare("UPDATE courses SET hero_banner=?");
                $stmt->execute([$safe_file_name]);
                $success_msg = "Global course banner updated successfully! All courses now use this banner.";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        } else {
            $error_msg = "Failed to upload new banner image.";
        }
    } else {
        $error_msg = "Please select a valid image file.";
    }
}

// FETCH CURRENT GLOBAL BANNER (From any course, since they should all be the same)
$stmt = $pdo->query("SELECT hero_banner FROM courses ORDER BY id DESC LIMIT 1");
$current_banner = $stmt->fetchColumn();

if (!$current_banner) {
    $current_banner = 'scholar image5.png'; // Default
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Global Course Banner | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon_new.png">
</head>
<body>

    <div class="row g-0 overflow-hidden" style="min-height: 100vh;">
        <div class="col-auto">
            <?php 
            $current_page = 'banners';
            include 'includes/sidebar.php'; 
            ?>
        </div>
        
        <div class="col admin-main">
            <header class="admin-header">
                <div>
                    <h4>GLOBAL COURSE BANNER MANAGEMENT</h4>
                    <small class="text-muted">Upload a single banner image that will automatically be applied to all classroom courses.</small>
                </div>
            </header>
            
            <div class="p-2">
                <?php if($success_msg): ?>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-4 mb-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg; ?>
                    </div>
                <?php endif; ?>

                <?php if($error_msg): ?>
                    <div class="alert alert-danger bg-danger bg-opacity-10 border-0 text-danger rounded-4 mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i> <?php echo htmlspecialchars($error_msg); ?>
                    </div>
                <?php endif; ?>
                
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0 text-dark">Current Global Course Banner</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-5 col-lg-4 text-center mb-4 mb-md-0">
                                <div class="rounded-4 overflow-hidden border shadow-sm d-inline-block bg-light" style="width: 100%; max-width: 300px; height: 150px;">
                                    <img src="../assets/images/<?php echo htmlspecialchars($current_banner); ?>" class="img-fluid w-100 h-100 object-fit-cover" alt="Current Global Banner" onerror="this.src='../assets/images/logo.png'">
                                </div>
                                <div class="mt-3 text-secondary fw-bold">
                                    <i class="fas fa-image me-1"></i> <?php echo htmlspecialchars($current_banner); ?>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 border-start ps-md-5">
                                <h5 class="fw-black mb-3 text-primary">Update Global Banner</h5>
                                <p class="text-muted small mb-4">Select a new image below to override the banner for <b>ALL</b> courses instantly.</p>
                                
                                <form action="manage-banners.php" method="POST" enctype="multipart/form-data">
                                    <div class="input-group mb-4 shadow-sm rounded-pill overflow-hidden border">
                                        <input type="file" class="form-control border-0 bg-light p-3" name="image" accept="image/*" required>
                                    </div>
                                    <button type="submit" name="update_global_banner" class="btn btn-premium text-white px-5 py-3 rounded-pill fw-bold shadow-lg text-uppercase tracking-wider">
                                        <i class="fas fa-upload me-2"></i> APPLY TO ALL COURSES
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info bg-info bg-opacity-10 border-info border-opacity-25 rounded-4 p-4 text-dark">
                    <h6 class="fw-bold text-info"><i class="fas fa-info-circle me-2"></i> How it works</h6>
                    <p class="mb-0 small">When you upload an image here, the system will update the <code>hero_banner</code> database field for every single course in your catalog. All courses will immediately start displaying this new banner.</p>
                </div>
            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
