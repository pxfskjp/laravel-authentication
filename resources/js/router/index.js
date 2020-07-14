import Vue from 'vue';
import VueRouter from 'vue-router';

import store from '../store'

import App from '../App';
import Login from '../views/Login';
import Register from '../views/Register';

Vue.use(VueRouter);

const router =  new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: App,
            meta: {
                requiresAuth: false,
                hideForAuth: false,
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresAuth: false,
                hideForAuth: true,
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                requiresAuth: false,
                hideForAuth: true,
            }
        }
    ]
});

/*
router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth && !store.getters.isAuthenticated){
        next('/login');
    } else if(to.meta.hideForAuth && store.getters.isAuthenticated){
        next('/');
    } else {
        next();
    }
});
*/


router.beforeEach((to, from, next) =>
    Promise.all([store.dispatch("auth/checkAuth")]).then(next)
);


export default router;
