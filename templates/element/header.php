<!-- src/Template/Element/header.php -->
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Default title is 'Gleam & Grace' if no title is set in the view -->
<title>
    <?= $this->fetch('title', 'Gleam & Grace') ?>
</title>

<?= $this->Html->meta('icon') ?>
<?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

<!-- Bootstrap 5.3.3 CSS -->
<?= $this->Html->css(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
    ['block' => true, 'rel' => 'stylesheet', 'integrity' => 'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH', 'crossorigin' => 'anonymous']
) ?>

<!-- Google Fonts -->
<?= $this->Html->css(
    'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap',
    ['block' => true, 'rel' => 'stylesheet']
) ?>

<!-- Material Icons -->
<?= $this->Html->css(
    'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined',
    ['block' => true, 'rel' => 'stylesheet']
) ?>

<!-- Datatables CSS-->
<?= $this->Html->css(
    'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/cr-2.0.4/fc-5.0.4/fh-4.0.1/rr-1.5.0/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css',
    ['block' => true, 'rel' => 'stylesheet', 'integrity' => 'sha384-wfrv4hkIk0AIej6fJkWWjGCWORR5z6YlAq47SQ5UnS4DDOLyIhGljkhKCmibeuOQ', 'crossorigin' => 'anonymous']
) ?>

<!-- Add DataTables CSS and JS (CDN) -->
<?= $this->Html->css('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
<?= $this->Html->script('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') ?>
