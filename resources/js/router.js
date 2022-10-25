// importiamo Vue
import Vue from 'vue';

// importiamo Vue-router
import VueRouter from 'vue-router';

// specifico a vue-router le rotte da prendere e usare
Vue.use(VueRouter)

// rotte
import HomePage from './components/pages/HomePage';
import AdvancedResearch from './components/pages/AdvancedResearch';

// istanziamo VueRouter
const routes = new VueRouter({
    // questo ci dà comandini fighi e la cronologia
    mode: 'history',
    routes: [
        {path: '/', component: HomePage, name: 'home'},
        {path: '/users', component: AdvancedResearch, name: 'users'},
        {path: '/users/{user}', component: AdvancedResearch, name: 'users.show'},
    ],
})

// se ti dimentichi sto dio madonna di export non ti funziona un cazzo puttana la madonna, Dr. Strunz
export default routes;