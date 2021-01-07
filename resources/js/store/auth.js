import $axios from '../api/index'

const state = () => {

}

const mutations = {

}

const actions = {
    submit({commit}, payload) {
        commit('SET_LOADING', true, {root: true})
        localStorage.setItem('token', null)
        commit('SET_TOKEN', null, {root: true})
        return new Promise((resolve, reject) => {
            $axios.post('/login', payload).then(response => {
                commit('SET_LOADING', false, {root: true})
                if ( response.data.success ) {
                    localStorage.setItem('token', response.data.token)
                    commit('SET_TOKEN', response.data.token)
                } else {
                    commit('SET_ERRORS', {invalid: response.data.message}, {root: true})
                }
                resolve(response.data)
            }).catch(error => {
                commit('SET_LOADING', false, {root: true})
                localStorage.removeItem('token')
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, {root: true})
                }
            })
        })
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}