<?php 
require_once 'config/database.php';
include 'includes/header.php'; 
?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.7)), url('<?php echo BASE_URL; ?>assets/images/scholarship_header.png') center/cover no-repeat; padding: 40px 0 !important;">
    <div class="container text-center text-white">
        <h1 class="h3 fw-black mb-2 text-uppercase">EKALAVYA SCHOLARSHIP <span class="text-primary">Program- 2026</span></h1>
        <div class="text-primary fw-bold tracking-widest mb-3 animate-up" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px;">Recognising Talent. Rewarding Merit.</div>
        <p class="text-white mb-0 opacity-90 fs-5 fw-bold">🎓 Win up to 100% Scholarship on courses for NEET, JEE & Classes 7-10.</p>
    </div>
</section>

<!-- Main Scholarship Pathways -->
<section class="scholarship-pathways py-6 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="pathway-container p-5 rounded-5 shadow-2xl position-relative overflow-hidden" style="background-color: #ffffff; border: 1px solid rgba(0,0,0,0.05);">
                    <div class="text-center mb-5">
                        <div class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3 fw-black tracking-widest shadow-sm">SCHOLARSHIP PATHWAYS</div>
                        <h2 class="fw-black mb-0 display-6">SECURE YOUR <span class="text-primary">FUTURE</span></h2>
                    </div>
                    
                    <div class="position-relative mt-5">
                        <div class="row g-4 align-items-stretch">
                            <!-- Pathway 1: ESAT -->
                            <div class="col-md-5">
                                <div class="h-100 p-5 position-relative overflow-hidden group transition-all hover-translate-y text-start" style="background: linear-gradient(145deg, #ffffff, #f8fafc); border: 2px solid #e2e8f0; border-radius: 30px;">
                                    <div class="position-absolute top-0 end-0 p-4 opacity-10 transition-all group-hover-opacity-20">
                                        <i class="fas fa-file-signature text-primary" style="font-size: 7rem; transform: rotate(-15deg) translateY(-20px);"></i>
                                    </div>
                                    <div class="mb-4 bg-primary text-white d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 55px; height: 55px; font-size: 1.5rem; font-weight: 800;">
                                        1
                                    </div>
                                    <h4 class="fw-black text-dark mb-3" style="font-size: 1.5rem;">ESAT <span class="text-primary">2026</span></h4>
                                    <p class="text-muted fw-semibold mb-0" style="line-height: 1.8;">Appear in the Ekalavya Scholarship Admission Test and secure up to 100% scholarship on our premium courses.</p>
                                </div>
                            </div>
                            
                            <!-- OR Divider -->
                            <div class="col-md-2 d-flex align-items-center justify-content-center position-relative py-4 py-md-0">
                                <div class="d-none d-md-block position-absolute h-100 border-start" style="border-color: #cbd5e1 !important; border-style: dashed !important; border-width: 2px !important;"></div>
                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm position-relative z-1 fw-black text-secondary" style="width: 60px; height: 60px; border: 2px solid #e2e8f0; font-size: 1.2rem;">
                                    OR
                                </div>
                            </div>
                            
                            <!-- Pathway 2: Direct Admission -->
                            <div class="col-md-5">
                                <div class="h-100 p-5 position-relative overflow-hidden group transition-all hover-translate-y text-start" style="background: linear-gradient(145deg, #ffffff, #f8fafc); border: 2px solid #e2e8f0; border-radius: 30px;">
                                    <div class="position-absolute top-0 end-0 p-4 opacity-10 transition-all group-hover-opacity-20">
                                        <i class="fas fa-medal text-dark" style="font-size: 7rem; transform: rotate(15deg) translateY(-20px);"></i>
                                    </div>
                                    <div class="mb-4 bg-dark text-white d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 55px; height: 55px; font-size: 1.5rem; font-weight: 800;">
                                        2
                                    </div>
                                    <h4 class="fw-black text-dark mb-3" style="font-size: 1.5rem;">Direct Scholarship</h4>
                                    <p class="text-muted fw-semibold mb-4" style="line-height: 1.8;">Avail scholarship directly based on your performance in qualifying board or competitive exams.</p>
                                    <div class="d-flex gap-2 flex-wrap position-relative z-1">
                                        <span class="badge bg-white text-secondary border px-3 py-2 fw-bold shadow-sm">NEET</span>
                                        <span class="badge bg-white text-secondary border px-3 py-2 fw-bold shadow-sm">JEE</span>
                                        <span class="badge bg-white text-secondary border px-3 py-2 fw-bold shadow-sm">Olympiads</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5 pt-4">
                        <div class="d-inline-flex align-items-center gap-2 mb-4 px-4 py-2 rounded-pill shadow-sm" style="background: #fff7ed; border: 1px solid #fed7aa; color: #ea580c;">
                            <div class="spinner-grow spinner-grow-sm" role="status" style="width: 0.6rem; height: 0.6rem;"></div>
                            <span class="fw-bold tracking-wider text-uppercase" style="font-size: 0.8rem;">Limited Seats | Early Registration Recommended</span>
                        </div>
                        
                        <div>
                            <a href="<?php echo BASE_URL; ?>scholarship.php" class="btn btn-primary btn-lg rounded-pill px-5 py-4 fw-black text-uppercase tracking-wider shadow-glow hover-translate-y transition-all" style="font-size: 1rem;">
                                Register Now <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-banner py-6 text-white text-center position-relative overflow-hidden" style="background-color: #0C1028;">
    <div class="container position-relative z-index-2">
        <h2 class="display-5 fw-black mb-4 text-uppercase text-white">Take the First Step Towards <span class="text-warning">Excellence</span></h2>
        <p class="fs-5 opacity-75 mb-5 max-width-700 mx-auto">Register for the upcoming Scholarship Exam and secure your seat in our premium batches for 2026-27.</p>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="<?php echo BASE_URL; ?>scholarship.php" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-black shadow-lg">REGISTER FOR ESAT 2026</a>
            <a href="https://wa.me/919934244522" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold border-2">TALK TO A COUNSELOR</a>
        </div>
    </div>
    <!-- Background Accents -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
</section>

<style>
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hover-translate-y:hover {
    transform: translateY(-10px);
}
.bg-purple { background-color: #6c5ce7; }
.bg-orange-soft { background-color: #ffeaa7; }
</style>

<?php include 'includes/footer.php'; ?>
