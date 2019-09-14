import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        activeTab: 'Inventory'
    },
    getters: {
        getActiveTab(state) {
            return state.activeTab
        }
    },
    mutations: {
        toogleActiveTab(state, payload) {
            state.activeTab = payload
        }
    },
    actions: {}
})
