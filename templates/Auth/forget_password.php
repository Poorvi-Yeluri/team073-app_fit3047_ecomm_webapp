<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend class="fs-2 mb-3" style="font-family: Baskerville"><?= __('Forgot Password?') ?></legend>
                <?= $this->Flash->render() ?>
                <p>Enter your email address registered with our system below to reset your password: </p>

                <div class="mb-3">
                    <?= $this->Form->control('email', [
                        'type' => 'email',
                        'required' => true,
                        'autofocus' => true,
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'label' => false,
                    ]);
                    ?>
                </div>
            </fieldset>
            <?= $this->Form->button('Send verification email', ['class' => 'btn btn-dark w-100 rounded-0']) ?>
            <?= $this->Form->end() ?>

            <div class="mt-3 justify-content-end d-flex">
                <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline text-dark']) ?>
            </div>
        </div>
    </div>
</div>
