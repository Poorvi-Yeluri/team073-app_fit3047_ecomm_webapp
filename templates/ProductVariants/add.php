<?php
use App\Model\Entity\Product;
use App\Model\Entity\ProductVariant;
use App\View\AppView;
/**
 * @var AppView $this
 * @var Product $products
 * @var ProductVariant $productVariant
 * @var array $groupedAttributeValues
 */
?>
<div class="container mt-4">
    <div class="row justify-content-center mb-3">
        <h4 class="ms-3 mb-0"><?= __('Add Product Variant') ?></h4>

    </div>

    <?= $this->Form->create($productVariant, ['type' => 'file', 'class' => 'needs-validation', 'novalidate' => true]) ?>

    <div class="row">
        <!-- Left Card -->
        <div class="col-md-6 mb-4">
            <div class="card p-4 shadow-sm rounded-3 h-100 shadow-none border-dark">
                <fieldset>
                    <!-- Name -->
                    <div class="mb-3 form-group required">
                        <?= $this->Form->control('name', [
                            'label' => ['text' => 'Name', 'class' => 'mb-2 control-label'],
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'placeholder' => 'Enter product variant name',
                            'id' => 'product_name',
                            'aria-describedby' => 'product_name_error'
                        ]) ?>
                        <div id="product_name_error" class="invalid-feedback">Product Variant name is required.</div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3 form-group required">
                        <?= $this->Form->control('price', [
                            'label' => ['text' => 'Price', 'class' => 'mb-2 control-label'],
                            'type' => 'number',
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'min' => 0,
                            'step' => '0.01',
                            'placeholder' => 'Enter price',
                            'id' => 'base_price',
                            'aria-describedby' => 'base_price_error',
                        ]) ?>
                        <div id="base_price_error" class="invalid-feedback">Price is required and needs to be above 0.00.</div>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-3 form-group required">
                        <?= $this->Form->control('stock_quantity', [
                            'label' => ['text' => 'Stock', 'class' => 'mb-2 control-label'],
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
                        <div id="stock_quantity_error" class="invalid-feedback">Stock quantity is required and can be a number up to 9999.</div>
                    </div>

                    <!-- SKU -->
                    <div class="mb-3 form-group required">
                        <?= $this->Form->control('sku', [
                            'label' => ['text' => 'SKU', 'class' => 'mb-2 control-label'],
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'placeholder' => 'Enter product variant SKU',
                            'id' => 'sku',
                            'aria-describedby' => 'sku_error'
                        ]) ?>
                        <div id="sku_error" class="invalid-feedback">SKU for the product variant is required.</div>
                        <small id="sku_help" class="form-text text-muted">
                            Please create the SKU as per relevant attributes (e.g., sapphire-necklace-green).
                        </small>
                    </div>

                    <!-- Base Product -->
                    <div class="mb-3 form-group required">
                        <?= $this->Form->control('product_id', [
                            'type' => 'select',
                            'label' => ['text' => 'Base Product', 'class' => 'mb-2 control-label'],
                            'options' => $products,
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'placeholder' => 'Select the product you wish to associate this variant with',
                            'empty' => 'Select the product you wish to associate for this variant',
                            'id' => 'product',
                            'aria-describedby' => 'product_error'
                        ]) ?>
                        <div id="product_category_error" class="invalid-feedback">Category is required.</div>
                    </div>
                </fieldset>
            </div>
        </div>

        <!-- Right Card -->
        <div class="col-md-6 mb-4">
            <div class="card p-4 shadow-sm rounded-3 w-100 h-100 shadow-none border-dark">
                <fieldset>
                    <!-- Attribute Values -->
                    <div class="mb-3 w-100 form-group required">
                        <?= $this->Form->control('variant_attribute_values._ids', [
                            'type' => 'select',
                            'multiple' => true,
                            'options' => $groupedAttributeValues,
                            'label' => ['text' => 'Variant Attributes', 'class' => 'mb-2 control-label'],
                            'class' => 'form-control select2 rounded-0 shadow-none border-dark',
                            'id' => 'variant_attribute_values',
                            'aria-describedby' => 'variant_attribute_values_error variant_attribute_values_help'
                        ]) ?>
                        <div id="variant_attribute_values_error" class="invalid-feedback">
                            Please select at least one attribute value.
                        </div>
                        <small id="variant_attribute_values_help" class="form-text text-muted">
                            Select one or more attribute values for this product variant.
                        </small>
                    </div>

                    <!-- Product Images -->
                    <div class="mb-3">
                        <?= $this->Form->control('product_variant_images[]', [
                            'type' => 'file',
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'multiple' => 'multiple',
                            'label' => ['text' => 'Upload Product Variant Images <span class="text-danger">*</span>', 'escape' => false],
                            'required' => true,
                            'id' => 'product_variant_images',
                            'name' => 'product_variant_images[]',
                            'aria-describedby' => 'product_variant_images_error'
                        ]) ?>
                        <div id="product_variant_images_error" class="invalid-feedback">Please upload at least one product image.</div>
                        <small class="form-text text-muted">You can upload multiple images. The first image will be used as the main image.</small>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $this->Form->submit('Submit', ['class' => 'btn btn-dark w-100 rounded-0 mt-3']) ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>


<script>
    $(document).ready(function() {
        $('#variant_attribute_values').select2({
            placeholder: 'Select attribute values',
            allow_clear: true,
            width: '100%',

        });
    });
</script>
