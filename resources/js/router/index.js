import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('@/App')
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('@/views/Login')
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('@/views/Register')

        }
    ]
});