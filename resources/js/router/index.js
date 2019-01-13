import Vue from 'vue'
import VueRouter from 'vue-router'

import App from '../App'
import Login from '../views/Login'
import Register from '../views/Register'

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => App
        },
        {
            path: '/login',
            name: 'login',
            component: () => Login
        },
        {
            path: '/register',
            name: 'register',
            component: () => Register

        }
    ]
});