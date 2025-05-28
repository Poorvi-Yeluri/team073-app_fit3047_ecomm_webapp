<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductVariant $productVariant
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductVariant $productVariant
 */
use Cake\Routing\Router;

$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Product Variants', ['action' => 'index']);
$this->Breadcrumbs->add('Edit Product Variant');
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <?= $this->Html->link(__('Back to Variants'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                </div>
                <h4 class="ms-4"><?= h($productVariant->name) ?></h4>
            </div>

            <div class="card p-4 shadow-sm rounded-3">
                <?= $this->Form->create($productVariant, [
                    'type' => 'file',
                    'class' => 'needs-validation',
                    'novalidate' => true
                ]) ?>

                <fieldset>
                    <!-- Variant Name -->
                    <div class="mb-3">
                        <?= $this->Form->control('name', [
                            'label' => ['text' => 'Variant Name', 'escape' => false],
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'placeholder' => 'Enter variant name',
                            'id' => 'variant_name',
                            'aria-describedby' => 'variant_name_error'
                        ]) ?>
                        <div id="variant_name_error" class="invalid-feedback">Variant name is required.</div>
                    </div>

                    <!-- Product Select -->
                    <div class="mb-3">
                        <?= $this->Form->control('product_id', [
                            'type' => 'select',
                            'options' => $products,
                            'empty' => '-- Select Product --',
                            'label' => ['text' => 'Assign to Product', 'escape' => false],
                            'class' => 'form-select rounded-0 shadow-none border-dark',
                            'required' => true,
                            'id' => 'product_id',
                            'aria-describedby' => 'product_id_error'
                        ]) ?>
                        <div id="product_id_error" class="invalid-feedback">Please select a product.</div>
                    </div>

                    <!-- SKU -->
                    <div class="mb-3">
                        <?= $this->Form->control('sku', [
                            'label' => ['text' => 'SKU', 'escape' => false],
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => false,
                            'placeholder' => 'Enter SKU',
                            'id' => 'sku',
                            'aria-describedby' => 'sku_error'
                        ]) ?>
                        <div id="sku_error" class="invalid-feedback">Please enter a valid SKU.</div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <?= $this->Form->control('price', [
                            'label' => ['text' => 'Price', 'escape' => false],
                            'type' => 'tel',
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'placeholder' => 'Enter price',
                            'id' => 'price',
                            'pattern' => '^\d+(\.\d{1,2})?$',
                            'inputmode' => 'decimal',
                            'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(?!^.*\.)./g, '')",
                            'aria-describedby' => 'price_error',
                        ]) ?>
                        <div id="price_error" class="invalid-feedback">Price is required and must be a valid number (e.g., 10.99).</div>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-3">
                        <?= $this->Form->control('stock_quantity', [
                            'label' => ['text' => 'Stock Quantity', 'escape' => false],
                            'type' => 'number',
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'required' => true,
                            'placeholder' => 'Enter stock quantity',
                            'id' => 'stock_quantity',
                            'min' => 0,
                            'aria-describedby' => 'stock_quantity_error'
                        ]) ?>
                        <div id="stock_quantity_error" class="invalid-feedback">Stock quantity is required and must be a non-negative number.</div>
                    </div>

                    <!-- Images upload -->
                    <div class="mb-3">
                        <?= $this->Form->control('product_variant_images', [
                            'type' => 'file',
                            'class' => 'form-control rounded-0 shadow-none border-dark',
                            'multiple' => 'multiple',
                            'required' => false,
                            'label' => ['text' => 'Update Variant Images', 'escape' => false],
                            'id' => 'product_variant_images',
                            'aria-describedby' => 'variant_images_help'
                        ]) ?>
                        <small id="variant_images_help" class="form-text text-muted">You can upload new images. Existing ones will remain unless changed.</small>
                    </div>

                    <?php if (!empty($productVariant->product_variant_images)): ?>
                        <div class="mb-3">
                            <label><?= __('Existing Images') ?></label>
                            <div class="row g-3">
                                <?php foreach ($productVariant->product_variant_images as $image): ?>
                                    <div class="col-6 col-sm-4 col-md-3">
                                        <div class="d-flex flex-column gap-3">
                                            <img src="<?= $this->Url->build($image->image_url) ?>" alt="Variant Image"
                                                 class="img-thumbnail w-100 object-fit-cover rounded"
                                                 style="border: 1px solid #ddd;">
                                            <?= $this->Form->postLink(
                                                __('Delete (ID: {0})', $image->id),
                                                ['controller' => 'ProductVariantImages', 'action' => 'delete', $image->id],
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

                <?= $this->Form->submit('Update', ['class' => 'btn btn-dark w-100 mt-3']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
