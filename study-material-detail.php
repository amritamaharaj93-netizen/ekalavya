<?php 
include_once 'config/database.php';

// Fetch study material details
$material = null;
if (isset($_GET['slug'])) {
    $stmt = $pdo->prepare("SELECT * FROM study_material WHERE slug = :slug");
    $stmt->execute(['slug' => $_GET['slug']]);
    $material = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM study_material WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['id']]);
    $material = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Redirect if not found
if (!$material) {
    header('Location: ' . BASE_URL . 'study-material.php');
    exit();
}

include 'includes/header.php';

$cat = strtolower($material['category']);
$icon = 'fa-file-pdf';
if (strpos($cat, 'physic') !== false) { $icon = 'fa-rocket'; }
elseif (strpos($cat, 'chem') !== false) { $icon = 'fa-flask'; }
elseif (strpos($cat, 'math') !== false) { $icon = 'fa-square-root-alt'; }
elseif (strpos($cat, 'biol') !== false) { $icon = 'fa-dna'; }
?>

<!-- Professional Page Header -->
<section class="page-header study-vault-header" style="padding: 40px 0 !important;">
    <div class="container text-center">
        <h1 class="mb-0"><?php echo htmlspecialchars($material['title']); ?></h1>
    </div>
</section>

<!-- Detail Ecosystem -->
<section class="material-detail-body py-6 bg-white">
    <div class="container container-1440">
        <div class="row g-5">
            <!-- Left Column: Knowledge -->
            <div class="col-lg-8">
                <div class="detail-main-content pe-lg-4">
                    
                    <!-- Overview Section -->
                    <div class="overview-section mb-6">
                        <div class="d-flex align-items-center gap-3 mb-4">
                             <div class="icon-portal bg-primary text-white p-3 rounded-4 shadow-lg">
                                 <i class="fas <?php echo $icon; ?> fs-3"></i>
                             </div>
                             <div>
                                 <h2 class="fw-black mb-0">MODULE <span class="text-primary">INSIGHTS</span></h2>
                                 <p class="text-muted small mb-0">Comprehensive coverage of <?php echo htmlspecialchars($material['title']); ?></p>
                             </div>
                        </div>

                        <div class="description-text lead text-muted mb-5">
                            Expertly crafted educational resources designed by senior faculty to bridge the gap between classroom teaching and competitive examination patterns. This module features graded exercises and conceptual theory maps.
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="premium-feature-pill d-flex align-items-center gap-4 p-4 rounded-5 bg-white border border-light shadow-sm transition-all hover-translate-y">
                                    <div class="feature-icon bg-orange-soft text-primary rounded-circle d-flex align-items-center justify-content-center shadow-inner" style="width: 65px; height: 65px; flex-shrink: 0;">
                                        <i class="fas fa-check-double fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-black mb-1">NCERT Aligned</h6>
                                        <p class="very-small text-muted mb-0">Strictly follows the latest NTA/CBSE syllabus benchmarks.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="premium-feature-pill d-flex align-items-center gap-4 p-4 rounded-5 bg-white border border-light shadow-sm transition-all hover-translate-y">
                                    <div class="feature-icon bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center shadow-inner" style="width: 65px; height: 65px; flex-shrink: 0;">
                                        <i class="fas fa-pencil-ruler fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-black mb-1">Solved Examples</h6>
                                        <p class="very-small text-muted mb-0">Step-by-step solutions to past year competitive problems.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Roadmap section -->
                    <div class="roadmap-section mb-6 wow-container">
                        <!-- Decorative Blobs -->
                        <div class="wow-blob" style="top: -50px; left: -100px;"></div>
                        <div class="wow-blob" style="bottom: -50px; right: -100px; background: radial-gradient(circle, rgba(10,31,68, 0.05) 0%, transparent 70%);"></div>

                        <div class="section-title-wrap d-flex align-items-center gap-3 mb-5">
                            <h2 class="fw-black mb-0">ACADEMIC <span class="text-primary">DEPTH</span></h2>
                            <div class="flex-grow-1 border-top opacity-10"></div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="glass-pill-premium h-100 position-relative overflow-hidden text-center">
                                    <div class="wow-icon-wrap mx-auto">
                                        <i class="fas fa-map-marked-alt fs-2 text-primary"></i>
                                    </div>
                                    <div class="mastery-tag-wow">Foundational</div>
                                    <h4 class="fw-black mb-3">Theory Map</h4>
                                    <p class="very-small text-muted mb-0">Visual summary of all core concepts and formulas mapping to JEE/NEET weightage.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="glass-pill-premium h-100 position-relative overflow-hidden text-center">
                                    <div class="wow-icon-wrap mx-auto">
                                        <i class="fas fa-tasks fs-2 text-primary"></i>
                                    </div>
                                    <div class="mastery-tag-wow">Application</div>
                                    <h4 class="fw-black mb-3">Graded MCQ</h4>
                                    <p class="very-small text-muted mb-0">Exercises meticulously categorized from conceptual basics to elite rank-booster levels.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="glass-pill-premium h-100 position-relative overflow-hidden text-center">
                                    <div class="wow-icon-wrap mx-auto">
                                        <i class="fas fa-brain fs-2 text-primary"></i>
                                    </div>
                                    <div class="mastery-tag-wow">Revision</div>
                                    <h4 class="fw-black mb-3">Mind Maps</h4>
                                    <p class="very-small text-muted mb-0">Specialized cognitive flowcharts designed for rapid active recall during exam cycles.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 140px; z-index: 5;">
                    <!-- Request Vault - High Fidelity Portal -->
                    <div class="request-vault-card p-4 p-md-5 rounded-5 bg-white shadow-2xl border border-light text-center position-relative overflow-hidden">
                        <div class="vault-header mb-4">
                            <h3 class="fw-black mb-1 text-uppercase tracking-tight" style="font-size: 1.8rem; color: #1a1a1a;">REQUEST <span style="color: #f7941d;">VAULT</span></h3>
                            <p class="text-muted small fw-bold tracking-widest opacity-75">Module Access 2026</p>
                        </div>
                        
                        <form action="<?php echo BASE_URL; ?>process-enquiry.php" method="POST" class="vstack gap-3">
                            <input type="hidden" name="course" value="Module Access: <?php echo htmlspecialchars($material['title']); ?>">
                            
                            <div class="vault-input-group">
                                <input type="text" name="name" class="vault-input w-100 mb-3" placeholder="Full Name" required>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="tel" name="phone" class="vault-input w-100" placeholder="Mobile" required>
                                    </div>
                                    <div class="col-6">
                                        <select class="vault-input w-100 text-muted" style="appearance: none; -webkit-appearance: none; background: #f8f9fa url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23666%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.4-12.8z%22/%3E%3C/svg%3E') no-repeat right 15px center/10px auto;">
                                            <option selected><?php echo htmlspecialchars($material['category']); ?></option>
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
    </div>
</section>

<?php include 'includes/footer.php'; ?>
