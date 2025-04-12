<!-- src/Template/Element/header.php -->
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Default title is 'Gleam & Grace' if no title is set in the view -->
<title>
    <?= $this->fetch('title', 'Gleam & Grace') ?>
</title>
<?= $this->Html->meta('icon') ?>
<?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

<!-- Placeholders for additional meta, CSS, or JS -->
<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>
