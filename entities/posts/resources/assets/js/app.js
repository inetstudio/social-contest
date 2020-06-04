require('./stores/posts');

Vue.component(
    'SocialContestPostForm',
    require('./components/pages/Form.vue').default,
);

let posts = require('./package/social-contest.posts');
posts.init();
