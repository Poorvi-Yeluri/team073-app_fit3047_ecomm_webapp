<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductVariant $productVariant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product Variant'), ['action' => 'edit', $productVariant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product Variant'), ['action' => 'delete', $productVariant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productVariant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Product Variants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product Variant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="productVariants view content">
            <h3><?= h($productVariant->variant_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productVariant->hasValue('product') ? $this->Html->link($productVariant->product->name, ['controller' => 'Products', 'action' => 'view', $productVariant->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Variant Name') ?></th>
                    <td><?= h($productVariant->variant_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Variant Value') ?></th>
                    <td><?= h($productVariant->variant_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sku') ?></th>
                    <td><?= h($productVariant->sku) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productVariant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($productVariant->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock Quantity') ?></th>
                    <td><?= $this->Number->format($productVariant->stock_quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($productVariant->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>