<?php
/**
 * @var AppView $this
 * @var Product $product
 */

use App\Model\Entity\Product;
use App\View\AppView;

$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Products', ['action' => 'index']);
$this->Breadcrumbs->add('Edit Product');
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <!-- Back to Products button on the left with fixed size -->
                <div>
                    <?= $this->Html->link(__('Back to Products'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                </div>
                <!-- Title centered next to the button -->
                <h4 class="ms-4"><?= __('Edit Product: ') . h($product->name) ?></h4>
            </div>

            <div class="card p-4 shadow-sm rounded-3">
                <div class="row">
                    <div class="col-12">
                        <?= $this->Form->create($product, [
                            'type' => 'file',
                            'class' => 'needs-validation',
                            'novalidate' => true
                        ]) ?>

                        <fieldset>
                            <!-- Product Name -->
                            <div class="mb-3">
                                <?= $this->Form->control('name', [
                                    'label' => ['text' => 'Product Name', 'escape' => false],
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'required' => false,
                                    'placeholder' => 'Enter product name',
                                    'id' => 'product_name',
                                    'aria-describedby' => 'product_name_error'
                                ]) ?>
                                <div id="product_name_error" class="invalid-feedback">Product name is required.</div>
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <?= $this->Form->control('category', [
                                    'type' => 'select',
                                    'label' => ['text' => 'Category', 'escape' => false],
                                    'options' => [
                                        'jewellery' => 'Jewellery',
                                        'home-decor' => 'Home Decor',
                                        'gifts' => 'Gifts',
                                        'clearance' => 'Clearance'
                                    ],
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'required' => false,
                                    'empty' => 'Select a category',
                                    'id' => 'product_category',
                                    'aria-describedby' => 'product_category_error'
                                ]) ?>
                                <div id="product_category_error" class="invalid-feedback">Category is required.</div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <?= $this->Form->control('description', [
                                    'id' => 'description',
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'placeholder' => 'Enter product description',
                                    'label' => ['text' => 'Description', 'class' => 'mb-2'],
                                    'required' => false,
                                    'maxlength' => 500,
                                    'aria-describedby' => 'description_error',
                                ]); ?>
                                <div id="description_error" class="invalid-feedback">Description is required and can't exceed 500 characters.</div>
                            </div>

                            <!-- Base Price -->
                            <div class="mb-3">
                                <?= $this->Form->control('base_price', [
                                    'label' => ['text' => 'Base Price', 'escape' => false],
                                    'type' => 'tel',
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'required' => false,
                                    'placeholder' => 'Enter base price',
                                    'id' => 'base_price',
                                    'pattern' => '^\d+(\.\d{1,2})?$',
                                    'inputmode' => 'decimal',
                                    'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(?!^.*\.)./g, '')",
                                    'aria-describedby' => 'base_price_error',
                                ]) ?>
                                <div id="base_price_error" class="invalid-feedback">Base price is required and must be a valid number (e.g., 10.99).</div>
                            </div>

                            <!-- Product Images (Optional on Edit) -->
                            <div class="mb-3">
                                <?= $this->Form->control('product_images', [
                                    'type' => 'file',
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'multiple' => 'multiple',
                                    'required' => false,
                                    'label' => ['text' => 'Update Product Images', 'escape' => false],
                                    'id' => 'product_images',
                                    'aria-describedby' => 'product_images_help'
                                ]) ?>
                                <small id="product_images_help" class="form-text text-muted">You can upload new images. Existing ones will remain unless changed.</small>
                            </div>

                            <?php if (!empty($product->product_images)): ?>
                                <div class="mb-3">
                                    <label><?= __('Existing Images') ?></label>
                                    <div class="row g-3">
                                        <?php foreach ($product->product_images as $image): ?>
                                            <div class="col-6 col-sm-4 col-md-3">
                                                <div class="d-flex flex-column gap-3">
                                                    <img src="<?= $this->Url->build($image->image_url) ?>" alt="Product Image"
                                                         class="img-thumbnail w-100 object-fit-cover rounded"
                                                         style="border: 1px solid #ddd;">
                                                    <?= $this->Form->postLink(
                                                        __('Delete (ID: {0})', $image->id),
                                                        ['controller' => 'Products', 'action' => 'removeImage', $image->id],
                                                        [
                                                            'escape' => false,
                                                            'confirm' => __('Are you sure you want to delete image {0}?', $image->id),
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'title' => __('Delete Image'),
                                                        ]
                                                    ) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </fieldset>
                        <?= $this->Form->submit('Update',  ['class' => 'btn btn-dark w-100 mt-3']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
