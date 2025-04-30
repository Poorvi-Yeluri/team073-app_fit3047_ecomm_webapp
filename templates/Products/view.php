<div class="container mt-3">
    <div class="row">
        <!-- Main Image with Thumbnails Below -->
        <div class="col-md-7">
            <div class="text-center mb-3">
                <img id="mainProductImage"
                     src="<?= h($product['images'][0] ?? 'https://picsum.photos/600/600') ?>"
                     alt="<?= h($product['name']) ?>"
                     class="img-fluid border"
                     style="object-fit: cover; width: 100%; max-height: 400px;">
            </div>

            <?php if (!empty($product['images'])) : ?>
                <div class="mt-3">
                    <div id="thumbnailRow" class="d-flex overflow-auto gap-2 px-1 pb-1 border-bottom"
                         style="scroll-behavior: smooth;">
                        <?php foreach ($product['images'] as $index => $image) : ?>
<!--                        --><?php //= debug($product['images']) ?>
                            <img src="<?= h($image) ?>"
                                 alt="<?= h($product['name']) ?>"
                                 class="thumb-image img-thumbnail p-0 rounded-0"
                                 data-src="<?= h($image) ?>"
                                 style="cursor:pointer; width: 120px; height: 120px; object-fit: cover; flex: 0 0 auto;">
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info (right column) -->
        <div class="col-md-5 p-5" style="background-color: var(--light-gray);">
            <h3><?= h($product['name']) ?></h3>
            <h5 class="font-sans weight-regular">$<?= $this->Number->format(
                    $product['base_price'], ['places' => 2, 'precision' => 2, 'locale' => 'en_US', 'currency' => true]
                ) ?></h5>
<!--            --><?php //if (!$this->Identity->isLoggedIn()) : ?>
<!--                <div class="d-flex flex-column my-3">-->
<!--                    <span class="font-sans">Quantity</span>-->
<!--                    <select name="quantity" class="w-25 p-2 border-gray" style="height: 35px;" id="quantity">-->
<!--                        --><?php //for ($i = 1; $i <= 10; $i++): ?>
<!--                            <option value="--><?php //= $i ?><!--">--><?php //= $i ?><!--</option>-->
<!--                        --><?php //endfor; ?>
<!--                    </select>-->
<!--                </div>-->
<!--            --><?php //endif; ?>

            <!-- <div class="d-flex w-75 gap-2 font-sans mb-3">
                 <button class="btn btn-md rounded-pill w-100" style="background-color: var(--accent-color); color: var(--white)">Add to Cart</button>
                 <button class="btn btn-md btn-secondary rounded-pill w-100">Wishlist</button>
             </div> -->

            <div class="mb-3 mt-3">
                <strong class="text-h4"><?= __('Description') ?></strong>
                <p><?= h($product['description']) ?></p>
            </div>

            <?php if (!$this->Identity->isLoggedIn()) : ?>
                <div class="mb-4">
                    <strong><?= __('Interested in Purchasing?') ?></strong><br>
                    If you would like to purchase this product, please contact us on
                    <a class="text-dark"
                       style="border-bottom: 2px solid var(--accent-color); text-decoration: none;"
                       href="tel:+618121234567">
                        +61 812 123 4567
                    </a>
                    <br> <br>
                    You can also submit an enquiry through our
                    <a class="text-dark fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">
                        Contact Form
                    </a>.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- <div class="row mt-5">
        <div class="col-md-12">
            <h4><?= __('You May Like') ?></h4>
            <div class="row">

            </div>
        </div>
    </div> -->

    <!-- Customer Reviews Section -->
    <!-- <div class="row mt-5">
        <div class="col-md-12">
            <h4><?= __('Customer Reviews') ?></h4>

            <?php if (!empty($product['reviews'])) : ?>
                <div class="list-group">
                    <?php foreach ($product['reviews'] as $review) : ?>
                        <div class="list-group-item">
                            <h5 class="mb-1"><?= h($review->customer_name) ?></h5>
                            <p class="mb-1"><?= h($review->review_text) ?></p>
                            <small><?= __('Rating: ') ?><?= $review->rating ?>/5</small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p><?= __('No reviews yet.') ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const thumbnails = document.querySelectorAll(".thumb-image");
            const mainImage = document.getElementById("mainProductImage");

            thumbnails.forEach(thumb => {
                thumb.addEventListener("click", () => {
                    const newSrc = thumb.getAttribute("data-src");
                    mainImage.src = newSrc;
                });
            });
        });
    </script>
