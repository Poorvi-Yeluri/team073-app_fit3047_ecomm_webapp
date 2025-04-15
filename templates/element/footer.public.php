<!-- Desktop Footer (md and up) -->
<div class="d-none d-md-flex row justify-content-between py-4">
    <!-- Brand & Tagline -->
    <div class="col-md-3">
        <a class="logo-brand" href="/">
            GLEAM <i class="text-small">AND</i> GRACE
        </a>
        <p>Your one-stop shop for elegance.</p>
    </div>

    <!-- Quick Links -->
    <div class="col-md-2">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
            <li><a href="#" class="text-dark">Home</a></li>
            <li><a href="#" class="text-dark">Shop</a></li>
            <li><a href="#" class="text-dark">About</a></li>
            <li><a href="/contact-messages/add" class="text-dark">Contact</a></li>
        </ul>
    </div>

    <!-- Support -->
    <div class="col-md-2">
        <h5>Support</h5>
        <ul class="list-unstyled">
            <li><a href="#" class="text-dark">FAQ</a></li>
            <li><a href="#" class="text-dark">Returns</a></li>
            <li><a href="#" class="text-dark">Shipping</a></li>
        </ul>
    </div>

    <!-- Contact Info -->
    <div class="col-md-3">
        <h5>Contact Us</h5>
        <h6 class="font-sans weight-regular">support@gleamandgrace.com</h6>
        <h6 class="font-sans weight-regular">+61 812 123 4567</h6>
    </div>
</div>

<!-- Mobile Footer (sm and down) -->
<div class="d-md-none py-space-3">
    <div class="text-center mb-space-3">
        <a class="logo-brand" href="#">GLEAM AND GRACE</a>
        <p class="text-body">Your one-stop shop for elegance.</p>
    </div>

    <div class="accordion" id="mobileFooterAccordion">
        <!-- Quick Links -->
        <div class="accordion-item mb-space-2">
            <h2 class="accordion-header" id="headingQuickLinks">
                <button class="accordion-button collapsed text-h5 text-dark" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseQuickLinks" aria-expanded="false"
                        aria-controls="collapseQuickLinks">
                    Quick Links
                </button>
            </h2>
            <div id="collapseQuickLinks" class="accordion-collapse collapse" aria-labelledby="headingQuickLinks"
                 data-bs-parent="#mobileFooterAccordion">
                <div class="accordion-body mt-space-1">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Home</a></li>
                        <li><a href="#" class="text-dark">Shop</a></li>
                        <li><a href="#" class="text-dark">About</a></li>
                        <li><a href="/contact-messages/add" class="text-dark">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="accordion-item mb-space-2">
            <h2 class="accordion-header" id="headingSupport">
                <button class="accordion-button collapsed text-h5 text-dark" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseSupport" aria-expanded="false"
                        aria-controls="collapseSupport">
                    Support
                </button>
            </h2>
            <div id="collapseSupport" class="accordion-collapse collapse" aria-labelledby="headingSupport"
                 data-bs-parent="#mobileFooterAccordion">
                <div class="accordion-body mt-space-1">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">FAQ</a></li>
                        <li><a href="#" class="text-dark">Returns</a></li>
                        <li><a href="#" class="text-dark">Shipping</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingContact">
                <button class="accordion-button collapsed text-h5 text-dark" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseContact" aria-expanded="false"
                        aria-controls="collapseContact">
                    Contact Us
                </button>
            </h2>
            <div id="collapseContact" class="accordion-collapse collapse" aria-labelledby="headingContact"
                 data-bs-parent="#mobileFooterAccordion">
                <div class="accordion-body mt-space-1">
                    <p class="text-small m-0"><strong>Email:</strong> support@gleamandgrace.com</p>
                    <p class="text-small m-0"><strong>Phone:</strong> +61 812 123 4567</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="contact-fab" class="fab-button black" aria-label="Contact Us">
    <span class="material-symbols-outlined">contact_support</span>
</div>

<div id="contact-modal" class="contact-modal">
    <div class="contact-modal-content">
        <span class="close-modal">&times;</span>
        <h2>Contact Us</h2>
        <?php
        $contactMessage = $this->get('contactMessage');
        echo $this->element('contact_form', compact('contactMessage'));
        ?>
    </div>
</div>

<script>
    const fab = document.getElementById('contact-fab');
    const modal = document.getElementById('contact-modal');
    const close = document.querySelector('.close-modal');

    fab.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    close.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>
