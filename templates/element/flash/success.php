<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div
    id="flashMessage"
    class="toast toast-body
    d-flex mb-2 gap-2
    position-fixed top-1 start-50
    translate-middle-x z-5
    justify-content-between align-items-center
    text-success border border-success
    rounded-pill show"
>
    <span class="material-symbols-outlined">check_circle</span>
    <p class="fs-7 mb-0"><?= $message ?></p>

    <button class="btn btn-sm p-0 border-0 bg-transparent" onclick="this.closest('.toast').classList.add('hidden')">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>

<style>
    .toast.fade {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let delay = 0;
        document.querySelectorAll('.toast').forEach(function(toast, index) {
            delay = 2000 + (index * 1000); // Start 2 seconds after page load, increase delay by 1 second for each toast
            setTimeout(function() {
                toast.classList.add('fade');
                setTimeout(function() {
                    toast.remove();
                }, 1000);
            }, delay);
        });
    });
</script>
