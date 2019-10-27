import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        activeTab: 'Inventory',
        token: document
            .querySelector("meta[name='csrf-token']")
            .getAttribute('content'),
        user: JSON.parse(localStorage.getItem('User')),
        requestAdded: false
    },
    getters: {
        getActiveTab(state) {
            return state.activeTab
        },
        getToken(state) {
            return state.token
        },
        getUser(state) {
            return state.user
        },
        getRequestAdded(state) {
            return state.requestAdded
        }
    },
    mutations: {
        toogleActiveTab(state, payload) {
            state.activeTab = payload
        },
        setUserData(state, payload) {
            state.user = payload
        },
        setRequestAdded(state, payload) {
            state.requestAdded = payload
        }
    },
    actions: {}
})
