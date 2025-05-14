<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactMessage $contactMessage
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Contact Messages', ['action' => 'index']);
$this->Breadcrumbs->add('View Message', ['action' => 'view', $contactMessage->id]);
?>

<div class="row justify-content-center font-sans">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <!-- Card Header with Title and Actions -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Back to List Button on the Left -->
                <div class="btn-group mr-3">
                    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                </div>

                <!-- Title with Customer Name, Message Type, and Date -->
                <h4 class="mb-0 font-serif mx-auto">
                    <?= h($contactMessage->customer_name) ?> - <?= h($contactMessage->message_type) ?> -
                    <?= $this->Time->format($contactMessage->created_at, 'dd MMM yyyy') ?>
                </h4>
            </div>

            <!-- Card Body with Details -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-4">
                        <tbody>
                        <tr>
                            <th><?= __('Customer Name') ?></th>
                            <td><?= h($contactMessage->customer_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Customer Email') ?></th>
                            <td><?= h($contactMessage->customer_email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Customer Phone') ?></th>
                            <td><?= h($contactMessage->customer_phone) ?></td>
                        </tr>
                        <tr>
                            <th class="w-25"><?= __('Message Type') ?></th>
                            <td><?= h($contactMessage->message_type) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Sent At') ?></th>
                            <td><?= $this->Time->format($contactMessage->created_at, 'dd MMM yyyy') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="font-serif">
                    <h5 class="mb-2"><?= __('Description') ?></h5>
                    <div class="bg-light border rounded p-3 font-sans">
                        <?= $this->Text->autoParagraph(h($contactMessage->description)) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
