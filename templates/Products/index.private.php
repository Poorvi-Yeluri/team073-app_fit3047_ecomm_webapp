<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProductVariant> $variants
 */
$category = $category ?? (string)$this->request->getQuery('category', '');
?>

<div class="container py-4 font-sans">
    <div class="row">
        <!-- Product Table -->
        <div class="col-md-12">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                <h4 class="mb-0 font-serif" id="pageTitle">
                    <?= $category ? ucwords(str_replace('-', ' ', $category)) : __('Products') ?>
                </h4>
<!--                --><?php //= $this->Html->link(__('Add Product'), ['action' => 'add'], [
//                    'class' => 'btn btn-outline-success rounded-3'
//                ]) ?>
            </div>
            <hr class="mb-1 mt-1" />

            <div class="row g-3 align-items-center">
                <!-- Category Filter -->
                <div class="col-12 col-md-auto">
                    <label for="variantCategory" class="text-small text-accent"><?= __('Category') ?></label>
                    <select id="variantCategory" class="form-select form-select-sm w-100">
                        <option value=""><?= __('Select Category') ?></option>
                        <option value="Home Decor"><?= __('Home Decor') ?></option>
                        <option value="Jewellery"><?= __('Jewellery') ?></option>
                        <option value="Gifts"><?= __('Gifts') ?></option>
                        <option value="Clearance"><?= __('Clearance') ?></option>
                    </select>
                </div>

                <!-- Stock Level Filter -->
                <div class="col-12 col-md-auto">
                    <label for="variantStock" class="text-small text-accent"><?= __('Stock Level') ?></label>
                    <select id="variantStock" class="form-select form-select-sm w-100">
                        <option value=""><?= __('Select Stock Level') ?></option>
                        <option value="Low"><?= __('Low') ?></option>
                        <option value="Medium"><?= __('Medium') ?></option>
                        <option value="High"><?= __('High') ?></option>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="col-12 col-md-auto">
                    <label for="priceRangeMin" class="text-small text-accent"><?= __('Price Range') ?></label>
                    <div class="d-flex gap-2">
                        <input type="number" id="priceRangeMin" class="form-control form-control-sm border rounded" placeholder="Min" min="0" style="width: 110px;">
                        <span class="d-flex align-items-center">-</span>
                        <input type="number" id="priceRangeMax" class="form-control form-control-sm border rounded" placeholder="Max" min="0" style="width: 110px;">
                    </div>
                </div>

                <!-- Sort Dropdown -->
                <div class="col-12 col-md-auto">
                    <label for="stockOrder" class="text-small text-accent"><?= __('Sort by Stock') ?></label>
                    <select id="stockOrder" class="form-select form-select-sm w-100">
                        <option value=""><?= __('Default') ?></option>
                        <option value="stock-low-high"><?= __('Low to High') ?></option>
                        <option value="stock-high-low"><?= __('High to Low') ?></option>
                    </select>
                </div>
            </div>

            <hr class="mb-1 mt-3" />



            <!-- DataTable -->
            <div class="table-responsive">
                <table id="productsTable" class="table table-striped table-bordered align-middle display nowrap w-100">
                    <thead class="table-light">
                    <tr>
                        <th><?= __('Product') ?></th>
                        <th><?= __('Category') ?></th>
                        <th><?= __('Price') ?></th>
                        <th><?= __('Stock') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (count($variants) === 0): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted"><?= __('No products found.') ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($variants as $variant): ?>
                        <tr>
                            <td>
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-2">
                                    <?php if ($variant->image_url): ?>
                                        <img src="<?= h($variant->image_url) ?>" alt="<?= h($variant->name) ?>" class="product-thumb rounded-1">
                                    <?php endif; ?>
                                    <span><?= h($variant->name) ?></span>
                                </div>
                            </td>
                            <td class="text-capitalize"><?= str_replace('-', ' ', h($variant->variant_category)) ?></td>
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
                                <span class="d-none"><?= $s ?></span>
                            </td>
<!--                            <td class="text-center">-->
<!--                                <div class="d-flex flex-wrap justify-content-center gap-2">-->
<!--                                    --><?php //= $this->Html->link(__('Edit'), ['action' => 'edit', $variant->slug], [
//                                        'class' => 'btn btn-sm btn-secondary rounded-3'
//                                    ]) ?>
<!--                                    --><?php //= $this->Form->postLink(__('Delete'), ['action' => 'delete', $variant->slug], [
//                                        'method' => 'delete',
//                                        'confirm' => __('Are you sure you want to delete {0}?', $variant->name),
//                                        'class' => 'btn btn-sm btn-danger rounded-3'
//                                    ]) ?>
<!--                                </div>-->
<!--                            </td>-->
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = $('#productsTable').DataTable({
            responsive: true,
            paging: true,
            info: true,
            ordering: true,
            autoWidth: false,
            scrollX: true,
            language: {
                loadingRecords: "Loading...",
                zeroRecords: "No matching products found"
            },
            columnDefs: [
                { responsivePriority: 1, targets: 0 }, // Product
                { responsivePriority: 2, targets: 3 }, // Stock
                { responsivePriority: 3, targets: 2 }, // Price
                { responsivePriority: 4, targets: 1 }  // Category
            ]

        });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            const min = parseFloat(document.getElementById('priceRangeMin').value) || 0;
            const max = parseFloat(document.getElementById('priceRangeMax').value) || Infinity;
            const priceText = data[2] || "0"; // Assuming column 2 is price
            const price = parseFloat(priceText.replace(/[^\d.]/g, ''));

            return price >= min && price <= max;
        });

        const priceMinInput = document.getElementById('priceRangeMin');
        const priceMaxInput = document.getElementById('priceRangeMax');

        priceMinInput.addEventListener('input', () => table.draw());
        priceMaxInput.addEventListener('input', () => table.draw());


        const categoryFilter = document.getElementById('variantCategory');
        categoryFilter.addEventListener('change', function () {
            const selectedCategory = this.value.trim().toLowerCase();

            if (selectedCategory === '') {
                // Clear filter to show all
                table.columns(1).search('').draw();
            } else {
                // Apply exact match search
                table.columns(1).search('^' + selectedCategory + '$', true, false).draw();
            }
        });

        const stockFilter = document.getElementById('variantStock');
        stockFilter.addEventListener('change', function () {
            const selectedStock = this.value.trim().toLowerCase();

            if (selectedStock === '') {
                // Clear stock filter to show all
                table.columns(3).search('').draw();
            } else {
                // Apply exact match search
                table.columns(3).search(selectedStock, true, false).draw();
            }
        });




        const stockOrderSelect = document.getElementById('stockOrder');
        const savedSort = localStorage.getItem('stockSort');

        if (savedSort === 'stock-low-high') {
            table.order([3, 'asc']).draw();
            stockOrderSelect.value = 'stock-low-high';
        } else if (savedSort === 'stock-high-low') {
            table.order([3, 'desc']).draw();
            stockOrderSelect.value = 'stock-high-low';
        }

        stockOrderSelect.addEventListener('change', function () {
            const selected = this.value;
            if (selected === 'stock-low-high') {
                table.order([3, 'asc']).draw();
            } else if (selected === 'stock-high-low') {
                table.order([3, 'desc']).draw();
            } else {
                table.order([]).draw();
            }
            localStorage.setItem('stockSort', selected);
        });

        const toggleBtn = document.getElementById('toggleCategories');
        const categoryList = document.getElementById('categoryList');

        toggleBtn.addEventListener('click', function () {
            categoryList.classList.toggle('d-none');
            this.textContent = categoryList.classList.contains('d-none') ? 'Show' : 'Hide';
        });

        function adjustCategoryVisibility() {
            if (window.innerWidth < 768) {
                categoryList.classList.add('d-none');
                toggleBtn.textContent = 'Show';
            } else {
                categoryList.classList.remove('d-none');
                toggleBtn.textContent = 'Hide';
            }
        }

        adjustCategoryVisibility();
        window.addEventListener('resize', adjustCategoryVisibility);
    });
</script>
