<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProductVariant> $productVariants
 */
?>
<div class="container py-4 font-sans">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                <h4 class="mb-0 font-serif"><?= __('Product Variants') ?></h4>
                <?= $this->Html->link(__('Add Variant'), ['action' => 'add'], [
                    'class' => 'btn btn-outline-success rounded-3'
                ]) ?>
            </div>

            <hr class="mb-1 mt-1"/>


            <div class="row g-3 align-items-center mb-3">
                <!-- SKU Filter -->
                <div class="col-12 col-md-auto">
                    <label for="variantSKU" class="text-small text-accent"><?= __('SKU') ?></label>
                    <input type="text" id="variantSKU" class="form-control form-control-sm border rounded"
                           placeholder="<?= __('Search SKU') ?>">
                </div>

                <!-- Product Name Filter -->
                <div class="col-12 col-md-auto">
                    <label for="productNameSearch" class="text-small text-accent"><?= __('Product Name') ?></label>
                    <input type="text" id="productNameSearch" class="form-control form-control-sm border rounded"
                           placeholder="<?= __('Search name') ?>">
                </div>

                <!-- Variant Name Filter -->
                <div class="col-12 col-md-auto">
                    <label for="variantNameSearch" class="text-small text-accent"><?= __('Variant Name') ?></label>
                    <input type="text" id="variantNameSearch" class="form-control form-control-sm border rounded"
                           placeholder="<?= __('Search variant') ?>">
                </div>

            </div>
            <hr class="mb-1 mt-1"/>

            <!-- Filters -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-12 col-md-auto">
                    <label for="variantStock" class="text-small text-accent"><?= __('Stock Level') ?></label>
                    <select id="variantStock" class="form-select form-select-sm w-100">
                        <option value=""><?= __('Select Stock Level') ?></option>
                        <option value="Low"><?= __('Low') ?></option>
                        <option value="Medium"><?= __('Medium') ?></option>
                        <option value="High"><?= __('High') ?></option>
                    </select>
                </div>

                <div class="col-12 col-md-auto">
                    <label for="priceRangeMin" class="text-small text-accent"><?= __('Price Range') ?></label>
                    <div class="d-flex gap-2">
                        <input type="number" id="priceRangeMin" class="form-control form-control-sm border rounded"
                               placeholder="Min" min="0" style="width: 110px;">
                        <span class="d-flex align-items-center">-</span>
                        <input type="number" id="priceRangeMax" class="form-control form-control-sm border rounded"
                               placeholder="Max" min="0" style="width: 110px;">
                    </div>
                </div>
                <!-- Date Range Filter -->
                <div class="col-12 col-md-auto">
                    <label for="createdFrom" class="text-small text-accent"><?= __('Created After') ?></label>
                    <input type="date" id="createdFrom" class="form-control form-control-sm border rounded">
                </div>
                <div class="col-12 col-md-auto">
                    <label for="createdTo" class="text-small text-accent"><?= __('Created Before') ?></label>
                    <input type="date" id="createdTo" class="form-control form-control-sm border rounded">
                </div>
            </div>

            <hr class="mb-1 mt-1"/>

            <div class="col-12 col-md-auto d-flex align-items-end justify-content-end my-2">
                <button id="clearFilters" class="btn btn-sm btn-secondary rounded-3 me-2">
                    <?= __('Clear All Filters') ?>
                </button>
            </div>



            <div class="table-responsive">
                <table id="variantsTable" class="table table-striped table-bordered align-middle display nowrap w-100">
                    <thead class="table-light">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Base Product') ?></th>
                        <th><?= __('SKU') ?></th>
                        <th><?= __('Price') ?></th>
                        <th><?= __('Stock') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($productVariants)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted"><?= __('No variants found.') ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($productVariants as $variant): ?>
                        <tr>
                            <td><?= h($variant->name) ?></td>
                            <td class="text-dark">
                                <?= $variant->hasValue('product') ? $this->Html->link(
                                    $variant->product->name,
                                    ['controller' => 'Products', 'action' => 'view', $variant->product->slug],
                                    ['style' => 'color: inherit;', 'class' => 'text-dark']
                                ) : '' ?>
                            </td>

                            <td><?= h($variant->sku) ?></td>
                            <td>$<?= number_format((float)($variant->price ?? 0), 2) ?></td>
                            <td class="text-center" data-order="<?= $variant->stock_quantity ?>">
                                <?php
                                $s = $variant->stock_quantity;
                                if ($s < 10) {
                                    $badge = 'rounded-pill text-bg-danger';
                                    $label = 'Low';
                                } elseif ($s < 20) {
                                    $badge = 'rounded-pill text-bg-warning';
                                    $label = 'Medium';
                                } else {
                                    $badge = 'rounded-pill text-bg-success';
                                    $label = 'High';
                                }
                                ?>
                                <span class="badge <?= $badge ?>"><?= $label ?> (<?= $s ?>)</span>
                            </td>
                            <td><?= h($variant->created_at) ?></td>
                            <td>
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
<!--                                    --><?php //= $this->Html->link(__('View'), ['action' => 'view', $variant->id], [
//                                        'class' => 'btn btn-sm btn-primary rounded-3'
//                                    ]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $variant->id], [
                                        'class' => 'btn btn-sm btn-secondary rounded-3'
                                    ]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $variant->id], [
                                        'method' => 'post',
                                        'confirm' => __('Are you sure you want to delete {0}?', $variant->name),
                                        'class' => 'btn btn-sm btn-danger rounded-3'
                                    ]) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables & Filters Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = $('#variantsTable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            info: true,
            scrollX: true,
            autoWidth: false,
            language: {
                zeroRecords: "<?= __('No matching variants found.') ?>",
                loadingRecords: "<?= __('Loading...') ?>"
            },
            columnDefs: [
                {responsivePriority: 1, targets: 0}, // Variant Name
                {responsivePriority: 2, targets: 4}, // Stock
                {responsivePriority: 3, targets: 3}, // Price
                {responsivePriority: 4, targets: 1}  // Product
            ]
        });

        document.getElementById('clearFilters').addEventListener('click', function () {
            // Clear all filter inputs
            document.getElementById('variantSKU').value = '';
            document.getElementById('productNameSearch').value = '';
            document.getElementById('variantNameSearch').value = '';
            document.getElementById('variantStock').value = '';
            document.getElementById('priceRangeMin').value = '';
            document.getElementById('priceRangeMax').value = '';
            document.getElementById('createdFrom').value = '';
            document.getElementById('createdTo').value = '';

            const inStockEl = document.getElementById('inStockOnly');
            if (inStockEl) {
                inStockEl.checked = false;
            }

            // Clear column searches
            table.columns().search('');

            // Redraw table to reset all filters
            table.draw();
        });


        // Filter: Stock Level Dropdown (search text in column 4 badges)
        document.getElementById('variantStock').addEventListener('change', function () {
            const val = this.value.toLowerCase();
            table.columns(4).search(val || '', true, false).draw();
        });

        // Simple column text filters
        document.getElementById('variantSKU').addEventListener('input', function () {
            table.columns(2).search(this.value).draw();
        });

        document.getElementById('productNameSearch').addEventListener('input', function () {
            table.columns(1).search(this.value).draw();
        });

        document.getElementById('variantNameSearch').addEventListener('input', function () {
            table.columns(0).search(this.value).draw();
        });

        // Unified custom filter combining price range, date range, and in-stock toggle
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            // Apply only to #variantsTable
            if (settings.nTable.id !== 'variantsTable') {
                return true;
            }

            // Price range filter
            const minPrice = parseFloat(document.getElementById('priceRangeMin').value) || 0;
            const maxPrice = parseFloat(document.getElementById('priceRangeMax').value) || Infinity;
            const priceText = data[3] || "0";
            const price = parseFloat(priceText.replace(/[^\d.]/g, ''));
            if (price < minPrice || price > maxPrice) {
                return false;
            }

            // Created date range filter
            const createdFromInput = document.getElementById('createdFrom').value;
            const createdToInput = document.getElementById('createdTo').value;
            const fromDate = createdFromInput ? new Date(createdFromInput) : new Date('1970-01-01');
            const toDate = createdToInput ? new Date(createdToInput) : new Date('3000-01-01');
            const createdAt = new Date(data[5]);
            if (createdAt < fromDate || createdAt > toDate) {
                return false;
            }

            // In stock only filter
            const inStockCheckbox = document.getElementById('inStockOnly');
            if (inStockCheckbox && inStockCheckbox.checked) {
                const stockText = data[4];
                const match = stockText.match(/\((\d+)\)/);
                const quantity = match ? parseInt(match[1], 10) : 0;
                if (quantity <= 0) {
                    return false;
                }
            }

            return true;
        });

        // Trigger redraw on price range inputs
        ['priceRangeMin', 'priceRangeMax'].forEach(id => {
            document.getElementById(id).addEventListener('input', () => table.draw());
        });

        // Trigger redraw on created date inputs
        ['createdFrom', 'createdTo'].forEach(id => {
            document.getElementById(id).addEventListener('change', () => table.draw());
        });

        // Trigger redraw on in-stock checkbox if present
        const inStockEl = document.getElementById('inStockOnly');
        if (inStockEl) {
            inStockEl.addEventListener('change', () => table.draw());
        }
    });
</script>

