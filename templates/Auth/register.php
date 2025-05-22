<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="col-12 col-lg-5 mt-2 font-sans">
        <?= $this->Form->create($user, ['class' => 'needs-validation', 'novalidate' => true]) ?>
        <fieldset>
            <legend class="mb-3 font-serif text-h2"><?= __('Register User') ?></legend>

            <!-- First and Last Name -->
            <div class="row mb-3">
                <div class="col-md-6 form-group required">
                    <?= $this->Form->control('first_name', [
                        'id' => 'first_name',
                        'type' => 'text',
                        'label' => ['text' => 'First Name', 'class' => 'mb-2 control-label'],
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'required' => true,
                        'aria-describedby' => 'first_name_error'
                    ]); ?>
                    <div id="first_name_error" class="invalid-feedback">Please enter your first name.</div>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('last_name', [
                        'id' => 'last_name',
                        'type' => 'text',
                        'label' => ['text' => 'Last Name', 'class' => 'mb-2 control-label'],
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'required' => false,
                        'aria-describedby' => 'last_name_error'
                    ]); ?>
                    <div id="last_name_error" class="invalid-feedback">Please enter your last name.</div>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3 form-group required">
                <?= $this->Form->control('email', [
                    'id' => 'email',
                    'type' => 'email',
                    'label' => ['text' => 'Email Address', 'class' => 'mb-2 control-label'],
                    'class' => 'form-control rounded-0 shadow-none border-dark',
                    'required' => true,
                    'aria-describedby' => 'email_error'
                ]); ?>
                <div id="email_error" class="invalid-feedback">Please enter a valid email address.</div>
            </div>

            <!-- Password -->
            <div class="mb-3 form-group required">
                <?= $this->Form->control('password', [
                    'id' => 'password',
                    'type' => 'password',
                    'label' => ['text' => 'Password', 'class' => 'mb-2 control-label'],
                    'class' => 'form-control rounded-0 shadow-none border-dark',
                    'required' => true,
                    'aria-describedby' => 'password_error'
                ]); ?>
                <div id="password_error" class="invalid-feedback">Please enter a password.</div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 form-group required">
                <?= $this->Form->control('password_confirm', [
                    'id' => 'password_confirm',
                    'type' => 'password',
                    'label' => ['text' => 'Retype Password', 'class' => 'mb-2 control-label'],
                    'class' => 'form-control rounded-0 shadow-none border-dark',
                    'required' => true,
                    'aria-describedby' => 'password_confirm_error'
                ]); ?>
                <div id="password_confirm_error" class="invalid-feedback">Please retype your password.</div>
            </div>

            <!-- Back to Login -->
            <div class="mb-1 justify-content-end d-flex">
                <?= $this->Html->link(
                    'Back to login',
                    ['controller' => 'Auth', 'action' => 'login'],
                    ['class' => 'btn btn-sm btn-link text-dark']
                ) ?>
            </div>

            <!-- Submit Button -->
            <div class="mt-0">
                <?= $this->Form->button('Register', ['class' => 'btn btn-dark w-100 rounded-0']) ?>
            </div>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>
