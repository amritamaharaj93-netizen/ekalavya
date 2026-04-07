<?php include 'includes/header.php'; ?>

<!-- Hero Section: Resource Hub -->
<section class="page-hero bg-primary position-relative overflow-hidden py-5 text-white">
    <div class="container py-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold">E-RESOURCE LIBRARY</span>
                <h1 class="display-3 fw-black mb-4">Academic <span class="text-white opacity-75">Armor</span></h1>
                <p class="lead opacity-90 mb-5">Access the most comprehensive, scientifically-structured study materials designed by senior IITians. From micro-topic modules to complete revision mindmaps, we arm you for every challenge.</p>
                <div class="d-flex gap-3">
                    <a href="#physics" class="btn btn-light btn-lg px-4 rounded-pill fw-bold text-primary shadow-lg">Download Physics PDF <i class="fas fa-file-pdf ms-2"></i></a>
                    <a href="#all" class="btn btn-outline-light btn-lg px-4 rounded-pill fw-bold text-white shadow-lg">Browse Library</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-visual text-end">
                    <i class="fas fa-book-reader opacity-10" style="font-size: 350px; transform: rotate(-15deg);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Resource Catalog (High-Fidelity Subject Grid) -->
<section class="resource-catalog py-6 bg-white" id="all">
    <div class="container container-1440">
        <div class="section-title text-center mb-6">
            <h2 class="fw-black">BROWSE BY <span class="text-primary">SUBJECT</span></h2>
            <div class="title-accent mx-auto"></div>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Physics -->
            <div class="col-lg-3 col-md-6" id="physics">
                <div class="resource-card p-5 rounded-5 border border-light transition-all hover-translate-y hover-shadow-lg text-center h-100">
                    <div class="resource-icon mb-4"><i class="fas fa-rocket text-primary fs-1"></i></div>
                    <h4 class="fw-bold mb-3">PHYSICS</h4>
                    <p class="text-muted small mb-5">Advanced Mechanics, Electromagnetism, and Modern Physics modules with solved HC Verma & Irodov problems.</p>
                    <a href="#" class="btn btn-primary w-100 py-3 rounded-pill fw-bold mb-2">View Modules</a>
                    <a href="#" class="text-primary fw-bold small text-decoration-none">Sample Questions <i class="fas fa-chevron-right ms-1 mt-1"></i></a>
                </div>
            </div>

            <!-- Chemistry -->
            <div class="col-lg-3 col-md-6" id="chemistry">
                <div class="resource-card p-5 rounded-5 border border-light transition-all hover-translate-y hover-shadow-lg text-center h-100">
                    <div class="resource-icon mb-4"><i class="fas fa-flask text-primary fs-1"></i></div>
                    <h4 class="fw-bold mb-3">CHEMISTRY</h4>
                    <p class="text-muted small mb-5">Integrated Physical, Organic, and Inorganic modules focusing on reaction mechanisms and atomic precision.</p>
                    <a href="#" class="btn btn-primary w-100 py-3 rounded-pill fw-bold mb-2">View Modules</a>
                    <a href="#" class="text-primary fw-bold small text-decoration-none">Sample Questions <i class="fas fa-chevron-right ms-1 mt-1"></i></a>
                </div>
            </div>

            <!-- Math -->
            <div class="col-lg-3 col-md-6" id="math">
                <div class="resource-card p-5 rounded-5 border border-light transition-all hover-translate-y hover-shadow-lg text-center h-100">
                    <div class="resource-icon mb-4"><i class="fas fa-square-root-alt text-primary fs-1"></i></div>
                    <h4 class="fw-bold mb-3">MATHEMATICS</h4>
                    <p class="text-muted small mb-5">Calculus, Coordinate Geometry, and Algebra modules with tricky problem-solving techniques for JEE Advanced.</p>
                    <a href="#" class="btn btn-primary w-100 py-3 rounded-pill fw-bold mb-2">View Modules</a>
                    <a href="#" class="text-primary fw-bold small text-decoration-none">Sample Questions <i class="fas fa-chevron-right ms-1 mt-1"></i></a>
                </div>
            </div>

            <!-- Biology -->
            <div class="col-lg-3 col-md-6" id="biology">
                <div class="resource-card p-5 rounded-5 border border-light transition-all hover-translate-y hover-shadow-lg text-center h-100">
                    <div class="resource-icon mb-4"><i class="fas fa-dna text-primary fs-1"></i></div>
                    <h4 class="fw-bold mb-3">BIOLOGY</h4>
                    <p class="text-muted small mb-5">Visual NCERT modules with detailed flowcharts and high-resolution diagrams for anatomy & physiology.</p>
                    <a href="#" class="btn btn-primary w-100 py-3 rounded-pill fw-bold mb-2">View Modules</a>
                    <a href="#" class="text-primary fw-bold small text-decoration-none">Sample Questions <i class="fas fa-chevron-right ms-1 mt-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Material Excellence (Detailed View) -->
<section class="material-excellence py-6 bg-light">
    <div class="container container-1440">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="material-visual pe-lg-5">
                    <img src="assets/images/faq-student.png" class="img-fluid rounded-5 shadow-2xl border border-white border-5 transform-hover scale-105" alt="Study Environment">
                </div>
            </div>
            <div class="col-lg-5">
                <h2 class="display-5 fw-black mb-4">Crafted for <span class="text-primary">Clarity</span></h2>
                <div class="excellence-pillar mb-4">
                    <h6 class="fw-black text-secondary mb-3"><i class="fas fa-microchip text-primary me-2"></i> SCIENTIFIC TOPIC MAPPING</h6>
                    <p class="text-muted small">Every chapter is broken into 'Learning Objectives' and 'Examination Benchmarks' based on 20 years of trends.</p>
                </div>
                <div class="excellence-pillar mb-4">
                    <h6 class="fw-black text-secondary mb-3"><i class="fas fa-images text-primary me-2"></i> HIGH-FIDELITY VISUALS</h6>
                    <p class="text-muted small">We use custom 3D diagrams and conceptual flowcharts to make complex concepts intuitive and memorable.</p>
                </div>
                <div class="excellence-pillar">
                    <h6 class="fw-black text-secondary mb-3"><i class="fas fa-layer-group text-primary me-2"></i> GRADED PROBLEM SETS</h6>
                    <p class="text-muted small">Exercises are graded from 'Conceptual Foundations' to 'Challenging Rank-Boosters'.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
