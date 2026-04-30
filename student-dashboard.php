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
?>

<section class="page-header" style="padding: 40px 0;">
    <div class="container d-flex align-items-center justify-content-between">
        <div>
            <p class="very-small uppercase fw-black text-primary tracking-widest mb-1" style="opacity: 0.8;">Institutional Portal</p>
            <h1 class="mb-0 h2"><?php echo strtoupper(htmlspecialchars($student['name'])); ?></h1>
        </div>
        <div class="text-end">
             <span class="badge bg-white text-primary border rounded-pill px-3 py-2 fw-black small shadow-sm"><?php echo htmlspecialchars($student['student_id']); ?></span>
             <a href="logout.php" class="text-danger small fw-bold text-decoration-none ms-3"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</section>

<main class="dashboard-body bg-light py-6">
    <div class="container">
        <div class="row g-4">
            
            <!-- Core Resources Grid -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <!-- Admit Card -->
                    <div class="col-md-6">
                        <div class="portal-resource-card p-5 rounded-5 bg-white shadow-sm border border-light h-100 text-center transition-all hover-translate-y">
                            <div class="icon-bubble bg-primary bg-opacity-10 text-primary p-4 rounded-circle d-inline-block mb-4">
                                <i class="fas fa-id-card fs-1"></i>
                            </div>
                            <h4 class="fw-black mb-2">ADMIT CARD</h4>
                            <p class="small text-muted mb-5">Download your official ESAT examination admission slip with venue details.</p>
                            <?php $admit_card = (isset($student['admit_card']) && $student['admit_card'] != '#') ? 'uploads/admit_cards/' . $student['admit_card'] : '#'; ?>
                            <a href="<?php echo $admit_card; ?>" download target="_blank" class="btn btn-warning w-100 py-2 rounded-pill fw-black text-white">DOWNLOAD SLIP <i class="fas fa-download ms-2"></i></a>
                        </div>
                    </div>

                    <!-- Test Portal -->
                    <div class="col-md-6">
                        <div class="portal-resource-card p-5 rounded-5 bg-white shadow-sm border border-light h-100 text-center transition-all hover-translate-y">
                            <div class="icon-bubble bg-success bg-opacity-10 text-success p-4 rounded-circle d-inline-block mb-4">
                                <i class="fas fa-vial fs-1"></i>
                            </div>
                            <h4 class="fw-black mb-2">TEST SERIES</h4>
                            <p class="small text-muted mb-5">Access your mocks, part-tests, and real-time rank forecasting analytics.</p>
                            <?php $ts_link = (isset($student['test_series_link']) && $student['test_series_link'] != '#') ? $student['test_series_link'] : 'test-series.php'; ?>
                            <a href="<?php echo $ts_link; ?>" target="_blank" class="btn btn-success w-100 py-2 rounded-pill fw-black text-white">ENTER PORTAL <i class="fas fa-external-link-alt ms-2"></i></a>
                        </div>
                    </div>

                    <!-- Course Portal -->
                    <div class="col-12">
                        <div class="portal-wide-card p-5 rounded-5 bg-white shadow-sm border border-light d-flex align-items-center justify-content-between transition-all hover-translate-y">
                            <div class="d-flex align-items-center gap-5">
                                <div class="icon-bubble bg-warning bg-opacity-10 text-warning p-4 rounded-circle d-inline-block">
                                    <i class="fas fa-graduation-cap fs-1"></i>
                                </div>
                                <div>
                                    <p class="very-small text-muted uppercase fw-black mb-1">Active Program</p>
                                    <h3 class="fw-black mb-0"><?php echo htmlspecialchars(isset($student['program']) ? $student['program'] : 'IIT-JEE'); ?></h3>
                                </div>
                            </div>
                            <?php $c_link = (isset($student['course_link']) && $student['course_link'] != '#') ? $student['course_link'] : 'course-detail.php?slug=nurture-jee-11'; ?>
                            <a href="<?php echo $c_link; ?>" target="_blank" class="btn btn-dark px-5 py-3 rounded-pill fw-black">GO TO COURSE <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>

                    <!-- Assigned Study Materials -->
                    <div class="col-12">
                        <div class="bg-white p-5 rounded-5 shadow-sm border border-light">
                            <h4 class="fw-black mb-4">ASSIGNED STUDY MODULES</h4>
                            <div class="row g-3">
                                <?php 
                                $stmt = $pdo->prepare("SELECT sm.* FROM study_material sm JOIN student_materials stm ON sm.id = stm.material_id WHERE stm.student_id = ?");
                                $stmt->execute([$student['id']]);
                                $assigned_mats = $stmt->fetchAll();
                                
                                if($assigned_mats): ?>
                                    <?php foreach($assigned_mats as $mat): ?>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-4 d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </div>
                                                    <div>
                                                        <b class="small d-block"><?php echo htmlspecialchars($mat['title']); ?></b>
                                                        <span class="very-small text-muted uppercase"><?php echo htmlspecialchars($mat['category']); ?></span>
                                                    </div>
                                                </div>
                                                <a href="uploads/materials/<?php echo $mat['file_path']; ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">View</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12 text-center py-4 bg-light rounded-4">
                                        <p class="small text-muted mb-0">No study modules assigned to your profile yet.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile / Info Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-info p-5 rounded-5 bg-white shadow-sm border border-light vstack gap-4">
                    <h5 class="fw-black mb-2 text-uppercase" style="letter-spacing: 1px;">Academic Profile</h5>
                    
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
                        <p class="fw-bold mb-0"><?php echo date('d M, Y', strtotime($student['created_at'])); ?></p>
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
