<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><?= __('Users') ?></h4>
        <a class="btn btn-md btn-primary "
           style="font-family: Avenir"
           href='<?= $this->Url->build(['action' => 'add']) ?>'>
            Add User
        </a>
    </div>

    <table id="usersTable" class="table table-striped table-bordered align-middle">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created</th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= h($user->first_name . ' ' . $user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?= $this->Time->format($user->created, 'dd MMM yyyy, hh:mm a') ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        __('View'),
                        ['action' => 'view', $user->id],
                        ['class' => 'btn btn-sm btn-info'],
                    ) ?>
                    <?= $this->Html->link(
                        __('Edit'),
                        ['action' => 'edit', $user->id],
                        ['class' => 'btn btn-sm btn-warning'],
                    ) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $user->id],
                        [
                            'method' => 'delete',
                            'confirm' => __('Are you sure you want to delete {0} ({1})?', $user->first_name . ' ' . $user->last_name, $user->email),
                            'class' => 'btn btn-sm btn-danger',
                        ],
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "order": [[0, 'asc']],
            layout: {
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });
    });
</script>
