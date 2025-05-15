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
    position-fixed start-50
    translate-middle-x
    justify-content-between align-items-center
    border border-success rounded-pill show"
    style="background-color: #d4edda; z-index: 1055; top: 60px;"
>
    <span class="material-symbols-outlined">check_circle</span>
    <p class="fs-7 mb-0"><?= $message ?></p>

    <button class="btn btn-sm p-0 border-0 bg-transparent" onclick="this.closest('.toast').remove()">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>

<style>
    .toast.fade {
        opacity: 0;
        transition: opacity 0.5s ease-out;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let baseDelay = 8000; // Toast stays for 8 seconds
        document.querySelectorAll('.toast').forEach(function(toast, index) {
            let delay = baseDelay + (index * 1000);
            setTimeout(function() {
                toast.classList.add('fade');
                setTimeout(function() {
                    toast.remove();
                }, 1000); // Wait 1s after fade before removing
            }, delay);
        });
    });
</script>
