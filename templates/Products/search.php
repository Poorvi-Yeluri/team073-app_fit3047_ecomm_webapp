<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProductVariant> $variants  // Updated to ProductVariant for consistency
 * @var array $filterOptions // Available filter options for the filters sidebar
 * @var array $selectedFilters // The selected filter values (e.g., for checkboxes)
 * @var string|null $sort // Sort option selected by the user
 * @var string $queryTerm // The search term used to filter products (assuming you're passing it from the controller)
 */
?>



<div class="container">
    <h5 class="text-uppercase">
        Results for: "<i><?= h($queryTerm) ?></i>"
    </h5>
    <hr />
    <div class="row gy-3 my-3 font-sans">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2"
                 data-bs-toggle="offcanvas"
                 data-bs-target="#offcanvasFilterOptions"
                 aria-controls="offcanvasFilterOptions">
                <h5>Filters</h5>
                <span class="material-symbols-outlined mb-2">filter_list</span>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-2">
                <small class="d-none d-md-flex">Sort By:</small>
                <?= $this->Form->create(null, [
                    'type' => 'get',
                    'valueSources' => ['query'],
                    'url' => ['controller' => 'Products', 'action' => 'search', 'category' => $this->request->getQuery('category')]
                ]) ?>

                <?= $this->Form->hidden('category', ['value' => $this->request->getQuery('category')]) ?>
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
                <?php if (!$variants) : ?>
                    No products found for your search criteria.
                <?php else: ?>
                    Showing <?= $this->Paginator->counter('{{start}}-{{end}} of {{count}} products') ?>
                <?php endif; ?>
            </small>
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
                               style="color: var(--white); background-color: var(--accent-color)">
                                View Details
                            </a>
                            <?= $this->Form->create(null, [
                                'url' => ['controller' => 'Cart', 'action' => 'add', $variant->id],
                                'type' => 'post',
                                'class' => 'add-to-cart-form',
                                'data-product-id' => $variant->id
                            ]) ?>
                            <?= $this->Form->button(__('Add to Cart'), [
                                'class' => 'btn w-100 rounded-2 btn-dark'
                            ]) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="offcanvas offcanvas-start w-sm-75 w-md-50"
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
        <?= $this->Form->hidden('q', ['value' => $this->request->getQuery('q')]) ?>
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
        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'search', 'q' => $this->request->getQuery('q'), 'category' => $this->request->getQuery('category')]) ?>"
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
