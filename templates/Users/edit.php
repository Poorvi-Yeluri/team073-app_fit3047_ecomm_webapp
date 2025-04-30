<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Users', ['action' => 'index']);
$this->Breadcrumbs->add('Edit User');
?>

<div class="row justify-content-center w-75 font-sans mt-4">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 font-serif"><?= __('Edit User') ?></h4>
                <div class="btn-group">
<!--                    --><?php //= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'confirm' => __('Are you sure you want to delete {0} ({1})?',
                            $user->first_name . ' ' . $user->last_name,
                            $user->email
                        )
                    ]) ?>
                    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                </div>
            </div>

            <!-- Card Body with Form -->
            <div class="card-body">
                <?= $this->Form->create($user, ['class' => 'needs-validation']) ?>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('first_name', [
                            'label' => 'First Name',
                            'class' => 'form-control shadow-none border-dark rounded-0',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('last_name', [
                            'label' => 'Last Name',
                            'class' => 'form-control shadow-none border-dark rounded-0',
                        ]) ?>
                    </div>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('email', [
                        'label' => 'Email',
                        'type' => 'email',
                        'class' => 'form-control shadow-none border-dark rounded-0',
                    ]) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('password', [
                        'label' => 'Password',
                        'type' => 'password',
                        'class' => 'form-control shadow-none border-dark rounded-0',
                        'placeholder' => 'Leave blank to keep current password',
                    ]) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('phone', [
                        'label' => 'Phone',
                        'type' => 'tel',
                        'maxlength' => 15,
                        'class' => 'form-control shadow-none border-dark rounded-0',
                    ]) ?>
                </div>

                <div class="d-flex justify-content-start">
                    <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-dark px-4']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
