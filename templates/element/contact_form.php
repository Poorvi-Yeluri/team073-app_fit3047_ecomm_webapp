<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 */
?>

<div class="container">
    <div class="row w-100">
        <div class="col-12 col-lg-12">
            <?= $this->Form->create($contactMessage, [
                'class' => 'needs-validation',
                'novalidate' => true
            ]) ?>
            <fieldset>
                <legend class="fs-2 mb-3" style="font-family: Baskerville"><?= __('Email Us') ?></legend>

                <!-- Name Field -->
                <div class="mb-3">
                    <?= $this->Form->control('customer_name', [
                        'id' => 'customer_name',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'E.g. Jane Smith',
                        'label' => ['text' => 'Name', 'class' => 'mb-2'],
                        'required' => true,
                        'aria-describedby' => 'customer_name_error'
                    ]); ?>
                    <div id="customer_name_error" class="invalid-feedback">Please enter your name.</div>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <?= $this->Form->control('customer_email', [
                        'id' => 'customer_email',
                        'type' => 'email',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'E.g. janesmith@gmail.com',
                        'label' => ['text' => 'Email', 'class' => 'mb-2'],
                        'required' => true,
                        'aria-describedby' => 'customer_email_error'
                    ]); ?>
                    <div id="customer_email_error" class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <!-- Phone Field -->
                <div class="mb-3">
                    <?= $this->Form->control('customer_phone', [
                        'id' => 'customer_phone',
                        'type' => 'tel',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'E.g. 0450012347',
                        'maxLength' => 10,
                        'label' => ['text' => 'Phone', 'class' => 'mb-2'],
                        'pattern' => '\d{10}',
                        'required' => true,
                        'aria-describedby' => 'customer_phone_error'
                    ]); ?>
                    <div id="customer_phone_error" class="invalid-feedback">Phone number must be 10 digits.</div>
                </div>

                <!-- Message Type -->
                <div class="mb-3">
                    <?= $this->Form->control('message_type', [
                        'id' => 'message_type',
                        'type' => 'select',
                        'options' => [
                            '' => 'Select your enquiry',
                            'General Inquiry' => 'General Inquiry',
                            'Support' => 'Support',
                            'Feedback' => 'Feedback',
                            'Complaint' => 'Complaint'
                        ],
                        'class' => 'form-select rounded-0 shadow-none border-dark',
                        'label' => ['text' => 'Enquiry Type', 'class' => 'mb-2'],
                        'required' => true,
                        'aria-describedby' => 'message_type_error'
                    ]); ?>
                    <div id="message_type_error" class="invalid-feedback">Please select an enquiry type.</div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <?= $this->Form->control('description', [
                        'id' => 'description',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'Describe your message',
                        'label' => ['text' => 'Description', 'class' => 'mb-2'],
                        'required' => true,
                        'minlength' => 10,
                        'aria-describedby' => 'description_error'
                    ]); ?>
                    <div id="description_error" class="invalid-feedback">Description must be at least 10 characters.</div>
                </div>


            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-dark w-100 mt-3']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('.needs-validation');
        const fields = ['customer_name', 'customer_email', 'customer_phone', 'message_type', 'description'];

        // Phone field to allow only numbers
        document.getElementById('customer_phone').addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

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
