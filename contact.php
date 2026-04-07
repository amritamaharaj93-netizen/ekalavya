<?php include 'includes/header.php'; ?>

<!-- Hero Section: Connect with Admissions -->
<section class="page-hero bg-primary position-relative overflow-hidden py-5 text-white">
    <div class="container py-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold">CONTACT US</span>
                <h1 class="display-3 fw-black mb-4">Start Your <span class="text-white opacity-75">Elite Journey</span></h1>
                <p class="lead opacity-90 mb-5">Have a query about our programs, scholarship entrance exam (ESAT), or career counseling? Our admissions experts are ready to guide you at every step.</p>
                <div class="d-flex gap-3">
                    <a href="tel:9934244522" class="btn btn-light btn-lg px-4 rounded-pill fw-bold text-primary shadow-lg"><i class="fas fa-phone-alt me-2"></i> +91 9934244522</a>
                    <a href="https://wa.me/919934244522" target="_blank" class="btn btn-success btn-lg px-4 rounded-pill fw-bold shadow-lg"><i class="fab fa-whatsapp me-2"></i> WhatsApp Us</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-end">
                <i class="fas fa-headset opacity-10" style="font-size: 350px; transform: rotate(-15deg);"></i>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Address Grid (High-Fidelity Studio Layout) -->
<section class="contact-hub py-6 bg-white" id="connect">
    <div class="container container-1440">
        <div class="row g-5">
            <!-- Stunning Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-master p-5 rounded-5 shadow-2xl border-0 overflow-hidden position-relative bg-light">
                    <h3 class="fw-black text-secondary display-6 mb-4">SEND AN <span class="text-primary">ENQUIRY</span></h3>
                    <p class="text-muted small mb-5">Our academic counselor will reach out to you within 24 business hours for a personalized counseling session.</p>
                    
                    <form action="process-contact.php" method="POST" class="row g-4">
                        <div class="col-md-6"><input type="text" name="name" class="form-control-minimal p-4 rounded-4 w-100 border-0 bg-white shadow-sm" placeholder="Your Name" required></div>
                        <div class="col-md-6"><input type="tel" name="phone" class="form-control-minimal p-4 rounded-4 w-100 border-0 bg-white shadow-sm" placeholder="Phone Number" required></div>
                        <div class="col-md-12"><input type="email" name="email" class="form-control-minimal p-4 rounded-4 w-100 border-0 bg-white shadow-sm" placeholder="Email Address" required></div>
                        <div class="col-md-12">
                            <select name="subject" class="form-select-minimal p-4 rounded-4 w-100 border-0 bg-white shadow-sm text-muted" required>
                                <option value="" disabled selected>Nature of Inquiry</option>
                                <option value="Admissions">New Admission Inquiry</option>
                                <option value="Scholarship">Scholarship (ESAT) Doubt</option>
                                <option value="Counseling">Personalized Counseling Session</option>
                                <option value="Others">General Query</option>
                            </select>
                        </div>
                        <div class="col-12"><textarea name="message" class="form-control-minimal p-4 rounded-4 w-100 border-0 bg-white shadow-sm" rows="5" placeholder="Your Message / Query in Detail" required></textarea></div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-4 rounded-pill fw-bold text-uppercase letter-spacing-2 shadow-lg scale-hover">SUBMIT ADMISSION QUERY</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Address Cards (Glassmorphism & Authority) -->
            <div class="col-lg-5">
                <div class="address-grid vstack gap-4 ps-lg-4">
                    <!-- Patna Center -->
                    <div class="address-card p-5 rounded-5 shadow-sm border border-light transition-all hover-translate-y hover-shadow-lg h-100">
                        <div class="center-meta d-flex justify-content-between mb-4 align-items-center">
                            <h4 class="fw-black text-secondary mb-0">PATNA <span class="text-primary">CENTER</span></h4>
                            <span class="badge bg-orange-soft text-primary px-3 py-2 rounded-pill small fw-bold">HEAD OFFICE</span>
                        </div>
                        <p class="text-muted small mb-4">Shakti Enclave, Opposite of G.D. Goenka School, Canal Road, Boring Road, Patna, Bihar.</p>
                        <div class="contact-links vstack gap-2 small fw-bold text-secondary mb-4">
                            <a href="tel:9934244522" class="text-decoration-none hover-text-primary"><i class="fas fa-phone-alt text-primary me-2"></i> +91 9934244522</a>
                            <a href="mailto:info.ekalavya@gmail.com" class="text-decoration-none hover-text-primary"><i class="fas fa-envelope text-primary me-2"></i> info.ekalavya@gmail.com</a>
                            <a href="#" class="text-decoration-none hover-text-primary"><i class="fas fa-clock text-primary me-2"></i> Open: 8:00 AM - 8:00 PM</a>
                        </div>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline-primary py-2 px-4 rounded-pill small fw-bold hstack gap-2">View On Map <i class="fas fa-location-arrow"></i></a>
                    </div>
                    
                    <!-- Gaya Center -->
                    <div class="address-card p-5 rounded-5 shadow-sm border border-light transition-all hover-translate-y hover-shadow-lg h-100">
                        <h4 class="fw-black text-secondary mb-4">GAYA <span class="text-primary">CENTER</span></h4>
                        <p class="text-muted small mb-4">Eklavya Academy Campus, Bisar Talab Rd, Gaya, Bihar 823001.</p>
                        <div class="contact-links vstack gap-2 small fw-bold text-secondary mb-4">
                             <a href="tel:9934244522" class="text-decoration-none hover-text-primary"><i class="fas fa-phone-alt text-primary me-2"></i> +91 9934244522</a>
                             <a href="mailto:info.ekalavya@gmail.com" class="text-decoration-none hover-text-primary"><i class="fas fa-envelope text-primary me-2"></i> info.ekalavya@gmail.com</a>
                             <a href="#" class="text-decoration-none hover-text-primary"><i class="fas fa-clock text-primary me-2"></i> Open: 8:00 AM - 8:00 PM</a>
                        </div>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline-primary py-2 px-4 rounded-pill small fw-bold hstack gap-2">View On Map <i class="fas fa-location-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
