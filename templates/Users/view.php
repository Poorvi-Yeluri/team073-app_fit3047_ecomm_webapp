<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><?= h($user->first_name . ' ' . $user->last_name) ?></h4>
        <div>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-warning me-1']) ?>
            <?= $this->Form->postLink(
                __('Delete User'),
                ['action' => 'delete', $user->id],
                [
                    'confirm' => __('Are you sure you want to delete {0} ({1})?', $user->first_name . ' ' . $user->last_name, $user->email),
                    'class' => 'btn btn-sm btn-danger me-1'
                ]
            ) ?>
            <?= $this->Html->link(__('Back to Users'), ['action' => 'index'], ['class' => 'btn btn-sm btn-secondary']) ?>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Time->format($user->created, 'dd MMM yyyy, hh:mm a') ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Time->format($user->modified, 'dd MMM yyyy, hh:mm a') ?></td>
        </tr>
    </table>
</div>
