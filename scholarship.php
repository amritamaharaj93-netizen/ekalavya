<?php 
include 'includes/header.php'; 

// Fetch Active Scholarship Tabs
$stmt = $pdo->query("SELECT * FROM scholarship_tabs WHERE is_active = 1 ORDER BY display_order ASC");
$active_tabs = $stmt->fetchAll();

if (empty($active_tabs)) {
    // Fallback if DB is empty (unlikely after setup)
    $active_tabs = []; 
}
?>

<!-- Premium Institutional Header (WOW Treatment) -->
<section class="page-header wow-container overflow-hidden" style="background: #0a1f44;">
    <div class="wow-blob" style="top: -100px; left: -100px; background: radial-gradient(circle, rgba(247,148,29,0.2) 0%, transparent 70%);"></div>
    <div class="wow-blob" style="bottom: -100px; right: -100px; background: radial-gradient(circle, rgba(247,148,29,0.15) 0%, transparent 70%);"></div>
    
    <div class="container text-center text-white position-relative">
        <h6 class="text-primary fw-black tracking-widest mb-2 animate-up" style="font-size: clamp(0.55rem, 2.5vw, 0.7rem); letter-spacing: clamp(1px, 1vw, 3px); white-space: nowrap;">RECOGNISING TALENT • REWARDING MERIT</h6>
        <h1 class="fw-black mb-0" style="font-size: clamp(2rem, 9vw, 4.5rem); line-height: 1.1;">SCHOLARSHIP <span class="text-primary d-block d-md-inline">PORTAL 2026</span></h1>
    </div>
</section>

<!-- Main Portal Layout -->
<main class="scholarship-portal py-6 bg-white">
    <div class="container">
        
        <!-- Unique Spectrum Pathway Hub (Premium Redesign) -->
        <div class="row g-4 mb-6 justify-content-center">
            <div class="col-lg-10">
                <div class="pathway-hub-grid d-flex flex-wrap justify-content-center gap-4">
                    <?php foreach($active_tabs as $index => $t): ?>
                    <!-- <?php echo $t['tab_name']; ?> Option -->
                    <div class="pathway-card-wrapper">
                        <button class="pathway-wow-card <?php echo $index === 0 ? 'active' : ''; ?>" 
                                id="btn-<?php echo $t['tab_slug']; ?>" 
                                onclick="switchPathway('<?php echo $t['tab_slug']; ?>')" 
                                data-theme="<?php echo $t['tab_theme']; ?>">
                            <div class="wow-icon-bg"><i class="<?php echo $t['tab_icon']; ?>"></i></div>
                            <div class="wow-card-info text-center text-lg-start">
                                <h4 class="fw-black mb-0"><?php echo htmlspecialchars($t['tab_name']); ?></h4>
                                <p class="small opacity-75 mb-0"><?php echo htmlspecialchars($t['tab_label']); ?></p>
                            </div>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Right Side (HTML First for mobile top): Sticky Registration Form - WOW Redesign -->
            <div class="col-lg-4 order-lg-2">
                <div class="sticky-top" style="top: 140px; z-index: 5;">
                    <div class="registration-form-card glass-pill-premium p-4 rounded-5 shadow-2xl position-relative overflow-hidden" style="max-width: 380px; margin-left: auto;">
                        <div class="wow-blob" style="top: -50px; right: -50px; width: 200px; height: 200px; opacity: 0.2;"></div>
                        
                        <div class="text-center mb-5 position-relative">
                            <div class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">SESSION 2026-27</div>
                            <h3 class="fw-black mb-1">REGISTRATION <span class="text-primary">PORTAL</span></h3>
                            <p class="very-small text-muted uppercase fw-bold tracking-widest">Scholarship Program Admission</p>
                        </div>
                        
                        <form action="<?php echo BASE_URL; ?>process-scholarship.php" method="POST" class="vstack gap-3 position-relative">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control rounded-4 border-0 bg-light px-4" id="regName" placeholder="Full Name" required>
                                <label for="regName" class="small text-muted px-4">Full Name</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" name="email" class="form-control rounded-4 border-0 bg-light px-4" id="regEmail" placeholder="Email Address" required>
                                <label for="regEmail" class="small text-muted px-4">Email Address</label>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="tel" name="phone" class="form-control rounded-4 border-0 bg-light px-4" id="regPhone" placeholder="Mobile" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        <label for="regPhone" class="small text-muted px-4">Phone</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="program" class="form-select rounded-4 border-0 bg-light px-4" id="regClass" required>
                                            <option value="IIT-JEE">IIT-JEE</option>
                                            <option value="NEET">NEET</option>
                                            <option value="School Prep (Class 7th)">School Prep (Class 7th)</option>
                                            <option value="School Prep (Class 8th)">School Prep (Class 8th)</option>
                                            <option value="School Prep (Class 9th)">School Prep (Class 9th)</option>
                                            <option value="School Prep (Class 10th)">School Prep (Class 10th)</option>
                                            <option value="School Prep (Class 11th)">School Prep (Class 11th)</option>
                                            <option value="School Prep (Class 12th)">School Prep (Class 12th)</option>
                                        </select>
                                        <label for="regClass" class="small text-muted px-4">Program</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating">
                                <select name="scholarship_type" class="form-select rounded-4 border-0 bg-light px-4" id="regType" required>
                                    <option value="ESAT">Scholarship Test (ESAT)</option>
                                    <option value="EMRS">Merit Based (EMRS)</option>
                                    <option value="EARLY_BIRD">Early Bird Benefits</option>
                                </select>
                                <label for="regType" class="small text-muted px-4">Apply For</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-4 rounded-pill fw-black shadow-lg text-uppercase tracking-wider mt-3" style="font-size: 0.9rem;">
                                REGISTER NOW <i class="fas fa-paper-plane ms-2"></i>
                            </button>

                            <div class="text-center mt-4">
                                <a href="https://wa.me/919934244522" class="text-success small fw-bold text-decoration-none d-flex align-items-center justify-content-center gap-2">
                                    <i class="fab fa-whatsapp fs-5"></i> WHATSAPP ADMISSION HELPLINE
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Left Side: Detailed Content -->
            <div class="col-lg-8 order-lg-1">
                
                <?php foreach($active_tabs as $index => $t): ?>
                <?php 
                    $blocks = json_decode($t['content_json'] ?? '[]', true);
                    $is_esat_style = ($t['layout_type'] === 'accordion'); 
                ?>
                <!-- <?php echo $t['tab_name']; ?> Section -->
                <div id="<?php echo $t['tab_slug']; ?>-content" class="pathway-content <?php echo $index === 0 ? '' : 'd-none'; ?>">
                    <div class="section-title mb-5 text-center text-lg-start">
                        <h2 class="fw-black text-dark h1"><?php echo $t['title']; ?></h2>
                        <?php if(!empty($t['subtitle'])): ?>
                            <h5 class="text-primary fw-bold mb-4"><?php echo htmlspecialchars($t['subtitle']); ?></h5>
                        <?php endif; ?>
                        <div class="text-muted lead px-2 px-lg-0"><?php echo nl2br($t['description']); ?></div>
                    </div>

                    <?php if($is_esat_style): ?>
                        <?php $clean_slug = str_replace(' ', '-', $t['tab_slug']); ?>
                        <div class="accordion accordion-wow" id="<?php echo $clean_slug; ?>Accordion">
                            <?php foreach($blocks as $bIndex => $block): ?>
                            <div class="accordion-item mb-4 border-0 rounded-5 overflow-hidden shadow-sm glass-pill-premium position-relative">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $bIndex === 0 ? '' : 'collapsed'; ?> fw-black text-dark py-4 px-3 px-md-5 bg-transparent d-flex flex-column flex-md-row align-items-center text-center text-md-start" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $clean_slug . $bIndex; ?>">
                                        <span class="wow-icon-wrap me-0 me-md-4 mb-3 mb-md-0" style="width: 50px; height: 50px; border-radius: 15px;"><i class="<?php echo $block['icon']; ?> text-primary"></i></span> 
                                        <?php echo htmlspecialchars($block['title']); ?>
                                    </button>
                                </h2>
                                <div id="<?php echo $clean_slug . $bIndex; ?>" class="accordion-collapse collapse <?php echo $bIndex === 0 ? 'show' : ''; ?>" data-bs-parent="#<?php echo $clean_slug; ?>Accordion">
                                    <div class="accordion-body px-5 pb-5 pt-0 text-muted">
                                        <?php echo $block['content']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="vstack gap-4">
                            <?php foreach($blocks as $block): ?>
                            <div class="emrs-feature p-4 border rounded-5 hover-bg-light transition-all">
                                <h6 class="fw-black text-dark mb-2"><i class="<?php echo $block['icon']; ?> text-primary me-2"></i> <?php echo htmlspecialchars($block['title']); ?></h6>
                                <div class="small text-muted mb-0"><?php echo $block['content']; ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($t['tab_slug'] === 'emrs'): ?>
                        <div class="mt-5 text-center">
                            <button onclick="switchPathway('esat')" class="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow-lg scale-hover border-0" style="background: var(--dark-navy);">
                                <i class="fas fa-eye me-2"></i> View ESAT Scholarship Program
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</main>

<style>
.pathway-wow-card {
    background: #fff;
    border: 1px solid #eee;
    padding: 25px 35px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    cursor: pointer;
    transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    position: relative;
    overflow: hidden;
    min-width: 280px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.pathway-wow-card .wow-icon-bg {
    width: 60px;
    height: 60px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.4s ease;
    background: #f8f9fa;
}

.pathway-wow-card .wow-card-info {
    text-align: left;
}

.pathway-wow-card.active,
.pathway-wow-card:hover {
    background: #0a1f44;
    color: #fff !important;
    border-color: #0a1f44;
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(10,31,68,0.2);
}

.pathway-wow-card.active h4,
.pathway-wow-card:hover h4 {
    color: #fff !important;
}

/* Icon Themes for Active and Hover */
.pathway-wow-card[data-theme="orange"].active .wow-icon-bg,
.pathway-wow-card[data-theme="orange"]:hover .wow-icon-bg { background: var(--primary-color); color: #fff; box-shadow: 0 10px 20px rgba(247,148,29,0.3); }

.pathway-wow-card[data-theme="blue"].active .wow-icon-bg,
.pathway-wow-card[data-theme="blue"]:hover .wow-icon-bg { background: #007bff; color: #fff; box-shadow: 0 10px 20px rgba(0,123,255,0.3); }

.pathway-wow-card[data-theme="green"].active .wow-icon-bg,
.pathway-wow-card[data-theme="green"]:hover .wow-icon-bg { background: #28a745; color: #fff; box-shadow: 0 10px 20px rgba(40,167,69,0.3); }



.pathway-wow-card:hover .wow-icon-bg {
    transform: scale(1.1) rotate(5deg);
}

/* Accordion Custom Enhancements */
.accordion-wow .accordion-button:focus,
.accordion-wow .accordion-button:not(.collapsed) {
    box-shadow: none !important;
    background-color: transparent !important;
}

.accordion-wow .accordion-body {
    border-top: 1px solid rgba(0, 0, 0, 0.08);
    margin-top: 0.5rem;
    padding-top: 2rem !important;
}

/* Global Bullet Point Styling for Accordion Content */
.accordion-wow .accordion-body ul {
    list-style: none !important;
    padding-left: 0 !important;
}

.accordion-wow .accordion-body ul li, 
.accordion-wow .accordion-body p,
.accordion-wow .accordion-body div {
    position: relative;
    padding-left: 35px !important;
    margin-bottom: 12px !important;
    display: block !important;
    font-weight: 500;
    line-height: 1.6;
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    padding-right: 0 !important;
    min-height: auto !important;
}

.accordion-wow .accordion-body ul li::before, 
.accordion-wow .accordion-body p::before,
.accordion-wow .accordion-body div::before {
    content: "\f058";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    left: 0;
    top: 2px;
    color: var(--primary-color) !important;
    font-size: 1.1rem;
}

/* Hide bullets for empty elements or containers that should just pass through */
.accordion-wow .accordion-body li:empty::before, 
.accordion-wow .accordion-body p:empty::before,
.accordion-wow .accordion-body div:empty::before,
.accordion-wow .accordion-body li:has(> br:only-child)::before, 
.accordion-wow .accordion-body p:has(> br:only-child)::before,
.accordion-wow .accordion-body div:has(> br:only-child)::before { 
    display: none !important; 
}

/* Hide bullets for elements that have no text (only empty tags or whitespace) */
.accordion-wow .accordion-body p:not(:has(text)),
.accordion-wow .accordion-body li:not(:has(text)) {
    /* Note: standard CSS doesn't have :has(text), so we use a different approach */
}

/* More robust empty-ish element hiding */
.accordion-wow .accordion-body p:empty,
.accordion-wow .accordion-body p:blank,
.accordion-wow .accordion-body li:empty,
.accordion-wow .accordion-body li:blank,
.accordion-wow .accordion-body p:has(br:only-child),
.accordion-wow .accordion-body li:has(br:only-child) {
    display: none !important;
}

/* Safety: if the element is somehow rendered but has no height, hide the bullet */
.accordion-wow .accordion-body p, 
.accordion-wow .accordion-body li {
    min-height: 1px;
}
</style>

<script>
function switchPathway(id) {
    // Buttons
    document.querySelectorAll('.pathway-wow-card').forEach(btn => btn.classList.remove('active'));
    
    const targetBtn = document.getElementById('btn-' + id);
    if(targetBtn) targetBtn.classList.add('active');

    // Content
    document.querySelectorAll('.pathway-content').forEach(content => content.classList.add('d-none'));
    const targetContent = document.getElementById(id + '-content');
    if(targetContent) targetContent.classList.remove('d-none');

    // Update Form Type Dropdown
    const regType = document.getElementById('regType');
    if(regType) regType.value = id.toUpperCase();
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const path = urlParams.get('path');
    if (path) {
        switchPathway(path);
    }
}
</script>

<?php include 'includes/footer.php'; ?>
