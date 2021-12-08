import hash from 'object-hash';
import { v4 as uuidv4 } from 'uuid';

window.Admin.vue.stores['social_contest_prizes'] = new window.Vuex.Store({
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
      state.prize.hash = hash(state.prize.model);
    },
    newPrize(state) {
      let prizeId = uuidv4();

      let prize = {
        id: prizeId,
        pivot: {
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
  }
});
