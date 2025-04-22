<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>

<!-- Include DataTables + Responsive extension -->
<?= $this->Html->css([
    'https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css',
    'https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css'
]) ?>
<?= $this->Html->script([
    'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js',
    'https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js',
    'https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js',
    'https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js'
]) ?>

<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h4 class="mb-0"><?= __('Products') ?></h4>
        <?= $this->Html->link(__('New Product'), ['action' => 'add'], [
            'class' => 'btn btn-success text-white rounded-3'
        ]) ?>
    </div>

    <div class="table-responsive">
        <table id="productsTable" class="table table-striped table-bordered align-middle nowrap" style="width:100%">
            <thead class="table-light">
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Category') ?></th>
                <th><?= __('Price') ?></th>
                <th><?= __('Stock') ?></th>
                <th><?= __('Created At') ?></th>
                <th class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td class="text-center"><?= h($product->name) ?></td>
                    <td class="text-center"><?= h($product->category) ?></td>
                    <td class="text-center">$<?= number_format((float)$product->base_price, 2) ?></td>
                    <td class="text-center"><?= $this->Number->format($product->stock_quantity) ?></td>
                    <td class="text-center"><?= $this->Time->format($product->created_at, 'dd/MM/yyyy HH:mm') ?></td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], [
                                'class' => 'btn btn-sm rounded-3 text-white me-2',
                                'style' => 'background-color: #6c757d;'
                            ]) ?>

                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], [
                                'class' => 'btn btn-sm btn-warning text-white rounded-3 me-2'
                            ]) ?>

                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
                                'class' => 'btn btn-sm btn-danger text-white rounded-3',
                                'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                            ]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#productsTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            info: true,
            lengthChange: true,
            order: [[0, 'asc']],
            layout: {
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });
    });
</script>
