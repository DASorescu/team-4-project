require('./bootstrap');

window.Vue = require('vue');

import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faHouse } from '@fortawesome/free-solid-svg-icons'
import { faPhone } from '@fortawesome/free-solid-svg-icons'
import { faArrowRight } from '@fortawesome/free-solid-svg-icons'
import { faLocationDot } from '@fortawesome/free-solid-svg-icons'
import { faBriefcaseMedical } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faHouse)
library.add(faPhone)
library.add(faArrowRight)
library.add(faLocationDot)
library.add(faBriefcaseMedical)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

import App from './components/App.vue';

import router from './router';

const app = new Vue({
    router,
    el: '#root',
    render: h => h(App),
});

