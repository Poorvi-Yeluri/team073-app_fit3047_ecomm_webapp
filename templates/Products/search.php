<?php if (!empty($queryTerm)): ?>
    <h3>Search results for "<?= h($queryTerm) ?>"</h3>

    <?php if ($usedFallback): ?>
        <p><em>Showing partial matches (fallback to keyword search)</em></p>
    <?php endif; ?>

    <?php if (empty($results)): ?>
        <p>No results found.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($results as $item): ?>
                <li>
                    <strong><?= h($item['title']) ?></strong>
                    - Category: <?= h($item['category']) ?>
                    - Price: $<?= h(number_format($item['price'], 2)) ?>

                    <?php if (!empty($item['variants'])): ?>
                        <ul>
                            <?php foreach ($item['variants'] as $variant): ?>
                                <li>
                                    Variant: <?= h($variant['variant_name']) ?> <?= h($variant['variant_value']) ?>
                                    - SKU: <?= h($variant['sku']) ?>
                                    - Price: $<?= h(number_format($variant['price'], 2)) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>
