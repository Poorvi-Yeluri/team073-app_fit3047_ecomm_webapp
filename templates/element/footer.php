<?php if (!$this->Identity->isLoggedIn()) : ?>
    <footer class="container-fluid border-top mt-5 p-3 p-md-5 ">
        <?= $this->element('footer.public') ?>
    </footer>
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
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"
        integrity="sha384-zAVoatBLtEAzOhdX4Xkli8AOOsRiPj+iFEsCh/BBYnKNHJCM/G8PNGupst4xx3Ft"
        crossorigin="anonymous"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?= $this->Html->script('form-validation') ?>
<?= $this->Html->script('datatable-init') ?>
<?= $this->Html->script('add-to-cart') ?>
