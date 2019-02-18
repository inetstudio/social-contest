let posts = {};

posts.init = function () {
    $(document).ready(function () {
        let $moderationTable = $('#moderation table');
        let $tableContent = $('#moderation .ibox-content');

        $moderationTable.on('draw.dt', function () {
            new Clipboard('.clipboard');
        });

        $moderationTable.on('click', 'a.post-moderate, button.post-block', function (event) {
            event.preventDefault();

            let url = $(this).attr('data-target');

            $tableContent.toggleClass('sk-loading');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                success: function (data) {
                    $tableContent.toggleClass('sk-loading');

                    if (data.success === true) {
                        let ids = data.ids;

                        ids.forEach(function (id) {
                            let row = $('#post_row_'+id);

                            row.find('td:nth-child(1)').html(data.status);
                            row.find('td:nth-child(2)').html(data.moderation[id]);
                        });

                        swal({
                            title: "Статус изменен",
                            type: "success"
                        });
                    } else {
                        showError('При модерации произошла ошибка');
                    }
                },
                error: function () {
                    $tableContent.toggleClass('sk-loading');

                    showError('При модерации произошла ошибка');
                }
            });
        });

        $('#add_socialPost_modal .add').on('click', function (event) {
            event.preventDefault();

            let $form = $('#add_socialPost_modal form');
            let $content = $('#add_socialPost_modal .ibox-content');

            $content.toggleClass('sk-loading');

            let data = $form.serializeArray();
            let url = $form.attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    $tableContent.toggleClass('sk-loading');

                    $('#add_socialPost_modal').modal('hide');

                    if (data.success === true) {
                        $content.toggleClass('sk-loading');

                        $moderationTable.DataTable().ajax.reload(function () {
                            $tableContent.toggleClass('sk-loading');
                        });
                    } else {
                        showError('При добавлении поста произошла ошибка');
                    }
                },
                error: function () {
                    $content.toggleClass('sk-loading');
                    $tableContent.toggleClass('sk-loading');

                    $('#add_socialPost_modal').modal('hide');

                    showError('При добавлении поста произошла ошибка');
                }
            });
        });

        $('#add_socialPost_modal').on('hidden.bs.modal', function (e) {
            let modal = $(this);

            modal.find('.ibox-content').removeClass('sk-loading');

            modal.find('select.select2').val('');
            modal.find('select.select2').trigger('change');
            modal.find('input[name=social_post_link]').val('');
        });

        function showError(text) {
            swal({
                title: "Ошибка",
                text: text,
                type: "error"
            });
        }
    });
};

module.exports = posts;
