<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="container">
    <div class="row">
        <aside class="col-md-3">
            <div class="side-nav">
                <h4 class="heading"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            </div>
        </aside>
        <div class="col-md-9">
            <div class="products form content">
                <?= $this->Form->create($product, ['type' => 'file']) ?>
                <fieldset>
                    <legend><?= __('Add Product') ?></legend>

                    <!-- Product Name -->
                    <div class="mb-3">
                        <?= $this->Form->control('name', [
                            'label' => 'Product Name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter product name'
                        ]) ?>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <?= $this->Form->control('description', [
                            'label' => 'Product Description',
                            'class' => 'form-control',
                            'placeholder' => 'Enter product description'
                        ]) ?>
                    </div>

                    <!-- Product Category -->
                    <div class="mb-3">
                        <?= $this->Form->control('category', [
                            'label' => 'Category',
                            'class' => 'form-control',
                            'placeholder' => 'Enter product category'
                        ]) ?>
                    </div>

                    <!-- Base Price -->
                    <div class="mb-3">
                        <?= $this->Form->control('base_price', [
                            'label' => 'Base Price',
                            'type' => 'number',
                            'class' => 'form-control',
                            'minlength' => 0,
                            'step' => '0.01',
                            'placeholder' => 'Enter product price'
                        ]) ?>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-3">
                        <?= $this->Form->control('stock_quantity', [
                            'label' => 'Stock Quantity',
                            'type' => 'number',
                            'class' => 'form-control',
                            'placeholder' => 'Enter stock quantity'
                        ]) ?>
                    </div>

                    <!-- Product Images (File Upload) -->
                    <div class="mb-3">
                        <label for="product_images"><?= __('Product Images') ?></label>
                        <?= $this->Form->control('product_images._ids', [
                            'type' => 'file',
                            'class' => 'form-control',
                            'multiple' => 'multiple',
                            'label' => 'Upload Product Images'
                        ]) ?>
                        <small class="form-text text-muted">You can upload multiple images. The first image will be set
                            as
                            the main image.</small>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <?= $this->Form->button(__('Submit'), [
                            'class' => 'btn btn-success w-100'
                        ]) ?>
                    </div>

                </fieldset>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
