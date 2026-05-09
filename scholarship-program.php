<?php 
require_once 'config/database.php';
include 'includes/header.php'; 
?>

<!-- Premium Institutional Hero Section -->
<section class="scholarship-hero py-6 bg-white overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Content -->
            <div class="col-lg-7 text-center text-lg-start">
                <div class="badge bg-warning text-dark px-3 py-2 rounded-2 mb-4 fw-bold shadow-sm" style="font-size: 0.75rem;">SESSION 2026-27</div>
                
                <h1 class="fw-black mb-1" style="font-size: clamp(2rem, 5vw, 3.5rem); letter-spacing: -1px;">
                    EKALAVYA SCHOLARSHIP <span class="text-primary">Program- 2026</span>
                </h1>
                
                <div class="text-muted fw-bold mb-5 tracking-widest" style="font-size: 0.9rem;">
                    Recognising Talent. Rewarding Merit.
                </div>

                <div class="scholarship-bullet mb-5">
                    <p class="fs-5 fw-bold text-dark d-flex align-items-center justify-content-center justify-content-lg-start gap-3">
                        <i class="fas fa-graduation-cap text-primary"></i> 
                        Win up to <span class="text-primary">100% Scholarship</span> on NEET, JEE & Classes 7-12.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3 mt-4">
                    <a href="scholarship.php?path=esat" class="btn btn-dark rounded-pill px-5 py-3 fw-black text-uppercase shadow-lg hover-translate-y" style="background: #0C1028; font-size: 0.9rem;">ESAT</a>
                    <a href="scholarship.php?path=emrs" class="btn btn-dark rounded-pill px-5 py-3 fw-black text-uppercase shadow-lg hover-translate-y" style="background: #0C1028; font-size: 0.9rem;">EMRS</a>
                    <a href="scholarship.php?path=early_bird" class="btn btn-dark rounded-pill px-5 py-3 fw-black text-uppercase shadow-lg hover-translate-y" style="background: #0C1028; font-size: 0.9rem;">EARLY BIRD</a>
                </div>
            </div>

            <!-- Right Side: Student Image -->
            <div class="col-lg-5 mt-5 mt-lg-0 text-center">
                <div class="position-relative d-inline-block">
                    <!-- Subtle Background Blob -->
                    <div class="position-absolute top-50 start-50 translate-middle bg-primary opacity-10" style="width: 120%; height: 120%; border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; filter: blur(50px);"></div>
                    <img src="<?php echo BASE_URL; ?>assets/images/thumbs_up_student.png" alt="Scholarship Student" class="img-fluid position-relative z-1" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hover-translate-y:hover {
    transform: translateY(-5px);
}
.fw-black { font-weight: 900; }
.text-primary { color: #f7941d !important; }
.bg-primary { background-color: #f7941d !important; }
</style>

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
