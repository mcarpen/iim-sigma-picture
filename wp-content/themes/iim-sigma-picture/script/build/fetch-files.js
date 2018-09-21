jQuery(document).ready(function () {
    $('#qq-form select').change(function () {
        const value = $('#qq-form select option:selected').attr('value');

        $.post(ajaxurl,
            {
                action: 'fetch_files',
                param: value
            },
            function (response) {
                $('.shared-files').html(response);
            }
        );
    });
});