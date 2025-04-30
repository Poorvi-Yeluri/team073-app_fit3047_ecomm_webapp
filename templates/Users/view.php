<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add('Users', ['action' => 'index']);
$this->Breadcrumbs->add('View User');
?>

<div class="row justify-content-center font-sans mt-4">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 font-serif"><?= h($user->first_name . ' ' . $user->last_name) ?></h4>
                <div class="btn-group">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'confirm' => __('Are you sure you want to delete {0} ({1})?',
                            $user->first_name . ' ' . $user->last_name,
                            $user->email
                        )
                    ]) ?>
                    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-4">
                        <tbody>
                        <tr>
                            <th class="w-25"><?= __('First Name') ?></th>
                            <td><?= h($user->first_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Name') ?></th>
                            <td><?= h($user->last_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Phone') ?></th>
                            <td><?= h($user->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= $this->Time->format($user->created, 'dd MMM yyyy, hh:mm a') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= $this->Time->format($user->modified, 'dd MMM yyyy, hh:mm a') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
