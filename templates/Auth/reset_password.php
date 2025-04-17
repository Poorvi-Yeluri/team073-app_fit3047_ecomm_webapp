<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="col-12 col-lg-5 font-sans">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend class="fs-2 mb-3 font-serif"><?= __('Reset your Password') ?></legend>

        <div class="mb-3">
            <?= $this->Form->control('password', [
                'type' => 'password',
                'label' => 'Password',
                'value' => '',
                'class' => 'form-control rounded-0 shadow-none border-dark',
                'required' => true,
                'autofocus' => true
            ]); ?>
        </div>

        <div class="mb-3">
            <?= $this->Form->control('password_confirm', [
                'type' => 'password',
                'label' => 'Retype Password',
                'value' => '',
                'class' => 'form-control rounded-0 shadow-none border-dark',
                'required' => true,
                'autofocus' => true
            ]); ?>
        </div>

        <?= $this->Form->button('Reset Password', ['class' => 'btn btn-dark w-100 rounded-0']) ?>


        <div class="mt-3 justify-content-end d-flex">
            <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline-dark rounded-0']) ?>
        </div>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
