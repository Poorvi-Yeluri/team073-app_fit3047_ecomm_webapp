<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="col-12 col-lg-5 mt-2 font-sans">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend class="mb-3 font-serif text-h2"><?= __('Register User') ?></legend>

            <div class="row mb-3">
                <div class="col-md-6">
                    <?= $this->Form->control('first_name', [
                        'type' => 'text',
                        'label' => 'First Name',
                        'value' => '',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'required' => true,
                        'autofocus' => true
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('last_name', [
                        'type' => 'text',
                        'label' => 'Last Name',
                        'value' => '',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'required' => true,
                        'autofocus' => true
                    ]); ?>
                </div>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('email', [
                    'type' => 'email',
                    'label' => 'Email Address',
                    'value' => '',
                    'class' => 'form-control rounded-0 shadow-none border-dark',
                    'required' => true,
                    'autofocus' => true
                ]); ?>
            </div>

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
                ]); ?>
            </div>

            <div class="mb-1 justify-content-end d-flex">
                <?= $this->Html->link(
                    'Back to login',
                    ['controller' => 'Auth', 'action' => 'login'],
                    ['class' => 'btn btn-sm btn-link text-dark']
                ) ?>
            </div>
            <div class="mt-0">
                <?= $this->Form->button('Register', ['class' => 'btn btn-dark w-100 rounded-0']) ?>
            </div>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('.needs-validation');
        const fields = ['customer_name', 'customer_email', 'customer_phone', 'message_type', 'description'];


        const validateField = (field) => {
            const errorElement = document.getElementById(field.id + '_error');
            const isValid = field.checkValidity();
            field.classList.toggle('is-invalid', !isValid);
            field.classList.toggle('is-valid', isValid);
            errorElement.style.display = isValid ? 'none' : 'block';
        };

        form.addEventListener('input', (e) => validateField(e.target));

        form.addEventListener('submit', (e) => {
            let isValid = true;
            fields.forEach(id => {
                const field = document.getElementById(id);
                validateField(field);
                if (!field.checkValidity()) isValid = false;
            });

            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });
</script>
