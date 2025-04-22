<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Contact Messages', ['action' => 'index']);
$this->Breadcrumbs->add('Edit Message', ['action' => 'edit', $contactMessage->id]);
?>

<div class="row justify-content-center font-sans">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <!-- Card Header with Title and Actions -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 font-serif"><?= __('Edit Contact Message') ?></h4>
                <div class="btn-group">
                    <?= $this->Html->link(__('Back to All Messages'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                    <?= $this->Html->link(__('Back to View Message'), ['action' => 'view', $contactMessage->id], ['class' => 'btn btn-info btn-sm ms-2']) ?>
                </div>
            </div>

            <!-- Card Body with Form -->
            <div class="card-body">
                <?= $this->Form->create($contactMessage, ['class' => 'needs-validation']) ?>
                <div class="mb-3">
                    <?= $this->Form->control('message_type', ['label' => 'Message Type', 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('description', ['label' => 'Description', 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('customer_name', ['label' => 'Customer Name', 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('customer_email', ['label' => 'Customer Email', 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('customer_phone', ['label' => 'Customer Phone', 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('created_at', ['label' => 'Sent At', 'class' => 'form-control', 'empty' => true]) ?>
                </div>
                <div class="d-flex justify-content-end">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'style' => 'font-family: Avenir']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

            <!-- Card Footer with Delete button at the bottom-left -->
            <div class="card-footer d-flex justify-content-start">
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactMessage->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'confirm' => __('Are you sure you want to delete the message from {0} ({1}) - Sent on {2}',
                        $contactMessage->customer_name,
                        $contactMessage->message_type,
                        $this->Time->format($contactMessage->created_at, 'dd MMM yyyy, hh:mm a')
                    )
                ]) ?>
            </div>
        </div>
    </div>
</div>
