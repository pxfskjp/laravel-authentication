import ApiService from "../api/api.service";
import JwtService from "../common/jwt.service";

import {CHECK_AUTH} from "./action.type"

import {SET_AUTH, SET_ERROR, RESET_AUTH} from "../store/mutations.type";

const state = {
    errors: null,
    user: {},
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

};

const actions = {

};

export default {
    getters,
    actions,
    mutations,
    state
}