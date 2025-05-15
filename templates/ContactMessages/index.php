<?php

use Cake\Utility\Text;

?>
<div class="container py-4 font-sans">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h4 class="mb-0 font-serif"><?= __('Contact Messages') ?></h4>
    </div>

    <hr class="mb-1 mt-1" />

    <div class="row g-3 align-items-center">
        <!-- Message Type Filter -->
        <div class="col-12 col-md-auto">
            <label for="filterType" class="text-small text-accent"><?= __('Message Type') ?></label>
            <select id="filterType" class="form-select form-select-sm">
                <option value=""><?= __('All') ?></option>
                <option value="General Inquiry"><?= __('General Inquiry') ?></option>
                <option value="Complaint"><?= __('Complaint') ?></option>
                <option value="Feedback"><?= __('Feedback') ?></option>
                <option value="Support"><?= __('Support') ?></option>
            </select>
        </div>

        <!-- Date Range -->
        <div class="col-12 col-md-auto">
            <label class="text-small text-accent"><?= __('Sent Between') ?></label>
            <div class="d-flex gap-2">
                <input type="date" id="dateFrom" class="form-control form-control-sm rounded border">
                <input type="date" id="dateTo" class="form-control form-control-sm rounded border">
            </div>
        </div>

        <!-- Sort -->
        <div class="col-12 col-md-auto">
            <label for="sortDate" class="text-small text-accent"><?= __('Sort by Date') ?></label>
            <select id="sortDate" class="form-select form-select-sm">
                <option value=""><?= __('Default') ?></option>
                <option value="asc"><?= __('Oldest First') ?></option>
                <option value="desc"><?= __('Newest First') ?></option>
            </select>
        </div>
    </div>

    <hr class="mb-1 mt-3" />

    <div class="table-responsive">
        <table id="messagesTable" class="table table-striped table-bordered align-middle display nowrap w-100">
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
            <?php foreach ($contactMessages as $m): ?>
                <tr>
                    <td><?= h($m->customer_name) ?></td>
                    <td><?= h($m->customer_email) ?></td>
                    <td><?= h($m->customer_phone) ?></td>
                    <td><?= h($m->message_type) ?></td>
                    <td>
                        <span class="d-inline-block text-truncate text-dark"
                              style="max-width: 200px; cursor: pointer;"
                              data-bs-toggle="offcanvas"
                              data-bs-target="#descriptionOffcanvas"
                              data-description="<?= h($m->description) ?>">
                            <?= h(Text::truncate($m->description, 60, ['ellipsis' => '...'])) ?>
                        </span>
                    </td>
                    <td data-order="<?= strtotime($m->created_at) ?>">
                        <?= $this->Time->format($m->created_at, 'dd MMM yyyy, hh:mm a') ?>
                    </td>
                    <td class="text-center">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $m->id], [
                            'class' => 'btn btn-sm btn-primary rounded-3'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="descriptionOffcanvas"
     aria-labelledby="descriptionOffcanvasLabel"
     data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="descriptionOffcanvasLabel"><?= __('Description') ?></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="<?= __('Close') ?>"></button>
    </div>
    <div class="offcanvas-body">
        <p id="offcanvasDescriptionText" class="mb-0"></p>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = $('#messagesTable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            autoWidth: false,
            scrollX: true,
            language: {
                zeroRecords: "No messages found",
                loadingRecords: "Loading..."
            },
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 5 },
                { responsivePriority: 3, targets: 3 }
            ]
        });

        // Offcanvas description viewer
        document.getElementById('descriptionOffcanvas').addEventListener('show.bs.offcanvas', function (event) {
            const trigger = event.relatedTarget;
            const description = trigger.getAttribute('data-description');
            document.getElementById('offcanvasDescriptionText').textContent = description;
        });

        // Type filter
        document.getElementById('filterType').addEventListener('change', function () {
            table.columns(3).search(this.value).draw();
        });

        // Date range filter
        $.fn.dataTable.ext.search.push(function (settings, data) {
            const min = new Date(document.getElementById('dateFrom').value || '1970-01-01');
            const max = new Date(document.getElementById('dateTo').value || '3000-01-01');
            const date = new Date(data[5]);
            return (!isNaN(date) && date >= min && date <= max);
        });

        document.getElementById('dateFrom').addEventListener('change', () => table.draw());
        document.getElementById('dateTo').addEventListener('change', () => table.draw());

        // Sort by date
        const sortDropdown = document.getElementById('sortDate');
        const savedSort = localStorage.getItem('msgSort');
        if (savedSort) {
            table.order([5, savedSort]).draw();
            sortDropdown.value = savedSort;
        }

        sortDropdown.addEventListener('change', function () {
            const dir = this.value;
            if (dir) {
                table.order([5, dir]).draw();
                localStorage.setItem('msgSort', dir);
            } else {
                table.order([]).draw();
                localStorage.removeItem('msgSort');
            }
        });
    });
</script>
