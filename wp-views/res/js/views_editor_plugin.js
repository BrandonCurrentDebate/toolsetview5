//views_editor_plugin.js
(function ($) {
    // Disable initial AJAX loading on document ready
    $(document).ready(function () {
        console.log('Initial AJAX loading disabled.');
    });

    // Preserve user-triggered events for pagination and filtering
    $(document).on('click', '.js-wpv-pagination-link', function (e) {
        e.preventDefault();
        const $container = $(this).closest('.js-wpv-view-layout-wrapper');
        const url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $container.html(response);
                console.log('Pagination updated.');
            },
            error: function () {
                alert('An error occurred while updating the View.');
            },
        });
    });
})(jQuery);
