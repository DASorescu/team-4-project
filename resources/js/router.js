// importiamo Vue
import Vue from 'vue';

// importiamo Vue-router
import VueRouter from 'vue-router';

// specifico a vue-router le rotte da prendere e usare
Vue.use(VueRouter)

// rotte
import HomePage from './components/pages/HomePage';

// istanziamo VueRouter
const routes = new VueRouter({
    // questo ci dà comandini fighi e la cronologia
    mode: 'history',
    routes: [
        {path: '/', component: HomePage, name: 'home'},
    ],
})

// se ti dimentichi sto dio madonna di export non ti funziona un cazzo puttana la madonna, Dr. Strunz
export default routes;