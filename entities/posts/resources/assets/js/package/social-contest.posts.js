let posts = {};

posts.init = function () {
    $(document).ready(function () {
        let $moderationTable = $('#social_contest_posts table');

        $moderationTable.on('draw.dt', function () {
            new Clipboard('.clipboard');
        });

        $moderationTable.on('click', 'a.post-moderate', function (event) {
            event.preventDefault();

            let button = $(this),
                url = button.attr('href'),
                reason = button.attr('data-reason');

            $('#social_contest_posts .ibox-content').toggleClass('sk-loading');

            if (typeof reason !== typeof undefined && reason !== false) {
                swal.fire({
                    title: 'Введите причину изменения статуса',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    preConfirm: (inputReason) => {
                        if (inputReason === '') {
                            return {
                                dismiss: 'cancel'
                            };
                        }

                        let data = {
                            additional_info: {
                                statusReason: inputReason
                            }
                        };

                        return moderate(url, data);
                    },
                    allowOutsideClick: () => ! swal.isLoading()
                }).then((result) => {
                    processModerateResponse(result);
                });
            } else {
                new Promise(function(resolve, reject) {
                    let result = moderate(url, {});

                    resolve(result);
                }).then((result) => {
                    processModerateResponse(result);
                });
            }
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

    function moderate(url, data)
    {
        return axios.post(url, data)
            .then(response => {
                $('#social_contest_posts .ibox-content').toggleClass('sk-loading');

                if (response.status !== 200) {
                    throw new Error(response.statusText);
                }

                return response.data;
            })
            .catch(error => {
                $('#social_contest_posts .ibox-content').toggleClass('sk-loading');

                swal.fire({
                    title: 'Ошибка',
                    text: 'При модерации произошла ошибка',
                    type: 'error',
                });
            });
    }

    function processModerateResponse(result)
    {
        result = _.get(result, 'value', result);

        if (result.dismiss === 'cancel') {
            $('#social_contest_posts .ibox-content').toggleClass('sk-loading');

            return;
        }

        if (result.success === true) {
            result.items.forEach(function (item) {
                let row = $('#post_row_'+item.id);

                for (let column in item){
                    if (item.hasOwnProperty(column)) {
                        row.find('.post-'+column).html(item[column]);
                    }
                }
            });

            swal.fire({
                title: 'Статус изменен',
                type: 'success',
            });
        } else {
            swal.fire({
                title: 'Ошибка',
                text: 'При модерации произошла ошибка',
                type: 'error',
            });
        }
    }

};

module.exports = posts;
