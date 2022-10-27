// importiamo Vue
import Vue from 'vue';

// importiamo Vue-router
import VueRouter from 'vue-router';

// specifico a vue-router le rotte da prendere e usare
Vue.use(VueRouter)

// rotte
import HomePage from './components/pages/HomePage';
<<<<<<< HEAD
import DoctorDetails from './components/pages/DoctorDetails';
=======
import UserDetailsPage from './components/pages/UserDetailsPage';
import ReviewsPage from './components/pages/ReviewsPage';
>>>>>>> d25c59d99f80dd27c9cabb204695d0e37be26428
import UserSearchPage from './components/pages/UserSearchPage';
import NotFoundPage from './components/pages/NotFoundPage';




// istanziamo VueRouter
const routes = new VueRouter({
    // questo ci dà comandini fighi e la cronologia
    mode: 'history',
    routes: [
        {path: '/', component: HomePage, name: 'home'},
        {path: '/search/:specializationId', component: UserSearchPage, name: 'search'},
<<<<<<< HEAD
        {path: '/users/:id', component: DoctorDetails, name: 'users-show'},
=======
        { path: '/users/:id', component: UserDetailsPage, name: 'user-detail' },
        { path: '/users/:userId/reviews', component: ReviewsPage, name: 'reviews' },

        // ! SEMPRE IN FONDO!
        { path: '*', component: NotFoundPage, name: 'notFound' },
>>>>>>> d25c59d99f80dd27c9cabb204695d0e37be26428
    ],
})

// se ti dimentichi sto dio madonna di export non ti funziona un cazzo puttana la madonna, Dr. Strunz
export default routes;
