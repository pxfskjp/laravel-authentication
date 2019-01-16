import ApiService from "../api/api.service";
import JwtService from "../common/jwt.service";

import {CHECK_AUTH} from "./actions.type"

import {SET_AUTH, SET_ERROR, RESET_AUTH} from "../store/mutations.type";
import {LOGIN, LOGOUT, REGISTER} from "./actions.type";

const state = {
    errors: null,
    user: {},
    userId: null,
    isAuthenticated: !!JwtService.getToken()
};

const getters = {
    currentUser(state){
        return state.user;
    },
    isAuthenticated(state){
        return state.isAuthenticated;
    }
};

const mutations = {
    [SET_ERROR](state, error) {
        state.errors = error;
    },
    [SET_AUTH](state, userId) {
        state.isAuthenticated = true;
        state.userId = userId;
        state.errors = {};
        JwtService.saveToken(state.token);
    },
    [RESET_AUTH](state) {
        state.isAuthenticated = false;
        state.user = {};
        state.errors = {};
        JwtService.unsetToken();
    }
};

const actions = {
    [LOGIN](context, credentials) {
        return new Promise(resolve => {
            ApiService.post("api/users/login", { user: credentials })
                .then(({ data }) => {
                    context.commit(SET_AUTH, data.userId);
                    resolve(data);
                })
                .catch(({ response }) => {
                    context.commit(SET_ERROR, response.data.errors);
                });
        });
    },
    [LOGOUT](context) {
        context.commit(RESET_AUTH);
    },
    [REGISTER](context, credentials) {
        console.log(credentials);
        return new Promise((resolve, reject) => {
            ApiService.post("api/users", { user: credentials })
                .then(({ data }) => {
                    console.log(data);
                    context.commit(SET_AUTH, data.userId);
                    resolve(data);
                })
                .catch(({ response }) => {
                    context.commit(SET_ERROR, response.data.errors);
                    reject(response);
                });
        });
    },
};

export default {
    getters,
    actions,
    mutations,
    state
}