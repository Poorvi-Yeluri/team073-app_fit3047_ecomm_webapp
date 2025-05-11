<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
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
                                    'label' => ['text' => 'Product Name <span class="text-danger">*</span>', 'escape' => false],
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'required' => true,
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
                                <div id="description_error" class="invalid-feedback">Description is required and can't exceed 500 characters.</div>
                            </div>

                            <!-- Base Price -->
                            <div class="mb-3">
                                <?= $this->Form->control('base_price', [
                                    'label' => ['text' => 'Base Price <span class="text-danger">*</span>', 'escape' => false],
                                    'type' => 'tel',
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'required' => true,
                                    'placeholder' => 'Enter base price',
                                    'id' => 'base_price',
                                    'pattern' => '^\d+(\.\d{1,2})?$',
                                    'inputmode' => 'decimal',
                                    'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(?!^.*\.)./g, '')",
                                    'aria-describedby' => 'base_price_error',
                                ]) ?>
                                <div id="base_price_error" class="invalid-feedback">Base price is required and must be a valid number (e.g., 10.99).</div>
                            </div>

                            <!-- Stock Quantity -->
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
                                <div id="stock_quantity_error" class="invalid-feedback">Stock quantity must be a whole number up to 9999.</div>
                            </div>

                            <!-- Product Images (Optional on Edit) -->
                            <div class="mb-3">
                                <?= $this->Form->control('product_images._ids', [
                                    'type' => 'file',
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'multiple' => 'multiple',
                                    'label' => ['text' => 'Update Product Images', 'escape' => false],
                                    'id' => 'product_images',
                                    'aria-describedby' => 'product_images_help'
                                ]) ?>
                                <small id="product_images_help" class="form-text text-muted">You can upload new images. Existing ones will remain unless changed.</small>
                            </div>

                        </fieldset>

                        <?= $this->Form->submit('Update', ['class' => 'btn btn-dark w-100 mt-3']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
