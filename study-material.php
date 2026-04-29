<?php 
include 'includes/header.php'; 

// Fetch filters from URL
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$subject = isset($_GET['subject']) ? trim($_GET['subject']) : '';

// Build dynamic query
$query = "SELECT * FROM study_material WHERE 1=1";
$params = [];

if ($category) {
    $query .= " AND (category LIKE ? OR title LIKE ?)";
    $params[] = "%$category%";
    $params[] = "%$category%";
}

if ($subject) {
    $query .= " AND (title LIKE ? OR category LIKE ?)";
    $params[] = "%$subject%";
    $params[] = "%$subject%";
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$db_materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

$header_title = "ACADEMIC <span class='text-primary'>VAULT</span>";
if ($category || $subject) {
    $header_title = htmlspecialchars($category ?: $subject) . " <span class='text-primary'>RESOURCES</span>";
}
?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('assets/images/study_vault_header.png') center/cover no-repeat; padding: 50px 0 !important;">
    <div class="container text-center text-white">
        <h1 class="display-3 fw-black mb-0"><?php echo $header_title; ?></h1>
    </div>
</section>

<!-- Resource Ecosystem -->
<main class="resource-portal bg-white py-6">
    <div class="container container-1440">
        
        <!-- Section 1: Top Engagement Split (Core Pedagogy vs Access) -->
        <div class="row g-5 mb-6">
            <!-- Left Side: Teaching Philosphy -->
            <div class="col-lg-8">
                <div class="pe-lg-5">
                    <h2 class="fw-black mb-4 h1">CRAFTED FOR <span class="text-primary">CLARITY</span></h2>
                    <p class="text-muted lead mb-5">Our study modules are iterative research results, bridging the gap between classroom teaching and rank-focused application.</p>
                    
                    <div class="bento-grid mb-5">
                        <!-- Topic Heatmaps (Large) -->
                        <div class="bento-item bento-item-lg bento-orange d-flex flex-column justify-content-between">
                            <div class="bento-top">
                                <div class="bento-icon-box"><i class="fas fa-microchip"></i></div>
                                <h3 class="fw-black mb-3 h4">Topic Heatmaps</h3>
                                <p class="opacity-90 small">Advanced trend-based weightage analysis to strategically map your high-yield topics.</p>
                            </div>
                            <div class="bento-bottom">
                                <span class="bento-badge-white">CORE ACCESS</span>
                            </div>
                        </div>

                        <!-- Graded Exercises (Medium) -->
                        <div class="bento-item bento-item-md bento-dark d-flex flex-column justify-content-between">
                            <div class="bento-top">
                                <div class="bento-icon-box" style="background: rgba(247, 148, 29, 0.1);"><i class="fas fa-layer-group text-primary"></i></div>
                                <h3 class="fw-black mb-3 h4">Graded Exercises</h3>
                                <p class="opacity-75 small">Structured pedagogical flow from Level 1 basics to elite Rank Booster 3.</p>
                            </div>
                            <div class="bento-bottom">
                                <span class="badge border border-primary text-primary rounded-pill px-3 py-1 very-small fw-bold">RESEARCH</span>
                            </div>
                        </div>

                        <!-- Access Protocol (Wide) -->
                        <div class="bento-item bento-item-xl bento-glass">
                            <div class="d-flex align-items-center gap-4">
                                <div class="protocol-icon text-primary"><i class="fas fa-shield-halved fs-1"></i></div>
                                <div>
                                    <h5 class="fw-black text-dark mb-1 text-uppercase tracking-wider">Access Protocol</h5>
                                    <p class="small text-muted mb-0">Digital modules are restricted to enrolled students. External requests are subject to academic review by our senior mentorship team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Request Access (Sticky) -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 140px; z-index: 5;">
                    <div class="enroll-card compact-form-container shadow-2xl bg-white border border-light border-1">
                        <div class="text-center mb-5">
                            <h3 class="fw-black mb-1 text-uppercase">Request <span class="text-primary">Vault</span></h3>
                            <p class="very-small text-muted uppercase fw-bold">Module Access <?php echo date('Y'); ?></p>
                        </div>
                        
                        <?php if(isset($_GET['status']) && $_GET['status'] == 'enquiry_sent'): ?>
                            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success fw-bold text-center small mb-4 py-2 rounded-3">
                                <i class="fas fa-check-circle me-1"></i> Request submitted successfully!
                            </div>
                        <?php elseif(isset($_GET['error'])): ?>
                            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger fw-bold text-center small mb-4 py-2 rounded-3">
                                <i class="fas fa-exclamation-circle me-1"></i> Something went wrong. Please try again.
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo BASE_URL; ?>process-enquiry.php" method="POST" class="vstack gap-3">
                            <div>
                                <input type="text" name="name" class="form-control-minimal rounded-3 w-100 border text-dark py-2 px-3" placeholder="Full Name" required>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <input type="tel" name="phone" class="form-control-minimal rounded-3 w-100 border text-dark py-2 px-3" placeholder="Mobile" required>
                                </div>
                                <div class="col-6">
                                    <select name="course" class="form-select form-control-minimal rounded-3 w-100 border text-dark py-2 px-3" style="font-size: 0.85rem;" required>
                                        <option value="Phy-Mod">Physics Modules</option>
                                        <option value="Chem-Mod">Chemistry Modules</option>
                                        <option value="Math-Mod">Math Modules</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <input type="email" name="email" class="form-control-minimal rounded-3 w-100 border text-dark py-2 px-3" placeholder="Email Address" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg">REQUEST ACCESS <i class="fas fa-unlock-alt ms-2"></i></button>
                            
                            <div class="text-center mt-3">
                                <a href="https://wa.me/919934244522" class="text-success small fw-bold text-decoration-none">
                                    <i class="fab fa-whatsapp me-2"></i> WHATSAPP HELPLINE
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-6 opacity-10">

        <!-- Section 2: Resource Repository Grid -->
        <div class="resource-catalog">
             <div class="section-title mb-5">
                <h2 class="fw-black h1">CORE <span class="text-primary">REPOSITORY</span></h2>
                <p class="text-muted">Explore subject-specific academic vault items mapped to competitive benchmarks.</p>
            </div>

            <div class="row g-5">
                <?php if (count($db_materials) > 0): ?>
                    <?php foreach($db_materials as $item): 
                        $cat = strtolower($item['category']);
                        $icon = 'fa-file-pdf';
                        $accent = 'accent-phy';
                        if (strpos($cat, 'physic') !== false) { $icon = 'fa-rocket'; $accent = 'accent-phy'; }
                        elseif (strpos($cat, 'chem') !== false) { $icon = 'fa-flask'; $accent = 'accent-che'; }
                        elseif (strpos($cat, 'math') !== false) { $icon = 'fa-square-root-alt'; $accent = 'accent-mat'; }
                        elseif (strpos($cat, 'biol') !== false) { $icon = 'fa-dna'; $accent = 'accent-bio'; }
                    ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="vault-tile text-center <?php echo $accent; ?>">
                            <div class="vault-icon-float">
                                <i class="fas <?php echo $icon; ?>"></i>
                            </div>
                            <h3 class="vault-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                            <div class="vault-tag"><?php echo htmlspecialchars($item['type']); ?></div>
                            <p class="text-muted small mb-4">Institutional graded module focusing on NCERT alignment and competitive pattern mastery.</p>
                            <a href="<?php echo BASE_URL; ?>study-material-detail.php?slug=<?php echo $item['slug']; ?>" class="vault-btn">
                                Explore Vault <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><div class="p-5 bg-light rounded-4 text-center"><p class="text-muted mb-0">Vault items are currently being curated for the <?php echo date('Y'); ?>-<?php echo date('y') + 1; ?> session.</p></div></div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>
