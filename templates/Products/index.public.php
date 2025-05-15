<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProductVariant> $variants
 * @var array $filterOptions
 * @var array $selectedFilters
 * @var string|null $sort
 */

?>
<div class="container">
    <h3 class="text-uppercase">
        <?= $this->request->getQuery('category')
            ? str_replace('-', ' ', $this->request->getQuery('category'))
            : 'Products' ?>
    </h3>
    <div class="row gy-3 my-3 font-sans">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <!-- Filters Button -->
            <div class="d-flex align-items-center gap-2"
                 data-bs-toggle="offcanvas"
                 data-bs-target="#offcanvasFilterOptions"
                 aria-controls="offcanvasFilterOptions">
                <h5>Filters</h5>
                <span class="material-symbols-outlined mb-2">filter_list</span>
            </div>

            <!-- Sort By Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <small class="d-none d-md-flex">Sort By:</small>
                <?= $this->Form->create(null, [
                    'type' => 'get',
                    'valueSources' => ['query'],
                    'url' => ['controller' => 'Products', 'action' => 'index', 'category' => $this->request->getQuery('category')]
                ]) ?>

                <!-- Automatically retain category in the form -->
                <?= $this->Form->hidden('category', ['value' => $this->request->getQuery('category')]) ?>
                <?php
                foreach ($selectedFilters as $filterName => $filterValues) {
                    if (is_array($filterValues)) {
                        foreach ($filterValues as $value) {
                            echo $this->Form->hidden($filterName . '[]', ['value' => $value]);
                        }
                    } else {
                        echo $this->Form->hidden($filterName, ['value' => $filterValues]);
                    }
                }
                ?>

                <!-- Dropdown for sorting -->
                <?= $this->Form->select('sort', [
                    'relevance' => 'Relevance',
                    'price-asc' => 'Price: Low - High',
                    'price-desc' => 'Price: High - Low',
                    'latest' => 'Latest'
                ], [
                    'default' => $sort ?? 'relevance',
                    'class' => 'form-select form-select-md',
                    'aria-label' => 'Sort By',
                    'onchange' => 'this.form.submit()'
                ]) ?>

                <?= $this->Form->end() ?>
            </div>

        </div>

        <div class="col-12 d-flex justify-content-between justify-content-md-start gap-3 align-items-center">
            <small class="text-muted">
                Showing <?= $this->Paginator->counter('{{start}}-{{end}} of {{count}} products') ?>
            </small>
            <!--            --><?php //= $this->Html->link('View All', ['action' => 'index', 'category' => $this->request->getQuery('category')], ['class' => 'text-black text-body']) ?>
        </div>
    </div>

    <div class="row">
        <?php foreach ($variants as $variant) : ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-md rounded-0">
                    <img src="<?= h($variant->main_image_url) ?>" alt="<?= h($variant->name) ?>"
                         style="object-fit: cover; height: 280px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= h($variant->name) ?></h5>
                        <p class="card-text fw-bold">
                            $<?= number_format((float)$variant->price, 2) ?>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex flex-column justify-content-between gap-2">
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $variant->slug]) ?>"
                               class="btn w-100 rounded-2"
                               style="color: var(--white);
                                background-color: var(--accent-color)">
                                View Details
                            </a>
<!--                            --><?php //= $this->Form->create(null, [
//                                'url' => ['controller' => 'Cart', 'action' => 'add', $variant->id],
//                                'type' => 'post',
//                                'class' => 'add-to-cart-form',
//                                'data-product-id' => $variant->id
//                            ]) ?>
<!--                            --><?php //= $this->Form->button(__('Add to Cart'), [
//                                'class' => 'btn w-100 rounded-2 btn-dark'
//                            ]) ?>
<!--                            --><?php //= $this->Form->end() ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) : ?>
        <nav aria-label="Product Pagination">
            <ul class="pagination justify-content-center mt-4">
                <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Next') . ' >') ?>
            </ul>
        </nav>
    <?php endif; ?>

</div>


<div class="offcanvas offcanvas-start w-md-50"
     tabindex="-1"
     id="offcanvasFilterOptions"
     aria-labelledby="offcanvasFiltersLabel"
     data-bs-backdrop="false">

    <div class="offcanvas-header d-flex justify-content-between align-items-center">
        <h5 class="offcanvas-title" id="offcanvasFiltersLabel">Filters</h5>
        <button type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>

    <div class="offcanvas-body pb-5 pt-0">
        <?= $this->Form->create(null, ['type' => 'get', 'valueSources' => ['query']]) ?>
        <?= $this->Form->hidden('category', ['value' => $this->request->getQuery('category')]) ?>
        <fieldset>
            <legend class="visually-hidden"><?= __('Filter Products') ?></legend>

            <?php foreach ($filterOptions as $attributeName => $values) : ?>
                <div class="accordion mb-3">
                    <hr>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading-<?= str_replace(' ', '-', $attributeName) ?>">
                            <button class="accordion-button bg-transparent shadow-none text-body py-2 px-0"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-<?= str_replace(' ', '-', $attributeName) ?>"
                                    aria-expanded="true"
                                    aria-controls="collapse-<?= str_replace(' ', '-', $attributeName) ?>">
                                <?= h($attributeName) ?>
                            </button>
                        </h2>

                        <div id="collapse-<?= str_replace(' ', '-', $attributeName) ?>"
                             class="accordion-collapse collapse show"
                             aria-labelledby="heading-<?= str_replace(' ', '-', $attributeName) ?>">

                            <div class="accordion-body pt-0 ps-2">
                                <?php foreach ($values as $value) : ?>
                                    <div class="form-check mb-1 d-flex align-items-center">
                                        <?= $this->Form->checkbox(
                                            $attributeName . '[]',
                                            [
                                                'value' => $value,
                                                'id' => $attributeName . '-' . str_replace(' ', '-', $value),
                                                'class' => 'form-check-input rounded-0',
                                                'style' => 'transform: scale(1.2); margin-top: 0;',
                                                'checked' => in_array($value, $selectedFilters[$attributeName] ?? []), // Preselect if the value is in selectedFilters
                                            ]
                                        ) ?>
                                        <?= $this->Form->label(
                                            $attributeName . '-' . str_replace(' ', '-', $value),
                                            h($value),
                                            ['class' => 'form-check-label ms-2 mb-0']
                                        ) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </fieldset>
    </div>

    <div
        class="position-sticky bottom-0 bg-white p-3 border-top d-flex flex-column justify-content-center align-items-center font-sans"
        style="z-index: 1030;">
        <a href="<?= $this->Url->build(['action' => 'index', '?' => ['category' => $this->request->getQuery('category')]]) ?>"
           id="clearAllFilters"
           class="text-decoration-underline text-secondary small mb-2">
            <?= __('Clear All') ?>
        </a>

        <?= $this->Form->button(__('Apply Filters'), [
            'class' => 'btn btn-dark d-block d-md-inline-block w-100 w-md-auto rounded-0',
            'form' => null, // Ensures it still works outside form
        ]) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const clearBtn = document.getElementById("clearAllFilters");
        const filterForm = document.querySelector('.offcanvas-body form');

        clearBtn?.addEventListener("click", function () {
            const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = false);
            // Optionally submit the form to clear filters
            filterForm.submit();
        });

        const sortSelect = document.querySelector('.row > div:nth-child(2) select[name="sort"]');
        sortSelect?.addEventListener('change', function () {
            this.form.submit();
        });
    });
</script>
