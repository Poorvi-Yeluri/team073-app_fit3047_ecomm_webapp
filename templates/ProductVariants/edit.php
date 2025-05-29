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
            <?= $this->Form->create($productVariant, [
                'type' => 'file',
                'class' => 'needs-validation',
                'novalidate' => true,
            ]) ?>

            <div class="card p-4 shadow-sm">
                <fieldset>
                    <!-- Variant Name -->
                    <?= $this->Form->control('name', [
                        'label' => 'Variant Name',
                        'class' => 'form-control mb-3',
                        'required' => false,
                        'placeholder' => 'Enter variant name',
                    ]) ?>

                    <!-- SKU -->
                    <?= $this->Form->control('sku', [
                        'label' => 'SKU',
                        'class' => 'form-control mb-3',
                        'required' => false,
                        'placeholder' => 'Enter SKU',
                    ]) ?>


                    <!-- Select Base Product -->
                    <?= $this->Form->control('product_id', [
                        'type' => 'select',
                        'options' => $products,
                        'label' => 'Base Product',
                        'class' => 'form-control mb-3',
                        'empty' => 'Select Product',
                        'required' => false,
                    ]) ?>


                    <!-- Price -->
                    <?= $this->Form->control('price', [
                        'label' => 'Price',
                        'type' => 'number',
                        'min' => 0,
                        'step' => '0.01',
                        'class' => 'form-control mb-3',
                        'required' => false,
                        'placeholder' => 'Enter price',
                    ]) ?>

                    <!-- Stock Quantity -->
                    <?= $this->Form->control('stock_quantity', [
                        'label' => 'Stock Quantity',
                        'type' => 'number',
                        'min' => 0,
                        'step' => 1,
                        'class' => 'form-control mb-3',
                        'required' => false,
                        'placeholder' => 'Enter stock quantity',
                    ]) ?>

                    <div class=" mb-3">
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
                    </div>

                    <!-- Upload New Variant Images -->
                    <?= $this->Form->control('product_variant_images[]', [
                        'type' => 'file',
                        'multiple' => true,
                        'label' => 'Upload Variant Images',
                        'class' => 'form-control mb-3',
                        'required' => false,
                    ]) ?>

                    <?php
                    // Get all image URLs using the entity's virtual property
                    $imageUrls = $productVariant->image_urls;
                    ?>

                    <label><?= __('Current Images') ?></label>
                    <div class="row g-3">
                        <?php foreach ($productVariant->product_variant_images as $index => $image): ?>
                            <div class="col-6 col-sm-4 col-md-3 position-relative">
                                <div class="d-flex flex-column gap-2">
                                    <img src="<?= h($imageUrls[$index]) ?>" alt="Variant Image"
                                         class="img-thumbnail w-100 object-fit-cover rounded"
                                         style="height: 150px; object-fit: cover;">

                                    <?php if ($image->is_main): ?>
                                        <span
                                            class="position-absolute top-0 start-0 badge bg-success rounded-start rounded-bottom">
                                            <?= __('Main') ?>
                                        </span>
                                    <?php endif; ?>

                                    <!-- Delete button -->
                                    <?= $this->Form->postLink(
                                        __('Delete (ID: {0})', $image->id),
                                        ['controller' => 'ProductVariants', 'action' => 'removeImage', $image->id],
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

                </fieldset>
                <?= $this->Form->submit('Update Variant', ['class' => 'btn btn-dark mt-3 w-100']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.change-main-image-input').on('change', function () {
            const input = this;
            if (input.files.length !== 1) {
                alert('Please select exactly one image.');
                return;
            }

            const form = $(input).closest('form')[0];
            const formData = new FormData(form);

            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false, // Important for FormData
                contentType: false, // Important for FormData
                headers: {
                    'X-CSRF-Token': '<?= $this->request->getAttribute('csrfToken') ?>' // CSRF token for CakePHP
                },
                beforeSend: function () {
                    // Optionally, disable inputs or show a spinner here
                    $(input).prop('disabled', true);
                },
                success: function (response) {
                    alert('Main image updated successfully!');
                    // Optionally refresh the image or reload page
                    location.reload(); // Simple way to show the updated image
                },
                error: function (xhr, status, error) {
                    alert('Error uploading image: ' + xhr.responseText || error);
                    $(input).prop('disabled', false);
                },
                complete: function () {
                    $(input).prop('disabled', false);
                    $(input).val(''); // Reset input for next change
                }
            });
        });
    });
</script>

<!-- Optional: activate select2 for better multi-select UI -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.jQuery && $.fn.select2) {
            $('.select2').select2({
                placeholder: 'Select attributes',
                allowClear: true,
            });
        }
    });
</script>
