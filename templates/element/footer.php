<footer class="container-fluid border-top mt-5 p-3 p-md-5 ">
    <?php if ($this->request->getAttribute('identity')) : ?>
    <?php else : ?>
        <?= $this->element('footer.public') ?>
    <?php endif; ?>
    <!-- PopperJS (required for Bootstrap 5.3.3) -->
    <?= $this->Html->script(
        'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js',
        ['block' => true, 'integrity' => 'sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r', 'crossorigin' => 'anonymous']
    ) ?>

    <!-- Bootstrap 5.3.3 JS -->
    <?= $this->Html->script(
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js',
        ['block' => true, 'integrity' => 'sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy', 'crossorigin' => 'anonymous']
    ) ?>
    <!-- Datatables JS -->
    <?= $this->Html->script(
        'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/cr-2.0.4/fc-5.0.4/fh-4.0.1/rr-1.5.0/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js',
        ['block' => true, 'integrity' => 'sha384-OLaKBRgIysZHEnR3n4vZTgJQyblRDevlmz92Rw5aY09UnXHph0ttE+KTpATRJflt', 'crossorigin' => 'anonymous']
    ) ?>
</footer>
