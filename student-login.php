<?php 
include 'includes/header.php'; 

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.82), rgba(0,0,0,0.6)), url('assets/images/about_header.png') center/cover no-repeat; padding: 30px 0 !important;">
    <div class="container text-center text-white">
        <h1 class="display-5 fw-black mb-0">STUDENT <span class="text-primary">PORTAL</span></h1>
    </div>
</section>

<main class="login-chamber bg-white py-6">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-card p-5 rounded-5 shadow-2xl bg-white border border-light">
                    <div class="text-center mb-5">
                        <img src="assets/images/logo.png" alt="Logo" height="60" class="mb-4">
                        <h4 class="fw-black mb-1">STUDENT <span class="text-primary">PORTAL</span></h4>
                        <p class="very-small text-muted uppercase fw-bold tracking-widest">Gateway 2026</p>
                    </div>

                    <?php if($error): ?>
                        <div class="alert alert-danger py-2 rounded-3 small border-0 mb-4"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form action="process-student-login.php" method="POST" class="vstack gap-3">
                        <div>
                            <label class="very-small text-muted uppercase fw-bold mb-1">Student ID</label>
                            <input type="text" name="student_id" class="form-control-minimal border rounded-3 w-100 py-2 px-3" placeholder="EK25XXXX" required>
                        </div>
                        <div class="mb-3">
                            <label class="very-small text-muted uppercase fw-bold mb-1">Password</label>
                            <input type="password" name="password" class="form-control-minimal border rounded-3 w-100 py-2 px-3" placeholder="••••••••" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-black shadow-lg">AUTHORIZE ACCESS <i class="fas fa-sign-in-alt ms-2"></i></button>
                        
                        <p class="text-center mt-3 very-small text-muted">Don't have an ID? <a href="scholarship" class="text-primary fw-bold text-decoration-none">Register for ESAT</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
