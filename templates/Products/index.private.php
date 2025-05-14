<?php $category = $category ?? $this->request->getQuery('category'); ?>
<div class="container py-4 font-sans">
    <div class="row">
        <!-- Toggle Button for Mobile -->
        <div class="col-12 mb-3 d-md-none">
            <button id="toggleCategoriesMobile" class="btn btn-outline-dark w-100">
                <?= __('Toggle Categories') ?>
            </button>
        </div>

        <!-- Category List -->
        <div class="col-md-3 mb-4" id="categoryColumn">
            <div class="list-group">
                <div class="list-group-item fw-bold d-flex justify-content-between align-items-center">
                    <?= __('Categories') ?>
                    <button id="toggleCategoriesDesktop" class="btn btn-sm btn-outline-secondary d-none d-md-inline">
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
        <div class="col-12 col-md-9">
            <!-- Title and Add Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 font-serif" id="pageTitle">
                    <?= $category ? ucwords(str_replace('-', ' ', $category)) : __('Products') ?>
                </h4>
                <?= $this->Html->link(__('Add Product'), ['action' => 'add'], [
                    'class' => 'btn btn-outline-success rounded-3'
                ]) ?>
            </div>

            <!-- Sort Dropdown -->
            <div class="d-flex justify-content-start mb-4 align-items-center gap-2">
                <label for="stockOrder" class="form-label mb-0"><?= __('Sort by Stock') ?>:</label>
                <select id="stockOrder" class="form-select form-select-sm w-auto">
                    <option value=""><?= __('Default') ?></option>
                    <option value="stock-asc"><?= __('Ascending') ?></option>
                    <option value="stock-desc"><?= __('Descending') ?></option>
                </select>
            </div>

            <!-- DataTable -->
            <div class="table-responsive">
                <table id="productsTable" class="table table-striped table-bordered align-middle display nowrap" style="width:100%">
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
                            <td class="d-flex align-items-center gap-3">
                                <?php if ($product->image_url): ?>
                                    <img src="<?= h($product->image_url) ?>"
                                         alt="<?= h($product->name) ?>"
                                         class="product-image rounded-1"
                                         style="width:100px;height:100px;object-fit:cover;margin-left:10px;">
                                <?php endif; ?>
                                <?= h($product->name) ?>
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
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], [
                                    'class' => 'btn btn-sm btn-secondary rounded-3'
                                ]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                                    'class' => 'btn btn-sm btn-danger rounded-3'
                                ]) ?>
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
        const table = $('#productsTable').DataTable({
            responsive: true,
            paging: true,
            info: true,
            ordering: true,
            autoWidth: false
        });

        // Stock sorting
        const stockOrderSelect = document.getElementById('stockOrder');
        const savedSort = localStorage.getItem('stockSort');

        if (savedSort === 'stock-asc') {
            table.order([3, 'asc']).draw();
            stockOrderSelect.value = 'stock-asc';
        } else if (savedSort === 'stock-desc') {
            table.order([3, 'desc']).draw();
            stockOrderSelect.value = 'stock-desc';
        }

        stockOrderSelect.addEventListener('change', function () {
            const selected = this.value;
            if (selected === 'stock-asc') {
                table.order([3, 'asc']).draw();
            } else if (selected === 'stock-desc') {
                table.order([3, 'desc']).draw();
            } else {
                table.order([]).draw();
            }
            localStorage.setItem('stockSort', selected);
        });

        // Toggle categories (mobile and desktop)
        const toggleDesktop = document.getElementById('toggleCategoriesDesktop');
        const toggleMobile = document.getElementById('toggleCategoriesMobile');
        const categoryCol = document.getElementById('categoryColumn');

        toggleDesktop.addEventListener('click', function () {
            categoryCol.style.display = categoryCol.style.display === 'none' ? 'block' : 'none';
        });

        toggleMobile.addEventListener('click', function () {
            categoryCol.style.display = categoryCol.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>
