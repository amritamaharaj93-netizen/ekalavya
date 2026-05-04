<?php include 'includes/header.php'; ?>

<!-- Premium Institutional Header -->
<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('assets/images/contact_header.png') center/cover no-repeat; padding: clamp(40px, 8vh, 100px) 0 !important;">
    <div class="container text-center text-white">
        <h1 class="fw-black mb-0" style="font-size: clamp(2.2rem, 10vw, 4.5rem); line-height: 1.1;">CONTACT <span class="text-primary d-block d-md-inline">US</span></h1>
    </div>
</section>

<!-- Ultra Premium Contact Hub -->
<section class="contact-hub py-6 position-relative bg-white" id="connect">
    <div class="container container-1440 position-relative z-1">
        <div class="row g-4 align-items-center">
            
            <!-- Left: Gaya Center -->
            <div class="col-lg-4">
                <div class="location-card p-4 p-md-5 rounded-5 text-white h-100 transition-all hover-translate-y position-relative overflow-hidden d-flex flex-column" style="background-color: #0d1b31; border: 1px solid rgba(255,255,255,0.05);">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box bg-white bg-opacity-10 text-warning rounded-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="fw-black mb-0 text-uppercase text-warning fs-4">GAYA CENTER</h3>
                    </div>
                    
                    <p class="text-light opacity-75 mb-5 fs-6">Ekalavya Academy Campus, Bisar Talab Rd, Gaya, Bihar 823001.</p>
                    
                    <div class="contact-info-list d-flex flex-column gap-4 mb-5">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-phone-alt text-warning"></i>
                            <span class="fw-bold">+91 9934244522</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-envelope text-warning"></i>
                            <span class="fw-bold">info.ekalavyaeducation@gmail.com</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-clock text-warning"></i>
                            <span class="fw-bold">Open: 8:00 AM - 8:00 PM</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline-light w-100 py-3 rounded-pill fw-bold border-opacity-25">
                            View On Map <i class="fas fa-paper-plane ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Center: Enquiry Form -->
            <div class="col-lg-4">
                <div class="contact-form-premium p-4 p-md-5 rounded-5 bg-white position-relative h-100 shadow-lg text-center">
                    <div class="badge bg-warning bg-opacity-10 text-warning px-4 py-2 rounded-pill mb-4 fw-black tracking-widest small">GET IN TOUCH</div>
                    <h2 class="fw-black text-dark mb-3 text-uppercase">SEND AN <span class="text-warning">ENQUIRY</span></h2>
                    <p class="text-muted small mb-5">Our academic counselor will reach out to you within 24 hours.</p>
                    
                    <form id="contactEnquiryForm" action="process-contact.php" method="POST" class="row g-4 text-start">
                        <div class="col-12">
                            <input type="text" name="name" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 py-3" placeholder="Your Name" required>
                        </div>
                        <div class="col-12">
                            <input type="tel" name="phone" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 py-3" placeholder="Phone Number" required>
                        </div>
                        <div class="col-12">
                            <input type="email" name="email" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 py-3" placeholder="Email Address" required>
                        </div>
                        <div class="col-12">
                            <select name="subject" class="form-select form-select-lg border-0 bg-light rounded-4 px-4 py-3 text-muted" required>
                                <option value="" disabled selected>Select Inquiry Type</option>
                                <option value="Admissions">Admission Inquiry</option>
                                <option value="Scholarship">Scholarship Doubt</option>
                                <option value="Others">General Query</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <textarea name="message" class="form-control border-0 bg-light rounded-4 px-4 py-3" rows="4" placeholder="Your Message" required></textarea>
                        </div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-black shadow-lg text-uppercase" style="background: #f7941d; border: none; color: white;">
                                Submit Enquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Patna Center -->
            <div class="col-lg-4">
                <div class="location-card p-4 p-md-5 rounded-5 text-white h-100 transition-all hover-translate-y position-relative overflow-hidden d-flex flex-column" style="background-color: #0d1b31; border: 1px solid rgba(255,255,255,0.05);">
                    <div class="position-absolute top-0 end-0 mt-4 me-4 badge bg-primary text-white px-3 py-1 rounded shadow-sm very-small fw-bold z-2">HEAD OFFICE</div>
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box bg-white bg-opacity-10 text-warning rounded-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="fw-black mb-0 text-uppercase text-warning fs-4">PATNA CENTER</h3>
                    </div>
                    
                    <p class="text-light opacity-75 mb-5 fs-6">Shakti Enclave, Opposite of G.D. Goenka School, Canal Road, Boring Road, Patna, Bihar.</p>
                    
                    <div class="contact-info-list d-flex flex-column gap-4 mb-5">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-phone-alt text-warning"></i>
                            <span class="fw-bold">+91 9934244522</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-envelope text-warning"></i>
                            <span class="fw-bold">info.ekalavyaeducation@gmail.com</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-clock text-warning"></i>
                            <span class="fw-bold">Open: 8:00 AM - 8:00 PM</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline-light w-100 py-3 rounded-pill fw-bold border-opacity-25">
                            View On Map <i class="fas fa-paper-plane ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <style>
        .very-small { font-size: 0.65rem; }
        .contact-hub input::placeholder, .contact-hub textarea::placeholder { color: #8892b0 !important; font-weight: 500; }
        .contact-hub .form-control:focus { background: #fff !important; box-shadow: 0 0 0 4px rgba(247, 148, 29, 0.1); }
    </style>
</section>


<!-- Quick FAQ + CTA -->
<section class="section-padding bg-light">
    <div class="container container-1440">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-black mb-4">FREQUENTLY <span class="text-primary">ASKED</span></h2>
                <div class="accordion faq-modern" id="contactFaq">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">What are the office timings?</button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#contactFaq">
                            <div class="accordion-body">Our centers in Patna and Gaya operate from 8:00 AM to 8:00 PM, Monday to Saturday. Sunday consultations are available by appointment.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">How can I schedule a campus visit?</button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                            <div class="accordion-body">Call us at +91 9934244522 or fill the enquiry form above. Our team will schedule a guided tour of our facilities.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Is there a free demo class available?</button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                            <div class="accordion-body">Yes! We offer free demo sessions for all programs. Book yours through WhatsApp or the enquiry form.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="cta-banner-premium rounded-5 overflow-hidden p-5 text-center position-relative" style="background: var(--navy-gradient); min-height: 350px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Admissions Open</h6>
                    <h2 class="display-5 fw-black text-white mb-4">START YOUR<br><span class="text-primary">JOURNEY</span> TODAY</h2>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="scholarship.php" class="btn btn-aurous-gradient btn-lg rounded-pill px-5 py-3 fw-bold shadow-glow">APPLY FOR SCHOLARSHIP</a>
                        <a href="https://wa.me/919934244522" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-bold"><i class="fab fa-whatsapp me-2"></i> WHATSAPP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactEnquiryForm');
    if(contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> PROCESSING...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    const cardContainer = this.closest('.contact-form-premium');
                    cardContainer.innerHTML = `
                        <div class="text-center p-5 animate__animated animate__fadeIn">
                            <div class="success-orb mb-4 mx-auto">
                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg" style="width: 90px; height: 90px;">
                                    <i class="fas fa-paper-plane fs-1"></i>
                                </div>
                            </div>
                            <h3 class="fw-black text-dark mb-3 text-uppercase">MESSAGE <span class="text-warning">SENT</span></h3>
                            <p class="text-muted small mb-0">${data.message}</p>
                            <div class="mt-5 pt-4 border-top border-light">
                                <p class="very-small text-muted mb-0">Follow our journey on social media</p>
                                <div class="d-flex justify-content-center gap-3 mt-3">
                                    <a href="#" class="text-secondary"><i class="fab fa-instagram fs-5"></i></a>
                                    <a href="#" class="text-secondary"><i class="fab fa-facebook fs-5"></i></a>
                                    <a href="#" class="text-secondary"><i class="fab fa-linkedin fs-5"></i></a>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    alert(data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnContent;
            });
        });
    }
});
</script>
