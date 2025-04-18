<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php if ($this->Identity->isLoggedIn()) : ?>
    <?= $this->fetch('Products/index.private') ?>
<?php else : ?>
    <?= $this->fetch('Products/index.public') ?>
<?php endif; ?>
