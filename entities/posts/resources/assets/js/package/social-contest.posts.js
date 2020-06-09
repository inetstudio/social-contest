let posts = {};

posts.init = function() {
  $(document).ready(function() {
    let $moderationTable = $('#social_contest_posts table');

    $moderationTable.on('draw.dt', function() {
      new Clipboard('.clipboard');
    });

    $moderationTable.on('click', 'a.post-moderate', function(event) {
      event.preventDefault();

      let button = $(this),
          url = button.attr('href'),
          reason = button.attr('data-reason');

      $('#social_contest_posts .ibox-content').toggleClass('sk-loading');

      let data = {
        id: button.data('id'),
        status_id: button.data('status_id'),
      };

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

            data.additional_info = {
              statusReason: inputReason
            };

            return moderate(url, data);
          },
          allowOutsideClick: () => ! swal.isLoading(),
        }).then((result) => {
          processModerateResponse(result);
        });
      } else {
        new Promise(function(resolve, reject) {
          let result = moderate(url, data);

          resolve(result);
        }).then((result) => {
          processModerateResponse(result);
        });
      }
    });

    $('#social_contest_posts').on('click', '.show-social_post', function(event) {
      window.Admin.vue.helpers.initComponent('social_contest_posts', 'SocialContestPostForm', {});

      let url = $(this).attr('data-url');

      window.waitForElement('#social_contest_post_form_modal', function() {
        axios.get(url)
            .then(response => {
              window.Admin.vue.stores['social_contest_posts'].commit('setPost', response.data);

              $('#social_contest_post_form_modal').modal();
            })
            .catch(error => {
              showError('При загрузке поста произошла ошибка');
            });
      });
    });

    $('#add_socialPost_modal .add').on('click', function(event) {
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
        success: function(data) {
          $tableContent.toggleClass('sk-loading');

          $('#add_socialPost_modal').modal('hide');

          if (data.success === true) {
            $content.toggleClass('sk-loading');

            $moderationTable.DataTable().ajax.reload(function() {
              $tableContent.toggleClass('sk-loading');
            });
          } else {
            showError('При добавлении поста произошла ошибка');
          }
        },
        error: function() {
          $content.toggleClass('sk-loading');
          $tableContent.toggleClass('sk-loading');

          $('#add_socialPost_modal').modal('hide');

          showError('При добавлении поста произошла ошибка');
        },
      });
    });

    $('#add_socialPost_modal').on('hidden.bs.modal', function(e) {
      let modal = $(this);

      modal.find('.ibox-content').removeClass('sk-loading');

      modal.find('select.select2').val('');
      modal.find('select.select2').trigger('change');
      modal.find('input[name=social_post_link]').val('');
    });
  });

  function moderate(url, data) {
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

          showError('При модерации произошла ошибка');
        });
  }

  function processModerateResponse(result) {
    result = _.get(result, 'value', result);

    if (result.dismiss === 'cancel') {
      $('#social_contest_posts .ibox-content').toggleClass('sk-loading');

      return;
    }

    if (result.success === true) {
      result.items.forEach(function(item) {
        let row = $('#post_row_' + item.id);

        for (let column in item) {
          if (item.hasOwnProperty(column)) {
            row.find('.post-' + column).html(item[column]);
          }
        }
      });

      swal.fire({
        title: 'Статус изменен',
        type: 'success',
      });
    } else {
      showError('При модерации произошла ошибка');
    }
  }

  function showError(text) {
    swal.fire({
      title: 'Ошибка',
      text: text,
      type: 'error',
    });
  }
};

module.exports = posts;
