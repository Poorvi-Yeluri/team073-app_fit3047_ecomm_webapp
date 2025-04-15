<nav class="navbar bg-light sticky-top d-flex flex-column pt-0 pb-0 gap-0"
     style="background: rgba(255, 255, 255, 0.0);
            box-shadow: 2px 4px 60px rgba(0, 0, 0, 0.1);"
>
    <?php if ($this->Identity->isLoggedIn()) : ?>
        <?= $this->element('navbar.private') ?>
    <?php else : ?>
        <?= $this->element('navbar.public') ?>
    <?php endif; ?>
</nav>
