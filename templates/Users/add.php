<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><?= __('Add User') ?></h4>
        <div>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-sm btn-secondary ms-2']) ?>
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
