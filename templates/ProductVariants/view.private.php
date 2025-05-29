<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductVariant $productVariant
 * @var \Cake\Collection\CollectionInterface $products
 * @var array $groupedAttributeValues
 */

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
                <h4 class="ms-4"><?= h($productVariant->name ?: 'Edit Product Variant') ?></h4>
            </div>

            <div class="card p-4 shadow-sm">
                <?= $this->Form->create($productVariant, [
                    'type' => 'file',
                    'class' => 'needs-validation',
                    'novalidate' => true,
                ]) ?>

                <fieldset>
                    <!-- Variant Name -->
                    <?= $this->Form->control('name', [
                        'label' => 'Variant Name',
                        'class' => 'form-control',
                        'required' => false,
                        'placeholder' => 'Enter variant name',
                    ]) ?>

                    <!-- SKU -->
                    <?= $this->Form->control('sku', [
                        'label' => 'SKU',
                        'class' => 'form-control',
                        'required' => false,                        'placeholder' => 'Enter SKU',
                    ]) ?>


                    <!-- Select Base Product -->
                    <?= $this->Form->control('product_id', [
                        'type' => 'select',
                        'options' => $products,
                        'label' => 'Base Product',
                        'class' => 'form-control',
                        'empty' => 'Select Product',
                        'required' => false,                    ]) ?>


                    <!-- Price -->
                    <?= $this->Form->control('price', [
                        'label' => 'Price',
                        'type' => 'number',
                        'min' => 0,
                        'step' => '0.01',
                        'class' => 'form-control',
                        'required' => false,
                        'placeholder' => 'Enter price',
                    ]) ?>

                    <!-- Stock Quantity -->
                    <?= $this->Form->control('stock_quantity', [
                        'label' => 'Stock Quantity',
                        'type' => 'number',
                        'min' => 0,
                        'step' => 1,
                        'class' => 'form-control',
                        'required' => false,
                        'placeholder' => 'Enter stock quantity',
                    ]) ?>

                    <!-- Variant Attribute Values -->
                    <?= $this->Form->control('variant_attribute_values._ids', [
                        'type' => 'select',
                        'multiple' => true,
                        'options' => $groupedAttributeValues,
                        'label' => 'Variant Attributes',
                        'class' => 'form-control select2',
                        'required' => false,
                        'placeholder' => 'Select attributes',
                    ]) ?>

                    <!-- Upload New Variant Images -->
                    <?= $this->Form->control('product_variant_images[]', [
                        'type' => 'file',
                        'multiple' => true,
                        'label' => 'Upload Variant Images',
                        'class' => 'form-control',
                        'required' => false,
                    ]) ?>

                    <!-- Show Existing Images -->
                    <?php if (!empty($productVariant->product_variant_images)): ?>
                        <div class="mt-3">
                            <label><?= __('Existing Images') ?></label>
                            <div class="row g-3">
                                <?php foreach ($productVariant->product_variant_images as $image): ?>
                                    <div class="col-6 col-sm-4 col-md-3">
                                        <div class="d-flex flex-column gap-2">
                                            <img src="<?= $this->Url->build($image->image_url) ?>" alt="Variant Image"
                                                 class="img-thumbnail w-100 h-100 rounded" style="border: 1px solid #ddd;">
                                            <?= $this->Form->postLink(
                                                __('Delete (ID: {0})', $image->id),
                                                ['controller' => 'ProductVariantImages', 'action' => 'delete', $image->id],
                                                [
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

                <?= $this->Form->submit('Update Variant', ['class' => 'btn btn-dark mt-3 w-100']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<!-- Optional: activate select2 for better multi-select UI -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.jQuery && $.fn.select2) {
            $('.select2').select2({
                placeholder: 'Select attributes',
                allowClear: true,
                width: '100%',
            });
        }
    });
</script>
