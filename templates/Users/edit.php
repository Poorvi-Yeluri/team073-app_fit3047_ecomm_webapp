<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Users', ['action' => 'index']);
$this->Breadcrumbs->add('Edit User');
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <?= $this->Html->link(__('Back to Users'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm ms-2']) ?>
                </div>
                <h4 class="ms-4"><?= __('Edit User: ') . h($user->first_name . ' ' . $user->last_name) ?></h4>
            </div>

            <div class="card p-4 shadow-sm rounded-3">
                <div class="row">
                    <div class="col-12">
                        <?= $this->Form->create($user, [
                            'class' => 'needs-validation',
                            'novalidate' => true
                        ]) ?>

                        <fieldset>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <?= $this->Form->control('first_name', [
                                        'type' => 'text',
                                        'label' => ['text' => 'First Name <span class="text-danger">*</span>', 'escape' => false],
                                        'class' => 'form-control rounded-0 shadow-none border-dark',
                                        'required' => true,
                                        'id' => 'first_name',
                                        'aria-describedby' => 'first_name_error'
                                    ]) ?>
                                    <div id="first_name_error" class="invalid-feedback">First name is required.</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?= $this->Form->control('last_name', [
                                        'type' => 'text',
                                        'label' => ['text' => 'Last Name'],
                                        'class' => 'form-control rounded-0 shadow-none border-dark',
                                        'id' => 'last_name',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <?= $this->Form->control('email', [
                                    'type' => 'email',
                                    'label' => ['text' => 'Email <span class="text-danger">*</span>', 'escape' => false],
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'required' => true,
                                    'id' => 'email',
                                    'aria-describedby' => 'email_error'
                                ]) ?>
                                <div id="email_error" class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <div class="mb-3">
                                <?= $this->Form->control('phone', [
                                    'type' => 'tel',
                                    'label' => ['text' => 'Phone <span class="text-danger">*</span>', 'escape' => false],
                                    'class' => 'form-control rounded-0 shadow-none border-dark',
                                    'maxlength' => 15,
                                    'required' => true,
                                    'id' => 'phone',
                                    'aria-describedby' => 'phone_error'
                                ]) ?>
                                <div id="phone_error" class="invalid-feedback">Please enter a valid phone number.</div>
                            </div>
                        </fieldset>

                        <?= $this->Form->submit(__('Save Changes'), ['class' => 'btn btn-dark w-100 mt-3']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
