<footer class="container-fluid border-top mt-5 p-3 p-md-5 ">
    <?php if ($this->Identity->isLoggedIn()) : ?>
    <?php else : ?>
        <?= $this->element('footer.public') ?>
    <?php endif; ?>
    <!-- PopperJS (required for Bootstrap 5.3.3) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
    <!-- Datatables JS -->
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/cr-2.0.4/fc-5.0.4/fh-4.0.1/rr-1.5.0/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js"
        integrity="sha384-OLaKBRgIysZHEnR3n4vZTgJQyblRDevlmz92Rw5aY09UnXHph0ttE+KTpATRJflt"
        crossorigin="anonymous"></script>
</footer>

