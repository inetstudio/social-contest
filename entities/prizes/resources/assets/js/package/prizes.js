let prizes = {};

prizes.init = function() {
  if (!window.Admin.vue.modulesComponents.modules.hasOwnProperty('social_contest_prizes')) {
    window.Admin.vue.modulesComponents.modules = Object.assign(
        {}, window.Admin.vue.modulesComponents.modules, {
          social_contest_prizes: {
            components: [],
          },
        });
  }
};

module.exports = prizes;
