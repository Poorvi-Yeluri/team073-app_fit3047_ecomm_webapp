<div class="container">
    <div class="row justify-content-start">
        <div class="col-12 col-lg-5 font-sans">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend class="mb-3 font-serif text-h2"><?= __('Login') ?></legend>

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

                <div class="mb-1 justify-content-end d-flex">
                    <?= $this->Html->link(
                        'Create new account',
                        ['controller' => 'Auth', 'action' => 'register'],
                        ['class' => 'btn btn-sm btn-link text-dark']
                    ) ?>
                    <?= $this->Html->link(
                        'Forgot password?',
                        ['controller' => 'Auth', 'action' => 'forgetPassword'],
                        ['class' => 'btn btn-sm btn-link text-dark']
                    ) ?>
                </div>

                <div class="mt-0">
                    <?= $this->Form->button('Login', ['class' => 'btn btn-dark w-100 rounded-0']) ?>
                </div>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
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

