require('./bootstrap');

window.Vue = require('vue');

import App from './components/App.vue';
import router from './router';

const app = new Vue({
    router,
    el: '#root',
    render: h => h(App),
});

