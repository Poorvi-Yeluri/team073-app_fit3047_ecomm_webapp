<?php if ($this->Identity->isLoggedIn()) : ?>
    <script>
        window.location.href = "<?= $this->Url->build(['controller' => 'contact-messages', 'action' => 'index']) ?>";
    </script>
<?php else : ?>
    <section class="w-100 h-100 d-none d-md-flex justify-content-center align-items-center position-relative" id="hero-section">
        <img src="/img/hero-section.jpg" alt="hero image" class="object-fit-cover w-100"
             style="height: 100%; object-position: center;">
        <div class="position-absolute top-50 start-50 translate-middle text-center text-light px-3">
            <p class="fs-1 font-serif" style="color: white;">
                30% OFF RUSTIC RANGE
            </p>
            <p class="fs-4 font-sans" style="color: white;">
                Create a wonderful rustic experience with our range
            </p>
            <button class="btn btn-lg btn-dark rounded-0 fs-6"
                    style="background-color: black; color: white; letter-spacing: 2.5px">SHOP NOW
            </button>
        </div>
    </section>

    <section class="w-100 py-md-5" id="new-arrivals-section">
        <div class="container">
            <!-- Title Section -->
            <div class="col mb-4 text-center">
                <p class="fs-2 mb-2 fw-normal font-serif">New Arrivals</p>
                <p class="fs-6 font-sans">Explore our newest arrivals — thoughtfully curated pieces to inspire and delight.</p>
            </div>

            <!-- Carousel Section -->
            <div id="categories-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#categories-carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <img src="/img/landing-page/categories-section/cozy_house.jpeg" class="d-block w-100 img-fluid"
                             alt="Jewellery" style="object-fit: cover; height: 500px;">
                        <div class="carousel-caption d-block d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5 class="font-sans text-white" style="letter-spacing: 2px;">Jewellery</h5>
                            <p class="fs-6 font-sans text-white" style="letter-spacing: 1px;">Exquisite craftsmanship in every piece.</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <img src="/img/landing-page/categories-section/gold_ring.jpeg" class="d-block w-100 img-fluid"
                             alt="Gifts" style="object-fit: cover; height: 500px;">
                        <div class="carousel-caption d-block d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5 class="font-sans text-white" style="letter-spacing: 2px;">Gifts</h5>
                            <p class="fs-6 font-sans text-white" style="letter-spacing: 1px;">Timeless treasures for loved ones.</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <img src="/img/landing-page/categories-section/emerald_ring.png" class="d-block w-100 img-fluid"
                             alt="Emerald Ring" style="object-fit: cover; height: 500px;">
                        <div class="carousel-caption d-block d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5 class="font-sans text-white" style="letter-spacing: 2px;">Emerald Ring</h5>
                            <p class="fs-6 font-sans text-white" style="letter-spacing: 1px;">Bold elegance in every detail.</p>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="carousel-item">
                        <img src="/img/landing-page/categories-section/nice_chair.jpeg" class="d-block w-100 img-fluid"
                             alt="Furniture" style="object-fit: cover; height: 500px;">
                        <div class="carousel-caption d-block d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5 class="font-sans text-white" style="letter-spacing: 2px;">Furniture</h5>
                            <p class="fs-6 font-sans text-white" style="letter-spacing: 1px;">Comfort meets modern design.</p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#categories-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categories-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>


    <section class="w-100 py-5" id="categories-section">
        <div class="container">
            <!-- Title Section -->
            <div class="col mb-5 text-center">
                <p class="fs-2 fw-normal font-serif">Categories</p>
                <p class="fs-6 font-sans letter-spacing-1">
                    GleamAndGrace designs the best decor and Jewellery with unparalleled craftsmanship and signature.
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="row justify-content-center g-4">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'jewellery']]) ?>" class="text-dark">
                        <img src="/img/landing-page/categories-section/emerald_ring.png" class="img-fluid rounded" alt="Jewellery" style="object-fit: cover; width: 100%; height: 300px;">
                        <p class="fs-6 pt-2 fw-light font-sans" style="letter-spacing: 2px;">Jewellery</p>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'home-decor']]) ?>" class="text-dark">
                        <img src="/img/landing-page/categories-section/cozy_house.jpeg" class="img-fluid rounded" alt="Home Decor" style="object-fit: cover; width: 100%; height: 300px;">
                        <p class="fs-6 pt-2 fw-light font-sans" style="letter-spacing: 2px;">Home Decor</p>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'clearance']]) ?>" class="text-dark">
                        <img src="/img/landing-page/categories-section/nice_chair.jpeg" class="img-fluid rounded" alt="Clearance" style="object-fit: cover; width: 100%; height: 300px;">
                        <p class="fs-6 pt-2 fw-light font-sans" style="letter-spacing: 2px;">Clearance</p>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'gifts']]) ?>" class="text-dark">
                        <img src="/img/landing-page/categories-section/gold_ring.jpeg" class="img-fluid rounded" alt="Gifts" style="object-fit: cover; width: 100%; height: 300px;">
                        <p class="fs-6 pt-2 fw-light font-sans" style="letter-spacing: 2px;">Gifts</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 py-5" style="background-color: #f5f7fa" id="about-us-section">
        <div class="container">
            <p class="fs-2 fw-normal font-serif">About Us</p>
            <p class="fs-6 font-sans">
                Welcome to Gleam & Grace, where we transform houses into homes and spaces into serene sanctuaries.
                Our thoughtfully curated collection of homewares, bed linens, and décor is designed to bring elegance, comfort, and style into every corner of your home.
                <br><br>
                We have sought out the finest materials, premium fabrics, and the latest trends—both locally and globally—ensuring that every product embodies the perfect balance of quality and sophistication.
                Whether you’re looking for luxurious bedding, timeless furniture, or charming decorative accents, we are here to help you create a space that reflects your unique style.
                <br><br>
                At Gleam & Grace, we believe that comfort is an experience, not just a feeling. From plush cushions to cozy quilts, our expert-curated selections cater to every season, sleep style, and lifestyle.
                No matter where you are in Australia, we have your comfort covered.
                <br><br>
                Discover inspiration through our exclusive collections, style guides, and expert tips—because at Gleam & Grace, we believe that every home should be as beautiful as it is comfortable.
            </p>
        </div>
    </section>

<?php endif; ?>
