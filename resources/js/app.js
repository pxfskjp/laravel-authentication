import Vue from 'vue';
import App from './App';

import store from './store';
import router from './router';

import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);


const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
