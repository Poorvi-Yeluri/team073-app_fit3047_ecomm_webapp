<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><?= __('Edit User') ?></h4>
        <div>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                [
                    'confirm' => __('Are you sure you want to delete {0} ({1})?', $user->first_name . ' ' . $user->last_name, $user->email),
                    'class' => 'btn btn-sm btn-danger'
                ]
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-sm btn-secondary ms-2']) ?>
            <?= $this->Html->link(__('Back to View User'), ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info ms-2']) ?>
        </div>
    </div>

    <div class="card p-4 shadow-sm rounded-3">
        <?= $this->Form->create($user, ['class' => 'needs-validation']) ?>
        <div class="mb-3">
            <?= $this->Form->control('first_name', ['label' => 'First Name', 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3">
            <?= $this->Form->control('last_name', ['label' => 'Last Name', 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3">
            <?= $this->Form->control('email', ['label' => 'Email', 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3">
            <?= $this->Form->control('password', ['label' => 'Password', 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3">
            <?= $this->Form->control('phone', ['label' => 'Phone', 'class' => 'form-control']) ?>
        </div>
        <div class="d-flex justify-content-end">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'style' => 'font-family: Avenir']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
