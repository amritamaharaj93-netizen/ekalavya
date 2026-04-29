<?php 
include 'includes/header.php'; 

$sid = isset($_GET['sid']) ? $_GET['sid'] : '';
$pass = isset($_GET['pass']) ? $_GET['pass'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : 'Candidate';
?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.82), rgba(0,0,0,0.6)), url('assets/images/scholarship_header.png') center/cover no-repeat; padding: 100px 0 !important;">
    <div class="container text-center text-white">
        <h1 class="display-3 fw-black mb-3">REGISTRATION <span class="text-primary">SUCCESSFUL</span></h1>
        <p class="text-white-50 max-width-700 mx-auto fs-5 mb-4">Your institutional journey at Eklavya Academy begins now. Keep your credentials safe.</p>
        <div class="breadcrumb-wrap justify-content-center">
            <a href="<?php echo BASE_URL; ?>">Home</a>
            <span class="breadcrumb-separator px-2 opacity-50">/</span>
            <span>Enrollment Confirmed</span>
        </div>
    </div>
</section>

<main class="success-vault bg-light py-6">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="success-slip p-5 rounded-5 bg-white shadow-2xl text-center border border-primary border-opacity-10">
                    <div class="check-icon bg-success text-white p-4 rounded-circle d-inline-block mb-4 shadow-lg">
                        <i class="fas fa-check fs-2"></i>
                    </div>
                    
                    <h2 class="fw-black mb-1">WELCOME, <?php echo strtoupper(htmlspecialchars($name)); ?></h2>
                    <p class="text-muted small uppercase fw-bold tracking-widest mb-5">ESAT Examination Portal <?php echo date('Y'); ?></p>
                    
                    <div class="credential-box p-4 rounded-4 bg-white shadow-sm border border-dashed-primary mb-5 position-relative overflow-hidden">
                        <div class="watermark-ek position-absolute" style="font-size: 8rem; top: -20px; right: -20px; font-weight: 900; opacity: 0.03; color: var(--primary-color); pointer-events: none;">EK</div>
                        
                        <div class="row g-0">
                            <div class="col-6 border-end">
                                <p class="very-small text-muted mb-1 uppercase fw-bold">Student ID</p>
                                <h3 class="text-primary fw-black mb-0"><?php echo htmlspecialchars($sid); ?></h3>
                            </div>
                            <div class="col-6">
                                <p class="very-small text-muted mb-1 uppercase fw-bold">Access Password</p>
                                <h3 class="text-dark fw-black mb-0"><?php echo htmlspecialchars($pass); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="info-note text-start mb-5 p-3 rounded-4 border-start border-4 border-primary" style="background: rgba(230, 81, 0, 0.05);">
                        <p class="small text-dark mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> <strong>Important:</strong> Please screenshot or save these credentials. You will need them to log in to the Student Portal to download your Admit Card.</p>
                    </div>

                    <div class="cta-stack vstack gap-3">
                        <a href="student-login" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg">GO TO STUDENT PORTAL <i class="fas fa-external-link-alt ms-2"></i></a>
                        <a href="./" class="text-decoration-none text-muted small fw-bold uppercase">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
