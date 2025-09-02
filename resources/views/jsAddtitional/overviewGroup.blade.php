<script>
    document.addEventListener("DOMContentLoaded", function () {
        // enable all dropdowns
        var dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
        dropdownTriggerList.map(function (dropdownTriggerEl) {
            return new bootstrap.Dropdown(dropdownTriggerEl)
        });

        // enable all collapses
        var collapseList = [].slice.call(document.querySelectorAll('.collapse'))
        collapseList.map(function (collapseEl) {
            return new bootstrap.Collapse(collapseEl, { toggle: false })
        });
    });
</script>