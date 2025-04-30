<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ContactMessage> $contactMessages
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Contact Messages', ['controller' => 'ContactMessages', 'action' => 'index']);
?>

<div class="container py-4 font-sans">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 font-serif"><?= __('Contact Messages') ?></h4>
<!--        --><?php //= $this->Html->link(__('Add'), ['action' => 'add'], [
//            'class' => 'btn btn-success rounded-3',
//        ]) ?>
    </div>

    <table class="table datatable table-striped table-bordered align-middle">
        <thead class="table-light">
        <tr>
            <th><?= __('Name') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Type') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Sent At') ?></th>
            <th class="text-center"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contactMessages as $contactMessage): ?>
            <tr>
                <td class="text-center"><?= h($contactMessage->customer_name) ?></td>
                <td class="text-center"><?= h($contactMessage->customer_email) ?></td>
                <td class="text-center"><?= h($contactMessage->customer_phone) ?></td>
                <td class="text-center"><?= h($contactMessage->message_type) ?></td>
                <td class="text-center"><?= h($contactMessage->description) ?></td>
                <td class="text-center"><?= $this->Time->format($contactMessage->created_at, 'dd MMM yyyy, hh:mm a') ?></td>
                <td class="text-center">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contactMessage->id], [
                        'class' => 'btn btn-sm btn-primary rounded-3',
                    ]) ?>
<!--                    --><?php //= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactMessage->id], [
//                        'class' => 'btn btn-sm btn-danger rounded-3',
//                        'confirm' => __('Are you sure you want to delete the message from {0} ({1}) - Sent at {2}',
//                            $contactMessage->customer_name,
//                            $contactMessage->message_type,
//                            $this->Time->format(new \DateTime($contactMessage->created_at), 'dd MMM yyyy, hh:mm a')
//                        ),
//                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Offcanvas for Full Description -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="descriptionOffcanvas" aria-labelledby="descriptionOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="descriptionOffcanvasLabel"><?= __('Full Description') ?></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="<?= __('Close') ?>"></button>
    </div>
    <div class="offcanvas-body">
        <p id="offcanvasDescriptionText" class="mb-0"></p>
    </div>
</div>

<!-- Offcanvas Script -->
<script>
    $(document).ready(function () {
        const offcanvas = document.getElementById('descriptionOffcanvas');
        offcanvas.addEventListener('show.bs.offcanvas', function (event) {
            const trigger = event.relatedTarget;
            const description = trigger.getAttribute('data-description');
            document.getElementById('offcanvasDescriptionText').textContent = description;
        });
    });
</script>
