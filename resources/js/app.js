import Vue from 'vue';
import App from './App';

import store from './store';
import router from './router';

import BootstrapVue from 'bootstrap-vue';
import ApiService from './api/api.service';

import veevalidate from './util/veevalidate'

Vue.use(BootstrapVue);

ApiService.init();

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
