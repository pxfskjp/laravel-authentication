import ApiService from "../api/api.service";
import JwtService from "../common/jwt.service";

import {CHECK_AUTH} from "./actions.type"

import {SET_AUTH, SET_ERROR, RESET_AUTH, CLEAR_ERRORS} from "./mutations.type";
import {LOGIN, LOGOUT, REGISTER} from "./actions.type";

const getDefaultState = () => {
    return {
        token: null,
        errors: {
            login: [],
            register: []
        },
        userId: null,
        isAuthenticated: !!JwtService.getToken()
    }
};

const state = getDefaultState();

const getters = {
    getErrors(state){
        return state.errors;
    },
    currentUser(state){
        return state.userId;
    },
    isAuthenticated(state){
        return state.isAuthenticated;
    }
};

const mutations = {
    [CLEAR_ERRORS](state) {
        state.errors = [];
    },
    [SET_ERROR](state, {target, message}) {
        state.errors[target] = [];
        state.errors[target].push({message: message});
    },
    [SET_AUTH](state, data) {
        state.isAuthenticated = true;
        state.userId = data.userId;
        state.token = data.token;
        state.errors = getDefaultState().errors;
        JwtService.setToken(data.token);
    },
    [RESET_AUTH](state) {
        JwtService.unsetToken();
        Object.assign(state, getDefaultState());
    },
};

const actions = {
    [LOGIN](context, credentials) {
        return new Promise((resolve, reject) => {
            ApiService.post("api/users/login", {user: credentials})
                .then(({data}) => {
                    context.commit(CLEAR_ERRORS);
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
        return new Promise((resolve, reject) => {
            ApiService.get("api/users/logout")
                .then(({data}) => {
                    context.commit(RESET_AUTH);
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(
                        SET_ERROR,
                        {target: 'logout', message: response.data.error}
                    );
                    reject(response);
                });
        });
    },
    [REGISTER](context, credentials) {
        return new Promise((resolve, reject) => {
            ApiService.post("api/users", {user: credentials})
                .then(({data}) => {
                    console.log(data);
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
    [CHECK_AUTH](context) {
        if (JwtService.getToken()) {
            ApiService.setHeader();
            ApiService.get("api/token/validate")
                .catch(({ response }) => {
                    context.commit(RESET_AUTH);
                });
        } else {
            context.commit(RESET_AUTH);
        }
    },
};

export default {
    getters,
    actions,
    mutations,
    state
}
