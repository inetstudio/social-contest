<template>
    <li>
        <div class="row">
            <div class="col-10">
                <i v-if="prize.model.pivot.confirmed" class="fa fa-check-square"></i><span class="m-l-xs">{{ prize.model.name }}</span>
            </div>
            <div class="col-2">
                <div class="btn-group float-right">
                    <a href="#" class="btn btn-xs btn-default edit-prize m-r" v-on:click.prevent.stop="edit"><i class="fa fa-pencil-alt"></i></a>
                    <a href="#" class="btn btn-xs btn-danger delete-prize" v-on:click.prevent.stop="remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
  export default {
    name: 'SocialContestPrizesListItem',
    props: {
      prize: {
        type: Object,
        required: true
      },
    },
    methods: {
      edit() {
        let component = this;

        window.Admin.vue.helpers.initComponent('social_contest_prizes', 'SocialContestPrizesListItemForm', {});

        window.Admin.vue.stores['social_contest_prizes'].commit('setMode', 'edit_list_item');
        window.Admin.vue.stores['social_contest_prizes'].commit('setPrize', component.prize);

        window.waitForElement('#social_contest_prizes_list_item_form_modal', function () {
          $('#social_contest_prizes_list_item_form_modal').modal();
        });
      },
      remove() {
        let component = this;

        component.$emit('remove', {
          id: component.prize.model.id
        });
      }
    }
  };
</script>

<style scoped>
</style>
