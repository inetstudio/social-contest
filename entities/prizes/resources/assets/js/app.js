require('./stores/social_contest_prizes');

Vue.component(
    'SocialContestPrizesList',
    require('./components/partials/SocialContestPrizesList/SocialContestPrizesList.vue').default,
);
Vue.component(
    'SocialContestPrizesListItem',
    require('./components/partials/SocialContestPrizesList/SocialContestPrizesListItem.vue').default,
);
Vue.component(
    'SocialContestPrizesListItemForm',
    require('./components/partials/SocialContestPrizesList/SocialContestPrizesListItemForm.vue').default,
);

let prizes = require('./package/social_contest_prizes');
prizes.init();
