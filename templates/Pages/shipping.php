<?php
$this->assign('title', 'Shipping FAQ');
$this->Html->css('style')
?>

<div class="container">
    <h1>Shipping FAQ</h1>

    <div class="accordion" id="shippingAccordion">
        <!-- Shipping Process -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingShippingProcess">
                <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseShippingProcess" aria-expanded="false"
                        aria-controls="collapseShippingProcess">
                    What is the shipping process?
                </button>
            </h2>
            <div id="collapseShippingProcess" class="accordion-collapse collapse" aria-labelledby="headingShippingProcess"
                 data-bs-parent="#shippingAccordion">
                <div class="accordion-body">
                    <p>Once your order is placed, we will process it and dispatch it as quickly as possible. Our shipping
                        is handled by Australia Post for standard deliveries and Team Global Express for priority shipping.
                        Please allow 1-3 business days for processing, and once shipped, you'll receive a tracking number
                        to follow your order's journey.</p>
                </div>
            </div>
        </div>

        <!-- Shipping Times -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingShippingTimes">
                <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseShippingTimes" aria-expanded="false"
                        aria-controls="collapseShippingTimes">
                    How long does shipping take?
                </button>
            </h2>
            <div id="collapseShippingTimes" class="accordion-collapse collapse" aria-labelledby="headingShippingTimes"
                 data-bs-parent="#shippingAccordion">
                <div class="accordion-body">
                    <p>For standard shipping with Australia Post, delivery usually takes between 3-7 business days depending
                        on your location within Australia. Priority shipping via Team Global Express typically arrives within
                        1-3 business days. Please note that these are estimates, and delivery times can vary based on your
                        location and any potential delays with the courier services.</p>
                </div>
            </div>
        </div>

        <!-- Shipping Costs -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingShippingCosts">
                <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseShippingCosts" aria-expanded="false"
                        aria-controls="collapseShippingCosts">
                    How much does shipping cost?
                </button>
            </h2>
            <div id="collapseShippingCosts" class="accordion-collapse collapse" aria-labelledby="headingShippingCosts"
                 data-bs-parent="#shippingAccordion">
                <div class="accordion-body">
                    <p>Shipping costs depend on the size and weight of your order, as well as the delivery address. You can
                        view the shipping costs during checkout, after entering your address details. Standard shipping
                        rates apply for deliveries within Australia, and priority shipping costs will be calculated based
                        on your location. You will always be notified of the cost before completing your order.</p>
                </div>
            </div>
        </div>

        <!-- Large Item Deliveries -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingLargeItemDelivery">
                <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseLargeItemDelivery" aria-expanded="false"
                        aria-controls="collapseLargeItemDelivery">
                    How are large items delivered?
                </button>
            </h2>
            <div id="collapseLargeItemDelivery" class="accordion-collapse collapse" aria-labelledby="headingLargeItemDelivery"
                 data-bs-parent="#shippingAccordion">
                <div class="accordion-body">
                    <p><strong>Oversized Delivery:</strong><br>
                        We use third parties for the delivery of all oversized items. Oversized delivery refers to items that
                        cannot be delivered by Australia Post’s standard services due to weight and size. These items include
                        furniture, rugs, and larger homeware pieces.</p>

                    <p>To check if the product you are viewing is classified as oversized, please refer to the ‘Product Information’
                        section of the product listing. Then, identify the ‘Delivery Type’ of the product.</p>

                    <p>Once you place your order for an oversized item on our website, you'll receive an Order Confirmation email
                        confirming your order details, usually within an hour.</p>

                    <p>Once dispatched, our delivery partner will send you a text message when your item arrives at their main depot.
                        If your order contains both oversized items and standard delivery items, your standard items will be dispatched
                        separately via Australia Post.</p>

                    <p><strong>Delivery Time Estimates:</strong></p>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>State</th>
                            <th>Metro</th>
                            <th>Regional</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>VIC</td>
                            <td>2 - 3 business days</td>
                            <td>6 - 7 business days</td>
                        </tr>
                        <tr>
                            <td>NSW</td>
                            <td>2 - 4 business days</td>
                            <td>4 - 6 business days</td>
                        </tr>
                        <tr>
                            <td>QLD</td>
                            <td>4 - 5 business days</td>
                            <td>6 - 7 business days</td>
                        </tr>
                        <tr>
                            <td>ACT</td>
                            <td>4 - 5 business days</td>
                            <td>4 - 5 business days</td>
                        </tr>
                        <tr>
                            <td>SA</td>
                            <td>2 - 5 business days</td>
                            <td>5 - 9 business days</td>
                        </tr>
                        <tr>
                            <td>WA</td>
                            <td>6 - 8 business days</td>
                            <td>8 - 10 business days</td>
                        </tr>
                        <tr>
                            <td>TAS</td>
                            <td>6 - 8 business days</td>
                            <td>6 - 8 business days</td>
                        </tr>
                        <tr>
                            <td>NT</td>
                            <td>8 - 10 business days</td>
                            <td>8 - 10 business days</td>
                        </tr>
                        </tbody>
                    </table>

                    <p>We strive to deliver oversized items to your room of choice, however, in certain regional locations, this service
                        may not be available, and we will deliver to the front door.</p>

                    <p>Your delivery ETA will be communicated via SMS or email upon dispatch.</p>

                    <p>If you have any queries regarding oversized deliveries, please contact SteadFAST Logistics at 03 9012 5251 or email
                        <a href="mailto:operations@steadfastlogistics.com.au">operations@steadfastlogistics.com.au</a>.</p>

                    <p><strong>Important:</strong><br> Please note that there may be certain excluded postcodes where oversized item delivery is unavailable. </p>
                </div>
            </div>
        </div>

        <!-- Additional FAQs -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDeliveryLocations">
                <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseDeliveryLocations" aria-expanded="false"
                        aria-controls="collapseDeliveryLocations">
                    Which locations do you deliver to?
                </button>
            </h2>
            <div id="collapseDeliveryLocations" class="accordion-collapse collapse" aria-labelledby="headingDeliveryLocations"
                 data-bs-parent="#shippingAccordion">
                <div class="accordion-body">
                    <p>We deliver to all regions within Australia. However, delivery times and costs may vary depending on your location. Some remote or regional areas may experience longer shipping times. We currently do not offer international delivery, but we are exploring options to expand our shipping services.</p>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTrackOrder">
                <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTrackOrder" aria-expanded="false"
                        aria-controls="collapseTrackOrder">
                    How can I track my order?
                </button>
            </h2>
            <div id="collapseTrackOrder" class="accordion-collapse collapse" aria-labelledby="headingTrackOrder"
                 data-bs-parent="#shippingAccordion">
                <div class="accordion-body">
                    <p>Once your order has been dispatched, you will receive a tracking number via email. You can use this number to track your order through Australia Post or Team Global Express, depending on your chosen delivery method. Simply visit the courier’s website and enter the tracking number to see where your package is.</p>
                </div>
            </div>
        </div>
    </div>
</div>
