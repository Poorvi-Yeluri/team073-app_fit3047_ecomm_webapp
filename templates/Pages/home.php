<?php if ($this->request->getAttribute('identity')) : ?>
    <script>
        window.location.href = "<?= $this->Url->build(['controller' => 'contact-messages', 'action' => 'index']) ?>";
    </script>
<?php else : ?>


<?php endif; ?>
