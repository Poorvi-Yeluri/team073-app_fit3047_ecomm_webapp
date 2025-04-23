document.addEventListener('DOMContentLoaded', () => {
    $('.datatable').DataTable({
        paging: true,
        searching: true,
        info: true,
        lengthChange: true,
        responsive: true,
        order: [[0, 'asc']],
        layout: {
            topStart: 'pageLength',
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging'
        }
    });
});
