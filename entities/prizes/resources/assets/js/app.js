import {prizes} from './package/social_contest_prizes';

require('./stores/social_contest_prizes');

window.Vue.component(
    'SocialContestPrizesList',
    () => import('./components/partials/SocialContestPrizesList/SocialContestPrizesList.vue'),
);
window.Vue.component(
    'SocialContestPrizesListItem',
    () => import('./components/partials/SocialContestPrizesList/SocialContestPrizesListItem.vue'),
);
window.Vue.component(
    'SocialContestPrizesListItemForm',
    () => import('./components/partials/SocialContestPrizesList/SocialContestPrizesListItemForm.vue'),
);

prizes.init();
