<template>
    <div id="social_contest_post_form_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade" ref="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
                    </button>
                    <h1 class="modal-title">Пост</h1>
                </div>
                <div class="modal-body">
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="content">
                            <div class="row m-b-md">
                                <div class="col-lg-12">
                                    <span :class="'btn-' + _.get(post, 'model.status.color_class', '')" class="btn btn-sm float-right">{{ _.get(post, 'model.status.name', '') }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Основная информация</h5>
                                            <div class="ibox-tools">
                                                <a class="collapse-link">
                                                    <i class="fa fa-chevron-up"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="m-b-lg">
                                                        <p><strong>Социальная сеть:</strong> {{ _.get(post, 'model.social.social_name', '') }}</p>
                                                        <p><strong>Тип поста:</strong> {{ _.get(post, 'model.social.media_type', '') }}</p>
                                                        <p><strong>Пользователь:</strong> <a :href="_.get(post, 'model.social.user.url', '#')" target="_blank">{{ _.get(post, 'model.social.user.nickname', '') }}</a></p>
                                                        <p v-if="_.has(post, 'model.social.url')"><strong>Пост:</strong> <a :href="_.get(post, 'model.social.url', '#')" target="_blank">Перейти</a></p>
                                                        <p><strong>ID поста на сайте:</strong> <span :id="'uuid-' + _.get(post, 'model.id', 0)">{{ _.get(post, 'model.uuid', '') }}</span></p>
                                                        <p v-if="_.has(post, 'model.social.caption')"><strong>Содержимое:</strong><br/><span v-html="_.get(post, 'model.social.caption', '')"></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox border-bottom collapsed">
                                        <div class="ibox-title">
                                            <h5>Призы</h5>
                                            <div class="ibox-tools">
                                                <a class="collapse-link">
                                                    <i class="fa fa-chevron-up"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content" style="display: none;">
                                            <div>
                                                <social-contest-prizes-list
                                                    v-bind:prizes-prop="_.get(post, 'model.prizes', [])"
                                                    v-on:update:prizes="updatePrizes($event)"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="save btn btn-primary" v-on:click.prevent.stop="save">Сохранить</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'SocialContestPostForm',
    data() {
      return {
        post: {}
      };
    },
    computed: {
      _() {
        return _;
      },
      storePost() {
        return window.Admin.vue.stores['social_contest_posts'].state.post;
      }
    },
    watch: {
      'post.model': {
        handler: function(newValue, oldValue) {
          let component = this;

          component.post.hash = window.hash(newValue);
        },
        deep: true
      },
      storePost: {
        handler: function(newValue, oldValue) {
          let component = this;

          component.post = JSON.parse(JSON.stringify(newValue));
        },
        deep: true
      }
    },
    methods: {
        updatePrizes(data) {
          let component = this;

          if (data) {
            component.post.model.prizes = _.map(data.prizes, function (prize) {
                if (prize.hasOwnProperty('model')) {
                    return prize.model;
                }

                return prize;
            });
          }
        },
        save() {
            let component = this;

            let container = $(component.$refs.modal).find('.ibox-content');
            container.addClass('sk-loading');

            let url = (component.post.model.id)
                ? route('back.social-contest.posts.update', {post: component.post.model.id})
                : route('back.social-contest.posts.store');

            let data = component.post.model;
            if (component.post.model.id) {
              data._method = 'PUT';
            }

            axios.post(url, data)
              .then(response => {
                container.removeClass('sk-loading');

                if (response.status !== 200) {
                  throw new Error(response.statusText);
                }

                let item = response.data;

                let row = $('#post_row_'+item.id);

                for (let column in item){
                  if (item.hasOwnProperty(column)) {
                    row.find('.post-'+column).html(item[column]);
                  }
                }

                $(component.$refs.modal).modal('hide');
              })
              .catch(error => {
                container.removeClass('sk-loading');

                swal.fire({
                  title: 'Ошибка',
                  text: 'При сохранении произошла ошибка',
                  type: 'error'
                });
              });
        }
    }
  };
</script>

<style scoped>
</style>
