<!-- src/Template/Element/header.php -->
<head>
    <link rel="manifest" href="/site.webmanifest?v=1">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(registration) {
                    console.log('ServiceWorker registration successful with scope:', registration.scope);
                }, function(err) {
                    console.log('ServiceWorker registration failed:', err);
                });
            });
        }
    </script>



    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <!-- Default title is 'Gleam & Grace' if no title is set in the view -->
    <title>
        <?= $this->fetch('title') ?? 'Gleam & Grace' ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['cake', 'styles', 'button']) ?>
    <?= $this->fetch('script') ?>


    <!-- Bootstrap 5.3.3 CSS -->
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css') ?>


    <!-- Preconnect to speed up Google Fonts loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Google Font (Bodoni Moda) -->
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&display=swap') ?>
    <!-- Google Font (Libre Baskerville) -->
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap') ?>
    <!-- Google Font (DM Sans) -->
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap') ?>


    <!-- Material Icons -->
    <?= $this->Html->css(
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined',
    ) ?>


    <!-- Datatables CSS-->
    <?= $this->Html->css(
        'https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/cr-2.0.4/fc-5.0.4/fh-4.0.1/rr-1.5.0/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css',
        ['integrity' => 'sha384-wfrv4hkIk0AIej6fJkWWjGCWORR5z6YlAq47SQ5UnS4DDOLyIhGljkhKCmibeuOQ', 'crossorigin' => 'anonymous'],
    ) ?>
    <?= $this->Html->css(
        'https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.css',
        ['integrity' => 'sha384-inDoREwjvy5La3vgUWcIczhlGcfXAt1V1DsIU/yHRTbfL3W/HfMnReyF4xwS7S+x', 'crossorigin' => 'anonymous'],
    ) ?>

    <!-- Add DataTables jQuery CSS and JS (CDN) -->
    <?= $this->Html->css('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css') ?>
    <?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
    <?= $this->Html->script('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') ?>
</head>
