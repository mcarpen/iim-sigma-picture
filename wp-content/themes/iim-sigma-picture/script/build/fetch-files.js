jQuery(document).ready(function () {
    $('select[name="user_email"]').change(function () {
        const value = $('select[name="user_email"] option:selected').attr('value'),
            tableAdmin = $('.table-admin tbody'),
            tableUser = $('.table-user tbody'),
            form = $('#qq-form');

        tableAdmin.html('');
        tableUser.html('');
        form.find('input[type="hidden"]').attr('value', value);

        $.post(ajaxurl,
            {
                action: 'fetch_files',
                param: value
            },
            function (response) {
                const data = $(JSON.parse(response));
                let html;

                form.show();

                data[0].forEach(function(item) {
                    html = '<tr>' +
                        `<td><a href="${item.path}" download title="Télécharger ce fichier">${item.name}</a></td>` +
                        '</tr>';
                    tableAdmin.append(html);
                });

                data[1].forEach(function(item) {
                    html = '<tr>' +
                        `<td><a href="${item.path}" download title="Télécharger ce fichier">${item.name}</a></td>` +
                        '</tr>';
                    tableUser.append(html);
                });
            }
        );
    });
});