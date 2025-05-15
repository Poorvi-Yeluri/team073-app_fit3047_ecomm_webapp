<div class="container py-4 font-sans">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h4 class="mb-0 font-serif" id="pageTitle">
            <?= __('Users') ?>
        </h4>
        <?= $this->Html->link(__('Add User'), ['action' => 'add'], [
            'class' => 'btn btn-outline-success rounded-3'
        ]) ?>
    </div>

    <hr class="mb-1 mt-1" />

    <div class="row g-3 align-items-center">
        <!-- Email Filter -->
        <div class="col-12 col-md-auto">
            <label for="emailFilter" class="text-small text-accent">Email</label>
            <input type="text" id="emailFilter" class="form-control form-control-sm" placeholder="Search Email">
        </div>

        <!-- Phone Filter -->
        <div class="col-12 col-md-auto">
            <label for="phoneFilter" class="text-small text-accent">Phone</label>
            <input type="text" id="phoneFilter" class="form-control form-control-sm" placeholder="Search Phone">
        </div>

        <!-- Sort Dropdown -->
        <div class="col-12 col-md-auto">
            <label for="createdSort" class="text-small text-accent">Sort by Created</label>
            <select id="createdSort" class="form-select form-select-sm">
                <option value="">Default</option>
                <option value="created-asc">Oldest First</option>
                <option value="created-desc">Newest First</option>
            </select>
        </div>
    </div>

    <hr class="mb-1 mt-3" />

    <div class="table-responsive">
        <table id="usersTable" class="table table-striped table-bordered align-middle display nowrap w-100">
            <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th class="actions">Actions</th>
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
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], [
                            'class' => 'btn btn-sm btn-secondary rounded-3'
                        ]) ?>

                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $user->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete {0} ({1})?', $user->first_name . ' ' . $user->last_name, $user->email),
                                'class' => 'btn btn-sm btn-danger rounded-3'
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = $('#usersTable').DataTable({
            responsive: true,
            paging: true,
            info: true,
            ordering: true,
            autoWidth: false,
            scrollX: true,
            language: {
                loadingRecords: "Loading...",
                zeroRecords: "No matching users found"
            },
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 3 },
                { responsivePriority: 3, targets: 1 },
                { responsivePriority: 4, targets: 2 }
            ]
        });

        document.getElementById('emailFilter').addEventListener('input', function () {
            table.columns(1).search(this.value).draw();
        });

        document.getElementById('phoneFilter').addEventListener('input', function () {
            table.columns(2).search(this.value).draw();
        });

        const sortSelect = document.getElementById('createdSort');
        const savedSort = localStorage.getItem('createdSort');

        if (savedSort === 'created-asc') {
            table.order([3, 'asc']).draw();
            sortSelect.value = 'created-asc';
        } else if (savedSort === 'created-desc') {
            table.order([3, 'desc']).draw();
            sortSelect.value = 'created-desc';
        }

        sortSelect.addEventListener('change', function () {
            if (this.value === 'created-asc') {
                table.order([3, 'asc']).draw();
            } else if (this.value === 'created-desc') {
                table.order([3, 'desc']).draw();
            } else {
                table.order([]).draw();
            }
            localStorage.setItem('createdSort', this.value);
        });
    });
</script>
