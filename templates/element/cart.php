<?php
$session = $this->request->getSession();
$cartItems = $session->read('Cart.items') ?? [];
?>

<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="cartOffcanvas"
     data-bs-backdrop="false"
     aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 id="cartOffcanvasLabel">Your Cart</h5>
        <button type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if (!empty($cartItems)): ?>
            <div id="cartItemsList" class="d-flex flex-column gap-3">
                <?php foreach ($cartItems as $itemId => $item): ?>
                    <div class="cartItem p-2">
                        <div class="d-flex align-items-center">
<!--                            <div class="d-flex align-items-center">-->
<!--                                <img src="--><?php //= h($item['image_url']) ?><!--"-->
<!--                                     class="me-3"-->
<!--                                     style="width: 60px; height: 60px; object-fit: cover;">-->
<!--                            </div>-->
                            <div class="flex-grow-1">
                                <strong class="font-serif"><?= h($item['name']) ?></strong><br>
                                <span>Price: $<?= number_format($item['price'], 2) ?></span><br>
                                <span>Quantity: <?= h($item['quantity']) ?></span>
                            </div>

                            <!-- Remove Item Button -->
                            <?= $this->Form->create(null, [
                                'url' => ['controller' => 'Cart', 'action' => 'remove', $itemId],
                                'type' => 'post',
                                'class' => 'd-inline'
                            ]) ?>
                            <?= $this->Form->button(__('Remove'), [
                                'class' => 'btn btn-sm btn-danger rounded-2 ms-3',
                                'confirm' => 'Are you sure you want to remove "' . h($item['name']) . '" from your cart?'
                            ]) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="<?= $this->Url->build(['controller' => 'Cart', 'action' => 'checkout']) ?>"
               class="btn rounded-2 mt-3 w-100"
               style="background-color: var(--accent-color); color: var(--white);">
                Proceed to Checkout
            </a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</div>


