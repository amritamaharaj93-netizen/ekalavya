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
                    <div class="request-vault-card p-4 p-md-5 rounded-5 bg-white shadow-2xl border border-light text-center position-relative overflow-hidden">
                        <div class="vault-header mb-4">
                            <h3 class="fw-black mb-1 text-uppercase tracking-tight" style="font-size: 1.8rem; color: #1a1a1a;">REQUEST <span style="color: #f7941d;">VAULT</span></h3>
                            <p class="text-muted small fw-bold tracking-widest opacity-75">Module Access <?php echo date('Y'); ?></p>
                        </div>
                        
                        <?php if(isset($_GET['status']) && $_GET['status'] == 'enquiry_sent'): ?>
                            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success fw-bold text-center small mb-4 py-2 rounded-3">
                                <i class="fas fa-check-circle me-1"></i> Request submitted successfully!
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo BASE_URL; ?>process-enquiry.php" method="POST" class="vstack gap-3">
                            <div class="vault-input-group">
                                <input type="text" name="name" class="vault-input w-100 mb-3" placeholder="Full Name" required>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="tel" name="phone" class="vault-input w-100" placeholder="Mobile" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    </div>
                                    <div class="col-6">
                                        <select name="course" class="vault-input w-100 text-muted" style="appearance: none; -webkit-appearance: none; background: #f8f9fa url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23666%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.4-12.8z%22/%3E%3C/svg%3E') no-repeat right 15px center/10px auto;" required>
                                            <option value="" disabled selected>Subject</option>
                                            <option value="Physics Modules">Physics Modules</option>
                                            <option value="Chemistry Modules">Chemistry Modules</option>
                                            <option value="Math Modules">Math Modules</option>
                                            <option value="Biology Modules">Biology Modules</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <input type="email" name="email" class="vault-input w-100" placeholder="Email Address" required>
                            </div>

                            <button type="submit" class="btn btn-vault-access w-100 py-3 rounded-pill fw-black shadow-lg mt-3 text-uppercase position-relative">
                                REQUEST ACCESS <i class="fas fa-lock ms-2 opacity-50"></i>
                            </button>
                            
                            <div class="mt-4">
                                <a href="https://wa.me/919934244522" target="_blank" class="text-success fw-bold text-decoration-none small d-flex align-items-center justify-content-center gap-2">
                                    <i class="fab fa-whatsapp fs-5"></i> WHATSAPP HELPLINE
                                </a>
                            </div>
                        </form>
                    </div>

                    <style>
                        .request-vault-card { transition: transform 0.3s ease; }
                        .vault-input {
                            background: #f8f9fa;
                            border: 1px solid #eee;
                            padding: 15px 20px;
                            border-radius: 12px;
                            font-size: 0.95rem;
                            font-weight: 500;
                            color: #444;
                            transition: all 0.3s ease;
                        }
                        .vault-input:focus {
                            outline: none;
                            background: #fff;
                            border-color: #f7941d;
                            box-shadow: 0 0 0 4px rgba(247, 148, 29, 0.05);
                        }
                        .vault-input::placeholder {
                            color: #888;
                            opacity: 0.8;
                        }
                        .btn-vault-access {
                            background: #f7941d;
                            color: #fff;
                            border: none;
                            letter-spacing: 0.5px;
                            font-size: 1rem;
                            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                        }
                        .btn-vault-access:hover {
                            background: #e68512;
                            color: #fff;
                            transform: translateY(-3px) scale(1.02);
                            box-shadow: 0 15px 30px rgba(247, 148, 29, 0.3) !important;
                        }
                        .shadow-2xl {
                            box-shadow: 0 25px 60px -12px rgba(10, 31, 68, 0.12);
                        }
                    </style>
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
                    <?php if ($category == 'NCERT' || empty($category)): ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="vault-tile text-center accent-che" style="border-color: #00b894;">
                            <div class="vault-icon-float">
                                <i class="fas fa-flask"></i>
                            </div>
                            <h3 class="vault-title">NCERT Complete Solutions & Roadmap</h3>
                            <div class="vault-tag">Notes</div>
                            <p class="text-muted small mb-4">Institutional graded module focusing on NCERT alignment and competitive pattern mastery.</p>
                            <a href="<?php echo BASE_URL; ?>study-material-detail.php?slug=ncert-complete-solutions-roadmap" class="vault-btn">
                                Explore Vault <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($category == 'HC-Verma' || empty($category)): ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="vault-tile text-center accent-phy" style="border-color: #f7941d;">
                            <div class="vault-icon-float">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h3 class="vault-title">HC Verma Concepts & Solutions</h3>
                            <div class="vault-tag">PDF</div>
                            <p class="text-muted small mb-4">Institutional graded module focusing on NCERT alignment and competitive pattern mastery.</p>
                            <a href="<?php echo BASE_URL; ?>study-material-detail.php?slug=hc-verma-concepts-solutions" class="vault-btn">
                                Explore Vault <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($category) && $category != 'NCERT' && $category != 'HC-Verma'): ?>
                        <div class="col-12"><div class="p-5 bg-light rounded-4 text-center"><p class="text-muted mb-0">Vault items are currently being curated for the <?php echo date('Y'); ?>-<?php echo date('y') + 1; ?> session.</p></div></div>
                    <?php elseif (empty($category) && count($db_materials) == 0): ?>
                        <div class="col-12"><div class="p-5 bg-light rounded-4 text-center"><p class="text-muted mb-0">Vault items are currently being curated for the <?php echo date('Y'); ?>-<?php echo date('y') + 1; ?> session.</p></div></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>
