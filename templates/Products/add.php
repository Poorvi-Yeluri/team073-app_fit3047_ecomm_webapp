<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="container mt-4">
    <div class="w-75">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><?= __('Add Product') ?></h4>
            <div>
                <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'btn btn-primary ms-2']) ?>
            </div>
        </div>

        <div class="card p-4 shadow-sm rounded-3">
            <div class="row w-100">
                <div class="col-12">
                    <?= $this->Form->create($product, ['type' => 'file', 'class' => 'needs-validation', 'novalidate' => true]) ?>

                    <fieldset>
                        <!-- Product Name -->
                        <div class="mb-3">
                            <?= $this->Form->control('name', [
                                'label' => ['text' => 'Product Name <span class="text-danger">*</span>', 'escape' => false],
                                'class' => 'form-control rounded-0 shadow-none border-dark',
                                'required' => true,
                                'placeholder' => 'Enter product name',
                                'id' => 'product_name',
                                'aria-describedby' => 'product_name_error'
                            ]) ?>
                            <div id="product_name_error" class="invalid-feedback">Product name is required.</div>
                        </div>

                        <div class="mb-3">
                            <?= $this->Form->control('category', [
                                'type' => 'select',
                                'label' => ['text' => 'Category <span class="text-danger">*</span>', 'escape' => false],
                                'options' => [
                                    'jewellery' => 'Jewellery',
                                    'home-decor' => 'Home Decor',
                                    'gifts' => 'Gifts',
                                    'clearance' => 'Clearance'
                                ],
                                'class' => 'form-control rounded-0 shadow-none border-dark',
                                'required' => true,
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
                                'required' => true,
                                'maxlength' => 500,
                                'aria-describedby' => 'description_error',
                            ]); ?>
                            <div id="description_error" class="invalid-feedback">Description is required and can't exceed 500 characters.
                            </div>
                        </div>

                        <!-- Base Price -->
                        <div class="mb-3">
                            <?= $this->Form->control('base_price', [
                                'label' => ['text' => 'Base Price <span class="text-danger">*</span>', 'escape' => false],
                                'type' => 'number',
                                'class' => 'form-control rounded-0 shadow-none border-dark',
                                'required' => true,
                                'min' => 0,
                                'step' => '0.01',
                                'placeholder' => 'Enter base price',
                                'id' => 'base_price',
                                'aria-describedby' => 'base_price_error',
                            ]) ?>
                            <div id="base_price_error" class="invalid-feedback">Base price is required and needs to be above 0.00.</div>
                        </div>



                        <div class="mb-3">
                            <?= $this->Form->control('stock_quantity', [
                                'label' => ['text' => 'Stock Quantity <span class="text-danger">*</span>', 'escape' => false],
                                'type' => 'tel',
                                'class' => 'form-control rounded-0 shadow-none border-dark',
                                'required' => true,
                                'placeholder' => 'Enter stock quantity',
                                'id' => 'stock_quantity',
                                'aria-describedby' => 'stock_quantity_error',
                                'maxlength' => 10,
                                'pattern' => '^[0-9]{1,10}$',
                                'title' => 'Only whole numbers up to 9999 are allowed',
                                'inputmode' => 'numeric',
                                'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                            ]) ?>
                            <div id="stock_quantity_error" class="invalid-feedback">
                                Stock quantity is required and must be a whole number up to 9999.
                            </div>
                        </div>

                        <!-- Product Images (Multiple Uploads) -->
                        <div class="mb-3">
                            <?= $this->Form->control('product_images._ids', [
                                'type' => 'file',
                                'class' => 'form-control rounded-0 shadow-none border-dark',
                                'multiple' => 'multiple',
                                'label' => ['text' => 'Upload Product Images <span class="text-danger">*</span>', 'escape' => false],
                                'required' => true,
                                'id' => 'product_images',
                                'aria-describedby' => 'product_images_error'
                            ]) ?>
                            <div id="product_images_error" class="invalid-feedback">Please upload at least one product image.</div>
                            <small class="form-text text-muted">You can upload multiple images. The first image will be used as the main image.</small>
                        </div>
                    </fieldset>

                    <?= $this->Form->submit('Submit', ['class' => 'btn btn-dark w-100 rounded-0 mt-3']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
