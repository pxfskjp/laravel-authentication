import ApiService from "../../../api/api.service";
import JwtService from "../../../common/jwt.service"
import Vue from 'vue';

const state = {
    token: null,
    errors: {
        login: [],
        register: []
    },
    userId: null,
    isAuthenticated: false,
};

const getters = {
    getLoginErrors(state) {
        return state.errors.login;
    },
    getRegistrationErrors(state) {
        return state.errors.register;
    },
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
    clearErrors(state) {
        state.errors = [];
    },
    setError(state, {target, errors}) {

        Vue.set(state.errors, target, []);

        for (let key in errors)
            state.errors[target].push(errors[key][0]);
    },
    setUser(state, data) {
        state.isAuthenticated = true;
        state.userId = data.userId;
        state.token = data.token;
        state.errors = {
            login: [],
            register: []
        };
        JwtService.setToken(data.token);
    },
    logout(state, payload) {
        JwtService.unsetToken();
    },
};

const actions = {
    login(context, credentials) {
        return new Promise((resolve, reject) => {
            ApiService.post("api/users/login", credentials)
                .then(({data}) => {
                    context.commit("clearErrors");
                    context.commit(
                        "setUser", {userId: data.user_id, token: data.token}
                    );
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(
                        "setError",
                        {target: 'login', message: response.data.error}
                    );
                    reject(response);
                });
        });
    },
    logout(context, payload) {
        context.commit("logout");
        context.commit("resetState", null, { root: true });
        return new Promise((resolve, reject) => {
            ApiService.get("api/users/logout")
                .then(({data}) => {
                    context.commit("logout");
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(
                        "setError",
                        {target: 'logout', message: response.data.error}
                    );
                    reject(response);
                });
        });
    },
    register(context, credentials) {
        return new Promise((resolve, reject) => {
            ApiService.post("api/users", credentials)
                .then(({data}) => {
                    context.commit("setUser", {userId: data.user_id, token: data.token});
                    resolve(data);
                })
                .catch(({response}) => {

                    if(response.status === 422) {

                        context.commit(
                            "setError",
                            {target: 'register', errors: response.data.errors}
                        );
                    }
                    reject(response);
                });
        });
    },
    checkAuth(context) {
        if (JwtService.getToken()) {
            ApiService.setHeader();
            ApiService.get("api/token/validate")
                .catch(({ response }) => {
                    context.commit("logout");
                });
        } else {
            context.commit("logout");
        }
    },
};

export default {
    namespaced: true,
    getters,
    actions,
    mutations,
    state
}
