import Vue from 'vue';
import Vuex from 'vuex';

import auth from './auth.module';

import createPersistedState from 'vuex-persistedstate';
import createMutationsSharer from 'vuex-shared-mutations';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth
    },
    plugins: [
        createPersistedState(),
        createMutationsSharer({ predicate: ['logout','setUser'] })
    ]
});