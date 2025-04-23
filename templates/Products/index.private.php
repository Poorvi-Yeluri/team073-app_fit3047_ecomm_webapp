<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Contact Messages', ['controller' => 'ContactMessages', 'action' => 'index']);
?>


<div class="container py-4 font-sans">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 font-serif"><?= __('Products') ?></h4>
        <?= $this->Html->link(__('Add Product'), ['action' => 'add'], [
            'class' => 'btn btn-success rounded-3',
        ]) ?>
    </div>

    <table class="table datatable table-striped table-bordered align-middle">
        <thead class="table-light">
        <tr>
            <th><?= __('Product') ?></th>
            <th><?= __('Category') ?></th>
            <th><?= __('Price') ?></th>
            <th><?= __('Stock') ?></th>
<!--            <th>--><?php //= __('Created At') ?><!--</th>-->
            <th><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td class="d-flex justify-content-start align-items-center gap-3">
                    <?php if ($product->image_url): ?>
                        <img src="https://picsum.photos/100" alt="<?= h($product->name) ?>" class="product-image rounded-1" style="max-width: 100px; max-height: 100px; margin-left: 10px;">
<!--                        <img src="--><?php //= h($product->image_url) ?><!--" alt="--><?php //= h($product->name) ?><!--" class="product-image" style="max-width: 100px; max-height: 100px; margin-left: 10px;">-->
                    <?php endif; ?>
                    <?= h($product->name) ?>
                </td>
                <td class="text-capitalize"><?= str_replace('-', ' ', h($product->category)) ?></td>
                <td>$<?= number_format((float)$product->base_price, 2) ?></td>
                <td><?= $this->Number->format($product->stock_quantity) ?></td>
<!--                <td>--><?php //= $this->Time->format($product->created_at, 'dd MMM yyyy, hh:mm a') ?><!--</td>-->
                <td>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->slug], [
                        'class' => 'btn btn-sm btn-primary rounded-3',
                    ]) ?>

                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->slug], [
                        'class' => 'btn btn-sm btn-warning rounded-3'
                    ]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->slug], [
                        'class' => 'btn btn-sm btn-danger rounded-3',
                        'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        const offcanvas = document.getElementById('descriptionOffcanvas');
        offcanvas.addEventListener('show.bs.offcanvas', function (event) {
            const trigger = event.relatedTarget;
            const description = trigger.getAttribute('data-description');
            document.getElementById('offcanvasDescriptionText').textContent = description;
        });
    });
</script>

