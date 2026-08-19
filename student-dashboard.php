<?php 
session_start();
include 'config/database.php';

// Auth Protection
if(!isset($_SESSION['student_id'])) {
    header("Location: student-login.php");
    exit();
}

include 'includes/header.php'; 

// Fetch full student details
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute(['id' => $_SESSION['student_db_id']]);
$student = $stmt->fetch();

if (!$student) {
    session_destroy();
    header("Location: student-login.php");
    exit();
}
?>

<section class="page-header position-relative" style="background: url('assets/images/<?php echo htmlspecialchars($global_breadcrumb_bg); ?>') center/cover no-repeat; padding: clamp(40px, 8vh, 100px) 0 !important; padding-left: 5px !important;">
    <!-- Invisible spacer exactly matching courses.php structure to force identical container height & background crop -->
    <div class="container text-center" style="visibility: hidden;">
        <h1 class="fw-black mb-0" style="font-size: clamp(2.2rem, 10vw, 4.5rem); line-height: 1.1;">DUMMY <span class="d-block d-md-inline">TEXT</span></h1>
    </div>

    <!-- Real content perfectly centered vertically within the exact same space -->
    <div class="container d-flex align-items-center justify-content-between position-absolute w-100" style="top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2; padding-left: calc(var(--bs-gutter-x) * 0.5); padding-right: calc(var(--bs-gutter-x) * 0.5);">
        <div class="text-white">
            <p class="very-small uppercase fw-black text-primary tracking-widest mb-1" style="opacity: 0.9;">Institutional Portal</p>
            <h1 class="fw-black mb-0" style="font-size: clamp(1.8rem, 5vw, 3rem); line-height: 1.1;"><?php echo strtoupper(htmlspecialchars($student['name'])); ?></h1>
        </div>
        <div class="text-end text-white">
             <span class="badge bg-white text-primary border rounded-pill px-3 py-2 fw-black small shadow-sm"><?php echo htmlspecialchars($student['student_id']); ?></span>
             <a href="logout.php" class="text-white small fw-bold text-decoration-none ms-3 opacity-75 hover-opacity-100"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</section>

<style>
.icon-bubble {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}
.portal-resource-card, .portal-wide-card {
    transition: all 0.3s ease;
}
</style>

<main class="dashboard-body bg-light py-6">
    <div class="container">
        <div class="row g-4">
            
            <!-- Core Resources Grid -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <!-- Admit Card -->
                    <div class="col-12">
                        <div class="portal-resource-card p-5 rounded-5 bg-white shadow-sm border border-light h-100 text-center transition-all hover-translate-y">
                            <div class="icon-bubble bg-primary bg-opacity-10 text-primary rounded-circle mb-4">
                                <i class="fas fa-id-card fs-1"></i>
                            </div>
                            <h4 class="fw-black mb-2">ADMIT CARD</h4>
                            <p class="small text-muted mb-5">Download your official ESAT examination admission slip with venue details.</p>
                            <?php 
                                $admit_file = !empty($student['admit_card']) ? $student['admit_card'] : '';
                                // Verification: Database entry must exist, not be '#' placeholder, and file must actually exist on disk
                                $has_admit = !empty($admit_file) && $admit_file != '#' && file_exists('uploads/admit_cards/' . $admit_file);
                                $admit_card_url = $has_admit ? 'uploads/admit_cards/' . $admit_file : '#'; 
                            ?>
                            <?php if($has_admit): ?>
                                <a href="<?php echo $admit_card_url; ?>" download target="_blank" class="btn btn-warning w-100 py-2 rounded-pill fw-black text-white shadow-sm">DOWNLOAD SLIP <i class="fas fa-download ms-2"></i></a>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100 py-2 rounded-pill fw-black text-white opacity-50" style="cursor: not-allowed;" disabled>ADMIT CARD PENDING <i class="fas fa-clock ms-2"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>

                    </div>
                </div>

            <!-- Profile / Info Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-info p-5 rounded-5 bg-white shadow-sm border border-light vstack gap-4">
                    <h5 class="fw-black mb-2 text-uppercase" style="letter-spacing: 1px;">Eklavya Profile</h5>
                    
                    <div class="profile-item">
                        <p class="very-small text-muted uppercase fw-bold mb-1">Registered Contact</p>
                        <p class="fw-bold mb-0"><?php echo htmlspecialchars($student['phone']); ?></p>
                    </div>
                    
                    <div class="profile-item">
                        <p class="very-small text-muted uppercase fw-bold mb-1">Email Address</p>
                        <p class="fw-bold mb-0"><?php echo htmlspecialchars($student['email']); ?></p>
                    </div>

                    <div class="profile-item">
                        <p class="very-small text-muted uppercase fw-bold mb-1">Joined Date</p>
                        <p class="fw-bold mb-0"><?php echo date('d M, Y'); ?></p>
                    </div>

                    <div class="divider bg-light my-2" style="height: 1px;"></div>
                    
                    <div class="status-box p-3 rounded-4 bg-light text-center">
                        <p class="very-small text-muted uppercase fw-bold mb-1">Account Status</p>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">ACTIVE MEMBER</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
