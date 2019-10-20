import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        activeTab: 'Inventory',
        token: document
            .querySelector("meta[name='csrf-token']")
            .getAttribute('content')
    },
    getters: {
        getActiveTab(state) {
            return state.activeTab
        },
        getToken(state) {
            return state.token
        }
    },
    mutations: {
        toogleActiveTab(state, payload) {
            state.activeTab = payload
        }
    },
    actions: {}
})
