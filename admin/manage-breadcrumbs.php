<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success_msg = "";
$error_msg = "";

// UPDATE BREADCRUMB BACKGROUND LOGIC
if (isset($_POST['update_breadcrumb_bg'])) {
    if (isset($_FILES['breadcrumb_bg']) && $_FILES['breadcrumb_bg']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['breadcrumb_bg']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = 'breadcrumb_bg_' . time() . '.' . $ext;
            $upload_path = '../assets/images/' . $new_filename;
            
            if (move_uploaded_file($_FILES['breadcrumb_bg']['tmp_name'], $upload_path)) {
                try {
                    // Try update first
                    $stmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = 'breadcrumb_bg_image'");
                    $stmt->execute([$new_filename]);
                    if($stmt->rowCount() == 0) {
                        // Insert if not exists
                        $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES ('breadcrumb_bg_image', ?)");
                        $stmt->execute([$new_filename]);
                    }
                    $success_msg = "Global Breadcrumb Background updated successfully!";
                } catch (PDOException $e) {
                    $error_msg = "Database Error: " . $e->getMessage();
                }
            } else {
                $error_msg = "Failed to upload image.";
            }
        } else {
            $error_msg = "Invalid file type. Only JPG, PNG, and WebP are allowed.";
        }
    } else {
        $error_msg = "Please select a valid image.";
    }
}



// FETCH CURRENT BREADCRUMB BG
try {
    $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = 'breadcrumb_bg_image'");
    $stmt->execute();
    $breadcrumb_bg = $stmt->fetchColumn();
    if (!$breadcrumb_bg) {
        $breadcrumb_bg = 'TopFront & side .png';
    }
} catch (PDOException $e) {
    $breadcrumb_bg = 'TopFront & side .png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Breadcrumbs | Ekalavya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon_new.png">
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

                <!-- Breadcrumb Image Management -->
                <div class="card border-0 rounded-4 shadow-sm mb-5 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="fas fa-image text-primary me-2"></i> Global Breadcrumb Background</h5>
                        <p class="text-muted small mt-1 mb-0">This image appears behind the page title on Courses, Scholarships, Portals, and Dashboards.</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label class="small fw-bold text-muted text-uppercase tracking-widest d-block mb-3">Current Background</label>
                                <div class="rounded-3 overflow-hidden border position-relative" style="height: 120px; background: url('../assets/images/<?php echo htmlspecialchars($breadcrumb_bg); ?>') center/cover no-repeat;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
                                    <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                                        <h3 class="text-white fw-black mb-0" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">SAMPLE TITLE</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="manage-breadcrumbs.php" method="POST" enctype="multipart/form-data" class="bg-light p-3 rounded-4 border">
                                    <label class="form-label small fw-bold">Upload New Background Image</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="breadcrumb_bg" accept="image/jpeg, image/png, image/webp" required>
                                    </div>
                                    <button type="submit" name="update_breadcrumb_bg" class="btn btn-primary w-100 rounded-pill fw-bold">
                                        <i class="fas fa-cloud-upload-alt me-2"></i> UPDATE IMAGE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            
            <footer class="admin-footer">&copy; 2026 Ekalavya ACADEMY ADMINISTRATIVE PORTAL.</footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
