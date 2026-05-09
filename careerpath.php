<?php 
require_once 'config/database.php';
include 'includes/header.php'; 

// Fetch Career Path Data
$features = $pdo->query("SELECT * FROM career_features ORDER BY created_at ASC")->fetchAll();
$journey = $pdo->query("SELECT * FROM career_journey ORDER BY step_number ASC")->fetchAll();
?>

<!-- Premium Institutional Header -->
<section class="page-header career-header" style="background: linear-gradient(rgba(10, 31, 68, 0.9), rgba(10, 31, 68, 0.7)), url('assets/images/career_bg.png') center/cover no-repeat; padding: 20px 0 !important;">
    <div class="container text-center text-white">
        <h1 class="display-6 fw-black mb-2">Career<span class="text-warning">Path</span></h1>
        
        <a href="https://forms.gle/sk9u8trC6YiQ5Jwy6" target="_blank" class="btn btn-warning px-4 py-2 rounded-pill fw-black shadow-lg small">
            BOOK FREE GUIDANCE SESSION <i class="fas fa-external-link-alt ms-2"></i>
        </a>
    </div>
</section>

<!-- Content Section -->
<main class="career-portal py-6 bg-white">
    <div class="container">
        
        <div class="row g-5 align-items-center mb-6">
            <div class="col-lg-6">
                <div class="section-title mb-5">
                    <h2 class="fw-black text-dark h1">WHY <span class="text-primary">CAREERPATH?</span></h2>
                    <p class="text-muted lead">Whether you're a student or a working professional, we help you make informed decisions for a successful career!</p>
                </div>
                
                <div class="row g-4">
                    <?php if($features): ?>
                        <?php foreach($features as $f): ?>
                        <div class="col-sm-6">
                            <div class="premium-feature-card p-4 h-100">
                                <div class="pf-icon"><i class="<?php echo htmlspecialchars($f['icon']); ?>"></i></div>
                                <h5 class="fw-black mb-2 text-white fs-6"><?php echo htmlspecialchars($f['title']); ?></h5>
                                <p class="small text-slate mb-0"><?php echo htmlspecialchars($f['description']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Features coming soon.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Image Box -->
                <div class="career-image-wrap p-3 bg-light rounded-5 shadow-sm">
                    <img src="assets/images/careerpath.png" alt="CareerPath Poster" class="img-fluid rounded-4 shadow">
                    <!-- Note: If the image above doesn't load, please upload the provided poster as assets/images/careerpath.png -->
                </div>
            </div>
        </div>

        <!-- 4 Steps Section -->
        <div class="section-title text-center mb-5 mt-6">
            <h2 class="fw-black h1">THE GUIDANCE <span class="text-primary">JOURNEY</span></h2>
            <p class="text-muted">A systematic 4-step approach to securing your professional future.</p>
        </div>

        <div class="row g-4 mb-6">
            <?php if($journey): ?>
                <?php foreach($journey as $j): ?>
                <?php $pts = json_decode($j['points_json'], true); ?>
                <div class="col-md-6 col-lg-3">
                    <div class="journey-card p-4 rounded-5 border h-100 position-relative overflow-hidden">
                        <div class="journey-number"><?php echo htmlspecialchars($j['step_number']); ?></div>
                        <h5 class="fw-black mb-3"><?php echo htmlspecialchars($j['title']); ?></h5>
                        <ul class="list-unstyled small text-muted vstack gap-2">
                            <?php foreach($pts as $pt): ?>
                                <li><i class="fas fa-caret-right text-primary me-2"></i> <?php echo htmlspecialchars($pt); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted">Journey steps coming soon.</div>
            <?php endif; ?>
        </div>

        <!-- Pricing Section -->
        <div class="pricing-banner p-4 p-md-5 rounded-5 bg-dark text-white text-center shadow-lg position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 p-4 opacity-10"><i class="fas fa-gift display-1"></i></div>
            <h4 class="text-warning fw-bold mb-3 small tracking-widest text-uppercase">Affordable Investment in your Future!</h4>
            <h2 class="fw-black mb-3 text-white">JUST ₹9999/- <small class="fs-6 opacity-50">only!</small></h2>
            <p class="lead mb-4">Get this exclusive plan valid for <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">1 to 2 Years</span></p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="https://forms.gle/sk9u8trC6YiQ5Jwy6" target="_blank" class="btn btn-primary px-4 px-md-5 py-3 rounded-pill fw-black">REGISTER NOW</a>
                <a href="https://wa.me/919934244522" class="btn btn-outline-light px-4 px-md-5 py-3 rounded-pill fw-bold"><i class="fab fa-whatsapp me-2"></i> WHATSAPP US</a>
            </div>
            <p class="mt-4 very-small opacity-50">Invest today. Achieve tomorrow. Your Dream Career, Our Mission!</p>
        </div>

    </div>
</main>

<style>
.career-header {
    background-blend-mode: multiply;
}
.journey-card {
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    background: #fff;
    border: 1px solid #edf2f7 !important;
    z-index: 1;
}
.journey-card:hover {
    border-color: var(--primary-color) !important;
    transform: translateY(-12px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.08);
}
.journey-number {
    width: 50px;
    height: 50px;
    background: var(--primary-color);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 1.2rem;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 10px 20px rgba(var(--primary-rgb), 0.2);
    position: relative;
    top: 0;
    right: 0;
}
.journey-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.02) 0%, transparent 100%);
    z-index: -1;
}
.pricing-banner {
    background: linear-gradient(45deg, #0a1f44, #1a3a6d) !important;
}
.feature-box {
    transition: all 0.3s ease;
}
.feature-box:hover {
    background: #f8f9fa;
    border-color: var(--primary-color) !important;
}

/* Premium Feature Cards for CareerPath */
.premium-feature-card {
    background: linear-gradient(145deg, #0f172a, #1e293b);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.05);
    transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    z-index: 1;
}
.premium-feature-card::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(249,115,22,0.2) 0%, rgba(249,115,22,0) 70%);
    border-radius: 50%;
    z-index: -1;
    transition: all 0.5s ease;
}
.premium-feature-card:hover::before {
    transform: scale(1.5);
    background: radial-gradient(circle, rgba(249,115,22,0.3) 0%, rgba(249,115,22,0) 70%);
}
.premium-feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(15,23,42,0.2);
    border-color: rgba(249,115,22,0.3);
}
.pf-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #f97316, #ea580c);
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(249,115,22,0.3);
    transition: all 0.4s ease;
}
.premium-feature-card:hover .pf-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 25px rgba(249,115,22,0.5);
}
.text-slate {
    color: #94a3b8;
}
</style>

<?php include 'includes/footer.php'; ?>
