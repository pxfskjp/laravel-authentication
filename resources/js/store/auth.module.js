import ApiService from "../api/api.service";
import JwtService from "../common/jwt.service";

import {CHECK_AUTH} from "./actions.type"

import {SET_AUTH, SET_ERROR, RESET_AUTH} from "../store/mutations.type";
import {LOGIN, LOGOUT, REGISTER} from "./actions.type";

const state = {
    token: null,
    errors: {
        login: [],
        register: []
    },
    userId: null,
    isAuthenticated: !!JwtService.getToken()
};

const getters = {
    getRegisterErrors(){
        return state.errors.register;
    },
    getLoginErrors(){
        return state.errors.login;
    },
    currentUser(state){
        return state.userId;
    },
    isAuthenticated(state){
        return state.isAuthenticated;
    }
};

const mutations = {
    [SET_ERROR](state, {target, message}) {
        console.log(message);
        state.errors[target] = [];
        state.errors[target].push({message: message})
    },
    [SET_AUTH](state, data) {
        state.isAuthenticated = true;
        state.userId = data.userId;
        state.token = data.token;
        JwtService.setToken(data.token);
    },
    [RESET_AUTH](state) {
        state.isAuthenticated = false;
        state.userId = null;
        state.token = null;
        JwtService.unsetToken();
    }
};

const actions = {
    [LOGIN](context, credentials) {
        return new Promise((resolve, reject) => {
            ApiService.post("api/users/login", {user: credentials})
                .then(({data}) => {
                    context.commit(
                        SET_AUTH, {userId: data.userId, token: data.token}
                    );
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(
                        SET_ERROR,
                        {target: 'login', message: response.data.error}
                    );
                    reject(response);
                });
        });
    },
    [LOGOUT](context) {
        context.commit(RESET_AUTH);
    },
    [REGISTER](context, credentials) {
        return new Promise((resolve, reject) => {
            ApiService.post("api/users", {user: credentials})
                .then(({data}) => {
                    context.commit(SET_AUTH, {userId: data.userId, token: data.token});
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(
                        SET_ERROR,
                        {target: 'register', message: response.data.error}
                    );
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