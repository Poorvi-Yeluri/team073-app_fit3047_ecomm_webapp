<nav class="navbar sticky-top d-flex flex-column pt-0 gap-0">
    <?php if ($this->request->getAttribute('identity')) : ?>
        <?= $this->element('navbar.private') ?>
    <?php else : ?>
        <?= $this->element('navbar.public') ?>
    <?php endif; ?>
</nav>
