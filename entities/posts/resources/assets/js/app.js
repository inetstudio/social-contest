import {posts} from './package/social-contest.posts'

require('./stores/posts');

window.Vue.component(
    'SocialContestPostForm',
    () => import('./components/pages/Form.vue'),
);

posts.init();
