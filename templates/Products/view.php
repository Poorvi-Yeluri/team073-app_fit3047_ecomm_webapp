<?php
use App\Model\Entity\ProductVariant;
use App\View\AppView;
/**
 * @var AppView $this
 * @var ProductVariant $variant
 */
?>

<div class="container mt-3">
    <div class="row">
        <!-- Main Image with Thumbnails -->
        <div class="col-md-7">
            <div class="text-center mb-3">
                <img id="mainProductImage"
                     src="<?= h($variant->main_image_url ) ?>"
                     alt="<?= h($variant->name) ?>"
                     class="img-fluid border"
                     style="object-fit: cover; width: 100%; max-height: 400px;">
            </div>

            <?php if (!empty($variant->image_urls)): ?>
                <div class="mt-3">
                    <div id="thumbnailRow" class="d-flex overflow-auto gap-2 px-1 pb-1 border-bottom"
                         style="scroll-behavior: smooth;">
                        <?php foreach ($variant->image_urls as $image): ?>
                            <img src="<?= h($image) ?>"
                                 alt="<?= h($variant->name) ?>"
                                 data-src="<?= h($image) ?>"
                                 class="thumb-image img-thumbnail p-0 rounded-0"
                                 style="cursor:pointer; width: 120px; height: 120px; object-fit: cover; flex: 0 0 auto;">
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="col-md-5 p-5" style="background-color: var(--light-gray);">
            <h3><?= h($variant->name) ?></h3>
            <h5 class="font-sans weight-regular">
                $<?= $this->Number->format(
                    $variant->price,
                    ['places' => 2, 'precision' => 2, 'locale' => 'en_US', 'currency' => true]
                ) ?>
            </h5>

            <?php if (!$this->Identity->isLoggedIn()) : ?>
                <?= $this->Form->create(null, [
                    'url' => ['controller' => 'Cart', 'action' => 'add', $variant->id],
                    'type' => 'post',
                    'class' => 'add-to-cart-form',
                    'data-variant-id' => $variant->id
                ]) ?>

                <div class="d-flex flex-column my-3">
                    <label for="quantity" class="font-sans">Quantity</label>
                    <?= $this->Form->control('quantity', [
                        'type' => 'select',
                        'label' => false,
                        'required' => true,
                        'empty' => 'Select quantity',
                        'options' => array_combine(range(1, $variant->stock_quantity), range(1, $variant->stock_quantity)),
                        'class' => 'w-50 p-2 border-gray',
                        'id' => 'quantity'
                    ]) ?>
                </div>

                <?php if ($variant->product->category === "jewellery") : ?>
                    <div class="d-flex flex-column my-3">
                        <label for="size" class="font-sans">Size</label>
                        <?= $this->Form->control('size', [
                            'type' => 'select',
                            'empty' => 'Select size',
                            'required' => true,
                            'label' => false,
                            'options' => array_reduce(
                                $variant->product_variant_attributes,
                                function ($carry, $attr) {
                                    if ($attr->attribute_value->attribute->name === 'Size') {
                                        $carry[$attr->attribute_value->value] = $attr->attribute_value->value;
                                    }
                                    return $carry;
                                },
                                []
                            ),
                            'class' => 'w-50 p-2 border-gray',
                            'id' => 'size'
                        ]) ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex w-50 gap-2 font-sans mb-3">
                    <?= $this->Form->button(__('Add to Cart'), [
                        'class' => 'btn btn-lg btn-dark rounded-pill w-100'
                    ]) ?>
                </div>

                <?= $this->Form->end() ?>
            <?php endif; ?>

            <hr />

            <div class="mb-3 mt-3">
                <strong class="text-h4"><?= __('Description') ?></strong>
                <p><?= h($variant->product->description) ?></p>
            </div>
        </div>
    </div>

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
