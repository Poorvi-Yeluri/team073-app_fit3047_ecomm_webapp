<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 * @var bool $isModal // to check if form is being rendered inside a modal
 */
?>

<div class="container-fluid">
    <div class="row w-100">
        <div class="col-12 col-lg-12">
            <?= $this->Form->create($contactMessage, [
                'url' => ['controller' => 'ContactMessages', 'action' => 'add'],
                'class' => 'needs-validation',
                'novalidate' => true,
            ]) ?>
            <fieldset>
                <div class="d-flex justify-content-between align-items-center font-serif mb-3">
                    <legend><?= __('Email Us') ?></legend>
                    <?php if (isset($isModal) && $isModal) : ?>
                        <span class="material-symbols-outlined mb-3 close-modal" role="button" data-bs-dismiss="modal">close</span>
                    <?php endif; ?>
                </div>
                <!-- Name Field -->
                <div class="mb-3 form-group required">
                    <?= $this->Form->control('customer_name', [
                        'id' => 'customer_name',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'E.g. Jane Smith',
                        'label' => ['text' => 'Name', 'class' => 'mb-2 control-label'],
                        'required' => true,
                        'aria-describedby' => 'customer_name_error',
                    ]); ?>
                    <div id="customer_name_error" class="invalid-feedback">Please enter your name.</div>
                </div>

                <!-- Email Field -->
                <div class="mb-3 form-group required">
                    <?= $this->Form->control('customer_email', [
                        'id' => 'customer_email',
                        'type' => 'email',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'E.g. janesmith@gmail.com',
                        'label' => ['text' => 'Email', 'class' => 'mb-2 control-label'],
                        'required' => true,
                        'aria-describedby' => 'customer_email_error',
                    ]); ?>
                    <div id="customer_email_error" class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <!-- Phone Field -->
                <div class="mb-3 form-group required">
                    <?= $this->Form->control('customer_phone', [
                        'id' => 'customer_phone',
                        'type' => 'tel',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'E.g. 0450012347',
                        'maxlength' => 15,
                        'label' => ['text' => 'Phone', 'class' => 'mb-2 control-label'],
                        'required' => true,
                        'aria-describedby' => 'customer_phone_error',
                    ]); ?>
                    <div id="customer_phone_error" class="invalid-feedback">Phone number must not exceed 15 digits.
                    </div>
                </div>

                <!-- Message Type -->
                <div class="mb-3 form-group required">
                    <?= $this->Form->control('message_type', [
                        'id' => 'message_type',
                        'type' => 'select',
                        'options' => [
                            '' => 'Select your enquiry',
                            'General Inquiry' => 'General Inquiry',
                            'Support' => 'Support',
                            'Feedback' => 'Feedback',
                            'Complaint' => 'Complaint',
                        ],
                        'class' => 'form-select rounded-0 shadow-none border-dark',
                        'label' => ['text' => 'Enquiry Type', 'class' => 'mb-2 control-label'],
                        'required' => true,
                        'aria-describedby' => 'message_type_error',
                    ]); ?>
                    <div id="message_type_error" class="invalid-feedback">Please select an enquiry type.</div>
                </div>

                <!-- Description -->
                <div class="mb-3 form-group required">
                    <?= $this->Form->control('description', [
                        'id' => 'description',
                        'class' => 'form-control rounded-0 shadow-none border-dark',
                        'placeholder' => 'Describe your message',
                        'label' => ['text' => 'Description', 'class' => 'mb-2 control-label'],
                        'required' => true,
                        'maxlength' => 500,
                        'aria-describedby' => 'description_error',
                    ]); ?>
                    <div id="description_error" class="invalid-feedback">Description can't be empty or exceed 500
                        characters.
                    </div>
                </div>

                <!-- reCaptcha -->
                <div id="recaptcha-container" class="mb-3">
                    <?= $this->Recaptcha->display() ?>
                </div>


            </fieldset>
            <?= $this->Form->submit('Send Message', ['class' => 'btn btn-dark w-100 rounded-0 mt-3']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
