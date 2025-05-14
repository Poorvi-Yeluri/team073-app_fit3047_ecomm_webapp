<?php
/**
 * @var AppView $this
 * @var Product $product
 * @var ProductVariant|null $selectedVariant
 */

use App\Model\Entity\Product;
use App\Model\Entity\ProductVariant;
use App\View\AppView;

$activeItem = $selectedVariant ?? $product;
?>

<div class="container mt-3">
    <div class="row">
        <!-- Main Image with Thumbnails Below -->
        <div class="col-md-7">
            <div class="text-center mb-3">
                <img id="mainProductImage"
                     src="<?= h($activeItem->image_urls[0] ?? $product->main_image_url) ?>"
                     alt="<?= h($activeItem->name) ?>"
                     class="img-fluid border"
                     style="object-fit: cover; width: 100%; max-height: 400px;">
            </div>

            <?php if (!empty($activeItem->image_urls)): ?>
                <div class="mt-3">
                    <div id="thumbnailRow" class="d-flex overflow-auto gap-2 px-1 pb-1 border-bottom"
                         style="scroll-behavior: smooth;">
                        <?php foreach ($activeItem->image_urls as $image): ?>
                            <img src="<?= h($image) ?>"
                                 alt="<?= h($activeItem->name) ?>"
                                 data-src="<?= h($image) ?>"
                                 class="thumb-image img-thumbnail p-0 rounded-0"
                                 style="cursor:pointer; width: 120px; height: 120px; object-fit: cover; flex: 0 0 auto;">
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info (right column) -->
        <div class="col-md-5 p-5" style="background-color: var(--light-gray);">
            <h3><?= h($activeItem->name) ?></h3>
            <h5 class="font-sans weight-regular">
                $<?= $this->Number->format(
                    $activeItem->price ?? $product->base_price,
                    ['places' => 2, 'precision' => 2, 'locale' => 'en_US', 'currency' => true]
                ) ?>
            </h5>

            <!-- Quantity Selection (for users not logged in) -->
            <?php if (!$this->Identity->isLoggedIn()) : ?>
                <div class="d-flex flex-column my-3">
                    <label for="quantity" class="font-sans">Quantity</label>
                    <select name="quantity" class="w-25 p-2 border-gray" style="height: 35px;" id="quantity">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <?php if ($product->category === "jewellery") : ?>
                    <div class="d-flex flex-column my-3">
                        <label for="size" class="font-sans">Size</label>
                        <select name="size" class="w-25 p-2 border-gray" style="height: 35px;" id="size">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="d-flex w-50 gap-2 font-sans mb-3">
                <button class="btn btn-lg btn-dark rounded-pill w-100">Add to Cart</button>
            </div>

            <div class="mb-3 mt-3">
                <strong class="text-h4"><?= __('Description') ?></strong>
                <p><?= h($activeItem->description ?? $product->description) ?></p>
            </div>
        </div>
    </div>

    <?php if (in_array($product->category, ['home-decor'])): ?>
        <div class="row mt-5">
            <h4 class="mb-4">Also Available in Other Styles</h4>

            <?php if ($selectedVariant): ?>
                <!-- Link back to base product -->
                <div class="col-md-3 mb-3">
                    <a href="<?= $this->Url->build([
                        'controller' => 'Products',
                        'action' => 'view',
                        $product->slug
                    ]) ?>"
                       class="text-dark">
                        <img src="<?= h($product->main_image_url) ?>"
                             alt="Base Product"
                             class="p-0 rounded-0"
                             style="cursor:pointer; width: 190px; height: 190px; object-fit: cover;">
                        <p class="mt-1"><?= h($product->name) ?></p>
                    </a>
                </div>
            <?php else: ?>
                <!-- Show all variants -->
                <?php foreach ($product->product_variants as $variant): ?>
                    <?php if (!empty($variant->image_urls)): ?>
                        <div class="col-md-3 mb-3">
                            <a href="<?= $this->Url->build([
                                'controller' => 'Products',
                                'action' => 'view',
                                $product->slug,
                                '?' => ['variant' => $variant->sku]
                            ]) ?>"
                               class="text-dark">

                                <img src="<?= h($variant->image_urls[0]) ?>"
                                     alt="<?= h($variant->sku) ?>"
                                     class="p-0 rounded-0"
                                     style="cursor:pointer; width: 190px; height: 190px; object-fit: cover;">
                                <p class="mt-1"><?= h($variant->name) ?></p>
                            </a>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>


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
</div>
