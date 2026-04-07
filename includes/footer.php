    <footer class="footer bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="footer-logo-wrapper mb-3">
                        <img src="assets/images/logo.png" alt="Eklavya Academy" class="footer-logo bg-white p-2 shadow-sm" style="height: 70px; width: auto; border-radius: 4px;">
                    </div>
                    <p class="text-light opacity-75">Eklavya Academy is a premier offline coaching institute for IIT-JEE, NEET, and Foundation courses. We are dedicated to providing the best education and result-oriented coaching.</p>
                    <div class="social-links mt-4">
                        <a href="https://www.instagram.com/ekalavya.education/" target="_blank" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://wa.me/919934244522" target="_blank" class="social-icon whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="text-white mb-4 position-relative d-inline-block">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="./" class="text-light opacity-75 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="about.php" class="text-light opacity-75 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="courses.php" class="text-light opacity-75 text-decoration-none">Courses</a></li>
                        <li class="mb-2"><a href="results.php" class="text-light opacity-75 text-decoration-none">Results</a></li>
                        <li class="mb-2"><a href="contact.php" class="text-light opacity-75 text-decoration-none">Contact Us</a></li>
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
                    <p class="small mb-0">&copy; <?php echo date("Y"); ?> Eklavya Academy. All Rights Reserved.</p>
                    <p class="small mb-0 opacity-50">Powered by <a href="https://globalwebify.com" target="_blank" class="text-white text-decoration-none fw-bold hover-primary">Global Webify</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Enquiry Modal (Studio Grade) -->
    <div class="modal fade studio-modal" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl">
                <div class="modal-header d-flex flex-column align-items-center text-center py-5 position-relative">
                    <div class="modal-label-icon mb-3 bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3 class="modal-title text-white fw-black mb-0" id="enquiryModalLabel">Enquire Now</h3>
                    <p class="text-white opacity-75 small mb-0 mt-2">Our expert counselors will call you shortly.</p>
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5">
                    <form id="globalEnquiryForm">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Select Course</label>
                            <select class="form-select form-control shadow-none" name="course">
                                <option value="IIT-JEE">IIT-JEE (Mains & Adv)</option>
                                <option value="NEET">NEET (Medical)</option>
                                <option value="Foundation">Foundational Classes</option>
                                <option value="Scholarship">Scholarship Exam (ESAT)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-lg mt-2">Submit Enquiry</button>
                        
                        <div class="text-center mt-4">
                            <p class="small text-muted">Or chat directly on Whatsapp</p>
                            <a href="https://wa.me/919934244522" class="text-success fw-bold text-decoration-none">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp Message
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/919934244522" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
