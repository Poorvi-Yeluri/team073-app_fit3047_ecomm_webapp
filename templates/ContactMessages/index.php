<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ContactMessage> $contactMessages
 */
?>
<div class="contactMessages index content">
    <?= $this->Html->link(__('New Contact Message'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contact Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('message_type') ?></th>
                    <th><?= $this->Paginator->sort('customer_name') ?></th>
                    <th><?= $this->Paginator->sort('customer_email') ?></th>
                    <th><?= $this->Paginator->sort('customer_phone') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactMessages as $contactMessage): ?>
                <tr>
                    <td><?= $this->Number->format($contactMessage->id) ?></td>
                    <td><?= h($contactMessage->message_type) ?></td>
                    <td><?= h($contactMessage->customer_name) ?></td>
                    <td><?= h($contactMessage->customer_email) ?></td>
                    <td><?= h($contactMessage->customer_phone) ?></td>
                    <td><?= h($contactMessage->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contactMessage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactMessage->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $contactMessage->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $contactMessage->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>