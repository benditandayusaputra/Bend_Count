import Vue from 'vue';
import Vuex from 'vuex'

import auth from './auth'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth
    },
    state: {
        token: localStorage.getItem('token'),
        errors: [],
        loading: false
    },
    getters: {
        isAuth: state => {
            return state.token != 'null' && state.token != null
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        }, 
        CLEAR_ERRORS(state) {
            state.errors = []
        },
        SET_LOADING(state, payload) {
            state.loading = payload
        }
    }
})

export default store