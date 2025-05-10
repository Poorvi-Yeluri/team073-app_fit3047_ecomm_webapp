<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 font-serif"><?= __('Users') ?></h4>
        <?= $this->Html->link(__('Add User'), ['action' => 'add'], [
            'class' => 'btn btn-outline-success rounded-3'
        ]) ?>
    </div>


    <table class="table datatable table-striped table-bordered align-middle">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
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
                    <!-- Edit button with neutral grey color -->
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], [
                        'class' => 'btn btn-sm btn-secondary rounded-3'  // Default grey color
                    ]) ?>

                    <!-- Delete button with a light red color -->
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $user->id],
                        [
                            'method' => 'delete',
                            'confirm' => __('Are you sure you want to delete {0} ({1})?', $user->first_name . ' ' . $user->last_name, $user->email),
                            'class' => 'btn btn-sm btn-danger rounded-3'  // Default light red color
                        ],
                    ) ?>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
