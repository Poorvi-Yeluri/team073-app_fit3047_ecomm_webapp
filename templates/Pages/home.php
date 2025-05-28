<?php if (!$this->Identity->isLoggedIn()) : ?>

    <!-- Hero Section -->
    <section class="w-100 d-none d-md-flex justify-content-center align-items-center position-relative" id="hero-section">
        <img src="<?= h($this->ContentBlock->text('hero-image-url')) ?>" alt="hero image" class="object-fit-cover w-100" style="height: 500px; object-position: center;">
        <div class="position-absolute top-50 start-50 translate-middle text-center text-light px-3">
            <p class="fs-1 font-serif" style="color: white;"><?= h($this->ContentBlock->text('hero-title')) ?></p>
            <p class="fs-4 font-sans" style="color: white;"><?= h($this->ContentBlock->text('hero-subtitle')) ?></p>
            <button class="btn btn-lg btn-dark rounded-0 fs-6"
                    onclick="scrollToSectionWithOffset('categories-section')"
                    style="background-color: black; color: white; letter-spacing: 2.5px">
            <?= h($this->ContentBlock->text('hero-button-text')) ?>
            </button>
            <!--                    onclick="window.location.href='--><?php //= h($this->ContentBlock->text('hero-button-link')) ?>//';"
        </div>
    </section>

    <script>
        function scrollToSectionWithOffset(id) {
            const element = document.getElementById(id);
            const yOffset = -120;
            const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

            window.scrollTo({ top: y, behavior: 'smooth' });
        }
    </script>
    <!-- Categories Section -->
    <section class="w-100 py-5" id="categories-section">
        <div class="container">
            <div class="col mb-5 text-center">
                <p class="fs-2 fw-normal font-serif"><?= h($this->ContentBlock->text('categories-title')) ?></p>
                <p class="fs-6 font-sans letter-spacing-1"><?= h($this->ContentBlock->text('categories-description')) ?></p>
            </div>
            <div class="row justify-content-center g-4">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        <a href="<?= h($this->ContentBlock->text("category{$i}-link")) ?>" class="text-dark">
                            <img src="<?= h($this->ContentBlock->text("category{$i}-image-url")) ?>" class="img-fluid rounded" alt="<?= h($this->ContentBlock->text("category{$i}-name")) ?>" style="object-fit: cover; width: 100%; height: 300px;">
                            <p class="fs-6 pt-2 fw-light font-sans" style="letter-spacing: 2px;"><?= h($this->ContentBlock->text("category{$i}-name")) ?></p>
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="w-100 py-5" style="background-color: #f5f7fa" id="about-us-section">
        <div class="container">
            <p class="fs-2 fw-normal font-serif"><?= h($this->ContentBlock->text('about-us-title')) ?></p>
            <?php for ($i = 1; $i <= 7; $i++): ?>
                <p class="fs-6 font-sans"><?= nl2br(h($this->ContentBlock->text("about-us-paragraph-{$i}"))) ?></p>
            <?php endfor; ?>
        </div>
    </section>

<?php endif; ?>
