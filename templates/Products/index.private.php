<?php $category = $category ?? $this->request->getQuery('category'); ?>
<div class="container py-4 font-sans">
    <div class="row">
        <!-- Category List -->
        <div class="col-md-3 mb-4">
            <div class="list-group">
                <div class="list-group-item fw-bold d-flex justify-content-between align-items-center">
                    <?= __('Categories') ?>
                    <button id="toggleCategories" class="btn btn-sm btn-outline-secondary">
                        <?= __('Hide') ?>
                    </button>
                </div>
                <div id="categoryList">
                    <?= $this->Html->link(__('All Products'), ['action' => 'index'], [
                        'class' => 'list-group-item list-group-item-action ' . (!$category ? 'active' : '')
                    ]) ?>
                    <?php foreach (['jewellery', 'home-decor', 'gifts', 'clearance'] as $cat): ?>
                        <?= $this->Html->link(__(ucwords(str_replace('-', ' ', $cat))), ['action' => 'index', '?' => ['category' => $cat]], [
                            'class' => 'list-group-item list-group-item-action ' . ($category === $cat ? 'active' : '')
                        ]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Product Table -->
        <div class="col-md-9">
            <!-- Title and Add Button -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                <h4 class="mb-0 font-serif" id="pageTitle">
                    <?= $category ? ucwords(str_replace('-', ' ', $category)) : __('Products') ?>
                </h4>
                <?= $this->Html->link(__('Add Product'), ['action' => 'add'], [
                    'class' => 'btn btn-outline-success rounded-3'
                ]) ?>
            </div>

            <!-- Sort Dropdown -->
            <div class="d-flex justify-content-start mb-4 align-items-center gap-2 flex-wrap">
                <label for="stockOrder" class="form-label mb-0"><?= __('Sort by Stock') ?>:</label>
                <select id="stockOrder" class="form-select form-select-sm w-auto">
                    <option value=""><?= __('Default') ?></option>
                    <option value="stock-low-high"><?= __('Low to High') ?></option>
                    <option value="stock-high-low"><?= __('High to Low') ?></option>
                </select>
            </div>

            <!-- DataTable -->
            <div class="table-responsive">
                <table id="productsTable" class="table table-striped table-bordered align-middle display nowrap w-100">
                    <thead class="table-light">
                    <tr>
                        <th><?= __('Product') ?></th>
                        <th><?= __('Category') ?></th>
                        <th><?= __('Price') ?></th>
                        <th><?= __('Stock') ?></th>
                        <th class="text-center"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-2">
                                    <?php if ($product->image_url): ?>
                                        <img src="<?= h($product->image_url) ?>"
                                             alt="<?= h($product->name) ?>"
                                             class="product-image rounded-1"
                                             style="width:70px;height:70px;object-fit:cover;">
                                    <?php endif; ?>
                                    <span><?= h($product->name) ?></span>
                                </div>
                            </td>
                            <td class="text-capitalize"><?= str_replace('-', ' ', h($product->category)) ?></td>
                            <td>$<?= number_format((float)$product->base_price, 2) ?></td>
                            <td class="text-center" data-order="<?= $product->stock_quantity ?>">
                                <?php
                                $s = $product->stock_quantity;
                                if ($s < 5) {
                                    $badge = 'custom-stock-badge low-stock';
                                    $label = 'Low';
                                } elseif ($s < 10) {
                                    $badge = 'custom-stock-badge medium-stock';
                                    $label = 'Medium';
                                } else {
                                    $badge = 'custom-stock-badge high-stock';
                                    $label = 'High';
                                }
                                ?>
                                <span class="badge <?= $badge ?>"><?= $label ?> (<?= $s ?>)</span>
                                <span class="d-none"><?= $s ?></span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], [
                                        'class' => 'btn btn-sm btn-secondary rounded-3'
                                    ]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete {0}?', $product->name),
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

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the DataTable for product listing with responsive options
        const table = $('#productsTable').DataTable({
            responsive: true,
            paging: true,
            info: true,
            ordering: true,
            autoWidth: false,
            scrollX: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 }, // Product name is most important
                { responsivePriority: 2, targets: 4 }, // Actions are second most important
                { responsivePriority: 3, targets: 3 }, // Stock is third most important
                { responsivePriority: 4, targets: 2 }  // Price is fourth most important
            ]
        });

        // Stock sorting functionality
        const stockOrderSelect = document.getElementById('stockOrder');
        const savedSort = localStorage.getItem('stockSort');

        // Apply saved sort order when page loads
        if (savedSort === 'stock-low-high') {
            table.order([3, 'asc']).draw();  // Sort by stock from low to high
            stockOrderSelect.value = 'stock-low-high';
        } else if (savedSort === 'stock-high-low') {
            table.order([3, 'desc']).draw();  // Sort by stock from high to low
            stockOrderSelect.value = 'stock-high-low';
        }

        // Handle stock sorting change
        stockOrderSelect.addEventListener('change', function () {
            const selected = this.value;
            if (selected === 'stock-low-high') {
                table.order([3, 'asc']).draw();  // Sort by stock from low to high
            } else if (selected === 'stock-high-low') {
                table.order([3, 'desc']).draw();  // Sort by stock from high to low
            } else {
                table.order([]).draw();  // Reset to default sorting
            }
            // Store the selected sort order in localStorage
            localStorage.setItem('stockSort', selected);
        });

        // For hiding/showing categories
        const toggleBtn = document.getElementById('toggleCategories');
        const categoryList = document.getElementById('categoryList');
        toggleBtn.addEventListener('click', function () {
            const isHidden = categoryList.style.display === 'none';
            categoryList.style.display = isHidden ? 'block' : 'none';
            this.textContent = isHidden ? 'Hide' : 'Show';
        });

        // Automatically hide categories on small screens initially
        function adjustCategoryVisibility() {
            if (window.innerWidth < 768) {
                categoryList.style.display = 'none';
                toggleBtn.textContent = 'Show';
            } else {
                categoryList.style.display = 'block';
                toggleBtn.textContent = 'Hide';
            }
        }

        // Run on page load
        adjustCategoryVisibility();

        // Run when window is resized
        window.addEventListener('resize', adjustCategoryVisibility);
    });
</script>
