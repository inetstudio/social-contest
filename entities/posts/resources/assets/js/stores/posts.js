import hash from 'object-hash';

window.Admin.vue.stores['social_contest_posts'] = new window.Vuex.Store({
  state: {
    post: {
      model: {},
      errors: {},
      hash: ''
    },
    posts: [],
    mode: '',
  },
  mutations: {
    setPost(state, post) {
      let postCopy = JSON.parse(JSON.stringify(post));

      state.post.model = postCopy;
      state.post.hash = hash(postCopy);
    },
    setPosts(state, posts) {
      state.posts = posts;
    },
    setMode(state, mode) {
      state.mode = mode;
    },
    reset(state) {
      state.mode = '';
      state.post = {
        model: {},
        hash: ''
      };
      state.posts = [];
    }
  },
});
