<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <?php if (!empty($product->product_images)) : ?>
                    <img src="<?= h($product->product_images[0]->image_url) ?>" style="object-fit: cover" alt="<?= h($product->name) ?>"
                         class="img-fluid mb-3">
                <?php else : ?>
                    <img src="https://picsum.photos/" style="object-fit: cover" alt="No Image Available"
                         class="img-fluid mb-3">
                <?php endif; ?>
            </div>
            <div class="row">
                <?php if (!empty($product->product_images)) : ?>
                    <?php foreach ($product->product_images as $image) : ?>
                        <div class="col-4">
                            <img src="<?= h($image->image_url) ?>" alt="<?= h($product->name) ?>" class="img-thumbnail">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?= h($product->name) ?></h3>
                    <p class="card-text"><?= h($product->category) ?></p>

                    <p class="h4"><?= $this->Number->format($product->base_price) ?></p>

                    <form action="/cart/add" method="post" class="mb-3">
                        <input type="hidden" name="product_id" value="<?= h($product->id) ?>">

                        <div class="form-group">
                            <label for="quantity"><?= __('Quantity') ?></label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                        </div>
                        <button type="submit" class="btn btn-primary"><?= __('Add to Cart') ?></button>
                    </form>

                    <form action="/wishlist/add" method="post">
                        <input type="hidden" name="product_id" value="<?= h($product->id) ?>">
                        <button type="submit" class="btn btn-outline-secondary"><?= __('Add to Wishlist') ?></button>
                    </form>

                    <hr>

                    <div class="mb-3">
                        <strong><?= __('Description') ?></strong>
                        <p><?= h($product->description) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($product->product_variants)) : ?>
        <div class="row mt-5">
            <div class="col-md-12">
                <h4><?= __('Also available in other Styles') ?></h4>
                <div class="row">
                    <?php foreach ($product->product_variants as $variant) : ?>
                        <div class="col-md-3">
                            <div class="card">
                                <?php if (!empty($variant->product_variant_images)) : ?>
                                    <img src="<?= h($variant->product_variant_images[0]->image_url) ?>" alt="<?= h($variant->name) ?>"
                                         class="card-img-top">
                                <?php else : ?>
                                    <img src="https://picsum.photos/" alt="<?= h($variant->name) ?>"
                                         class="card-img-top">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= h($variant->name) ?></h5>
                                    <p class="h6"><?= $this->Number->format($variant->price) ?></p>
                                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $product->id, '?' => ['variant' => $variant->id]]) ?>"
                                       class="btn btn-outline-primary"><?= __('View Variant') ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-5">
        <div class="col-md-12">
            <h4><?= __('You May Like') ?></h4>
            <div class="row">
                <?php foreach ($productVariants as $recommendedProduct) : ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?= h($recommendedProduct->image_url) ?>"
                                 alt="<?= h($recommendedProduct->name) ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= h($recommendedProduct->name) ?></h5>
                                <p class="h6"><?= $this->Number->format($recommendedProduct->base_price) ?></p>
                                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $recommendedProduct->id]) ?>"
                                   class="btn btn-outline-primary"><?= __('View Details') ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h4><?= __('Customer Reviews') ?></h4>

            <?php if (!empty($product->reviews)) : ?>
                <div class="list-group">
                    <?php foreach ($product->reviews as $review) : ?>
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

            <h5 class="mt-4"><?= __('Write a Review') ?></h5>
            <form action="/reviews/add" method="post">
                <div class="form-group">
                    <label for="customer_name"><?= __('Your Name') ?></label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="review_text"><?= __('Your Review') ?></label>
                    <textarea name="review_text" id="review_text" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rating"><?= __('Rating') ?></label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="5"><?= __('5 Stars') ?></option>
                        <option value="4"><?= __('4 Stars') ?></option>
                        <option value="3"><?= __('3 Stars') ?></option>
                        <option value="2"><?= __('2 Stars') ?></option>
                        <option value="1"><?= __('1 Star') ?></option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?= __('Submit Review') ?></button>
            </form>
        </div>
    </div>
</div>
