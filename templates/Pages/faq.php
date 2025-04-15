<?php
$this->assign('title', 'FAQ');
$this->Html->css('style');
?>

<div class="container">
    <h1>Frequently Asked Questions</h1>

    <p>At Gleam and Grace, we believe in offering our customers not only exquisite home decor and jewelry, but also an exceptional experience. Below are some answers to common questions that might help guide your shopping journey with us. If you need further assistance, feel free to contact us.</p>

    <hr>

    <div class="accordion" id="faqAccordion">
        <!-- FAQ 1: About Gleam & Grace -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Who is Gleam & Grace and what do you offer?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Gleam & Grace is a Melbourne-based luxury brand specializing in elegant home decor and beautifully crafted jewellery. We focus on offering timeless pieces that bring warmth, grace, and sophistication to your home and personal style. From artful decor to statement jewelry, each piece is handpicked for its quality and beauty.
                </div>
            </div>
        </div>

        <!-- FAQ 2: Return Policy for Home Decor -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    What is your return policy for Home Decor items?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We understand that finding the perfect home decor piece is important. You can return home decor items within 7 days of receiving them, provided they are in original, unused condition. Please note that change of mind is not accepted.
                </div>
            </div>
        </div>

        <!-- FAQ 3: Return Policy for Jewelry -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Can I return jewellery items?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Due to hygiene reasons, we do not accept returns or exchanges on jewellery items unless they are defective. All jewellery sales are final. If you receive a defective piece, please contact us immediately, and we'll assist you in resolving the issue.
                </div>
            </div>
        </div>

        <!-- FAQ 4: Shipping Information -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    How long will it take for my order to arrive?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We ship to all areas of Australia and internationally. Orders typically arrive within 3-5 business days for local deliveries. International shipping times vary depending on the destination, but you can expect delivery within 10-15 business days.
                </div>
            </div>
        </div>

        <!-- FAQ 5: Product Care -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    How should I care for my jewelry and home decor items?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>Jewellery:</strong> To maintain the elegance of your jewellery, avoid direct contact with perfumes, lotions, and water. Clean gently with a soft cloth to preserve its shine.
                    <br><br>
                    <strong>Home Decor:</strong> For long-lasting beauty, keep your decor pieces away from direct sunlight and moisture. Dust regularly with a soft, dry cloth and handle with care.
                </div>
            </div>
        </div>

        <!-- FAQ 6: Customer Support -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    How can I get in touch with customer support?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Our customer support team is here to assist you with any queries you may have. You can reach us via our <a href="/contact-messages/add">Contact Form</a> or by emailing us directly at <strong>support@gleamandgrace.com</strong>. We aim to respond to all inquiries within 1-2 business days.
                </div>
            </div>
        </div>

        <!-- FAQ 7: Why Choose Gleam & Grace? -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Why should I choose Gleam & Grace for my home decor and jewelry needs?
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Gleam & Grace stands out for our commitment to quality and craftsmanship. Our curated selection of home decor and jewelry is designed to inspire elegance in every home and on every individual. We offer high-quality, timeless pieces that are carefully sourced and crafted to last a lifetime.
                </div>
            </div>
        </div>

        <!-- FAQ 8: Gift Cards -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Do you offer gift cards?
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, we offer gift cards for those who want to give the gift of choice. You can purchase a gift card of any value from our website, and the recipient can use it to shop for their favorite items from Gleam & Grace.
                </div>
            </div>
        </div>

    </div>
</div>
