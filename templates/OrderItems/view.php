<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Item'), ['action' => 'edit', $orderItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Item'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderItems view content">
            <h3><?= h($orderItem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderItem->hasValue('order') ? $this->Html->link($orderItem->order->status, ['controller' => 'Orders', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Variant') ?></th>
                    <td><?= $orderItem->hasValue('variant') ? $this->Html->link($orderItem->variant->variant_name, ['controller' => 'Variants', 'action' => 'view', $orderItem->variant->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($orderItem->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($orderItem->price) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
