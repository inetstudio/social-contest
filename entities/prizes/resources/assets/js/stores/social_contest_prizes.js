window.Admin.vue.stores['social_contest_prizes'] = new Vuex.Store({
  state: {
    prize: {
      model: {},
      errors: {},
      hash: '',
    },
    prizes: [],
    mode: '',
  },
  mutations: {
    setPrize(state, prize) {
      let prizeCopy = JSON.parse(JSON.stringify(prize));

      state.prize.model = (prizeCopy.hasOwnProperty('model')) ? prizeCopy.model : prizeCopy;
      state.prize.hash = window.hash(state.prize.model);
    },
    newPrize(state, postId) {
      let prizeId = UUID.generate();

      let prize = {
        id: prizeId,
        pivot: {
          post_id: postId,
          prize_id: prizeId,
          confirmed: 0,
          date_start: null,
          date_end: null
        }
      };

      this.commit('setPrize', prize);
    },
    setPrizes(state, prizes) {
      state.prizes = prizes;
    },
    setMode(state, mode) {
      state.mode = mode;
    },
    reset(state) {
      state.mode = '';
      state.prize = {
        model: {},
        errors: {},
        hash: ''
      };
      state.prizes = [];
    }
  },
});
