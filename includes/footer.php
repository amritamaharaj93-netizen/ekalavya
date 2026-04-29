    <footer class="footer bg-dark-navy text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="footer-logo-wrapper mb-3">
                        <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="Ekalavya Academy" class="footer-logo bg-white p-2 shadow-sm" style="height: 50px; width: auto; border-radius: 4px;">
                    </div>
                    <p class="text-light opacity-75">Ekalavya Academy is a premier offline coaching institute for IIT-JEE, NEET, and School Prep (Class 7th-12th) courses. We are dedicated to providing the best education and result-oriented coaching.</p>
                    <div class="social-links mt-4">
                        <a href="https://www.instagram.com/ekalavya.education/" target="_blank" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/919934244522" target="_blank" class="social-icon whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="text-white mb-4 position-relative d-inline-block">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>" class="text-light opacity-75 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>about" class="text-light opacity-75 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>courses" class="text-light opacity-75 text-decoration-none">Courses</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>classroom-courses" class="text-light opacity-75 text-decoration-none">Classroom Programs</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>scholarship" class="text-light opacity-75 text-decoration-none">Scholarship</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>contact" class="text-light opacity-75 text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-white mb-4 position-relative d-inline-block">Our Head Office</h5>
                    <p class="text-light opacity-75 mb-1">H.O: Boring Canal Road, Patna</p>
                    <p class="text-light opacity-75 mb-1">Gaya: Bisar Talab, Nutan Nagar, Gaya</p>
                    <p class="text-light opacity-75 mb-1"><i class="fas fa-phone-alt me-2 text-primary"></i> 9934244522</p>
                    <p class="text-light opacity-75 small"><i class="fas fa-envelope me-2 text-primary"></i> info.ekalavyaeducation@gmail.com</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-white mb-4 position-relative d-inline-block">Newsletter</h5>
                    <p class="text-light opacity-75 mb-3 small">Stay updated with our latest result news and program announcement.</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control bg-transparent border-secondary text-white" placeholder="Email Address" style="height: 48px;">
                        <button class="btn btn-primary px-3" type="button">Join</button>
                    </div>
                </div>
            </div>
            <hr class="border-secondary opacity-25">
            <div class="row pt-2">
                <div class="col-md-12 d-flex flex-wrap justify-content-between align-items-center text-secondary py-2">
                    <p class="small mb-0">&copy; <?php echo date("Y"); ?> Ekalavya Academy. All Rights Reserved.</p>
                    <p class="small mb-0 opacity-50">Powered by <a href="https://globalwebify.com" target="_blank" class="text-white text-decoration-none fw-bold hover-primary">Global Webify</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Automatic Registration Popup Modal -->
    <div class="modal fade" id="registrationPopupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content border-0 rounded-5 shadow-2xl overflow-hidden">
                <div class="modal-body p-0">
                    <div class="registration-form-card p-4 p-md-5 position-relative overflow-hidden bg-white">
                        <!-- Background Blob for WOW effect -->
                        <div class="wow-blob" style="top: -50px; right: -50px; width: 200px; height: 200px; opacity: 0.15; background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);"></div>
                        
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 shadow-none z-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        
                        <div class="text-center mb-4 position-relative">
                            <div class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="font-size: 0.7rem;">SESSION 2026-27</div>
                            <h3 class="fw-black mb-1" style="font-size: 1.5rem;">REGISTRATION <span class="text-primary">PORTAL</span></h3>
                            <p class="text-muted uppercase fw-bold tracking-widest mb-0" style="font-size: 0.65rem;">Scholarship Program Admission</p>
                        </div>
                        
                        <form action="<?php echo BASE_URL; ?>process-scholarship.php" method="POST" class="vstack gap-3 position-relative">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control rounded-4 border-0 bg-light px-4" id="popRegName" placeholder="Full Name" style="height: 58px;" required>
                                <label for="popRegName" class="small text-muted px-4">Full Name</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" name="email" class="form-control rounded-4 border-0 bg-light px-4" id="popRegEmail" placeholder="Email Address" style="height: 58px;" required>
                                <label for="popRegEmail" class="small text-muted px-4">Email Address</label>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="tel" name="phone" class="form-control rounded-4 border-0 bg-light px-4" id="popRegPhone" placeholder="Mobile" style="height: 58px;" required>
                                        <label for="popRegPhone" class="small text-muted px-4">Phone</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="program" class="form-select rounded-4 border-0 bg-light px-4" id="popRegClass" style="height: 58px;" required>
                                            <option value="IIT-JEE">IIT-JEE</option>
                                            <option value="NEET">NEET</option>
                                            <option value="Foundation">Foundation</option>
                                        </select>
                                        <label for="popRegClass" class="small text-muted px-4">Program</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating">
                                <select name="scholarship_type" class="form-select rounded-4 border-0 bg-light px-4" id="popRegType" style="height: 58px;" required>
                                    <option value="ESAT">Scholarship Test (ESAT)</option>
                                    <option value="EMRS">Merit Based (EMRS)</option>
                                    <option value="EARLY_BIRD">Early Bird Benefits</option>
                                </select>
                                <label for="popRegType" class="small text-muted px-4">Apply For</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-black shadow-lg text-uppercase tracking-wider mt-2" style="font-size: 0.9rem;">
                                REGISTER NOW <i class="fas fa-paper-plane ms-2"></i>
                            </button>

                            <div class="text-center mt-3">
                                <a href="https://wa.me/919934244522" class="text-success small fw-bold text-decoration-none d-flex align-items-center justify-content-center gap-2">
                                    <i class="fab fa-whatsapp fs-5"></i> WHATSAPP ADMISSION HELPLINE
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- High-Density Admission Enquiry Modal -->
    <div class="modal fade studio-modal" id="enquiryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content border-0 rounded-4 shadow-2xl overflow-hidden">
                <div class="modal-body p-0">
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="modal-header-minimal">
                                <h4 class="fw-black mb-1 text-dark" style="font-size: 1rem; letter-spacing: -0.2px;">ADMISSION <span class="text-primary">ENQUIRY</span></h4>
                                <p class="text-muted mb-0" style="font-size: 0.70rem;">Session <?php echo date('Y'); ?>-<?php echo date('y') + 1; ?> Enrollment Portal</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close" style="font-size: 0.6rem;"></button>
                        </div>

                        <form id="globalEnquiryForm" action="<?php echo BASE_URL; ?>process-enquiry.php" method="POST">
                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <label class="fw-bold mb-1 text-uppercase text-muted" style="font-size: 0.6rem; letter-spacing: 0.5px;">Full Name</label>
                                    <input type="text" class="form-control-minimal rounded-2 w-100 border text-dark py-1 px-3" name="name" placeholder="Full Name" style="font-size: 0.8rem; height: 38px;" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold mb-1 text-uppercase text-muted" style="font-size: 0.6rem; letter-spacing: 0.5px;">Mobile Number</label>
                                    <input type="tel" class="form-control-minimal rounded-2 w-100 border text-dark py-1 px-3" name="phone" placeholder="Mobile" style="font-size: 0.8rem; height: 38px;" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold mb-1 text-uppercase text-muted" style="font-size: 0.6rem; letter-spacing: 0.5px;">Email Address</label>
                                    <input type="email" class="form-control-minimal rounded-2 w-100 border text-dark py-1 px-3" name="email" placeholder="Email" style="font-size: 0.8rem; height: 38px;" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold mb-1 text-uppercase text-muted" style="font-size: 0.6rem; letter-spacing: 0.5px;">Target Program</label>
                                <select class="form-select form-control-minimal rounded-2 w-100 border text-dark py-1 px-3" name="course" id="modalCourseSelect" style="font-size: 0.8rem; height: 38px;" required>
                                    <option value="" disabled selected>Select Program</option>
                                    <?php if($nav_courses): ?>
                                        <?php foreach($nav_courses as $nc): ?>
                                            <option value="<?php echo htmlspecialchars($nc['title']); ?>"><?php echo htmlspecialchars($nc['title']); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <option value="School Prep (Class 7th-12th)">School Prep (Class 7th-12th)</option>
                                    <option value="IIT-JEE">IIT-JEE</option>
                                    <option value="NEET">NEET-UG</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-black shadow-lg mb-3" style="font-size: 0.8rem;">CONFIRM ENQUIRY <i class="fas fa-arrow-right ms-2"></i></button>
                            
                            <div class="text-center">
                                <a href="https://wa.me/919934244522" class="text-success fw-bold text-decoration-none" style="font-size: 0.70rem;">
                                    <i class="fab fa-whatsapp me-1"></i> DIRECT WHATSAPP ASSISTANCE
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/919934244522" class="whatsapp-float shadow-heavy" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Dynamic Header Height Fix: measures the real sticky header and applies correct top offset to all inner sticky elements -->
    <script>
        (function applyHeaderOffset() {
            function setOffset() {
                var header = document.querySelector('.main-header');
                if (!header) return;
                var h = Math.ceil(header.getBoundingClientRect().height);
                // Update CSS variable for scroll-padding-top
                document.documentElement.style.setProperty('--header-height', h + 'px');
                // Apply to every inner sticky-top (not the header itself)
                document.querySelectorAll('.sticky-top').forEach(function(el) {
                    if (!header.contains(el)) {
                        el.style.top = (h + 10) + 'px';
                    }
                });
            }
            // Run immediately (DOM already parsed at this point in footer)
            setOffset();
            // Re-run after full render (images/fonts may shift header height)
            window.addEventListener('load', setOffset);
            // Re-run on resize (mobile ↔ desktop toggles the utility bar)
            window.addEventListener('resize', setOffset);
        })();
    </script>
    <script>
        // Intelligent Course Auto-selection
        document.addEventListener('DOMContentLoaded', function() {
            var enquiryModal = document.getElementById('enquiryModal');
            enquiryModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var courseName = button.getAttribute('data-course');
                var selectElement = document.getElementById('modalCourseSelect');
                
                if (courseName && selectElement) {
                    for (var i = 0; i < selectElement.options.length; i++) {
                        if (selectElement.options[i].value === courseName) {
                            selectElement.selectedIndex = i;
                            break;
                        }
                    }
                }
            });
        });
    </script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
