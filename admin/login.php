<?php
session_start();
require_once '../config/database.php';

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error_msg = "The credentials provided do not match our records.";
        }
    } else {
        $error_msg = "Please enter both username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutional Login | Eklavya Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-premium.css">
</head>
<body class="login-screen">

    <div class="login-card-clean">
        <div class="text-center mb-5">
            <img src="../assets/images/logo.png" alt="Eklavya Academy" style="height: 60px;" class="mb-4">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Jost';">Management Portal</h3>
            <p class="text-muted small">Please authenticate to manage institutional data</p>
        </div>

        <?php if($error_msg): ?>
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-3 small mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-4">
                <label class="small fw-bold text-uppercase text-muted mb-2 ms-1" style="letter-spacing: 0.5px;">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="far fa-user text-muted"></i></span>
                    <input type="text" class="form-control premium-input border-start-0 rounded-end-3" name="username" placeholder="admin_username" required>
                </div>
            </div>
            
            <div class="mb-5">
                <label class="small fw-bold text-uppercase text-muted mb-2 ms-1" style="letter-spacing: 0.5px;">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="far fa-lock text-muted"></i></span>
                    <input type="password" class="form-control premium-input border-start-0 rounded-end-3" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-premium w-100 py-3 text-white rounded-3 shadow-sm">
                Log In to Dashboard <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="mt-5 text-center">
            <p class="text-muted" style="font-size: 0.75rem;">&copy; 2026 EKLAVYA ACADEMY. ALL RIGHTS RESERVED.</p>
        </div>
    </div>

</body>
</html>
