<?php if ($this->request->getAttribute('identity')) : ?>
    <script>
        window.location.href = "<?= $this->Url->build(['controller' => 'contact-messages', 'action' => 'index']) ?>";
    </script>
<?php else : ?>
    <?= $this->Html->css('style') ?>
    <section class="w-100 h-100 d-flex justify-content-center align-items-center" id="hero-section">
        <img src="/img/hero-section.jpg" alt="logo" class="object-fit-cover w-100"
             style="height: 100%; object-position: center;">
        <div class="position-absolute top-50 start-50 translate-middle text-center text-light px-3">
            <p class="fs-1" style="font-family: 'Baskerville', serif; color: white;">
                30% OFF RUSTIC RANGE
            </p>
            <p class="fs-4" style="font-family: 'Baskerville', sans-serif; color: white;">
                Create a wonderful rustic experience with our range
            </p>
            <button class="btn btn-lg btn-dark rounded-0 fs-6"
                    style="background-color: black; color: white; letter-spacing: 2.5px">SHOP NOW
            </button>

        </div>
    </section>


    <section class="w-100 py-5" id="new-arrivals-section">
        <div class="container">
            <!-- Title Section -->
            <div class="col mb-4">
                <p class="fs-2 mb-2 fw-normal" style="font-family: Baskerville;">New Arrivals</p>
                <p class="fs-6" style="font-family: Avenir;">Explore our newest arrivals — thoughtfully curated pieces to inspire and delight.</p>
            </div>

            <!-- Carousel Section -->
            <div id="categories-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <!-- Carousel Item 1 -->
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <img src="/img/landing-page/categories-section/cozy_house.jpeg" class="d-block w-100 img-fluid"
                                 alt="Jewellery" style="object-fit: cover; height: 500px;">
                            <div class="carousel-caption d-block bg-dark bg-opacity-50 px-3 py-2 rounded"
                                 style="border: 1px solid rgba(255, 255, 255, 0.2); max-width: 400px; margin: auto;">
                                <h5 style="font-family: 'Avenir', sans-serif; letter-spacing: 2px; color: white;">
                                    Jewellery
                                </h5>
                                <p class="fs-6" style="font-family: 'Baskerville', sans-serif; letter-spacing: 1px; color: white;">
                                    Exquisite craftsmanship in every piece.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Item 2 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img src="/img/landing-page/categories-section/nice_chair.jpeg" class="d-block w-100 img-fluid"
                                 alt="Furniture" style="object-fit: cover; height: 500px;">
                            <div class="carousel-caption d-block bg-dark bg-opacity-50 px-3 py-2 rounded"
                                 style="border: 1px solid rgba(255, 255, 255, 0.2); max-width: 400px; margin: auto;">
                                <h5 style="font-family: 'Avenir', sans-serif; letter-spacing: 2px; color: white;">
                                    Furniture
                                </h5>
                                <p style="font-family: 'Avenir', sans-serif; letter-spacing: 1px; color: white;">
                                    Elegant and modern furniture pieces for your home.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Item 3 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img src="/img/landing-page/categories-section/wooden_table.jpeg" class="d-block w-100 img-fluid"
                                 alt="Furniture" style="object-fit: cover; height: 500px;">
                            <div class="carousel-caption d-block bg-dark bg-opacity-50 px-3 py-2 rounded"
                                 style="border: 1px solid rgba(255, 255, 255, 0.2); max-width: 400px; margin: auto;">
                                <h5 style="font-family: 'Avenir', sans-serif; letter-spacing: 2px; color: white;">
                                    Furniture
                                </h5>
                                <p style="font-family: 'Avenir', sans-serif; letter-spacing: 1px; color: white;">
                                    Sturdy and stylish tables for every home.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Item 4 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img src="/img/landing-page/categories-section/gold_ring.jpeg" class="d-block w-100 img-fluid"
                                 alt="Jewellery" style="object-fit: cover; height: 500px;">
                            <div class="carousel-caption d-block bg-dark bg-opacity-50 px-3 py-2 rounded"
                                 style="border: 1px solid rgba(255, 255, 255, 0.2); max-width: 400px; margin: auto;">
                                <h5 style="font-family: 'Avenir', sans-serif; letter-spacing: 2px; color: white;">
                                    Jewellery
                                </h5>
                                <p style="font-family: 'Avenir', sans-serif; letter-spacing: 1px; color: white;">
                                    Luxurious gold rings for a timeless look.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#categories-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categories-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#categories-carousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#categories-carousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
        </div>
    </section>

    <style>

    </style>


    <section class="w-100 py-5" id="categories-section">
        <div class="container">
            <!-- Title Section -->
            <div class="col mb-5 text-center">
                <p class="fs-2 fw-normal" style="font-family: 'Baskerville', serif;">Categories</p>
                <p class="fs-6" style="font-family: 'Avenir', sans-serif; letter-spacing: 1px;">GleamAndGrace designs
                    the best decor and Jewelery with unparalleled craftsmanship and signature.</p>
            </div>

            <!-- Categories Grid -->
            <div class="row justify-content-center g-4">
                <div class="col text-center">
                    <img src="/img/landing-page/categories-section/gold_ring.jpeg" class="img-fluid" alt="Jewelery"
                         style="object-fit: cover; width: 300px; height: 300px;">
                    <p class="fs-6 pt-2 fw-light" style="font-family: 'Avenir', sans-serif; letter-spacing: 2px;">Rings</p>
                </div>
                <div class="col text-center">
                    <img src="/img/landing-page/categories-section/emerald_ring.png" class="img-fluid" alt="Jewelery"
                         style="object-fit: cover; width: 300px; height: 300px;">
                    <p class="fs-6 pt-2 fw-light" style="font-family: 'Avenir', sans-serif; letter-spacing: 2px;">
                        Bracelets</p>
                </div>
                <div class="col text-center">
                    <img src="/img/landing-page/categories-section/cozy_house.jpeg" class="img-fluid" alt="Jewelery"
                         style="object-fit: cover; width: 300px; height: 300px;">
                    <p class="fs-6 pt-2 fw-light" style="font-family: 'Avenir', sans-serif; letter-spacing: 2px;">Living
                        Room</p>
                </div>
                <div class="col text-center">
                    <img src="/img/landing-page/categories-section/nice_chair.jpeg" class="img-fluid" alt="Furniture"
                         style="object-fit: cover; width: 300px; height: 300px;">
                    <p class="fs-6 pt-2 fw-light" style="font-family: 'Avenir', sans-serif; letter-spacing: 2px;">
                        Bedroom</p>
                </div>
                <div class="col text-center">
                    <img src="/img/landing-page/categories-section/wooden_table.jpeg" class="img-fluid" alt="Furniture"
                         style="object-fit: cover; width: 300px; height: 300px;">
                    <p class="fs-6 pt-2 fw-light" style="font-family: 'Avenir', sans-serif; letter-spacing: 2px;">
                        Furniture</p>
                </div>
                <div class="col text-center">
                    <img src="/img/landing-page/categories-section/silver_ring.jpeg" class="img-fluid" alt="Jewelery"
                         style="object-fit: cover; width: 300px; height: 300px;">
                    <p class="fs-6 pt-2 fw-light" style="font-family: 'Avenir', sans-serif; letter-spacing: 2px;">Decor</p>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 py-5" style="background-color: #f5f7fa" id="about-us-section">
        <div class="container">
            <p class="fs-2 fw-normal" style="font-family: 'Baskerville', serif;">About Us</p>
            <p class="fs-6" style="font-family: 'Avenir', sans-serif;">
                Welcome to Gleam & Grace, where we transform houses into homes and spaces into serene sanctuaries.
                Our thoughtfully curated collection of homewares, bed linens, and décor is designed to bring elegance,
                comfort, and style into every corner of your home.
                <br><br>
                We have sought out the finest materials, premium fabrics, and the latest trends—both
                locally and globally—ensuring that every product embodies the perfect balance of quality and sophistication.
                Whether you’re looking for luxurious bedding, timeless furniture, or charming decorative accents,
                we are here to help you create a space that reflects your unique style.
                <br><br>
                At Gleam & Grace, we believe that comfort is an experience, not just a feeling. From plush cushions
                to cozy quilts, our expert-curated selections cater to every season, sleep style, and lifestyle.
                No matter where you are in Australia, we have your comfort covered.
                <br><br>
                Discover inspiration through our exclusive collections, style guides, and expert tips—because at
                Gleam & Grace, we believe that every home should be as beautiful as it is comfortable.
            </p>

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php endif; ?>
